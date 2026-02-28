<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
    protected $table = 'tbl_eps';
    protected $primaryKey = 'NIS';
    public $timestamps = false;

    protected $fillable = [
        'Numdoc',
        'Denominacion',
        'Observaciones'
    ];
}
