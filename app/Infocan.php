<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infocan extends Model
{
    //
    use SoftDeletes;
    protected  $table = "infocan";

    protected $fillable = ['combustivel','cinto', 'freio', 'limp'];

    protected $guarded = ['id','carro_id'];

    public $dates = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];
}
