<nav class="navbar navbar-expand-lg navbar-glass">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center">
                <h2>Gestionnaire de la station : {{ Auth::user()->name }}</h2>
            </div>
            <div>
                <ul class="list-unstyled d-flex align-items-center mb-0 ms-5 ms-lg-0">
                    <li class="dropdown ms-4">
                        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="lh-1">
                                <div class="mb-2">
                                    <i class="bi bi-person-circle fs-1"></i>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0">
                            <ul class="list-unstyled px-2 py-3">
                                <li>
                                    <a class="dropdown-item" href="#!">Acceuil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!">Editer Profil</a>
                                </li>
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
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>