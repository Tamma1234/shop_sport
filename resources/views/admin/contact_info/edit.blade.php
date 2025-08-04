@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa thông tin liên hệ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chỉnh sửa thông tin liên hệ</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.contact-info.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shop_name">Tên shop <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('shop_name') is-invalid @enderror" 
                                           id="shop_name" name="shop_name" 
                                           value="{{ old('shop_name', $contactInfo['shop_name'] ?? '') }}" required>
                                    @error('shop_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shop_phone">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('shop_phone') is-invalid @enderror" 
                                           id="shop_phone" name="shop_phone" 
                                           value="{{ old('shop_phone', $contactInfo['shop_phone'] ?? '') }}" required>
                                    @error('shop_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shop_email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('shop_email') is-invalid @enderror" 
                                           id="shop_email" name="shop_email" 
                                           value="{{ old('shop_email', $contactInfo['shop_email'] ?? '') }}" required>
                                    @error('shop_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shop_website">Website</label>
                                    <input type="url" class="form-control @error('shop_website') is-invalid @enderror" 
                                           id="shop_website" name="shop_website" 
                                           value="{{ old('shop_website', $contactInfo['shop_website'] ?? '') }}">
                                    @error('shop_website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="shop_address">Địa chỉ <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('shop_address') is-invalid @enderror" 
                                      id="shop_address" name="shop_address" rows="3" required>{{ old('shop_address', $contactInfo['shop_address'] ?? '') }}</textarea>
                            @error('shop_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="shop_working_hours">Giờ làm việc <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('shop_working_hours') is-invalid @enderror" 
                                   id="shop_working_hours" name="shop_working_hours" 
                                   value="{{ old('shop_working_hours', $contactInfo['shop_working_hours'] ?? '') }}" required>
                            @error('shop_working_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shop_facebook">Facebook</label>
                                    <input type="url" class="form-control @error('shop_facebook') is-invalid @enderror" 
                                           id="shop_facebook" name="shop_facebook" 
                                           value="{{ old('shop_facebook', $contactInfo['shop_facebook'] ?? '') }}">
                                    @error('shop_facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shop_instagram">Instagram</label>
                                    <input type="url" class="form-control @error('shop_instagram') is-invalid @enderror" 
                                           id="shop_instagram" name="shop_instagram" 
                                           value="{{ old('shop_instagram', $contactInfo['shop_instagram'] ?? '') }}">
                                    @error('shop_instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="shop_description">Mô tả shop <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('shop_description') is-invalid @enderror" 
                                      id="shop_description" name="shop_description" rows="4" required>{{ old('shop_description', $contactInfo['shop_description'] ?? '') }}</textarea>
                            @error('shop_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Lưu thông tin
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 