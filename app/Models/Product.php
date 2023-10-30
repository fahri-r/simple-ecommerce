<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product';
    
    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'image_id'
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id', 'id');
    }
}
