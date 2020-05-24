<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    
    protected $table = 'tb_kabupaten';
    protected $primaryKey = 'id_kabupaten';
    protected $fillable = [
    	'kabupaten',
    ];
}
