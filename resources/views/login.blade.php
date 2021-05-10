@extends('master')
@section('content')

<style>

body{
    /* background:lightblue; */
    background-image:url('images/wall.png');
}

.form-group{
    background-color:white;
}

.form-control{
    text-align:center;
    outline:none;
    border:none;
}

</style>
<div class="col-sm-8">

@if(Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
{{Session::get('error')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
@endif
    <br>
    <br>
    <div class="card shadow-lg  bg-white rounded" style="width: 20rem; height: 20rem; margin:auto; top:30%; border-radius:10px;">
    <img class="card-img-top" src="images/atg.png" style="width:50px; align:center" alt="Card image cap">
    <br>
    <h3 style="text-align:center ; padding: 0 0 20px 0; font-family:fantasy"><b><u>Login</u></b></h3>

    <form action="loginUser" method="post" style="padding:0 40px; box-sizing:border-box;">
    @csrf
    <div class="form-group">
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" style="width:100%;" placeholder="Username" required>
    </div>
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
    <input type="password" name="password" class="form-control" placeholder="Password" style="width:100%" required>
    </div>
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <div class="text-center">
    <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>
</div>
</div>

@endsection