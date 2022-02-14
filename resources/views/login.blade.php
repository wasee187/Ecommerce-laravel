@extends('master')
@section('content')
<div class="container d-flex justify-content-center custom-login-form">
    <div class="row">
        <h2 class="login-h mt-3">Login</h2>
        <div class="col-lg-12">
            <form>
                <div class="form-group">
                  <label for="inputEmail4" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="form-group">
                  <label for="inputPassword4" class="form-label">Password</label>
                  <input type="password" class="form-control" id="inputPassword4">
                </div>
            
                <div class="col-12 mt-3">
                  <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
              </form>
        </div>
    </div>
</div>
@endsection