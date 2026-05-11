<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

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

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <p>Nome: <input type="text" name="name" value="{{ old('name') }}"></p>

                        <p>E-mail: <input type="email" name="email" value="{{ old('email') }}"></p>

                        <p>Telefone: <input type="text" name="phone" value="{{ old('phone') }}"></p>

                        <p>Perfil:
                            <select name="role">
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuário</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador
                                </option>
                            </select>
                        </p>

                        <p>Senha: <input type="password" name="password"></p>

                        <p>Confirmar Senha: <input type="password" name="password_confirmation"></p>

                        <button type="submit">Salvar Usuário</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
