<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Module;

class ModuleComposer
{
    public $module_item = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->module_item[] =  Module::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // dd($this->module_item);
        $view->with('module_item', end($this->module_item));
    }
}
