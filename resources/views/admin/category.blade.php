<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
        input[type ='text']
        {
            width: 300px;
            height: 40px;;
        }
        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 15px;
        }
        .cat_title{

            color: white;
            font-size: 35px;
            font-weight: bold;
        }
        .table_deg{
            text-align: center;
            margin: auto;
            border: 2px solid rgb(184, 173, 173);
            margin-top: 50px;
            width: 400px;
        }
        th{
            background: rgb(143, 51, 35);
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        td{
            color: white;
            padding: 10px;
            border: 1px solid rgb(139, 55, 55);
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
            <div class="div_deg">

            <form action="{{ url('add_category') }}" method="post">
               @csrf

                <div>
                    <input type="text" name="category">
                    <input class="btn btn-primary" type="submit" value="Add Category">
                </div>
            </form>
            </div>

            <div>

                <table class="table_deg">
                    <tr>
                        <th>Category Name</th>
                        <th>Delete </th>

                    </tr>
                    {{-- fetching category from the database --}}
                    @foreach($data as $data)

                    <tr>
                        <td>{{ $data->category_name }}</td>
                        <td>
                            <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_category', $data->id) }}">Delete</a>
                        </td>

                    </tr>

                    @endforeach
                </table>

            </div>



      </div>
    </div>


    <!-- JavaScript files-->
    
    {{-- asking a confirmation messsage before deleting  --}}
    <script type="text/javascript">
        function confirmation(ev)
        {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                title:"Are you sure to Delete This?",
                text: "This delete will be permanent",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            .then((willCancel)=>{

                if(willCancel)
                {
                    window.location.href = urlToRedirect;
                }
            });
        }

        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="{{ asset('/adminstyle/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/adminstyle/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('/adminstyle/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/adminstyle/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('/adminstyle/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/adminstyle/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/adminstyle/js/charts-home.js') }}"></script>
    <script src="{{ asset('/adminstyle/js/front.js') }}"></script>


</body>
</html>
