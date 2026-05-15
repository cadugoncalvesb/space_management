<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Busca as reservas já trazendo as relações de espaço e usuário para não pesar o banco
    $query = \App\Models\Booking::with(['space', 'user']);

    // Se NÃO for admin, filtra apenas as reservas do usuário logado
    if (auth()->user()->role !== 'admin') {
        $query->where('user_id', auth()->id());
    }

    // Mapeia os resultados para o formato que o FullCalendar entende
    $eventos = $query->get()->map(function($booking) {
        $titulo = $booking->space->name;

        // Se for admin, adiciona o nome de quem reservou do lado do nome do espaço
        if (auth()->user()->role === 'admin') {
            $titulo .= ' (' . $booking->user->name . ')';
        }

        return [
            'title' => $titulo,
            'start' => $booking->start_time,
            'end'   => $booking->end_time,
            // Truque de UX: Cor azul (Indigo) para as reservas do próprio usuário, e cinza para as reservas dos outros
            'color' => auth()->id() === $booking->user_id ? '#4F46E5' : '#6B7280',
        ];
    });

    return view('dashboard', compact('eventos'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logs', [\App\Http\Controllers\LogController::class, 'index'])->name('logs.index');

    Route::resource('locals', LocalController::class);
    Route::resource('spaces', SpaceController::class);
    Route::resource('users', UserController::class);
    Route::resource('bookings', BookingController::class);
});

require __DIR__.'/auth.php';
