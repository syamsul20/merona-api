<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Barang;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama','image'
    ];

    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class);
    }
}

