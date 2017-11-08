// When the window has finished loading create our google map below

if(google) {
  google.maps.event.addDomListener(window, 'load', getLocation);
}

function geoSuccess() {

    var myLatlng = new google.maps.LatLng(48.262340, 7.805900);

    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;

    var infoWindowContent =
      '<div class="info_content">' +
      '<h3>Evangelisch-Freikirchliche Gemeinde Ettenheim</h3>' +
      '<p>Stückle-Straße 2, 77955 Ettenheim</p>' +
      '<img src="../custom/themes/efg-ettenheim-de/img/logo2.png" width="151" height="52">' +
      '</div>'
      ;

    var mapOptions = {

        zoom: 13,
        scrollwheel: true,
        center: myLatlng, // Ettenheim

    };

    var mapElement = document.getElementById('map');

    var map = new google.maps.Map(mapElement, mapOptions);

    var marker = new google.maps.Marker({
        position: myLatlng,
        title: 'Evangelisch-Freikirchliche Gemeinde Ettenheim'
    });

    var infoWindow = new google.maps.InfoWindow(), marker;

    marker.setMap(map);

    google.maps.event.addListener(marker, 'click', (function(marker) {
      return function() {
        infoWindow.setContent(infoWindowContent);
        infoWindow.open(map, marker);
        latit = marker.getPosition().lat();
        longit = marker.getPosition().lng();
      }
    })(marker));


    marker.addListener('click', function() {
      var currentPosition = navigator.geolocation.getCurrentPosition(geoSuccess, geoError);

      directionsService.route({

        origin: myLatlng,

        destination: {
          lat: latit,
          lng: longit
        },
        travelMode: 'DRIVING'
      }, function(response, status) {
        if (status === 'OK') {
          directionsDisplay.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
    });

  });

}

function geoError() {
  //alert("Geocoder failed.");
}

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
    // alert("Geolocation is supported by this browser.");
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}
