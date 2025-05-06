<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-glass row">
            <div class="dashboard_bar col-lg-10 text-start">
                <h2>{{ Auth::user()->name }}</h2>
            </div>
            <div class="col-lg-2">
                <ul class="list-unstyled d-flex align-items-center mb-0 ms-5 ms-lg-0">
                    <li class="dropdown ms-4">
                        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../assets/images/avatar/avatar-1.jpg" alt=""
                                class="avatar avatar-md rounded-circle" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0">
                            <div class="lh-1 px-5 py-4 border-bottom">
                                <h5 class="mb-1 h6">FreshCart Admin</h5>
                                <small>admindemo@email.com</small>
                            </div>

                            <ul class="list-unstyled px-2 py-3">
                                <li>
                                    <a class="dropdown-item" href="#!">Home</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!">Profile</a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#!">Settings</a>
                                </li>
                            </ul>
                            <div class="border-top px-5 py-3">
                                <a href="#">Log Out</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<nav class="navbar-vertical-nav d-none d-xl-block">
    <div class="navbar-vertical">
        <div class="px-4 py-5">
            <a href="{{ route('approvisionnement.index') }}" class="navbar-brand">
                <img src="{{ asset('./assets/images/logo/stationflow-logo.svg')}}" alt="" />
            </a>
        </div>
        <div class="navbar-vertical-content flex-grow-1 " data-simplebar="">
            <ul class="navbar-nav flex-column" id="sideNavbar">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(patterns: 'gestionnaire.dashboard') ? 'active' : '' }}"
                        href="{{ route('gestionnaire.dashboard') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="bi bi-house"></i></span>
                            <span class="nav-link-text">Tableau de bord</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(patterns: 'approvisionnement.index') ? 'active' : '' }}"
                        href="{{ route('approvisionnement.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="bi bi-shop"></i></span>
                            <span class="nav-link-text">Stockage</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  collapsed " href="" data-bs-toggle="collapse" data-bs-target="#navCustomer"
                        aria-expanded="false" aria-controls="navCustomer">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="bi bi-cart"></i></span>
                            <span class="nav-link-text">Ventes</span>
                        </div>
                    </a>
                    <div id="navCustomer" class="collapse " data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('vente.index') ? 'active' : '' }}" href="{{ route('vente.index') }}">Produits Blancs</a>
                            </li>
                            <!-- Nav item -->
                            <li class="nav-item">
                                <a class="nav-link " href="">Lubrifiants</a>
                            </li>
                            <!-- Nav item -->
                            <li class="nav-item">
                                <a class="nav-link " href="">Gaz & Accessoires</a>
                            </li>
                        </ul>
                    </div>
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