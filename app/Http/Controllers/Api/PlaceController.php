<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Category;
use App\Models\Place;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Utils;

class PlaceController extends Controller
{
    use GeneralTrait;
    public function insertPlace(Request $request)
    {
        try {
            $place_image = '';
            if ($request->hasFile('image')) {
                $place_image = $this->saveImage($request->image, 'places');
            }
            Place::create([
                'category_id'=>$request->category_id,
                'name'=> $request->name,
                'information'=> $request->information,
                'image'=> $place_image
            ]);

            return $this->returnSuccessMessage('inserted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }



    public function getPlaces(Request $request,$id)
    {
        return UIController::handleJson(Category::find($id)->places);
    }




}
