<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'slug','name'
    ];

    public function userSupplier(){
      return $this->hasMany('App\Supplier', 'id');
    }

    public function userBuyer(){
      return $this->hasMany('App\Buyer', 'id');
    }
}
