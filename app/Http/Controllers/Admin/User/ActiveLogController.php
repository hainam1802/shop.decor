<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Activity;
use Illuminate\Support\Carbon;
use Log;
use App\User;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogUser;

class ActiveLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:log-user', ['only' => ['LogUser']]);
    }
     
    public function index()
    {
        
        $user_id = Auth::user()->id;
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        // dd($year,$month,$day);
        $day_log = Activity::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->whereDay('created_at', '=', $day)
        ->orderBy('id','desc')->offset(0)->limit(1000)->where('user_id',$user_id)->get();

        $month_log = Activity::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->orderBy('id','desc')->offset(0)->limit(100000)->where('user_id',$user_id)->get();
        Activity::addLog('Truy cập trang nhật kí hoạt động');
        return view('admin.user.user-log',compact('day_log','month_log'));
    }

    public function LogUser(Request $request,$id){
        $user = User::find($id);
        if($request->ajax()) {
            $data = Activity::orderBy('id','desc')->where('user_id',$id);
            $data->get();
        return Datatables::of($data)
        ->editColumn('date', function($data) {
            return date('d/m/Y', strtotime($data->created_at));
        })
        ->editColumn('time', function($data) {
            return date('H:i:s', strtotime($data->created_at));
        })
        ->make(true);
    }
        Activity::addLog('Truy cập lịch sử hoạt động của thành viên: ',$user->name);
        return view('admin.user.view-log-user',compact('user','id'));
    }

    public function export(Request $request,$id)
    {
        // dd($id);
        $data = User::find($id);
        Activity::addLog('Xuất excel nhật kí hoạt động thành viên: '.$data->name);
        return Excel::download(new LogUser($request->id), 'Nhật kí hoạt động thành viên '.$data->name.'.xlsx');
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
