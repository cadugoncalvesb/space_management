<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Espaços') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('error'))
                        <div class="">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6 flex justify-between items-end">

                        @if($spaces->isNotEmpty())
                            <div>
                                <form method="GET" action="{{ route('spaces.index') }}" class="flex items-end gap-3">

                                    <div>
                                        <label for="resource_id" class="block text-sm font-medium text-gray-700 mb-1">Filtrar
                                            por Recurso</label>
                                        <select name="resource_id" id="resource_id"
                                                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">Todos os recursos</option>
                                            @foreach($resources as $resource)
                                                <option
                                                    value="{{ $resource->id }}" {{ request('resource_id') == $resource->id ? 'selected' : '' }}>
                                                    {{ $resource->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="local_id" class="block text-sm font-medium text-gray-700 mb-1">Filtrar
                                            por Local</label>
                                        <select name="local_id" id="local_id"
                                                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">Todos os locais</option>
                                            @foreach($locals as $local)
                                                <option
                                                    value="{{ $local->id }}" {{ request('local_id') == $local->id ? 'selected' : '' }}>
                                                    {{ $local->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit"
                                            class="bg-indigo-500 px-4 py-2 rounded-md hover:bg-indigo-700 transition mt-6">
                                        🔍 Filtrar
                                    </button>

                                    <a href="{{ route('spaces.index') }}"
                                       class="text-gray-500 hover:text-gray-700 px-4 py-2 text-center mt-6">
                                        Limpar
                                    </a>

                                </form>
                            </div>
                        @endif

                        @if(auth()->user()->role === 'admin')
                            <div>
                                <a href="{{ route('spaces.create') }}"
                                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    + Cadastrar Novo Espaço
                                </a>
                            </div>
                        @endif

                    </div>

                    @if($spaces->isEmpty())
                        <p class="text-center text-gray-500 py-4">Nenhum espaço cadastrado no momento.</p>
                    @else
                        <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm mt-4">
                            <table class="w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nome
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Local (Prédio)
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tipo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Capacidade
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Recursos
                                    </th>
                                    @if(auth()->user()->role === 'admin')
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ações
                                        </th>
                                    @endif
                                </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($spaces as $space)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $space->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div
                                                class="text-sm font-medium text-gray-900 text-center">{{ $space->local->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div
                                                class="text-sm font-medium text-gray-900 text-center">{{ $space->type }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div
                                                class="text-sm font-medium text-gray-900 text-center">{{ $space->capacity }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div
                                                class="text-sm font-medium text-gray-900 text-center">
                                                {{ match ($space->status) {
                                                    'active' => 'Ativo',
                                                    'inactive' => 'Inativo',
                                                    'maintenance' => 'Em manutenção',
                                                    default => 'Desconhecido'
                                                } }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-wrap gap-1">
                                                @forelse($space->resources as $resource)
                                                    <span
                                                        class="px-2 py-1 text-xs text-blue-700 bg-blue-100 rounded-md border border-blue-200">
                                                        {{ $resource->name }}
                                                    </span>
                                                @empty
                                                    <span class="text-xs text-gray-400 italic">Nenhum recurso</span>
                                                @endforelse
                                            </div>
                                        </td>


                                        @if(auth()->user()->role === 'admin')
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center justify-end gap-3">
                                                    <a href="{{ route('spaces.edit', $space->id) }}"
                                                       class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                                        Editar
                                                    </a>

                                                    <form action="{{ route('spaces.destroy', $space->id) }}"
                                                          method="POST"
                                                          style="display:inline;"
                                                          onsubmit="return confirm('Tem certeza que deseja exluir este espaço?')">
                                                        {{--                                            @if({{$space-}}) @endif--}}
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                            Excluir
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
