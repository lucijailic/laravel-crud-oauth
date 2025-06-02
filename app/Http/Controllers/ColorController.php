<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::paginate(10);
        return view('colors.index', compact('colors'));
    }

    public function create()
    {
        return view('colors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:colors,name',
        ]);

        Color::create($request->only('name'));

        return redirect()->route('colors.index')->with('success', 'Color created successfully.');
    }

    public function show(Color $color)
    {
        return view('colors.show', compact('color'));
    }

    public function edit(Color $color)
    {
        return view('colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:colors,name,' . $color->id,
        ]);

        $color->update($request->only('name'));

        return redirect()->route('colors.index')->with('success', 'Color updated successfully.');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('colors.index')->with('success', 'Color deleted successfully.');
    }
}
