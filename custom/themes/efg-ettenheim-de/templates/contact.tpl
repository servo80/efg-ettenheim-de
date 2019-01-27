<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Evangelisch-Freikirchliche Gemeinde Ettenheim - {app:page:title}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
</head>

<body>
<div id="preloader"></div>
<div id="wrapper">
  <!-- header begin -->
  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <!-- logo begin -->
          <div id="logo">
            <div class="inner">
              <a href="index.html">
                <img src="custom/themes/efg-ettenheim-de/img/logo.png" alt="" class="logo-1">
                <img src="custom/themes/efg-ettenheim-de/img/logo-2.png" alt="" class="logo-2">
              </a>

            </div>
          </div>
          <!-- logo close -->
        </div>

        <div class="col-md-9">
          <!-- mainmenu begin -->
          <div id="mainmenu-container">

            <bb:menu key="main" id="mainmenu" page_id="null">
              <bb:link>
                <bb:menu key="sub" page_id="parent">
                  <bb:link />
                  <bb:active />
                </bb:menu>
              </bb:link>
              <bb:active>
                <bb:menu key="sub" page_id="parent">
                  <bb:link />
                  <bb:active />
                </bb:menu>
              </bb:active>
            </bb:menu>
          </div>

          <!-- mainmenu close -->

          <!-- social icons -->
          <div class="social">
            <a href="https://www.facebook.com/efgettenheim"><i class="fa fa-facebook"></i></a>
            <a href="https://www.efg-ettenheim.de/de/Kontakt.html"><i class="fa fa-envelope-o"></i></a>
          </div>
          <!-- social icons close -->
        </div>

      </div>
    </div>



  </header>
  <!-- header close -->

  <!-- subheader begin -->
  <section id="subheader" data-speed="2" data-type="background">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <h1>{app:page:title}</h1>
        </div>
      </div>
    </div>
  </section>
  <!-- subheader close -->

  <div id="map"></div>

  <!-- content begin -->
  <div id="content" class="no-padding">
    <bb:location key="main" number="1" />
  </div>
  <!-- footer begin -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          &copy; Copyright 2017{year} - EFG Ettenheim
        </div>
        <div class="col-md-6">
          <nav>
            <bb:menu key="footer" page_id="null">
              <bb:link />
              <bb:active />
            </bb:menu>
          </nav>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer close -->
</div>

<script stay="true" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG3ttqyuf0AgSZQL5B94PWbVaHwGFUreA"></script>

</body>

<script stay="true">
  google.maps.event.addDomListener(window, 'load', geoSuccess);
</script>
</html>
