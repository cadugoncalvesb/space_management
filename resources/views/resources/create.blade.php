<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Novo Local') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('resources.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Nome do Recurso"></x-input-label>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus></x-text-input>
                        </div>

                        <div>
                            <x-input-label for="description" value="Descrição"></x-input-label>
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" value="{{ old('description') }}"></x-text-input>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <x-primary-button>
                                Cadastrar recurso
                            </x-primary-button>

                            <a href="{{ route('resources.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Cancelar e voltar
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
