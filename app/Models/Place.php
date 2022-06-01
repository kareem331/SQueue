<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $table='places';



    protected $fillable=['category_id','name','information','image'];
    protected $hidden=['created_at','updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);

    }

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }
}
