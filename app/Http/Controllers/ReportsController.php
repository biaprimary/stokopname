<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\ItemDetail;
use App\TransactionDetail;
use PDF;
use Sentinel;

class ReportsController extends Controller
{
    //
    public function __construct(){
      $this->middleware('sentinel');
      $this->middleware('sentinel.role');
    }

    public function index(){
      $item = Item::all();
      $userid = Sentinel::getUser();
      if(Sentinel::inRole('supplier')){
        $item = $item->where('id_user', $userid->id);
      }
      return view('report')->with('item', $item);
    }

    public function reportdownload(Request $request){
      $itemdetail = ItemDetail::with('item')->orderBy('id_item')->get();
      $transactiondetail = TransactionDetail::with('item')->orderBy('id_item')->get();
      $item = Item::with('user')->orderBy('id')->get();
      if($request->input('id_item') != 'all'){
        $itemdetail = $itemdetail->where('id_item', $request->input('id_item'));
        $transactiondetail = $transactiondetail->where('id_item', $request->input('id_item'));
        $item = $item->where('id', $request->input('id_item'));
      }
      $userid = Sentinel::getUser();
      if(Sentinel::inRole('supplier')){
        $itemdetail = $itemdetail->where('item.id_user', $userid->id);
      }
      $report = PDF::loadView('reportdownload', compact('itemdetail', 'transactiondetail', 'item'))->setPaper('a4');
      return $report->stream();
    }
}
