@extends('layout.appdashboard')
@section('content')

@include('shared.navbar')

<div id="wrapper">
  @include('shared.sidebar')
  <div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <h5>Item List</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <a class="btn btn-primary btn-md active" href="{{route('items.create')}}">Add New</a>
              <a class="btn btn-success btn-md active float-right" href="{{URL::to('downloadtemplate/xls')}}">Download Template</a> <br>
              <form enctype="multipart/form-data" action="{{URL::to('importtemplate')}}" method="post" class="float-right">
              {{csrf_field()}}
              <input type="file" name="import_file">
              <button class="btn btn-primary">Import Template</button>
            </form>  <br>

              <br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Stock</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($item as $item)
                  <tr>
                    <td>{{$item->name_item}}</td>
                    <td>{{$item->category['name_category']}}</td>
                    <td>{{$item->user['name']}}</td>
                    <td>{{$item->stock_item}}</td>
                    <td>{!! Form::open(array('route' => array('items.edit',$item->id), 'method'=>'get')) !!}
                        {!! Form::submit('Edit', array('class' => 'btn btn-success btn-sm')) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>{!! Form::open(array('route' => array('items.destroy',$item->id), 'method'=>'delete')) !!}
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
