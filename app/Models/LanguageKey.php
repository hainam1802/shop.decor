<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageKey extends Model
{
    protected $table = "language_key";
    protected $guarded=[];

    public function language_nation(){
        return $this->belongsToMany(LanguageNation::class,'language_mapping','language_key_id', 'language_nation_id')
            ->withPivot('title');
    }
}
