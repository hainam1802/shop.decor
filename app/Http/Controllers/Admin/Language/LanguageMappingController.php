<?php

namespace App\Http\Controllers\Admin\Language;
use App\Models\LanguageNation;
use App\Models\LanguageMapping;
use App\Models\LanguageKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LanguageExport;
use App\Imports\LanguageImport;
use Log;
use App\Models\Activity;

class LanguageMappingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:language-mapping-list');
        $this->middleware('permission:language-mapping-export', ['only' => ['export']]);
        $this->middleware('permission:language-mapping-import', ['only' => ['import']]);
        $this->middleware('permission:language-mapping-render', ['only' => ['render']]);
        $this->middleware('permission:language-mapping-add', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        foreach ($data as $item){
            $name[] = $item->title;
            $id[] = $item->id;
            foreach ($item->language_nation as $key => $value){
                $va[] = $value->pivot['title'];
            }
        }
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
            $arr = LanguageKey::all();
        }

        // dd($arr);


        Activity::addLog('Truy cập bảng biên dịch ngôn ngữ hệ thống');
        return view('admin.languageMapping.index',compact('arr'));
    }

    // export dữ liệu

    public function export()
    {
        $lang = session()->get('locale');
            if(!isset($lang)){
            $lang = 'vi';
        }
        Activity::addLog('Xuất Excel bảng ngôn ngữ: '.$lang.'json');
        return Excel::download(new LanguageExport, $lang.'.xlsx');
    }


    // import dữ liệu excel

    public function import()
    {
        $lang = session()->get('locale');

        $language = LanguageNation::where('locale',$lang)->get();

        foreach ($language as $la){
            $id_key = $la->id;
        }
//        dd($id_key);
        $data = LanguageMapping::where('language_nation_id',$id_key)->get();
        foreach($data as $item){
            $ids[] = $item->id;
        }
//        dd($ids);
        if(isset($ids)) {
            LanguageMapping::destroy($ids);
        }
        $import = Excel::import(new LanguageImport(), request()->file('file_language'));
//        dd($import);
        Activity::addLog('Nhập dữ liệu bằng excel bảng biên dịch ngôn ngữ');
        return redirect()->back()->with('success', 'Đăng tải thành công !!!');
    }


    public function render(){
        $lang = session()->get('locale');
        if(isset($lang)){
            if($lang == "vi"){
                return redirect()->back()->withErrors(['Bạn đang ở ngôn ngữ mặc định, không thể biên dịch sang ngôn ngữ này']);
            }else if($lang != "vi"){
                $language = LanguageNation::where('locale',$lang)->get();

        foreach ($language as $la){
            $id_key = $la->id;
        }
        $data = LanguageMapping::where('language_nation_id',$id_key)->get();
        $count = count($data);
        $val = $count-1;
        $string = "";
        $string = "{";
        // $string .= "<br>";
        // dd($count);
        foreach($data as $item){
            $default[] = $item->translate->title;
            $translation[] = $item->title;
        }
        // dd($translation);
        for($i = 0;$i<$count;$i++){
            foreach($default as $defa){
                $def[] = $defa;
            }
            foreach($translation as $trans){
                $tran[] = $trans;
            }
            $string .= (json_encode($def[$i],JSON_UNESCAPED_UNICODE)).":".(json_encode($tran[$i],JSON_UNESCAPED_UNICODE));
            if($i<$val){
                $string .= ",";
            }
                // $string .= "<br>";
            }
            $string .= "}";
            // echo $string;die();
            $file = "../resources/lang/$lang.json";
            if(file_exists($file)){
                unlink($file);
                $open = fopen($file,'a');
                fwrite($open, $string);
            }else{
                $open = fopen($file,'a');
                fwrite($open, $string);      
            }
                fclose($open);
                Activity::addLog('Lưu bản biên dịch ngôn ngữ thành công');
                return redirect()->back()->with('success', 'Ghi dữ liệu thành công !!!');
            }
        }else{
            return redirect()->back()->withErrors(['Bạn đang ở ngôn ngữ mặc định, không thể biên dịch sang ngôn ngữ này']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languageMapping.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $count =count($request->language_key_id);

        $lang = $request->session()->get('locale');
        $language = LanguageNation::where('locale',$lang)->get();
        foreach ($language as $langkey){
            $idl = $langkey->id;
        }
        for ($i = 0; $i < $count; $i++){
            $language_nation_id[$i] = $idl;
        }
        $language_key_id = $request->language_key_id;
        $title = $request->title;
        for ($i = 0; $i < $count; $i++){
            foreach ($language_key_id as $key => $key_id){
                $n1[] = $key_id;
            }
            foreach ($language_nation_id as $key => $nation_id){
                $n2[] = $nation_id;
            }
            foreach ($title as $key => $tit){
                $n3[] = $tit;
            }
            $data[$i] = [
                'language_key_id' =>$n1[$i],
                'language_nation_id' => $n2[$i],
                'title' => $n3[$i]
            ];
        }


        $data_id = LanguageMapping::where('language_nation_id',$idl)->get();

        foreach($data_id as $item){
            $ids[] = $item->id;
        }

        if(isset($ids)) {
            LanguageMapping::destroy($ids);
        }

        LanguageMapping::insert($data);
        return redirect()->back()->with('success','Thành công!');
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
