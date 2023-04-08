<?php

namespace App\Exports;

use App\Models\LanguageMapping;
use App\Models\LanguageKey;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LanguageExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $lang = session()->get('locale');
        if(isset($lang)){
            $data = LanguageKey::with(array('language_nation'=>function($q){
                $q->where('locale',session()->get('locale'));
            }))->get();
        }else{
            $data = LanguageKey::with(array('language_nation'=>function($q){
                $q->where('locale','vi');
            }))->get();
        }

        $count = LanguageKey::count();
        // dd($count);
        foreach ($data as $item){
            // dd($item->language_nation[0]->pivot->title);
            $name[] = $item->title;
            $id[] = $item->id;
            foreach ($item->language_nation as $key => $value){
                $va[] = $value->pivot['title'];
            }
        }
//        dd($va);
        if(isset($va)){
            for($i = 0; $i < $count; $i++){

                foreach($id as $i2){
                    $i1[] = $i2;
                }
                foreach($name as $nam){
                    $na[] = $nam;
                }
                foreach($va as  $key => $v){
                    if($key =! $i){
                        $v1[] = $v;
                    }else{
                        $v1[] = "";
                    }
                }
                $arr[] = [
                    'id' => $i1[$i],
                    'title' => $na[$i],
                    'language' => $v1[$i]
                ];
            }
        }else{
            $data = LanguageKey::all();
            foreach ($data as $item){
                $arr[] = [
                    'id' => $item->id,
                    'title' => $item->title
                ];
            }
        }
        // dd($arr);
        return $arr;
    }
    public function headings() :array {
    	return ["Key ID", "Ngôn ngữ gốc", "Bản dịch"];
    }
}
