@extends('layout.appdashboard')
@section('content')

@include('shared.navbar')

<div id="wrapper">
  @include('shared.sidebar')
  <div id="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h1>Welcome</h1><br>
          <h3><i>Choose Menu from left Sidebar</i></h3>
        </div>
      </div>
    </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      @include('shared.footer')


  </div>
</div>

@endsection
