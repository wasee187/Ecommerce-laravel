@extends('master')
@section('content')
<div class="container d-flex justify-content-center custom-login-form">
    <div class="row">
        <h2 class="login-h mt-3">Login</h2>
        <div class="col-lg-12">
          @if(session('log_error'))
            <p class="err-msg">{{session('log_error')}}</p>
          @endif
            <form action='login' method='POST'>
                <div class="form-group">
                  @csrf
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name='email' class="form-control" id="email" value="{{old("email")}}">
                  <span class="err-msg">@error('email'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name='password' class="form-control" id="password">
                  <span class="err-msg">@error('password'){{$message}}@enderror</span>
                </div>
            
                <div class="col-12 mt-3">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </form>
        </div>
    </div>
</div>
@endsection