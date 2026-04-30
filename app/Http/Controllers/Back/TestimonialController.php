<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('back.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('back.testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:testimonials,name',
            'job' => 'required',
            'description' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,svg|max:1024',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.unique' => 'Ce nom existe déjà dans les témoignages.',
            'job.required' => 'Le poste (job) est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'description.max' => 'La description ne doit pas dépasser 100 caractères.',
            'image.required' => 'L\'image est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpeg, png ou svg.',
            'image.max' => 'L\'image ne doit pas dépasser 1Mo.',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('back.testimonials.index')->with('success', 'Témoignage créé avec succès.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('back.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|unique:testimonials,name,' . $testimonial->id,
            'job' => 'required',
            'description' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,svg|max:1024',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.unique' => 'Ce nom existe déjà dans les témoignages.',
            'job.required' => 'Le poste (job) est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'description.max' => 'La description ne doit pas dépasser 100 caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpeg, png ou svg.',
            'image.max' => 'L\'image ne doit pas dépasser 1Mo.',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('back.testimonials.index')->with('success', 'Témoignage modifié avec succès.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();
        return redirect()->route('back.testimonials.index')->with('success', 'Témoignage supprimé avec succès.');
    }
}
