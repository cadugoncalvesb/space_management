<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Auditoria e Logs de Segurança') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if($logs->isEmpty())
                        <p class="text-center text-gray-500 py-4">Nenhum log registrado ainda.</p>
                    @else
                        <!-- TABELA DE LOGS -->
                        <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm mt-4 -mx-6 mb-[-24px]">
                            <!-- O min-w-full garante que a tabela ocupe 100% do espaço, e fixed ajuda na distribuição das colunas -->
                            <table class="min-w-full divide-y divide-gray-200 text-sm table-fixed">
                                <thead class="bg-gray-50">
                                <tr>
                                    <!-- Distribuição de larguras (w-2/12 = ~16%, w-4/12 = ~33%) -->
                                    <th scope="col" class="w-2/12 px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Data / Hora</th>
                                    <th scope="col" class="w-4/12 px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Usuário (Causador)</th>
                                    <th scope="col" class="w-2/12 px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Evento</th>
                                    <th scope="col" class="w-4/12 px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Descrição da Ação</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($logs as $log)
                                    <!-- align-top joga o conteúdo para cima caso uma coluna fique mais alta que a outra -->
                                    <tr class="hover:bg-gray-50 transition duration-150 align-top">

                                        <!-- DATA E HORA (Pode manter em uma linha só) -->
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                            {{ $log->created_at->format('d/m/Y H:i:s') }}
                                        </td>

                                        <!-- USUÁRIO CAUSADOR (Retirado o whitespace-nowrap) -->
                                        <td class="px-6 py-4">
                                            @if($log->causer)
                                                <div class="font-medium text-gray-900">{{ $log->causer->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $log->causer->email }}</div>
                                            @else
                                                <div class="text-gray-400 italic">Anônimo</div>
                                            @endif

                                            <!-- Qual IP e SO? -->
                                            <div class="mt-3 space-y-2">
                                                <div class="text-[11px] font-mono bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 border border-gray-200 inline-block shadow-sm">
                                                    🌐 IP: {{ $log->properties['ip'] ?? 'Desconhecido' }}
                                                </div>

                                                @if(isset($log->properties['user_agent']))
                                                    <!-- Removido o 'truncate' e adicionado 'break-words' para exibir 100% do texto quebrando em linhas -->
                                                    <div class="text-[10px] text-gray-500 break-words leading-relaxed bg-gray-50 p-2 rounded border border-gray-100">
                                                        💻 SO/Nav: {{ $log->properties['user_agent'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- TIPO DE EVENTO (Retirado o whitespace-nowrap) -->
                                        <td class="px-6 py-4">
                                            @if($log->event === 'falha_login')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Falha de Login</span>
                                            @elseif($log->event === 'deleted')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-500">Exclusão</span>
                                            @elseif($log->event === 'updated')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Edição</span>
                                            @elseif($log->event === 'created')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Criação</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($log->event) }}</span>
                                            @endif

                                            @if($log->subject_type)
                                                <div class="mt-3 text-xs text-gray-600 break-words">
                                                    Tabela: <strong>{{ class_basename($log->subject_type) }}</strong> <br>
                                                    ID: <strong>#{{ $log->subject_id }}</strong>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- DESCRIÇÃO (Retirado o whitespace-nowrap) -->
                                        <td class="px-6 py-4 text-gray-700 break-words text-center">
                                            {{ $log->description }}
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
