<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $primaryKey='no_trans';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $guarded = ['no_trans'];
}
