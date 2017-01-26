<section id="last">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 text-center">
				<h2 style="visibility: hidden; animation-name: none;"
					class="margin-top-0 wow fadeIn">Get in Touch</h2>
				<hr class="primary">
				<p>We love feedback. Fill out the form below and we'll get back to
					you as soon as possible.</p>
			</div>
			<div class="col-lg-10 col-lg-offset-1 text-center">
				<form class="contact-form row" id="contact-form" method="post">
					<input type="hidden" name="token" value="<?php echo $token; ?>" />
					<input type="hidden" name="form" value="feedback">
					<div class="col-md-4">
						<label></label> <input class="form-control" placeholder="Name"
							type="text" name="Name"
							value="<?php echo getUserDisplayName(); ?>">
					</div>
					<div class="col-md-4">
						<label></label> <input class="form-control" placeholder="Email"
							type="text" name="Email" value="<?php echo getUserMail();?>">
					</div>
					<div class="col-md-4">
						<label></label> <input class="form-control" placeholder="Phone"
							name="Phone" type="text">
					</div>
					<div class="col-md-12">
						<label></label>
						<textarea class="form-control" rows="9" id="contact-form-message"
							name="Message" placeholder="Your message here.."></textarea>
					</div>
					<div class="col-md-4 col-md-offset-4">
						<label></label>
						<button type="submit" class="btn btn-primary btn-block btn-lg">
							Send <i class="ion-android-arrow-forward"></i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>