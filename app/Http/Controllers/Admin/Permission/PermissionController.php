<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use Log;
use App\Models\Activity;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:permission-list');
        $this->middleware('permission:permission-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Permission::all();
        Activity::addLog('Truy cập danh sách quyền trong hệ thống');
        return view('admin.permission.index');
    }
    public function anyData(Request $request)
    {
        // return Datatables::of(Permission::query())->make(true);
            if($request->ajax()) {
                $data = Permission::orderBy('id','desc');
                    if ($request->filled('title')) {
                        $data->where('title', 'LIKE', '%' . $request->get('title') . '%');
                    }
                $data->get();
            return Datatables::of($data)
            ->addColumn('action', function ($data) {
               $html = '<a href="'. route('permission.edit', $data->id) .'" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle"><i class="la la-edit"></i></a>';
               $html .= '<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle" data-toggle="modal" data-target="#exampleModal" data-action="'.route('permission.destroy', $data->id).'"><i class="fas fa-trash-alt"></i></button>';
               return $html;

            })
            ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Permission::all();
        // dd($data);
        Activity::addLog('Truy cập bảng thêm mới quyền');
        return view('admin.permission.create_edit',compact('groups'));
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
            'title'=>'unique:permissions,title',
            'name'=>'unique:permissions,name'
        ],[
            'title.unique' => 'Chức năng đã tồn tại',
            'name.unique' =>'Keyword đã tồn tại'
        ]);
        $input = $request->all();
        Permission::create($input);
        Activity::addLog('Thêm mới quyền: '.$input['title']);
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
        $groups = Permission::all();
        $data = Permission::find($id);
        Activity::addLog('Truy cập bảng chỉnh sửa quyền: '.$data->title);
        return view('admin.permission.create_edit',compact('data','groups'));
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
        $this->validate($request,[
            'title'=>'unique:permissions,title,'.$id,
            'name'=>'unique:permissions,name,'.$id
        ],[
            'title.unique' => 'Chức năng đã tồn tại',
            'name.unique' =>'Keyword đã tồn tại'
        ]);
        $data = Permission::find($id);
        $input = $request->all();
        $data->update($input);
        Activity::addLog('Chỉnh sửa quyền: '.$input['title']);
        return redirect()->back()->with('success','Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Permission::find($id);
        Activity::addLog('Xóa quyền: '.$data->title);
        Permission::destroy($id);
        return redirect()->back()->with('success','Xóa thành công !');
    }
}
