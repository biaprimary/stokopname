<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'id_category', 'id_user', 'name_item','stock_item'
    ];

    public function category(){
      return $this->belongsTo('App\Category', 'id_category');
    }

    public function user(){
      return $this->belongsTo('App\User', 'id_user');
    }
}
