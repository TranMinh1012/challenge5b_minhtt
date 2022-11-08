@extends('layouts.index')

@section('title', 'Trả lời')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Trả lời</h1>
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
        <form action="{{ route('essay.submit', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="answer">Trả lời: <span class="text-danger">*</span></label>
                <input type="text" id="answer" name="answer" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>
</div>
@endsection
