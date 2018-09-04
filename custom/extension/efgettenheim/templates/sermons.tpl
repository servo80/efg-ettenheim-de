<div class="container mt-20">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">

      {foreach($serviceRows as $service):}
      <div class="custom-col-3">
        <div class="left-col">
          <img src="share/public/Sonstige/predigt.jpg" alt="" class="img-responsive">
        </div>
        <div class="mid-col">
          <a href="#">
            <h3>{$service->serviceSermonTopic}</h3>
          </a>
          <div class="details"><span>von {$service->servicePreacher} am {echo strftime('%d.%m.%Y', $service->serviceDate);}.</div>
        </div>
        <div class="right-col">
          <a href="download/public/{$service->serviceSermonRecording}"><i class="fa fa-volume-up"></i></a>
        </div>
      </div>
      {endforeach;}

    </div>
  </div>
</div>