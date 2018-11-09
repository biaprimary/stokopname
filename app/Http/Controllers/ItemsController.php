<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Item;
use App\ItemDetail;
use App\Transaction;
use Session;
use Sentinel;
use App\Http\Requests\ItemRequest;
use Excel;

class ItemsController extends Controller
{
    public function __construct(){
      $this->middleware('sentinel');
      $this->middleware('sentinel.role');
      $this->middleware('item.owner', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userid = Sentinel::getUser();
        if($userid->inRole('admin')){
          $items = Item::with(['category', 'user'])->get();
        }else{
          $items = Item::with(['category', 'user'])->where('id_user',$userid->id)->get();
        }
        return view('item.item')->with('item', $items)->with('userid', $userid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::all();
        $userid = Sentinel::getUser();
        return view('item.itemnew')->with('category', $category)->with('userid', $userid);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        //
        $item = Item::create($request->all());
        ItemDetail::create([
          'id_item' => $item->id,
          'last_stock' => 0,
          'new_stock' => $request->input('stock_item')
        ]);
        return redirect()->route('items.index');
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
    public function edit(Item $item)
    {
        //

        // if(Sentinel::getUser()->id != 2){
        //   return "who";
        // }else{

          $category = Category::all();
          $item = Item::find($item->id);
          $userid = Sentinel::getUser();
          //$this->authorize('view', $item);
          return view('item.itemedit')->with('item',$item)->with('category', $category)->with('userid', $userid);
        //}

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        //
        $request->offsetUnset('id_user');
        $item = Item::find($id);
        $last_stock = $item->stock_item;
        $item->update($request->all());
        if($request->input('stock_item') != $last_stock){
          ItemDetail::create([
            'id_item' => $id,
            'last_stock' => $last_stock,
            'new_stock' => $request->input('stock_item')
          ]);
        }
        return redirect()->route('items.index');
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
        Item::destroy($id);
        return redirect()->route('items.index');
    }

    public function checkstock($id){
      $itemcheckstock = Item::find($id);
      return response()->json($itemcheckstock);
    }

    public function checktransaction($id){
      $checktransaction = Transaction::where('id_buyer', $id)->get();
      return response()->json($checktransaction);
    }

    public function downloadtemplate($type){
      $userid = Sentinel::getUser();
      $data = Item::select('id_category','name_item','stock_item');
      if($userid->inRole('supplier')){
        $data = $data->where('id_user', $userid->id);
      }
      $data = $data->get()->take(1)->toArray();
      return Excel::create('Item', function($excel) use($data) {
        $excel->sheet('Item', function($sheet) use($data) {
          $sheet->fromArray($data);
        });
      })->download($type);
    }

    public function importtemplate(Request $request){
      if($request->hasFile('import_file')){
        Excel::load($request->file('import_file')->getRealPath(), function($reader){
          foreach($reader->toArray() as $key => $row){
            $userid = Sentinel::getUser();
            $item = new Item;
            $item->id_category = $row['id_category'];
            $item->id_user = $userid->id;
            $item->name_item = $row['name_item'];
            $item->stock_item = $row['stock_item'];
            if(!empty($item)){
              $item->save();
              ItemDetail::create([
                'id_item' => $item->id,
                'last_stock' => 0,
                'new_stock' => $row['stock_item']
              ]);
            }
          }
        });
      }
      return back();
    }
}
