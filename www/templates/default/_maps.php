    <script>
        function initMap() {
          initMapLTC(<?php echo json_encode($TURNservers); ?>);
          initMapREST(<?php echo json_encode($TURNservers);?>);
        }
    </script>
    <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdl6wVohcvpT5Q9hrIB4Uo8qVqKiwratg&callback=initMap">
    </script>