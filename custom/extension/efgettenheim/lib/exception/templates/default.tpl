<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de" class="login">
  <head>
    <title>Error</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="shortcut icon" type="image/x-icon" href="{app:path:skin}favicon.ico" />
    <link rel="stylesheet" type="text/css" href="{app:path:http}application/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="{app:path:http}{app:path:skin}skin.css" />
    <!--[if lte IE 10]>
      <link rel="stylesheet" type="text/css" href="{app:path:skin}ie-fix.css" />
    <![endif]-->
  </head>
  <body class="error404">

    <div class="row main">
      <div class="col-sm-4 col-sm-offset-4">

        <img src="{app:path:http}{app:path:skin}logo_brandbox.png" class="logo_brandbox" alt="" />

        <div class="panel">
          <div class="panel-body">

            <h2>Error</h2>
            <p>{$message}</p>
          </div>
        </div>

        <img src="{app:path:http}{app:path:skin}marketing_convenience.png" class="marketing_convenience" alt="" />

      </div>
    </div>

    <div class="loginFooter">
      <div class="version pull-left">
        Brandbox&reg; {echo \BB\info::getVersion();}
      </div>
    </div>

    <div class="clearfix"></div>

  </body>
</html>

