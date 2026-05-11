<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minhas Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6 flex justify-end">
                        <a href="{{ route('bookings.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                            + Fazer Nova Reserva
                        </a>
                    </div>

                    @if($bookings->isEmpty())
                        <p class="text-center text-gray-500 py-4">Nenhuma reserva encontrada.</p>
                    @else
                        <ul class="divide-y divide-gray-200 border-t border-b border-gray-200">
                            @foreach($bookings as $booking)
                                <li class="py-4 flex flex-col sm:flex-row sm:items-left justify-between gap-4">

                                    <div>
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $booking->space->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            @php
                                                $start = \Carbon\Carbon::parse($booking->start_time);
                                                $end = \Carbon\Carbon::parse($booking->end_time);
                                            @endphp

                                            @if($start->isSameDay($end))
                                                <!-- Se for no mesmo dia: dd/mm/yy das hh:mm às hh:mm -->
                                                Data: {{ $start->format('d/m/y') }} das {{ $start->format('H:i') }} às {{ $end->format('H:i') }}
                                            @else
                                                <!-- Se passar de um dia para o outro: dd/mm/yy hh:mm até dd/mm/yy hh:mm -->
                                                Data: {{ $start->format('d/m/y - H:i') }} até {{ $end->format('d/m/y - H:i') }}
                                            @endif
                                        </div>

                                        <!-- Mostra o dono da reserva somente se o usuário logado for o Admin -->
                                        @if(Auth::user()->role === 'admin')
                                            <div class="text-xs text-indigo-600 mt-1 font-semibold">
                                                Reservado por: {{ $booking->user->name }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <a href="{{route('bookings.edit', $booking->id)}}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                            Editar Reserva
                                        </a>

                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja cancelar esta reserva?')"
                                              class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit">
                                                Cancelar Reserva
                                            </x-danger-button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
