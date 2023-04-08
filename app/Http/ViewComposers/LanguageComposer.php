<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\LanguageNation;

class LanguageComposer
{
    public $lang_active_data = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $lang = session()->get('locale');
        if(isset($lang)){
            $lang_active = LanguageNation::where('locale',$lang)->get();
        }else{
            $lang = 'vi';
            $lang_active = LanguageNation::where('locale','vi')->get();
        }
        foreach ($lang_active as $id_lang){
            $id_la = $id_lang->id;
        }
    //    dd($id_la);
    //    dd($lang_active_data);
        $this->lang_active_data[] =  LanguageNation::find($id_la);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
    //    dd($this->lang_active_data);
        $view->with('language_active', end($this->lang_active_data));
    }
}
