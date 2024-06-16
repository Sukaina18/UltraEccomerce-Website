<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style>
      /* Custom table styles */
      .custom-table .custom-th, .custom-table .custom-td {
          border: 1px solid maroon;
          color: white;
      }

      .custom-table .custom-th {
          background-color: maroon;
      }

      .custom-table tbody tr {
          background-color: #333;
      }

      .custom-table tbody tr:nth-child(even) {
          background-color: #444;
      }

      .custom-table thead .custom-th {
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
          <div class="container mt-5">
            <h2 class="mb-4 text-center">Registered Customers</h2>
            <table class="table table-bordered table-hover customer custom-table">
              <thead>
                <tr>
                  <th class="custom-th">ID</th>
                  <th class="custom-th">First Name</th>
                  <th class="custom-th">Last Name</th>
                  <th class="custom-th">Email</th>
                  <th class="custom-th">Phone</th>
                  <th class="custom-th">Address</th>
                  <th class="custom-th">Created At</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($customers as $customer)
                  <tr>
                    <td class="custom-td">{{ $customer->id }}</td>
                    <td class="custom-td">{{ $customer->first_name }}</td>
                    <td class="custom-td">{{ $customer->last_name }}</td>
                    <td class="custom-td">{{ $customer->email }}</td>
                    <td class="custom-td">{{ $customer->phone }}</td>
                    <td class="custom-td">{{ $customer->address }}</td>
                    <td class="custom-td">{{ $customer->created_at }}</td>
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
