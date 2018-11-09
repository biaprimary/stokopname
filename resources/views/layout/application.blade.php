<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap core CSS-->
    <link href="{{URL::asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('css/fontawesome/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{URL::asset('css/sb-admin.min.css')}}" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="{{URL::asset('css/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      @yield('content')
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{URL::asset('js/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{URL::asset('js/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Page level plugin JavaScript-->
    <script src="{{URL::asset('js/jquery/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{URL::asset('js/sb-admin.min.js')}}"></script>

    <!-- Demo scripts for this page-->
    <script src="{{URL::asset('js/datatables-demo.js')}}"></script>

  </body>

</html>
