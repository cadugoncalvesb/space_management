@extends('layouts.app')

@section('content')
    <h1>Lista de Usuários</h1>

    <a href="{{ route('users.create') }}">Cadastrar Novo Usuário</a>

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px;">
        <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Perfil</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? 'Não informado' }}</td>
                <td>{{ $user->role == 'admin' ? 'Administrador' : 'User' }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}">Editar</a>

                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
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
