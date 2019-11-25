<?php
  ob_start();
  session_start();
  require_once 'actions/db_connect.php';
  require_once 'RESTful.php';
  $error = false;

  $sql = "SELECT street, house_no, zip_code, city FROM `addresses`
          INNER JOIN `cities` ON fk_zip_code = zip_code";
  $result = mysqli_query($connect, $sql);
  $addresses = mysqli_fetch_all($result);

  foreach ($addresses as $address) {
    $addressesStr[] = implode(",", $address);
  }
  // $addressesJSON = JSON_encode($addressesStr, JSON_UNESCAPED_UNICODE);
  // echo $addressesJSON;
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 90vh;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
  </head>
  <body>
    <?php
      include "header.php";
    ?>
    <!--The div element for the map -->
    <div id="map"></div>

    <script>
      function initMap() {
        var vienna = {lat: 48.2081743, lng: 16.3738189};
        var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 13, center: vienna});

        <?php
          for ($i=0; $i<3; $i++) {
            $addressStr = $addressesStr[$i];
            $url = "https://maps.google.com/maps/api/geocode/xml?address=".$addressStr."&key=AIzaSyBtjaD-saUZQ47PbxigOg25cvuO6_SuX3M";
            $response = curl_get($url);
            $xml = simplexml_load_string($response);
            $xmlPath = $xml->result->geometry->location;
            echo "

                let location".$i." = {lat: ".$xmlPath->lat.", lng: ".$xmlPath->lng."};
                let marker".$i." = new google.maps.Marker({position: location".$i.", map: map});

            ";
          }
        ?>
      }
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtjaD-saUZQ47PbxigOg25cvuO6_SuX3M&callback=initMap">
    </script>
  </body>
</html>