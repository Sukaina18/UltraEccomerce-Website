{{-- starting best selling products --}}
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


<section id="selling-products" class="product-store bg-light-grey padding-large">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Best selling products</h2>
        </div>
        <ul class="tabs list-unstyled">
            <li data-tab-target="#all" class="active tab">All</li>
            <li data-tab-target="#shoes" class="tab">Shoes</li>
            <li data-tab-target="#tshirts" class="tab">Tshirts</li>
            <li data-tab-target="#pants" class="tab">Pants</li>
            <li data-tab-target="#hoodie" class="tab">Hoodie</li>
            <li data-tab-target="#outer" class="tab">Outer</li>
            <li data-tab-target="#jackets" class="tab">Jackets</li>
            <li data-tab-target="#accessories" class="tab">Accessories</li>
        </ul>

        <div class="tab-content">
            <div id="all" data-tab-content class="active">
                <div class="row productsrow d-flex flex-wrap">
                    @foreach ($products as $product)
                    <div class="product-item col-lg-3 col-md-6 col-sm-6 p-4">
                        <div class="image-holder">
                         <img src="/products/{{ $product->product_image }}"  class="product-image">
                        </div>
                        <div class="cart-concern">
                            <div class="cart-button d-flex justify-content-between align-items-center">
                               <a class="btn btn-group-toggle" href="{{ url('add_cart', $product->id) }}">Add to Cart</a>
                                <button type="button" class="view-btn tooltip d-flex">
                                    <i class="icon icon-screen-full"></i>
                                    <span class="tooltip-text">Quick view</span>
                                </button>
                                <button type="button" class="wishlist-btn">
                                    <i class="icon icon-heart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="product-detail">
                            <h3 class="product-title">
                                <a href="">{{ $product->product_name }}</a>
                            </h3>
                            <div class="item-price text-primary">LKR {{ $product->product_price }}</div>
                        </div>
                        <div class="buttons">
                            <a class="btn btn-group-toggle" href="{{ url('view_products', $product->id) }}">View Details</a>
                            <a class="btn btn-group-toggle" href="{{ url('add_cart', $product->id) }}">Add to Cart</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ending best selling products --}}
