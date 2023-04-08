<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";
    protected $guarded=[];

    public function category(){
        return $this->hasOne(Group::class,'id','parrent_id');
    }
    public function color(){
        return $this->hasOne(ColorItem::class,'id','color');
    }
}
