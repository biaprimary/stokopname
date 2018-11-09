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
            {!! Form::open(array('route' => 'categories.store', 'method'=>'post')) !!}
            <table class="table-edit">
              <tr>
                <td>Category Name :</td>
                <td>
                  {!! Form::text('name_category', null, array('class' => 'form-control')) !!}
                  <div class="text-danger">{!! $errors->first('name_category') !!}</div>
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
