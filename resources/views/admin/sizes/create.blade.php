@extends('admin.layouts.main')

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
                <h1 class="text-3xl font-bold">Thêm Kích Thước Mới</h1>
            </div>
        </div>
    </div>

    <form action="{{ route('sizes.store') }}" method="POST" class="space-y-6">
    @csrf

    {{-- Section: Thông tin cơ bản --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-xl font-semibold">Thông Tin Cơ Bản <span class="text-sm text-gray-400">(Bắt buộc)</span></h2>
            <p class="text-gray-500 text-sm">Thông tin cần thiết về kích thước</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên Kích Thước *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    placeholder="VD: Size L">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Mã Kích Thước *</label>
                <input type="text" name="code" id="code" value="{{ old('code') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('code') border-red-500 @enderror"
                    placeholder="VD: L">
                @error('code')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mô Tả</label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                placeholder="Mô tả chi tiết về kích thước...">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @else
                <p class="text-xs text-gray-400 mt-1">{{ strlen(old('description', '')) }}/500 ký tự</p>
            @enderror
        </div>
    </div>

    {{-- Section: Trạng Thái --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <div class="flex items-center justify-between">
            <label for="status" class="text-sm font-medium text-gray-700">Trạng Thái</label>
            <input type="checkbox" name="status" id="status" value="active"
                class="h-5 w-5 text-green-600 rounded focus:ring-2 focus:ring-green-500"
                {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
        </div>
        <p class="text-sm text-gray-400">
            {{ old('status', 'active') == 'active'
                ? 'Kích thước sẽ được hiển thị cho khách hàng'
                : 'Kích thước sẽ bị ẩn khỏi cửa hàng' }}
        </p>
        <button type="submit"
            class="w-full bg-gray-900 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
            Lưu Kích Thước
        </button>
    </div>
</form>

</div>
@endsection

@push('scripts')
<script>
    document.getElementById('name').addEventListener('input', function () {
        const nameValue = this.value;
        const code = nameValue.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        document.getElementById('code').value = code;
    });
</script>
@endpush
