@include('user.tags')
@include('user.header')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Orders</h4>
                    <div class="breadcrumb__links">
                        <a href="{{route('user_Dashboard')}}">Home</a>
                        <span>My Orders</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

@if($orders_fetch->isNotEmpty())
<div class="container mt-5">
    <div class="col-md-12">
        <h1 style="margin-top: 80px; font-size: 30px; font-weight: 700;text-align:center;">Order Detail</h1>
        <hr>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders_fetch as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->address }}, {{ $order->city }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="container mb-5">
    <h1 style="margin-top: 80px; font-size: 30px; font-weight: 700;text-align:center;">Products Detail</h1>
    <hr>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Color</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders_fetch as $order)
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->color }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table> 
</div>
@else
<div class="text-center mb-5">
    <h1 style="font-size: 50px;font-weight:900;">You have no orders</h1>
</div>
@endif

@include('user.footer')
