<?php

namespace App\Exports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogUser implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function collection()
    {
        // dd($this->id);
        $data = Activity::orderBy('id','desc')->where('user_id',$this->id)->get();
        foreach($data as $item){
            $id_item[] = $item->id;
            $date[] = ($item->created_at)->format('d-m-Y');
            $time[] = ($item->created_at)->format('H:i:s');
            $description[] = $item->description;
            $url[] = $item->url;
            $ip_address[] = $item->ip_address;
            $user_agent[] = $item->user_agent;
        }
        $count = count($data);
        // dd($count);
        for($i = 0; $i <$count-1; $i++){
            $arr[$i] = [
                "id" => $id_item[$i],
                "date" => $date[$i],
                "time" => $time[$i],
                "description" => $description[$i],
                "url" => $url[$i],
                "ip_address" => $ip_address[$i],
                "user_agent" => $user_agent[$i]
            ]; 
        }
        // print_r("<pre>");
        // print_r($arr);
        // die();
        if(!empty($arr)){
            return $arr;
        }
    }
    public function headings() :array {
    	return ["ID", "Ngày", "Thời gian","Hành động","Url","Địa chỉ IP","Trình duyệt sử dụng"];
    }
}
