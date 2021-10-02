@extends('layouts.admin')
@section('title', 'ニュースの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                    <h2>ニュース新規作成</h2>
                <form action="{{ action('NewsController@create') }}" method="post" enctype="multipart/form-data">
                    <div style="text-align: right">
                        <div class="chkbox">
                            <input type="checkbox" id="chkbox01" name="checkhikoukai" value=1 />
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
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                            <input maxlength='30' type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                        <div class="form-group row">
                            <label class="col-md-2">画像</label>
                            <div class="col-md-10">
                                <p><input type="file" id="myImage" name="image" accept="image"></p>
　　　　　　　　　　　　        <p>ファイルを選択すると、下にプレビューを表示します。</p>
　　　　　　　　　　　　        <div style="display:inline-block; min-width:200px; min-height:200px; border:5px dashed #eee; padding:10px;">
　　　　　　　　　　　　    <img id="preview" >
　　　　　　　　　　　　        </div>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label class="col-md-2">本文</label>
                        <div class="col-md-10">
                            <textarea maxlength='200' class="form-control" name="body" rows="10">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div style="text-align: right">
                        <input type="submit" class="btn btn-primary" value="保存">
                    </div>
                    <input type="hidden" name="count" value="0">
                </form>
            </div>
        </div>
    </div>
    <script type="module">
        $('#myImage').on('change', function (e) {

            var reader = new FileReader();
            reader.onload = function (e) {
                $("#preview").attr('src', e.target.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
@endsection