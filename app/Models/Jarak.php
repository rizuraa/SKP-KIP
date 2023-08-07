<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataTesting;
use App\Models\DataTraining;

class Jarak extends Model
{
    use HasFactory;

    protected $guarded = 'id';
    protected $table = 'jarak';

    public function data_testings(){
        return $this->hasMany(DataTesting::class, 'data_testing');
    }

    public function data_trainings(){
        return $this->hasMany(DataTraining::class, 'data_training');
    }
}
