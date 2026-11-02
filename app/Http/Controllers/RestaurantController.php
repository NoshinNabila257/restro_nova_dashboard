<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    public function create()
    {
        return view('restaurants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('restaurants', 'public');
        }

        $request->user()->restaurants()->create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Restaurant created successfully!');
    }
    public function index()
    {
    $restaurants = \Illuminate\Support\Facades\Auth::user()->restaurants;

    return view('restaurants.index', compact('restaurants'));
    }

    public function edit(Restaurant $restaurant)
    {
        abort_unless(
            (int) $restaurant->owner_id === (int) auth()->id(),
            403
        );

        return view('restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        abort_unless(
            (int) $restaurant->owner_id === (int) auth()->id(),
            403
        );

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $oldImage = $restaurant->image;

            $validated['image'] = $request->file('image')
                ->store('restaurants', 'public');

            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $restaurant->update($validated);

        return redirect()
            ->route('restaurants.index')
            ->with('success', 'Restaurant updated successfully!');
    }
}
