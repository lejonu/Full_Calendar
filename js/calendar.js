document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
    header: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    locale: 'pt-br',
    // defaultDate: '2019-08-12',
    navLinks: true, // can click day/week names to navigate views
    selectable: true,
    selectMirror: true,
    select: function(arg) {
    var title = prompt('Event Title:')
    if (title) {
        calendar.addEvent({
        title: title,
        start: arg.start,
        end: arg.end,
        allDay: arg.allDay
        })
    }
    calendar.unselect()
    },
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    events: 'events_list.php',
    extraParams: ()=>
    {
    return 
    {
        cachebuster: new Date().valueOf()
    }
    },
    eventClick: ( info )=>
    {
    info.jsEvent.preventDefault()

    $('#visualizar #id').text(info.event.id)
    $('#visualizar #title').text(info.event.title)
    $('#visualizar #color').text(info.event.color)
    $('#visualizar #start').text(info.event.start.toLocaleString())
    $('#visualizar #end').text(info.event.start.toLocaleString())


    $('#visualizar').modal('show')
    }
    })

calendar.render()
})

