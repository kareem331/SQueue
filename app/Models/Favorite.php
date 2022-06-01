<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    protected $fillable=['user_id','branch_id'];
    protected $hidden = ['created_at', 'updated_at'];



    public function branch()
    {
        return $this->belongsTo(Branch::class);

    }
    public function user()
    {
        return $this->belongsTo(User::class);

    }}
