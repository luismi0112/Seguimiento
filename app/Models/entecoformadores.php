<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class entecoformadores extends Model
{
    protected $table = 'tbl_entecoformadores';
    protected $primaryKey = 'NIS';

    protected $fillable = [
        'Tdoc',
        'Numdoc',
        'Nombres',
        'RazonSocial',
        'Direccion',
        'Telefono',
        'CorreoInstitucional'
    ];

    public $timestamps = false;

    public function tipoDocumento()
    {
        return $this->belongsTo(Tiposdedocumentos::class, 'Tdoc', 'NIS');
    }
}
