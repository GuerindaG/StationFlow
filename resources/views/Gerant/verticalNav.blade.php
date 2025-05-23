<nav class="navbar-vertical-nav d-none d-xl-block">
    <div class="navbar-vertical">
        <div class="px-4 py-5">
            <a href="{{ route('approvisionnement.index') }}" class="navbar-brand">
                <img src="{{ asset('./assets/images/logo/stationflow-logo.svg')}}" alt="" />
            </a>
        </div>
        <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
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
                <li class="nav-item mt-6 mb-3">
                    <span class="nav-label">Store Managements</span>
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
                    <a class="nav-link {{ request()->routeIs('vente.index') ? 'active' : '' }}"
                        href="{{ route('vente.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="bi bi-cart"></i></span>
                            <span class="nav-link-text">Vente</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('rapports.index') ? 'active' : '' }}"
                        href="{{ route('rapports.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="bi bi-newspaper"></i></span>
                            <span class="nav-link-text">Rapport</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item mt-6 mb-3">
                    <span class="nav-label">Support</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="bi bi-question-circle"></i></span>
                            <span class="nav-link-text">Help Center</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>