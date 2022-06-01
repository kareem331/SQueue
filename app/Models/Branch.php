<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['place_id', 'name', 'location', 'image'];
    protected $hidden = ['created_at', 'updated_at'];

    public function place()
    {
        return $this->belongsTo(Place::class)->with('category');

    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

}
