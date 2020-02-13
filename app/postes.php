<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postes extends Model
{
    protected $table='posts';
    protected $fillable = [
        'id','description','articles_id'
    ];
}
