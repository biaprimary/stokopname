@extends('layout.appdashboard')
@section('content')

@include('shared.navbar')

<div id="wrapper">
  @include('shared.sidebar')
  <div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <h5>Report</h5>
          </div>
          <div class="card-body">
            {!! Form::open(array('route' => 'reportdownload','method'=>'post', 'target' => '_blank')) !!}
            <table width="100%">
            <tr>
              <td>Item</td>
              <td>
                <select name="id_item" class="form-control" id="id_item">
                  <option value="all">-- All Item --</option>
                  @foreach ($item as $item)
                    <option value="{{ $item->id }}">{{ $item->name_item }}</option>
                  @endforeach
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="right">{!! Form::submit('View', array('class' => 'btn btn-success')) !!}</td>
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
