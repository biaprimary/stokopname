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
            {!! Form::open(array('route' => 'items.store', 'method'=>'post')) !!}
            {!! Form::hidden('id_user', $userid->id, array('class' => 'form-control')) !!}
            <table class="table-edit">
              <tr>
                <td>Name</td>
                <td>
                  {!! Form::text('name_item', null, array('class' => 'form-control')) !!}
                  <div class="text-danger">{!! $errors->first('name_item') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Category</td>
                <td>
                  <select name="id_category" class="form-control">
                    <option value="">-- Select --</option>
                    @foreach ($category as $category)
                      <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                    @endforeach
                  </select>
                  <div class="text-danger">{!! $errors->first('id_category') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Stock</td>
                <td>
                  {!! Form::number('stock_item', null, array('class' => 'form-control', 'min' => '0')) !!}
                  <div class="text-danger">{!! $errors->first('stock_item') !!}</div>
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
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      @include('shared.footer')




  </div>
</div>

@endsection
