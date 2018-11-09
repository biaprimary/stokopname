@extends('layout.appdashboard')
@section('content')

@include('shared.navbarshopping')
<div id="wrapper">

  <div id="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h5 class="float-right"><i><b id="noticex"></b></i></h5>
            <br><br>
            <table width="100%">
              <tr>
                <td>Category :</td>
                <td>Sort :</td>
                <td>Search :</td>
              </tr>
              <tr>
                <td style="vertical-align: top">
                  <select name="id_category" class="form-control" style="width: 50%" id="id_category">
                    <option value="">All Category</option>
                    @foreach ($category as $category)
                      <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                    @endforeach
                  </select>
                </td>
                <td style="vertical-align: top">
                  <select name="sort" class="form-control" style="width: 50%" id="sort">
                    <option value="asc">A - Z</option>
                    <option value="desc">Z - A</option>
                  </select>
                </td>
                <td>
                  {!! Form::text('search', null, array('class' => 'form-control', 'style' => 'margin-bottom:5px', 'id' => 'search', 'placeholder' => 'Type Item Name')) !!}
                </td>
              </tr>
            </table>
          </div>
        </div>
        <hr>
        <br>
        <div class="row" id="ajax-render">
          @foreach ($items as $item)
          <div class="col-md-4">
            <div class="card mb-3">
              <div class="card-header">
                <h6>{{$item->name_item}}</h6>
              </div>
              <div class="card-body">
                <table class="buy-table">
                  <tr>
                    <td style="padding-bottom:20px; width: 30%;"><img src="{{URL::asset('/img/book.png')}}" width="100%"></td>
                    <td style="vertical-align: top; padding-left:20px">
                      <table width="100%">
                      <tr>
                        <td>Name</td>
                        <td>: {{$item->name_item}}</td>
                      </tr>
                      <tr>
                        <td>Category</td>
                        <td>: {{$item->id_category}}</td>
                      </tr>
                      <tr>
                        <td>Seller:</td>
                        <td>: {{$item->id_user}}</td>
                      </tr>
                      <tr>
                        <td>Qty</td>
                        <td>{!! Form::number('qty', 1, array('class' => 'form-control', 'min' => '1', 'max' => $item->stock_item, 'id' => 'addtocart', 'data-id' => $item->id)) !!}</td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><button class="float-right btn btn-primary buy" id="buy">Add to Cart</button></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          @endforeach
          <div class="col-md-12 text-center">
            {{ $items->links() }}
          </div>
      </div>
      </div>

      <div id="tes">
      </div>
      <!-- /.container-fluid -->
      <!-- Sticky Footer -->
      @include('shared.footershopping')
  </div>
</div>

@endsection
