<!DOCTYPE html>
<html>
<head>
    @include('admin.css')
    <link rel="stylesheet" href="{{ asset('css/updateproduct.css') }}"> <!-- Link to custom CSS -->
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <h1 class="upprod_title1" style="color: #830e0e; margin-bottom: 20px; margin-top: 15px; font-weight: bold; ">Update Product</h1>

            <div class="d-flex justify-content-center"> <!-- Center the form -->
                <form action="{{ url('edit_product', $product->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation update-prod-form" novalidate>

                    @csrf
                    {{-- @method('PUT') --}}

                    <div class="form-group update-prod-group">
                        <label for="productTitle" class="update-prod-label">Product Title</label>
                        <input type="text" class="form-control update-prod-input" id="productTitle" name="title" value="{{ $product->product_name }}" required>
                        <div class="invalid-feedback">
                            Please provide a product title.
                        </div>
                    </div>

                    <div class="form-group update-prod-group">
                        <label for="productDescription" class="update-prod-label">Description</label>
                        <textarea class="form-control update-prod-textarea" id="productDescription" name="description" required>{{ $product->product_description }}</textarea>
                        <div class="invalid-feedback">
                            Please provide a product description.
                        </div>
                    </div>

                    <div class="form-group update-prod-group">
                        <label for="productPrice" class="update-prod-label">Price</label>
                        <input type="text" class="form-control update-prod-input" id="productPrice" name="price" value="{{ $product->product_price }}" required>
                        <div class="invalid-feedback">
                            Please provide a product price.
                        </div>
                    </div>

                    <div class="form-group update-prod-group">
                        <label for="productQuantity" class="update-prod-label">Quantity</label>
                        <input type="number" class="form-control update-prod-input" id="productQuantity" name="quantity" value="{{ $product->product_quantity }}" required>
                        <div class="invalid-feedback">
                            Please provide a product quantity.
                        </div>
                    </div>

                    <div class="form-group update-prod-group">
                        <label for="productCategory" class="update-prod-label">Category</label>
                        <select class="form-control update-prod-select" id="productCategory" name="category" required>
                            <option value="{{ $product->product_category }}">{{ $product->product_category }}</option>
                            <!-- Add other categories dynamically if needed -->
                        @foreach ($category as $category)
                        <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>

                        @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a product category.
                        </div>
                    </div>

                    <div class="form-group update-prod-group">
                        <label for="currentImage" class="update-prod-label">Current Image</label>
                        <div>
                            <img src="/products/{{ $product->product_image }}" alt="Current Product Image" width="100" height="100" class="img-thumbnail">
                        </div>
                    </div>

                    <div class="form-group update-prod-group">
                        <label for="productImage" class="update-prod-label">Add New Image</label>
                        <input type="file" class="form-control-file update-prod-file-input" id="productImage" name="image">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-success update-prod-button">Update Product</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @include('admin.js')

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
