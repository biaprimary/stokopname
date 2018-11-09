@foreach ($items as $item)
<div class="col-md-4">
  <div class="card mb-3">
    <div class="card-header">
      <h6>{{$item->name_item}}</h6>
    </div>
    <div class="card-body buy-table">
      <table>
        <tr>
          <td style="padding-bottom:20px; width: 30%;"><img src="{{URL::asset('/img/book.png')}}" width="100%"></td>
          <td style="vertical-align: top; padding-left:20px">
            <table width="100%">
            <tr>
              <td>Name</td>
              <td>: {{$item->name_item}}</td>
            </tr>
            <tr>
              <td>Category</td>
              <td>: {{$item->id_category}}</td>
            </tr>
            <tr>
              <td>Seller:</td>
              <td>: {{$item->id_user}}</td>
            </tr>
            <tr>
              <td>Qty</td>
              <td>{!! Form::number('qty', 1, array('class' => 'form-control', 'min' => '1', 'max' => $item->stock_item, 'id' => 'addtocart', 'data-id' => $item->id)) !!}</td>
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td colspan="2"><button class="float-right btn btn-primary buy" id="buy">Add to Cart</button></td>
        </tr>
      </table>
    </div>
  </div>
</div>
@endforeach
<div class="col-md-12 text-center">
  {{ $items->links() }}
</div>
