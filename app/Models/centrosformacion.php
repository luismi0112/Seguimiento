<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centrosformacion extends Model
{
    protected $table = 'tbl_centrosformacion';
    protected $primaryKey = 'NIS';
    public $timestamps = false;

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Observaciones',
        'tblregionales_NIS'
    ];

    public function regional()
    {
        return $this->belongsTo(Regionales::class, 'tblregionales_NIS', 'NIS');
    }

    public function fichas()
    {
        return $this->hasMany(Fichasdecaracterizacion::class, 'tblcentrosdeformacion_NIS', 'NIS');
    }
}
