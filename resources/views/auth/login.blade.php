@extends('layouts.app')

@section('content')
@php 
    $setting = DB::table('settings')->find(1);
@endphp
<div class="row">
      <div class="col s12">
        <div class="container"><div id="login-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8" style="border-radius: 20px !important;">
     <form method="POST" action="{{ url('login_w') }}" method="POST" enctype="multipart/form-data"  class="login-form">
     @csrf
    
      <div class="row margin">
      <center><img src="{{ asset('upload/setting/'.$setting->large_icon) }}" alt="Chris Wood" class="img-fluid" style="height: 90px;max-width: 110%;max-height: 100%;margin-top:40px;margin-bottom:15px" ></center>
          
        @if ($message = Session::get('status'))
            <div class="card-alert card green">
                <div class="card-content white-text">
                  <p>{{ $message }}</p>
                </div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
        @endif
        @if ($message = Session::get('status2'))
            <div class="card-alert card red">
                <div class="card-content white-text">
                  <p>{{ $message }}</p>
                </div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
        @endif

        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="name" type="text"  name="name">
          @if ($errors->has('name'))<small>
            <div class="error">{{ $errors->first('name') }}</div>
          </small>@endif
          <label for="name" class="center-align">Nama User</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" name="password" >
          @if ($errors->has('password'))<small>
            <div class="error">{{ $errors->first('password') }}</div>
          </small>@endif
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12 l12 ml-2 mt-1">
          <p>
            <label>
              <input type="checkbox" name="remember_me" id="remember_me" value="remember_me"/>
              <span>Remember Me</span>
            </label>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-light-blue-cyan col s12">Login</button>
        </div>
      </div>
    </form>
  </div>
</div>
        </div>
        <div class="content-overlay"></div>
      </div>
    </div>

@endsection