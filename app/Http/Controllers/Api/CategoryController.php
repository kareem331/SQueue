<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Type;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    use GeneralTrait;
    public function insert(Request $request)
    {
        try {
            $category_image = '';
            if ($request->hasFile('image')) {
                $category_image = $this->saveImage($request->image, 'categories');
            }
            Category::create([
                'name' => $request->name,
                'image' => $category_image

            ]);
            return $this->returnSuccessMessage('inserted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
    public function getCategories()
    {
        try {
            $categories = Category::get();
            return $this->returnData('Categories', $categories);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

}
