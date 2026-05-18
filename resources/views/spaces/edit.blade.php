<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Espaço:') }} {{ $space->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong class="font-bold">Atenção!</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('spaces.update', $space->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" value="Nome do Espaço" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $space->name) }}" required />
                        </div>

                        <div>
                            <x-input-label for="type" value="Tipo (ex: Laboratório, Sala)" />
                            <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" value="{{ old('type', $space->type) }}" required />
                        </div>

                        <div>
                            <x-input-label for="local_id" value="Local" />
                            <select id="local_id" name="local_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled>Selecione um local...</option>
                                @foreach($locals as $local)
                                    <option value="{{ $local->id }}" {{ old('local_id', $space->local_id) == $local->id ? 'selected' : '' }}>
                                        {{ $local->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="capacity" value="Capacidade" />
                            <x-text-input id="capacity" name="capacity" type="number" class="mt-1 block w-full" value="{{ old('capacity', $space->capacity) }}" required />
                        </div>

                        <div>
                            <x-input-label for="status" value="Status" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="active" {{ old('status', $space->status) == 'active' ? 'selected' : '' }}>Ativo</option>
                                <option value="inactive" {{ old('status', $space->status) == 'inactive' ? 'selected' : '' }}>Inativo</option>
                                <option value="maintenance" {{ old('status', $space->status) == 'maintenance' ? 'selected' : '' }}>Em Manutenção</option>
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                Atualizar Espaço
                            </x-primary-button>

                            <a href="{{ route('spaces.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
