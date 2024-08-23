<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Cliente extends Authenticatable
{
    use HasFactory;
    protected $table = 'cliente'; // Especifica el nombre de la tabla en singular

    protected $fillable = [
        'nombres',
        'apellidos',
        'email',
        'password',
        'foto_perfil',
        'celular',
        'direccion',
        ];  

    }
