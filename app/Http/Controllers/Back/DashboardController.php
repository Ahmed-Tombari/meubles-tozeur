<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts' => Post::count(),
            'total_testimonials' => Testimonial::count(),
            'total_products' => Product::count(),
            'latest_post' => Post::latest()->first(),
            'latest_testimonial' => Testimonial::latest()->first(),
        ];

        // Pie Chart: Distribution
        $pieData = [
            'labels' => ['Articles', 'Témoignages', 'Produits'],
            'data' => [
                $stats['total_posts'],
                $stats['total_testimonials'],
                $stats['total_products']
            ]
        ];

        // Bar Chart: Posts per month (last 6 months)
        $monthlyPosts = Post::select(
            DB::raw('count(id) as count'),
            DB::raw("MONTH(created_at) as month")
        )
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $barData = [
            'labels' => [],
            'data' => []
        ];

        foreach ($monthlyPosts as $stat) {
            $monthIndex = (int)$stat->month - 1;
            $barData['labels'][] = $months[$monthIndex];
            $barData['data'][] = $stat->count;
        }

        // Default data if empty
        if (empty($barData['labels'])) {
            $barData['labels'] = ['Aucune donnée'];
            $barData['data'] = [0];
        }

        return view('back.dashboard', compact('stats', 'pieData', 'barData'));
    }
}
