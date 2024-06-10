<header class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light container-fluid">
        <div id="left-navbar"></div>
        <div id="right-navbar" class="container-fluid d-flex align-items-center align-content-center">
            <ul class="navbar-nav d-flex flex-row justify-content-end">
                <li class="nav-item">
                    <a class="nav-link me-3 me-lg-0" href="#">
                        <i class="fas fa-bell"></i>
                    </a>
                </li>
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="https://github.com/ElisaMavilia">
                        <i class="fab fa-github"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-3 me-lg-0" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" title="Logout">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="userProfile" role="button">
                        <span class="pe-3mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                        <img id="profile-logo" class="img-profile rounded-circle" src="../images/em_logo.jpg">
                    </a>
            </ul>
            </li>
            </ul>
        </div>
    </nav>
</header>