<script>
$(document ).ready(function() {
	initGeoLTC(<?php echo get_servers_geo($db_ltc); ?>);
	initGeoRest(<?php echo get_servers_geo($db_rest); ?>);
});
</script>
