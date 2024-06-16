<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.css')
    <style>
        /* Custom CSS for shopping cart */
        body {
            margin-top: 20px;
            background-color: #f1f3f7;
        }

        .avatar-lg {
            height: 5rem;
            width: 5rem;
            margin-left: 20px;
            margin-top: 20px;
        }

        .ms-2 {
            margin-inline-start: .5rem;
            margin-top: 20px;
            margin-left: 500px;
        }

        .font-size-18 {
            font-size: 18px !important;
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        a {
            text-decoration: none !important;
        }

        .w-xl {
            min-width: 160px;
        }

        strong {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 24px;
            -webkit-box-shadow: 0 2px 3px #e4e8f0;
            box-shadow: 0 2px 3px #e4e8f0;
            max-width: 800px;
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #eff0f2;
            border-radius: 1rem;
        }

        /* Add margin between image and text */
        .product-info {
            margin-left: 20px;
            margin-top: 20px;
        }

        /* Add margin between product name and color */
        .product-name {
            margin-bottom: 10px; /* Adjust as needed */
        }

        .col-md-4 {
            float: left;
            position: relative;
            min-height: 1px;
            padding-left: 15px;
            padding-right: 15px;
            width: 100%;
            margin-right: 20px;
            margin-left: 20px;
        }

        .col-md-5 {
            float: left;
            position: relative;
            min-height: 1px;
            padding-left: 15px;
            padding-right: 15px;
            width: 100%;
            margin-right: 20px;
            margin-left: 20px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
        }

        .quantity-control button {
            background-color: #ddd;
            border: 1px solid #ccc;
            padding: 5px 10px; /* Adjust padding for better appearance */
            cursor: pointer;
            font-size: 16px; /* Adjust font size for visibility */
        }

        .quantity-control input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            margin: 0 5px;
            font-size: 16px; /* Adjust font size for consistency */
        }
        .shopc{
            font-weight: bold;
            font-size: 40px;
            text-align: center;
         }

         /* Custom background color for the order summary card */
        .order-summary-card {
            background-color: #87CEEB; /* Sky blue color */
        }

        .card-body .btn{
            background-color: #000000; /* Sky blue color */
            color: #ffffff;
            margin-top:1rem;
            padding: .6rem;
            border-radius: 1rem
        }

    </style>
</head>
<body>

@include('home.header')

<div class="container">
    <div class="row justify-content-center"> <!-- Center the row content -->

        <h1 class="shopc">Shopping Cart</h1>

        <div class="col-xl-8">
            <?php $value = 0; ?>

            @foreach($cart as $item)
                <?php $itemTotal = $item->product->product_price * $item->quantity; ?>
                <div class="card border shadow-none mx-auto">
                    <div class="card">
                        <div class="d-flex align-items-start border-bottom pb-3">
                            <div class="me-4">
                                <img width="100px" src="/products/{{ $item->product->product_image }}" alt="Product Image" class="avatar-lg rounded">
                            </div>

                            <div class="flex-grow-1 align-self-center overflow-hidden product-info">
                                <div class="product-name">
                                    <h5 class="text-truncate font-size-18">
                                        <a href="#" class="text-dark"><strong>{{ $item->product->product_name }}</strong></a>
                                    </h5>
                                    <p class="text-muted mb-0">
                                        @for ($i = 0; $i < $item->product->rating; $i++)
                                            <i class="bx bxs-star text-warning"></i>
                                        @endfor
                                    </p>
                                </div>
                                <p class="mb-0 mt-1">Color: <span class="fw-medium">{{ $item->product->color }}</span></p>
                            </div>
                            <div class="flex-shrink-0 ms-2">
                                <form action="{{ route('delete_cart_item', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="text-muted px-1" style="border: none; background: none;">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mt-3">
                                    <p class="text-muted mb-2">Price</p>
                                    <h5 class="mb-0 mt-2">LKR{{ $item->product->product_price }}</h5>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mt-3">
                                    <p class="text-muted mb-2">Quantity</p>
                                    <div class="quantity-control">
                                        <button onclick="updateQuantity('{{ $item->id }}', -1)">-</button>
                                        <input type="number" id="quantity-{{ $item->id }}" value="{{ $item->quantity }}" min="1" max="8" readonly data-price="{{ $item->product->product_price }}">
                                        <button onclick="updateQuantity('{{ $item->id }}', 1)">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mt-3">
                                    <p class="text-muted mb-2">Total</p>
                                    <h5 id="total-{{ $item->id }}">LKR{{ $itemTotal }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $value += $itemTotal; ?>
            @endforeach
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-8">
            <div class="mt-5 mt-lg-0 mx-auto">
                <div class="card border shadow-none">
                    <div class="card-header bg-transparent border-bottom py-3 px-4">
                        <h5 class="font-size-16 mb-0">Order Summary: <span id="order-summary-value">LKR{{ $value }}</span></h5>
                    </div>
                    <div class="card-body p-4 pt-2">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td><strong>Product</strong></td>
                                        <td><strong>Quantity</strong></td>
                                        <td><strong>Total Price</strong></td>
                                    </tr>
                                    @foreach($cart as $item)
                                        <tr id="order-summary-row-{{ $item->id }}">
                                            <td>{{ $item->product->product_name }}</td>
                                            <td id="summary-quantity-{{ $item->id }}">{{ $item->quantity }}</td>
                                            <td id="summary-total-{{ $item->id }}">LKR{{ $item->product->product_price * $item->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <div class="col-xl-8 mt-5">
            <div class="card border shadow-none">
                <div class="card-header bg-transparent border-bottom py-3 px-4">
                    <h5 class="font-size-16 mb-0">Delivery Information</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ url('checkout') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="credit_card">Credit Card</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="cash_on_delivery">Cash on Delivery</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateQuantity(cartItemId, change) {
        let quantityInput = document.getElementById('quantity-' + cartItemId);
        let newQuantity = parseInt(quantityInput.value) + change;
        if (newQuantity < 1) newQuantity = 1;
        if (newQuantity > 8) newQuantity = 8;

        let price = quantityInput.getAttribute('data-price');
        let totalElement = document.getElementById('total-' + cartItemId);

        quantityInput.value = newQuantity;
        totalElement.innerText = 'LKR' + (newQuantity * price);

        // Update the order summary
        document.getElementById('summary-quantity-' + cartItemId).innerText = newQuantity;
        document.getElementById('summary-total-' + cartItemId).innerText = 'LKR' + (newQuantity * price);

        updateOrderSummary();
    }

    function updateOrderSummary() {
        let orderSummaryValue = document.getElementById('order-summary-value');
        let totalValue = 0;

        document.querySelectorAll('[id^="total-"]').forEach(element => {
    let numericValue = parseFloat(element.innerText.replace('LKR', ''));
    if (!isNaN(numericValue)) {
        totalValue += numericValue;
    }
});


        orderSummaryValue.innerText = 'LKR' + totalValue;
    }
</script>


@include('home.footer')

</body>
</html>
