<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Library\HelpersDevice;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Group;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Provinces;
use App\Models\User;
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

class OrderController extends Controller
{

    public function postOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname'=>'required',
            'phone'=>'required',
            'provinces'=>'required',
            'districts'=>'required',
            'address'=>'required',
        ],[
            'fullname.required' => __('Vui lòng nhập tên đầy đủ'),
            'phone.required' => __('Vui lòng nhập số điện thoại'),
            'provinces.required' => __('Vui lòng chọn thành phố'),
            'districts.required' => __('Vui lòng chọn quận huyện'),
            'address.required' => __('Vui lòng nhập địa chỉ cụ thể'),
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => 0
            ],200);
        }
        // tìm sản phẩm
        if (!$request->cart){
            return response()->json([
                'message' => 'Bạn không có sản phẩm nào trong giỏ hàng để thực hiện thao tác này !',
                'status' => 0,
            ], 200);
        }
        $cart = collect($request->cart);
        $id_item = $cart->pluck('id')->toArray();
        $id_item = array_unique($id_item);
        $data_item = Item::where('module', '=','product')->whereIn('id',$id_item)->get();
        $total = [];
        $total_base = [];
        $count = [];
        foreach($cart as $item){
            $total[] = $item['price'] * $item['qty'];
            $total_base[] = $item['price_base'] * $item['qty'];
            $count[] = $item['qty'] ;
        }
        $total = array_sum($total);
        $total_base = array_sum($total_base);
        $count = array_sum($count);
        $order = Order::create([
            'module' => 'order',
            'author_id' => $request->userid,
            'price' => $total_base,
            'real_received_price' => $total,
            'type' => 1,
            'content' => $request->note,
            'status' => 2,
            'status_confirm' => 1,
        ]);

        $order_detail = array();
        $order_detail = [
            [
                'module' => 'fullname',
                'value' => $request->fullname
            ],
            [
                'module' => 'phone',
                'value' => $request->phone
            ],
            [
                'module' => 'provinces',
                'value' => $request->provinces
            ],
            [
                'module' => 'districts',
                'value' => $request->districts
            ],
            [
                'module' => 'address',
                'value' => $request->address
            ],

        ];

        for($i = 0;$i < count($order_detail); $i++){
            OrderDetail::create([
                'module' => $order_detail[$i]['module'],
                'order_id' => $order->id,
                'value' => $order_detail[$i]['value'],
            ]);
        }

        foreach($cart as $item){

            OrderDetail::create([
                'module' => 'product',
                'order_id' => $order->id,
                'item_id' => $item['id'] ,
                'quantity' => $item['qty'],
                'value' =>json_encode($item['options'],JSON_UNESCAPED_UNICODE) ,
            ]);
        }


        return response()->json([
            'message' => 'Đặt hàng thành công.',
            'status' => 1,
        ], 200);


    }

    public function getOrder(){
        $user = Auth::guard('api')->user();
        $data = Order::where('author_id',$user->id)->where('module','order')->get();
        return response()->json([
            'message' => 'Thành công!',
            'status' => 1,
            'data' => $data,
        ], 200);

    }

}
