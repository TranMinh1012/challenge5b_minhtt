@extends('layouts.index')

@section('title', 'Cập nhật bài tập về nhà')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Cập nhật bài tập về nhà</h1>

<!-- DataTales Example -->
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('homework.edit', ['id' => $homework->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="title">Tiêu đề: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Nhập tiêu đề" id="title" name="title" value="{{ $homework->title }}" required>
            </div>
            <div class="form-group">
                <label for="homework">Tập tin:</label>
                <input type="file" id="homework" name="homework">
            </div>
            <div class="d-block mb-3">
                <span class="mr-1">Bài tập đã giao:</span><a href="{{ asset($homework->homework_file) }}" download>{{ basename($homework->homework_file) }}</a>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
          </form>
    </div>
</div>
@endsection
