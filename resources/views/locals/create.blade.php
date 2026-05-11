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

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong class="font-bold">Atenção!</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('locals.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Nome do Local" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus />
                        </div>

                        <div>
                            <x-input-label for="address" value="Endereço" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" value="{{ old('address') }}" required />
                        </div>

                        <div>
                            <x-input-label for="description" value="Descrição" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" value="{{ old('description') }}" />
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <x-primary-button>
                                Cadastrar Local
                            </x-primary-button>

                            <a href="{{ route('locals.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Cancelar e Voltar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
