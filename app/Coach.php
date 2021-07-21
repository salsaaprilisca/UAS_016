<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $table = 'coaches';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'umur', 'alamat','masa_jabatan','negara'];

    public function atlet(){
        return $this->hasMany(Sport::class);
    }
}
