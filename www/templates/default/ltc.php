<section id="ltc">
	
	<?php 
		if (isUserLogged() == true) {
	?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="margin-top-0 text-primary">Password</h2>
				<h3>Long Term Credential Mechanism</h3>
				<hr class="primary">
				<br>
				<h3>
					STUN/TURN Server:
					<h3>
						<h3 data-wow-delay="0.5s" class="wow rubberBand text-primary">ltc.<?php echo default_realm; ?></h3>
						<br>
			
			</div>
		</div>
	</div>
	<div class="container" id="passwords">
		<div class="row col-md-8 col-md-offset-2 custyle" id="password_table">
<?php
$query = "SELECT * FROM turnusers_lt where eppn=:eppn and realm='" . default_realm . "'";
$sth = $db_ltc->prepare ( $query );
$sth->bindValue ( ':eppn', $attrib ["eppn"], PDO::PARAM_STR );
$sth->execute ();
$result = $sth->fetchAll ( PDO::FETCH_ASSOC );
if (empty ( $result )) {
	echo '            <a href="#addUserModal" data-toggle="modal" data-target="#addUserModal" class="btn btn-primary btn-xs pull-right" id="addUserButton"><b>+</b> Add new User</a>';
}
?>
           <table class="table">
				<thead>
					<tr>
						<th>Username</th>
						<th>Realm</th>
						<th>MD5(username:realm:password)</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
<?php
foreach ( $result as $row => $columns ) {
	echo "                    <tr>
                        <td>" . $columns ["name"] . "</td>
                        <td>" . $columns ["realm"] . "</td>
                        <td>" . $columns ["hmackey"] . "</td>
                        <td class=\"text-center\">
                            <a href=\"#renewUserModal\" data-toggle=\"modal\" data-target=\"#renewUserModal\" data-id=\"" . $columns ['id'] . "\" class=\"btn btn-primary btn-xs\"><span class=\"ion-android-refresh\"></span> Renew</a>
                            <a href=\"#delModal\" data-toggle=\"modal\" data-target=\"#delModal\" data-id=\"" . $columns ['id'] . "\" data-table=\"turnusers_lt\" class=\"btn btn-primary btn-xs\"><span class=\"ion-android-delete\"></span> Del</a>
                        </td>
                    </tr>\n";
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
			<div class="col-lg-4 col-md-4 text-center">
				<div class="feature">
					<i
						style="visibility: hidden; animation-delay: 0.3s; animation-name: none;"
						class="icon-lg ion-ios-telephone-outline wow fadeIn"
						data-wow-delay=".3s"></i>
					<h3>Legacy</h3>
					<p class="text-muted">For legacy Soft/Hard phones and VC systems</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 text-center">
				<div class="feature">
					<i
						style="visibility: hidden; animation-delay: 0.2s; animation-name: none;"
						class="icon-lg ion-ios-locked-outline wow fadeInUp"
						data-wow-delay=".2s"></i>
					<h3>Secure</h3>
					<p class="text-muted">Protection against dictionary attacks</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 text-center">
				<div class="feature">
					<i
						style="visibility: hidden; animation-delay: 0.3s; animation-name: none;"
						class="icon-lg ion-android-cloud-outline wow fadeIn"
						data-wow-delay=".3s"></i>
					<h3>Distributed</h3>
					<p class="text-muted">The Service is distributed around Europe</p>
				</div>
			</div>
		</div>
	</div>

	<section class="bg-dark" id="ltc-map">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h2 class="margin-top-0 text-primary">LTC Servers on Maps</h2>
					<hr class="primary">
				</div>
			</div>
			<div id='ltc-map-api' style="height: 600px; width: 100%;"></div>
		</div>
	</section>	
</section>