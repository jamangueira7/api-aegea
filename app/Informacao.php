<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informacao extends Model
{
    //
    use SoftDeletes;
    protected  $table = "informacoes";

    protected $fillable = ['odo','odo_total', 'rpm', 'velocidade', 'log', 'ign', 'gps'];

    protected $guarded = ['id','carro_id'];

    public $dates = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];
}
