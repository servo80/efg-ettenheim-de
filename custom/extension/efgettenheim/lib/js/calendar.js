jQuery(document).ready(function() {

  var calendarEventsJSON = $('#calendarEvents').html();
  var calendarEvents = jQuery.parseJSON(calendarEventsJSON);
  var calendarEventsEditPage = jQuery('#calendarEventsEditPage').html();

  jQuery('#serviceSongs').select2({
    placeholder: "Liedtitel eingeben...",
    minimumInputLength: 1,
    width: '600px',
    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
      url: 'http://localhost/efg-ettenheim-de-4/de/de/event.html?searchSong=1',
      dataType: 'json',
      quietMillis: 250,
      data: function (term, page) {
        return {
          q: term, // search term
        };
      },
      results: function (data, page) { // parse the results into the format expected by Select2.
        // since we are using custom formatting functions we do not need to alter the remote JSON data
        return { results: data.results };
      }
    },
    escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
  });

  jQuery('#serviceSongAdd').click(function() {

    var data = $('#serviceSongs').select2('data');
    if(data) {
      var existingElements = jQuery('#sortable div[data-id="'+data.id+'"]').length;
      if(existingElements > 0) {
        alert('Info: Dieses Lied existiert bereits. Ein Lied kann natürlich mehrmals gesungen werden, dieser Hinweis nur, falls ein Versehen vorliegt.');
      }
      jQuery('#sortable').append('<div data-id="'+data.id+'" onclick="jQuery(this).remove();">'+data.text+'</div>');
    }
  });

  jQuery('#editEvent').submit(
    function() {
      var songIDs = [];
      jQuery('#sortable div').each(function() {
        songIDs.push(jQuery(this).data('id'));
      });
      jQuery('#songIDs').val(songIDs.join('|'));
    }
  );

  jQuery("#sortable").sortable();


  jQuery('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,basicWeek,basicDay'
    },
    locale: 'de',
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    events: calendarEvents,
    eventClick: function(calEvent, jsEvent, view) {

      var timestamp = calEvent.start.unix();
      window.open(calendarEventsEditPage + '?eventTimestamp='+timestamp,'_blank');

    }
  });

});
