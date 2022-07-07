$(document).ready(function () {
  $('#calendar').fullCalendar({
    defaultDate: '2021-11-12',
    editable: true,
    selectHelper: true,
    selectable: true,
    eventLimit: true, // allow "more" link when too many events
    header: {
      left: 'prev, next today',
      center: 'title',
      right: 'month, agendaWeek, agendaDay'
    },
    events: '/app/proses.php?request=get-calendar-project'
  });
});