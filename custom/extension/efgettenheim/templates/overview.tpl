<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <table style="width:100%" class="songs">

          <tr>
            <th class="left">Datum</th>
            <th>Prediger</th>
            <th>Moderator</th>
            <th>Lobpreisleiter</th>
            <th>Technik</th>
            <th>Kindertreff groß</th>
            <th>Kindertreff klein</th>
            <th class="right">Begrüßung</th>
          </tr>

          {foreach($events as  $event):}

          <tr>
            <td>{echo strftime('%A, den %d. %B %Y', $event->serviceDate)}</td>
            <td>{echo $event->servicePreacher}</td>
            <td>{echo $event->serviceModerator}</td>
            <td>{echo $event->serviceWorshipLeader}</td>
            <td>{echo $event->serviceAudioEngineer}</td>
            <td>{echo $event->serviceSundaySchoolTeacherSmall}</td>
            <td>{echo $event->serviceSundaySchoolTeacherBig}</td>
            <td>{echo $event->serviceReceptionist}</td>
          </tr>

          {endforeach;}

        </table>

      </div>
    </div>
  </div>
</section>