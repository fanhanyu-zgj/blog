@extends('layouts.default')
@section('content')
    <form action="{{route('findPasswordUpdate')}}" method="post">
        <input type="text" name="token" hidden value="{{$user->email_token}}">
        @csrf
        <div class="card">
            <div class="card-header">
                重置密码
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label >邮箱</label>
                    <input type="text" name="email" value="{{$user->email}}" disabled class="form-control">
                </div>
                <div class="form-group">
                    <label >密码</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label >确认密码</label>
                    <input type="password" name="password_confirmation"  class="form-control">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success">确认更新</button>
            </div>
        </div>
    </form>
@endsection