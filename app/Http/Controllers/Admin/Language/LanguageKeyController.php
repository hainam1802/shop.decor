<?php

namespace App\Http\Controllers\Admin\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;
use App\Models\Activity;
use App\Models\LanguageKey;
use Yajra\Datatables\Datatables;

class LanguageKeyController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:language-key-list');
        $this->middleware('permission:language-key-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:language-key-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:language-key-delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = LanguageKey::all();
        return Datatables::of($data)
        ->addColumn('action', function ($data) {
           $html = '<a href="'. route('language-key.edit', $data->id) .'" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle"><i class="la la-edit"></i></a>';
           $html .= '<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle" data-toggle="modal" data-target="#exampleModal" data-action="'.route('language-key.destroy', $data->id).'"><i class="fas fa-trash-alt"></i></button>';
           return $html;
        })
        ->make(true);

        }
        return view('admin.languageKey.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Activity::addLog('Truy cập bảng thêm từ khóa ngôn ngữ');
        return view('admin.languageKey.create_edit');

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
            'title'=>'unique:language_key,title',
        ],[
            'title.unique'=>'Từ khóa đã tồn tại',
        ]);
        $input = $request->all();
        // dd($input);
        LanguageKey::create($input);
        Activity::addLog('Thêm từ khóa : '.$input['title'].' vào hệ thống');
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
        $data = LanguageKey::find($id);
        Activity::addLog('Truy cập trang chỉnh sửa từ khóa : '.$data->title);
        return view('admin.languageKey.create_edit',compact('data'));
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
            'title'=>'unique:language_key,title,'.$id,
        ],[
            'title.unique'=>'Từ khóa đã tồn tại',
        ]);
        $data = LanguageKey::find($id);
        $input = $request->all();
        $data->update($input);
        Activity::addLog('Chỉnh sửa từ khóa: '.$input['title']);
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
        $data = LanguageKey::find($id);
        Activity::addLog('Xóa từ khóa: '.$data->title);
        LanguageKey::destroy($id);
        return redirect()->route('language-key.index')->with('success','Xóa thành công');
    }
}
