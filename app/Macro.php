<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Macro extends Model
{
    //
    use SoftDeletes;
    protected  $table = "macros";

    protected $fillable = ['descricao','apr_proc'];

    protected $guarded = ['id','carro_id'];

    public $dates = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];
}
