@extends('back.layout.layout')

@section('content')
<div class="mb-4">
    <h1>Ajouter un nouveau témoignage</h1>
    <a href="{{ route('back.testimonials.index') }}" class="text-decoration-none">← Retour à la liste</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('back.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom complet</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="job" class="form-label">Poste / Job</label>
                        <input type="text" name="job" id="job" class="form-control @error('job') is-invalid @enderror" value="{{ old('job') }}">
                        @error('job')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description (max 100 caractères)</label>
                        <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image (Avatar - jpeg, png, svg, max 1Mo)</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success px-4">Enregistrer le témoignage</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
