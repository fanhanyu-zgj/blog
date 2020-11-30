@extends('layouts.default')
@section('content')

    <div class="card">
        <div class="card-header">
            <h1 class="text-center">{{$user->name}}</h1>
            <div class="text-center">
                <a href="{{route('following',$user)}}" class="btn btn-success">关注：{{$user->following()->count()}}</a>
                <a href="{{route('follower',$user)}}" class="btn btn-success">粉丝：{{$user->follower()->count()}}</a>
            </div>
            @can('follower',$user)
            <div class="text-center">
                <a href="{{route('user.follow',$user)}}" class="btn btn-success">
                    {{$followTitle}}
                </a>
            </div>
            @endcan

        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{$blog->content}}
                        </td>
                        <td>{{$blog->user->name}}</td>
                        <td>
                            @can('delete',$blog)
                                <form action="{{route('blog.destroy',$blog)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">删除</button>
                                </form>
                            @endcan</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{$blogs->links()}}
        </div>
    </div>
@endsection