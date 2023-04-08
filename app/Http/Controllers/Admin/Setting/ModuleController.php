<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Log;
use App\Models\Item;
use App\Models\Group;
use App\Models\Activity;
use Yajra\Datatables\Datatables;
use App\Library\Files;
use Artisan;    

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Module::orderBy('id','desc');
            $data->get();
        return Datatables::of($data)
        ->addColumn('action', function ($data) {
           $html = '<a href="'. route('setting-module.edit', $data->id) .'" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle"><i class="la la-edit"></i></a>';
           $html .= '<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle" data-toggle="modal" data-target="#exampleModal" data-action="'.route('setting-module.destroy', $data->id).'"><i class="fas fa-trash-alt"></i></button>';
           return $html;

        })
        ->editColumn('created_at', function($data) {
            return date('d/m/Y H:i:s', strtotime($data->created_at));
        })
        ->make(true);
        }

        Activity::addLog('Truy cập bảng module hệ thống');
        return view('admin.module.index');
    }

    public function clearCache(){
        Artisan::call('cache:clear');
        return redirect()->back()->with('success','Xóa thành công');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Activity::addLog('Truy cập bảng thêm mới module hệ thống');
        return view('admin.module.create_edit');
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
            'title'=>'unique:module,title',
        ],[
            'title.unique' => 'Module đã tồn tại',
        ]);
        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        $input['author'] = Auth::user()->name;
        // dd($input);
        Module::create($input);
        Activity::addLog('Thêm mới module: '.$input['title']);
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
        $data = Module::find($id);
        // dd($data);
        Activity::addLog('Truy cập bảng chỉnh sửa module: '.$data->title);
        return view('admin.module.create_edit',compact('data'));
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
            'title'=>'unique:module,title,'.$id,
        ],[
            'title.unique' => 'Module đã tồn tại',
        ]);
        $data = Module::find($id);
        $slug_item = $data->slug;
        $count_item = Item::where('module',$slug_item)->count();
        $count_category = Group::where('module',$slug_item)->count();
        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        $input['author'] = Auth::user()->name;
        if($count_item > 0){
            Item::where('module',$slug_item)->update(['module'=>$input['slug']]);
        }
        if($count_category > 0){
            Group::where('module',$slug_item)->update(['module'=>$input['slug']]);
        }
        // die();
        $data->update($input);
        Activity::addLog('Chỉnh sửa module: '.$data->title);
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
        $data = Module::find($id);
        $module = $data->slug;
        $item = Item::where('module',$module)->get();
        foreach($item as $items){
            $id_item[] = $items->id;
            $img[] = $items->image;
            $img_ext[] = $items->image_extension;
        }
        if(isset($id_item)){
            if($img){
                foreach($img as $img_it){
                    Files::delete_image($img_it);
                }
            }
            if($img_ext){
                foreach($img_ext as $img_ext_it){
                    $img_name[] = json_decode($img_ext_it);
                }
                    $count = count($img_name);
                    $arr = [];
                    for($i = 0; $i<$count; $i++){
                        if(is_array($img_name[$i])){
                            $arr = array_merge($arr,$img_name[$i]);
                        }
                    }
                    // dd($arr);
                    foreach($arr as $item_arr){
                        Files::delete_image($item_arr);
                    }
                }
            // die();
            $item->each->delete();
        }
        $category = Group::where('module',$module)->get();
        foreach($category as $cate){
            $id_cat[] = $cate->id;
            $img_cat[] = $cate->image;
        }

        if(isset($id_cat)){
            if($img_cat){
                foreach($img_cat as $img_it){
                    Files::delete_image($img_it);
                }
            }
            $category->each->delete();
        }
        Module::destroy($id);
        return redirect()->back()->with('success','Xóa thành công !');
    }
}
