<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\User;
use Auth;
use App\Library\Files;
use Illuminate\Support\Facades\Hash;
use Log;
use App\Models\Activity;


class ProfileController extends Controller
{
    public function getProfile(){
        $id = Auth::user()->id;
        $data = User::find($id);
        Activity::addLog('Truy cập trang cá nhân');
        return view('admin.user.profile',compact('data'));
    }

    public function getPassword(){
        Activity::addLog('Truy cập trang cá nhân');
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('admin.user.password',compact('data'));
    }

    public function postProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::FindOrFail($id);
        $this->validate($request,[
            're_password'=>'same:password',
        ],[
            're_password.same' => 'Mật khẩu nhập lại không đúng'
        ]);
        $input = $request->all();

        if($request->file('image')){
            if($data->image){
                Files::delete_image($data->image);
            }
            $input['image']=Files::upload_image($request->file('image'),'profile',null,100,100);
        }
        if($request->password){
            $input['password'] = Hash::make($request->password);
        }
    //    dd($input);
        $data->update($input);
        Activity::addLog('Chỉnh sửa thông tin cá nhân');
        return redirect()->back()->with('success','Chỉnh sửa thành công !');
    }
}
