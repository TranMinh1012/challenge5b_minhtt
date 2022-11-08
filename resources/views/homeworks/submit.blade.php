@extends('layouts.index')

@section('title', 'Nộp bài tập')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Nộp bài tập</h1>
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
        @if (!\App\Models\Solution::where([['student_id', Auth::user()->id], ['homework_id', $id]])->exists())
            <form action="{{ route('homework.submit', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="solution">Bài làm: <span class="text-danger">*</span></label>
                    <input type="file" id="solution" name="solution" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Đăng tải</button>
            </form>
        @else
            <form action="{{ route('homework.solution.update', ['id' => $solution->id]) }}" method="POST" enctype="multipart/form-data">

                @csrf

                @if (is_null($solution->score))
                    <div class="form-group">
                        <label for="solution">Bài làm: <span class="text-danger">*</span></label>
                        <input type="file" id="solution" name="solution" required>
                    </div>
                @endif
                <div class="d-block mb-3">
                    <span class="mr-1">Bài làm đã nộp:</span><a href="{{ asset($solution->solution_file) }}" download>{{ basename($solution->solution_file) }}</a>
                </div>
                @if (is_null($solution->score))
                    <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
                @else
                    <p class="text-danger">Điểm số: {{ $solution->score }}</p>
                @endif
            </form>
        @endif
    </div>
</div>
@endsection
