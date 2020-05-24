<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Covid extends Model
{
    
	protected $table = 'tb_input';
	protected $primaryKey = 'id_input';
    protected $fillable = [
        'id_kabupaten', 'tanggal', 'positif', 'rawat', 'sembuh', 'meninggal',
    ];
}
