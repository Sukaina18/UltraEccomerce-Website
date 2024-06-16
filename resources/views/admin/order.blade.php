<!DOCTYPE html>
<html>
<head>
    @include('admin.css')

    <style>
        table {
            border: 2px solid rgb(235, 135, 205);
            text-align: center;
            width: 80%;
            margin: 0 auto;  */
        }

        th {
            background-color: skyblue;
            padding: 10px; /* Reduce the padding */
            font-size: 16px; /* Reduce the font size */
            font-weight: bold;
        }

        td {
            padding: 8px; /* Reduce the padding */
            color: #f0ecec;
        }

        .table thead th {
            background-color: rgb(111, 10, 10);
            color: white;
        }

        .table-responsive {
            overflow-x: auto; /* Add horizontal scrollbar if needed */
        }

        img {
            max-width: 80px; /* Limit the image size */
            max-height: 80px;
        }

        .btn {
            font-size: 14px; /* Reduce button font size */
            padding: 5px 10px; /* Reduce button padding */
        }
        h1{
            color: white;
            font-size: 30px;
            text-align: center
        }
        .page-header1{
        background: #2d3035;
        color: #12306c;
        margin-bottom: 30px;
}

    </style>
</head>
<body>
@include('admin.header')
@include('admin.sidebar')

<div class="page-content">
    <div class="page-header1 ">
        <div class="container-fluid">
            <h1>Orders</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Quantity</th>
                        <th>Product Name</th>
                        <th>Payment Type</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Update Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($product as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->delivery_address }}</td>
                            <td>{{ $item->phone_no }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->product->product_name }}</td>
                            <td>{{ $item->payment_method }}</td>
                            <td>{{ $item->product->product_price }}</td>
                            <td><img src="products/{{ $item->product->product_image }}" alt="Product Image"></td>
                            <td>
                                @if( $item->status =='in progress' )
                                    <span style="color: rgb(199, 40, 12)">{{ $item->status }}</span>
                                @elseif( $item->status =='Out for Delivery' )
                                    <span style="color: rgb(215, 231, 50)">{{ $item->status }}</span>
                                @else
                                    <span style="color: rgb(0, 255, 0)">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-outline-warning" href="{{url('out_for_delivery', $item->id) }}">Out for Delivery</a>
                                <a class="btn btn-outline-success" href="{{ url('delivered', $item->id) }}">Delivered</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.js')
</body>
</html>
