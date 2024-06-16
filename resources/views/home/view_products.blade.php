<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.css')
</head>
<body>
    @include('home.header')

    <section id="selling-products" class="product-store bg-light-grey py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="imageholderview">
                        <img style="height: 550px; width: 100%;" src="/products/{{ $product->product_image }}" alt="{{ $product->product_name }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-detail">
                        <h3 class="product-title" style="color: black; font-weight: bold;">{{ $product->product_name }}</h3>
                        <div class="item-price text-primary font-weight-bold">LKR {{ $product->product_price }}</div>
                        <div class="product-description">
                            <p><strong>Description:</strong> <span class="text-black">{{ $product->product_description }}</span></p>
                        </div>
                        <div class="product-description">
                            <p><strong>Category:</strong> <span class="text-black font-weight-bold">{{ $product->product_category }}</span></p>
                        </div>
                        <div class="product-description">
                            <p><strong>Qty:</strong> <span class="text-black font-weight-bold">{{ $product->product_quantity }}</span></p>
                        </div>
                        <div class="cart-concern mt-1">
                            <form action="{{ url('add_cart', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg" style="width: 200px; height:45px;">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('home.footer')
</body>
</html>
