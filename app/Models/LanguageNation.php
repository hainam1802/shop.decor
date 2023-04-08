<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageNation extends Model
{
    protected $table = "language_nation";
    protected $guarded=[];

    public function language_key(){
        return $this->belongsToMany(LanguageKey::class,'language_mapping','language_nation_id', 'language_key_id')->withPivot('title');
    }
}
