<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $filliable = [
        'title',
        'detail',
        'image'
    ];

    function findAll(){
        return Category::all();
    }
}
