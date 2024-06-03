<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonHoc extends Model
{
    use HasFactory;

    protected $fillable = ['MaMH', 'TenMH', 'SoTietLyThuyet', 'SoTietThucHanh', 'TongSoTiet', 'SoTinChi'];
    protected $primaryKey = 'MaMH';
    public $timestamps = false;
    protected $table = 'MonHoc';
    public $incrementing = false;
    protected $keyType = 'string';
    public function LopHocPhan() : HasMany{
        return $this->hasMany(LopHocPhan::class, 'MaMH', 'MaMH');
    }
}
