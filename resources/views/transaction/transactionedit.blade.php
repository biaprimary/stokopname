@extends('layout.appdashboard')
@section('content')

@include('shared.navbar')

<div id="wrapper">
  @include('shared.sidebar')
  <div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <h5>Edit</h5>
          </div>
          <div class="card-body">
            {!! Form::open(array('route' => array('transactions.update',$transactiondetail->id), 'method'=>'put')) !!}
            <table class="table-edit">
              <tr>
                <td width="15%">Buyer</td>
                <td>
                  <select name="id_buyer" class="form-control" id="id_buyeredit">
                    @foreach ($buyer as $buyer)
                      @if ($transactiondetail->transaction->id_buyer == $buyer->user->id)
                      <option value="{{ $buyer->user->id }}" selected>{{ $buyer->user->name }}</option>
                      @else
                      <option value="{{ $buyer->user->id }}">{{ $buyer->user->name }}</option>
                      @endif
                    @endforeach
                  </select>
                  <div class="text-danger">{!! $errors->first('id_buyer') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Transaction Date</td>
                <td>
                  <select name="id_transaction" class="form-control" id="id_transaction">
                    @foreach ($transaction as $transaction)
                      @if ($transactiondetail->transaction->id_transaction == $transaction->id)
                      <option value="{{ $transaction->id }}" selected>{{ dateConversion($transaction->created_at) }}</option>
                      @else
                      <option value="{{ $transaction->id }}">{{ dateConversion($transaction->created_at) }}</option>
                      @endif
                    @endforeach
                    <option value="new">Add New</option>
                  </select>
                  <div class="text-danger">{!! $errors->first('id_transaction') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Item</td>
                <td>
                  <select name="id_item" class="form-control" id="id_item">
                    @foreach ($item as $item)
                      @if ($transactiondetail->id_item == $item->id)
                      <option value="{{ $item->id }}" selected>{{ $item->name_item }}</option>
                      @else
                      <option value="{{ $item->id }}">{{ $item->name_item }}</option>
                      @endif
                    @endforeach
                  </select>
                  <div class="text-danger">{!! $errors->first('id_item') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Quantity</td>
                <td>
                  {!! Form::number('qty', $transactiondetail->qty, array('class' => 'form-control', 'min' => '1', 'max' => $transactiondetail->item->stock_item, 'id' => 'qtyedit')) !!}
                  <div class="text-danger">{!! $errors->first('qty') !!}</div>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="right">{!! Form::submit('Update', array('class' => 'btn btn-success')) !!}</td>
              </tr>
            </table>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      @include('shared.footer')




  </div>
</div>

@endsection
