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
                <h1 class="text-3xl font-bold">Thêm Sản Phẩm Mới</h1>
            </div>
        </div>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    {{-- Section: Thông tin cơ bản --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-xl font-semibold">Thông Tin Cơ Bản <span class="text-sm text-gray-400">(Bắt buộc)</span></h2>
            <p class="text-gray-500 text-sm">Thông tin cần thiết về sản phẩm</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên Sản Phẩm *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    placeholder="VD: Áo Barcelona 2024">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">Mã Sản Phẩm *</label>
                <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sku') border-red-500 @enderror"
                    placeholder="VD: BCN-HOME-2024">
                @error('sku')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Đường Dẫn *</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('slug') border-red-500 @enderror"
                placeholder="VD: ao-barcelona-2024">
            @error('slug')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mô Tả *</label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                placeholder="Mô tả chi tiết về sản phẩm...">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @else
                <p class="text-xs text-gray-400 mt-1">{{ strlen(old('description', '')) }}/500 ký tự</p>
            @enderror
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Danh Mục *</label>
            <select name="category_id" id="category_id"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                <option value="">Chọn danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Thẻ</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') }}"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="VD: bóng đá, áo đấu, barcelona">
            <p class="text-xs text-gray-400 mt-1">Các từ khóa cách nhau bởi dấu phẩy</p>
        </div>
    </div>

    {{-- Section: Giá & Kho --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-xl font-semibold">Giá & Kho Hàng</h2>
            <p class="text-gray-500 text-sm">Quản lý giá và số lượng sản phẩm</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Giá (₫) *</label>
                <input type="text" name="price" id="price" value="{{ old('price') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                    placeholder="VD: 180.000">
                <input type="hidden" name="price_value" id="price_value">
                @error('price')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">Giảm Giá (%)</label>
                <input type="number" min="0" max="100" name="discount" id="discount" value="{{ old('discount', 0) }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('discount') border-red-500 @enderror"
                    placeholder="0">
                @error('discount')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Số Lượng *</label>
                <input type="number" min="0" name="stock" id="stock" value="{{ old('stock') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stock') border-red-500 @enderror"
                    placeholder="0">
                @error('stock')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        @if(old('price') && old('discount', 0) > 0)
            <div class="bg-green-100 border border-green-300 rounded p-3 text-sm text-green-700 mt-2">
                Giá sau khi giảm:
                <strong>{{ number_format(old('price') - (old('price') * old('discount') / 100), 0, ',', '.') }}₫</strong>
            </div>
        @endif
    </div>

    {{-- Section: Hình Ảnh --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-xl font-semibold">Hình Ảnh Sản Phẩm <span class="text-sm text-gray-400">(Bắt buộc)</span></h2>
        </div>

        <div>
            <label for="main_image" class="block text-sm font-medium text-gray-700 mb-1">Ảnh Chính *</label>
            <input type="file" name="main_image" id="main_image"
                class="w-full px-3 py-2 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('main_image') border-red-500 @enderror"
                accept="image/*">
            @error('main_image')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
            <div id="main_image_preview" class="mt-3 flex flex-wrap gap-2"></div>
        </div>

        <div>
            <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-1">Ảnh Phụ</label>
            <input type="file" name="gallery_images[]" id="gallery_images" multiple
                class="w-full px-3 py-2 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                accept="image/*">
            <p class="text-xs text-gray-400 mt-1">Tối đa 8 ảnh</p>
            <div id="gallery_images_preview" class="mt-3 flex flex-wrap gap-2"></div>
        </div>
    </div>

    {{-- Section: Trạng Thái --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <div class="flex items-center justify-between">
            <label for="status" class="text-sm font-medium text-gray-700">Trạng Thái Sản Phẩm</label>
            <input type="checkbox" name="status" id="status" value="active"
                class="h-5 w-5 text-green-600 rounded focus:ring-2 focus:ring-green-500"
                {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
        </div>
        <p class="text-sm text-gray-400">
            {{ old('status', 'active') == 'active'
                ? 'Sản phẩm sẽ được hiển thị cho khách hàng'
                : 'Sản phẩm sẽ bị ẩn khỏi cửa hàng' }}
        </p>
        <button type="submit"
            class="w-full bg-gray-900 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
            Lưu Sản Phẩm
        </button>
    </div>
</form>

</div>
@endsection

@push('scripts')
<script>
    function createImagePreview(containerId, files, imageSizeClasses = '') {
        const previewContainer = document.getElementById(containerId);
        previewContainer.innerHTML = '';

        const maxFiles = (containerId === 'gallery_images_preview') ? 8 : 1;

        if (files.length > maxFiles) {
            alert(`Bạn chỉ có thể tải lên tối đa ${maxFiles} ảnh${maxFiles > 1 ? '' : ''}.`);
            return;
        }

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrapper = document.createElement('div');
                wrapper.className = 'relative overflow-hidden rounded-md border border-gray-300 shadow bg-white';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = `${imageSizeClasses} object-cover transition-transform duration-300 hover:scale-105`;

                wrapper.appendChild(img);
                previewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    }

    document.getElementById('main_image').addEventListener('change', function (e) {
        createImagePreview('main_image_preview', e.target.files, 'h-40 w-40 sm:h-48 sm:w-48');
    });

    document.getElementById('gallery_images').addEventListener('change', function (e) {
        createImagePreview('gallery_images_preview', e.target.files, 'h-24 w-24 sm:h-28 sm:w-28');
    });
    document.getElementById('name').addEventListener('input', function () {
        const nameValue = this.value;
        const slug = nameValue.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        document.getElementById('slug').value = slug;
    });

    // Format số tiền
    function formatCurrency(input) {
        // Xóa tất cả ký tự không phải số
        let value = input.value.replace(/[^0-9]/g, '');

        // Format số với dấu chấm
        if (value.length > 0) {
            value = parseInt(value).toLocaleString('vi-VN');
        }

        // Cập nhật giá trị hiển thị
        input.value = value;

        // Cập nhật giá trị thực để submit
        document.getElementById('price_value').value = value.replace(/[^0-9]/g, '');
    }

    // Áp dụng format khi nhập giá
    const priceInput = document.getElementById('price');
    priceInput.addEventListener('input', function() {
        formatCurrency(this);
    });

    // Format giá trị ban đầu nếu có
    if (priceInput.value) {
        formatCurrency(priceInput);
    }

    // Xử lý form submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const priceValue = document.getElementById('price_value').value;
        if (priceValue) {
            priceInput.value = priceValue;
        }
    });
</script>
@endpush
