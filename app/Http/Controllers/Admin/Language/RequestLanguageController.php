<?php

namespace App\Http\Controllers\Admin\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Log;
use App\Models\Activity;

class RequestLanguageController extends Controller
{
    public function index(Request $request,$id){
    if($id){
        Session::put('locale',$id);
    }
        Activity::addLog('Thay đổi ngôn ngữ hệ thống');
        return redirect()->back();
    }
}
