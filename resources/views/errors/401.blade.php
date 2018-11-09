@extends('layout.appdashboard')
@section('content')

@include('shared.navbar')

<div id="wrapper">
  @include('shared.sidebar')
  <div id="content-wrapper">
      <div class="container-fluid">
        <div class="col-md-12 text-center">
          <br>
          <br>
          <br>
          <br>
          <h1>401</h1> <br><h2>Unauthorized</h2><br>
            <h3><i>You Don't Have Privilege</i></h3>

        </div>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      @include('shared.footer')
  </div>
</div>

@endsection
