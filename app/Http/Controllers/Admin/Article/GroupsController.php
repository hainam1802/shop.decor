<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Item;
use App\Models\Module;
use Yajra\Datatables\Datatables;
use Log;
use App\Models\Activity;
use Illuminate\Support\Str;
use App\Library\Files;
use Illuminate\Support\Facades\Auth;
use Html;
use Session;
use Validator;

class GroupsController extends Controller
{

    public function __construct(Request $request)
	{
        $this->module =$request->segments()[2];
        // dd($this->module);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        $module = $this->module;
        $name_module = Module::where('slug',$module)->first();

        $data= Group::orderBy('id','asc')->where('module',$this->module)->get();
		$datatable=$this->getHTMLCategory($data);



        $dataCategory = Group::orderBy('id','asc')->where('module',$this->module)->get();
        // dd($datatable);

		//SET BACK URL
		Session::put('BackUrl', count ($request->query())>0 ? $request->fullUrlWithQuery($request->query()):$request->url());
		return view('admin.groups.index',compact('datatable','dataCategory','module','name_module','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $module = $this->module;
        $name_module = Module::where('slug',$module)->first();
        $groups = Group::where('module',$this->module)->get();
        Activity::addLog('Truy cập bảng thêm danh mục cho: '.$this->module);
        return view('admin.groups.create_edit',compact('groups','module','name_module'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:groups,title',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->first()]);
        }
        $input = $request->all();
            // dd($input);
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'Groups',null,100,100);
        }
        $input['slug'] = Str::slug($request->title);
        $input['module'] = $this->module;
        $input['author'] = Auth::user()->name;
        // dd($input);
        Group::create($input);
        Activity::addLog('Thêm danh mục: '.$input['title']);
        return response()->json(['success' => 'Thêm mới thành công']);
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
    public function edit(Request $request,$id)
    {

        $module = $this->module;
        $name_module = Module::where('slug',$module)->first();
        $id = $request->segments()[4];
        // dd($id);
        $groups = Group::all();
        $data = Group::find($id);
        Activity::addLog('Truy cập bảng chỉnh sửa danh mục: '.$data->title);
        return view('admin.groups.create_edit',compact('data','groups','module','name_module'));
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
        $module = $this->module;
        $id = $request->segments()[4];
        $this->validate($request,[
            'title'=>'unique:groups,title,'.$id,
        ],[
            'title.unique' => 'Tên danh mục đã tồn tại',
        ]);
        $data = Group::find($id);
        $input = $request->all();
        if($request->file('image')){
            if($data->image){
                Files::delete_image($data->image);
            }
            $input['image']=Files::upload_image($request->file('image'),'module',null,100,100);
        }
        $data->update($input);
        Activity::addLog('Chỉnh sửa danh mục: '.$input['title']);
        return redirect()->back()->with('success','Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = $request->segments()[3];
        $input=explode(',',$request->id);
        // dd($input);
        foreach($input as $in){
               $item[] = Item::where('parrent_id',$in)->get();
        }
       if(empty(json_encode($item))){
        $data = Group::find($id);
        Activity::addLog('Xóa danh mục: '.$data->title);
        Group::destroy($id);
        return redirect()->back()->with('success','Xóa thành công !');
       }else{
        return redirect()->back()->withErrors(['Không thể xóa']);
       }
        
        // if($data->image){
        //     // $path = 'public'.$data->image;
        //     Files::delete_image($data->image);
        // }
       
    }

    public function UpdateOrder(Request $request)
	{
		$source = e($request->get('source'));
		$destination = $request->get('destination');

		$item = Group::find($source);
		$item->parrent_id = isset($destination)?$destination:0;
		$item->save();

		$ordering = json_decode($request->get('order'));
		$rootOrdering = json_decode($request->get('rootOrder'));

		if ($ordering) {
			foreach ($ordering as $order => $item_id) {
				if ($itemToOrder = Group::find($item_id)) {
					$itemToOrder->order = $order;
					$itemToOrder->save();
				}
			}
		} else {
			foreach ($rootOrdering as $order => $item_id) {
				if ($itemToOrder = Group::find($item_id)) {
					$itemToOrder->order = $order;
					$itemToOrder->save();
				}
			}
		}

		return 'ok ';
	}

    function getHTMLCategory($menu)
	{
		return $this->buildMenu($menu);
	}

    function buildMenu($menu, $parrent_id = 0)
	{
        $result = null;
        // $data= Group::orderBy('id','asc')->where('module',$this->module)->get();
        // dd($menu);
		foreach ($menu as $item)
			if ($item->parrent_id == $parrent_id) {
				$result .= "<li class='dd-item nested-list-item' data-id='{$item->id}'>
              <div class='dd-handle nested-list-handle'>
                <span class='la la-arrows-alt'></span>
              </div>
              <div class='nested-list-content'>";
				if($parrent_id!=0){
					$result .="<label class=\"m-checkbox\">
											<input type=\"checkbox\" rel='{$item->id}' class='children_of_{$item->parrent_id}'>" .HTML::entities($item->title).
						"<span></span>
                                            </label>" ;
                }
				else{

					$result .="<label class=\"m-checkbox\">
											<input type=\"checkbox\" rel='{$item->id}' >" .HTML::entities($item->title).
						"<span></span>
											</label>" ;
				}
				$result .= "<div class='btnControll'>";
                // $result .= "<a href='" . url("admin/module-category/{$this->module}/edit/{$item->id}") . "' class='btn btn-xs btn-info m-btn edit_toggle' rel='{$item->id}' >Sửa</a>";
                $result .= '<a data-id="'.$item->id.'" href="'.url("admin/module-category/{$this->module}/edit/{$item->id}").'">';
                $result .= '<button id="edit_category" type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#m_modal_1_2" data-id="'.$item->id.'">';
                $result .= 'Sửa';
                $result .= '</button></a>';
				$result .= "<a href=\"#\" class=\"btn btn-xs btn-danger m-btn  delete_toggle \" rel=\"{$item->id}\">
									Xóa
								</a>
                </div>
              </div>" . $this->buildMenu($menu, $item->id) . "</li>";
            }
		return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
	}
}
