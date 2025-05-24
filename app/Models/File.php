<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = "files";

    protected $fillable = [
        'orig_filename',
        'mime_type',
        'filesize',
        'content'
    ];
}
