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

                    @if($errors->any())
                        <div style="color: red; margin-bottom: 20px;">
                            <strong>Atenção:</strong>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('spaces.store') }}" method="POST">
                        @csrf

                        Nome do Espaço: <input type="text" name="name" value="{{old('name')}}" required>
                        Tipo (ex: Laboratório, Sala): <input type="text" name="type" value="{{old('type')}}" required>
                        Capacidade: <input type="number" name="capacity" value="{{old('capacity')}}" required>
                        Status:
                        <select name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Ativo</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inativo
                            </option>
                            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Em
                                Manutenção
                            </option>
                        </select>
                        <select name="local_id" required>
                            <option value="">Selecione um Local:</option>
                            @foreach($locals as $local)
                                <option value="{{ $local->id }}">{{ $local->name }}</option>
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
