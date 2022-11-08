@extends('layouts.index')

@section('title', 'Chấm điểm')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Chấm điểm</h1>

<!-- DataTales Example -->
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('homework.mark', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">
            
            @csrf

            <div class="form-group">
                <label for="score">Điểm số: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Nhập điểm số" id="score" name="score" value="{{ !is_null($solution) ? $solution->score : '' }}" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Chấm điểm</button>
        </form>
    </div>
</div>
@endsection
