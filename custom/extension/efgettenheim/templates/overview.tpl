<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <table style="width:100%" class="songs">

          <tr>
            <th class="left">Datum</th>
            <th>Besonderheiten</th>
            <th>Prediger</th>
            <th>Moderator</th>
            <th>Lobpreisleiter</th>
            <th>Technik</th>
            <th>Kindertreff klein</th>
            <th>Kindertreff groß</th>
            <th>Begrüßung</th>
            <th class="right">PDF</th>
          </tr>

          {foreach($events as  $event):}

          <tr>
            <td><a href="{calendarEventsEditPage}?eventTimestamp={$event->serviceDate}">{echo utf8_encode(strftime('%A, den %d. %B %Y', $event->serviceDate))}</a></td>
            <td>{echo nl2br($event->serviceAdditionalInfo)}</td>
            <td>{echo $event->servicePreacher}</td>
            <td>{echo $event->serviceModerator}</td>
            <td>{echo $event->serviceWorshipLeader}</td>
            <td>{echo $event->serviceAudioEngineer}</td>
            <td>{echo $event->serviceSundaySchoolTeacherSmall}</td>
            <td>{echo $event->serviceSundaySchoolTeacherBig}</td>
            <td>{echo $event->serviceReceptionist}</td>
            {if($event->serviceDate < time()):}
            <td><a href="{calendarEventsEditPage}?eventTimestamp={$event->serviceDate}&createPdf=1" target="_blank"><img src="skins/responsive/icons/filetypes/pdf.gif" /></a></td>
            {else:}
            <td></td>
            {endif;}
          </tr>

          {endforeach;}

        </table>

      </div>
    </div>
  </div>
</section>