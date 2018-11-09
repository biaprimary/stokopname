@extends('layout.appdashboard')
@section('content')

@include('shared.navbar')

<div id="wrapper">
  @include('shared.sidebar')
  <div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <h5>Transaction List</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <a class="btn btn-primary btn-md active" href="{{route('transactions.create')}}">Add New</a>
              <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Buyer</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transactions as $transactions)
                  <tr>
                    <td>{{$transactions->transaction->buyer['name']}}</td>
                    <td>{{$transactions->item->name_item}}</td>
                    <td>{{$transactions->qty}}</td>
                    <td>{{dateConversion($transactions->created_at)}}</td>
                    <td>{!! Form::open(array('route' => array('transactions.edit',$transactions->id), 'method'=>'get')) !!}
                        {!! Form::submit('Edit', array('class' => 'btn btn-success btn-sm')) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>{!! Form::open(array('route' => array('transactions.destroy',$transactions->id), 'method'=>'delete')) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("Are you sure you want to delete this data?")')) !!}
                        {!! Form::close() !!}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      @include('shared.footer')
  </div>
</div>

@endsection
