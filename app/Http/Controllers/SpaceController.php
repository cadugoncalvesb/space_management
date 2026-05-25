<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Models\Space;
use App\Models\Local;
use App\Http\Requests\StoreSpaceRequest;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Space::with('resources', 'local');

        $query->when($request->filled('resource_id'), function ($q) use ($request) {
            $q->whereHas('resources', function ($queryRelacao) use ($request) {
                $queryRelacao->where('resources.id', $request->resource_id);
            });
        });

        $query->when($request->filled('local_id'), function ($q) use ($request) {
            $q->where('local_id', $request->local_id);
        });

        $spaces = $query->orderBy('status', 'asc')->get();
        $resources = Resource::all();
        $locals = Local::all();

        return view('spaces.index', compact('spaces', 'resources', 'locals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locals = Local::all();
        $resources = Resource::all();

        return view('spaces.create', compact('locals', 'resources'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpaceRequest $request)
    {
        $space = Space::create($request->except('resources'));
        // Vincula os recursos com o espaço
        $space->resources()->sync($request->input('resources', []));

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
        $space = Space::with('resources')->findOrFail($id);
        $locals = Local::all();
        $resources = Resource::all();
        return view('spaces.edit', compact('space', 'locals', 'resources'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSpaceRequest $request, string $id)
    {
        $space = Space::findOrFail($id);
        $space->update($request->except('resources'));

        $space->resources()->sync($request->input('resources', []));

        return redirect()->route('spaces.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $space = Space::findOrFail($id);

        if (Booking::where('space_id', $id)->exists()) {
            return redirect()->route('spaces.index')->with('error', 'Ação bloqueada: Não é possível excluir um espaço com uma reserva vinculada a ele.');
        }

        $space->delete();

        return redirect()->route('spaces.index')->with('success', 'Espaço excluído com sucesso.');
    }
}
