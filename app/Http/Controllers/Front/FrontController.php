<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Testimonial;
use App\Models\Product;

class FrontController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(3)->get();
        $testimonials = Testimonial::latest()->get();
        return view('front.index', compact('posts', 'testimonials'));
    }

    public function blog()
    {
        $posts = Post::latest()->get();
        $testimonials = Testimonial::latest()->get();
        return view('front.blog', compact('posts', 'testimonials'));
    }

    public function about()
    {
        $posts = Post::latest()->take(3)->get();
        $testimonials = Testimonial::latest()->get();
        return view('front.about', compact('posts', 'testimonials'));
    }

    public function services()
    {
        $posts = Post::latest()->take(3)->get();
        $testimonials = Testimonial::latest()->get();
        return view('front.services', compact('posts', 'testimonials'));
    }

    public function shop()
    {
        $products = Product::all();
        return view('front.shop', compact('products'));
    }

    public function contact()
    {
        return view('front.contact');
    }
}
