<nav class="navbar-vertical-nav d-none d-xl-block">
    <div class="navbar-vertical">
        <div class="px-4 py-5">
            <a href="" class="navbar-brand">
                <img src="{{ asset('./assets/images/logo/stationflow-logo.svg')}}" alt="" />
            </a>
        </div>
        <div class="navbar-vertical-content flex-grow-1 py-5" data-simplebar="">
            <ul class="navbar-nav flex-column" id="sideNavbar">



                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('approvisionnement.index') ? 'active' : '' }}"
                        href="{{ route('approvisionnement.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="bi bi-shop"></i></span>
                            <span class="nav-link-text">Stockage</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('vente.index') ? 'active' : '' }}"
                        href="{{ route('vente.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="bi bi-cart"></i></span>
                            <span class="nav-link-text">Vente</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('addRapport') ? 'active' : '' }}"
                        href="{{ route('addRapport') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="bi bi-newspaper"></i></span>
                            <span class="nav-link-text">Rapport</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <hr />
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account-settings.html">
                        <i class="feather-icon icon-settings me-2"></i>
                        Paramètres
                    </a>
                </li>
                <!-- nav item -->

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="nav-link" href="#">
                            <i class="feather-icon icon-log-out me-2"></i>
                            Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>