<div class="container mt-20 mb-20">
  <div class="row">
    <div class="col-md-6">
      <div id="contact-form-wrapper">
        <div class="contact_form_holder">
          <form id="contact" class="row" name="form1" method="post">

            <input type="hidden" name="exec" value="sendContact" />
            <input type="hidden" name="sent" value="1" />

            {if($error && empty($fullname)):}
            <div id="error_name" class="error" style="display:block;">Bitte geben Sie Ihren Namen ein.</div>
            {endif;}
            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Ihr Name" value="{$fullname}" />

            {if($error && empty($email)):}
            <div id="error_email" class="error" style="display:block;">Bitte geben Sie Ihre E-Mail-Adresse ein.</div>
            {endif;}
            <input type="text" class="form-control" name="email" id="email" placeholder="Ihre E-Mail-Adresse" value="{$email}" />

            {if($error && empty($message)):}
            <div id="error_message" class="error" style="display:block;">Bitte geben Sie Ihre Nachricht ein.</div>
            {endif;}

            <textarea cols="10" rows="10" name="message" id="message" class="form-control" placeholder="Ihre Nachricht">{$message}</textarea>

            {if($error && !$captchaSuccess):}
            <div id="error_captcha" class="error" style="display:block;">Bitte bestätigen Sie, dass Sie kein Roboter sind.</div>
            {endif;}

            <div class="g-recaptcha" data-sitekey="6LeTtDUUAAAAABSHlDG5je9QKOUW1TO-fq8ToYWq"></div>

            {if($sent):}
            <div id="mail_success" class="success" style="display:block;">Vielen Dank für Ihre Nachricht.</div>
            {endif;}

            {if($notsent):}
            <div id="mail_failed" class="error" style="display:block;">Ihre Nachricht konnte leider nicht übermittelt werden.</div>
            {endif;}

            <p id="btnsubmit">
              <input type="submit" id="send" value="Abschicken" class="btn btn-custom" />
            </p>


          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6 text-center">
      <div class="contact-info">

        <div class="social-icons">
          <a href="https://www.facebook.com/efgettenheim"><i class="fa fa-facebook"></i></a>
        </div>

        <div class="divider-line"></div>

        <span class="title">Gottesdienst:</span>
        Sonntags um 10 Uhr<br>
        Kinderbetreuung von 3-14 Jahren

        <div class="divider-line"></div>

        <span class="title">Adresse:</span>
        Stückle-Straße 2, 77955 Ettenheim

      </div>


    </div>
  </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
