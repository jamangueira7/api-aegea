<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    //
    use SoftDeletes;
    protected  $table = "registffros";

    protected $fillable = ['motorista','endereco', 'data_inc', 'data_pos', 'latitude', 'longitude'];

    protected $guarded = ['id','carro_id'];

    public $dates = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];
}
