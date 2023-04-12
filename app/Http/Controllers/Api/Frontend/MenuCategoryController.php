<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function index(){
        try {
            $data = Group::where('status', '=', 1)
                ->where('module', '=', config('module.menu-category.key'))
                ->select('id','image','title','target','url','parent_id','slug')
                ->where('status',1)
                ->orderBy('order')
                ->get();

            return response()->json([
                'message' => 'Menu trang chủ.',
                'status' => 1,
                'data' => $data,
            ], 200);
        }catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json([
                    'message' => 'Có lỗi phát sinh',
                    'status' => 0
                ], 200);
            }
            return response()->json([
                'message' => 'Lỗi hệ thống.',
                'status' => -1
            ], 500);
        }

    }
}
