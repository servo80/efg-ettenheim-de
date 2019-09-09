<div class="container mt-20">
  <div class="row">

    <ol class="menu">
      <li{if($overviewActive):} class="active"{endif;}><a href="{linkOverview}">Übersicht</a></li>
      <li{if($calendarActive):} class="active"{endif;}><a href="{linkCalendar}">Kalender</a></li>
      <li{if($songsActive):} class="active"{endif;}><a href="{linkSongs}">Lieder</a></li>
      <li><a href="{linkCalendar}?exec=logout">Abmelden</a></li>
    </ol>

  </div>
</div>