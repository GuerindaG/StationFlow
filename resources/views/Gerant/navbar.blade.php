<nav class="navbar navbar-expand-lg navbar-glass">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center">
                <form role="search">
                    <label for="search" class="form-label visually-hidden">Search</label>
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search" />
                </form>
            </div>
            <div>
                <ul class="list-unstyled d-flex align-items-center mb-0 ms-5 ms-lg-0">
                    <li class="dropdown ms-4">
                        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('./assets/images/avatar/profil.png')}}" alt=""
                                class="avatar avatar-md rounded-circle" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0">
                            <div class="lh-1 px-5 py-4 border-bottom">
                                <h5 class="mb-1 h6">Gérant {{ Auth::user()->name }}</h5>
                                <small>{{ Auth::user()->email }}</small>
                            </div>
                            <ul class="list-unstyled px-2 py-3">
                                <li>
                                    <a class="dropdown-item" href="#!">Acceuil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!">Profil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!">Paramètres</a>
                                </li>
                            </ul>
                            <div class="border-top px-5 py-3">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item btn btn-danger">Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>