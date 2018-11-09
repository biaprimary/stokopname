@extends('layout.appdashboard')
@section('content')

@include('shared.navbarshopping')
<div id="wrapper">

  <div id="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 text-center">
            <br>
            <br>
            <hr>
            <h1>Thank You</h1>
            <hr>
            <br>
            <a href="shopping" class="btn btn-primary active">
                <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Shop Again
            </a>
          </div>
        </div>
        <br>

      </div>


      <!-- /.container-fluid -->
      <!-- Sticky Footer -->
      @include('shared.footershopping')
  </div>
</div>

@endsection
