@extends('layouts.app')

@section('content')
    <h1>Lista de Espaços</h1>

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

                    <form action="{{ route('spaces.destroy', $space->id) }}" method="POST" style="display:inline;"
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
@endsection
