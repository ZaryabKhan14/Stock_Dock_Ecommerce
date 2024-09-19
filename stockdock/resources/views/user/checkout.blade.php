

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 90%;
            margin: auto;
            max-width: 1200px;
        }

        .spad {
            padding: 30px 0;
        }

        .checkout__form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-lg-8, .col-lg-4, .col-md-6 {
            padding: 15px;
        }

        .col-lg-8 {
            width: 66.66%;
        }

        .col-lg-4 {
            width: 33.33%;
        }

        .checkout__title, .order__title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #007bff;
        }

        .checkout__input__checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .checkout__input__checkbox label {
            display: flex;
            align-items: center;
            font-size: 16px;
            color: #333;
        }

        .checkout__input__checkbox input[type="checkbox"] {
            margin-right: 10px;
            cursor: pointer;
        }

        .input__field {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fafafa;
        }

        .checkout__order {
            background-color: #f8f8f8;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .checkout__order__products, .checkout__total__products, .checkout__total__all {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .checkout__order__products span, .checkout__total__all span {
            float: right;
        }

        .checkout__total__products li {
            margin-bottom: 10px;
        }

        .checkout__total__all li {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .site-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        .site-btn:hover {
            background-color: #0056b3;
        }

        /* Improve labels and headings */
        .checkout__input p {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
            color: black;
        }

        .checkout__input span {
            color: #e74c3c;
            font-weight: 700;
        }

        .breadcrumb__text h4 {
            font-size: 24px;
            color: #007bff;
            margin: 0;
        }

        .breadcrumb__links a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        .breadcrumb__links span {
            color: #555;
        }
    </style>
    @include('user.header')
    @include('user.tags')
    <br>
    <br>
    <br>
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('user_Dashboard')}}">Home</a>
                            <a href="{{route('all_product')}}">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{route('process_checkout')}}" method="post">
                @csrf

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" class="input__field" name="f_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" class="input__field" name="l_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" class="input__field" placeholder="Apartment, suite, unit, etc (optional)" name="shipping_address" required>
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" class="input__field" name="city" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" class="input__field" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" class="input__field" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Notes about your order, e.g. special notes for delivery.<span>*</span></p>
                                <div class="mb-3">
                                    <textarea style="resize:none;" class="form-control" name="note" id="" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your Order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                          
                            <ul class="checkout__total__products">
                            @foreach(session('cart', []) as $cartItem)
                            <li>{{ $cartItem['name'] }}<sup style="font-size: 12px;font-weight:bold;color:red;">x{{ $cartItem['quantity'] }}</sup><span> x{{$cartItem['color'] }}</span><span> x PKR {{ number_format($cartItem['price'], 2) }}</span></li>

                            @endforeach
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Subtotal <span style="color: green;">PKR {{ number_format($subtotal, 2) }}</span></li>
                                <li>GST 18% <span style="color: green;">PKR {{ number_format($gst, 2) }}</span></li>
                                <li>Delivery Charges <span style="color: green;">PKR {{ number_format($deliveryCharges, 2) }}</span></li>
                                <li>Total <span style="color: green;">PKR {{ number_format($total, 2) }}</span></li>
                            </ul>        <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Cash On Delivery
                                        <input type="checkbox" value='Cash On Delivery' name="payment_method" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Online Payment (Coming Soon)
                                        <input type="checkbox" id="paypal" disabled>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @include('user.footer')
