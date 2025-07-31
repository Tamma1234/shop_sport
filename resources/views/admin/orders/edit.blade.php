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
                <label for="note" class="block text-sm font-medium text-gray-700 mb-1">Hình thức mua hàng</label>
                <input type="text" name="note" value="{{ old('note', $order->note) }}" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('note') border-red-500 @enderror" placeholder="VD: Mua tại cửa hàng, online, ...">
                @error('note')
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

        {{-- Section: Quà tặng và giảm giá --}}
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <h2 class="text-xl font-semibold">Quà Tặng & Giảm Giá</h2>
                <p class="text-gray-500 text-sm">Chọn quà tặng và cấu hình giảm giá</p>
            </div>
            
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
                                                    data-gift-price="{{ $gift->price }}"
                                                    @if($order->gifts->contains($gift->id)) checked @endif>
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
                                                    value="{{ $order->gifts->contains($gift->id) ? ($order->gifts->find($gift->id)->pivot->quantity ?? 1) : 1 }}" 
                                                    min="1" max="10"
                                                    class="gift-quantity w-16 px-2 py-1 border rounded-md text-sm"
                                                    data-gift-id="{{ $gift->id }}"
                                                    @if(!$order->gifts->contains($gift->id)) disabled @endif>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Đơn Giá Gốc</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Giảm Giá</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Đơn Giá Sau Giảm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Số Lượng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thành Tiền</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                        </tr>
                    </thead>
                    <tbody id="order_items" class="bg-white divide-y divide-gray-200">
                        @foreach($order->orderItems as $item)
                        <tr data-product-id="{{ $item->product_id }}">
                            <td class="px-6 py-4">
                                {{ $item->product->name }}
                                <input type="hidden" name="products[{{ $item->product_id }}][id]" value="{{ $item->product_id }}">
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($item->product->price, 0, ',', '.') }}₫
                                <input type="hidden" name="products[{{ $item->product_id }}][original_price]" value="{{ $item->product->price }}">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <select name="products[{{ $item->product_id }}][discount_type]" class="w-20 px-2 py-1 border rounded-md text-xs" onchange="updateProductDiscount({{ $item->product_id }})">
                                        <option value="none">Không</option>
                                        <option value="percentage">%</option>
                                        <option value="fixed">₫</option>
                                    </select>
                                    <input type="number" name="products[{{ $item->product_id }}][discount_value]" value="0" min="0" step="0.01" 
                                        class="w-20 px-2 py-1 border rounded-md text-xs" 
                                        onchange="updateProductDiscount({{ $item->product_id }})" 
                                        onkeyup="updateProductDiscount({{ $item->product_id }})">
                                </div>
                                <input type="hidden" name="products[{{ $item->product_id }}][discounted_price]" value="{{ $item->price }}">
                            </td>
                            <td class="px-6 py-4" id="discounted-price-{{ $item->product_id }}">
                                {{ number_format($item->price, 0, ',', '.') }}₫
                            </td>
                            <td class="px-6 py-4">
                                <input type="number" name="products[{{ $item->product_id }}][quantity]" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                    class="w-20 px-2 py-1 border rounded-md"
                                    onchange="updateQuantity({{ $item->product_id }}, this.value)">
                            </td>
                            <td class="px-6 py-4" id="subtotal-{{ $item->product_id }}">
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫
                            </td>
                            <td class="px-6 py-4">
                                <button type="button" onclick="removeProduct({{ $item->product_id }})" class="text-red-600 hover:text-red-800">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="px-6 py-2 bg-gray-50">
                                <div class="flex flex-wrap gap-4">
                                    @foreach($printings as $printing)
                                        <div>
                                            <div class="font-semibold text-blue-700 mb-1">{{ $printing->name }}</div>
                                            <div class="space-y-1">
                                                @foreach($printing->styles as $style)
                                                    <label class="inline-flex items-center space-x-2 mr-4">
                                                        <input type="checkbox"
                                                            name="printing_styles[{{ $item->product_id }}][]"
                                                            value="{{ $style->id }}"
                                                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                                            @if(optional($item->printingStyles)->contains($style->id)) checked @endif>
                                                        <span>{{ $style->name }} <span class="text-xs text-gray-500">({{ number_format($style->price) }}đ)</span></span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-right font-medium">Tổng cộng:</td>
                            <td class="px-6 py-4 font-bold" id="total_amount">{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                            <td></td>
                        </tr>
                        <tr id="order_discount_row" class="hidden">
                            <td colspan="5" class="px-6 py-4 text-right font-medium text-green-600">Giảm giá đơn hàng:</td>
                            <td class="px-6 py-4 font-bold text-green-600" id="order_discount_amount">0₫</td>
                            <td></td>
                        </tr>
                        <tr id="final_total_row">
                            <td colspan="5" class="px-6 py-4 text-right font-medium">Tổng thanh toán:</td>
                            <td class="px-6 py-4 font-bold text-lg" id="final_total">{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Hidden input để gửi dữ liệu sản phẩm --}}
        <div id="products_inputs"></div>

        <!-- <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Chọn các kiểu in <span class="text-xs text-gray-400">(Chọn nhiều kiểu in nếu cần)</span></label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($printings as $printing)
                <div>
                    <div class="font-semibold text-blue-700 mb-1">{{ $printing->name }}</div>
                    <div class="space-y-1">
                        @foreach($printing->styles as $style)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="printing_style_ids[]" value="{{ $style->id }}" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" @if(optional($order->printingStyles)->contains($style->id)) checked @endif>
                            <span>{{ $style->name }} <span class="text-xs text-gray-500">({{ number_format($style->price) }}đ)</span></span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <p class="text-xs text-gray-500 mt-1 italic">Bạn có thể chọn nhiều kiểu in cho đơn hàng này.</p>
        </div> -->


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
                <input type="text" name="deposit" id="deposit"
                    value="{{ old('deposit', number_format($order->deposit, 0, ',', '.')) }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deposit') border-red-500 @enderror"
                    placeholder="VD: 100,000">
                <input type="hidden" name="deposit_value" id="deposit_value" value="{{ old('deposit', $order->deposit) }}">
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
// Khai báo dữ liệu printings từ PHP
var printingsData = {!! json_encode($printings ?? []) !!};
window.printingsData = printingsData;

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing order edit form...');
    
    const productSelect = document.getElementById('product_select');
    const addProductBtn = document.getElementById('add_product');
    const orderItems = document.getElementById('order_items');
    const totalAmountElement = document.getElementById('total_amount');
    const finalTotalElement = document.getElementById('final_total');
    const orderDiscountRow = document.getElementById('order_discount_row');
    const orderDiscountAmountElement = document.getElementById('order_discount_amount');
    
    let orderItemsData = [];

    // Khởi tạo dữ liệu từ các sản phẩm hiện có
    document.querySelectorAll('#order_items tr[data-product-id]').forEach(row => {
        const productId = parseInt(row.dataset.productId);
        const name = row.cells[0].textContent.trim();
        const originalPrice = parseFloat(row.querySelector('input[name*="[original_price]"]').value);
        const discountedPrice = parseFloat(row.querySelector('input[name*="[discounted_price]"]').value);
        const quantity = parseInt(row.querySelector('input[name*="[quantity]"]').value);
        const stock = parseInt(row.querySelector('input[name*="[quantity]"]').getAttribute('max'));

        orderItemsData.push({
            id: productId,
            name,
            price: originalPrice,
            discountedPrice: discountedPrice,
            quantity,
            stock
        });
    });

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

    window.cancelOrder = function() {
        if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')) {
            document.getElementById('status').value = 'cancelled';
            document.querySelector('form').submit();
        }
    };
    
    console.log('Order edit form initialization completed');
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
        const numericValue = parseInt(value);
        const formattedValue = numericValue.toLocaleString('vi-VN');
        input.value = formattedValue;
        document.getElementById('deposit_value').value = numericValue;
    } else {
        input.value = '';
        document.getElementById('deposit_value').value = '';
    }
}

// Khởi tạo format cho deposit input
const depositInput = document.getElementById('deposit');
if (depositInput) {
    depositInput.addEventListener('input', function() {
        formatDepositCurrency(this);
    });
    
    // Format giá trị ban đầu nếu có
    if (depositInput.value) {
        formatDepositCurrency(depositInput);
    }
}

// Khi submit form, đảm bảo gửi giá trị số thực
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const depositValueInput = document.getElementById('deposit_value');
            const depositDisplayInput = document.getElementById('deposit');
            
            if (depositValueInput && depositDisplayInput) {
                // Gửi giá trị số thực thay vì giá trị đã format
                depositDisplayInput.value = depositValueInput.value || '0';
            }
        });
    }
});
</script>
@endpush
