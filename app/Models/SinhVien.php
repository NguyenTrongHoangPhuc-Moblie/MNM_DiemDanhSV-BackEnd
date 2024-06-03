<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SinhVien extends Model
{
    use HasFactory;
    protected $fillable = ['MaSV', 'HoTenSV', 'GioiTinh', 'NgaySinh', 'SoDienThoai', 'Email', 'DiaChi', 'MaKhoa', 'MaNganh', 'MaLNC'];
    protected $primaryKey = 'MaSV';
    public $timestamps = false;
    protected $table = 'SinhVien';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $with = ['Khoa', 'Nganh', 'LopNienChe'];
    //protected $f
    public function Khoa() : BelongsTo {
        return $this->belongsTo(Khoa::class, 'MaKhoa', 'MaKhoa');
    }

    public function Nganh() : BelongsTo {
        return $this->belongsTo(Nganh::class, 'MaNganh', 'MaNganh');
    }

    public function LopNienChe() : BelongsTo{
        return $this->belongsTo(LopNienChe::class, 'MaLNC', 'MaLNC');
    }
    public function DanhSachSinhVien_LopHocPhan() : HasMany {
        return $this->hasMany(DanhSachSinhVien_LopHocPhan::class, 'MaSV', 'MaSV');
    }
}
