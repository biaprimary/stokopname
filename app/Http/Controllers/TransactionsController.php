<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\TransactionDetail;
use App\Transaction;
use App\Buyer;
use App\Item;

class TransactionsController extends Controller
{
    public function __construct(){
      $this->middleware('sentinel');
      $this->middleware('sentinel.role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transactions = TransactionDetail::with(['transaction', 'item', 'transaction.buyer'])->get();
        return view('transaction.transaction')->with('transactions', $transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $buyer = Buyer::with('user')->where('role_id', '3')->get();
        $item = Item::where('stock_item', '!=', '0')->get();
        return view('transaction.transactionnew')->with('buyer', $buyer)->with('item', $item);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        //
        if($request->input('id_transaction') == 'new'){
          $newtransaction = Transaction::create($request->all());
          $request->merge(['id_transaction' => $newtransaction->id]);
        }
        TransactionDetail::create($request->all());
        $item = Item::find($request->input('id_item'));
        $qty = $item->stock_item - $request->qty;
        $item->update([
          'stock_item' => $qty
        ]);

        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $buyer = Buyer::with('user')->where('role_id', '3')->get();
        $transactiondetail = TransactionDetail::with('transaction', 'item')->find($id);
        $transaction = Transaction::where('id_buyer', $transactiondetail->transaction->id_buyer)->get();
        $item = Item::where('stock_item', '!=', '0')->get();
        return view('transaction.transactionedit')
                ->with('transactiondetail', $transactiondetail)
                ->with('buyer', $buyer)
                ->with('transaction', $transaction)
                ->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        //
        if($request->input('id_transaction') == 'new'){
          $newtransaction = Transaction::create($request->all());
          $request->merge(['id_transaction' => $newtransaction->id]);
        }

        $stored = TransactionDetail::find($id);
        if($request->qty == $stored->qty && $request->id_item == $stored->id_item){
          $request->offsetUnset('qty');
        }elseif($request->qty != $stored->qty && $request->id_item == $stored->id_item){
          $item = Item::find($stored->id_item);
          $qty_start = $item->stock_item + $stored->qty;
          $qty = $qty_start - $request->qty;
          $item->update([
            'stock_item' => $qty
          ]);
        }elseif($request->id_item != $stored->id_item){
          $item = Item::find($stored->id_item);
          $qty_start = $item->stock_item + $stored->qty;
          $item->update([
            'stock_item' => $qty_start
          ]);
          $itemnew = Item::find($request->input('id_item'));
          $qty = $itemnew->stock_item - $request->qty;
          $itemnew->update([
            'stock_item' => $qty
          ]);
        }
        $stored->update($request->all());
        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $transactiondetail = TransactionDetail::with('item','transaction');
        $td_id = $transactiondetail->find($id);
        $qty = $td_id->qty + $td_id->item->stock_item;
        $td_id->item->update([
          'stock_item' => $qty
        ]);
        $count = TransactionDetail::where('id_transaction', $td_id->id_transaction)->get();
        if($count->count() == 1){
            Transaction::destroy($td_id->id_transaction);
        }else{
            TransactionDetail::destroy($id);
        }
        return redirect()->route('transactions.index');
    }
}
