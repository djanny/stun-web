<nav id="topNav" class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#bs-navbar">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand page-scroll"
				href="https://wiki.geant.org/display/WRTC/GN4-1+WebRTC+Roadmap"><i
				class="ion-ios-flask-outline"></i> GN4 WebRTC Lab</a>
		</div>
		<div class="navbar-collapse collapse" id="bs-navbar">
			<ul class="nav navbar-nav">
				<li><a class="page-scroll" href="#intro">Intro</a></li>
				<li><a class="page-scroll" href="#ltc">Password</a></li>
				<li><a class="page-scroll" href="#ltc-map">Password Servers</a></li>
				<li><a class="page-scroll" href="#rest">REST API</a></li>
				<li><a class="page-scroll" href="#rest-map">REST Servers</a></li>
				<li><a class="page-scroll" href="#oauth">Oauth</a></li>
				<li><a class="page-scroll" href="#last">Contact</a></li>
				<li>
				<?php 
					if (isUserLogged() == true) {
				?>
				<a href="<?php echo LOGOUT_URL; ?>">Logout</a></li>
				<?php 
					} else {
				?>
					<a href="?action=login">Login</a></li>
				<?php 
					}
				?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a class="page-scroll" data-toggle="modal"
					title="A free Bootstrap video landing theme" href="#aboutModal">About</a>
				</li>
			</ul>
		</div>
	</div>
</nav>