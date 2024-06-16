<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">



            <title>Add Products</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          </head>
          <body>
            <div class="container mt-5">
              <h1 class="text-center mb-4">Add Products</h1>
              <form action="{{ url('upload_product') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <div class="form-group row">
                  <label for="productTitle" class="col-sm-3 col-form-label">Product Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="productTitle" name="title" required>
                    <div class="invalid-feedback">
                      Please provide a product title.
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="productDescription" class="col-sm-3 col-form-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" id="productDescription" name="description"></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="productPrice" class="col-sm-3 col-form-label">Price</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="productPrice" name="price">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="productQuantity" class="col-sm-3 col-form-label">Quantity</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="productQuantity" name="qty">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="productCategory" class="col-sm-3 col-form-label">Product Category</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="productCategory" name="category" required>
                      <option value="" selected disabled>Select Category</option>
                      @foreach ($category as $category)
                        <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="productImage" class="col-sm-3 col-form-label">Product Image</label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control-file" id="productImage" name="image">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-danger">Add Product</button>
                  </div>
                </div>
              </form>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

  @include('admin.js')
  </body>
</html>
