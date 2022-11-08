@extends('layouts.index')

@section('title', 'Cập nhật thông tin cá nhân')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Cập nhật thông tin cá nhân</h1>
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
        <form action="{{ route('user.update.profile', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="username">Tài khoản: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Nhập tài khoản" id="username" name="username" value="{{ $user->username }}" {{ Auth::user()->role == 0 ? 'required' : 'disabled' }}>
            </div>
            <div class="form-group">
                <label for="name">Họ tên: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Nhập họ tên" id="name" name="name" value="{{ $user->name }}" {{ Auth::user()->role == 0 ? 'required' : 'disabled' }}>
            </div>
            <div class="form-group">
                <label for="email">Email: <span class="text-danger">*</span></label>
                <input type="email" class="form-control" placeholder="Nhập email" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu: <span class="text-danger">*</span></label>
                <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="password" name="password" value="{{ $user->password }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại: <span class="text-danger">*</span></label>
                <input type="tel" class="form-control" placeholder="Nhập số điện thoại" id="phone" name="phone" pattern="[0-9]{10}" value="{{ $user->phone }}" required>
            </div>
            <div class="form-group">
                <label for="image">Ảnh đại diện: <span class="text-danger">*</span></label>
                <div class="custom-file">
                    <input type="file" id="image" name="image" accept=".png,.gif,.jpg,.jpeg" />
                </div>
            </div>
            <div class="image-preview mb-4" id="imagePreview">
                <img src="{{ asset($user->avatar) }}" alt="Image Preview" class="image-preview__image" style="display:block;" />
                <span class="image-preview__default-text" style="display:none;">Hình ảnh</span>
            </div>
            <br />
            <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
          </form>
    </div>
</div>
@endsection
