<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Covid extends Model
{
    
	protected $table = 'tb_input';
	protected $primaryKey = 'id_input';
    protected $fillable = [
        'id_kabupaten', 'id_kecamatan', 'id_kelurahan', 'level', 'pp-ln', 'pp-dn', 'tl', 'lainnya', 'tanggal', 'positif', 'rawat', 'sembuh', 'meninggal',
    ];
}
