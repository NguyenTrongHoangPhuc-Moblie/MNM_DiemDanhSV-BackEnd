<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TietHoc extends Model
{
    use HasFactory;
    protected $fillable = ['MaTH', 'TenTH', 'GioBD', 'GioKT'];
    protected $primaryKey = 'MaTH';
    public $timestamps = false;
    protected $table = 'TietHoc';
    public $incrementing = false;
    protected $keyType = 'string';
    public function ChiTietNgayHoc() : HasMany{
        return $this->hasMany(ChiTietNgayHoc::class, 'MaTH', 'MaTH');
    }
}
