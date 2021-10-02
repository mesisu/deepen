@extends('layouts.admin')
@section('title', '登録済みニュースの一覧')
@section('content')
    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
            <td>{{ $news->title }}</td>
            <td>{{ $news->id }}</td>
            <td>{{ $news->body }}</td>
            <td>{{ $news->image_path }}</td>
            </h1>
        </div>
    </div>
@endsection