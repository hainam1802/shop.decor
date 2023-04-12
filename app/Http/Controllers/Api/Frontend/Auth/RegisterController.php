<?php

namespace App\Http\Controllers\Api\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|min:4|max:30|unique:users,username|regex:/^([A-Za-z0-9_.])+$/i',
                'email' => 'required|unique:users,email|string|email|max:255',
                'phone' =>'required|unique:users,phone|digits_between:5,11',
                'password' => 'required|min:6|max:32|string|min:6|confirmed|different:username',

            ],[
                'username.min'      => 'Tên tài khoản ít nhất 4 ký tự.',
                'username.max'      => 'Tên tài khoản không quá 30 ký tự.',
                'username.unique'   => 'Tên tài khoản đã được sử dụng.',
                'username.required' => 'Vui lòng nhập tài khoản',
                'username.regex'    => 'Tên tài khoản không ký tự đặc biệt.',
                'email.required' => 'Vui lòng nhập email',
                'email.email'    => 'Địa chỉ email không đúng định dạng.',
                'email.unique'   => 'Địa chỉ email đã được sử dụng.',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min'      => 'Mật khẩu phải ít nhất 6 ký tự.',
                'password.max'      => 'Mật khẩu không vượt quá 32 ký tự.',
                'password.confirmed' => 'Mật khẩu xác nhận không đúng',
                'password.different' => 'Mật khẩu không được trùng với tài khoản',
                'phone.required'    => 'Vui lòng nhập số điện thoại',
                'phone.unique'      => 'Số điện thoại đã được đăng ký',
                'phone.digits'      => 'Số điện thoại không đúng định đạng',
            ]);

            if($validator->fails()){
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'status' => 0
                ],422);
            }
            $username = $request->username;
            // kiểm tra username
            $checkUsername = User::where('username',$username)->first();
            if($checkUsername){
                return response()->json([
                    'message' => 'Tên tài khoản đã được đăng kí',
                    'status' => 0,
                ], 200);
            }
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'account_type' => 2,
                'status' => 1,
            ]);
            ActivityLog::add($request,"Đăng nhập frontend thành công");
            $token = JWTAuth::fromUser($user);
            $data = User::where('id',$user->id)->where('status',1)->select('id','username','email','fullname','balance')->first();
            return response()->json([
                'message' => 'Đăng kí tài khoản thành công.',
                'status' => 1,
                'token' => $token,
                'user' => $data,
                'exp_token' => 60 * 60,
            ], 200);

        }catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response()->json([
                    'message' => 'Tên tài khoản đã được đăng kí',
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
