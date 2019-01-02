jQuery(document).ready(function() {

  var calendarEventsJSON = $('#calendarEvents').html();
  var calendarEvents = jQuery.parseJSON(calendarEventsJSON);
  var calendarEventsEditPage = jQuery('#calendarEventsEditPage').html();

  // SONGS

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
      var existingElements = jQuery('#songSortable div[data-id="'+data.id+'"]').length;
      if(existingElements > 0) {
        alert('Info: Dieses Lied existiert bereits. Ein Lied kann natürlich mehrmals gesungen werden, dieser Hinweis nur, falls ein Versehen vorliegt.');
      }
      jQuery('#songSortable').append('<div data-id="'+data.id+'" onclick="jQuery(this).remove();">'+data.text+'</div>');
    }
  });


  jQuery("#songSortable").sortable();

  // SELECT2 FOR WORKSHOP MUSICIANS
  jQuery('#serviceWorshipMusicians').select2({});


  // AGENDA

  jQuery('#agendaBlocks div').click(function() {
    var songID = jQuery(this).attr('data-song-id');
    var responsibleStaff = jQuery(this).attr('data-responsible');
    var remarks = jQuery(this).attr('data-remarks');
    jQuery('#agendaSortable').append(
      '<div style="cursor:pointer;" class="alert alert-success" data-id="new" data-remarks="'+remarks+'" data-responsible="'+responsibleStaff+'" data-song-id="'+songID+'">'+
      '<span>'+jQuery(this).html()+'</span>'+
      '<a onclick="jQuery(this).parent().remove();"><i class="fa fa-trash-o" style="float:right;"></i></a>'+
      '<a onclick="jQuery(this).parent().editAgenda();"><i class="fa fa-pencil-square" style="float:right;margin-right:10px;"></i></a>'+
      '</div>'
    );
  });

  jQuery('#serviceAgendaAdd').click(function() {
    var serviceAgendaTitle = jQuery('#serviceAgendaTitle').val();
    var responsibleStaff = jQuery('#serviceAgendaResponsible').val();
    var remarks = jQuery('#serviceAgendaRemarks').val();
    jQuery('#agendaSortable').append(
      '<div style="cursor:pointer;" class="alert alert-success" data-id="new" data-remarks="'+remarks+'" data-responsible="'+responsibleStaff+'" onclick="jQuery(this).remove();">'+
      '<span>'+serviceAgendaTitle+'</span>'+
      '<a onclick="jQuery(this).parent().remove();"><i class="fa fa-trash-o" style="float:right;"></i></a>'+
      '<a onclick="jQuery(this).parent().editAgenda();"><i class="fa fa-pencil-square" style="float:right;margin-right:10px;"></i></a>'+
      '</div>'
    );
    jQuery('#serviceAgendaEdit').hide();
  });

  jQuery("#agendaSortable").sortable({
    cursor: 'move',
    tolerance: 'pointer',
    helper: function(event, ui){
      var $clone =  $(ui).clone();
      $clone .css('position','absolute');
      return $clone.get(0);
    }
  });

  // SAVE EVENT
  jQuery('#editEvent').submit(
    function() {

      var songIDs = [];
      jQuery('#songSortable div').each(function() {
        songIDs.push(jQuery(this).data('id'));
      });
      jQuery('#songIDs').val(songIDs.join('|'));

      var agendaPositions = {};
      var agendaCounter = 0;

      jQuery('#agendaSortable div').each(function() {
        var agendaID = jQuery(this).data('id');
        var songID = jQuery(this).data('song-id');
        var staffResponsible = jQuery(this).data('responsible');
        var remarks = jQuery(this).data('remarks');
        var agendaText = jQuery(this).find('span').html();
        agendaPositions[agendaCounter++] = {
          'agendaID': agendaID,
          'agendaTitle': agendaText,
          'songID': songID,
          'agendaRemarks': remarks,
          'agendaResponsible': staffResponsible

        };
      });

      var agendaPositionsJson = JSON.stringify(agendaPositions);
      jQuery('#agenda').val(agendaPositionsJson);

    }
  );

  // CALENDAR

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
      window.open(calendarEventsEditPage + '?eventTimestamp='+timestamp+(calEvent.className != '' ? '&mode='+calEvent.className : ''),'_blank');

    }
  });

  // Agenda bearbeiten

  jQuery('#serviceAgendaEdit').hide();


  jQuery.fn.extend({
    editAgenda: function () {
      var agendaElement = jQuery(this);
      var agendaID = agendaElement.data('id');
      var agendaResponsible = agendaElement.data('responsible');
      var agendaRemarks = agendaElement.data('remarks');
      var agendaTitle = agendaElement.find('span').html();

      jQuery('#serviceAgendaTitle').val(agendaTitle);
      jQuery('#serviceAgendaResponsible').val(agendaResponsible);
      jQuery('#serviceAgendaRemarks').val(agendaRemarks);
      jQuery('#serviceAgendaEditID').val(agendaID);
      jQuery('#serviceAgendaEdit').show();
    },
    saveAgenda: function () {
      var agendaID = jQuery('#serviceAgendaEditID').val();
      var agendaTitle = jQuery('#serviceAgendaTitle').val();
      var agendaResponsible= jQuery('#serviceAgendaResponsible').val();
      var agendaRemarks = jQuery('#serviceAgendaRemarks').val();

      var agendaElement = jQuery('div[data-id="'+agendaID+'"]');
      agendaElement.data('responsible', agendaResponsible);
      agendaElement.data('remarks', agendaRemarks);
      agendaElement.find('span').html(agendaTitle);

      jQuery('#serviceAgendaEditID').val('');
      jQuery('#serviceAgendaEdit').hide();
    }
  });

});