<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    
    protected $table = 'tb_kelurahan';
    protected $primaryKey = 'id_kelurahan';
    protected $fillable = [
    	'id_kelurahan','kelurahan',
    ];
}
