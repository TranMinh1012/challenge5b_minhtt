@extends('layouts.index')

@section('title', 'Danh sách bài làm')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Bài làm</h1>
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
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <!-- /.col-lg-12 -->
            <table class="table table-bordered" id="dataTables-example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Người nộp</th>
                        <th>Bài làm</th>
                        <th>Ngày nộp</th>
                        <th>Điểm số</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Người nộp</th>
                        <th>Bài làm</th>
                        <th>Ngày nộp</th>
                        <th>Điểm số</th>
                        <th>Hành động</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach ($solutions as $solution)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $solution->student->name }}</td>
                            <td><a href="{{ asset($solution->solution_file) }}" download>{{ basename($solution->solution_file) }}</a></td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($solution->submission_time)); }}</td>
                            <td>{{ $solution->score ?? 'Chưa chấm điểm' }}</td>
                            <td>
                                <a href="{{ route('homework.show.mark.form', ['id' => $solution->homework_id]) }}" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                        </tr>
                        @php $count++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
