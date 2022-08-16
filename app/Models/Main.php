<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'content',
        'trail',
        'title_ar',
        'content_ar',
        'trail_ar',
        'images'
];
}
