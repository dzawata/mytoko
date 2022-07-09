<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('home') }}">Bunehaba Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="#!">About</a></li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('all-products') }}">All Products</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="{{ route('popular') }}">Popular Items</a></li>
                        <li><a class="dropdown-item" href="{{ route('new') }}">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>
            <!-- <form class="d-flex">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form> &nbsp; -->
            @guest
            <a class="btn btn-outline-primary" href="{{ route('login') }}">
                <i class="bi-key-fill me-1"></i>
                Login
            </a>
            @endguest
            @auth
            <form class="d-flex" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-primary">
                    <i class="bi-unlock-fill me-1"></i>
                    Logout
                </button>
            </form>
            @endauth
        </div>
    </div>
</nav>