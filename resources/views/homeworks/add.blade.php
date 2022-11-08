@extends('layouts.index')

@section('title', 'Thêm bài tập về nhà')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Thêm bài tập về nhà</h1>

<!-- DataTales Example -->
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('homework.add') }}" method="POST" enctype="multipart/form-data">

            @csrf
            
            <div class="form-group">
                <label for="title">Tiêu đề: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Nhập tiêu đề" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="homework">Tập tin: <span class="text-danger">*</span></label>
                <input type="file" id="homework" name="homework" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
          </form>
    </div>
</div>
@endsection
