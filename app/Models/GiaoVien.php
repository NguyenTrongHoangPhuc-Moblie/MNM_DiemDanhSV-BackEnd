<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChuyenMon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GiaoVien extends Model
{
    use HasFactory;
    protected $fillable = ['MaGV', 'HoTenGV', 'NamSinh', 'GioiTinh', 'DiaChi', 'MaCM', 'MaTD'];
    protected $primaryKey = 'MaGV';
    public $timestamps = false;
    protected $table = 'GiaoVien';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $with = ['ChuyenMon', 'TrinhDo'];
    //protected $f
    public function ChuyenMon() : BelongsTo {
        return $this->belongsTo(ChuyenMon::class, 'MaCM', 'MaCM');
    }

    public function TrinhDo() : BelongsTo {
        return $this->belongsTo(TrinhDo::class, 'MaTD', 'MaTD');
    }
}
