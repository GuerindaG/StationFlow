<div class="py-5">
    <div class="container">
        <div class="row w-100 align-items-center gx-lg-3 gx-0">
            <div class="col-xxl-2 col-lg-4 col-md-6 col-5">
                <a class="navbar-brand d-none d-lg-block" href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('../assets/images/logo/stationflow-logo.svg')}}" alt="StationFlow" />
                </a>
                <div class="d-flex justify-content-between w-100 d-lg-none">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('../assets/images/logo/stationflow-logo.svg')}}" alt="StationFlow" />
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

            <div class="col-xxl-5 col-lg-1 d-none d-lg-block text-center">
                <a class="text-reset position-relative btn-icon btn-ghost-secondary btn rounded-circle lh-1" href="#"
                    role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight">
                    <i class="bi bi-bell fs-2 "></i>
                    @if($notifications->count() > 0)
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 ms-n2">
                            {{ $notifications->count() }}
                            <span class="visually-hidden">notifications non lues</span>
                        </span>
                    @endif
                </a>
            </div>
            <div class="col-xxl-5 col-lg-1 d-none d-lg-block text-center">
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
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom">
        <div class="text-start">
            <h5 id="offcanvasRightLabel" class="mb-0 fs-4">Notifications</h5>
            <small>Vous avez {{ auth()->user()->unreadNotifications->count() }} notifications non lues</small>
            <form method="POST" action="{{ route('notifications.readall') }}">
                @csrf
                <button class="btn btn-ghost-info btn-icon rounded-circle" type="submit" title="Tout marquer comme lu">
                    <i class="bi bi-check2-all text-success"></i>
                </button>
            </form>
        </div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <form method="POST" action="{{ route('notifications.bulkDelete') }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger mb-3">Supprimer la sélection</button>

            <ul class="list-group list-group-flush notification-list-scroll fs-6">
                @forelse($notifications as $notif)
                    <li
                        class="list-group-item px-4 py-3 list-group-item-action {{ is_null($notif->read_at) ? 'bg-light' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input me-2" name="notifications[]"
                                    value="{{ $notif->id }}">
                                <a href="{{ route('notifications.read', $notif->id) }}"
                                    class="text-muted text-decoration-none">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/images/avatar/profil.png') }}" alt=""
                                            class="avatar avatar-md rounded-circle" />
                                        <div class="ms-3">
                                            <p class="mb-1">
                                                <span
                                                    class="text-dark">{{ $notif->data['station'] ?? 'Station inconnue' }}</span>
                                                vous a envoyé un rapport.
                                            </p>
                                            <span>
                                                <i class="bi bi-clock text-muted"></i>
                                                <small class="ms-2">{{ $notif->created_at->diffForHumans() }}</small>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <form method="POST" action="{{ route('notifications.destroy', $notif->id) }}"
                                onsubmit="return confirm('Supprimer cette notification ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-link text-danger p-0 ms-2" title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item px-5 py-4 text-center">
                        Aucune notification
                    </li>
                @endforelse
            </ul>
        </form>
    </div>
</div>