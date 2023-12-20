<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo'
    ];
    protected $table = 'type_produks';
}
