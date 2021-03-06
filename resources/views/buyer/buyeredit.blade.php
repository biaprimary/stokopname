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
            {!! Form::open(array('route' => array('buyers.update',$buyer->user->id), 'method'=>'put')) !!}
            <table class="table-edit">
              <tr>
                <td>Name :</td>
                <td>
                  {!! Form::text('name', $buyer->user->name, array('class' => 'form-control')) !!}
                  <div class="text-danger">{!! $errors->first('name') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Email</td>
                <td>
                  {!! Form::text('email', $buyer->user->email, array('class' => 'form-control')) !!}
                  <div class="text-danger">{!! $errors->first('email') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Password</td>
                <td>
                  {!! Form::password('password', array('class' => 'form-control')) !!}
                  <div class="text-secondary font-italic"><sub>***Leave Blank for Unchanged Password</sub></div>
                  <div class="text-danger">{!! $errors->first('password') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>
                  {!! Form::text('phone', $buyer->user->phone, array('class' => 'form-control')) !!}
                  <div class="text-danger">{!! $errors->first('phone') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Address</td>
                <td>
                  {!! Form::text('address', $buyer->user->address, array('class' => 'form-control')) !!}
                  <div class="text-danger">{!! $errors->first('address') !!}</div>
                </td>
              </tr>
              <tr>
                <td>Role</td>
                <td>
                  <select name="role" id="username-role" class="form-control">
                    @foreach ($role as $role)
                      @if ($buyer->role->name == $role->name)
                            <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                      @else
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                      @endif
                    @endforeach
                  </select>
                  <div class="text-danger">{!! $errors->first('role') !!}</div>
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
