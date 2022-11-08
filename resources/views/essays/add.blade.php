@extends('layouts.index')

@section('title', 'Thêm mới câu đố')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Thêm mới câu đố</h1>
@if(Session::has('invalid'))
    <div class="alert alert-danger alert-dismissible">
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{Session::get('invalid')}}
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible">
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{Session::get('success')}}
    </div>
@endif
<!-- DataTales Example -->
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('essay.add') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="tip">Gợi ý: <span class="text-danger">*</span></label>
                <textarea class="form-control" name="tip" id="tip" rows="3" cols="10" required></textarea>
            </div>
            <div class="form-group">
                <label for="essay">Tập tin: <span class="text-danger">*</span></label>
                <input type="file" id="essay" name="essay" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
          </form>
    </div>
</div>
@endsection
