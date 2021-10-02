@extends('layouts.admin')
@section('title', '登録済みニュースの一覧')

@section('content')
        
         <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ action('NewsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
                </div>
                <div class="col-md-8">
                    <form action="{{ action('NewsController@index') }}" method="get">
                        <div class="form-group row">
                             <label><input type="checkbox"  name="hihyoujijoutai"  />非表示中</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="cond_title" value={{ $cond_title }}>
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                        
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                    <link href="{{ asset('css/news.css') }}" rel="stylesheet">
                    @foreach($posts as $news)
                    <div class='col-md-4' style="padding-top:50px;">
                        @if($news->checkhikoukai == 1 )
                            <div class="chkbox" style="background-color:blue">非表示</div>
                        @endif
                        <a href="{{ action('NewsController@edit', ['id' => $news->id]) }}">
                            @if ($news->image_path == null)
                                <img src="{{ secure_asset('storage/image/noimage_m.jpg') }}" alt="{{ str_limit($news->title, 100) }}" width="300" height="250">
                            @else
                                <img src="{{ secure_asset('storage/image/'.$news->image_path) }}" alt="{{ str_limit($news->title, 100) }}" width="300" height="250">
                            @endif
                            <h5 style="text-align:center; width:300px; ">{{ str_limit($news->title, 100) }}</h5>
                        </a>
                    </div>
                    @endforeach
            </div>
        </div>
        <div class="col-sm-8" style="text-align:right; padding-left:380px;">
                <div class="paginate">
                    {{ $posts->appends(Request::only('cond_title'))->links() }}
                </div>
        </div>
@endsection
