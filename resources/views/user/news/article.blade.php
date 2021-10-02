@extends('layouts.admin')
@section('title','記事詳細')
@section('content')
    <div class="container mt-4">
        <div class="border p-5">
            <link href="{{ asset('css/news.css') }}" rel="stylesheet">
            <h2 class="h5 mb-4">
                {{ $news->title }}
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
                    @if($news->image_path == null)
                    <td><img src="{{ secure_asset('storage/image/noimage_m.jpg') }}" alt="{{ str_limit($news->title, 100) }}" width="300" height="250"></td>
                    @else
                    <td><img src="{{ secure_asset('storage/image/'.$news->image_path) }}" width="300"></td>
                    @endif
                    <td>&nbsp;</td>
                    <td class="text-newsbody">{!! nl2br(e($news->body)) !!}</td>
                </tr>
            </table>
                {{ $news->count }}
        </div>
    </div>
    
    
@endsection


