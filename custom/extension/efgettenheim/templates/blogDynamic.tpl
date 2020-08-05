<div class="container mt-20">
  <div class="row">

    {if(empty($blogID)):}

    <div class="col-md-8">

      <ul class="blog-list">

        {foreach($blog as $blogEntry):}

        <li>
          <div class="info">
            <div class="date-box">
              <span class="day">{echo strftime('%d', $blogEntry->eventDate)}</span>
              <span class="month">{echo strftime('%b', $blogEntry->eventDate)}</span>
            </div>
          </div>
          <div class="preview">
            <img src="{$blogEntry->eventImage}" alt="" />
            <a href="{pageBlog}?blogID={$blogEntry->getContentID()}">
              <h3 class="blog-title">{$blogEntry->eventHeadline}</h3>
            </a>
            {echo substr($blogEntry->eventText, 0, 100)}...<br />
            <a href="{pageBlog}?blogID={$blogEntry->getContentID()}">&raquo; lesen</a>
          </div>
          <div class="meta-info">Von: <a href="mailto:pastor@efg-ettenheim.de">Patric Gleichauf</a></div>
        </li>

        {endforeach;}

      </ul>

      <div class="clearfix"></div>

      <!--
      <div class="text-center ">
        <ul class="pagination">
          <li><a href="#">Prev</a></li>
          <li class="active"><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">Next</a></li>
        </ul>
      </div>
      -->
    </div>

    <div id="sidebar" class="col-md-4">

      <div class="widget latest_news">
        <h3>Archiv</h3>
        <ul class="bloglist-small">


          {foreach($blog as $blogEntry):}

          <li>
          <div class="date-box">
            <span class="day">{echo strftime('%d', $blogEntry->eventDate)}</span>
            <span class="month">{echo strftime('%b', $blogEntry->eventDate)}</span>
          </div>
          <div class="txt">
            <h5><a href="{pageBlog}?blogID={$blogEntry->getContentID()}">{$blogEntry->eventHeadline}</a></h5>
            <div>
              <div>{echo substr($blogEntry->eventText, 0, 30)}...</div>
            </div>
          </div>
          </li>

          {endforeach;}

        </ul>
      </div>

    </div>

    {else:}

    <div class="col-md-8">

      <div class="blog-read">
        <div>
          <div class="info">
            <div class="date-box">
              <span class="day">{echo strftime('%d', $blogDetail->eventDate)}</span>
              <span class="month">{echo strftime('%b', $blogDetail->eventDate)}</span>
            </div>
          </div>
          <div class="preview">
            <img src="{$blogDetail->eventImage}" alt="{$blogDetail->eventHeadline}" class="img-responsive">
            <a href="#">
              <h3 class="blog-title">{$blogDetail->eventHeadline}</h3>
            </a>
            <p>
              {$blogDetail->eventText}
            </p>
            
            <a href="{pageBlog}">&laquo; zurück</a>
          </div>
          <div class="meta-info">Von: <a href="mailto:pastor@efg-ettenheim.de">Patric Gleichauf</a></div>


        </div>

      </div>

    </div>

    <div id="sidebar" class="col-md-4">

      <div class="widget latest_news">
        <h3>Archiv</h3>
        <ul class="bloglist-small">


          {foreach($blog as $blogEntry):}

          <li>
            <div class="date-box">
              <span class="day">{echo strftime('%d', $blogEntry->eventDate)}</span>
              <span class="month">{echo strftime('%b', $blogEntry->eventDate)}</span>
            </div>
            <div class="txt">
              <h5><a href="{pageBlog}?blogID={$blogEntry->getContentID()}">{$blogEntry->eventHeadline}</a></h5>
              <div>
                <div>{echo substr($blogEntry->eventText, 0, 30)}...</div>
              </div>
            </div>
          </li>

          {endforeach;}

        </ul>
      </div>

    </div>

    {endif;}

  </div>

</div>