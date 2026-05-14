<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Novo Usuário') }}
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

                    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Nome Completo"/>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          value="{{ old('name') }}" required autofocus/>
                        </div>

                        <div>
                            <x-input-label for="role" value="Perfil de Acesso"/>
                            <select id="role" name="role"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuário Comum
                                </option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador
                                </option>
                            </select>
                        </div>


                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="phone" value="Telefone"/>
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                                              value="{{ old('phone') }}"/>
                            </div>

                        </div>
                        <div>
                            <x-input-label for="email" value="E-mail"/>
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                          value="{{ old('email') }}" required/>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="password" value="Senha"/>
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                              required/>
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" value="Confirmar Senha"/>
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                              class="mt-1 block w-full" required/>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
                            <x-primary-button>
                                Cadastrar Usuário
                            </x-primary-button>

                            <a href="{{ route('users.index') }}"
                               class="text-sm text-gray-600 hover:text-gray-900 transition ease-in-out duration-150">
                                Cancelar e Voltar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
