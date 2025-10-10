document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        events: '/redoma/actions/buscarEventos.php',

        aspectRatio: 2,

        allDayText: 'Dia todo',

        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },

        buttonText: {
            today: 'Hoje',
            month: 'Mês',
            week: 'Semana',
            list: 'Lista'
        },

        eventDataTransform: function (eventInfo) {
            const temHorarioValido = eventInfo.horario && eventInfo.horario.includes(':');
            return {
                title: eventInfo.nome_recurso,
                start: temHorarioValido ? eventInfo.data_evento + 'T' + eventInfo.horario : eventInfo.data_evento,
                extendedProps: {
                    recurso: eventInfo.nome_recurso,
                    observacoes: eventInfo.observacoes
                }
            };
        },

        // --- FUNÇÃO AJUSTADA PARA INCLUIR A LÓGICA DA LISTA ---
        eventContent: function (arg) {
            let title = arg.event.title;
            let time = arg.timeText;
            let observacoes = arg.event.extendedProps.observacoes;

            // Lógica para a visão de LISTA
            if (arg.view.type.startsWith('list')) {
                return {
                    html: `
                        <div class="fc-list-event-custom-content">
                            <div class="fc-list-event-custom-title">${title}</div>
                            <div class="fc-list-event-custom-details">
                                <small>${observacoes || 'Sem observações.'}</small>
                            </div>
                        </div>
                    `
                };
            }

            // Lógica para as outras visões (Mês, Semana)
            if (time) {
                return {
                    html: `<div>${title} - <strong>${time}h</strong></div>`
                };
            } else {
                return {
                    html: `<div>${title}</div>`
                };
            }
        },

        eventClick: function (info) {
            let recurso = info.event.extendedProps.recurso;
            let observacoes = info.event.extendedProps.observacoes;
            let detalhes = `Recurso: ${recurso}\nObservações: ${observacoes}`;
            alert(detalhes);
            info.jsEvent.preventDefault();
        },

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
    });

    calendar.render();
});