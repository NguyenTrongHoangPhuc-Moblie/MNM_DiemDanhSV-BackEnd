<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrinhDo extends Model
{
    use HasFactory;
    protected $fillable = ['MaTD', 'TenTD'];
    protected $primaryKey = 'MaTD';
    public $timestamps = false;
    protected $table = 'TrinhDo';
    public $incrementing = false;
    protected $keyType = 'string';
}
