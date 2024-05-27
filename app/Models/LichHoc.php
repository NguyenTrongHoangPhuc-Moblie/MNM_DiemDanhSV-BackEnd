<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichHoc extends Model
{
    use HasFactory;

    protected $fillable = ['MaTGH', 'SoLuongNgayHoc', 'NgayBD', 'NgayKT'];
    protected $primaryKey = 'MaTGH';
    public $timestamps = false;
    protected $table = 'ThoiGianHoc';
    public $incrementing = false;
    protected $keyType = 'string';
}
