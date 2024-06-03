<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LopNienChe extends Model
{
    use HasFactory;
    protected $fillable = ['MaLNC', 'TenLNC', 'SiSo', 'MaGV'];
    protected $primaryKey = 'MaLNC';
    public $timestamps = false;
    protected $table = 'LopNienChe';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $with = ['GiaoVien'];
    //protected $f
    public function GiaoVien() : BelongsTo {
        return $this->belongsTo(GiaoVien::class, 'MaGV', 'MaGV');
    }
}
