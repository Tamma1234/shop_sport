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
                <h1 class="text-3xl font-bold">Chi Tiết Đơn Hàng #{{ $order->id }}</h1>
            </div>
        </div>
    </div>

    <form action="{{ route('orders.update', $order->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Section: Thông tin khách hàng --}}
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <h2 class="text-xl font-semibold">Thông Tin Khách Hàng</h2>
                <p class="text-gray-500 text-sm">Thông tin người đặt hàng</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Tên Khách Hàng *</label>
                    <input type="text" name="customer_name" value="{{ $order->customer->name }}" readonly class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('customer_name') border-red-500 @enderror">
                    @error('customer_name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Số Điện Thoại *</label>
                    <input type="text" name="customer_phone" value="{{ $order->customer->phone }}" readonly class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('customer_phone') border-red-500 @enderror">
                    @error('customer_phone')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="customer_email" value="{{ $order->customer->email }}" readonly class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('customer_email') border-red-500 @enderror">
                @error('customer_email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Địa Chỉ Giao Hàng *</label>
                <textarea name="shipping_address" id="shipping_address" rows="3"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('shipping_address') border-red-500 @enderror"
                    placeholder="Nhập địa chỉ giao hàng chi tiết...">{{ $order->customer->address }}</textarea>
                @error('shipping_address')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Section: Sản phẩm --}}
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold">Sản Phẩm</h2>
                    <p class="text-gray-500 text-sm">Danh sách sản phẩm trong đơn hàng</p>
                </div>
                <div class="flex items-center gap-4">
                    <select id="product_select" class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn sản phẩm</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">
                            {{ $product->name }} - {{ number_format($product->price, 0, ',', '.') }}₫
                        </option>
                        @endforeach
                    </select>
                    <button type="button" id="add_product" class="bg-gray-900 text-white px-4 py-2 rounded-md hover:bg-gray-800">
                        Thêm
                    </button>
                </div>
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
                        @foreach($order->orderItems as $item)
                        <tr data-product-id="{{ $item->product_id }}">
                            <td class="px-6 py-4">{{ $item->product->name }}</td>
                            <td class="px-6 py-4">{{ number_format($item->price, 0, ',', '.') }}₫</td>
                            <td class="px-6 py-4">
                                <input type="number" name="quantities[{{ $item->product_id }}]" value="{{ $item->quantity }}"
                                    min="1" max="{{ $item->product->stock }}" class="w-20 px-2 py-1 border rounded-md"
                                    onchange="updateQuantity({{ $item->product_id }}, this.value)">
                            </td>
                            <td class="px-6 py-4">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</td>
                            <td class="px-6 py-4">
                                <button type="button" onclick="removeProduct({{ $item->product_id }})" class="text-red-600 hover:text-red-800">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-medium">Tổng cộng:</td>
                            <td class="px-6 py-4 font-bold" id="total_amount">{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Chọn các kiểu in <span class="text-xs text-gray-400">(Chọn nhiều kiểu in nếu cần)</span></label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($printings as $printing)
                <div>
                    <div class="font-semibold text-blue-700 mb-1">{{ $printing->name }}</div>
                    <div class="space-y-1">
                        @foreach($printing->styles as $style)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="printing_style_ids[]" value="{{ $style->id }}" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            <span>{{ $style->name }} <span class="text-xs text-gray-500">({{ number_format($style->price) }}đ)</span></span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <p class="text-xs text-gray-500 mt-1 italic">Bạn có thể chọn nhiều kiểu in cho đơn hàng này.</p>
        </div>


        {{-- Section: Thanh toán & Ghi chú --}}
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <h2 class="text-xl font-semibold">Thanh Toán & Ghi Chú</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Phương Thức Thanh Toán *</label>
                    <select name="payment_method" id="payment_method"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('payment_method') border-red-500 @enderror">
                        <option value="cod" @selected(old('payment_method', $order->payment_method) == 'cod')>Thanh toán khi nhận hàng (COD)</option>
                        <option value="bank_transfer" @selected(old('payment_method', $order->payment_method) == 'bank_transfer')>Chuyển khoản ngân hàng</option>
                    </select>
                    @error('payment_method')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Trạng Thái *</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                        <option value="pending" @selected(old('status', $order->status) == 'pending')>Chờ xử lý</option>
                        <option value="processing" @selected(old('status', $order->status) == 'processing')>Đang xử lý</option>
                        <option value="completed" @selected(old('status', $order->status) == 'completed')>Hoàn thành</option>
                        <option value="cancelled" @selected(old('status', $order->status) == 'cancelled')>Đã hủy</option>
                    </select>
                    @error('status')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <label for="deposit" class="block text-sm font-medium text-gray-700 mb-1">Tiền Cọc</label>
                <input type="number" name="deposit" id="deposit"
                    value="{{ old('deposit', (int) $order->deposit) }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deposit') border-red-500 @enderror"
                    placeholder="VD: 100000">
                @error('deposit')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Ghi Chú</label>
                <textarea name="notes" id="notes" rows="3"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ghi chú thêm về đơn hàng...">{{ $order->customer->note }}</textarea>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" class="bg-gray-900 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition duration-200">
                    Cập Nhật Đơn Hàng
                </button>
                @if($order->status !== 'cancelled')
                <button type="button" onclick="cancelOrder()" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md transition duration-200">
                    Hủy Đơn Hàng
                </button>
                @endif
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productSelect = document.getElementById('product_select');
        const addProductBtn = document.getElementById('add_product');
        const orderItems = document.getElementById('order_items');
        const totalAmountElement = document.getElementById('total_amount');
        let orderItemsData = [];

        // Khởi tạo dữ liệu từ các sản phẩm hiện có
        document.querySelectorAll('#order_items tr[data-product-id]').forEach(row => {
            const productId = parseInt(row.dataset.productId);
            const name = row.cells[0].textContent;
            const price = parseFloat(row.cells[1].textContent.replace(/[^\d]/g, ''));
            const quantity = parseInt(row.querySelector('input[type="number"]').value);
            const stock = parseInt(row.querySelector('input[type="number"]').getAttribute('max'));

            orderItemsData.push({
                id: productId,
                name,
                price,
                quantity,
                stock
            });
        });

        function updateTotalAmount() {
            const total = orderItemsData.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            totalAmountElement.textContent = formatCurrency(total) + '₫';
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN').format(amount);
        }

        function createOrderItemRow(product) {
            const tr = document.createElement('tr');
            tr.dataset.productId = product.id;
            tr.innerHTML = `
            <td class="px-6 py-4">${product.name}</td>
            <td class="px-6 py-4">${formatCurrency(product.price)}₫</td>
            <td class="px-6 py-4">
                <input type="number" name="quantities[${product.id}]" value="${product.quantity}" min="1" max="${product.stock}"
                    class="w-20 px-2 py-1 border rounded-md" onchange="updateQuantity(${product.id}, this.value)">
            </td>
            <td class="px-6 py-4">${formatCurrency(product.price * product.quantity)}₫</td>
            <td class="px-6 py-4">
                <button type="button" onclick="removeProduct(${product.id})" class="text-red-600 hover:text-red-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </td>
        `;
            return tr;
        }

        addProductBtn.addEventListener('click', function() {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            if (!selectedOption.value) return;

            const productId = parseInt(selectedOption.value);
            if (orderItemsData.some(item => item.id === productId)) {
                alert('Sản phẩm này đã có trong đơn hàng!');
                return;
            }

            const product = {
                id: productId,
                name: selectedOption.text.split(' - ')[0],
                price: parseFloat(selectedOption.dataset.price),
                stock: parseInt(selectedOption.dataset.stock),
                quantity: 1
            };

            orderItemsData.push(product);
            orderItems.appendChild(createOrderItemRow(product));
            updateTotalAmount();
            productSelect.value = '';
        });

        // Thêm các hàm này vào global scope để có thể gọi từ inline event handlers
        window.updateQuantity = function(productId, newQuantity) {
            const item = orderItemsData.find(item => item.id === productId);
            if (item) {
                item.quantity = parseInt(newQuantity);
                const row = orderItems.querySelector(`tr[data-product-id="${productId}"]`);
                row.cells[3].textContent = formatCurrency(item.price * item.quantity) + '₫';
                updateTotalAmount();
            }
        };

        window.removeProduct = function(productId) {
            orderItemsData = orderItemsData.filter(item => item.id !== productId);
            const row = orderItems.querySelector(`tr[data-product-id="${productId}"]`);
            if (row) {
                row.remove();
                updateTotalAmount();
            }
        };

        window.cancelOrder = function() {
            if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')) {
                document.getElementById('status').value = 'cancelled';
                document.querySelector('form').submit();
            }
        };
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