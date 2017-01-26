<?php
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

require_once('../vendor/autoload.php');

require_once('../lib/db.php');
require_once('../lib/geo.php');

if (!empty($_GET['action'])) {
	$action = $_GET['action'];
	switch($action){
		case "login":
			if (!isset($_SERVER["AUTH_TYPE"]) || empty($_SERVER["AUTH_TYPE"]) || $_SERVER["AUTH_TYPE"]!="Shibboleth") {
				header("Location: /Shibboleth.sso/Login"); /* Redirect browser */
			} else {
				$mandatory=array("mail","eppn","displayName",);
				foreach($mandatory as $v) {
					if (isset($_SERVER[$v]) && !empty($_SERVER[$v])){
						$attrib[$v]=$_SERVER[$v];
					} else {
						if($v=="mail" || $v=="mail" || "eppn"){
							header("Location: /attribute-error.html"); /* Redirect browser */
							exit();
						} else{
							$attrib[$v]="NULL";
						}
					}
				}
			}
			break;
		default:
			break;
	}
}

$db_rest = DB::getRestDBConnection();
$db_ltc = DB::getLtcDBConnection();

// Default realm
const default_realm='turn.geant.org';

//create csfr token
$a = session_id();
if(empty($a))session_start();
if (empty($_SESSION['token'])) {
    if (function_exists('mcrypt_create_iv')) {
        $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    } else {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}
$token = $_SESSION['token'];

function mkpasswd($length) {
    $generator = new ComputerPasswordGenerator();
    
    $generator
      ->setUppercase()
      ->setLowercase()
      ->setNumbers()
      ->setSymbols(false)
      ->setLength($length);
    
    $password = $generator->generatePasswords();
    return $password[0];
 
};

function huston_we_have_a_problem($problem){
    http_response_code(500);
    echo $problem;
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && !empty($_POST)) {
    // AJAX request
    if (!empty($_POST['token'])) {
        if (hash_equals($_POST['token'], $_SESSION['token'])) { 
            switch($_POST["form"]){
                case "feedback":
                    $mail = new PHPMailer;
                    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
                    
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'localhost';  // Specify main and backup SMTP servers
                
                    $mail->CharSet = "UTF-8";
                    
                    $mail->setFrom('stun-devops@listserv.niif.hu', 'Contact Webform');
                    // set recipient
                    $mail->addAddress('stun-devops@listserv.niif.hu', 'Voice Video Collaboration');     // Add a recipient
                    
                    $mail->isHTML(true);                                  // Set email format to HTML
                    
                    $mail->Subject = 'Contact Form from '.default_realm;
                    $mail->Body    = "Name: ".$_POST['Name']."<br>Email: ".$_POST['Email']."<br>Phone: ".$_POST['Phone']."<br>Message:".$_POST['Message'];
                    $mail->AltBody = "Name: ".$_POST['Name']."\nEmail: ".$_POST['Email']."\nPhone: ".$_POST['Phone']."\nMessage:".$_POST['Message'];
                    print_r($mail);
                    exit;
                    if(!$mail->send()) {
                        http_response_code(500);
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        echo 'Message has been sent';
                        // We delete the addresses of distributer and owner.
                        $mail->ClearAddresses();
                        
                        $mail->addAddress($_POST['Email'], $_POST['Name']);     // Add a recipient
                        $mail->Subject = 'Your feedback is highly Appreciated!';
                        $mail->Body = "Many thanks for Your feedback, we will contact you soon..<br><br>Lab Team";
                    	$mail->AltBody = "Many thanks for Your feedback, we will contact you soon..\n\nLab Team";
                        
                        if($mail->Send()){  }else{ $error = "Error sending feedback message to the user! <br/>"; }
                    }
                    break;
                case "adduser":
        	    $query="INSERT INTO turnusers_lt (eppn,email,displayname,name,realm,hmackey) values(:eppn,:mail,:displayname,:username,:realm,:HA1)";
                    $sth = $db_ltc->prepare($query);
                    $sth->bindValue(':eppn', $attrib["eppn"], PDO::PARAM_STR);
                    $sth->bindValue(':mail', $attrib["mail"], PDO::PARAM_STR);
                    $sth->bindValue(':displayname', $attrib["displayName"], PDO::PARAM_STR);
                    $sth->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
                    $sth->bindValue(':realm', $_POST['realm'], PDO::PARAM_STR);
                    $sth->bindValue(':HA1', md5($_POST['username'].':'.$_POST['realm'].':'.$_POST['password']), PDO::PARAM_STR);
                    if($sth->execute()){
        		//success
        	    } else {
        		huston_we_have_a_problem('New user could not be inserted.');
        	    }
                    break;
                case "updateuser":
        	    $query="UPDATE turnusers_lt SET hmackey=:HA1,email=:mail,displayname=:displayname,name=:username,realm=:realm WHERE eppn=:eppn AND id=:id and realm='default_realm'";
                    $sth = $db_ltc->prepare($query);
                    $sth->bindValue(':eppn', $attrib["eppn"], PDO::PARAM_STR);
                    $sth->bindValue(':mail', $attrib["mail"], PDO::PARAM_STR);
                    $sth->bindValue(':displayname', $attrib["displayName"], PDO::PARAM_STR);
                    $sth->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
                    $sth->bindValue(':realm', $_POST['realm'], PDO::PARAM_STR);
                    $sth->bindValue(':HA1', md5($_POST['username'].':'.$_POST['realm'].':'.$_POST['password']), PDO::PARAM_STR);
                    $sth->bindValue(':id', $_POST['row_id'], PDO::PARAM_STR);
                    if($sth->execute()){
        		//success
        	    } else {
        		huston_we_have_a_problem('New user could not be updated.');
        	    }
                    break;
                 case "addservice":
                    $token = mkpasswd(32);
        	    
        	    $query="INSERT INTO token (eppn,email,displayname,token,service_url,realm) values(:eppn,:mail,:displayname,:token,:service_url,:realm)";
                    $sth = $db_rest->prepare($query);
                    $sth->bindValue(':eppn', $attrib["eppn"], PDO::PARAM_STR);
                    $sth->bindValue(':mail', $attrib["mail"], PDO::PARAM_STR);
                    $sth->bindValue(':displayname', $attrib["displayName"], PDO::PARAM_STR);
                    $sth->bindValue(':token', $token, PDO::PARAM_STR);
                    $sth->bindValue(':service_url', $_POST['service_url'], PDO::PARAM_STR);
                    $sth->bindValue(':realm', $_POST['realm'], PDO::PARAM_STR);
                    if($sth->execute()){
        		//success
        	    } else {
        		huston_we_have_a_problem('New token could not be inserted.');
        	    }
                    break;
                 case "updateservice":
                    $token = mkpasswd(32);
        	    
        	    $query="UPDATE token set created=NOW(),email=:mail,displayname=:displayname,token=:token,service_url=:service_url,realm=:realm WHERE eppn=:eppn AND id=:id and realm='default_realm'";
                    $sth = $db_rest->prepare($query);
                    $sth->bindValue(':eppn', $attrib["eppn"], PDO::PARAM_STR);
                    $sth->bindValue(':mail', $attrib["mail"], PDO::PARAM_STR);
                    $sth->bindValue(':displayname', $attrib["displayName"], PDO::PARAM_STR);
                    $sth->bindValue(':token', $token, PDO::PARAM_STR);
                    $sth->bindValue(':service_url', $_POST['service_url'], PDO::PARAM_STR);
                    $sth->bindValue(':realm', $_POST['realm'], PDO::PARAM_STR);
                    $sth->bindValue(':id', $_POST['row_id'], PDO::PARAM_STR);
                    if($sth->execute()){
        		//success
        	    } else {
        		huston_we_have_a_problem('New token could not be updated.');
        	    }
                    break;
                 case "del":
                    $table="";
                    switch ($_POST["table"]) {
                        case "turnusers_lt":
                            $table="turnusers_lt";
                            $db=$db_ltc;
                            break;
                        case "token":
                            $table="token";
                            $db=$db_rest;
                            break;
                        default:
        		huston_we_have_a_problem('Invalid table parameter received!');
                    }

        	    $query="DELETE from ".$table." where eppn=:eppn and email=:mail and id=:id";
                    $sth = $db->prepare($query);
                    $sth->bindValue(':eppn', $attrib["eppn"], PDO::PARAM_STR);
                    $sth->bindValue(':mail', $attrib["mail"], PDO::PARAM_STR);
                    $sth->bindValue(':id', $_POST['row_id'], PDO::PARAM_STR);
                    if($sth->execute()){
                        echo $table;
        		//success
        	    } else {
        		huston_we_have_a_problem('Cannot delete from '.$table.'table row id:'.$_POST['id'].' !');
        	    }
                    break;
             }
        }
    } 
} else {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>STUN/TURN pilot</title>
    <meta name="description" content="STUN/TURN federation" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="dist/js/scripts.min.js"></script>
    <link rel="stylesheet" href="dist/css/geant.css" />
  </head>
  <body>
    
    
    <?php 
    	include('templates/default/navigation.php');
    	include('templates/default/header.php');
    	include('templates/default/intro.php');

    	include('templates/default/ltc.php');
    	include('templates/default/rest.php');
    	include('templates/default/oauth.php');
    	include('templates/default/features.php');

    	include('templates/default/slides.php');
    	include('templates/default/contact.php');

    	include('templates/default/_modals.php');

    	include('templates/default/_maps.php');
    ?>
    

  </body>
</html>

<?php } ?>
