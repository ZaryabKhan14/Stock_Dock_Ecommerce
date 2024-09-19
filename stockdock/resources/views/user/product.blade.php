<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <!-- Filter Controls -->
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Our Products</li>
                    <!-- <li data-filter=".new-arrivals">New Arrivals</li>
                    <li data-filter=".hot-sales">Hot Sales</li> -->
                </ul>
            </div>
        </div>
        <!-- Product Items -->
        <div class="row product__filter">
            @foreach ($show_product_data as $product)
            @php
                               $images = json_decode($product->product_images, true);
                               $firstImage = $images[0] ?? 'default-image.png'; // Fallback image
                           @endphp
            <div class="col-lg-3 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">

                <div class="product__item__pic" style="background-image: url('{{ asset('product_images/' . $firstImage) }}');">
                <span class="label">New</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="{{asset('user_assets/img/icon/heart.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('user_assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                            <li><a href=""><img src="{{asset('user_assets/img/icon/search.png')}}" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>{{ $product->product_name }}</h6>
                        <a href="{{ route('show_product_details', ['id' => $product->id]) }}" class="add-cart">Product Details</a>
                        <div class="rating">
                            <!-- Assuming product rating is available, display rating stars -->
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>PKR {{ number_format($product->product_price, 2) }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- View All Products Button -->
      
    </div>
</section>
<!-- Product Section End -->
