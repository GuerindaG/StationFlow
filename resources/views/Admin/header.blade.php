<div class="py-5">
    <div class="container">
        <div class="row w-100 align-items-center gx-lg-3 gx-0">
            <div class="col-xxl-2 col-lg-4 col-md-6 col-5">
                <a class="navbar-brand d-none d-lg-block" href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('../assets/images/logo/stationflow-logo.svg')}}" alt="eCommerce HTML Template" />
                </a>
                <div class="d-flex justify-content-between w-100 d-lg-none">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('../assets/images/logo/stationflow-logo.svg')}}"
                            alt="eCommerce HTML Template" />
                    </a>
                </div>
            </div>
            <div class="col-xxl-5 col-lg-6 d-none d-lg-block text-center">
                <form action="#">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Rechercher"
                            aria-label="Recipient's username" aria-describedby="button-addon2" />
                        <button class="btn btn-primary" type="button" id="button-addon2"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>

            <div class="col-xxl-5 col-lg-2 d-none d-lg-block text-center">
                <a href="#" class="text-reset" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="lh-1">
                        <div class="mb-2">
                            <i class="bi bi-person-circle fs-2"></i>
                        </div>
                        <p class="mb-0 d-none d-xl-block small">{{ Auth::user()->name }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="{{ route('parametre') }}">Editer Profil</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item btn btn-danger">
                                Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>