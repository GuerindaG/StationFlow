<nav class="navbar navbar-expand-lg navbar-glass">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center">
                <h2>{{ Auth::user()->name }}</h2>
            </div>
            <div>
                <ul class="list-unstyled d-flex align-items-center mb-0 ms-5 ms-lg-0">
                    <li class="dropdown ms-2">
                        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../assets/images/avatar/avatar-1.jpg" alt=""
                                class="avatar avatar-md rounded-circle" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0">
                            <div class="lh-1 px-5 py-4 border-bottom">
                                <h5 class="mb-1 h6">{{ Auth::user()->name }}</h5>
                                <small>{{ Auth::user()->email }}</small>
                            </div>

                            <ul class="list-unstyled px-2 py-3">
                                <li>
                                    <a class="dropdown-item" href="#!">Acceuil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!">Profil</a>
                                </li>
                            </ul>
                            <div class="border-top px-5 py-3">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-iten" href="#">
                                        Déconnexion
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