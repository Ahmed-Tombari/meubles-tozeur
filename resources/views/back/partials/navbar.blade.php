<nav class="navbar navbar-expand-lg navbar-main shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-light d-lg-none me-2" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        
        <div class="d-flex align-items-center">
            <h5 class="mb-0 fw-semibold">@yield('page_title', 'Overview')</h5>
        </div>

        <div class="ms-auto d-flex align-items-center gap-3">
            <div class="dropdown">
                <button class="btn btn-light border-0 d-flex align-items-center gap-2 px-3 py-2" type="button" data-bs-toggle="dropdown">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.8rem;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="text-start d-none d-sm-block">
                        <div class="fw-bold" style="font-size: 0.85rem; line-height: 1;">{{ Auth::user()->name }}</div>
                        <small class="text-muted" style="font-size: 0.75rem;">Administrateur</small>
                    </div>
                    <i class="bi bi-chevron-down text-muted" style="font-size: 0.8rem;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    <li><a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('profile.edit') }}"><i class="bi bi-person"></i> Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger d-flex align-items-center gap-2">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
