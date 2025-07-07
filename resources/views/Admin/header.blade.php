<div class="py-5">
    <div class="container">
        <div class="row w-100 align-items-center gx-lg-3 gx-0">
            <div class="col-xxl-2 col-lg-4 col-md-6 col-5">
                <a class="navbar-brand d-none d-lg-block" href="{{ route('dashboard') }}">
                    <img src="{{ asset('../assets/images/logo/stationflow-logo.svg')}}" alt="StationFlow" />
                </a>
                <div class="d-flex justify-content-between w-100 d-lg-none">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
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
        <div class="text-start w-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 id="offcanvasRightLabel" class="mb-0 fs-4">
                    <i class="bi bi-bell me-2"></i>Notifications
                </h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        <span class="badge bg-primary me-2">{{ auth()->user()->unreadNotifications->count() }}</span>
                        notifications non lues
                    </small>
                </div>

                @if(auth()->user()->unreadNotifications->count() > 0)
                    <form method="POST" action="{{ route('notifications.read-all') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-outline-success" type="submit" title="Tout marquer comme lu">
                            <i class="bi bi-check2-all me-1"></i>
                            Marquer tout comme lu
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="offcanvas-body p-0">
        @if($notifications->count() > 0)
            <!-- Contrôles de sélection -->
            <div class="px-3 py-2 bg-light border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleAllNotifications()">
                        <label class="form-check-label text-muted" for="selectAll">
                            Tout sélectionner
                        </label>
                    </div>

                    <button type="button" class="btn btn-sm btn-danger" id="deleteSelectedBtn" onclick="deleteSelected()"
                        disabled>
                        <i class="bi bi-trash me-1"></i>
                        Supprimer (<span id="selectedCount">0</span>)
                    </button>
                </div>
            </div>

            <!-- Liste des notifications -->
            <div class="notification-list-scroll" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                <ul class="list-group list-group-flush">
                    @forelse($notifications as $notif)
                        <li class="list-group-item px-0 py-3 border-0 border-bottom {{ is_null($notif->read_at) ? 'bg-light bg-opacity-10' : '' }}"
                            data-notification-id="{{ $notif->id }}">

                            <div class="px-3">
                                <div class="d-flex align-items-start">
                                    <div class="form-check me-3 mt-1">
                                        <input type="checkbox" class="form-check-input notification-checkbox"
                                            value="{{ $notif->id }}" onchange="updateSelectedCount()">
                                    </div>

                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-md position-relative">
                                            <img src="{{ asset('assets/images/avatar/profil.png') }}" alt="Station"
                                                class="avatar avatar-md rounded-circle">
                                            @if(is_null($notif->read_at))
                                                <span
                                                    class="unread-indicator position-absolute top-0 start-100 translate-middle p-1 bg-primary border border-light rounded-circle"></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex-grow-1">
                                        <a href="javascript:void(0);" onclick="markAsRead('{{ $notif->id }}')"
                                            class="text-decoration-none {{ is_null($notif->read_at) ? 'text-dark' : 'text-muted' }}">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <p class="mb-1 {{ is_null($notif->read_at) ? 'fw-bold' : 'fw-normal' }}">
                                                        <span
                                                            class="badge {{ is_null($notif->read_at) ? 'bg-primary' : 'bg-secondary' }} bg-opacity-75 me-2">
                                                            {{ $notif->data['station'] ?? 'Station inconnue' }}
                                                        </span>
                                                        vous a envoyé un rapport
                                                    </p>

                                                    <div class="d-flex align-items-center text-muted">
                                                        <i class="bi bi-clock me-1"></i>
                                                        <small>{{ $notif->created_at->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item px-5 py-4 text-center border-0">
                            <div class="text-muted">
                                <i class="bi bi-bell-slash fs-1 mb-3 d-block"></i>
                                <p class="mb-0">Aucune notification</p>
                                <small>Vous êtes à jour !</small>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-bell-slash fs-1 text-muted mb-3"></i>
                <h6 class="text-muted">Aucune notification</h6>
                <p class="text-muted mb-0">Vous êtes à jour !</p>
            </div>
        @endif
    </div>
</div>

<!-- Form caché pour la suppression en masse -->
<form method="POST" action="{{ route('notifications.bulkDelete') }}" id="bulkDeleteForm" class="d-none">
    @csrf
    @method('DELETE')
    <div id="selectedNotifications"></div>
</form>