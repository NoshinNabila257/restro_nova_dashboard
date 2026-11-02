<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MenuItem;

class Restaurant extends Model
{
    protected $table = 'restaurants';

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'image',
        'is_active',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
