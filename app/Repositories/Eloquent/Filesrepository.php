<?php 

namespace App\Repositories\Eloquent;
use App\Repositories\interface\Filesinterface;
use App\Models\File;
use Illuminate\Suport\Facades\Http;

class Filesrepository implements Filesinterface
{
    protected $model;

    public function __construct(File $model)
    {
        $this->model =$model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}