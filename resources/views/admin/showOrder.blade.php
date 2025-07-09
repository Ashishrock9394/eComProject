<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>

    <!-- Bootstrap & Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>
<body>
<div class="container-scroller">
    @include('admin.layouts.sidebar')
    <div class="container-fluid page-body-wrapper">
        @include('admin.layouts.navbar')

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container">
                    <h2 class="mb-4 text-center">Orders</h2>

                    @if (session('success'))
                        <div id="success-message" class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById("success-message").style.display = "none";
                            }, 3000);
                        </script>
                    @endif

                    <!-- ✅ Wrap table in a responsive div -->
                    <div class="table-responsive">
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
                                @foreach ($order->orderItems as $item)
                                    <tr class="table-light text-dark">
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->user->phone ?? 'N/A' }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $item->product_title }}</td>
                                        <td>
                                            @if ($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                     alt="Product Image"
                                                     style="width: 100px; height: auto; border-radius: 5px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>
                                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="delivery_status" class="form-control" onchange="this.form.submit()">
                                                    <option value="Pending" @if($order->order_status == 'Pending') selected @endif>Pending</option>
                                                    <option value="Shipped" @if($order->order_status == 'Shipped') selected @endif>Shipped</option>
                                                    <option value="Delivered" @if($order->order_status == 'Delivered') selected @endif>Delivered</option>
                                                    <option value="Cancelled" @if($order->order_status == 'Cancelled') selected @endif>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- main-panel -->
    </div> <!-- page-body-wrapper -->
</div> <!-- container-scroller -->

<!-- JS Scripts -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>

</body>
</html>