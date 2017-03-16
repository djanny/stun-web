<section class="bg-dark" id="rest">

	<?php 
		if (isUserLogged() == true) {
	?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="margin-top-0 text-primary">REST API</h2>
				<h3>Time Limited Long Term Credential Mechanism</h3>
				<hr class="primary">
			</div>
		</div>
	</div>
	<div class="container text-center">
		<div class="call-to-action">
			<a href="https://api.<?php echo default_realm ;?>" target="ext"
				class="btn btn-default btn-lg wow pulse">The REST API Documentation</a>
		</div>
	</div>
	<hr />
	<div class="container text-center">
		<div class="call-to-action">
			<a href="/rest-sample.html" target="ext"
				class="btn btn-default btn-lg wow bounceInLeft">Sample PHP code</a>
		</div>
	</div>
	<hr />
	<div class="container" id="tokens">
		<div class="row col-md-8 col-md-offset-2 custyle" id="token_table">
			<a href="#addServiceModal" data-toggle="modal"
				data-target="#addServiceModal"
				class="btn btn-primary btn-xs pull-right"><b>+</b> Add new service</a>
			<table class="table">
				<thead>
					<tr>
						<th>Token (api_key)</th>
						<th>Service URL</th>
						<th>Realm</th>
						<th>Expire</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
<?php
$query = "SELECT id,token,service_url,realm,(created + INTERVAL 1 YEAR) as expire FROM token where eppn=:eppn and realm='" . default_realm . "'";
$sth = $db_rest->prepare ( $query );
$sth->bindValue ( ':eppn', $attrib ["eppn"], PDO::PARAM_STR );
$sth->execute ();
$result = $sth->fetchAll ( PDO::FETCH_ASSOC );
foreach ( $result as $row => $columns ) {
	echo "                    <tr>
                        <td>" . $columns ["token"] . "</td>
                        <td>" . $columns ["service_url"] . "</td>
                        <td>" . $columns ["realm"] . "</td>
                        <td>" . $columns ["expire"] . "</td>
                        <td class=\"text-center\">
                            <a href=\"#renewServiceModal\" data-toggle=\"modal\" data-target=\"#renewServiceModal\" data-id=\"" . $columns ['id'] . "\" data-service_url=\"" . $columns ['service_url'] . "\" class=\"btn btn-primary btn-xs\"><span class=\"ion-android-refresh\"></span> Renew</a>
                            <a href=\"#delModal\" data-toggle=\"modal\" data-target=\"#delModal\" data-id=\"" . $columns ['id'] . "\" data-table=\"token\" class=\"btn btn-primary btn-xs\"><span class=\"ion-android-delete\"></span> Del</a>
                       </td>
                    </tr>";
}
?>
           </table>
		</div>
	</div>
	<?php 
		}
	?>	
	
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 text-center">
				<div class="feature">
					<i
						style="visibility: hidden; animation-delay: 0.3s; animation-name: none;"
						class="icon-lg ion-social-chrome-outline wow fadeIn"
						data-wow-delay=".3s"></i>
					<h3>WebRTC</h3>
					<p class="text-muted">Designed for WebRTC usage</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 text-center">
				<div class="feature">
					<i
						style="visibility: hidden; animation-delay: 0.2s; animation-name: none;"
						class="icon-lg ion-ios-locked-outline wow fadeInUp"
						data-wow-delay=".2s"></i>
					<h3>Secure</h3>
					<p class="text-muted">Protection against attacks</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 text-center">
				<div class="feature">
					<i
						style="visibility: hidden; animation-delay: 0.3s; animation-name: none;"
						class="icon-lg ion-arrow-swap wow fadeIn" data-wow-delay=".3s"></i>
					<h3>Compatibility</h3>
					<p class="text-muted">Client side backward compatibility</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 text-center">
				<div class="feature">
					<i
						style="visibility: hidden; animation-delay: 0.3s; animation-name: none;"
						class="icon-lg ion-android-cloud-outline wow fadeIn"
						data-wow-delay=".3s"></i>
					<h3>Distributed</h3>
					<p class="text-muted">Distributed around Europe</p>
				</div>
			</div>
		</div>
	</div>

	<section class="bg-dark" id="rest-map">
	        <div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h2 class="margin-top-0 text-primary">REST API Servers on Maps</h2>
					<hr class="primary">
				</div>
			</div>
	
			<div id="rest-map-api" style="height: 600px; width: 100%;"></div>
		</div>
	</section>
  
 <section class="bg-dark" id="common-map">
         <div class="container">
   <div class="row">
    <div class="col-lg-12 text-center">
     <h2 class="margin-top-0 text-primary">All Servers on Maps</h2>
     <hr class="primary">
    </div>
   </div>
 
   <div id="common-map-api" style="height: 600px; width: 100%;"></div>
  </div>
 </section>
 
</section>