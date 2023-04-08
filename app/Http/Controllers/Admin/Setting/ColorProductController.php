<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Files;
use App\Models\ColorItem;
use Illuminate\Support\Facades\Auth;
use Log;
use App\Models\Activity;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;


class ColorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Activity::addLog('Truy cập bảng màu sắc sản phẩm');
        $data = ColorItem::all();
        return view('admin.color_item.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Activity::addLog('Truy cập bảng thêm màu sắc sản phẩm');
        return view('admin.color_item.create_edit');
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
            'title'=>'unique:color_item,title',
        ],[
            'title.unique' => 'Màu đã tồn tại',
        ]);
        $input = $request->all();
        ColorItem::create($input);
        Activity::addLog('Thêm mới: '.$input['title']);
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
        $data = ColorItem::find($id);
        Activity::addLog('Truy cập bảng chỉnh sửa màu: '.$data->title);
        return view('admin.color_item.create_edit',compact('data'));
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
        $data = ColorItem::find($id);
        $this->validate($request,[
            'title'=>'unique:color_item,title,'.$id,
        ],[
            'title.unique' => 'Màu đã tồn tại',
        ]);
        $input = $request->all();
        $data->update($input);
        Activity::addLog('Chỉnh sửa màu: '.$input['title']);
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
        //
    }
}
