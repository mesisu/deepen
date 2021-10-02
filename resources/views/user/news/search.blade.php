@extends('layouts.admin')
@section('title', '検索')
@section('content')
         <link href="{{ asset('css/search.css') }}" rel="stylesheet">
        <div class="container mt-4">

            <form action="{{ action('NewsController@search') }}" method="get">
                <div class="form-group row">
                                             
                    <a href="{{ action('NewsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
             
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                    </div>
                    
                    <div class="col-md-2">
                         {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="検索">
                    </div>
                </div>
            </form>
        @foreach($posts as $news)
        @if($news->checkhikoukai == 0)
    <div class="kiji-body" style="padding-top:20px;">
        <table border="0">
            <div class="sample-box"> 
                <a href="{{ url('/user/profile/detail/' .$news->user->id) }}" > 
                @if($news->user->profile->profile_image == null)
                <img src="{{ secure_asset('storage/image/noimage_m.jpg') }}" class="user-image" width="67" height="67">
                @else
                <img src="{{ asset('storage/image/' . $news->user->profile->profile_image) }}" class=user-image width="67" height="67">
                @endif
                </a>
            </div>
            <tr>
                @if ($news->image_path == null)
                <td><img src="{{ secure_asset('storage/image/noimage_m.jpg') }}" alt="{{ str_limit($news->title, 100) }}" width="300" height="250"></td>
                @else
                <td><img class="img-position" src="{{ secure_asset('storage/image/'.$news->image_path) }}" alt="{{ str_limit($news->title, 100) }}" width="300" height="250"></td>
                @endif
                <td><a h5 style="text-align:center; width:300px; vertical-align:top;" href="{{ action('NewsController@show', ['id' => $news->id]) }}">{{ str_limit($news->title, 100) }}
                </a>
                </h5>
                </td>
            </tr>
        </table>
    </div>
    @endif
        @endforeach
            <div class="col-sm-8" style="text-align:right; padding-top:50px;">
                <div class="paginate">
                    {{ $posts->appends(Request::only('cond_title'))->links() }}
                </div>
            </div>
        </div>   
@endsection