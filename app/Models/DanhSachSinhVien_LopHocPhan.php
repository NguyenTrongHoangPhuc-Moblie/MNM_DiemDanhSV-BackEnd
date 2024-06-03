<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DanhSachSinhVien_LopHocPhan extends Model
{
    use HasFactory;
    protected $fillable = ['MaSV', 'MaLop', 'SoLanVang', 'SoLanCoMat'];
    protected $primaryKey = ['MaSV', 'MaLop'];
    protected $with = ['SinhVien', 'LopHocPhan'];
    public $timestamps = false;
    protected $table = 'danhsachsinhvien_lophocphan';
    public $incrementing = false;
    protected $keyType = 'string';
    public function LopHocPhan() : BelongsTo{
        return $this->belongsTo(LopHocPhan::class, 'MaLop', 'MaLop');
    }
    public function SinhVien() : BelongsTo{
        return $this->belongsTo(SinhVien::class, 'MaSV', 'MaSV');
    }
}
