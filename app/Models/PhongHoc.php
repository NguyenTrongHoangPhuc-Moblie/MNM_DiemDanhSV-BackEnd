<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhongHoc extends Model
{
    use HasFactory;

    protected $fillable = ['MaPH', 'TenPH', 'DiaChiPH'];
    protected $primaryKey = 'MaPH';
    public $timestamps = false;
    protected $table = 'PhongHoc';
    public $incrementing = false;
    protected $keyType = 'string';
    public function LopHocPhan() : HasMany{
        return $this->hasMany(LopHocPhan::class, 'MaPH', 'MaPH');
    }
}
