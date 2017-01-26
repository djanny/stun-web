<?php

function get_servers_geo($db_conn) {
	$query = "select fqdn,organization,ip,latitude,longitude from server left join ip on ip.server_id=server.id order by latitude,longitude,server.id,ip.ipv6";
	$sth = $db_conn->prepare ( $query );
	if ($sth->execute ()) {
		// success
		$result = $sth->fetchAll ( PDO::FETCH_ASSOC );
		$lat = 0;
		$lng = 0;
		$TURNservers = array ();
		foreach ( $result as $row => $columns ) {
			if ($lat == $columns ["latitude"] && $lng == $columns ["longitude"]) {
				end ( $TURNservers );
				$TURNservers [key ( $TURNservers )] ['content'] .= "FQDN: " . $columns ["fqdn"] . " - IP: " . $columns ["ip"] . "<br>";
			} else {
				$lng = $columns ["longitude"];
				$lat = $columns ["latitude"];
				$TURNserver = array (
						"position" => array (
								"lat" => ( float ) $lat,
								"lng" => ( float ) $lng 
						),
						"title" => $columns ["organization"],
						"content" => "FQDN: " . $columns ["fqdn"] . " - IP: " . $columns ["ip"] . "<br>" 
				);
				$TURNservers [] = $TURNserver;
			}
		}
		if (empty ( $result )) {
			print ("DB error: empty result!") ;
		}
	} else {
		print ("DB error: conncetion error!") ;
	}
	
	return json_encode($TURNservers);
}

?>