@extends('layout.application')
@section('content')

<div class="container">
  <div class="card card-login mx-auto mt-5">
    <div class="card-header text-center">Log In<br><br>
      @if(Session::has('notice'))
          <i>{{Session::get('notice')}}</i>
      @endif
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'login.store', 'class' => 'form-horizontal','role' => 'form']) !!}
      <div class="form-group">
        <div class="form-label-group">
         {!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Your Name', 'id' => 'name')) !!}
         <label for="name">E-mail</label>
         <div class="text-danger">{!! $errors->first('email') !!}</div>
       </div>
      </div>
      <div class="form-group">
        <div class="form-label-group">
         {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Your Password', 'id' => 'password')) !!}
         <label for="password">Password</label>
         <div class="text-danger">{!! $errors->first('password') !!}</div>
       </div>
      </div>
      <div class="form-group">
         {!! Form::submit('Log In', array('class' => 'btn btn-primary btn-block')) !!}
      </div>
        <!-- <div class="text-center">
        <a class="d-block small mt-3" href="register.html">Register an Account</a>
      </div> -->
      <div class="text-center">
        {!! link_to(route('signup'), 'Register an Account', array('class' => 'd-block small mt-3')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection
