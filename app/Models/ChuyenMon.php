<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChuyenMon extends Model
{
    use HasFactory;
    protected $fillable = ['MaCM', 'TenCM'];
    protected $primaryKey = 'MaCM';
    public $timestamps = false;
    protected $table = 'ChuyenMon';
    public $incrementing = false;
    protected $keyType = 'string';
    public function GiaoVien() : HasMany{
        return $this->hasMany(GiaoVien::class, 'MaCM', 'MaCM');
    }
}
