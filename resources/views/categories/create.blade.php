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
                <h1 class="text-3xl font-bold">Thêm Danh Mục Mới</h1>
            </div>
        </div>
    </div>

    <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Section: Thông tin cơ bản --}}
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <h2 class="text-xl font-semibold">Thông Tin Danh Mục <span class="text-sm text-gray-400">(Bắt buộc)</span></h2>
                <p class="text-gray-500 text-sm">Nhập thông tin cho danh mục mới</p>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên Danh Mục *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    placeholder="VD: Áo Đấu">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Đường Dẫn *</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('slug') border-red-500 @enderror"
                    placeholder="VD: ao-dau">
                @error('slug')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-400 mt-1">Đường dẫn thân thiện với URL. Tự động tạo từ tên.</p>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mô Tả</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                    placeholder="Mô tả về danh mục...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Section: Trạng thái --}}
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <div class="flex items-center justify-between">
                <label for="status" class="text-sm font-medium text-gray-700">Trạng Thái Danh Mục</label>
                <input type="checkbox" name="status" id="status" value="active"
                    class="h-5 w-5 text-green-600 rounded focus:ring-2 focus:ring-green-500"
                    {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
            </div>
            <p class="text-sm text-gray-400">
                {{ old('status', 'active') == 'active'
                    ? 'Danh mục sẽ được hiển thị cho khách hàng'
                    : 'Danh mục sẽ bị ẩn khỏi cửa hàng' }}
            </p>
            <button type="submit"
                class="w-full bg-gray-900 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                Lưu Danh Mục
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('name').addEventListener('input', function () {
        const nameValue = this.value;
        const slug = nameValue.toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
        document.getElementById('slug').value = slug;
    });
</script>
@endpush
