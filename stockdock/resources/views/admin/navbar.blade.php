        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="{{ route('admin') }}" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
              
                <div class="navbar-nav align-items-center ms-auto">

                    
                   <!-- Settings Dropdown -->
<div class="ms-3 relative">
    <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <img class="rounded-circle me-lg-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" style="width: 40px; height: 40px;">
            @endif
            <span class="d-none d-lg-inline-flex">
                {{ Auth::user()->name }}
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-3 shadow" style="width: 200px; padding: 0;">
            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="dropdown-item text-center" style="padding: 10px;">
                    <img class="rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" style="width: 40px; height: 40px;">
                </div>
            @endif

            <!-- Profile Link -->
            <a href="{{ route('profile.show') }}" class="dropdown-item">{{ __('Profile') }}</a>

            <!-- API Tokens Link -->
            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <a href="{{ route('api-tokens.index') }}" class="dropdown-item">{{ __('API Tokens') }}</a>
            @endif

            <div class="dropdown-divider"></div>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
            </form>
        </div>
    </div>
</div>


            </nav>
            <!-- Navbar End -->

