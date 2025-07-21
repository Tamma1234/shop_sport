@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Quay lại
            </a>
            <div>
                <h1 class="text-3xl font-bold">Thêm Kiểu In Ấn Mới</h1>
            </div>
        </div>
    </div>
    <form action="{{ route('printing-styles.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <h2 class="text-xl font-semibold">Thông Tin Kiểu In Ấn <span class="text-sm text-gray-400">(Bắt buộc)</span></h2>
                <p class="text-gray-500 text-sm">Nhập thông tin cho kiểu in ấn mới</p>
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên Kiểu In *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    placeholder="VD: In nhiệt, In decal">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Giá *</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                    placeholder="VD: 50000">
                @error('price')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="printing_id" class="block text-sm font-medium text-gray-700 mb-1">Loại In Ấn *</label>
                <select name="printing_id" id="printing_id" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('printing_id') border-red-500 @enderror">
                    <option value="">-- Chọn loại in ấn --</option>
                    @foreach($printings as $printing)
                        <option value="{{ $printing->id }}" {{ old('printing_id') == $printing->id ? 'selected' : '' }}>{{ $printing->name }}</option>
                    @endforeach
                </select>
                @error('printing_id')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button type="submit"
            class="w-full bg-gray-900 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
            Lưu Kiểu In Ấn
        </button>
    </form>
</div>
@endsection 