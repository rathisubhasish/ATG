@extends('master')

@section('content')
<div class="col-sm-8">
<h3>Register User</h3>

@if(Session::get('register_status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{Session::get('register_status')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
@endif
<form action="registerUser" method="post" return="false">
    <div class="form-group">
        <label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name" required>
    </div>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @csrf
    
    <div class="form-group">
    <label>
    <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required>
    </div>
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
    <label>
    <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password" required>
    </div>
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection 