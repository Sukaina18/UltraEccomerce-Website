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

            <h1 class="cat_title">Update Category</h1>

            <div class="div_update">


                <form action="{{ url('update_category', $data->id) }}" method="POST">
                    @csrf

                    <input type="text" name="category" value="{{ $data->category_name }}">
                    <input class="btn btn-warning" type="submit" value="Update Category">

                </form>
            </div>






      </div>
    </div>
</div>


  @include('admin.js')
  </body>
</html>
