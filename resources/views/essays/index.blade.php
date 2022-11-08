@extends('layouts.index')

@section('title', 'Danh sách câu đố')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Câu đố</h1>
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
            <a href="{{ route('essay.add.form') }}" class="btn btn-sm btn-primary">Thêm mới</a>
        </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <!-- /.col-lg-12 -->
            <table class="table table-bordered" id="dataTables-example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gợi ý</th>
                        @if(Auth::user()->role == 0)
                            <th>Tập tin</th>
                        @endif
                        <th>Ngày giao</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Gợi ý</th>
                        @if(Auth::user()->role == 0)
                            <th>Tập tin</th>
                        @endif
                        <th>Ngày giao</th>
                        <th>Hành động</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach ($essays as $essay)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $essay->tip }}</td>
                            @if(Auth::user()->role == 0)
                                <td><a href="{{ asset($essay->essay) }}" download>{{ basename($essay->essay); }}</a></td>
                            @endif
                            <td>{{ date('d/m/Y H:i:s', strtotime($essay->assignment_time)); }}</td>
                            <td>
                                @if(Auth::user()->role == 0)
                                    <a href="{{ route('essay.edit.form', ['id' => $essay->id]) }}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="{{ route('essay.delete', ['id' => $essay->id]) }}" onclick="return confirm('Bạn chắc chắn muốn xóa câu đố này không?');" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @else
                                    @if (!\App\Models\Answer::where([['essay_id', $essay->id], ['student_id', Auth::user()->id]])->exists())
                                        <a href="{{ route('essay.submit.form', ['id' => $essay->id]) }}" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    @else
                                        <a href="{{ asset($essay->essay) }}" class="btn btn-warning btn-circle btn-sm" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
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
