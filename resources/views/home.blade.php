@extends('layouts.default')
@section('content')
    @auth
        <form action="{{route('blog.store')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    发布博客
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">内容</label>
                        <textarea class="form-control" name="content" rows="3"></textarea>
                    </div>

                </div>
                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-success">发布</button>
                </div>
            </div>
        </form>
    @endauth
    <div class="card  mt-3">
        <div class="card-header">
            博客列表
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{$blog->content}}
                        </td>

                        <td>
                            @auth
                            <a href="{{route('user.show',$blog->user)}}">{{$blog->user->name}}</a>
                                @endauth
                        </td>
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
        <div class="card-footer text-muted">
            {{$blogs->links()}}
        </div>
    </div>
@endsection
