<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiposdedocumentos extends Model
{
    protected $table = 'tbl_tiposdedocumentos';
    protected $primaryKey = 'NIS';
    public $timestamps = false;

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Observaciones'
    ];
}
