<nav class="navbar navbar-expand-lg bg-white py-3">
    <div class="container-fluid">
        <a href="." class="navbar-brand logo">
            <img src="{{ asset('frontend/assets/images/logo.png') }}" alt=""> KasirOnlen
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto gap-2">
                <li class="nav-item">
                    <a href="." class="nav-link active px-4">Kasir</a>
                </li>
                <li class="nav-item">
                    <a href="order-list.html" class="nav-link px-4">Order List</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#">Setting</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
