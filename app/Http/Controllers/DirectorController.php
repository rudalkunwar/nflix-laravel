<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directors = director::all();
        return view('admin.directors.index', compact('directors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.directors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255|unique:directors,name',
            'birth_date' => 'nullable|date|before_or_equal:today',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/directors');
            $data['photo'] = basename($photoPath);
        }

        Director::create($data);

        return redirect()->route('admin.directors.index')->with('success', 'director added successfully.');
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
        $director = Director::find($id);
        return view('admin.directors.edit', compact('director'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $director = Director::find($id);
        $data = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255|',
            'birth_date' => 'nullable|date|before_or_equal:today',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            Storage::delete('public/directors/'.$director->photo);
            $photoPath = $request->file('photo')->store('public/directors');
            $data['photo'] = basename($photoPath);
        }

        $director->update($data);

        return redirect()->route('admin.directors.index')->with('success', 'director updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $director = Director::findOrFail($id);
        if ($director->photo) {
            Storage::delete('public/directors/'.$director->photo);
        }
        $director->delete();
        return redirect()->route('admin.directors.index')->with('success', 'director deleted');
    }
}
