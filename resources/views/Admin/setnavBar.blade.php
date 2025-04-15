<div class="col-lg-3 col-md-4 col-12 border-end d-none d-md-block">
    <div class="pt-10 pe-lg-10">
        <!-- nav item -->
        <ul class="nav flex-column nav-pills nav-pills-dark">
            <li class="nav-item">
                <a class="nav-link " aria-current="page" {{ request()->routeIs('categorie.index') ? 'active' : '' }}"
                    href="{{ route('categorie.index') }}">
                    <i class="feather-icon icon-shopping-bag me-2"></i>
                    Catégories
                </a>
            </li>
            <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link active" href="account-settings.html">
                    <i class="feather-icon icon-settings me-2"></i>
                    paramètres
                </a>
            </li>
            <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link" href="account-address.html">
                    <i class="feather-icon icon-map-pin me-2"></i>
                    Adresse
                </a>
            </li>
            <!-- nav item -->
            <li class="nav-item">
                <hr />
            </li>
            <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link" href="../index.html">
                    <i class="feather-icon icon-log-out me-2"></i>
                    Log out
                </a>
            </li>
        </ul>
    </div>
</div>