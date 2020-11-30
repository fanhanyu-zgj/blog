@extends('layouts.default')
@section('content')
    <form action="{{route('user.store')}}" method="post">
        @csrf
    <div class="card">
        <div class="card-header">
            用户注册
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="">昵称</label>
                <input type="text" name="name"  class="form-control" value="{{old('name')}}">
                <label for="">邮箱</label>
                <input type="text" name="email"  class="form-control" value="{{old('email ')}}">
                <label for="">密码</label>
                <input type="text" name="password"  class="form-control" >
                <label for="">确认密码</label>
                <input type="text" name="password_confirmation"  class="form-control" >
            </div>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-success">注册</button>
        </div>
    </div>
    </form>
@endsection