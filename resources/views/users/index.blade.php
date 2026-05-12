<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Usuários') }}
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

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
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
