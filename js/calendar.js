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
    select: ( info )=>
    {  
        $('#cadastrar #start').val(info.start.toLocaleString())
        $('#cadastrar #end').val(info.end.toLocaleString())

        $('#cadastrar').modal('show')
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

function DataHora(evento, objeto)
{
	var keypress=(window.event)?event.keyCode:evento.which;
	campo = eval (objeto);
	if (campo.value == '00/00/0000 00:00:00')
	{
		campo.value=""
	}

	caracteres = '0123456789';
	separacao1 = '/';
	separacao2 = ' ';
	separacao3 = ':';
	conjunto1 = 2;
	conjunto2 = 5;
	conjunto3 = 10;
	conjunto4 = 13;
	conjunto5 = 16;
	if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19))
	{
		if (campo.value.length == conjunto1 )
		campo.value = campo.value + separacao1;
		else if (campo.value.length == conjunto2)
		campo.value = campo.value + separacao1;
		else if (campo.value.length == conjunto3)
		campo.value = campo.value + separacao2;
		else if (campo.value.length == conjunto4)
		campo.value = campo.value + separacao3;
		else if (campo.value.length == conjunto5)
		campo.value = campo.value + separacao3;
	}
	else
		event.returnValue = false;
}