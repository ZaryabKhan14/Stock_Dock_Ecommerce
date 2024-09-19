<style>
    /*** Globals ***/
    body {
        font-family: 'Open Sans', sans-serif;
        overflow-x: hidden;
        background-color: #f9f9f9;
        color: #333;
    }

    img {
        max-width: 100%;
    }

    .container {
        padding: 20px;
    }

    .card {
        margin-top: 30px;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .preview {
        display: flex;
        flex-direction: column;
    }

    @media screen and (max-width: 996px) {
        .preview {
            margin-bottom: 20px;
        }
    }
    .rating-container {
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .rating {
        display: inline-flex;
        align-items: center;
    }

    .preview-pic {
        flex-grow: 1;
        margin-bottom: 15px;
    }

    .preview-thumbnail.nav-tabs {
        border: none;
        margin-top: 10px;
    }

    .preview-thumbnail.nav-tabs li {
        width: 18%;
        margin-right: 2.5%;
    }

    .preview-thumbnail.nav-tabs li img {
        max-width: 100%;
        display: block;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .tab-content {
        overflow: hidden;
    }

    .tab-content img {
        width: 100%;
        border-radius: 4px;
        animation: opacity .3s;
    }
    .product__thumb__pic {
    background-size: cover; /* Ensures the image covers the container */
    background-position: center; /* Centers the image */
    background-repeat: no-repeat; /* Prevents image repetition */
    width: 100%; /* Ensures the container takes full width */
    height: 200px; /* Adjust height as needed */
}

    .details {
        display: flex;
        flex-direction: column;
        padding-left: 30px;
    }

    .product-title {
        text-transform: uppercase;
        font-weight: bold;
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    .price {
        font-size: 1.2rem;
        color: #ff9f1a;
        font-weight: bold;
    }

    .rating {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .stars {
        margin-right: 10px;
    }

    .checked {
        color: #ff9f1a;
    }

    .product-description {
        margin-bottom: 15px;
        font-size: 0.9rem;
    }

    .vote {
        margin-bottom: 15px;
        font-size: 0.85rem;
        color: #777;
    }

    .color {
    display: inline-block;
    vertical-align: middle;
    margin-right: 10px;
    height: 2em;
    width: 2em;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid #ddd;
}

.color.selected {
    border-color: #333; /* Highlight selected color */
}


    .action .btn {
        margin-right: 5px;
        padding: 10px 15px;
        text-transform: uppercase;
        font-weight: bold;
    }

    .btn-warning {
        background-color: #ff9f1a;
        color: #fff;
        border: none;
    }

    .btn-warning:hover {
        background-color: #cc7a00;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: black;
    }

    .btn-light {
        background-color: #f8f9fa;
        color: #333;
        border: 1px solid #ddd;
    }

    .btn-light:hover {
        background-color: #e2e6ea;
    }

    .tooltip-inner {
        padding: 1.3em;
    }

    @keyframes opacity {
        0% {
            opacity: 0;
            transform: scale(3);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    
</style>

@include('user.tags')
@include('user.header')
<!-- Shop Details Section Begin -->
<section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{route('user_Dashboard')}}">Home</a>
                            <a href="{{route('all_product')}}">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
    @foreach($product_details->product_images as $index => $image)
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="tab-{{ $index + 1 }}" data-bs-toggle="tab" href="#tabs-{{ $index + 1 }}" role="tab" aria-controls="tabs-{{ $index + 1 }}" aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                <div class="product__thumb__pic " style="background-image: url('{{ asset('product_images/' . $image) }}');"></div>
            </a>
        </li>
    @endforeach
</ul>



                    </div>
                    <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
    @foreach($product_details->product_images as $index => $image)
        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="tabs-{{ $index + 1 }}" role="tabpanel" aria-labelledby="tab-{{ $index + 1 }}">
            <img src="{{ asset('product_images/' . $image) }}" class="img-fluid" />
        </div>
    @endforeach
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product_details->product_name }}</h4>
                            
                            <div class="rating-container">
        <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
            <span> - 5 Reviews</span>
        </div>
    </div>
                            <h3>PKR {{ number_format($product_details->product_price, 2) }}</h3>
                            <p>{{ $product_details->product_description }}</p>
                           
                                <div class="colors">
                                    <span >Color:</span>
                                    @foreach($product_details->product_colour as $color)
        @php
            // Check if color is a predefined class
            $colorClass = in_array($color, ['red', 'blue', 'purple']) ? $color : '';
        @endphp
        <span class="color {{ $colorClass }}" style="{{ $colorClass ? '' : 'background-color: ' . $color . ';' }}" data-color="{{ $color }}" onclick="selectColor(this)" data-toggle="tooltip" title="{{ $color }}"></span>
    @endforeach
                                </div>
                            </div>
                            <br>
                            <div class="rating-container">

                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                                
                                <a href="#" class="primary-btn"><i class="me-1 fa fa-shopping-basket"></i> Add to cart</a>
                                </div>
                                </div>
                                <div class="rating-container">

                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('user.footer')


<!-- JavaScript -->
<script>
// Update the selectColor function to highlight the selected color
function selectColor(element) {
    const colors = document.querySelectorAll('.colors .color');
    colors.forEach(color => color.classList.remove('selected'));
    element.classList.add('selected');
    const selectedColor = element.getAttribute('data-color');
    console.log('Selected color:', selectedColor); // For debugging purposes
}

// Add event listener to the "Add to cart" button
// Update the selectColor function to highlight the selected color
function selectColor(element) {
    const colors = document.querySelectorAll('.colors .color');
    colors.forEach(color => color.classList.remove('selected'));
    element.classList.add('selected');
    const selectedColor = element.getAttribute('data-color');
    console.log('Selected color:', selectedColor); // For debugging purposes
}

// Add event listener to the "Add to cart" button
document.querySelectorAll('.primary-btn').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        let productId = {{ $product_details->id }};
        let quantity = parseInt(document.querySelector('.pro-qty input').value) || 1; // Get quantity from input, default to 1 if invalid
        let selectedColor = document.querySelector('.colors .color.selected');
        let color = selectedColor ? selectedColor.getAttribute('data-color') : null;

        // Send selected color and product data to the server
        fetch('/user/add_product_to_cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: productId, quantity: quantity, color: color })
        })
        .then(response => {
            if (response.status === 401) {
                // If user is not authenticated, redirect to login page
                window.location.href = '/login';
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.error,
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Cart',
                    text: 'Item added to your cart successfully!',
                    showConfirmButton: false,
                    timer: 2000
                });
                document.getElementById('cartCount').innerText = data.cartCount;
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

</script>



<!-- Add this script for FS Lightbox -->
