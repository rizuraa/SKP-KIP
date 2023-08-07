<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jarak;

class DataTesting extends Model
{
    use HasFactory;
    protected $table = 'data_testing';
    protected $guarded = ['id'];
    protected $fillable = [
        'nama',
        'asalSekolah',
        'rataRapor',
        'penghasilanOrtu',
        'tanggunganOrtu',
        'riwayatOrganisasi',
        'riwayatPrestasi',
        'KIP',
    ];

    public function jaraks(){
        return $this->belongsTo(Jarak::class, 'jarak');
    }
}
