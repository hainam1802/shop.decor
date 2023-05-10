<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Library\HelpersDevice;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Group;
use App\Models\Group_Item_Index;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use ArrayObject;
use Illuminate\Http\Request;
use App\Models\UserAction;
use Auth;
use App\Models\Group_Item;
use App\Models\SubItem;
use App\Models\Installment;
use App\Models\InstallmentDetail;
use function Doctrine\Common\Cache\Psr6\get;
use Illuminate\Support\Facades\Cookie;
use Validator;

class SettingController extends Controller
{
    public function getWidget(Request $request)
    {
        if(isset($request->id) && is_int((int)$request->id)){
            $data = Group_Item_Index::with('item')
                ->with(array('item' => function($query){
                    $query->with('groups');
                }))
                ->select('id','group_id','item_id','order')
                ->where('group_id',$request->id)
                ->orderBy('id','desc')
                ->orderBy('order','asc')
                ->get();

        }
        return response()->json([
            'message' => 'Thành công.',
            'status' => 1,
            'data' => $data,
        ], 200);
    }
    public function getAds(Request $request)
    {
        $data = Item::where('status', '=', 1)
            ->where('module', '=', config('module.advertise.key'))
            ->where('position','=',$request->id)
//            ->select('image','title','target','url')
            ->where('status',1)
            ->orderBy('id','desc')
            ->orderBy('order')
            ->get();
        return response()->json([
            'message' => 'Thành công.',
            'status' => 1,
            'data' => $data,
        ], 200);
    }



}
