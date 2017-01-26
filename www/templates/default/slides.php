<aside class="bg-dark">
	<div class="container text-center">
		<div class="call-to-action">
			<h2 style="visibility: hidden; animation-name: none;"
				class="text-primary">Get Started</h2>
			<a href="http://coturn.net" target="ext"
				class="btn btn-default btn-lg wow flipInX">This Service is based on:
				COTURN</a>
		</div>
		<br />
		<hr>
		<br />
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="row">
					<h6 class="wide-space text-center">THE SERVICE IS BASED ON OPEN
						STANDARDS</h6>
					<div class="col-sm-3 col-xs-6 text-center">
						<i class="icon-lg ion-social-tux" title="Debian Linux"></i>
					</div>
					<div class="col-sm-3 col-xs-6 text-center">
						<i class="icon-lg ion-ios-paper-outline"
							title="IETF Open Standards"></i>
					</div>
					<div class="col-sm-3 col-xs-6 text-center">
						<i class="icon-lg ion-ribbon-b" title="Standards"></i>
					</div>
					<div class="col-sm-3 col-xs-6 text-center">
						<i class="icon-lg ion-social-html5-outline" title="html 5"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</aside>
<section id="background" class="bg-primary">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 text-center">
				<h2 style="visibility: hidden; animation-name: none;"
					class="text-primary margin-top-0 wow fadeIn">How it works?</h2>
				<hr class="primary">
				<br> <br> <br>
			</div>
		</div>
	</div>
	<div class="container-fluid no-padding">
		<div class="row no-gutter">
			
			<?php 
				$slides = array("slides-87-behave-10-page-002.jpg", "slides-87-behave-10-page-003.jpg", "slides-87-behave-10-page-004.jpg",
						"slides-87-behave-10-page-005.jpg", "slides-87-behave-10-page-006.jpg", "slides-87-behave-10-page-007.jpg",
						"slides-87-behave-10-page-008.jpg", "slides-87-behave-10-page-009.jpg", "slides-87-behave-10-page-010.jpg",
						"slides-87-behave-10-page-013.jpg", "slides-87-behave-10-page-014.jpg", "slides-87-behave-10-page-015.jpg",
						"slides-87-behave-10-page-016.jpg");
				foreach ($slides as $name) {
			?>
			<div class="col-lg-4 col-sm-6 stun-img-box">
				<a href="#galleryModal" class="gallery-box" data-toggle="modal"
					data-src="img/slides-87-behave-10/<?php echo $name;?>">
					<img src="img/slides-87-behave-10/<?php echo $name;?>"
					class="img-responsive" alt="Image">
					<div class="gallery-box-caption">
						<div class="gallery-box-content">
							<div>
								<i class="icon-lg ion-ios-search"></i>
							</div>
						</div>
					</div>
				</a>
			</div>		
			<?php 
				}
			?>
			

			<?php 
				$slides = array("slides-90-tram-6-page-004.jpg", "slides-90-tram-6-page-011.jpg");
				foreach ($slides as $name) {
			?>
			<div class="col-lg-4 col-sm-6  stun-img-box">
				<a href="#galleryModal" class="gallery-box" data-toggle="modal"
					data-src="img/slides-90-tram-6/<?php echo $name;?>">
					<img src="img/slides-90-tram-6/<?php echo $name;?>"
					class="img-responsive" alt="Image">
					<div class="gallery-box-caption">
						<div class="gallery-box-content">
							<div>
								<i class="icon-lg ion-ios-search"></i>
							</div>
						</div>
					</div>
				</a>
			</div>		
			<?php 
				}
			?>
			
		</div>
	</div>
</section>