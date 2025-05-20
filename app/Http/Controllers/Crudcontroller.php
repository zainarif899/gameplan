<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\interface\Userinterface;
use PhpParser\Node\Expr\FuncCall;
use App\Repositories\Eloquent\Userrepository;
use App\Models\User; 

class Crudcontroller extends Controller
{
    protected $userRepo;

    public function __construct(Userinterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'email','password','file']);
        $file = $request->file('file');
        if ($file) {
            $fileName = $this->userRepo->fileupload($file);
            $data['file'] = $fileName;
        }
        $user = $this->userRepo->create($data);
        return response()->json($user);
    }

    public function show($id)
    {
        $user = $this->userRepo->find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'email','password']);
        $user = $this->userRepo->update($id, $data);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $this->userRepo->delete($id);
        return response()->json(['message' => 'User deleted']);
    }

    public function parsar(){
        $parser = new \Smalot\PdfParser\Parser();
        $path = storage_path('app/public/uploads/1.pdf');
        $pdf = $parser->parseFile($path);
        $text = $pdf->getText();
        $metadata = $pdf->getDetails();
        $pageCount = $pdf->getPages();
     dd($pageCount);
    // echo $text . '<br>';
    // dd($text);
    }
    // public function parser(Request $request)
    // {
    //     $data = $request->only(['name', 'email','password']);
    //     $file = $request->file('file');
    //     if ($file) {
    //         $fileName = $this->userRepo->fileupload($file);
    //         $data['file'] = $fileName;
    //     }
    //     return response()->json($data);
    // }
    // public function fileupload(Request $request)
    // {
    //     $file = $request->file('file');
    //     $fileName = $this->userRepo->fileupload($file);
    //     return response()->json(['file_name' => $fileName]);
    // }


   
    
    public function user_page(Request $request)
    {
        return view('userview');
    }


}
