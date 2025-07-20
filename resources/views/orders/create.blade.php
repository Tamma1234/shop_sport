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
                <h1 class="text-3xl font-bold">Tạo Đơn Hàng Mới</h1>
            </div>
        </div>
    </div>

    <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
    @csrf

    {{-- Section: Thông tin khách hàng --}}
    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-xl font-semibold">Thông Tin Khách Hàng <span class="text-sm text-gray-400">(Bắt buộc)</span></h2>
            <p class="text-gray-500 text-sm">Thông tin người đặt hàng</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Tên Khách Hàng *</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('customer_name') border-red-500 @enderror"
                    placeholder="VD: Nguyễn Văn A">
                @error('customer_name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Số Điện Thoại *</label>
                <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('customer_phone') border-red-500 @enderror"
                    placeholder="VD: 0912345678">
                @error('customer_phone')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div>
            <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Hình Thức Mua Hàng</label>
            <input type="text" name="note" id="note" value="{{ old('note') }}"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('note') border-red-500 @enderror"
                placeholder="VD: example@email.com">
          
        </div>
        <div>
            <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('customer_email') border-red-500 @enderror"
                placeholder="VD: example@email.com">
            @error('customer_email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Địa Chỉ Giao Hàng *</label>
            <textarea name="shipping_address" id="shipping_address" rows="3"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('shipping_address') border-red-500 @enderror"
                placeholder="Nhập địa chỉ giao hàng chi tiết...">{{ old('shipping_address') }}</textarea>
            @error('shipping_address')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Sản phẩm --}}
        <div class="space-y-4">
            <div class="flex items-center gap-4">
                <select id="product_select" name="product_id" class="flex-1 px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn sản phẩm</option>
                    @if($products->count() > 0)
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">
                                {{ $product->name }} - {{ number_format($product->price, 0, ',', '.') }}₫
                            </option>
                        @endforeach
                    @else
                        <option value="" disabled>Số lượng sản phẩm: {{ $products->count() }}</option>
                    @endif
                </select>
                <button type="button" id="add_product" class="bg-gray-900 text-white px-4 py-2 rounded-md hover:bg-gray-800">
                    Thêm
                </button>
            </div>

            <div class="border rounded-md">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sản Phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Đơn Giá</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Số Lượng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thành Tiền</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                        </tr>
                    </thead>
                    <tbody id="order_items" class="bg-white divide-y divide-gray-200">
                        <!-- Các sản phẩm sẽ được thêm vào đây bằng JavaScript -->
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-medium">Tổng cộng:</td>
                            <td class="px-6 py-4 font-bold" id="total_amount">0₫</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Hidden input để gửi dữ liệu sản phẩm --}}
        <div id="products_inputs"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Trạng Thái *</label>
                <select name="status" id="status"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                    <option value="pending" @selected(old('status') == 'pending')>Chờ xử lý</option>
                    <option value="processing" @selected(old('status') == 'processing')>Đang xử lý</option>
                    <option value="completed" @selected(old('status') == 'completed')>Hoàn thành</option>
                    <option value="cancelled" @selected(old('status') == 'cancelled')>Đã hủy</option>
                </select>
                @error('status')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="deposit" class="block text-sm font-medium text-gray-700 mb-1">Tiền Cọc</label>
                <input type="text" name="deposit" id="deposit"
                    value="{{ old('deposit') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deposit') border-red-500 @enderror"
                    placeholder="VD: 100.000">
                <input type="hidden" name="deposit_value" id="deposit_value">
                @error('deposit')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Ghi Chú</label>
            <textarea name="notes" id="notes" rows="3"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ghi chú thêm về đơn hàng...">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="w-full bg-gray-900 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
            Tạo Đơn Hàng
        </button>
    </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing order form...');
    
    const productSelect = document.getElementById('product_select');
    const addProductBtn = document.getElementById('add_product');
    const orderItems = document.getElementById('order_items');
    const totalAmountElement = document.getElementById('total_amount');
    
    // Kiểm tra xem các element có tồn tại không
    if (!productSelect) {
        console.error('Product select not found!');
        return;
    }
    if (!addProductBtn) {
        console.error('Add product button not found!');
        return;
    }
    if (!orderItems) {
        console.error('Order items tbody not found!');
        return;
    }
    if (!totalAmountElement) {
        console.error('Total amount element not found!');
        return;
    }
    
    console.log('All elements found successfully');
    console.log('Products available:', productSelect.options.length - 1); // Trừ option đầu tiên
    
    let orderItemsData = [];

    function updateTotalAmount() {
        const total = orderItemsData.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        totalAmountElement.textContent = formatCurrency(total) + '₫';
        console.log('Total updated:', total);
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN').format(amount);
    }

    function createOrderItemRow(product) {
    console.log('Creating row for product:', product);
    const tr = document.createElement('tr');
    tr.dataset.productId = product.id;
    tr.innerHTML = `
        <td class="px-6 py-4">
            ${product.name}
            <input type="hidden" name="products[${product.id}][id]" value="${product.id}">
        </td>
        <td class="px-6 py-4">
            ${formatCurrency(product.price)}₫
            <input type="hidden" name="products[${product.id}][price]" value="${product.price}">
        </td>
        <td class="px-6 py-4">
            <input type="number" name="products[${product.id}][quantity]" value="${product.quantity}" min="1" max="${product.stock}"
                class="w-20 px-2 py-1 border rounded-md"
                onchange="updateQuantity(${product.id}, this.value)">
        </td>
        <td class="px-6 py-4" id="subtotal-${product.id}">
            ${formatCurrency(product.price * product.quantity)}₫
        </td>
        <td class="px-6 py-4">
            <button type="button" onclick="removeProduct(${product.id})" class="text-red-600 hover:text-red-800">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </td>
    `;
    return tr;
}


    addProductBtn.addEventListener('click', function() {
        console.log('Add product button clicked');
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        console.log('Selected option:', selectedOption);
        
        if (!selectedOption || !selectedOption.value) {
            console.log('No product selected');
            alert('Vui lòng chọn một sản phẩm!');
            return;
        }

        const productId = parseInt(selectedOption.value);
        console.log('Product ID:', productId);
        
        if (orderItemsData.some(item => item.id === productId)) {
            console.log('Product already exists in order');
            alert('Sản phẩm này đã được thêm vào đơn hàng!');
            return;
        }

        const product = {
            id: productId,
            name: selectedOption.text.split(' - ')[0],
            price: parseFloat(selectedOption.dataset.price),
            stock: parseInt(selectedOption.dataset.stock),
            quantity: 1
        };
        
        console.log('Product object created:', product);

        orderItemsData.push(product);
        console.log('Product added to orderItemsData, total items:', orderItemsData.length);
        
        const newRow = createOrderItemRow(product);
        console.log('New row created:', newRow);
        console.log('Order items tbody:', orderItems);
        
        orderItems.appendChild(newRow);
        console.log('Row added to table');
        console.log('Current tbody children:', orderItems.children.length);
        
        updateTotalAmount();
        productSelect.value = '';
        console.log('Product select reset');
    });

    // Thêm các hàm này vào global scope để có thể gọi từ inline event handlers
    window.updateQuantity = function(productId, newQuantity) {
    const item = orderItemsData.find(item => item.id === productId);
    if (item) {
        item.quantity = parseInt(newQuantity);
        const subtotalCell = document.getElementById(`subtotal-${productId}`);
        if (subtotalCell) {
            subtotalCell.textContent = formatCurrency(item.price * item.quantity) + '₫';
        }
        updateTotalAmount();
    }
};


    window.removeProduct = function(productId) {
        console.log('Removing product', productId);
        orderItemsData = orderItemsData.filter(item => item.id !== productId);
        const row = orderItems.querySelector(`tr[data-product-id="${productId}"]`);
        if (row) {
            row.remove();
            updateTotalAmount();
        }
    };
    
    console.log('Order form initialization completed');
});

// Thêm đoạn này để khi submit sẽ đóng gói dữ liệu sản phẩm đúng dạng
function syncProductsInputs() {
    const orderItems = window.orderItemsData || [];
    const productsInputs = document.getElementById('products_inputs');
    productsInputs.innerHTML = '';
    orderItems.forEach((item, idx) => {
        productsInputs.innerHTML += `<input type="hidden" name="products[${idx}][id]" value="${item.id}">`;
        productsInputs.innerHTML += `<input type="hidden" name="products[${idx}][quantity]" value="${item.quantity}">`;
    });
}

// Gọi lại hàm này mỗi khi thêm/xóa sản phẩm
window.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            syncProductsInputs();
        });
    }
});

// Format số tiền cho deposit
function formatDepositCurrency(input) {
    let value = input.value.replace(/[^0-9]/g, '');
    if (value.length > 0) {
        value = parseInt(value).toLocaleString('vi-VN');
    }
    input.value = value;
    document.getElementById('deposit_value').value = value.replace(/[^0-9]/g, '');
}

const depositInput = document.getElementById('deposit');
depositInput.addEventListener('input', function() {
    formatDepositCurrency(this);
});
if (depositInput.value) {
    formatDepositCurrency(depositInput);
}

// Khi submit form, lấy giá trị thực cho deposit
const form = document.querySelector('form');
form.addEventListener('submit', function(e) {
    const depositValue = document.getElementById('deposit_value').value;
    if (depositValue) {
        depositInput.value = depositValue;
    }
});
</script>
@endpush
