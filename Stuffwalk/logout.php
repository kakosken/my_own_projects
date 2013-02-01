<?php
	session_start();
	if(isset($_SESSION["profile"]))
	    unset($_SESSION["profile"]);
	if(isset($_SESSION["stuffwalk_profile"]))
	    unset($_SESSION["stuffwalk_profile"]);
	if(isset($_SESSION["stuffwalk_time"]))
		unset($_SESSION["stuffwalk_time"]);
	if(isset($_SESSION["stuffwalk_hashtag"]))
		unset($_SESSION["stuffwalk_hashtag"]);
	if(isset($_COOKIE["PHPSESSID"]))
		unset($_COOKIE["PHPSESSID"]);
		setcookie("stuffwalk_profile_id","");
	/*
	print $_SESSION["stuffwalk_profile"] . "<br/>";
	print $_SESSION["stuffwalk_time"] . "<br/>";
	print $_SESSION["stuffwalk_hashtag"] . "<br/>";
	*/
	session_unset();
	session_destroy();
header('Location:index.php');
?>