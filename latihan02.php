<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="DIVSIG UGM">
    <meta name="description" content="leaflet basic">

    <!-- Judul pada tab browser -->
    <title>Peta Data Localhost</title>

    <!-- Leaflet CSS Library -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css">

    <!-- Tab browser icon -->
    <link rel="icon" type="image/x-icon" href="http://luk.staff.ugm.ac.id/logo/UGM/Resmi/Warna.gif">

    <style>
        /* Tampilan peta fullscreen */
        html,
        body,
        #map {
            height: 100%;
            width: 100%;
            margin: 0px;
        }
    </style>
</head>

<body>
    <!-- Leaflet JavaScript Library -->
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

    <div id="map"></div>

    <script>
  /* Initial Map */ 
 var map = L.map('map').setView([-7.797068, 110.370529], 13); //lat, long, zoom


 /* Tile Basemap */ 
     var basemap1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | <a href="DIVSIGUGM" target="_blank">DIVSIG UGM</a>' 
        //menambahkan nama//
 });

     var basemap2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/ { z } / { y } / { x }', {
 attribution: 'Tiles &copy; Esri | <a href="Latihan WebGIS" target="_blank">DIVSIG UGM</a>'
 });

        var basemap3 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{ x } ', {
        attribution: 'Tiles &copy; Esri | <a href="Lathan WebGIS" target="_blank">DIVSIG UGM</a>'
 });

        var basemap4 = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org / ">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
 });

        basemap4.addTo(map);

    /* Layer Marker */
        /*L.marker([-7.76443, 110.37889]).addTo(map).bindPopup("TVRI Jogja")*/
        /*var marker1 = L.marker([-7.76443, 110.37889], { draggable: true });
        marker1.addTo(map);
        marker1.bindPopup("TVRI Jogja");

        var marker2 = L.marker([-7.76979, 110.37782]);
        marker2.addTo(map);
        marker2.bindPopup("Grha Sabha Pramana");

        var marker3 = L.marker([-7.76205, 110.37949]);
        marker3.addTo(map);
        marker3.bindPopup("Tempo Gelato");*/
        
        
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "acara8";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: ".$conn -> connect_error);
            }

            $sql = "SELECT * FROM data_penduduk";
            $result = $conn -> query($sql);

            if ($result -> num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                    $lat = $row["latitude"];
                    $long = $row["longitude"];
                    $info = $row["kecamatan"];
                    echo "L.marker([$lat, $long]).addTo(map).bindPopup('$info');";
                }
            }
            else {
                echo "0 results";
            }
            $conn -> close();
        ?>

        /* Control Layer */
        var baseMaps = {
            "OpenStreetMap": basemap1,
            "Esri World Street": basemap2,
            "Esri Imagery": basemap3,
            "Stadia Dark Mode": basemap4
        };

        var overlayMaps = {
            "TVRI Jogja": marker1,
            "Grha Sabha Pramana": marker2,
            "Tempo Gelato" : marker3,
            "UGM" : marker
        };

        L.control.layers(baseMaps, overlayMaps, { collapsed: false }).addTo(map);

        /* Scale Bar */
        L.control.scale({
            maxWidth: 150, position: 'bottomright'
        }).addTo(map);

    </script>
</body>

</html>