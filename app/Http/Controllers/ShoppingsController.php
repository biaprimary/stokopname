<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Transaction;
use App\TransactionDetail;
use Session;
use Sentinel;

class ShoppingsController extends Controller
{
    //
    public function __construct(){
      $this->middleware('sentinel');
      $this->middleware('sentinel.role');
    }

    public function index(Request $request){
      $category = Category::all();
      $item = Item::with(['category', 'user'])->where('stock_item', '!=', 0);
      if($request->ajax()){
          if($request->search){
            $item = $item->where('name_item', 'like', '%'.$request->search.'%');
          }

          if($request->category){
            $item = $item->where('id_category', $request->category);
          }

          if($request->sort){
            $item = $item->orderBy('name_item', $request->sort);
          }

          $item = $item->paginate(3);
          $view = (string)view('shopping.shoppingitem')->with('items',$item)->with('category',$category)->render();
          return response()->json(['view' => $view]);
      }else{
          $item = $item->orderBy('name_item', 'asc')->paginate(3);
          return view('shopping.shopping')->with('items', $item)->with('category', $category);
      }
    }

    public function cart(){
      $item = Session::get('carts');
      if(!empty($item)){
      $user = Sentinel::getUser();
      $id_item = array();
      $qty_item = array();

      foreach($item as $item){
        array_push($id_item, $item['id']);
        array_push($qty_item, $item['qty']);
      }

      $itemtostring = implode(",", $id_item);
      $itemdetail = Item::with('category', 'user')->whereIn('id', $id_item)->orderByRaw('FIELD(id, '.$itemtostring.')')->get();
      return view('shopping.shoppingcart')->with('user', $user)->with('itemdetail', $itemdetail)->with('qty_item', $qty_item);
      }
      else{
        return redirect()->to('shopping');
      }

    }

    public function setItem(Request $request){
      $value = Session::get('carts');
      if(isset($value)){
        foreach($value as $key => $value){
          if($value['id'] == $request->id){
            Session::pull('carts.' . $key);
          }
        }
      }
      $product = [
        'id' => (int)$request->id,
        'qty' => (int)$request->qty
      ];
      Session::push('carts', $product);
    }

    public function deleteItem($id){
      $value = Session::get('carts');
      if(isset($value)){
        foreach($value as $key => $value){
          if($value['id'] == $id){
            Session::pull('carts.' . $key);
          }
        }
      }
      if(!empty($value)){
          return redirect()->to('cart');
      }else{
          return redirect()->to('shopping');
      }
    }

    public function buy(){
      $userid = Sentinel::getUser();
      $value = Session::get('carts');

       $newtransaction = Transaction::create([
         'id_buyer' => $userid->id
       ]);
      foreach($value as $key => $value){
        $item = Item::find($value['id']);
        $qty = $item->stock_item - $value['qty'];
        $item->update(array('stock_item' => $qty));
        TransactionDetail::create([
          'id_transaction' => $newtransaction->id,
          'id_item' => $value['id'],
          'qty' => $value['qty']
        ]);
        Session::pull('carts.' . $key);
      }
      return view('shopping.shoppingfinish');
    }
}
