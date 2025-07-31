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
            <label for="note" class="block text-sm font-medium text-gray-700 mb-1">Hình Thức Mua Hàng</label>
            <input type="text" name="note" id="note" value="{{ old('note') }}"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('note') border-red-500 @enderror"
                placeholder="VD: Mua tại cửa hàng, Đặt hàng online...">
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

        {{-- Section: Quà tặng và giảm giá --}}
        <div class="border-t pt-6">
            <h3 class="text-lg font-semibold mb-4">Quà Tặng & Giảm Giá</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Quà tặng --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Chọn Quà Tặng</label>
                        <div class="border rounded-md overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Chọn</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quà Tặng</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Giá</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">SL</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($gifts as $gift)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2">
                                                <input type="checkbox" name="gifts[]" value="{{ $gift->id }}" 
                                                    class="gift-checkbox rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                                    data-gift-id="{{ $gift->id }}"
                                                    data-gift-price="{{ $gift->price }}">
                                            </td>
                                            <td class="px-4 py-2 text-sm">
                                                <div>
                                                    <div class="font-medium">{{ $gift->name }}</div>
                                                    @if($gift->description)
                                                        <div class="text-xs text-gray-500">{{ $gift->description }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-4 py-2 text-sm font-medium">
                                                {{ number_format($gift->price, 0, ',', '.') }}₫
                                            </td>
                                            <td class="px-4 py-2">
                                                <input type="number" name="gift_quantities[{{ $gift->id }}]" 
                                                    value="1" min="1" max="10"
                                                    class="gift-quantity w-16 px-2 py-1 border rounded-md text-sm"
                                                    data-gift-id="{{ $gift->id }}"
                                                    disabled>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-4 text-center text-sm text-gray-500">
                                                Không có quà tặng nào
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            Tổng giá trị quà tặng: <span id="total_gifts_value" class="font-medium">0₫</span>
                        </div>
                    </div>
                </div>

                {{-- Giảm giá tổng đơn hàng --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Giảm Giá Tổng Đơn Hàng</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="order_discount_type" value="none" checked class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm">Không giảm giá</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="order_discount_type" value="percentage" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm">Giảm theo phần trăm (%)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="order_discount_type" value="fixed" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm">Giảm theo số tiền cố định</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label for="order_discount_value" class="block text-sm font-medium text-gray-700 mb-1">Giá Trị Giảm</label>
                        <div class="flex">
                            <input type="text" name="order_discount_value" id="order_discount_value" value="{{ old('order_discount_value') }}"
                                class="flex-1 px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Nhập giá trị giảm...">
                            <span class="px-3 py-2 bg-gray-100 border border-l-0 rounded-r-md text-sm text-gray-600" id="order_discount_unit">₫</span>
                        </div>
                    </div>
                    
                    <div>
                        <label for="order_discount_reason" class="block text-sm font-medium text-gray-700 mb-1">Lý Do Giảm Giá</label>
                        <select name="order_discount_reason" id="order_discount_reason"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Chọn lý do giảm giá</option>
                            <option value="khach_hang_than_thiet">Khách hàng thân thiết</option>
                            <option value="mua_sl_lon">Mua số lượng lớn</option>
                            <option value="khuyen_mai">Khuyến mãi</option>
                            <option value="ngay_le">Ngày lễ</option>
                            <option value="khac">Lý do khác</option>
                        </select>
                    </div>
                </div>
            </div>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Đơn Giá Gốc</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Giảm Giá</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Đơn Giá Sau Giảm</th>
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
                            <td colspan="5" class="px-6 py-4 text-right font-medium">Tổng cộng:</td>
                            <td class="px-6 py-4 font-bold" id="total_amount">0₫</td>
                            <td></td>
                        </tr>
                        <tr id="order_discount_row" class="hidden">
                            <td colspan="5" class="px-6 py-4 text-right font-medium text-green-600">Giảm giá đơn hàng:</td>
                            <td class="px-6 py-4 font-bold text-green-600" id="order_discount_amount">0₫</td>
                            <td></td>
                        </tr>
                        <tr id="final_total_row">
                            <td colspan="5" class="px-6 py-4 text-right font-medium">Tổng thanh toán:</td>
                            <td class="px-6 py-4 font-bold text-lg" id="final_total">0₫</td>
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
// Khai báo dữ liệu printings từ PHP
var printingsData = {!! json_encode($printings ?? []) !!};
window.printingsData = printingsData;

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing order form...');
    
    const productSelect = document.getElementById('product_select');
    const addProductBtn = document.getElementById('add_product');
    const orderItems = document.getElementById('order_items');
    const totalAmountElement = document.getElementById('total_amount');
    const finalTotalElement = document.getElementById('final_total');
    const orderDiscountRow = document.getElementById('order_discount_row');
    const orderDiscountAmountElement = document.getElementById('order_discount_amount');
    
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
        // Tính tổng dựa trên giá sau giảm giá của từng sản phẩm
        const subtotal = orderItemsData.reduce((sum, item) => {
            const discountedPrice = item.discountedPrice || item.price;
            return sum + (discountedPrice * item.quantity);
        }, 0);
        
        totalAmountElement.textContent = formatCurrency(subtotal) + '₫';
        
        // Tính toán giảm giá tổng đơn hàng
        const orderDiscountType = document.querySelector('input[name="order_discount_type"]:checked').value;
        const orderDiscountValue = parseFloat(document.getElementById('order_discount_value').value) || 0;
        let orderDiscountAmount = 0;
        
        if (orderDiscountType === 'percentage' && orderDiscountValue > 0) {
            orderDiscountAmount = (subtotal * orderDiscountValue) / 100;
        } else if (orderDiscountType === 'fixed' && orderDiscountValue > 0) {
            orderDiscountAmount = orderDiscountValue;
        }
        
        const finalTotal = subtotal - orderDiscountAmount;
        
        // Hiển thị giảm giá tổng đơn hàng
        if (orderDiscountAmount > 0) {
            orderDiscountRow.classList.remove('hidden');
            orderDiscountAmountElement.textContent = '-' + formatCurrency(orderDiscountAmount) + '₫';
        } else {
            orderDiscountRow.classList.add('hidden');
        }
        
        finalTotalElement.textContent = formatCurrency(finalTotal) + '₫';
        console.log('Total updated:', subtotal, 'Order Discount:', orderDiscountAmount, 'Final:', finalTotal);
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN').format(amount);
    }

    // Xử lý thay đổi loại giảm giá tổng đơn hàng
    document.querySelectorAll('input[name="order_discount_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const orderDiscountValue = document.getElementById('order_discount_value');
            const orderDiscountUnit = document.getElementById('order_discount_unit');
            
            if (this.value === 'percentage') {
                orderDiscountUnit.textContent = '%';
                orderDiscountValue.placeholder = 'VD: 10 (giảm 10%)';
            } else if (this.value === 'fixed') {
                orderDiscountUnit.textContent = '₫';
                orderDiscountValue.placeholder = 'VD: 50000 (giảm 50.000₫)';
            } else {
                orderDiscountUnit.textContent = '₫';
                orderDiscountValue.placeholder = 'Nhập giá trị giảm...';
            }
            
            updateTotalAmount();
        });
    });

    // Xử lý thay đổi giá trị giảm giá tổng đơn hàng
    document.getElementById('order_discount_value').addEventListener('input', function() {
        updateTotalAmount();
    });

    // Xử lý checkbox quà tặng
    document.querySelectorAll('.gift-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const giftId = this.dataset.giftId;
            const quantityInput = document.querySelector(`input[name="gift_quantities[${giftId}]"]`);
            
            if (this.checked) {
                quantityInput.disabled = false;
                quantityInput.focus();
            } else {
                quantityInput.disabled = true;
                quantityInput.value = 1;
            }
            
            updateGiftsTotal();
        });
    });

    // Xử lý thay đổi số lượng quà tặng
    document.querySelectorAll('.gift-quantity').forEach(input => {
        input.addEventListener('change', function() {
            updateGiftsTotal();
        });
    });

    function updateGiftsTotal() {
        let totalGiftsValue = 0;
        
        document.querySelectorAll('.gift-checkbox:checked').forEach(checkbox => {
            const giftId = checkbox.dataset.giftId;
            const giftPrice = parseFloat(checkbox.dataset.giftPrice);
            const quantityInput = document.querySelector(`input[name="gift_quantities[${giftId}]"]`);
            const quantity = parseInt(quantityInput.value) || 1;
            
            totalGiftsValue += giftPrice * quantity;
        });
        
        document.getElementById('total_gifts_value').textContent = formatCurrency(totalGiftsValue) + '₫';
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
                <input type="hidden" name="products[${product.id}][original_price]" value="${product.price}">
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center space-x-2">
                    <select name="products[${product.id}][discount_type]" class="w-20 px-2 py-1 border rounded-md text-xs" onchange="updateProductDiscount(${product.id})">
                        <option value="none">Không</option>
                        <option value="percentage">%</option>
                        <option value="fixed">₫</option>
                    </select>
                    <input type="number" name="products[${product.id}][discount_value]" value="0" min="0" step="0.01" 
                        class="w-20 px-2 py-1 border rounded-md text-xs" 
                        onchange="updateProductDiscount(${product.id})" 
                        onkeyup="updateProductDiscount(${product.id})">
                </div>
                <input type="hidden" name="products[${product.id}][discounted_price]" value="${product.price}">
            </td>
            <td class="px-6 py-4" id="discounted-price-${product.id}">
                ${formatCurrency(product.price)}₫
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
        
        // Thêm dòng chọn kiểu in cho từng sản phẩm
        let printingHtml = '<td colspan="7" class="px-6 py-2 bg-gray-50"><div class="flex flex-wrap gap-4">';
        if (window.printingsData && window.printingsData.length > 0) {
            window.printingsData.forEach(printing => {
                printingHtml += `<div><div class="font-semibold text-blue-700 mb-1">${printing.name}</div><div class="space-y-1">`;
                printing.styles.forEach(style => {
                    printingHtml += `<label class="inline-flex items-center space-x-2 mr-4">` +
                        `<input type="checkbox" name="printing_styles[${product.id}][]" value="${style.id}" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">` +
                        `<span>${style.name} <span class="text-xs text-gray-500">(${Number(style.price).toLocaleString()}đ)</span></span>` +
                        `</label>`;
                });
                printingHtml += `</div></div>`;
            });
        }
        printingHtml += '</div></td>';
        const trPrint = document.createElement('tr');
        trPrint.innerHTML = printingHtml;
        return [tr, trPrint];
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
            quantity: 1,
            discountedPrice: parseFloat(selectedOption.dataset.price) // Giá sau giảm giá, ban đầu bằng giá gốc
        };
        
        console.log('Product object created:', product);

        orderItemsData.push(product);
        console.log('Product added to orderItemsData, total items:', orderItemsData.length);
        
        const [newRow, printRow] = createOrderItemRow(product);
        console.log('New row created:', newRow);
        console.log('Order items tbody:', orderItems);
        
        orderItems.appendChild(newRow);
        orderItems.appendChild(printRow);
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
                const discountedPrice = item.discountedPrice || item.price;
                subtotalCell.textContent = formatCurrency(discountedPrice * item.quantity) + '₫';
            }
            updateTotalAmount();
        }
    };

    window.updateProductDiscount = function(productId) {
        const item = orderItemsData.find(item => item.id === productId);
        if (item) {
            const discountTypeSelect = document.querySelector(`select[name="products[${productId}][discount_type]"]`);
            const discountValueInput = document.querySelector(`input[name="products[${productId}][discount_value]"]`);
            const discountedPriceCell = document.getElementById(`discounted-price-${productId}`);
            const subtotalCell = document.getElementById(`subtotal-${productId}`);
            const discountedPriceHidden = document.querySelector(`input[name="products[${productId}][discounted_price]"]`);
            
            const discountType = discountTypeSelect.value;
            const discountValue = parseFloat(discountValueInput.value) || 0;
            
            let discountedPrice = item.price; // Giá gốc
            
            if (discountType === 'percentage' && discountValue > 0) {
                discountedPrice = item.price * (1 - discountValue / 100);
            } else if (discountType === 'fixed' && discountValue > 0) {
                discountedPrice = Math.max(0, item.price - discountValue);
            }
            
            // Cập nhật giá sau giảm giá
            item.discountedPrice = discountedPrice;
            
            // Cập nhật hiển thị
            discountedPriceCell.textContent = formatCurrency(discountedPrice) + '₫';
            subtotalCell.textContent = formatCurrency(discountedPrice * item.quantity) + '₫';
            discountedPriceHidden.value = discountedPrice;
            
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
    const orderItems = orderItemsData || [];
    const productsInputs = document.getElementById('products_inputs');
    productsInputs.innerHTML = '';
    orderItems.forEach((item) => {
        productsInputs.innerHTML += `<input type="hidden" name="products[${item.id}][id]" value="${item.id}">`;
        productsInputs.innerHTML += `<input type="hidden" name="products[${item.id}][quantity]" value="${item.quantity}">`;
        productsInputs.innerHTML += `<input type="hidden" name="products[${item.id}][discounted_price]" value="${item.discountedPrice || item.price}">`;
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
