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

    @include('admin.body')
    @include('admin.footer')
      </div>
    </div>


    <!-- JavaScript files-->
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
