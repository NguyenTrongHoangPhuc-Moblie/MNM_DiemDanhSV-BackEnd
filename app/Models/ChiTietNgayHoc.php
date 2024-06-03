<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTietNgayHoc extends Model
{
    use HasFactory;
    protected $fillable = ['MaNH', 'MaTH', 'MaLop'];
    protected $primaryKey = ['MaNH', 'MaTH', 'MaLop'];
    protected $with = ['NgayHoc', 'TietHoc', 'LopHocPhan'];
    public $timestamps = false;
    protected $table = 'ChiTietNgayHoc';
    public $incrementing = false;
    protected $keyType = 'string';
    public function LopHocPhan() : BelongsTo{
        return $this->belongsTo(LopHocPhan::class, 'MaLop', 'MaLop');
    }
    public function TietHoc() : BelongsTo{
        return $this->belongsTo(TietHoc::class, 'MaTH', 'MaTH');
    }
    public function NgayHoc() : BelongsTo{
        return $this->belongsTo(NgayHoc::class, 'MaNH', 'MaNH');
    }
}
