<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Espaço') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                            <strong class="font-bold">Atenção!</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('spaces.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Nome do Espaço" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus placeholder="Ex: Laboratório de Informática 01" />
                        </div>

                        <div>
                            <x-input-label for="type" value="Tipo (ex: Laboratório, Sala, Auditório)" />
                            <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" value="{{ old('type') }}" required />
                        </div>

                        <div>
                            <x-input-label for="local_id" value="Local / Prédio" />
                            <select id="local_id" name="local_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled {{ old('local_id') ? '' : 'selected' }}>Selecione um local...</option>
                                @foreach($locals as $local)
                                    <option value="{{ $local->id }}" {{ old('local_id') == $local->id ? 'selected' : '' }}>
                                        {{ $local->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="capacity" value="Capacidade (Pessoas)" />
                            <x-text-input id="capacity" name="capacity" type="number" class="mt-1 block w-full" value="{{ old('capacity') }}" required />
                        </div>

                        <div>
                            <x-input-label for="status" value="Status Inicial" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Ativo</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inativo</option>
                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Em Manutenção</option>
                            </select>
                        </div>

                        <div class="mt-4 mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Recursos do Espaço:</label>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 border border-gray-200 rounded-md bg-gray-50">
                                @foreach($resources as $resource)
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox"
                                               name="resources[]"
                                               value="{{ $resource->id }}"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            {{ in_array($resource->id, old('resources', isset($space) ? $space->resources->pluck('id')->toArray() : [])) ? 'checked' : '' }}
                                        >
                                        <span class="ml-2 text-sm text-gray-700">{{ $resource->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <x-primary-button>
                                Salvar Novo Espaço
                            </x-primary-button>

                            <a href="{{ route('spaces.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                                Cancelar e Voltar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
