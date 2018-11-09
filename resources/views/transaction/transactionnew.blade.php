@extends('layout.appdashboard')
@section('content')

@include('shared.navbar')

<div id="wrapper">
  @include('shared.sidebar')
  <div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <h5>New</h5>
          </div>
          <div class="card-body">
            {!! Form::open(array('route' => 'transactions.store', 'method'=>'post')) !!}
            <table class="table-edit">
              <tr>
                <td width="15%">Buyer</td>
                <td>
                  <select name="id_buyer" class="form-control" id="id_buyer">
                    <option value="">-- Select --</option>
                    @foreach ($buyer as $buyer)
                      <option value="{{ $buyer->user->id }}">{{ $buyer->user->name }}</option>
                    @endforeach
                  </select>
                  <div class="text-danger">{!! $errors->first('id_buyer') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Transaction Date</td>
                <td>
                  <select name="id_transaction" class="form-control" id="id_transaction">
                    <option value="">-- Select --</option>
                  </select>
                  <div class="text-danger">{!! $errors->first('id_transaction') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Item</td>
                <td>
                  <select name="id_item" class="form-control" id="id_item">
                    <option value="">-- Select --</option>
                    @foreach ($item as $item)
                      <option value="{{ $item->id }}">{{ $item->name_item }}</option>
                    @endforeach
                  </select>
                  <div class="text-danger">{!! $errors->first('id_item') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Quantity</td>
                <td>
                  {!! Form::number('qty', null, array('class' => 'form-control', 'min' => '1', 'id' => 'qty')) !!}
                  <div class="text-danger">{!! $errors->first('qty') !!}</div>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="right">{!! Form::submit('Save', array('class' => 'btn btn-success')) !!}</td>
              </tr>
            </table>
            {!! Form::close() !!}
          </div>
        </div>
      </div>

      <div id="ulala"></div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      @include('shared.footer')




  </div>
</div>

@endsection
