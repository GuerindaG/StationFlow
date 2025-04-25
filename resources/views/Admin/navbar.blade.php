<nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 pb-lg-4" aria-label="Offcanvas navbar large">
    <div class="container">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default" aria-labelledby="navbar-defaultLabel">
            <div class="offcanvas-body">
                <div class="dropdown me-3 d-none d-lg-block col-lg-3">
                    <button class="btn btn-primary px-6 w-100" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-grid">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </span>
                        Tous les rapports
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="../pages/shop-grid.html">Dairy, Bread & EggsBread & Eggs</a>
                        </li>
                        <li><a class="dropdown-item" href="../pages/shop-grid.html">Snacks & Munchies</a></li>
                    </ul>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-6 text-end">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item w-100 w-lg-auto">
                            <a class="nav-link " href="{{ route('rapport') }}">Rapports</a>
                        </li>

                        <li class="nav-item w-100 w-lg-auto">
                            <a class="nav-link" href="{{ route('station.index') }}">Stations</a>
                        </li>
                        <li class="nav-item w-100 w-lg-auto">
                            <a class="nav-link" href="{{ route('categorie.index') }}">Catégories</a>
                        </li>
                        <li class="nav-item w-100 w-lg-auto">
                            <a class="nav-link" href="{{ route('produit.index') }}">Produits</a>
                        </li>
                        <li class="nav-item w-100 w-lg-auto">
                            <a class="nav-link" href="{{ route('parametre') }}">
                                Paramètres du Compte</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>