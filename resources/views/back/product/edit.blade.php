@extends('back.layout.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('back.products.index') }}" class="text-decoration-none">← Retour à la liste</a>
    <h1 class="mt-2">Modifier le produit : {{ $product->name }}</h1>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('back.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du produit</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Prix ($)</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}">
                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optionnel)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <label for="image" class="form-label d-block text-start">Image du produit</label>
                        <div class="mb-3">
                            @if($product->image)
                                @if(Str::startsWith($product->image, 'front/'))
                                    <img src="{{ asset($product->image) }}" width="150" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('storage/' . $product->image) }}" width="150" class="img-thumbnail">
                                @endif
                            @endif
                        </div>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        <div class="form-text text-start">Laissez vide pour conserver l'image actuelle.</div>
                        @error('image') <div class="invalid-feedback text-start">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>
@endsection
