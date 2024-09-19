@php
$subtotal = 0;
$total = 0;
@endphp

<!-- SweetAlert2 CSS -->
@include('user.tags')
@include('user.header')

<style>
    .disabled {
        pointer-events: none; /* Prevent mouse events */
        opacity: 0.6;        /* Optional: make it look disabled */
    }

    .product__cart__item__pic img {
        max-width: 100px; /* Set a maximum width */
        max-height: 100px; /* Set a maximum height */
        object-fit: cover; /* Maintain aspect ratio and cover the container */
    }
</style>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="{{route('user_Dashboard')}}">Home</a>
                        <a href="{{route('all_product')}}">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('cart', []) as $cartItem)
                                @php
                                    $subtotal += $cartItem['price'] * $cartItem['quantity'];
                                    $total += $cartItem['price'] * $cartItem['quantity'];
                                    $imagePath = $cartItem['poster'] ? json_decode($cartItem['poster'], true)[0] : 'default.jpg';
                                @endphp
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset('product_images/' . $imagePath) }}" alt="{{ $cartItem['name'] }}" class="img-fluid">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{ $cartItem['name'] }}</h6>
                                            <h5>PKR {{ number_format($cartItem['price'], 2) }}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity disabled">
                                            <div class="pro-qty-2">
                                                <input type="text" value="{{ $cartItem['quantity'] }}" readonly>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">PKR {{ number_format($cartItem['price'] * $cartItem['quantity'], 2) }}</td>
                                    <td class="cart__close">
                                        <i class="fa fa-close" onclick="removeCartItem('{{ $cartItem['id'] . '_' . ($cartItem['color'] ?? '') }}')"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{route('all_product')}}">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>PKR {{ number_format($subtotal, 2) }}</span></li>
                        <li>Total <span>PKR {{ number_format($total, 2) }}</span></li>
                    </ul>
                    <a href="{{route('show_checkout_form')}}" id="checkoutBtn" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

@include('user.footer')

<script>
function removeCartItem(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('{{ route("delete.cart.item") }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => {
                if (response.ok) {
                    Swal.fire(
                        'Removed!',
                        'The item has been removed from your cart.',
                        'success'
                    ).then(() => {
                        location.reload(); // Reload the page to reflect changes
                    });
                } else {
                    Swal.fire(
                        'Failed!',
                        'Failed to remove item. Please try again.',
                        'error'
                    );
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire(
                    'Error!',
                    'An error occurred. Please try again.',
                    'error'
                );
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    var checkoutBtn = document.getElementById('checkoutBtn');
    var cartItems = @json(session('cart', []));

    checkoutBtn.addEventListener('click', function (e) {
        if (cartItems.length === 0) {
            e.preventDefault(); // Prevent default action (navigation)
            Swal.fire(
                'Empty Cart!',
                'Your cart is empty. Please add items to the cart before proceeding to checkout.',
                'warning'
            );
        }
    });
});
</script>
