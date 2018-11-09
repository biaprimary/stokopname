@extends('layout.application')
@section('content')

<div class="container">
  <div class="card card-login mx-auto mt-5">
    <div class="card-header text-center">Sign Up</div>
    <div class="card-body">
      {!! Form::open(['route' => 'signup.store', 'class' => 'form-horizontal','role' => 'form']) !!}
      <div class="form-group">
        <div class="form-label-group">
         {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Your Name', 'id' => 'name')) !!}
         <label for="name">Name</label>
         <div class="text-danger">{!! $errors->first('name') !!}</div>
       </div>
      </div>
      <div class="form-group">
        <div class="form-label-group">
         {!! Form::text('phone', null, array('class' => 'form-control', 'placeholder' => 'Your Phone Number', 'id' => 'phone')) !!}
         <label for="phone">Phone</label>
         <div class="text-danger">{!! $errors->first('phone') !!}</div>
        </div>
      </div>
      <div class="form-group">
        <div class="form-label-group">
         {!! Form::text('address', null, array('class' => 'form-control', 'placeholder' => 'Your Home Address', 'id' => 'address')) !!}
         <label for="address">Address</label>
         <div class="text-danger">{!! $errors->first('address') !!}</div>
       </div>
      </div>
      <div class="form-group">
        <div class="form-label-group">
         {!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Your Email Address', 'id' => 'username-email')) !!}
         <label for="username-email">E-mail</label>
         <div class="text-danger">{!! $errors->first('email') !!}</div>
       </div>
      </div>
      <div class="form-group">
        <div class="form-label-group">
         {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'id' => 'username-password')) !!}
         <label for="username-password">Password</label>
         <div class="text-danger">{!! $errors->first('password') !!}</div>
       </div>
      </div>
      <div class="form-group">
        <div class="form-label-group">
          <select name="role" id="username-role" class="form-control">
          <option value=""> -- Select -- </option>
          @foreach ($role as $role)
          <option value="{{$role->name}}">{{$role->name}}</option>
          @endforeach
          </select>
         <div class="text-danger">{!! $errors->first('role') !!}</div>
       </div>
      </div>
      <div class="form-group">
         {!! Form::submit('Sign Up', array('class' => 'btn btn-primary btn-block')) !!}
      </div>
        <!-- <div class="text-center">
        <a class="d-block small mt-3" href="register.html">Register an Account</a>
      </div> -->
      <div class="text-center">
        {!! link_to(route('login'), 'Have an Account', array('class' => 'd-block small mt-3')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection
