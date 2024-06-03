<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NgayHoc extends Model
{
    use HasFactory;
    protected $fillable = ['MaNH', 'Ngay', 'Thu'];
    protected $primaryKey = 'MaNH';
    public $timestamps = false;
    protected $table = 'NgayHoc';
    public $incrementing = false;
    protected $keyType = 'string';
    public function ChiTietNgayHoc() : HasMany{
        return $this->hasMany(ChiTietNgayHoc::class, 'MaNH', 'MaNH');
    }
}
