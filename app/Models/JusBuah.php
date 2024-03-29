<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JusBuah extends Model
{
    use HasFactory;

    protected $primaryKey='id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = ['id'];
}
