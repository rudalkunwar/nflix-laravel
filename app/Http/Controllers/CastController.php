<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Cast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $casts = Actor::all();
        return view('admin.casts.index', compact('casts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.casts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255|unique:actors,name',
            'birth_date' => 'required|date|before_or_equal:today',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/casts');
            $data['photo'] = basename($photoPath);
        }

        Actor::create($data);

        return redirect()->route('admin.casts.index')->with('success', 'Cast added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cast = Actor::find($id);
        return view('admin.casts.edit', compact('cast'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cast = Actor::find($id);
        $data = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255|',
            'birth_date' => 'required|date|before_or_equal:today',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            Storage::delete('public/casts/' . $cast->photo);
            $photoPath = $request->file('photo')->store('public/casts');
            $data['photo'] = basename($photoPath);
        }

        $cast->update($data);

        return redirect()->route('admin.casts.index')->with('success', 'Cast updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cast = Actor::findOrFail($id);
        if ($cast->photo) {
            Storage::delete('public/casts/' . $cast->photo);
        }
        $cast->delete();
        return redirect()->route('admin.casts.index')->with('success', 'Cast deleted');
    }
}
