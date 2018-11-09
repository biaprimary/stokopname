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
            {!! Form::open(array('route' => array('categories.update',$category->id), 'method'=>'put')) !!}
            <table class="table-edit">
              <tr>
                <td>Name :</td>
                <td>
                  {!! Form::text('name_category', $category->name_category, array('class' => 'form-control')) !!}
                  <div class="text-danger">{!! $errors->first('name_category') !!}</div>
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
