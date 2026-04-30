<aside id="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <i class="bi bi-box-seam-fill"></i>
            <span>Meubles Tozeur</span>
        </a>
    </div>

    <div class="mt-4">
        <div class="px-4 mb-2">
            <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">Menu Principal</small>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>
            
            <a class="nav-link {{ request()->routeIs('back.products.*') ? 'active' : '' }}" href="{{ route('back.products.index') }}">
                <i class="bi bi-bag-fill"></i>
                Produits
            </a>

            <a class="nav-link {{ request()->routeIs('back.posts.*') ? 'active' : '' }}" href="{{ route('back.posts.index') }}">
                <i class="bi bi-journal-text"></i>
                Articles
            </a>

            <a class="nav-link {{ request()->routeIs('back.testimonials.*') ? 'active' : '' }}" href="{{ route('back.testimonials.index') }}">
                <i class="bi bi-chat-quote-fill"></i>
                Témoignages
            </a>
        </nav>

        <div class="px-4 mt-4 mb-2">
            <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">Paramètres</small>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                <i class="bi bi-person-gear"></i>
                Mon Profil
            </a>
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <i class="bi bi-globe"></i>
                Voir le Site
            </a>
        </nav>
    </div>

    <div class="position-absolute bottom-0 w-100 p-4 border-top">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-box-arrow-right"></i>
                Déconnexion
            </button>
        </form>
    </div>
</aside>
