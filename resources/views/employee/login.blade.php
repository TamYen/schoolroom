<!-- login.blade.php -->

@extends('master')
@section('content')
<div class="container">
  <form method="post" action="">
    <div class="form-group row">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Nhập email" name="email">
      </div>
    </div>  
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Password</label>
      <div class="col-sm-10">
      <input type="password" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Nhập password" name="password">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary" value="Đăng nhập">
    </div>
  </form>
</div>
@endsection