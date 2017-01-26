<div id="galleryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-body">
        		<img src="" id="galleryImage" class="img-responsive" />
        		<p>
        		    <br>
        		    <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">Close <i class="ion-android-close"></i></button>
        		</p>
        	</div>
        </div>
        </div>
    </div>
    <div id="aboutModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-body">
        		<h2 class="text-center">GÉANT4 Federated STUN/TURN Pilot Service</h2>
        		<h5 class="text-center">
        		    This is a free federated STUN/TURN pilot service for the Higher Education Research community.
        		</h5>
        		<p class="text-justify">
There could be plenty of barriers that may prevent Peer to Peer (P2P) direct communication: e.g. Firewalls/Packet Filters, NATs, Multiple Interfaces (Cable/VPN/WIFI/Mobile Internet), Next Gent IP transition (Multiple IP protocols IPv4,IPv6), etc. The goal is in this pilot to demonstrate that a Europe wide service could be build up from Open Source components that could serve our community Intercalative Connectivity Establishment (ICE) Agents. Which base on STUN/TURN servers. ICE is an IETF standard, that makes possible Real Time Communication (RTC) through NAT and Firewalls and also help in IPv6 smooth transition. It is widely deployed and used.  For example we could find it in VoIP phone, Telepresence/VideoConference systems,  and in ALL WebRTC clients like all Web browsers.
         		</p>
        		<p class="text-center"><a href="#last" onclick="$('#aboutModal').modal('hide');">In case of any question please don't hesitate to contact us.</a></p>
        		<br>
        		<button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true"> OK </button>
        	</div>
        </div>
        </div>
    </div>
    <div id="alertModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
        	<div class="modal-body">
        		<h2 class="text-center">Many thanks for your feedback!</h2>
        		<p class="text-center">We will get back to you soon!</p>
        		<br>
        		<button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">OK <i class="ion-android-close"></i></button>
        	</div>
        </div>
        </div>
    </div>
    <div id="addServiceModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
        	<div class="modal-content">
        		<div class="modal-body">
        			<h2 class="text-center">Request api_key to a new Service</h2>
        	        	<form class="addservice-form form" id="addservice-form" method="post">
					<div class="form-group">
                                                <input type="hidden" name="token" value="<?php echo $token; ?>" />
						<input type="hidden" name="form" value="addservice">
						<label class="control-label">Service URL</label>
						<input class="form-control" placeholder="Service URL" type="text" name="service_url" id="tokens-service-url">
                                        </div>
					<div class="form-group">
						<label class="control-label">Realm</label>
						<input class="form-control" type="text" name="realm" value="<?php echo default_realm; ?>" readonly>
					</div>
					<button type="submit" class="btn btn-primary btn-lg center-block" aria-hidden="true">Request Token (api_key) <i class="ion-android-arrow-forward"></i></button>
				</form>
	        	</div>
        	</div>
        </div>
    </div>
    <div id="renewServiceModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
        	<div class="modal-content">
        		<div class="modal-body">
        			<h2 class="text-center">Request api_key to a new Service</h2>
        	        	<form class="renewservice-form form" id="renewservice-form" method="post">
					<div class="form-group">
                                                <input type="hidden" name="token" value="<?php echo $token; ?>" />
						<input type="hidden" name="form" value="updateservice">
						<input type="hidden" name="row_id" class="row_id">
						<label class="control-label">Service URL</label>
						<input class="form-control service_url" placeholder="Service URL" type="text" name="service_url">
                                        </div>
					<div class="form-group">
						<label class="control-label">Realm</label>
						<input class="form-control" type="text" name="realm" value="<?php echo default_realm; ?>" readonly>
					</div>
					<button type="submit" class="btn btn-primary btn-lg center-block" aria-hidden="true">Renew Token (api_key) <i class="ion-android-arrow-forward"></i></button>
				</form>
	        	</div>
        	</div>
        </div>
    </div>
    <div id="renewUserModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
        	<div class="modal-content">
        		<div class="modal-body">
        			<h2 class="text-center">Please keep and notice!</h2>
                                <h3 class="text-center">This is your new Username Password and Realm!</h2>
                                <hr/>
        	        	<form role="form" class="form-horizontal renewuser-form" id="renewuser-form" method="post">
					<div class="form-group">
                                                <input type="hidden" name="token" value="<?php echo $token; ?>" />
						<input type="hidden" name="form" value="updateuser">
						<input type="hidden" name="row_id" class="row_id">
						<label class="control-label col-sm-2">Username</label>
                                                <div class="col-sm-10">
						    <input class="form-control " type="text" name="username" value="<?php echo str_replace("@","_at_",$attrib["mail"]); ?>" readonly>
                                                </div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Password</label>
                                                <div class="col-sm-10">
						<input class="form-control" type="text" name="password" value="<?php echo mkpasswd(32); ?>" readonly>
                                                </div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Realm</label>
                                                <div class="col-sm-10">
						<input class="form-control" type="text" name="realm" value="<?php echo default_realm; ?>" readonly>
                                                </div>
                                                <br>
					</div>
					<button type="submit" class="btn btn-primary btn-lg center-block" aria-hidden="true">Renew Password Credential <i class="ion-android-arrow-forward"></i></button>
				</form>
	        	</div>
        	</div>
        </div>
    </div>
    <div id="addUserModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
        	<div class="modal-content">
        		<div class="modal-body">
        			<h2 class="text-center">Please keep and notice!</h2>
                                <h3 class="text-center">This is your new Username Password and Realm!</h2>
                                <hr/>
        	        	<form role="form" class="form-horizontal adduser-form" id="adduser-form" method="post">
					<div class="form-group">
                                                <input type="hidden" name="token" value="<?php echo $token; ?>" />
						<input type="hidden" name="form" value="adduser">
						<label class="control-label col-sm-2">Username</label>
                                                <div class="col-sm-10">
						    <input class="form-control " type="text" name="username" value="<?php echo str_replace("@","_at_",$attrib["mail"]); ?>" readonly>
                                                </div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Password</label>
                                                <div class="col-sm-10">
						<input class="form-control" type="text" name="password" value="<?php echo mkpasswd(32); ?>" readonly>
                                                </div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Realm</label>
                                                <div class="col-sm-10">
						<input class="form-control" type="text" name="realm" value="<?php echo default_realm; ?>" readonly>
                                                </div>
                                                <br>
					</div>
					<button type="submit" class="btn btn-primary btn-lg center-block" aria-hidden="true">Request Password Credential <i class="ion-android-arrow-forward"></i></button>
				</form>
	        	</div>
        	</div>
        </div>
    </div>
   <div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
        	<div class="modal-body">
        		<h2 class="text-center">Are You sure ?!</h2>
        		<p class="text-center">You clicked on the delete button. This is your last chance to cancel...</p>
        	        	<form class="del-form row text-center" id="del-form" method="post">
					<div class="col-lg-10 col-lg-offset-1">
                                                <input type="hidden" name="token" value="<?php echo $token; ?>" />
						<input type="hidden" name="form" value="del">
						<input type="hidden" name="row_id" class="row_id">
						<input type="hidden" name="table" id="table">
						<label></label>
						<button type="submit" class="btn btn-primary btn-lg center-block" aria-hidden="true">I am  Sure <i class="ion-android-arrow-forward"></i></button>
					</div>
				</form>
        	</div>
        </div>
        </div>
    </div>