<div class="container mt-20 mb-20">
  <div class="row">
    <div class="col-md-12">
      <h3>Gottesdienst am {echo strftime('%d.%m.%Y', $eventTimestamp);}</h3>

      <form method="post" id="editEvent">

        <input type="hidden" name="eventID" value="{eventID}" />
        <input type="hidden" name="editMode" value="{$editMode}" />
        <input type="hidden" name="exec" value="saveEvent" />
        <input type="hidden" name="sendInfo" id="sendInfo" value="0" />
        <input type="hidden" name="songIDs" id="songIDs" value="" />

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
          <label>Sonntagsschule klein</label><br />
          {$formFieldServiceSundaySchoolTeacherSmall}
        </div>
        {endif;}

        {if(!empty($formFieldServiceSundaySchoolTeacherBig)):}
        <div class="form-group">
          <label>Sonntagsschule groß</label><br />
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
          <input type="button" value="Auswählen" id="serviceSongAdd" class="btn btn-default" />
        </div>

        <div class="form-group">
          <div id="sortable">
            {foreach($songs as $song):}
            <div data-id="{$song->getContentID()}" onclick="jQuery(this).remove();">{$song->songTitle}</div>
            {endforeach;}
          </div>
        </div>

        {endif;}

        <input type="submit" value="Speichern" class="btn btn-default" />

        {if($editMode === 'sermonTopic'):}
          <input type="button" value="Speichern und Musikteamleiter informieren" class="btn btn-default" onclick="jQuery('#sendInfo').val(1);jQuery('#editEvent').submit();" />
        {endif;}

        <a href="{calendarPage}" class="btn btn-default">Zum Kalender</a>

      </form>
    </div>
  </div>
</div>