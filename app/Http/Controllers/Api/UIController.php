<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UIController extends Controller
{
    public static function handleJson($data)
    {
        return response()->json(
            [
                'status' => 'success',
                'Places' => $data,
                'message' => 'data returned successfully'
            ]
        );
    }
    public static function Branches($data)
    {
        return response()->json(
            [
                'status' => 'success',
                'Branches' => $data,
                'message' => 'data returned successfully'
            ]
        );
    }
}
