<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop</title>

    <!-- Bootstrap core CSS-->
    <link href="{{URL::asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('css/fontawesome/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{URL::asset('css/sb-admin.min.css')}}" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="{{URL::asset('css/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <link href="{{URL::asset('css/custom.css')}}" rel="stylesheet">

    <link href="{{URL::asset('css/jquery-ui.min.css')}}" rel="stylesheet">

  </head>

  <body id="page-top">

    @yield('content')

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
    <script src="{{URL::asset('js/datatables-js.js')}}"></script>

    <script src="{{URL::asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{URL::asset('js/moment.min.js')}}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '.pagination a', function(e) {
        get_page($(this).attr('href').split('page=')[1]);
        e.preventDefault();
      });

      $(document).on('click', '.buy', function(e) {
        var qty = $(this).closest('.buy-table').find('input[name="qty"]');
        var id = $(this).closest('.buy-table').find('input[name="qty"]').data('id');
        console.log(qty.val(), id);
        e.preventDefault();
        $.ajax({
         url: "setitem",
         data: {
           'id' : id,
           'qty' : qty.val()
        },
         success : function(data) {
           console.log('sukses');
           document.getElementById("noticex").innerHTML = "Item Added";
           setTimeout(function(){
              document.getElementById("noticex").innerHTML = "";
          }, 10000);
         },
         error : function(xhr, status, error) {
           console.log(xhr.error + "\n ERROR STATUS : " + status + "\n"+ error);
         }
        });
      });
    });

    function delay(callback, ms) {
      var timer = 0;
      return function() {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
          callback.apply(context, args);
        }, ms || 0);
      };
    }

    function get_page(page) {
       $.ajax({
         url : 'shopping?page=' + page,
         type : 'GET',
         dataType : 'json',
         data : {
           'category' : $('#id_category').val(),
           'sort' : $('#sort').val(),
           'search' : $('#search').val()
         },
         success : function(data) {
           $('#ajax-render').html(data['view']);
         },
        error : function(xhr, status, error) {
          console.log(xhr.error + "\n ERROR STATUS : " + status + "\n"+ error);
        },
        complete : function() {
          alreadyloading = false;
        }
      });
     }

    $("#id_category").change(function(){
      var id = $(this).val();
      $.ajax({
        url: "shopping",
        type: "GET",
        dataType: "json",
        data : {
          'category' : $('#id_category').val(),
          'sort' : $('#sort').val(),
          'search' : $('#search').val()
        },
        success: function(data)
        {
          console.log(data);
          $("#ajax-render").html(data['view']);
        },
        error : function(xhr, status, error) {
          console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
        }
      });
    });

    $("#sort").change(function(){
      var id = $(this).val();
      $.ajax({
        url: "shopping",
        type: "GET",
        dataType: "json",
        data : {
          'category' : $('#id_category').val(),
          'sort' : $('#sort').val(),
          'search' : $('#search').val()
        },
        success: function(data)
        {
          console.log(data);
          $("#ajax-render").html(data['view']);
        },
        error : function(xhr, status, error) {
          console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
        }
      });
    });

    $('#search').keyup(delay(function (e) {
      var id = $(this).val();
      $.ajax({
        url: "shopping",
        type: "GET",
        dataType: "json",
        data : {
          'category' : $('#id_category').val(),
          'sort' : $('#sort').val(),
          'search' : $('#search').val()
        },
        success: function(data)
        {
          console.log(data);
          $("#ajax-render").html(data['view']);
        },
        error : function(xhr, status, error) {
          console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
        }
      });
    }, 500));

    $("#id_item").change(function(){
      var id = $(this).val();
      var url;
      if(document.getElementById("qty")){
        id_element = "qty";
        url = '../itemcheckstock/'+id;
      }else {
        id_element = "qtyedit";
        url = '../../itemcheckstock/'+id;
      }
      $.ajax({
        url: url,
        type:"GET",
        dataType:"json",
        success: function(data)
        {
          console.log(data.stock_item);
          $('#'+id_element).val(data.stock_item);
          document.getElementById(id_element).max = data.stock_item;
        },
        error : function(xhr, status, error) {
          console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
        }
      });
    });

    $("#id_buyer, #id_buyeredit").change(function(){
      var id = $(this).val();
      var url;
      if(document.getElementById("id_buyer")){
        url = '../checktransaction/'+id;
      }else {
        url = '../../checktransaction/'+id;
      }

      $.ajax({
        url: url,
        type:"GET",
        dataType:"json",
        success: function(data)
        {
          console.log(data);
          $('#id_transaction').empty();
          $.each(data, function(index, obj){
            var datecreated = moment(obj.created_at).format("DD MMMM YYYY");
            $('#id_transaction').append('<option value="'+obj.id+'">'+datecreated+'</option>');
          });
          $('#id_transaction').append('<option value="new">Add New</option>');
        },
        error : function(xhr, status, error) {
          console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
        }
      });
    });
    </script>
  </body>

</html>
