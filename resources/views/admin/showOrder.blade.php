<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}" />
    <style>
           
            .pending {
            background-color: yellow;
            color: black;
            }

            .shipped {
            background-color: lightblue;
            color: black;
            }

            .delivered {
            background-color: green;
            color: white;
            }

            .cancelled {
            background-color: red;
            color: white;
            }
            /* Change the background color of the select based on the selected option */
            .status-select option:checked {
            background-color: #5e5e5e; /* You can modify this color as you like */
            color: white;
            }

    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.layouts.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.layouts.navbar')
        <!-- partial -->

        <!-- product section -->
            <div class="main-panel">
                  <div class="content-wrapper">
                        <div class="container">
                        <h2 class="mb-4 text-center">Orders</h2>

                        @if (session('success'))
                              <div id="success-message" class="alert alert-success">
                              {{ session('success') }}
                              </div>
                              <script>
                                    // Hide the success message after 3 seconds (3000ms)
                                    setTimeout(function() {
                                          $("#success-message").fadeOut("slow");
                                    }, 3000);
                              </script>
                        @endif

                              <table class="table table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                          <th>Customer Name</th>
                                          <th>Email</th>
                                          <th>Phone</th>
                                          <th>Delivery Address</th>
                                          <th>Product Title</th>
                                          <th>Product Image</th>
                                          <th>Quantity</th>
                                          <th>Total Amount</th>
                                          <th>Payment Status</th>
                                          <th>Delivery Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)
                                          <tr class="table-light text-dark">
                                                <td>{{ $order->name }}</td>
                                                <td>{{ $order->email }}</td>
                                                <td>{{ $order->user->phone ?? 'N/A' }}</td>
                                                <td>{{ $order->address }}</td>
                                                @foreach ($order->orderItems as $item)
                                                <td>{{$item->product_title}}</td>
                                                <td>
                                                @if ($item->product->image)
                                                      <img src="{{ asset('storage/' . $item->product->image) }}" alt="Product Image"
                                                            style="width: 100%; height: auto; max-height: 500px;object-fit: cover; border-radius: 10px;">
                                                @else
                                                      No Image
                                                @endif
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                @endforeach
                                                <td>{{ $order->total_price }}</td>
                                                <td>{{ $order->payment_method }}</td>

                                                <!-- Add a form for updating delivery status -->
                                                <td>
                                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                      @csrf
                                                      @method('PUT')
                                                      <select name="delivery_status" class="form-control status-select" onchange="this.form.submit()">
                                                            <option value="Pending" @if($order->order_status == 'Pending') selected @endif class="pending">Pending</option>
                                                            <option value="Shipped" @if($order->order_status == 'Shipped') selected @endif class="shipped">Shipped</option>
                                                            <option value="Delivered" @if($order->order_status == 'Delivered') selected @endif class="delivered">Delivered</option>
                                                            <option value="Cancelled" @if($order->order_status == 'Cancelled') selected @endif class="cancelled">Cancelled</option>
                                                      </select>
                                                </form>
                                                </td>
                                          </tr>
                                    @endforeach
                                    </tbody>
                              </table>


                        </div>      


                  </div>
            </div>


        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('assets/js/misc.js')}}"></script>
    <script src="{{ asset('assets/js/settings.js')}}"></script>
    <script src="{{ asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->

    <script>
      document.addEventListener("DOMContentLoaded", function () {
            const statusSelect = document.querySelector("select[name='delivery_status']");
            
            // Function to update the select background color based on selected option
            function updateBackgroundColor() {
            const selectedOption = statusSelect.options[statusSelect.selectedIndex];
            statusSelect.style.backgroundColor = selectedOption.style.backgroundColor;
            statusSelect.style.color = selectedOption.style.color;
            }

            // Call it once when the page loads to apply the current selected status color
            updateBackgroundColor();

            // Listen for changes and update the background color
            statusSelect.addEventListener("change", updateBackgroundColor);
      });
      </script>

  </body>
</html>