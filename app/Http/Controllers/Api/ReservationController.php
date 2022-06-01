<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function Reservation(Request $request)
    {
        $last = Reservation::query()->where('branch_id', $request->branch_id)->orderBy('created_at', 'desc')->first();
        global $carrent;
        if ($last != null) {
            $carrent = Reservation::create([

                'user_id' => $request->user_id,
                'branch_id' => $request->branch_id,
                'status' => true,
                'turn' => $last->turn + 1,
                'current_reservation' => $last->current_reservation
            ]);
        } else $carrent = Reservation::create([

            'user_id' => $request->user_id,
            'branch_id' => $request->branch_id,
            'status' => true,
            'turn' => 1,
            'current_reservation' => 1
        ]);

        return response()->json([
            'data' => $carrent,
            'message' => 'successful',

        ]);

    }
    public function getReservations(){

       return  Reservation::query()->where('user_id',auth()->user()->id)->with('branch')->get()->all();
    }
    public function updateCurrentReservation(Request $request)
    {
        $last = Reservation::query()->where('branch_id', $request->branch_id)->update(array('current_reservation'=>$request->current_reservation));


        return response()->json([
            'data' => $last,
            'message' => 'successful',

        ]);

    }

}
