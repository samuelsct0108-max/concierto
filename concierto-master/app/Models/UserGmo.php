<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGmo extends Model
{
    use HasFactory;

    protected $table = 'users_gmos';

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_rol',
    ];
}
