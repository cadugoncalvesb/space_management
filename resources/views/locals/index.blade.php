<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Locais') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(auth()->user()->role === 'admin')
                        <div class="mb-6 flex justify-end">
                            <a href="{{ route('locals.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                + Cadastrar Novo Local
                            </a>
                        </div>
                    @endif

                    @if($locals->isEmpty())
                        <p class="text-center text-gray-500 py-4">Nenhum local cadastrado no momento.</p>
                    @else
                        <ul class="divide-y divide-gray-200 border-t border-b border-gray-200">
                            @foreach($locals as $local)
                                <li class="py-4 flex items-center justify-between">

                                    <div class="text-lg font-medium text-gray-900">
                                        {{ $local->name }} <br>
                                        Descrição: {{$local->description}}
                                    </div>

                                    @if(auth()->user()->role === 'admin')
                                        <div class="flex items-center gap-3">

                                            <a href="{{ route('locals.edit', $local->id) }}"
                                               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                                Editar
                                            </a>

                                            <form action="{{ route('locals.destroy', $local->id) }}" method="POST"
                                                  onsubmit="return confirm('Tem certeza que deseja excluir este local?')"
                                                  class="m-0 p-0">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit">
                                                    Excluir
                                                </x-danger-button>
                                            </form>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
