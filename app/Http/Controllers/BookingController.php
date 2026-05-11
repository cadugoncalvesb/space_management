<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $bookings = Booking::with(['user', 'space'])->latest()->get();
        } else {
            $bookings = Booking::with(['space'])->where('user_id', $user->id)->latest()->get();
        }

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $spaces = Space::all();
        return view('bookings.create', compact('spaces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $data = $request->all();

        // Injeta o ID do usuário que está logado no sistema no momento
        $data['user_id'] = Auth::id();

        Booking::create($data);

        return redirect()->route('bookings.index')
            ->with('success', 'Reserva solicitada com sucesso! Aguarde a aprovação.');
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
        $booking = Booking::findOrFail($id);
        $spaces = Space::all();
        return view('bookings.edit', compact('booking', 'spaces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookingRequest $request, string $id)
    {
        Booking::findOrFail($id)->update($request->all());
        return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->route('bookings.index');
    }
}
