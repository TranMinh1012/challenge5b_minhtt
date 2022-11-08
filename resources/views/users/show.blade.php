@extends('layouts.index')

@section('title', 'Thông tin người dùng')

@section('content')
<h1 class="h3 mb-2 text-gray-800">{{ $user->name }}</h1>
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
            <table class="table table-bordered" width="100%" cellspacing="0">
                <tr>
                    <th>Ảnh đại diện</th>
                    <td><img src="{{ asset($user->avatar) }}" width="300"></td>
                </tr>
                <tr>
                    <th>Tài khoản</th>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <th>Họ tên</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th>Lời nhắn của tôi</th>
                    <td>
                        @if ($messages->count() > 0)
                            <div style="overflow-y: auto;">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <tr>
                                        <th>Lời nhắn</th>
                                        <th>Ngày gửi</th>
                                        <th>Hành động</th>
                                    </tr>
                                    @foreach ($messages as $message)
                                        <tr>
                                            <td>{{ $message->msg }}</td>
                                            <td>{{ date('d/m/Y H:i:s', strtotime($message->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('user.delete.message', ['id' => $message->id]) }}" onclick="return confirm('Bạn chắc chắn muốn xóa tin nhắn này không?');" class="btn btn-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach                                    
                                </table>
                            </div>
                        @else
                            Hiện tại chưa có lời nhắn nào
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <form action="{{ route('user.add.message', ['id' => $id]) }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="message">Lời nhắn: <span class="text-danger">*</span></label>
                <textarea class="form-control" name="message" id="message" rows="3" cols="10"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>
</div>
@endsection
