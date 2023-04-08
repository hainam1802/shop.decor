<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "groups";
    protected $guarded=[];

    public function product()
    {
        return $this->hasMany('App\Models\Item', "parrent_id", "id");
    }
}
