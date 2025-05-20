<?php

namespace App\Repositories\interface;

interface Userinterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function fileupload($file);
    // public function download($file);
}
