@extends('layouts.admin')
@section('title', 'ニュースの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ニュース編集</h2>
                <form action="{{ action('NewsController@update') }}" method="post" enctype="multipart/form-data">
                    <div style="text-align: right">
                        <div class="chkbox">
                              <input type="checkbox" id="chkbox01" name="checkhikoukai" value="1" {{ $news_form->checkhikoukai === 1 ? "checked" : '' }}>
　　　　　　　　            <label for="chkbox01">非公開</label>
                        </div>
                    </div>
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル</label>
                        <div class="col-md-10">
                            <input maxlength='30' type="text" class="form-control" name="title" value="{{ $news_form->title }}">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <img src="{{ secure_asset("storage/image/".$news_form->image_path) }}" />
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $news_form->image_path }}
                            </div>
                        　　<div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                         </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">本文</label>
                        <div class="col-md-10">
                            <textarea maxlength='200' class="form-control" name="body"  rows="10">{{ $news_form->body }}</textarea>
                        </div>
                    </div>
                    <div style="text-align: right">
                            <input type="hidden" name="id" value="{{ $news_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


