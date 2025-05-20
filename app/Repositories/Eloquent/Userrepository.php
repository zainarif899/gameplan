<?php 

namespace App\Repositories\Eloquent;
use App\Repositories\interface\Userinterface;
use Illuminate\Suport\Facades\Http;

use App\Models\User;


class Userrepository implements Userinterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }

    public function fileupload($file){
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $fileName);
        return $fileName;
    }

    // public function download($file)
    // {
    //     $filepath = public_path('uploads/' . $file);
    //     if (file_exists($filepath)) {
    //         return response()->download($filepath);
    //     }
    // }
}
