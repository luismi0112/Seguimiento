<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rolesadministrativos extends Model
{
    protected $table = 'tbl_rolesadministrativos';
    protected $primaryKey = 'NIS';

    protected $fillable = [
        'Descripcion'
    ];

    public $timestamps = false;
}
