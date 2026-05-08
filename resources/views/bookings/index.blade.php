@extends('layouts.app')

@section('content')
    <h1>Lista de Reservas</h1>

    <!-- Exibe aquela mensagem verde de sucesso que fizemos no método Store -->
    @if (session('success'))
        <div style="color: green; margin-bottom: 20px;">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <a href="{{ route('bookings.create') }}">Solicitar Nova Reserva</a>

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px; width: 100%;">
        <thead>
        <tr>
            <!-- Só mostra a coluna "Solicitante" se for Admin -->
    {{--        @if(Auth::user()->role === 'admin')--}}
    {{--            <th>Solicitante</th>--}}
    {{--        @endif--}}
            <th>Espaço</th>
            <th>Início</th>
            <th>Término</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($bookings as $booking)
            <tr>
                <!-- Só preenche a coluna "Solicitante" se for Admin -->
    {{--            @if(Auth::user()->role === 'admin')--}}
    {{--                <td>{{ $booking->user->name }}</td>--}}
    {{--            @endif--}}

                <td>{{ $booking->space->name }} ({{ $booking->space->type }})</td>

                <!-- Formatando a data e hora para o padrão brasileiro -->
                <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('d/m/Y H:i') }}</td>

                <td>
                    <!-- Traduzindo o status visualmente -->
                    @if($booking->status == 'pending')
                        <span style="color: orange;">Pendente</span>
                    @elseif($booking->status == 'confirmed')
                        <span style="color: green;">Confirmada</span>
                    @else
                        <span style="color: red;">Cancelada</span>
                    @endif
                </td>

                <td>
                    <!-- Os botões de ação virão aqui depois! -->
                    <em>Em construção</em>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center;">Nenhuma reserva encontrada.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
