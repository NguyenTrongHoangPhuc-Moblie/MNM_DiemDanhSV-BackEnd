<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
    use HasFactory;

    protected $fillable = ['MaNganh', 'TenNganh', 'SoLuongSV'];
    protected $primaryKey = 'MaNganh';
    public $timestamps = false;
    protected $table = 'Nganh';
    public $incrementing = false;
    protected $keyType = 'string';
}
