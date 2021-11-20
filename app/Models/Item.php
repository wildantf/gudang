<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
