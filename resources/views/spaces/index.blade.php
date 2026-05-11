<x-app-layout>

    <x-slot name="header">
        <!-- Mude o título aqui dependendo da página -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Espaços') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('spaces.create') }}">Cadastrar Novo Espaço</a>
                    <br><br>

                    <table border="1">
                        <thead>
                        <tr>
                            <th>Nome do Espaço</th>
                            <th>Local (Prédio)</th>
                            <th>Tipo</th>
                            <th>Capacidade</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($spaces as $space)
                            <tr>
                                <td>{{ $space->name }}</td>
                                <td>{{ $space->local->name }}</td>
                                <td>{{ $space->type }}</td>
                                <td>{{ $space->capacity }}</td>
                                <td>{{ $space->status }}</td>
                                <td>
                                    <a href="{{ route('spaces.edit', $space->id) }}">Editar</a>

                                    <form action="{{ route('spaces.destroy', $space->id) }}" method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('Tem certeza que deseja exluir este espaço?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
