document.addEventListener('DOMContentLoaded', ()=> 
{
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'pt-br',
    plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    // defaultDate: new Date(),
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    events: 'events_list.php',
    extraParams: ()=>
    {
      return {
        cachebuster: new Date().valueOf()
      }
    },
    eventClick: ( info )=>
    {
      info.jsEvent.preventDefault();

      $('#visualizar #id').text(info.event.id);
      $('#visualizar #title').text(info.event.title);
      $('#visualizar #title').text(info.event.title);
      $('#visualizar #color').text(info.event.color);
      $('#visualizar #start').text(info.event.start.toLocaleString());
      $('#visualizar #end').text(info.event.end.toLocaleString());

      // send data to form editor
      $('#visualizar #id').val(info.event.id);
      $('#visualizar #title').val(info.event.title);
      $('#visualizar #title').val(info.event.title);
      $('#visualizar #color').val(info.event.backgroundColor);
      $('#visualizar #start').val(info.event.start.toLocaleString());
      $('#visualizar #end').val(info.event.end.toLocaleString());
      $('#visualizar').modal('show')
    },
    selectable: true,
    // selectMirror: true,
    select: ( info )=> 
    {
      $('#cadastrar #start').val(info.start.toLocaleString())
      $('#cadastrar #end').val(info.end.toLocaleString())
      $('#cadastrar').modal('show')
      calendar.unselect()
    }
  });
  calendar.render();
});

$(document).ready(function()
{
  $("#addevent").on("submit", function( event )
  {
    event.preventDefault()

    $.ajax({
      method: "POST",
      url: "event_cad.php",
      data: new FormData( this ),
      contentType: false,
      processData: false,
      success: function( retorna )     
      {
        if( retorna['sit'] )
        {
            location.reload()
        }
        else
        {
          $('#msg-cad').html(retorna['msg']);
        }
      }
    })
  })

  $(".btn-cancel-view, .cancel-edit").on("click", function()
  {
    $(".view-event").slideToggle();
    $(".form-edit").slideToggle();
  })

  $("#editevent").on("submit", function( event )
  {
    event.preventDefault()

    $.ajax({
      method: "POST",
      url: "event_edit.php",
      data: new FormData( this ),
      contentType: false,
      processData: false,
      success: function( retorna )     
      {
        if( retorna['sit'] )
        {
            location.reload()
        }
        else
        {
          $('#msg-cad-edit').html(retorna['msg']);
        }
      }
    })
  })

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