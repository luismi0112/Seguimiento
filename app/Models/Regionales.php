<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regionales extends Model
{
    protected $table = 'tbl_regionales';
    protected $primaryKey = 'NIS';
    public $timestamps = false;

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Observaciones'
    ];
}
