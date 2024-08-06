<?php

namespace App\Http\Controllers;

use App\Category;
use App\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login
        $informations = Information::with('category')
            ->where('user_id', $userId) // Menambahkan filter berdasarkan user_id
            ->get();

        return view('pages.informations.index', compact('informations'));
    }

    public function index_user()
    {
        $informations = Information::with('category')->get();
        return view('pages.informations.information', compact('informations'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.informations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'date_tanam' => 'required|date',
            'date_panen' => 'required|date',
        ]);

        Information::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'date_tanam' => $request->date_tanam,
            'date_panen' => $request->date_panen,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('informations.index')->with('success', 'Panen berhasil ditambahkan!');
    }
    public function edit(Information $information)
    {
        $categories = Category::all();
        return view('pages.informations.edit', compact('information', 'categories'));
    }

    public function update(Request $request, Information $information)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'date_tanam' => 'required|date',
            'date_panen' => 'required|date',
        ]);

        $information->update($request->all());
        return redirect()->route('informations.index')->with('success', 'Informasi panen berhasil diperbarui!');
    }

    public function destroy(Information $information)
    {
        $information->delete();
        return redirect()->route('informations.index')->with('success', 'Informasi panen berhasil dihapus!');
    }
}
