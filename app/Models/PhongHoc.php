<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongHoc extends Model
{
    use HasFactory;

    protected $fillable = ['TenPH', 'DiaChiPH'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $table = 'PhongHoc';
}
