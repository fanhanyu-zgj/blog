@extends('layouts.default')
@section('content')
    <div class="card  mt-3">
        <div class="card-header">
            {{$title}}
        </div>
        <div class="card-body">
            @foreach($users as $user)
                <a href="{{route('user.show',$user)}}">{{$user->name}}</a>
            @endforeach
        </div>
        <div class="card-footer text-muted">
            {{$users->links()}}
        </div>
    </div>
@endsection
