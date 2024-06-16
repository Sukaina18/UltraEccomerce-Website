

<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{ asset('/adminstyle/img/my.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Sukaina Azwar</h1>
            <p>Senior Developer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">


                <li class="active"><a href="{{ url('admin/dashboard') }}"> <i class="icon-home"></i>Dashboard </a></li>

                <li class="active"><a href="{{ url('customer_data') }}"> <i class="icon-user"></i>Customer Data </a></li>

                <li class="active"><a href="{{ url('view_category') }}"> <i class="fa fa-th"></i>Category </a></li>

                <li class="active"><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-shopping-cart"></i>Products </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{ url('add_product') }}">Add Product</a></li>
                    <li><a href="{{ url('view_product') }}">View Products</a></li>
                  </ul>
                </li>

                <li class="active"><a href="{{ url('view_order') }}"> <i class="icon-list"></i>Orders </a></li>

        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
