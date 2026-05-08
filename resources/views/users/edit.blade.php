@extends('layouts.app')

@section('content')
    <h1>Editar Usuário: {{ $user->name }}</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <strong>Atenção:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p>Nome: <input type="text" name="name" value="{{ old('name', $user->name) }}"></p>

        <p>E-mail: <input type="email" name="email" value="{{ old('email', $user->email) }}"></p>

        <p>Telefone: <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"></p>

        <p>Perfil:
            <select name="role">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuário</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
        </p>

        <hr>
        <p><em>Deixe os campos de senha em branco caso não queira alterá-la.</em></p>

        <p>Nova Senha: <input type="password" name="password"></p>

        <p>Confirmar Nova Senha: <input type="password" name="password_confirmation"></p>

        <button type="submit">Atualizar Usuário</button>
    </form>
@endsection
