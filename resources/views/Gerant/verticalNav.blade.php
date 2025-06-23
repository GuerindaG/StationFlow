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
                            <span class="nav-link-icon"><i class="bi bi bi-arrow-90deg-down"></i></span>
                            <span class="nav-link-text">Réceptions</span>
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
                            <span class="nav-link-icon"><i class="bi bi-clipboard"></i></span>
                            <span class="nav-link-text">Rapport</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                        data-bs-target="#navMenuLevelFirst" aria-expanded="false" aria-controls="navMenuLevelFirst">
                        <span class="nav-link-icon"><i class="bi bi-folder"></i></span>
                        <span class="nav-link-text">Historiques</span>
                    </a>
                    <div id="navMenuLevelFirst" class="collapse " data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link " href="#" data-bs-toggle="collapse"
                                    data-bs-target="#navMenuLevelSecond1" aria-expanded="false"
                                    aria-controls="navMenuLevelSecond1">
                                    Réceptions
                                </a>
                                <div id="navMenuLevelSecond1" class="collapse" data-bs-parent="#navMenuLevel">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link " href="#">Produits Blancs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="#">Lubrifiants</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="#">Gaz</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                                    data-bs-target="#navMenuLevelThreeOne1" aria-expanded="false"
                                    aria-controls="navMenuLevelThreeOne1">
                                    Ventes
                                </a>
                                <div id="navMenuLevelThreeOne1" class="collapse " data-bs-parent="#navMenuLevel">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link " href="#">Produits Blancs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="#">Lubrifiants</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="#">Gaz</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
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