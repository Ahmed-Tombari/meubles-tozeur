@extends('back.layout.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestion des Témoignages</h1>
    <a href="{{ route('back.testimonials.create') }}" class="btn btn-primary">Ajouter un témoignage</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Poste (Job)</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td>{{ $testimonial->name }}</td>
                        <td>{{ $testimonial->job }}</td>
                        <td>
                            @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" width="50" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $testimonial->created_at->format('d/m/Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('back.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-info">Modifier</a>
                            <form action="{{ route('back.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce témoignage ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Aucun témoignage trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
