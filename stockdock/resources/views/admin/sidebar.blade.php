<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Stock Dock</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="dropdown-item text-center">
                                <img class="rounded-circle mb-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" style="width: 40px; height: 40px;">
                            </div>
                        @endif

                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">
                            {{ Auth::user()->name }}
                        </h6>
                        <span>
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                </div>

                <div class="navbar-nav w-100">
                    <a href="{{ route('admin') }}" class="nav-item nav-link active">
                        <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Users</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('user_form') }}" class="dropdown-item"><i class="fa fa-user-plus me-2"></i>Add Users</a>
                            <a href="{{ route('show_user') }}" class="dropdown-item"><i class="fa fa-users me-2"></i>Show Users</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-sliders-h me-2"></i>Slider</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('add_slider_form') }}" class="dropdown-item"><i class="fa fa-plus me-2"></i>Add Slider</a>
                            <a href="{{ route('show_slider_page') }}" class="dropdown-item"><i class="fa fa-eye me-2"></i>Show Slider</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-boxes me-2"></i>Product</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('add_product_form') }}" class="dropdown-item"><i class="fa fa-plus me-2"></i>Add Product</a>
                            <a href="{{ route('show_product_page') }}" class="dropdown-item"><i class="fa fa-box me-2"></i>Show Product</a>
                        </div>
                    </div>

                    <a href="{{ route('show_customer_orders') }}" class="nav-item nav-link">
                        <i class="fa fa-receipt me-2"></i>Customer Orders
                    </a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
