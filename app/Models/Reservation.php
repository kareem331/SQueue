<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable=[
        'user_id',
        'branch_id',
        'status',
        'turn',
        'current_reservation',

    ];
    public function branch()
    {
        return $this->belongsTo(Branch::class)->with('place');

    }
    public function user()
    {
        return $this->belongsTo(User::class);

    }


}
