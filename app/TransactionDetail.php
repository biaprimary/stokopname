<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    //
    protected $table = 'transaction_details';
    protected $fillable = ['id_transaction', 'id_item', 'qty'];

    public function transaction(){
      return $this->belongsTo('App\Transaction', 'id_transaction');
    }

    public function item(){
      return $this->belongsTo('App\Item', 'id_item');
    }
}
