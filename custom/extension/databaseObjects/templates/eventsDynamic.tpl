<section id="page-events" class="no-padding">
  <div class="fullwidth">
    <div class="one-fourth text-center">
      <div class="title-area wow slideInLeft">
        <span>{h1}</span>
        <h1>{h2}</h1>
      </div>
    </div>

    <div class="three-fourth">
      <div class="fx custom-carousel-1">
        <div class="item">
          <div class="overlay">
            <span class="time">{echo strftime('%d.%m.%Y', $rows[0]->eventDate);}</span>
            {if($rows[0]->eventLink != ''):}
            <a href="{$rows[0]->eventLink}">
            {endif;}
              <h3>{$rows[0]->eventHeadline}</h3>
            {if($rows[0]->eventLink != ''):}
            </a>
            {endif;}
            <span class="desc">
              {$rows[0]->eventText}
              {if($rows[0]->eventLink != ''):}
              <a href="{$rows[0]->eventLink}">mehr Infos</a>
              {endif;}
            </span>
          </div>
          <img src="{$rows[0]->eventImage}" alt="">
        </div>

        <div class="item">
          <div class="overlay">
            <span class="time">{echo strftime('%d.%m.%Y', $rows[1]->eventDate);}</span>
            {if($rows[1]->eventLink != ''):}
            <a href="{$rows[1]->eventLink}">
              {endif;}
              <h3>{$rows[1]->eventHeadline}</h3>
            {if($rows[1]->eventLink != ''):}
            </a>
            {endif;}
            <span class="desc">
              {$rows[1]->eventText}
              {if($rows[1]->eventLink != ''):}
              <a href="{$rows[1]->eventLink}">mehr Infos</a>
              {endif;}
            </span>
          </div>
          <img src="{$rows[1]->eventImage}" alt="">
        </div>

        <div class="item">
          <div class="overlay">
            <span class="time">{echo strftime('%d.%m.%Y', $rows[2]->eventDate);}</span>
            {if($rows[2]->eventLink != ''):}
            <a href="{$rows[2]->eventLink}">
            {endif;}
              <h3>{$rows[2]->eventHeadline}</h3>
            {if($rows[1]->eventLink != ''):}
            </a>
            {endif;}
            <span class="desc">
              {$rows[2]->eventText}
              {if($rows[2]->eventLink != ''):}
              <a href="{$rows[2]->eventLink}">mehr Infos</a>
              {endif;}
            </span>
          </div>
          <img src="{$rows[2]->eventImage}" alt="">
        </div>

      </div>
    </div>
  </div>
  <div class="clearfix"></div>

</section>