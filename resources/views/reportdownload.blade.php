<h1 style="text-align: center">Item's Report</h1>
<hr>
<h4 style="text-align: center">Stock Report</h4>
<table width="100%" style="border: 1px solid #000000">
  <tr>
    <td style="border-bottom: 1px solid #000000">Item Name</td>
    <td style="border-bottom: 1px solid #000000; text-align:center">Last Stock</td>
    <td style="border-bottom: 1px solid #000000; text-align:center; text-align:center">New Stock</td>
    <td style="border-bottom: 1px solid #000000; text-align:center">Date Update</td>
  </tr>
  @foreach($itemdetail as $itemdetail)
  <tr>
    <td>{{ $itemdetail->item->name_item }}</td>
    <td style="text-align: center">{{ $itemdetail->last_stock }}</td>
    <td style="text-align: center">{{ $itemdetail->new_stock }}</td>
    <td style="text-align: center">{{ dateConversion($itemdetail->created_at) }}</td>
  </tr>
  @endforeach
</table>
@if(Sentinel::inRole('admin'))
<br>
<h4 style="text-align: center">Sold Report</h4>
<table width="100%" style="border: 1px solid #000000">
  <tr>
    <td style="border-bottom: 1px solid #000000">Item Name</td>
    <td style="border-bottom: 1px solid #000000; text-align:center">Qty</td>
    <td style="border-bottom: 1px solid #000000; text-align:center">Date Transaction</td>
  </tr>
  @foreach($transactiondetail as $transactiondetail)
  <tr>
    <td>{{ $transactiondetail->item->name_item }}</td>
    <td style="text-align: center">{{ $transactiondetail->qty }}</td>
    <td style="text-align: center">{{ dateConversion($transactiondetail->created_at) }}</td>
  </tr>
  @endforeach
</table>

<br>
<h4 style="text-align: center">Current Stock</h4>
<table width="100%" style="border: 1px solid #000000">
  <tr>
    <td style="border-bottom: 1px solid #000000">Item Name</td>
    <td style="border-bottom: 1px solid #000000; text-align:center">Supplier Name</td>
    <td style="border-bottom: 1px solid #000000; text-align:center; text-align:center">Current Stock</td>
  </tr>
  @foreach($item as $item)
  <tr>
    <td>{{ $item->name_item }}</td>
    <td style="text-align: center">{{ $item->user->name }}</td>
    <td style="text-align: center">{{ $item->stock_item }}</td>
  </tr>
  @endforeach
</table>
@endif
