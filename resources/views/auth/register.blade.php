@extends('master')

@section('content')

<style>

body{
    /* background:lightblue; */
    background-image:url('images/wall.png');
}


.form-control{
    text-align:center;
    outline:none;
    border:none;
}

</style>
<div class="col-sm-8">

@if(Session::get('register_status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{Session::get('register_status')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
@endif
    
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <div class="card shadow-lg  bg-white rounded" style="width: 22rem; height: 25rem; margin:auto; top:10%; border-radius:10px;">
    <img class="card-img-top" src="images/atg.png" style="width:50px; align:center" alt="Card image cap">
    <h3 style="text-align:center ; padding: -10px 0px 20px 10px; font-family:fantasy"><b><u>Registration</u></b></h3>

    <form action="registerUser" method="post" return="false" style="margin:auto;">
    @csrf
    <div class="form-group">
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" style="width:100%;" placeholder="Name" required>
    </div>
    
    
    <div class="form-group">
    <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" style="width:100%;"required>
    </div>
    <div class="form-group">
    <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password" style="width:100%;" required>
    </div>
    <br>
    <div class="text-center">
    <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>
</div>
</div>
@endsection 