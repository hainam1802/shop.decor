<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Library\HelpersDevice;
use App\Models\Group;
use App\Models\Item;
use ArrayObject;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getCategory(Request $request,$id)
    {
        $data = Group::where('module','=','product-category')
            ->where(function ($query) use ($id){
                $query->where('slug','=',$id);
                $query->orWhere('url','=',$id);
            })
            ->where('status',1)
            ->first();
        $currentCategory=$data;
        $breadcumb=null;
        $alltempParrentId = null;
        if($currentCategory){
            $breadcumb =new ArrayObject();
            $category=$currentCategory;
            $tempParrent=$category->parent_id;
            while(true){
                if($category->parent_id !=0){
                    $category = Group::where('module', '=','product-category')
                        ->where('status', '=', 1)
                        ->where('id', '=',$tempParrent)
                        ->first();
                    $alltempParrentId = Group::where('module', '=','product-category')
                        ->where('status', '=', 1)
                        ->where('parent_id', '=',$tempParrent)
                        ->get();
                    $tempParrent=$category->parent_id;
                    $breadcumb->append($category);

                }
                else{
                    break;
                }
            }
        }
        if(!$alltempParrentId){
            $alltempParrentId = Group::where('module', '=','product-category')
                ->where('status', '=', 1)
                ->where('parent_id', '=',$data->id)
                ->get();
        }
        $allCategory = Group::where('status', '=', 1)
            ->where('module', '=', 'product-category')
            ->orderBy('order')->get();

        $items_prd = Item::with(array('groups' => function($query){
            $query->where('module','product-category');
        }));
        $items_prd = $items_prd->where('module','product')
            ->whereHas('groups', function ($query) use ($data) {
                $query->where('group_id',$data->id);
            })
            ->where('status', '=', 1);
        if($request->filled('price')){
            switch ($request->get('price')) {
                case "0-1000000":
                    $items_prd = $items_prd->where('price','<=',1000000);
                    break;
                case "1000000-3000000":
                    $items_prd = $items_prd->where('price','>=',1000000)->where('price','<=',3000000);
                    break;
                case "3000000-5000000":
                    $items_prd = $items_prd->where('price','>=',3000000)->where('price','<=',5000000);
                    break;
                case "5000000-10000000":
                    $items_prd = $items_prd->where('price','>=',5000000)->where('price','<=',10000000);
                    break;
                case "10000000-12000000":
                    $items_prd = $items_prd->where('price','>=',10000000)->where('price','<=',12000000);
                    break;
                case "12000000-15000000":
                    $items_prd = $items_prd->where('price','>=',12000000)->where('price','<=',15000000);
                    break;
                case "15000000-20000000":
                    $items_prd = $items_prd->where('price','>=',15000000)->where('price','<=',20000000);
                    break;
                case "20000000-50000000":
                    $items_prd = $items_prd->where('price','>=',20000000)->where('price','<=',50000000);
                    break;
                default :
            }
        }

        if($request->filled('sort')){
            switch ($request->get('price')) {
                case "1":
                    $items_prd = $items_prd->orderBy('created_at','desc');
                    break;
                case "2":
                    $items_prd = $items_prd->orderBy('price','asc');
                    break;
                case "3":
                    $items_prd = $items_prd->orderBy('price','desc');
                    break;
                case "4":
                    $items_prd = $items_prd->orderBy('created_at','desc');
                    break;
                case "5":
                    $items_prd = $items_prd->orderBy('totalviews','desc');
                    break;
                case "6":
                    $items_prd = $items_prd->orderBy('totalviews','desc');
                    break;
                case "7":
                    $items_prd = $items_prd->orderBy('totalviews','desc');
                    break;
                case "8":
                    $items_prd = $items_prd->orderBy('totalviews','desc');
                    break;
                default :
            }
        }
        $items_prd = $items_prd->orderBy('id','desc')
            ->orderBy('order')
            ->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion')
            ->paginate(10);

        return response()->json([
            'message' => 'Load sản phẩm thành công.',
            'status' => 1,
            'items_prd' => $items_prd,
            'currentCategory' => $currentCategory,
            'alltempParrentId' => $alltempParrentId,
            'data' => $data,
        ], 200);
        if ($request->ajax()) {
            if($items_prd && count($items_prd) > 0){
                if(HelpersDevice::isMobile()) {
                    return view('frontend.pages.mobile.func.load_item_prd')
                        ->with('data',$items_prd);
                }
                else{
                    return view('frontend.pages.desktop.func.load_item_prd')
                        ->with('data',$items_prd);
                }
            }
            else{
                $res = [
                    'status' => 0,
                    'mess' => 'errror'
                ];
                return response()->json($res);
            }
        }
        else{
            $data->totalviews = $data->totalviews + 1;
            $data->save();
            if(HelpersDevice::isMobile()) {
                return view('frontend.pages.mobile.category')
                    ->with('breadcumb',$breadcumb)
                    ->with('currentCategory',$currentCategory)
                    ->with('items_prd',$items_prd)
                    ->with('alltempParrentId',$alltempParrentId)
                    ->with('data',$data);
            }
            else{
                return view('frontend.pages.desktop.category')
                    ->with('breadcumb',$breadcumb)
                    ->with('items_prd',$items_prd)
                    ->with('alltempParrentId',$alltempParrentId)
                    ->with('data',$data);
            }
        }
    }
}
