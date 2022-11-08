@extends('layouts.index')

@section('title', 'Danh sách bài tập về nhà')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Bài tập về nhà</h1>
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
    @if(Auth::user()->role == 0)
        <div class="card-header py-3">
            <a href="{{ route('homework.add.form') }}" class="btn btn-sm btn-primary">Thêm mới</a>
        </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <!-- /.col-lg-12 -->
            <table class="table table-bordered" id="dataTables-example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th width="100">Tiêu đề</th>
                        <th>Tập tin</th>
                        <th>Ngày giao</th>
                        @if(Auth::user()->role == 1)
                            <th>Người giao</th>
                        @endif
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Tiêu đề</th>
                        <th>Tập tin</th>
                        <th>Ngày giao</th>
                        @if(Auth::user()->role == 1)
                            <th>Người giao</th>
                        @endif
                        <th>Hành động</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php $count = 1 @endphp
                    @foreach ($homeworks as $homework)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $homework->title }}</td>
                            <td><a href="{{ asset($homework->homework_file) }}" download>{{ basename($homework->homework_file) }}</a></td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($homework->assignment_time)); }}</td>
                            @if(Auth::user()->role == 1)
                                <td>{{ $homework->teacher->name }}</td>
                            @endif
                            <td>
                                @if(Auth::user()->role == 0)
                                    @if (!\App\Models\Solution::where('homework_id', $homework->id)->exists())
                                        <a href="{{ route('homework.edit', ['id' => $homework->id]) }}" class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('homework.delete', ['id' => $homework->id]) }}" onclick="return confirm('Bạn chắc chắn muốn xóa bài tập này không?');" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('homework.show', ['id' => $homework->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @else
                                    <a href="{{ route('homework.submit', ['id' => $homework->id]) }}" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                @endif
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
