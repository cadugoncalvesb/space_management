<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;
use App\Models\Local;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // O padrão seria $spaces = Space::all();
        // Mas como irá exibir o nome do Local na tela, usa-se o 'with' para o banco de dados já trazer essa informação junto.
        $spaces = Space::with('local')->get();

        return view('spaces.index', compact('spaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locals = Local::all();

        return view('spaces.create', compact('locals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Space::create($request->all());

        return redirect()->route('spaces.index');
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
        $space = Space::findOrFail($id);
        $locals = Local::all();
        return view('spaces.edit', compact('space', 'locals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $space = Space::findOrFail($id);
        $space->update($request->all());

        return redirect()->route('spaces.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Space::findOrFail($id)->delete();

        return redirect()->route('spaces.index');
    }
}
