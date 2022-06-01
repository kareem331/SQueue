<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Department;
use App\Models\Place;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class BranchController extends Controller
{
    use GeneralTrait;

    public function insertBranch(Request $request)
    {
        try {
            $branch_image ='';
            if ($request->hasFile('image')) {
                $branch_image = $this->saveImage($request->image, 'branches');
            }
            Branch::create([
                'place_id'=>$request->place_id,
                'name'=> $request->name,
                'location'=> $request->location,
                'image'=> $branch_image
            ]);
            return $this->returnSuccessMessage('inserted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
    public function getBranches(Request $request,$id)
    {
        return UIController::Branches(Place::find($id)->branch);
    }


}
