<!-- Include Styles and Scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

@include('admin.tags')
@include('admin.sidebar')
@include('admin.navbar')

<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <h6 class="mb-4 text-center font-weight-bold">Orders Overview</h6>
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
            <table id="ordersTable" class="table table-bordered table-striped table-hover" style="table-layout: auto; width: 100%;">
                <thead class="thead-dark sticky-top">
                    <tr>
                        <th scope="col" class="table-heading">#</th>
                        <th scope="col" class="table-heading">Order ID</th>
                        <th scope="col" class="table-heading">User ID</th>
                        <th scope="col" class="table-heading">First Name</th>
                        <th scope="col" class="table-heading">Last Name</th>
                        <th scope="col" class="table-heading">Email</th>
                        <th scope="col" class="table-heading">Address</th>
                        <th scope="col" class="table-heading">City</th>
                        <th scope="col" class="table-heading">Phone</th>
                        <th scope="col" class="table-heading">Total Amount</th>
                        <th scope="col" class="table-heading">Order Status</th>
                        <th scope="col" class="table-heading">Order Payment Method</th>
                        <th scope="col" class="table-heading">Created At</th> <!-- New Column for Created Date -->
                        <th scope="col" class="table-heading">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_fetch as $order)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user_id }}</td>
                        <td>{{ $order->first_name }}</td>
                        <td>{{ $order->last_name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->city }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-F-Y') }}</td> <!-- Formatted Date -->
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}"><i class="fas fa-eye"></i> View</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modals for Order Items -->
@foreach ($order_fetch as $order)
<div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-black">
                <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Order #{{ $order->id }} Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ $item->product_id }}</td>
                            <td>{{ $item->product->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
$(document).ready(function() {
    $('#ordersTable').DataTable({
        "paging": true,
        "searching": true,
        "info": true,
        "autoWidth": false,
        "order": [[0, "asc"]]
    });
});
</script>

@include('admin.footer')

<style>
.table {
    table-layout: auto;
    width: 100%;
}
.table td, .table th {
    white-space: nowrap;
    padding: 8px;
}
</style>
