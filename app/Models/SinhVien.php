<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;
    protected $fillable = ['MaSV', 'HoTenSV', 'GioiTinh', 'NgaySinh', 'SoDienThoai', 'Email', 'DiaChi', 'MaKhoa', 'MaNganh', 'MaLNC'];
    protected $primaryKey = 'MaSV';
    public $timestamps = false;
    protected $table = 'SinhVien';
    public $incrementing = false;
    protected $keyType = 'string';
}
