<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nganh extends Model
{
    use HasFactory;

    protected $fillable = ['MaNganh', 'TenNganh', 'SoLuongSV'];
    protected $primaryKey = 'MaNganh';
    public $timestamps = false;
    protected $table = 'Nganh';
    public $incrementing = false;
    protected $keyType = 'string';
    public function SinhVien() : HasMany{
        return $this->hasMany(SinhVien::class, 'MaNganh', 'MaNganh');
    }
}
