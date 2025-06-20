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
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-bell fs-2 "></i>
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 ms-n2">
                        2
                        <span class="visually-hidden">messages non lus</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0 border-0">
                    <div class="border-bottom p-5 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Notifications</h5>
                            <p class="mb-0 small">Vous avez 2 unread messages</p>
                        </div>
                        <a href="#!" class="text-muted">
                            <a href="#" class="btn btn-ghost-secondary btn-icon rounded-circle" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-title="Mark all as read">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                    class="bi bi-check2-all text-success" viewBox="0 0 16 16">
                                    <path
                                        d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                    <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                </svg>
                            </a>
                        </a>
                    </div>
                    <div data-simplebar style="height: 250px">
                        <!-- List group -->
                        <ul class="list-group list-group-flush notification-list-scroll fs-6">
                            <!-- List group item -->
                            <li class="list-group-item px-5 py-4 list-group-item-action active">
                                <a href="#!" class="text-muted">
                                    <div class="d-flex">
                                        <img src="../assets/images/avatar/profil.png" alt=""
                                            class="avatar avatar-md rounded-circle" />
                                        <div class="ms-4">
                                            <p class="mb-1">
                                                <span class="text-dark">La station JNP12 </span>
                                                vous a envoyé son rapport journalier.
                                            </p>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                    fill="currentColor" class="bi bi-clock text-muted"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                                    <path
                                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                                </svg>
                                                <small class="ms-2">1 minute ago</small>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item px-5 py-4 list-group-item-action">
                                <a href="#!" class="text-muted">
                                    <div class="d-flex">
                                        <img src="../assets/images/avatar/avatar-5.jpg" alt=""
                                            class="avatar avatar-md rounded-circle" />
                                        <div class="ms-4">
                                            <p class="mb-1">
                                                <span class="text-dark">Jitu Chauhan</span>
                                                answered to your pending order list with notes
                                            </p>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                    fill="currentColor" class="bi bi-clock text-muted"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                                    <path
                                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                                </svg>
                                                <small class="ms-2">2 days ago</small>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item px-5 py-4 list-group-item-action">
                                <a href="#!" class="text-muted">
                                    <div class="d-flex">
                                        <img src="../assets/images/avatar/avatar-2.jpg" alt=""
                                            class="avatar avatar-md rounded-circle" />
                                        <div class="ms-4">
                                            <p class="mb-1">
                                                <span class="text-dark">You have new messages</span>
                                                2 unread messages
                                            </p>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                    fill="currentColor" class="bi bi-clock text-muted"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                                    <path
                                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                                </svg>
                                                <small class="ms-2">3 days ago</small>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="border-top px-5 py-4 text-center">
                        <a href="#">View All</a>
                    </div>
                </div>
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