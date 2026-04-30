@extends('back.layout.layout')

@section('title', 'Dashboard')
@section('page_title', 'Tableau de bord')

@section('content')
<div class="row g-4 mb-4">
    <!-- Stat Card 1 -->
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card h-100 border-0">
            <div class="stats-icon bg-primary-soft">
                <i class="bi bi-journal-text"></i>
            </div>
            <h6 class="text-muted mb-1">Total Articles</h6>
            <h3 class="fw-bold mb-0">{{ $stats['total_posts'] }}</h3>
            <div class="mt-2">
                <small class="text-success"><i class="bi bi-arrow-up me-1"></i>En ligne</small>
            </div>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card h-100 border-0">
            <div class="stats-icon bg-success-soft">
                <i class="bi bi-chat-quote"></i>
            </div>
            <h6 class="text-muted mb-1">Témoignages</h6>
            <h3 class="fw-bold mb-0">{{ $stats['total_testimonials'] }}</h3>
            <div class="mt-2">
                <small class="text-success"><i class="bi bi-check-circle me-1"></i>Approuvés</small>
            </div>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card h-100 border-0">
            <div class="stats-icon bg-warning-soft">
                <i class="bi bi-bag-check"></i>
            </div>
            <h6 class="text-muted mb-1">Total Produits</h6>
            <h3 class="fw-bold mb-0">{{ $stats['total_products'] }}</h3>
            <div class="mt-2">
                <small class="text-info"><i class="bi bi-info-circle me-1"></i>En stock</small>
            </div>
        </div>
    </div>

    <!-- Stat Card 4 -->
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card h-100 border-0">
            <div class="stats-icon bg-info-soft">
                <i class="bi bi-people"></i>
            </div>
            <h6 class="text-muted mb-1">Dernier Article</h6>
            <h6 class="fw-bold mb-0 text-truncate">{{ $stats['latest_post']->title ?? 'N/A' }}</h6>
            <div class="mt-2">
                <small class="text-muted">{{ $stats['latest_post'] ? $stats['latest_post']->created_at->diffForHumans() : '-' }}</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Bar Chart -->
    <div class="col-lg-8">
        <div class="card border-0 h-100">
            <div class="card-header bg-white border-0 py-3 px-4">
                <h5 class="card-title mb-0 fw-bold">Articles publiés par mois</h5>
            </div>
            <div class="card-body px-4 pb-4">
                <canvas id="postsChart" style="min-height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-lg-4">
        <div class="card border-0 h-100">
            <div class="card-header bg-white border-0 py-3 px-4">
                <h5 class="card-title mb-0 fw-bold">Distribution Contenu</h5>
            </div>
            <div class="card-body px-4 pb-4 d-flex align-items-center">
                <canvas id="distributionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold">Derniers Témoignages</h5>
                <a href="{{ route('back.testimonials.index') }}" class="btn btn-sm btn-light">Voir tout</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 border-0">Auteur</th>
                                <th class="border-0">Job</th>
                                <th class="border-0 text-end px-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $recentTestimonials = \App\Models\Testimonial::latest()->take(5)->get(); @endphp
                            @forelse($recentTestimonials as $testimonial)
                            <tr>
                                <td class="px-4 fw-semibold">{{ $testimonial->name }}</td>
                                <td><span class="badge bg-primary-soft">{{ $testimonial->job }}</span></td>
                                <td class="text-end px-4 text-muted small">{{ $testimonial->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/gray/no-data.svg" width="120" class="mb-3">
                                    <p class="text-muted mb-0">Aucun témoignage disponible.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Bar Chart
    const barCtx = document.getElementById('postsChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: @json($barData['labels']),
            datasets: [{
                label: 'Articles',
                data: @json($barData['data']),
                backgroundColor: '#6366f1',
                borderRadius: 8,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });

    // Pie Chart
    const pieCtx = document.getElementById('distributionChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: @json($pieData['labels']),
            datasets: [{
                data: @json($pieData['data']),
                backgroundColor: ['#6366f1', '#22c55e', '#f59e0b'],
                borderWidth: 0,
                cutout: '70%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
            }
        }
    });
</script>
@endsection
