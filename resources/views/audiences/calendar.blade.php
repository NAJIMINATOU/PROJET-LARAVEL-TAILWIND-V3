@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Titre et boutons export -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🗓️ Calendrier des Audiences</h1>
        <div class="flex gap-2">
            <a href="{{ route('audiences.export.pdf') }}"
               class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
               📄 Export PDF
            </a>

            <a href="{{ route('audiences.export.excel') }}"
               class="bg-green-600 hover:bg-green-700  text-black font-semibold py-2 px-4 rounded-lg shadow transition">
               📊 Export Excel
            </a>

            <a href="{{ route('audiences.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
               ← Retour à la liste
            </a>
        </div>
    </div>

    <!-- Calendrier -->
    <div id="calendar" class="bg-white p-4 rounded-lg shadow"></div>
</div>

<!-- FullCalendar CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        themeSystem: 'standard',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: @json($events),   // événements venant du contrôleur
        eventColor: '#4f46e5',    // violet indigo
        eventTextColor: '#fff',
        navLinks: true,
        editable: false,
        dayMaxEvents: true
    });

    calendar.render();
});
</script>
@endsection
