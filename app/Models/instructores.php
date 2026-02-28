<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class instructores extends Model
{
    protected $table = 'tbl_instructores';
    protected $primaryKey = 'NIS';
    public $timestamps = false;

    protected $fillable = [
        'Numdoc',
        'Nombres',
        'Apellidos',
        'Direccion',
        'Telefono',
        'CorreoInstitucional',
        'CorreoPersonal',
        'Sexo',
        'FechaNacimiento',
        'tbleps_NIS',                  
        'tblrolesadministrativos_NIS'
    ];
}
