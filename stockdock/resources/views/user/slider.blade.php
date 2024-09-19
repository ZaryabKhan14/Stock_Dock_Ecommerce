
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- Hero Section Begin -->
<section class="hero">
        <div class="hero__slider owl-carousel">
        @foreach($show_slider_data as $slider)
        <div class="hero__items set-bg" data-setbg="{{ asset('storage/' . $slider->image) }}" ">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                            <h6>{{ $slider->title }}</h6>
                            <h2>Fall - Winter Collections 2030</h2>
                            <p>{{ $slider->description }}</p>
                                <a href="{{route('all_product')}}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </section>
    <!-- Hero Section End -->










