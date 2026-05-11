<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Espaço') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('spaces.update', $space->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        Nome do Espaço: <input type="text" name="name" value="{{ $space->name }}">
                        Tipo (ex: Laboratório, Sala): <input type="text" name="type" value="{{ $space->type }}">
                        Capacidade: <input type="number" name="capacity" value="{{$space->capacity}}">
                        Status:
                        <select name="status">
                            <option value="active" {{ $space->status == 'active' ? 'selected' : '' }}>Ativo</option>
                            <option value="inactive" {{ $space->status == 'inactive' ? 'selected' : '' }}>Inativo
                            </option>
                            <option value="maintenance" {{ $space->status == 'maintenance' ? 'selected' : '' }}>Em
                                Manutenção
                            </option>
                        </select>
                        <select name="local_id">
                            @foreach($locals as $local)
                                <option value="{{ $local->id }}" {{ $space->local_id == $local->id ? 'selected' : '' }}>
                                    {{ $local->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit">Salvar Espaço</button>
                    </form>

                    <br>
                    <a href="{{ route('spaces.index') }}">Voltar para a lista</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
