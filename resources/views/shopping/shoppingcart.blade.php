@extends('layout.appdashboard')
@section('content')

@include('shared.navbarshopping')
<div id="wrapper">

  <div id="content-wrapper">
      <div class="container-fluid">
            <div class="card mb-12">
              <div class="card-header">
                <h3>Buyer Information</h3>
              </div>
              <div class="card-body">
            <table width="100%">
              <tr>
                <td width="15%"><h5>Name</h5></td>
                <td><h5>: <b>{{ $user->name }}</b></h5></td>
              </tr>
              <tr>
                <td><h5>Address</h5></td>
                <td><h5>: <b>{{ $user->address }}</b></h5></td>
              </tr>
              <tr>
                <td><h5>Phone</h5></td>
                <td><h5>: <b>{{ $user->phone }}</b></h5></td>
              </tr>
            </table>
          </div>
          </div>
          <br>
          <div class="card mb-12">
            <div class="card-header">
              <h3>Items</h3>
            </div>
            <div class="card-body">
          <table width="100%">
            <tr>
              <td width="40%"><b>Item</b></td>
              <td width="20%"><b>Category</b></td>
              <td width="20%"><b>Seller</b></td>
              <td width="20%"><b>Quantity</b></td>
              <td width="5%"><b>Hapus</b></td>
            </tr>
            @foreach ($itemdetail as $key => $itemdetail)
            <tr>
              <td>{{ $itemdetail->name_item }}</td>
              <td>{{ $itemdetail->category->name_category }}</td>
              <td>{{ $itemdetail->user->name }}</td>
              <td>{{ $qty_item[$key] }}</td>
              <td><a href="deleteitem/{{$itemdetail->id}}"<i class="fas fa-trash fa-fw"></i></a></td>
            </tr>
            @endforeach
            <tr>
              <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="5">
                <a href="buy" class="btn btn-primary active float-right">
                    <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Buy
                </a>
              </td>
            </tr>
          </table>
        </div>
        </div>
      <!-- /.container-fluid -->
      <!-- Sticky Footer -->
      @include('shared.footershopping')
  </div>
</div>

@endsection
