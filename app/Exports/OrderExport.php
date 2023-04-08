<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Order::where('excel',0)->where('status',1)->get();
            foreach($data as $item){
                $id[] = $item->id;
                $name[] = $item->name;
                $address[] = $item->address;
                $mail[] = $item->email;
                $phone[] = $item->phone;
                $content[] =($item->content);
                $total[] = $item->total;
                $date[] = date_format($item->created_at, 'd-m-Y');
            }
            // dd($name);
            $count = count($data);
            for($i = 0; $i <= $count-1; $i++){
                $arr[$i] = [
                    "id" => $i+1,
                    "name" => $name[$i],
                    "address" => $address[$i],
                    "mail" => $mail[$i],
                    "phone" => $phone[$i],
                    "content" => $content[$i],
                    "total" => $total[$i],
                    "date" => $date[$i],
                ];
            }
            // dd($id);
            if(!empty($arr)){
                $data = Order::where('excel',0)->where('status',1)->update(['excel'=> 1]);
                return $arr;
            }
    }
    public function headings() :array {
    	return ["STT", "Khách hàng","Địa chỉ", "Email", "Số điện thoại", "Sản phẩm", "Tổng tiền", "Ngày mua"];
    }
}
