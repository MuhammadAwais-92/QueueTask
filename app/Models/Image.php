<?php


namespace App\Models;

//use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{




    protected $fillable = [
        'image',
        'path',
    ];
}
