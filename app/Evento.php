<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    //
    use SoftDeletes;
    protected  $table = "eventos";

    protected $fillable = ['descricao','scr'];

    protected $guarded = ['id','carro_id'];

    public $dates = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];
}
