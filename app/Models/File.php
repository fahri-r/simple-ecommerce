<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    use HasFactory;

    protected $table = 'file';

    protected $fillable = [
        'url',
        'name',
        'type',
        'size',
    ];


    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
