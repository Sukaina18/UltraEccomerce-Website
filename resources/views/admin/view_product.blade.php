<!DOCTYPE html>
<html>
<head>
    @include('admin.css')
    <style>
        .custom-td {
    text-align: center;
}

.all-products-caption {
    font-size: 24px;
    font-weight: bold;
    text-align: center; /* Optional: Center the caption */
    padding-top: 20px; /* Add some space above the caption */
}

.prod_title{
    color: white;
    font-size: 35px;
    font-weight: bold;
    text-align: center;
    text-decoration-line:underline
}

.pagination-container {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}

.pagination .page-item .page-link {
    color: rgb(151, 19, 19); /* Page link color */
    border: 1px solid rgb(1, 1, 1); /* Border color */
}

.pagination .page-item.active .page-link {
    background-color: rgb(151, 19, 19); /* Active page background color */
    border-color: rgb(151, 19, 19); /* Active page border color */
}

.pagination .page-item .page-link:hover {
    background-color: rgb(151, 19, 19); /* Hover background color */
    border-color: rgb(151, 19, 19); /* Hover border color */
    color: white; /* Hover text color */
}

.upprod_title{
    color: rgb(24, 24, 24);
    font-size: 35px;
    font-weight: bold;
    text-align: center;

}

.update-prod-input,
.update-prod-textarea,
.update-prod-select,
.update-prod-file-input {
    border-radius: 10px;
    padding: 10px;
    background-color: transparent;
    color: #fff;
    border: 1px solid #555;
    width: 60%; /* Set the width to 70% */
    margin-bottom: 10px;
}

.update-prod-textarea {
    height: 150px;
}

.update-prod-button {
    margin-top: 20px;
    padding: 10px 20px;
    border-radius: 10px;
    width: 30%; /* Optional: Make the button wider */
    text-align: center;
}

.upprod_title1 {
    margin-bottom: 20px;
    margin-top: 15px;
    color: #830e0e;
    font-weight: bold;
    text-align: center;
}

.update-prod-form {
    margin-top: 20px;
    background-color: transparent;
    color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 60%; /* Center form and reduce width */
}

.update-prod-group {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
    /* align-items: center; */
}

.update-prod-label {
    font-weight: bold;
    color: #8d8a8a;
    font-size: 16px;
}

.search-container {
    display: flex;
    justify-content: left;
    align-items: center;

}

form {
    display: flex;
}

input[type="search"] {
    padding: 10px;
    border-radius: 5px 0 0 5px;
    border: 1px solid #ccc;
    font-size: 16px;
}

.search-button {
    padding: 10px 20px;
    background-color: #a71f1f;
    color: #fff;
    border: none;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

.search-button:hover {
    background-color: #0056b3;
}


/* customer.css */
.customer tbody tr td {
    color: white;
}

.customer thead {
    text-align: center;
    background-color: rgb(189, 17, 17);
    font-weight: bold;
}

.customer tbody tr:nth-child(even) {
    background-color: #343a40; /* Dark background for even rows */
}

.customer tbody tr:nth-child(odd) {
    background-color: #454d55; /* Slightly lighter background for odd rows */
}

h2 {
    background-color: transparent;
    color: white;
    font-weight: bold;
    text-align: center;
    padding: 15px;
    border-radius: 5px;
}



table{
    border: 2px solid rgb(235, 135, 205);
    text-align: center;
}

th{
    background-color: rgb(155, 17, 17);
    padding: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    text-align: center;
}
.table_center{
    display: flex;
    justify-content: center;
    align-items: center;

}
td{
    color: #f0ecec;
}

.table thead th {
    background-color: rgb(111, 10, 10);
    color: white;
}
    </style>

</head>
<body>

@include('admin.header')
@include('admin.sidebar')



<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">


            <div class="search-container">
                <form action="{{ url('product_search') }}" method="GET">
                    @csrf
                    <input type="search" name="search" placeholder="Search...">
                    <button type="submit" class="search-button">Search</button>
                </form>
            </div>

            <h1 class="prod_title">Products</h1>

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-17"> <!-- Increased the column width -->
                        <div class="table-responsive">
                            <table class="custom-table custom-table-bordered table-striped table-bordered">
                                <thead class="custom-thead">



                                    <tr>
                                        <th class="custom-th">Product ID</th>
                                        <th class="custom-th">Product Title</th>
                                        <th class="custom-th">Product Description</th>
                                        <th class="custom-th">Product Price</th>
                                        <th class="custom-th">Product Category</th>
                                        <th class="custom-th">Product Quantity</th>
                                        <th class="custom-th">Product Image</th>
                                        <th class="custom-th">Edit</th>
                                        <th class="custom-th">Delete</th>



                                    </tr>
                                </thead>
                                <tbody>
                                <!-- table rows will go here -->

                                @foreach ($product as $products)

                                    <tr>

                                        <td class="custom-td">{{ $products->id}}</td>
                                        <td class="custom-td">{{ $products->product_name }}</td>
                                        <td class="custom-td">{!!Str::limit($products->product_description,50)!!}</td>
                                        <td class="custom-td">{{ $products->product_price }}</td>
                                        <td class="custom-td">{{ $products->product_category }}</td>
                                        <td class="custom-td">{{ $products->product_quantity }}</td>
                                        <td class="custom-td">
                                            <img height="100" width="100" src="products/{{ $products->product_image }}" >
                                        </td>

                                        <td>
                                            <a class="btn btn-outline-warning" href="{{ url('update_product', $products->id) }}">Edit</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-danger"  onclick="confirmation(event)" href="{{ url('delete_product', $products->id) }}">Delete</a>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>

                         <div class="pagination-container">
                            {{ $product->onEachSide(1)->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.js')

</body>
</html>
