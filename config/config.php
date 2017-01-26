<?php 
	require_once('db-config.php');

	define('LOGOUT_URL', 'https://turn.geant.org/Shibboleth.sso/Logout');
	
	function isUserLogged() {
		return false;
	}
	
	function getUserDisplayName() {
		if (isset($attrib['displayName'])) {
			return $attrib['displayName'];
		}
	}
	
	function getUserMail() {
		if (isset($attrib['mail'])) {
			return $attrib['mail'];
		}
	}
?>

