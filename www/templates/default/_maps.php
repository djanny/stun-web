<script>
$(document ).ready(function() {
    initGeoLeaflet();
	initGeoLTC(<?php echo get_servers_geo($db_ltc); ?>);
	initGeoRest(<?php echo get_servers_geo($db_rest); ?>);
	initGeoCommon(<?php echo get_servers_geo($db_ltc); ?>, <?php echo get_servers_geo($db_rest); ?>);
});
</script>
