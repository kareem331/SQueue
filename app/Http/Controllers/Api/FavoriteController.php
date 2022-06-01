<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    public function AddFavorite(Request $request){
        try{
            $favoriteRequest = $request->all();
            $validator = Validator::make($favoriteRequest,[
                'user_id' => 'required|exists:users,id',
                'branch_id' => 'required|exists:branches,id',
            ]);

            if($validator->fails()){
                return response()->json([
                    'message' => $validator->errors()->all(),
                    'status' => false
                ],400);
            }

             Favorite::create([
                'user_id'=> $request->user_id,
                'branch_id'=> $request->branch_id
            ]);

            return response()->json([
                'message' => 'success message',
                'status' => true
            ]);
        }catch (\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false
            ],500);
        }
    }

    public function getFavorite(Request $request,$id){

        try{
            $favorits = Favorite::where('user_id',$id)
                ->with('branch')
                ->get();

                return response()->json([
                    'data' => $favorits,
                    'message' => 'success message',
                    'status' => true
                ]);

        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => false
            ],500);
        }
    }
}
