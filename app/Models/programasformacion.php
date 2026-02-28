<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programasformacion extends Model
{
    protected $table = 'tbl_programasformacion';
    protected $primaryKey = 'NIS';
    public $timestamps = false;

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Observaciones'
    ];

    public function fichas()
    {
        return $this->hasMany(Fichasdecaracterizacion::class, 'tblprogramasdeformacion_NIS', 'NIS');
    }
}
