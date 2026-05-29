<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlowerController extends Controller
{
    public function index()
    {
        $flowers = Flower::latest()->paginate(10);
        return view('flowers.index', compact('flowers'));
    }

    public function create()
    {
        return view('flowers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,out-of-stock'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('flowers', 'public');
        }

        Flower::create($data);

        return redirect()->route('flowers.index')
                        ->with('success', 'Flower created successfully.');
    }

    public function show(Flower $flower)
    {
        return view('flowers.show', compact('flower'));
    }

    public function edit(Flower $flower)
    {
        return view('flowers.edit', compact('flower'));
    }

    public function update(Request $request, Flower $flower)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,out-of-stock'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($flower->image) {
                Storage::disk('public')->delete($flower->image);
            }
            $data['image'] = $request->file('image')->store('flowers', 'public');
        }

        $flower->update($data);

        return redirect()->route('flowers.index')
                        ->with('success', 'Flower updated successfully.');
    }

    public function destroy(Flower $flower)
    {
        if ($flower->image) {
            Storage::disk('public')->delete($flower->image);
        }
        $flower->delete();

        return redirect()->route('flowers.index')
                        ->with('success', 'Flower deleted successfully.');
    }
}