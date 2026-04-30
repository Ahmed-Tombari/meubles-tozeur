@extends('back.layout.layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5 text-center">
                <h1 class="display-4">Bienvenue, {{ Auth::user()->name }} !</h1>
                <p class="lead text-muted">C'est votre espace d'administration pour Meubles Tozeur.</p>
                <hr class="my-4">
                <div class="row mt-5">
                    <div class="col-md-4 mb-3">
                        <div class="card bg-primary text-white h-100 shadow border-0">
                            <div class="card-body d-flex flex-column justify-content-center p-4">
                                <i class="fas fa-newspaper fa-2x mb-3"></i>
                                <h3 class="card-title">Gestion des articles</h3>
                                <p class="card-text">Publiez et modifiez les articles de votre blog.</p>
                                <a href="{{ route('back.posts.index') }}" class="btn btn-light mt-auto fw-bold">Accéder</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card bg-success text-white h-100 shadow border-0">
                            <div class="card-body d-flex flex-column justify-content-center p-4">
                                <i class="fas fa-comments fa-2x mb-3"></i>
                                <h3 class="card-title">Gestion des Témoignages</h3>
                                <p class="card-text">Gérez les avis de vos clients.</p>
                                <a href="{{ route('back.testimonials.index') }}" class="btn btn-light mt-auto fw-bold">Accéder</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card bg-warning text-dark h-100 shadow border-0">
                            <div class="card-body d-flex flex-column justify-content-center p-4">
                                <i class="fas fa-couch fa-2x mb-3"></i>
                                <h3 class="card-title">Gestion des Produits</h3>
                                <p class="card-text">Ajoutez et modifiez vos meubles en vente.</p>
                                <a href="{{ route('back.products.index') }}" class="btn btn-dark mt-auto fw-bold text-white">Accéder</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
