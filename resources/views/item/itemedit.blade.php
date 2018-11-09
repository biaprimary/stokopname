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
            {!! Form::open(array('route' => array('items.update',$item->id), 'method'=>'put')) !!}
            {!! Form::hidden('id_user', $userid->id, array('class' => 'form-control')) !!}
            <table class="table-edit">
              <tr>
                <td>Name :</td>
                <td>
                  {!! Form::text('name_item', $item->name_item, array('class' => 'form-control')) !!}
                  <div class="text-danger">{!! $errors->first('name_item') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Category</td>
                <td>
                  <select name="id_category" class="form-control">
                    @foreach ($category as $category)
                      @if ($item->id_category == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name_category }}</option>
                      @else
                            <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                      @endif
                    @endforeach
                  </select>
                  <div class="text-danger">{!! $errors->first('id_category') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Stock</td>
                <td>
                  {!! Form::number('stock_item', $item->stock_item, array('class' => 'form-control', 'min' => $item->stock_item)) !!}
                  <div class="text-danger">{!! $errors->first('stock_item') !!}</div>
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
