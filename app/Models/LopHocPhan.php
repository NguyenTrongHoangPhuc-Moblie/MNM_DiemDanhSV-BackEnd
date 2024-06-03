<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LopHocPhan extends Model
{
    use HasFactory;
    protected $fillable = ['MaLop', 'TenLop', 'SiSo', 'MaGV', 'MaMH', 'MaPH'];
    protected $primaryKey = 'MaLop';
    public $timestamps = false;
    protected $table = 'LopHocPhan';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $with = ['MonHoc', 'GiaoVien', 'PhongHoc'];
    //protected $f
    public function MonHoc() : BelongsTo {
        return $this->belongsTo(MonHoc::class, 'MaMH', 'MaMH');
    }
    public function GiaoVien() : BelongsTo {
        return $this->belongsTo(GiaoVien::class, 'MaGV', 'MaGV');
    }
    public function PhongHoc() : BelongsTo {
        return $this->belongsTo(PhongHoc::class, 'MaPH', 'MaPH');
    }
    public function DanhSachSinhVien_LopHocPhan() : HasMany {
        return $this->hasMany(DanhSachSinhVien_LopHocPhan::class, 'MaLop', 'MaLop');
    }
}
