<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Feedback;
use App\Models\Item;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hours = Carbon::now()->hour;
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $order_month = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
        $count_order_month = count($order_month);
        $status_order_month = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where('status',1)->get();
        $count_status_order_month = count($status_order_month);
        $none_status_order_month = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where('status',0)->get();
        $none_count_order_month = count($none_status_order_month);

        $pay1 = Order::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->whereDay('created_at', '=', $day)
        ->get();

        $data1 = json_decode($pay1);
        $count1 = count($data1);
        if($count1 == 0){
            $sum1 = 0;
        }else{

            foreach ($data1 as $key => $a) {
                $b1[$key] = $a->total;
            }

            $sum1 = array_sum($b1);

        }

        $pay = Order::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->get();

        $data = json_decode($pay);
        $count = count($data);
        if($count == 0){

            $sum = 0;

        }else{

            foreach ($data as $key => $a) {
                $b[$key] = $a->total;
            }

            $sum = array_sum($b);

        }
        $feekback = Feedback::orderby('id','desc')->paginate(30);
        $product = Item::orderBy('id','desc')->where('module','san-pham')->paginate(30);
        $news = Item::orderBy('id','desc')->where('module','bai-viet')->paginate(30);
        $new = Item::orderBy('id','desc')->where('module','bai-viet')->first();
        return view('admin.index',compact('hours','count_order_month','count_status_order_month','none_count_order_month','sum','sum1','count','count1','feekback','product','news','new'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
