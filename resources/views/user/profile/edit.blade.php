@extends('layouts.profile')
@section('title', 'プロフィール')
@section('profile_color',  $profile->profile_color  )
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto" style="background-color:black; padding-left: 50px; padding-right: 50px;">
                <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
                <h2>プロフィール設定</h2>
                
                <form action="{{ action('ProfileController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="image">プロフィール画像</label>
                        <div class="col-md-10">
                            @if ($profile->profile_image == null)
                            <img src="{{ secure_asset('storage/image/noimage_m.jpg') }}" class="avatar" width="120" height="120">
                            @else
                            <img src="{{ secure_asset("storage/image/".$profile->profile_image) }}" class="avatar" width="120" height="120">
                            @endif
                            <input type="file" class="form-control-file" name="image"> 
                    　　　　<div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                         </div>
                    </div>
                    
                    <div class="form-group row profile-name">
                        <label class="col-md-2" for="name">名前</label>
                        <div class="h5">
                            <input type="text" class="form-control" name="name" maxlength='8' value="{{ $profile->name }}">
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <label class="col-md-2" for="body">自己紹介</label>
                        <textarea maxlength='200' class="form-control" name="body"  rows="10" >{{ $profile->body }}</textarea>
                    </div>
                    <div style="text-align: center">
                        <input type="color" name="profile_color" value="{{ $profile->profile_color }}">
                        <label for="body">背景色</label>
                    </div>
                    <div style="text-align: right; margin: 55px 20px;">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="更新">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
