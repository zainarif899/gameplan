<?php

namespace App\Http\Controllers;
use App\Http\Requests\Filerequest;
use App\Models\File;
use App\Repositories\interface\Filesinterface;
use Smalot\PdfParser\Parser;


use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class FileController extends Controller
{
    protected $userRepository;

    public function __construct(Filesinterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(Filerequest $request){
        $file = $request->file;
        $validation = $request->validate();
        
        // use of pdf parser to read contents from pdf 
        $fileName = $file->getClientOriginalName();

        $pdfParser = new Parser();
        $pdf = $pdfParser->parseFile($file->path());
        $content = $pdf->getText();

       $upload_file = new File;
       $upload_file->orig_filename = $fileName;
       $upload_file->mime_type = $file->getMimeType();
       $upload_file->filesize = $file->getSize();
       $upload_file->content = $content;
       $upload_file->save();
       return redirect()->back()->with('success', 'File  submitted');
       
    }
}
