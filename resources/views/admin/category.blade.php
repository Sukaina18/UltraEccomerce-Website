<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <style>



.cat_title {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

.cat_deg {
    margin-bottom: 20px;
}

.cat_format {
    text-align: center;
}

.cat_format input[type="text"] {
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
}

.cat_format input[type="submit"] {
    padding: 5px 10px;
    border: none;
    background-color: #b71c0e;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
}

.cat_format input[type="submit"]:hover {
    background-color: #e81010;
}

.cat_table {
    width: 70%;
    margin: 0 auto;
    border-collapse: collapse;
    text-align: center;
}

.th_table {
    background-color: rgb(183, 33, 33);
    color: white;
    border: 1px solid white;
    padding: 8px;

}

.td_cat {
    border: 1px solid #ddd;
    padding: 8px;
}

.td_cat a {
    margin-right: 5px;
}

.td_cat a:hover {
    text-decoration: none;
}
    </style>

</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <h class="cat_title">Add Category</h>
                <div class="cat_deg">

                    <form action="{{ url('add_category') }}" method="post">
                        @csrf

                        <div class="cat_format">
                            <input type="text" name="category">
                            <input class="btn btn-primary" type="submit" value="Add Category">
                        </div>
                    </form>
                </div>

                <div>

                    <table class="cat_table centerd">
                        <tr>
                            <th class="th_table">Category Name</th>
                            <th class="th_table">Edit</th>
                            <th class="th_table">Delete </th>

                        </tr>
                        {{-- fetching category from the database --}}

                        @foreach ($data as $data)
                            <tr>
                                <td class="td_cat">{{ $data->category_name }}</td>
                                <td class="td_cat">
                                    <a class="btn btn-outline-success" href="{{ url('edit_category', $data->id) }}">
                                        Edit</a>
                                </td>


                                <td class="td_cat">
                                    <a class="btn btn-outline-danger" onclick="confirmation(event)"
                                        href="{{ url('delete_category', $data->id) }}">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                    </table>

                </div>



            </div>
        </div>
    </div>


        @include('admin.js')
</body>

</html>
