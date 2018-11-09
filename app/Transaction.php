<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = ['id_buyer'];

    public function buyer(){
      return $this->belongsTo('App\User', 'id_buyer');
    }

    public function transactiondetail(){
      return $this->hasMany('App\TransactionDetail', 'id_transaction');
    }
}
