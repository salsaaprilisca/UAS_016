<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $table = 'sports';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'umur','alamat', 'cabang_olahraga','tinggi', 'coach_id'];

    public function pelatih(){
        return $this->belongsTo(Coach::class, 'coach_id');
    }
}
