<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fichasdecaracterizacion extends Model
{
    protected $table = 'tbl_fichasdecaracterizacion';
    protected $primaryKey = 'NIS';
    public $timestamps = false;

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Cupo',
        'Fechainicio',
        'Fechafin',
        'Observaciones',
        'tblprogramasdeformacion_NIS',
        'tblcentrosdeformacion_NIS'
    ];

    public function programa()
    {
        return $this->belongsTo(Programasformacion::class, 'tblprogramasdeformacion_NIS', 'NIS');
    }

    public function centro()
    {
        return $this->belongsTo(Centrosformacion::class, 'tblcentrosdeformacion_NIS', 'NIS');
    }
}
