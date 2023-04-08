<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Log;
use App\Models\Activity;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:user-list');
        $this->middleware('permission:user-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete');
        $this->middleware('permission:user-permission', ['only' => ['getSetPermission', 'postSetPermission']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Activity::addLog('Truy cập danh sách thành viên');
        return view('admin.user.index');
    }

    public function anyData(Request $request)
    {
        // return Datatables::of(Permission::query())->make(true);
            if($request->ajax()) {
                $data = User::orderBy('id','desc');
                    if ($request->filled('name')) {
                        $data->where('name', 'LIKE', '%' . $request->get('name') . '%');
                    }
                    if ($request->filled('phone')) {
                        $data->where('phone', 'LIKE', '%' . $request->get('phone') . '%');
                    }
                    if ($request->filled('address')) {
                        $data->where('address', 'LIKE', '%' . $request->get('address') . '%');
                    }
                $data->get();
            return Datatables::of($data)
            ->addColumn('action', function ($data) {
               $html = '<a title="Chỉnh sửa thông tin thành viên" href="'. route('user.edit', $data->id) .'" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle"><i class="la la-edit"></i></a>';
               $html .= '<button title="Xóa" type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle" data-toggle="modal" data-target="#exampleModal" data-action="'.route('user.destroy', $data->id).'"><i class="fas fa-trash-alt"></i></button>';
               $html .= '<a title="Gán quyền cho thành viên" href="'. route('user.set-permisson', $data->id) .'" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle"><i class="la la-sitemap"></i></a>';
               $html .= '<a title="Nhật kí hoạt động" href="'. url('admin/log-user/'.$data->id) .'" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle"><i class="flaticon-clock-1"></i></a>';
               return $html;

            })
            ->make(true);
        }
    }

    public function getSetPermission($id){
        $data = User::find($id);    
        $permission = Permission::all();
        $id_permisson = json_decode($data->permissions);
        // dd($id_permisson);
        Activity::addLog('Truy cập bảng cấp quyền cho thành viên: '.$data->name);
        return view('admin.user.set_permission',compact('data','permission','id_permisson'));
    }

    public function postSetPermission(Request $request,$id){
        $data = User::find($id);
        $permission = $request->permission;
        // dd($permission);
        $data->syncPermissions($request->permission);
        Activity::addLog('Cấp quyền cho thành viên: '.$data->name);
        return redirect()->back()->with('success','Gán quyền thành công');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Activity::addLog('Truy cập bảng thêm mới thành viên');
        return view('admin.user.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=>'unique:users,email',
            're_password'=>'same:password',
        ],[
            'email.unique' =>'Email đã tồn tại',
            're_password.same' => 'Mật khẩu nhập lại không đúng'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);
        Activity::addLog('Thêm mới thành viên: '.$input['name']);
        return redirect()->back()->with('success','Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        Activity::addLog('Truy cập bảng chỉnh sửa thành viên: '.$data->name);
        return view('admin.user.create_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = User::FindOrFail($id);
        $this->validate($request,[
            're_password'=>'same:password',
        ],[
            're_password.same' => 'Mật khẩu nhập lại không đúng'

        ]);
        $key = $request->changePassword;
        if($key == "on"){
            $input = $request->all();
            $input['password'] = Hash::make($request->password);
        }else{
            $input = $request->except('password');
        }
//        dd($input);
        $data->update($input);
        Activity::addLog('Chỉnh sửa thông tin thành viên: '.$input['name']);
        return redirect()->back()->with('success','Chỉnh sửa thành công !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        if($data->image){
            // $path = 'public'.$data->image;
            Files::delete_image($data->image);
        }
        Activity::addLog('Xóa thành viên: '.$data->name);
        User::destroy($id);
        return redirect()->route('user.index')->with('success','Xóa thành công');
    }
}
