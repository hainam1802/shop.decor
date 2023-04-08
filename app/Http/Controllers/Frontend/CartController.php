<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Item;
use Validator;
use App\Models\Order;

class CartController extends Controller
{
    public function AddCart(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'size' => 'required',
            'color' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->first()]);
        }
        $size = $request->size;
        $color = $request->color;
        $product = Item::find($id);
        Cart::add(['id' => $id, 'name' => $product->title, 'qty' => 1,'weight' => 1, 'price' => $product->price, 'options' => ['image' => $product->image,'size' => $size,'color' => $color]]);
        return response()->json(['success' => "Đã thêm sản phẩm vào giỏ hàng"]);
    }

    public function getShow(){
        $total = Cart::total();
        $data = Cart::content();
        // dd($data);
        return view('frontend.pages.cart',['data'=>$data,'total'=>$total]);
    }

    public function Update(Request $request){
        // dd($request->all());
        Cart::update($request->rowId,$request->qty);
        return response()->json(['success' => "Cập nhật sản phẩm thành công"]);
        // dd(1);
    }

    public function getDelete($id){
        // dd($id);
        Cart::remove($id);
        return response()->json(['success' => "Đã xóa sản phẩm khỏi giỏ hàng"]);
    }

    public function getCheckout(){
        $data = Cart::content();
        $total = Cart::total();
        return view('frontend.pages.cart-done',['data'=>$data,'total'=>$total]);
    }

    public function postCheckout(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'address' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->first()]);
        }

        if($request->email){
            $dataMail = [
                'name'=>$request->name,
                'address'=>$request->address,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'total'=>Cart::total(),
                'data'=>Cart::content()
    
            ];
            $email = $request->email;
            Mail::send('frontend.pages.content-mail',$dataMail,function($meg) use ($email){
                $meg->from('truongdv.hqgroup@gmail.com','Hin Shop');
                $meg->to($email)->subject('Leoo Shop');
            });
        }
        // dd($request->content);
        $pay = new Order;
        $pay->name = $request->name;
        $pay->address = $request->address;
        $pay->email = $request->email;
        $pay->content = (str_replace('\\','',json_encode($request->content,JSON_UNESCAPED_UNICODE)));
        $pay->status = 0;
        $pay->excel = 0;
        $pay->phone = $request->phone;
        $pay->total = str_replace(',', '',Cart::total());
        $pay->save();
        Cart::destroy();
        // return response()->json(['success' => "Mua hàng thành công"]);

        return redirect('cart/succsess');
    }
    public function getSusscess(){
        return view('frontend.pages.done');
    }
}
