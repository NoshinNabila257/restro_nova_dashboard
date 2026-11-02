<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'price',
        'category',
        'image',
        'is_available',
        'customization_options',
    ];

    protected function casts(): array
{
    return [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'customization_options' => 'array',
    ];
}

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
