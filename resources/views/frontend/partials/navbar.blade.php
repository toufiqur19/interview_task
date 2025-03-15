<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class="container-fluid mx-5">
        <a class="navbar-brand fs-5 fw-bold" href="#">LogoName</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('users') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('users') }}">Users</a>
                </li>
            </ul>
        </div>
        <div class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <button id="logoutButton" class="btn btn-danger">Logout</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
