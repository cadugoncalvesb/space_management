<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agenda de Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Div onde o calendário será injetado -->
                    <div id="calendar"></div>

                </div>
            </div>
        </div>
    </div>

    <!-- Scripts do FullCalendar via CDN -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.11/locales/pt-br.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'pt-br', // Idioma PT-BR
                initialView: 'timeGridWeek', // Começa na visão de Semana
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay' // Botões de Filtro
                },
                events: @json($eventos), // Injeta a variável PHP criada na rota direto no JavaScript

                // Configurações extras de visualização (Opcional)
                slotMinTime: '06:00:00', // O calendário começa a mostrar a partir das 06h
                slotMaxTime: '23:59:00', // Vai até a meia-noite
                allDaySlot: false, // Esconde a barra de "Dia Inteiro" para focar nos horários
            });

            calendar.render();
        });
    </script>

    <!-- Ajustes CSS para mesclar o FullCalendar com o design do Tailwind -->
    <style>
        #calendar {
            max-height: 700px; /* Evita que o calendário fique gigante na tela */
        }

        /* Ajusta as cores dos botões do calendário para combinar com o tema do Breeze */
        .fc .fc-button-primary {
            background-color: #1f2937 !important;
            border-color: #1f2937 !important;
            text-transform: capitalize;
        }
        .fc .fc-button-primary:hover {
            background-color: #374151 !important;
        }
        .fc .fc-button-primary:not(:disabled).fc-button-active,
        .fc .fc-button-primary:not(:disabled):active {
            background-color: #111827 !important;
        }
    </style>
</x-app-layout>
