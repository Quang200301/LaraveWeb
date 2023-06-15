<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lazada extends Model
{
    protected $table='lazadas';
    protected  $fillable = ['name','avatar','price,shopower'];
    use HasFactory;
}
