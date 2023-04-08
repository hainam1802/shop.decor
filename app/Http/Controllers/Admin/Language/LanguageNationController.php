<?php

namespace App\Http\Controllers\Admin\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LanguageNation;
use Log;
use App\Models\Activity;
use App\Library\Files;
use Yajra\Datatables\Datatables;

class LanguageNationController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:language-nation-list');
        $this->middleware('permission:language-nation-add', ['only' => ['create', 'store']]);
        $this->middleware('permission:language-nation-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:language-nation-delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = LanguageNation::orderBy('id','desc')->get();
        return Datatables::of($data)
        ->editColumn('image', function($data) {

            return Files::media($data->image);
        })
        ->addColumn('action', function ($data) {
           $html = '<a href="'. route('language-nation.edit', $data->id) .'" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle"><i class="la la-edit"></i></a>';
           $html .= '<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle" data-toggle="modal" data-target="#exampleModal" data-action="'.route('language-nation.destroy', $data->id).'"><i class="fas fa-trash-alt"></i></button>';
           return $html;
        })
        ->make(true);

        }

        Activity::addLog('Truy cập bảng danh sách ngôn ngữ hệ thống');
        return view('admin.languageNation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Activity::addLog('Truy cập bảng thêm mới ngôn ngữ hệ thống');
        return view('admin.languageNation.create_edit');
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
            'title'=>'unique:language_nation,title',
            'locale'=>'unique:language_nation,locale'
        ],[
            'title.unique'=>'Ngôn ngữ đã tồn tại',
            'locale.unique'=>'Locale đã tồn tại'
        ]);
        $input = $request->all();
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'language',null,70,70);
        }
        LanguageNation::create($input);
        Activity::addLog('Thêm mới ngôn ngữ hệ thống: '.$input['title']);
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
        $data = LanguageNation::find($id);
        Activity::addLog('Truy cập bảng chỉnh sửa ngôn ngữ: '.$data->title);
        return view('admin.languageNation.create_edit',compact('data'));
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
            'title'=>'unique:language_nation,title,'.$id,
            'locale'=>'unique:language_nation,locale,'.$id
        ],[
            'title.unique'=>'Ngôn ngữ đã tồn tại',
            'locale.unique'=>'Locale đã tồn tại'
        ]);
        $data = LanguageNation::find($id);
        $input = $request->all();
        if($request->file('image')){
            if($data->image){
                Files::delete_image($data->image);
            }
            $input['image']=Files::upload_image($request->file('image'),'language',null,70,70);
        }
        $data->update($input);
        Activity::addLog('Chỉnh sửa thành công ngôn ngữ: '.$input['title']);
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
        $data = LanguageNation::find($id);
        $locale = $data->locale;
        // dd($locale);
        if($locale == "vi"){
            return redirect()->back()->withErrors(['Bạn không thể xóa ngôn ngữ mặc định']);
        }else{
            if($data->image){
                Files::delete_image($data->image);
            }
            LanguageMapping::where('language_nation_id',$id)->delete();
            Activity::addLog('Xóa ngôn ngữ: '.$data->title);
            LanguageNation::destroy($id);
            return redirect()->route('language.index')->with('success','Xóa thành công');
        }
    }
}
