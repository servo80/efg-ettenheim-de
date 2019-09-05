<div class="container mt-20 mb-20">
  <div class="row">
    <div class="col-md-12">
      <h2>Gottesdienst am {echo strftime('%d.%m.%Y', $eventTimestamp);}</h2>

      {if(!empty($successMessage)):}
      <div class="alert alert-success">{$successMessage}</div>
      {endif;}

      <form method="post" id="editEvent">

        <input type="hidden" name="eventID" value="{eventID}" />
        <input type="hidden" name="editMode" value="{$editMode}" />
        <input type="hidden" name="exec" value="saveEvent" />
        <input type="hidden" name="sendInfo" id="sendInfo" value="0" />
        <input type="hidden" name="createPdf" id="createPdf" value="0 " />
        <input type="hidden" name="songIDs" id="songIDs" value="" />
        <input type="hidden" name="agenda" id="agenda" value="" />

        {if(!empty($formFieldServiceModerator)):}
        <div class="form-group">
          <label>Moderator</label><br />
          {$formFieldServiceModerator}
        </div>
        {endif;}

        {if(!empty($formFieldServicePreacher)):}
        <div class="form-group">
          <label>Prediger</label><br />
          {$formFieldServicePreacher}
        </div>
        {endif;}

        {if(!empty($formFieldServiceWorshipLeader)):}
        <div class="form-group">
          <label>Lobpreisleiter</label><br />
          {$formFieldServiceWorshipLeader}
        </div>
        {endif;}

        {if(!empty($formFieldServiceSundaySchoolTeacherSmall)):}
        <div class="form-group">
          <label>Kindertreff klein</label><br />
          {$formFieldServiceSundaySchoolTeacherSmall}
        </div>
        {endif;}

        {if(!empty($formFieldServiceSundaySchoolTeacherBig)):}
        <div class="form-group">
          <label>Kindertreff groß</label><br />
          {$formFieldServiceSundaySchoolTeacherBig}
        </div>
        {endif;}

        {if(!empty($formFieldServiceAudioEngineer)):}
        <div class="form-group">
          <label>Technik</label><br />
          {$formFieldServiceAudioEngineer}
        </div>
        {endif;}

        {if(!empty($formFieldServiceReceptionist)):}
        <div class="form-group">
          <label>Begrüßung</label><br />
          {$formFieldServiceReceptionist}
        </div>
        {endif;}

        {if(!empty($formFieldServiceWorshipMusicians)):}
        <div class="form-group">
          <label>Musikteam</label><br />
          {$formFieldServiceWorshipMusicians}
        </div>
        {endif;}

        {if(!empty($formFieldServiceSermonTopic)):}
        <div class="form-group">
          <label>Predigtthema</label><br />
          {$formFieldServiceSermonTopic}
        </div>
        {endif;}

        {if($editMode == 'songs'):}
        <div class="form-group">
          <label>Lieder</label><br />
          <input type="text" value="" id="serviceSongs" />
          <input type="button" value="Auswählen" id="serviceSongAdd" class="btn btn-primary" />
        </div>

        <div class="form-group">
          <div id="songSortable">
            {foreach($songs as $song):}
            <div data-id="{$song->getContentID()}" onclick="jQuery(this).remove();">{$song->songTitle}</div>
            {endforeach;}
          </div>
        </div>
        {endif;}

        {if($editMode == 'agenda'):}

        <div class="row">
          <div class="col-md-6">
            <h3>Ablauf</h3>
            <div class="form-group">
              <div id="agendaSortable">
                {foreach($agenda as $agenda):}
                <div style="cursor:pointer;" class="alert alert-success" data-song-id="{$agenda->agendaSong}" data-responsible="{$agenda->agendaResponsible}" data-remarks="{$agenda->agendaRemarks}" data-id="{$agenda->getContentID()}">
                  <span>{$agenda->agendaTitle}</span>
                  <a onclick="jQuery(this).parent().remove();"><i class="fa fa-trash-o" style="float:right;"></i></a>
                  <a onclick="jQuery(this).parent().editAgenda();"><i class="fa fa-pencil-square" style="float:right;margin-right:10px;"></i></a>
                </div>
                {endforeach;}
              </div>
            </div>

            <input type="button" value="PDF ansehen" class="btn btn-primary" onclick="jQuery('#createPdf').val(1);jQuery('#editEvent').attr('target', '_blank');jQuery('#editEvent').submit();" />

          </div>

          <div class="col-md-6">
            <h3>Neuen Programmpunkt einfügen</h3>
            <div class="form-group">
              <label>Bezeichnung</label><br />
              <input type="text" id="serviceAgendaTitle" style="width:500px;" />
            </div>
            <div class="form-group">
              <label>Verantwortlich</label><br />
              <input type="text" id="serviceAgendaResponsible" style="width:500px;" />
            </div>
            <div class="form-group">
              <label>Anmerkungen</label><br />
              <textarea id="serviceAgendaRemarks" style="width:500px;"></textarea>
              <br />
              <input type="hidden" value="" id="serviceAgendaEditID" />
              <input type="button" value="Ändern" id="serviceAgendaEdit" class="btn btn-primary" onclick="jQuery(this).saveAgenda();" />
              <input type="button" value="Einfügen" id="serviceAgendaAdd" class="btn btn-primary" />
            </div>

            <h3>Vordefinierte Programmpunkte</h3>
            <div class="form-group" id="agendaBlocks">
              <div style="cursor:pointer;" class="alert alert-info" data-responsible="{$preacherName}">Predigt von {$preacherName}: {$sermonTopic}</div>
              {foreach($songs as $song):}
              <div style="cursor:pointer;" class="alert alert-info" data-responsible="Musikteam" data-song-id="{$song->getContentID()}">Lied: {$song->songTitle}</div>
              {endforeach;}
              <div style="cursor:pointer;" class="alert alert-info" data-responsible="{$preacherName}">Gebetsgemeinschaft</div>
              <div style="cursor:pointer;" class="alert alert-info" data-responsible="{$moderatorName}">Begrüßung</div>
              <div style="cursor:pointer;" class="alert alert-info" data-responsible="{$preacherName}">Segen</div>
              <div style="cursor:pointer;" class="alert alert-info" data-responsible="{$moderatorName}">Infoteil</div>
              <div style="cursor:pointer;" class="alert alert-info" data-responsible="{$moderatorName}">Kollekte</div>
            </div>
          </div>
        </div>

        {endif;}

        {if($eventTimestamp < time()):}

        <div class="alert alert-danger">Die Veranstaltung liegt in der Vergangenheit und kann nicht mehr bearbeitet werden.</div>

        {else:}

        <input type="button" value="Speichern" class="btn btn-primary" onclick="jQuery('#sendInfo').val(0);jQuery('#editEvent').attr('target', '_self');jQuery('#editEvent').submit();" />

        {if($editMode === 'songs'):}
        <input type="button" value="Speichern und Moderator informieren" class="btn btn-primary" onclick="jQuery('#sendInfo').val(1);jQuery('#editEvent').attr('target', '_self');jQuery('#editEvent').submit();" />
        {endif;}

        {if($editMode === 'sermonTopic'):}
          <input type="button" value="Speichern und Musikteamleiter informieren" class="btn btn-primary" onclick="jQuery('#sendInfo').val(1);jQuery('#editEvent').attr('target', '_self');jQuery('#editEvent').submit();" />
        {endif;}

        {endif;}

        <a href="{calendarPage}" class="btn btn-primary">Zum Kalender</a>

      </form>
    </div>
  </div>
</div>