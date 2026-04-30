@extends('back.layout.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestion des Produits</h1>
    <a href="{{ route('back.products.create') }}" class="btn btn-primary">Ajouter un produit</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            @if($product->image)
                                @if(Str::startsWith($product->image, 'front/'))
                                    <img src="{{ asset($product->image) }}" width="50" class="rounded">
                                @else
                                    <img src="{{ asset('storage/' . $product->image) }}" width="50" class="rounded">
                                @endif
                            @endif
                        </td>
                        <td>{{ $product->created_at->format('d/m/Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('back.products.edit', $product) }}" class="btn btn-sm btn-outline-info">Modifier</a>
                            <form action="{{ route('back.products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Aucun produit trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
