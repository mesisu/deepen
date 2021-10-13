@extends('layouts.admin')
@section('title','記事詳細')
@section('content')
    <link href="{{ asset('css/news.css') }}" rel="stylesheet">
    <div class="container mt-4">
        <h2>人気の投稿</h2>
        @foreach($top_news as $news)
        
        <div class="border p-5">
            <h2 class="h5 mb-4">
                <a h5 style="text-align:center; width:300px; vertical-align:top;" href="{{ action('NewsController@show', ['id' => $news->id]) }}">{{ str_limit($news->title, 100) }}
                </a>
            </h2>
            <div class="sample-box"> 
                <a href="{{ url('/user/profile/detail/' .$news->user->id) }}" > 
                @if($news->user->profile->profile_image == null)
                <img src="{{ secure_asset('storage/image/noimage_m.jpg') }}" class="user-image" width="67" height="67">
                @else
                <img src="{{ asset('storage/image/' . $news->user->profile->profile_image) }}" class=user-image width="67" height="67">
                @endif
                </a>
            </div>
            <table>
            <tr>
                 @if ($news->image_path == null)
                <td><img src="{{ secure_asset('storage/image/noimage_m.jpg') }}"width="300"></td>
                @else
                <td><img src="{{ secure_asset('storage/image/'.$news->image_path) }}" width="300"></td>
                @endif
                <td>&nbsp;</td>
                <td class="text-newsbody" style="max-width:600px; max-height:600px;"><p style="overflow-wrap: break-word; word-wrap: break-word;">{!! nl2br(e($news->body)) !!}</p></td>
            </tr>
            </table>
            {{ $news->user->name }}
                {{ $news->count }}
        </div>
        @endforeach
    </div>
@endsection

test


