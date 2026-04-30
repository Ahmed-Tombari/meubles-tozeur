@extends('back.layout.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestion des articles (Blog)</h1>
    <a href="{{ route('back.posts.create') }}" class="btn btn-primary">Ajouter un article</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author }}</td>
                        <td>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" width="50" class="rounded">
                            @endif
                        </td>
                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('back.posts.edit', $post) }}" class="btn btn-sm btn-outline-info">Modifier</a>
                            <form action="{{ route('back.posts.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cet article ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Aucun article trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
