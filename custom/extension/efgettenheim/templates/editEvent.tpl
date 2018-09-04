<div class="container mt-20{marginBottom}">
  <div class="row">
    <div class="col-md-6">
      <img src="{img}" alt="" class="img-responsive">
    </div>
    <div class="col-md-6">
      <h3>TEST</h3>

      <form method="post">

        <input type="hidden" name="eventID" value="{eventID}" />
        <input type="hidden" name="exec" value="saveEvent" />

        {formFieldServiceModerator}
        {formFieldServicePreacher}
        {formFieldServiceWorshipMusicians}

        <input type="submit" value="test" />

      </form>
    </div>
  </div>
</div>