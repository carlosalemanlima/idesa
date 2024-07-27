<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';
    public $timestamps = false;

    protected $fillable = ['name', 'nationality', 'birthdate'];

    protected $casts = [
        'birthdate' => 'date',
    ];
}
