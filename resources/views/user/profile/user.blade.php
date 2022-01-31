{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.profile')
@section('title', 'プロフィール')
@section('profile_color', $profile->profile_color)
{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto" style="background-color:black; padding-left: 50px;">
                <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
                <h2>筆者プロフィール</h2>
                <div>
                    @if ($profile->profile_image == null)
                    <img src="{{ secure_asset('storage/image/noimage_m.jpg') }}" class="avatar" width="120" height="120">
                    @else
                    <img src="{{ secure_asset('storage/image/'.$profile->profile_image) }}" class="avatar" width="120" height="120">
                    @endif
                </div>
                <div class="form-group row profile-name">
                    <label class="col-md-2">名前</label>
                    <div class="h5" maxlength='8'>
                            {{ $profile->name }}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">自己紹介</label>
                    <div class="text-profilebody">{!! nl2br(($profile->body)) !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
