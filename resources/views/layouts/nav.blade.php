<section>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/admin">E-commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li><a class="nav-link" href="{{ route('cats.index') }}">Category</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Jobs
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('cats.index') }}">Category</a></li>
                            <li><a class="dropdown-item" href="#">Products</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Other</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Moved the "End User" li to the end -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @guest
                                User
                            @endguest
                            @auth
                                {{ auth()->user()->name }}
                            @endauth
                        </a>
                        <ul class="dropdown-menu">
                            @guest()
                                <li><a class="dropdown-item" href="#">Login</a></li>
                                <li><a class="dropdown-item" href="#">Register</a></li>
                            @endguest
                            @auth()
                                <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                            @endauth
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
