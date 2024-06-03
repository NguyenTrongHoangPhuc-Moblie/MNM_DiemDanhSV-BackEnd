<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BangDiemDanh extends Model
{
    use HasFactory;
    protected $fillable = ['MaDD', 'MaSV', 'MaLop', 'TrangThaiDiemDanh', 'NgayDiemDanh', 'SoLanVang', 'SoLanCoMat', 'GhiChu'];
    protected $primaryKey = ['MaDD'];
    protected $with = ['SinhVien', 'LopHocPhan'];
    public $timestamps = false;
    protected $table = 'BangDiemDanh';
    public $incrementing = false;
    protected $keyType = 'string';
    public function LopHocPhan() : BelongsTo{
        return $this->belongsTo(LopHocPhan::class, 'MaLop', 'MaLop');
    }
    public function SinhVien() : BelongsTo{
        return $this->belongsTo(TietHoc::class, 'MaSV', 'MaSV');
    }
}
