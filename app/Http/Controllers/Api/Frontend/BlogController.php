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
use App\Models\Provinces;
use App\Models\User;
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

class BlogController extends Controller
{

    public function getSearch(Request $request){
        if($request->news == ""){
            return response()->json([
                'status' => '0',
                'message' => 'Không có dữ liệu'
            ]);
        }
        $data = Item::where(function ($query) use ($request){
            $query->where('title', 'LIKE', '%' . $request->news . '%');
        })
            ->where('module','article')
            ->where('status',1)
            ->orderBy('id','desc')
            ->paginate(6);
        return response()->json([
            'message' => 'Thành công!',
            'status' => 1,
            'data' => $data,
        ]);
    }
    public function getIndex(Request $request){
        $allCategory = Group::where('status', '=', 1)
            ->where('module', '=', 'article-category')
            ->orderBy('order')->get();

        $items_prd = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }));
        $items_prd = $items_prd->where('module','article')
            ->where('status', '=', 1);
        $items_prd = $items_prd->orderBy('id','desc')
            ->orderBy('order')
            ->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion','created_at')
            ->paginate(8);
        return response()->json([
            'message' => 'Thành công!',
            'status' => 1,
            'data' => $items_prd,
        ]);
    }
    public function getCategory(Request $request,$id){
        $data = Group::where('module','=','article-category')
            ->where(function ($query) use ($id){
                $query->where('slug','=',$id);
                $query->orWhere('url','=',$id);
            })
            ->where('status',1)
            ->first();
        $data->totalviews = $data->totalviews + 1;
        $data->save();
        $currentCategory=$data;
        $breadcumb=null;
        $alltempParrentId = null;
        if($currentCategory){
            $breadcumb =new ArrayObject();
            $category=$currentCategory;
            $tempParrent=$category->parent_id;
            while(true){
                if($category->parent_id !=0){
                    $category = Group::where('module', '=','article-category')
                        ->where('status', '=', 1)
                        ->where('id', '=',$tempParrent)
                        ->first();
                    $alltempParrentId = Group::where('module', '=','article-category')
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
            $alltempParrentId = Group::where('module', '=','article-category')
                ->where('status', '=', 1)
                ->where('parent_id', '=',$data->id)
                ->get();
        }
        $allCategory = Group::where('status', '=', 1)
            ->where('module', '=', 'article-category')
            ->orderBy('order')->get();

        $items_prd = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }));
        $items_prd =$items_prd->whereHas('groups', function ($query) use ($data) {
            $query->where('group_id',$data->id);
        });
        $items_prd = $items_prd->where('module','article')
            ->where('status', '=', 1);

        $items_prd = $items_prd->orderBy('id','desc')
            ->orderBy('order')
            ->select('id','title','image','order','url','slug','price','price_old','price_input','percent_sale','status','url_type','target','totalviews','description','content','promotion','created_at')
            ->paginate(8);
        $data_new = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }))
            ->where('module','article')->where('status', '=', 1)
            ->inRandomOrder()
            ->orderBy('id','desc')
            ->limit(6)
            ->get();

        return response()->json([
            'message' => 'Load sản phẩm thành công.',
            'status' => 1,
            'items_prd' => $items_prd,
            'data_new' => $data_new,
            'currentCategory' => $currentCategory,
            'alltempParrentId' => $alltempParrentId,
        ], 200);
    }
    public function getItem(Request $request, $category,$slug){
        $data = Item::with('groups')->where('module','=','article')
            ->where(function ($query) use ($slug){
                $query->where('slug','=',$slug);
                $query->orWhere('url','=',$slug);
            })
            ->where('status',1)
            ->first();
        $data->totalviews = $data->totalviews + 1;
        $data->save();
        $data_involve = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }))
            ->where('module','article')->where('status', '=', 1)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        $data_new = Item::with(array('groups' => function($query){
            $query->where('module','article-category');
        }))
            ->where('module','article')->where('status', '=', 1)
            ->inRandomOrder()
            ->orderBy('id','desc')
            ->limit(10)
            ->get();

        return response()->json([
            'message' => 'Load bài viết thành công.',
            'status' => 1,
            'data_new' => $data_new,
            'data_involve' => $data_involve,
            'data' => $data,
        ], 200);
    }

}
