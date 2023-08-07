<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jarak;

class DataTraining extends Model
{
    use HasFactory;
    protected $table = 'data_training';
    protected $fillable = [
        'nama',
        'asalSekolah',
        'rataRapor',
        'penghasilanOrtu',
        'tanggunganOrtu',
        'riwayatOrganisasi',
        'riwayatPrestasi',
        'KIP',
        'Klasifikasi',
    ];

    public function jaraks(){
        return $this->belongsTo(Jarak::class, 'jarak');
    }
}
