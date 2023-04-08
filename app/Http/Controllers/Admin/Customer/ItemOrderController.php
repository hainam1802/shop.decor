<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;
use App\Models\Activity;
use App\Models\Order;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;
use Carbon\Carbon;

class ItemOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Order::where('status',0)->get();
        return Datatables::of($data)
        ->editColumn('content', function($data) {
            return json_decode($data->content);
        })
        ->editColumn('total', function($data) {
            return number_format($data->total)." VNĐ";
        })
        ->editColumn('created_at', function($data) {
            return date_format($data->created_at, 'd-m-Y');
        })
        ->addColumn('action', function ($data) {
           $html = '<a title="Xử lí" href="'. url('admin/order/update-order/'. $data->id) .'" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill addMoney_toggle"><i class="fas fa-arrow-alt-circle-up"></i></a>';
           return $html;
        })
        ->make(true);

        }
        Activity::addLog('Truy cập bảng đơn hàng chưa xử lí');
        return view('admin.order.index');
    }

    public function UpdateOrder($id){
        // dd($id);
        $data = Order::find($id);
        $data->status = 1;
        $data->save();
        Activity::addLog('Đã xử lí đơn hàng có mã: '.$id);
        return redirect()->back()->with('success','Xử lí đơn hàng thành công');
    }

    public function export()
    {
        $now = Carbon::now();
        $date = $now->toDateString(); 
        Activity::addLog('Xuất Excel đơn hàng');
        return Excel::download(new OrderExport,'Đơn hàng HinShop ngày'.$date.'.xlsx');
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
        dd(1);
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
