<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use Auth;

class Activity extends \Eloquent
{
    protected $table = 'activity_log';

    protected $fillable = [
		'user_id',
		'name',
		'action',
		'url',
		'description',
		'module',
		'data',
		'ip_address',
		'user_agent',
    ];
    

    public function user()
	{
		return $this->belongsTo(config('auth.providers.users.model'), 'user_id');
    }
    

    public static function addLog($content,$data="",$backend=true)
    {
        $log = [];
        $log['description'] = $content;
        $log['url'] = Request::fullUrl();
        $log['method'] = Request::method();
        $log['ip_address'] = Request::ip();
        $log['input'] = $data;
        $log['user_agent'] = Request::header('user-agent');
        $log['name'] = Auth::user()->name;
        $log['user_id'] = Auth::user()->id;
        // if($backend){
        //     $log['name'] = \Auth::guard()->user()->username;
        // }
        // else{
        //     $log['name'] = \Auth::guard('frontend')->user()->username;
        // }

        Activity::create($log);
    }

    public static function logActivityLists()
    {
        return Activity::latest()->get();
    }
}
