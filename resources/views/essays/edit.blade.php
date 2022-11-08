@extends('layouts.index')

@section('title', 'Cập nhật câu đố')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Cập nhật câu đố</h1>
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
        <form action="{{ route('essay.edit', ['id' => $essay->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="tip">Gợi ý: <span class="text-danger">*</span></label>
                <textarea class="form-control" name="tip" id="tip" rows="3" cols="10" required>{{ $essay->tip }}</textarea>
            </div>
            <div class="form-group">
                <label for="essay">Tập tin:</label>
                <input type="file" id="essay" name="essay">
            </div>
            <div class="d-block mb-3">
                <span class="mr-1">Câu đố đã giao:</span><a href="{{ asset($essay->essay) }}" download>{{ basename($essay->essay) }}</a>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
          </form>
    </div>
</div>
@endsection
