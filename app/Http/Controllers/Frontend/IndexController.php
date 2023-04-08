<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Item;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Feedback;

class IndexController extends Controller
{
    //
    public function getIndex(){
        $category = Group::where('module','san-pham')->with(['product'])->inRandomOrder()->get();
        $trend = Item::inRandomOrder()->where('module','san-pham')->paginate(5);
        $run = Item::inRandomOrder()->where('module','san-pham')->paginate(5);
        $hight = Item::inRandomOrder()->where('module','san-pham')->paginate(5);
        // dd($category);
        return view('frontend.pages.index',compact('category','trend','run','hight'));
    }

    public function details($slug){
        $data=  Item::where('module','san-pham')->where('slug',$slug)->first();
        // dd($data);
        $image_extension = json_decode($data->image_extension);
        // dd($image_extension);
        $product = Item::where('module','san-pham')->where('slug',$slug)->get();
        foreach($product as $item){
            $id = $item->parrent_id;
        }
        $product_item = Item::where('module','san-pham')->where('parrent_id',$id)->inRandomOrder()->paginate(4);
        // dd($product_item);
        return view('frontend.pages.details',compact('data','product_item','image_extension'));
    }
    
    public function details_id($id){
        $data= Item::where('module','san-pham')->where('id',$id)->first();
        if(isset($data)) {
            $cat = $data->category->title;
            $size = json_decode($data->size);
            $color = json_decode($data->color);
            return response()->json(['data' => $data,'cat' => $cat,'size' => $size,'color' => $color]);
        }   
        return response()->json(['errorCode' => 0, 'mess' => 'Thất bại', 'data' => null]);
    }


    public function product(){
        $highlights = Item::where('module','san-pham')->inRandomOrder()->paginate(9);
        $selling = Item::where('module','san-pham')->inRandomOrder()->paginate(12);
        $category = Group::where('module','san-pham')->inRandomOrder()->get();
        return view('frontend.pages.product',compact('highlights','selling','category'));
    }

    public function category($slug){
        $slug= Group::where('module','san-pham')->where('slug',$slug)->first();
        $name = $slug->title;
        $data = Item::where('module','san-pham')->where('parrent_id',$slug->id)->paginate(12);
        $category = Group::where('module','san-pham')->inRandomOrder()->get();
        return view('frontend.pages.category',compact('data','category','name'));
    }

    public function search(Request $request){
        $title = $request->search;
        $search = str_replace(' ','%', $title);
        $data =  Item::where('module','san-pham')->orderBy('id','desc')->where('title','like','%'.$search.'%')->get();
        $count = count($data);
        // dd($title,$data,$count);
        return view('frontend.pages.search',compact('title','data','count'));
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function mailContact(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'content' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->first()]);
        }
        if($request->email){
            $dataMail = [
                'name'=>$request->name,
                'email'=>$request->email,
                'content'=>$request->content,

            ];
            $email = $request->email;
            Mail::send('frontend.pages.content',$dataMail,function($meg) use ($email){
                $meg->from('truongdv.hqgroup@gmail.com','Hin Shop');
                $meg->to($email)->subject('Hin Shop');
            });
        }

        $contr = new Feedback;
        $contr->name = $request->name;
        $contr->email = $request->email;
        $contr->content = $request->content;
        // dd($contr);
        $contr->save();

        // return redirect('lien-he')->with('success','Gửi ý kiến đóng góp thành công !');
        return response()->json(['success' => "Cảm ơn bạn đã góp ý cho chúng tôi"]);
    }

    public function policy(){
        return view('frontend.pages.policy');
    }
}
