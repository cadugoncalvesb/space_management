<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova Reserva') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong class="font-bold">Não foi possível reservar:</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="space_id" value="Qual espaço deseja reservar?"/>
                            <select id="space_id" name="space_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                <option value="">Selecione um espaço</option>
                                @foreach($spaces as $space)
                                    @if($space->status === 'active')
                                        <option
                                            value="{{ $space->id }}" {{ old('space_id') == $space->id ? 'selected' : '' }}>
                                            {{ $space->name }} - {{$space->local?->name ?? 'Local não definido' }} -
                                            (Capacidade: {{ $space->capacity }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="start_time" value="Início (Data e Hora)"/>
                                <x-text-input id="start_time" name="start_time" type="datetime-local"
                                              class="mt-1 block w-full" value="{{ old('start_time') }}" required
                                              min="{{ now()->format('Y-m-d\TH:i') }}"/>
                            </div>

                            <div>
                                <x-input-label for="end_time" value="Término (Data e Hora)"/>
                                <x-text-input id="end_time" name="end_time" type="datetime-local"
                                              class="mt-1 block w-full" value="{{ old('end_time') }}" required
                                              min="{{ now()->format('Y-m-d\TH:i') }}"/>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <x-primary-button>
                                Confirmar Reserva
                            </x-primary-button>

                            <a href="{{ route('bookings.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
