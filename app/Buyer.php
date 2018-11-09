<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    //
    protected $table = 'role_users';
    protected $primaryKey = 'user_id';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function role(){
      return $this->belongsTo('App\Role', 'role_id', 'id');
    }

    public function user(){
      return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
