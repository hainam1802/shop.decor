<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use App\Models\Item;
use App\Models\Group;
use App\Models\Module;
use App\Library\Files;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Log;
use App\Models\Activity;
use App\Models\ColorItem;

class ItemsController extends Controller
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
        $date = Carbon::now();
        $groups = Group::all();

        if($request->ajax()) {
            $data = Item::orderBy('id','desc');
                if ($request->filled('title')) {
                    $data->where('title', 'LIKE', '%' . $request->get('title') . '%');
                }
                if ($request->filled('author')) {
                    $data->where('author', 'LIKE', '%' . $request->get('author') . '%');
                }
                if ($request->filled('description')) {
                    $data->where('description', 'LIKE', '%' . $request->get('description') . '%');
                }
                if ($request->filled('started_at')) {

                    $model->where('created_at', '>=', Carbon::createFromFormat('d/m/Y H:i:s', $request->get('started_at')));
                }
            $data->where('module',$this->module)->get();
        return Datatables::of($data)
        ->editColumn('image', function($data) {

            return Files::media($data->image);
        })
        ->editColumn('parrent_id', function($data) {
            if($data->parrent_id == 0){
                return "Không chọn";
            }else{
                return $data->category->title;
            }
        })
        ->editColumn('created_at', function($data) {
            return date('d/m/Y', strtotime($data->created_at));
        })
        ->addColumn('action', function ($data) {
           $html = '<a href="'. url('admin/module-item/'.$data->module.'/edit/'.$data->id) .'" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle"><i class="la la-edit"></i></a>';
           $html .= '<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle" data-toggle="modal" data-target="#exampleModal" data-action="'.url('admin/module-item/'.$data->module.'/'.$data->id).'"><i class="fas fa-trash-alt"></i></button>';
           return $html;
        })
        ->make(true);
        }
        Activity::addLog('Truy cập danh sách bài viết');
        return view('admin.items.index',compact('module','groups','date','name_module'));
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
        // dd(1);
        $color = ColorItem::all();
        $groups = Group::where('module',$this->module)->get();
        Activity::addLog('Truy cập bảng thêm item: '.$this->module);
        return view('admin.items.create_edit',compact('groups','module','name_module','color'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module = $this->module;
        $name_module = Module::where('slug',$module)->first();
        $witdh_image = $name_module->width_image;
        $height_image = $name_module->height_image;
        $width_image_extension = $name_module->width_image_extension;
        $height_image_extension = $name_module->height_image_extension;
        // dd($witdh_image,$height_image,$width_image_extension,$height_image_extension);

        $input = $request->except('changeTitle');
        // dd($input);
        $key = $request->changeTitle;
        if($request->file('image')){
            $input['image']=Files::upload_image($request->file('image'),'article', Str::slug($request->title),$witdh_image,$height_image);
        }
        if($request->file('image_extension')){
            foreach ($request->file('image_extension') as $image_extension){
                $name_image[] = Files::upload_image_extension($image_extension,'ImageExtension',null,$width_image_extension,$height_image_extension);
            }
            $input['image_extension'] = str_replace('\\','',json_encode($name_image));
        }
        if($request->size){
            $input['size'] = (str_replace('\\','',json_encode($request->size)));
        }
        if($request->color){
            $input['color'] = (str_replace('\\','',json_encode($request->color,JSON_UNESCAPED_UNICODE)));
        }
        if($request->price_old && $request->sale){
            $input['price'] = ($request->price_old) * ((100 - $request->sale) / 100);
        }
        $input['slug'] = Str::slug($request->title);
        if($key == "on"){
            $input['slug'] = $request->slug;
        }
        $input['author'] = Auth::user()->name;
        $input['module'] = $this->module;
        // dd($input);
        Item::create($input);
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
    public function edit(Request $request,$id)
    {
        $module = $this->module;
        $name_module = Module::where('slug',$module)->first();
        $id = $request->segments()[4];
        // dd($id);
        $data = Item::find($id);
        $groups = Group::where('module',$module)->get();
        $color = ColorItem::all();
        Activity::addLog('Truy cập bảng chỉnh sửa: '.$data->title);
        return view('admin.items.create_edit',compact('groups','data','name_module','module','color'));
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
        $name_module = Module::where('slug',$module)->first();
        $witdh_image = $name_module->width_image;
        $height_image = $name_module->height_image;
        $width_image_extension = $name_module->width_image_extension;
        $height_image_extension = $name_module->height_image_extension;
        $id = $request->segments()[4];
        // dd($id);
        $data = Item::find($id);
        $key = $request->changeTitle;
        $input = $request->except('changeTitle');
        if($request->file('image')){
            if($data->image){
                Files::delete_image($data->image);
            }
            $input['image']=Files::upload_image($request->file('image'),'article',Str::slug($request->title),$witdh_image,$height_image);
        }
        if($request->file('image_extension')){
            $image_extension = json_decode($data->image_extension);
            foreach($image_extension as $item){
                Files::delete_image($item);
            }
            foreach ($request->file('image_extension') as $image_extension){
                $name_image[] = Files::upload_image_extension($image_extension,'ImageExtension',null,$width_image_extension,$height_image_extension);
            }
            $input['image_extension'] = str_replace('\\','',json_encode($name_image));
        }
        if($request->size){
            $input['size'] = (str_replace('\\','',json_encode($request->size)));
        }
        if($request->color){
            $input['color'] = (str_replace('\\','',json_encode($request->color,JSON_UNESCAPED_UNICODE)));
        }
        if($request->price_old && $request->sale){
            $input['price'] = ($request->price_old) * ((100 - $request->sale) / 100);
        }
        $input['slug'] = Str::slug($request->title);
        $input['author'] = Auth::user()->name;
        if($key == "on"){
            $input['slug'] = $request->slug;
        }

        $data->update($input);
        Activity::addLog('Chỉnh sửa: '.$data->title);
        return redirect()->back()->with('success','Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $id = $request->segments()[3];
        $data = Item::find($id);
        // dd($id);
        if($data->image){
            Files::delete_image($data->image);
        }
        if($data->image_extension){
            $image_extension = json_decode($data->image_extension);
            foreach($image_extension as $item){
                Files::delete_image($item);
            }
        }
        Activity::addLog('Xóa bài viết: '.$data->title);
        Item::destroy($id);
        return redirect()->back()->with('success','Xóa thành công !');
    }
}
