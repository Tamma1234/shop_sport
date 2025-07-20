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
                <h1 class="text-3xl font-bold">Chỉnh Sửa Kho Hàng</h1>
            </div>
        </div>
    </div>

    <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Section: Thông tin cơ bản --}}
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <h2 class="text-xl font-semibold">Thông Tin Cơ Bản <span class="text-sm text-gray-400">(Bắt buộc)</span></h2>
                <p class="text-gray-500 text-sm">Cập nhật thông tin cho kho hàng "{{ $warehouse->name }}"</p>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên Kho Hàng *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $warehouse->name) }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    placeholder="VD: Kho hàng chính">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Địa Chỉ *</label>
                <input type="text" name="location" id="address" value="{{ old('address', $warehouse->location) }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror"
                    placeholder="Nhập địa chỉ kho hàng">
                @error('address')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số Điện Thoại</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $warehouse->phone) }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror"
                    placeholder="VD: 0123456789">
                @error('phone')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Section: Nút bấm --}}
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <button type="submit"
                class="w-full bg-gray-900 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                Cập Nhật Kho Hàng
            </button>
        </div>
    </form>
</div>
@endsection
