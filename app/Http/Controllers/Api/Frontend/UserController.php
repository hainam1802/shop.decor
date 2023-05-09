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

class UserController extends Controller
{
    public function getInfo()
    {
        $user = Auth::guard('api')->user();
        $order = Order::where('author_id',$user->id)->where('module','order')->get();
        $comment = Comment::with('item')->with('user')->where('author_id',$user->id)->get();
        $favorite = Favourite::with('item')->with('user')->where('user_id',$user->id)->where('status','1')->get();
        return response()->json([
            'message' => 'Thành công!',
            'status' => 1,
            'data' => $user,
            'order' => $order,
            'comment' => $comment,
            'favorite' => $favorite,
        ], 200);

    }
    public function postProfile(Request $request)
    {
        $user = Auth::guard('api')->user();
        $validator = Validator::make($request->all(), [
            'username' => 'required',

        ],[
            'username.required' => "Vui lòng nhập họ tên",
            'email.required' => "Email không được để trống",
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => 0
            ],200);
        }else{
            $input = [
                'address' => $request->address,
                'username' => $request->username,
                'phone' => $request->phone,
                'birtday' => $request->birtday,
            ];
            $user->update($input);
        }
        if ($request->input("password")){
            $validator2 = Validator::make($request->all(), [
                'password' => 'min:6|max:32|string|min:6|confirmed|different:username',
            ],[
                'password.min'      => 'Mật khẩu phải ít nhất 6 ký tự.',
                'password.max'      => 'Mật khẩu không vượt quá 32 ký tự.',
                'password.different' => 'Mật khẩu không được trùng với tài khoản',
            ]);
            if ($validator2->fails()) {
                return response()->json([
                    'message' => $validator2->errors()->first(),
                    'status' => 0
                ],200);

            }else{
                $inputPassword = [
                    'password' => Hash::make($request->password),
                ];
                $user->update($inputPassword);
            }
        }


        if ($request->filled('provinces')){
            $user->setMeta('provinces', $request->provinces);
        }
        return response()->json([
            'message' => 'Cập nhật tài khoản thành công!',
            'status' => 1
        ],200);
    }
}
