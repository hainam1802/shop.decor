<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Favourite extends BaseModel
{
    protected $table = 'favorite';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $fillable = [
        'user_id',
        'item_id',
        'amount',
        'status',
        'action',
        'params',
    ];


    //foreign key of user(user_id)
//    public function user()
//    {
//        return $this->belongsTo(User::class)->select('id','username','email');
//    }
//
//    //foreign key of user(ref_id)
//    public function ref_id()
//    {
//        return $this->belongsTo(User::class,'ref_id','id')->select('id','username','email');
//    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->select('id','username','email','image');
    }
    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
//        return $this->belongsTo(Item::class,'item_id')->select('slug','url','title','image');
    }
}
