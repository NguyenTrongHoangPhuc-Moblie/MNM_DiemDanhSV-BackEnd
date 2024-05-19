<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    use HasFactory;
    protected $fillable = ['MaKhoa', 'TenKhoa', 'SoLuongSV'];
    protected $primaryKey = 'MaKhoa';
    public $timestamps = false;
    protected $table = 'Khoa';
    public $incrementing = false;
    protected $keyType = 'string';
}
