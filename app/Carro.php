<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carro extends Model
{
    //
    use SoftDeletes;
    protected  $table = "carros";

    protected $fillable = ['placa','numero_serial','id_interno','updated','','',];

    protected $guarded = ['id'];

    public $dates = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];
}
