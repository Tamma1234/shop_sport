@extends('layouts.main')

@section('content')
<div class="space-y-6">
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
            <div>
                <h1 class="text-3xl font-bold">Create New Product</h1>
            </div>
        </div>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    {{-- Section: Basic Info --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-xl font-semibold">Basic Information <span class="text-sm text-gray-400">(Required)</span></h2>
            <p class="text-gray-500 text-sm">Essential details about your product</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    placeholder="e.g., Barcelona Home Jersey 2024">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU *</label>
                <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sku') border-red-500 @enderror"
                    placeholder="e.g., BCN-HOME-2024">
                @error('sku')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                placeholder="Describe your product...">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @else
                <p class="text-xs text-gray-400 mt-1">{{ strlen(old('description', '')) }}/500 characters</p>
            @enderror
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
            <select name="category_id" id="category_id"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                <option value="">Select a category</option>
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
            <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') }}"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="e.g., soccer, jersey, barcelona">
            <p class="text-xs text-gray-400 mt-1">Comma-separated keywords</p>
        </div>
    </div>

    {{-- Section: Pricing --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-xl font-semibold">Pricing & Inventory</h2>
            <p class="text-gray-500 text-sm">Manage product pricing and availability</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price ($) *</label>
                <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                    placeholder="0.00">
                @error('price')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
                <input type="number" min="0" max="100" name="discount" id="discount" value="{{ old('discount', 0) }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('discount') border-red-500 @enderror"
                    placeholder="0">
                @error('discount')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity *</label>
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
                Final price after discount:
                <strong>${{ number_format(old('price') - (old('price') * old('discount') / 100), 2) }}</strong>
            </div>
        @endif
    </div>

    {{-- Section: Images --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-xl font-semibold">Product Images <span class="text-sm text-gray-400">(Required)</span></h2>
        </div>

        <div>
            <label for="main_image" class="block text-sm font-medium text-gray-700 mb-1">Main Product Image *</label>
            <input type="file" name="main_image" id="main_image"
                class="w-full px-3 py-2 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('main_image') border-red-500 @enderror"
                accept="image/*">
            @error('main_image')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
            <div id="main_image_preview" class="mt-3 flex flex-wrap gap-2"></div>
        </div>

        <div>
            <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-1">Gallery Images</label>
            <input type="file" name="gallery_images[]" id="gallery_images" multiple
                class="w-full px-3 py-2 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                accept="image/*">
            <p class="text-xs text-gray-400 mt-1">Up to 8 images</p>
            <div id="gallery_images_preview" class="mt-3 flex flex-wrap gap-2"></div>
        </div>
    </div>

    {{-- Section: Actions --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-4">
        <div class="flex items-center justify-between">
            <label for="status" class="text-sm font-medium text-gray-700">Product Status</label>
            <input type="checkbox" name="status" id="status" value="active"
                class="h-5 w-5 text-green-600 rounded focus:ring-2 focus:ring-green-500"
                {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
        </div>
        <p class="text-sm text-gray-400">
            {{ old('status', 'active') == 'active'
                ? 'Product will be visible to customers'
                : 'Product will be hidden from customers' }}
        </p>
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
            Create Product
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
            alert(`You can upload up to ${maxFiles} image${maxFiles > 1 ? 's' : ''}.`);
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
</script>
@endpush
