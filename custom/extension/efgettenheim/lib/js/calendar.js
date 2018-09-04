jQuery(document).ready(function() {

  var calendarEventsJSON = $('#calendarEvents').html();
  console.log(calendarEventsJSON);
  var calendarEvents = jQuery.parseJSON(calendarEventsJSON);

  jQuery('#serviceModerator').select2();
  jQuery('#servicePreacher').select2();
  jQuery('#serviceWorshipMusicians').select2();

  jQuery('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,basicWeek,basicDay'
    },
    defaultDate: '2018-08-21', //yyyy - mm - dd
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    events: calendarEvents,
    eventClick: function(calEvent, jsEvent, view) {

      var timestamp = calEvent.start.unix();
      window.open('Event.html?eventTimestamp='+timestamp,'_blank');

    }
  });

});
