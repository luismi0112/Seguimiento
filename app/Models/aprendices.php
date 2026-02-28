<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tiposdedocumentos;
use App\Models\Eps;
use App\Models\Fichasdecaracterizacion;

class aprendices extends Model
{
    protected $table = 'tbl_aprendices';
    protected $primaryKey = 'NIS';
    public $timestamps = false;

    // Muy importante: indicar que la PK es numérica y autoincremental
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'tbltiposdocumentos_NIS',
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
        'tblfichasdecaracterizacion_NIS'
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(Tiposdedocumentos::class, 'tbltiposdocumentos_NIS', 'NIS');
    }

    public function eps()
    {
        return $this->belongsTo(Eps::class, 'tbleps_NIS', 'NIS');
    }

    public function ficha()
    {
        return $this->belongsTo(Fichasdecaracterizacion::class, 'tblfichasdecaracterizacion_NIS', 'NIS');
    }
}
