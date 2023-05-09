<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Library\HelpersDevice;
use App\Models\Comment;
use App\Models\Favourite;
use App\Models\Group;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use ArrayObject;
use Illuminate\Http\Request;
use App\Models\UserAction;
use Auth;
use App\Models\Group_Item;
use App\Models\SubItem;
use App\Models\Installment;
use App\Models\InstallmentDetail;
use function Doctrine\Common\Cache\Psr6\get;
use Illuminate\Support\Facades\Cookie;
use Validator;

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
//        if($request->filled('id')){
//            $items_prd = $items_prd->where('id','=',$request->get('id'));
//        }
//        if($request->filled('title')){
//            $items_prd = $items_prd->where('title', 'like', '%'.$request->get('title').'%');
//        }
//        if($request->filled('price')){
//            switch ($request->get('price')) {
//                case "0-500000":
//                    $items_prd = $items_prd->where('price','<=',500000);
//                    break;
//                case "500000-1000000":
//                    $items_prd = $items_prd->where('price','>=',500000)->where('price','<=',1000000);
//                    break;
//                case "1000000-1500000":
//                    $items_prd = $items_prd->where('price','>=',3000000)->where('price','<=',5000000);
//                    break;
//                case "1500000-2000000":
//                    $items_prd = $items_prd->where('price','>=',1500000)->where('price','<=',2000000);
//                    break;
//                case "2000000-2500000":
//                    $items_prd = $items_prd->where('price','>=',2000000)->where('price','<=',2500000);
//                    break;
//                case "2500000-3000000":
//                    $items_prd = $items_prd->where('price','>=',2500000)->where('price','<=',3000000);
//                    break;
//                default :
//            }
//        }


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
    }
    public function getSearch(Request $request)
    {
        $data = Group::where('module','=','product-category')
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
    }
    public function getItem(Request $request, $category, $slug){
        $data = Item::with('groups')->where('module','=','product')
            ->where(function ($query) use ($slug){
                $query->where('slug','=',$slug);
                $query->orWhere('url','=',$slug);
            })
            ->where('status',1)
            ->first();

            //        $category_data = $data->groups->pluck('slug')->toArray();
            //        if(!in_array($category, $category_data))
            //        {
            //            return response()->json([
            //                'message' => 'Dữ liệu không hợp lệ .',
            //                'status' => 0,
            //            ], 500);
            //
            //
        $items_prd = null;
        $breadcumb = null;
        $currentCategory=Group::whereHas('items', function ($query) use ($data) {
            $query->where('item_id',$data->id);
        })
            ->where('slug',$category)
            ->where('status', '=', 1)
            ->where('module', '=', 'product-category')
            ->first();
        // Kiểm tra danh mục sản phẩm có tồn tại
        if($currentCategory){
            $breadcumb =new ArrayObject();
            $breadcumb->append($currentCategory);
            $category=$currentCategory;
            $tempParrent=$category->parent_id;
            while(true){
                if($category->parent_id !=0){
                    $category = Group::where('module', '=', 'product-category')
                        ->where('status', '=', 1)
                        ->where('id', '=',$tempParrent)
                        ->first();
                    $tempParrent=$category->parent_id;
                    $breadcumb->append($category);
                }
                else{
                    break;
                }
            }
            $items_prd = Item::with(array('groups' => function($query){
                $query->where('module','product-category');
            }));
            $items_prd = $items_prd->where('module','product')
                ->whereHas('groups', function ($query) use ($currentCategory) {
                    $query->where('group_id',$currentCategory->id);
                })
                ->where('status', '=', 1)->inRandomOrder()->limit(5)->get();

        }else{
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ .',
                'status' => 0,
            ], 500);
        }
        $data->totalviews = $data->totalviews + 1;
        $data->save();
        // xử lí cookie sản phẩm đã xem
        $minutes = 14400;
        $cookieProductViewed = Cookie::get('product-viewed');
        if($cookieProductViewed==null){
            $cookie = Cookie::queue('product-viewed',$data->id, $minutes);
        }
        else{
            $cookieProductViewed = Cookie::get('product-viewed');
            $arrCookie=explode(',',$cookieProductViewed);
            $arrCookie=collect($arrCookie);
            if(count($arrCookie)>30){
                $arrCookie->shift();
            }
            if(!($arrCookie->contains($data->id))){
                $cookieProductViewed=$cookieProductViewed.",".$data->id;
            }

            Cookie::queue('product-viewed',$cookieProductViewed, $minutes);
        }

        // Bình luận
        $comment = Comment::where('item_id',$data->id)->where('module','comment')->where('status','1')->get();
        $id_attribute = [];
        $data_attribute = [];
        $attribute = $data->subitem;
        // Kiểm tra có tồn tại thuộc tính  không
        if(isset($attribute) && count($attribute) > 0){
            foreach($attribute as $item){
                $id_attribute[] = $item->attribute_id;
            }
            $obj_attribute = Item::where('module','=','product-attribute')->where('status',1)->whereIn('id',$id_attribute)->get();
            if(isset($obj_attribute) && count($obj_attribute) > 0){
                foreach($attribute as $item_at){
                    foreach($obj_attribute as $item_obj){
                        $content_at = [];
                        if($item_at->attribute_id == $item_obj->id){
                            if(isset($data_attribute[$item_at->attribute_id])){
                                $content_at = $data_attribute[$item_at->attribute_id]['content'];
                                $content_at[$item_at->id] = $item_at->content;
                            }
                            else{
                                $content_at[$item_at->id] = $item_at->content;
                            }
                            $data_attribute[$item_at->attribute_id] = [
                                'title' => $item_obj->title,
                                'content' => $content_at,
                                'type' => $item_obj->type,
                            ];
                        }
                    }
                }
            }
        }

        $items_blog = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }));
        $items_blog = $items_blog->where('module','article')
            ->where('status', '=', 1)->limit(3)->get();
        // Sản phẩm yêu thích
        //        $favourite = 0;
        //        if(Auth::guard('frontend')->check()){
        //            $activeFavourite = Favourite::where('user_id',Auth::guard('frontend')->user()->id)->where('item_id',$data->id)->first();
        //            if($activeFavourite){
        //                if($activeFavourite->status == 1){
        //                    $favourite = 1;
        //                }
        //            }
        //        }
        return response()->json([
            'message' => 'Thành công.',
            'data_attribute' => $data_attribute,
            'currentCategory' => $currentCategory,
            'data' => $data,
            'items_prd' => $items_prd,
            'items_blog' => $items_blog,
            'comment' => $comment,
        ], 200);
    }
}
