<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\LanguageNation;

class LanguageAllComposer
{
    public $language_all = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->language_all[] =  LanguageNation::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // dd($this->language_all);
        $view->with('language', end($this->language_all));
    }
}
