<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthModel extends Model
{
    use HasFactory;

    protected $table = 'auth';
    protected $fillable = [
        'username',
        'password'
    ];
}