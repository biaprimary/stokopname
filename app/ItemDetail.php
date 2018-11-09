<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    //
    protected $table = 'item_details';
    protected $fillable = ['id_item', 'last_stock', 'new_stock'];

    public function item(){
      return $this->belongsTo('App\Item', 'id_item');
    }
}
