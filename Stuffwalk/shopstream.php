<?php 

  	session_start();
  	session_cache_limiter('private');
	session_cache_expire(365*24*60*60);

?>
<html>
<head>
<script type="text/javascript" src="csspopup.js"></script>
<script type="text/javascript" src="_dSf6-2x6.js"></script>
<style type="text/css">
<!--
#blanket {
background-color:#111;
opacity: 0.65;
filter:alpha(opacity=65);
position:absolute;
z-index: 9001;
top:0px;
left:0px;
width:100%;
}
#popUpDiv {
position:absolute;
background-color:#eeeeee;
width:300px;
height:300px;
z-index: 9002;
}

h1.element-spotlightrightpanel{
	background-color: #c0c0c0;
	font: 16px Times New Roman;
	margin: 0 5px 5px 0;
	border-bottom: 1px solid;
	padding: 0 5;
}

div.element-spotlightcontainer {
    position: relative;
	background:url('PSSWCO090P000020.jpg') no-repeat;
    display: block;
    margin: 0px 25px 10px 0px;
    text-align: left;
    color: #6c6f70;
    border: 1px solid #e0e0e0;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    -moz-box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    cursor: pointer;
}
div.element-spotlightcontainer input{
	float: right;
	margin-right: 5px;
}
div.element-spotlightcontainer div.more{
	margin-left: 100px;
}
div.element-spotlightcontainer p{
	margin-top: 195px;
}
div.element-spotlightcontainer p.product{
	border-top: 1px solid;
	text-transform:uppercase;
	border-color: #e0e0e0;
	margin-top: 240px;
	padding-left: 5px;
	height: 40px;
	background: white;
}

div.element-spotlightcontainer p.empty{
	margin-top: 25px;
	padding-left: 5px;
	border-color: #e0e0e0;
	background: white;
}
div.element-spotlightcontainer p.productclass{
	margin-top: 240px;
	padding-top: 10px;
	padding-left: 5px;
	border-top: 1px solid;
	border-color: #e0e0e0;
	background: white;
	text-align: center;
	text-transform:uppercase;
}

div.element-spotlightcontainer-ad {
    position: relative;
	background:url('') no-repeat;
    display: block;
    float: left;
    margin: 0px 0px 20px 0px;
    width: 420px;
    height: 284px;
    text-align: left;
    color: #6c6f70;
    border: 1px solid #e0e0e0;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    -moz-box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    cursor: pointer;
}
div.element-spotlightcontainer-ad a.editor{
	float: right;
	padding-right: 5px;
	text-decoration: none;
	font: 24px Arial Black;
}
div#cascadeNavigation{

}

#producttopic
{
	border: 1px solid;
	margin-top: 0px;
	padding-top: 15px;
}
#cloneOption
{
	border: 1px solid;
}
#someOption
{
	visibility: hidden;
}
-->
</style>
</head>

<?php


// $name = $_GET['name'];
// $lastname = $_GET['lastname'];

/* database communication */


// Connect to database

		$dbhost = 'ip_address:3306'; /* host */ $dbuser = 'username'; /* your username created */ $dbpass = 'password';//'password'; //the password 4 that user
		#$dbhost = 'localhost'; /* host */ $dbuser = 'root'; /* your username created */ $dbpass = '';//'password'; //the password 4 that user
		
		$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
		
		$dbname = 'database_name';
		mysql_select_db($dbname);//your database.
		/*
			Delete items
			http://dev.mysql.com/doc/refman/5.6/en/delete.html
		*/
		// $query="SELECT * FROM account WHERE email='$email'";
		// $result=mysql_query($query);
		// $i = 0;
		// $accountid = mysql_result($result,$i,"accountid");
		function invalid_user()
		{
				//header('Location: http://130.234.191.97:60000/xampp/Shopstream/');
				// print "Nyt meni joku pieleen!";
		}
		/*
		if(!isset($_SESSION["profile"]))
		{
			log_in($_POST["email"], $_POST["password"]);
		}
		else
		{
			//print $_SESSION["profile"];
			$idprofile = $_SESSION["profile"];
			//print $_SESSION["time"];
		}*/
		if(isset($_SESSION["stuffwalk_profile"]))
		{
			$idprofile = $_SESSION["stuffwalk_profile"];
			
			
		}
		else
		{
			//log_in($_POST["email"], $_POST["password"]);
		}
		function log_in($email, $password)
		{
			
			if(!isset($email) && !isset($password))
			{
				invalid_user();
			}
			else
			{
				user($email, $password);
			}
		}
		
		function user_id($email)
		{
			$query="SELECT * FROM `profile` WHERE data_value LIKE '$email'"; // WHERE data-value='$email'";
			$result=mysql_query($query);
			$num=mysql_numrows($result);
			$idprofile = mysql_result($result,0,"idprofile1");
			return $idprofile;
			/* print "<br/>idprofile " . $idprofile . "<br/>"; */
		}
		
		function user($email, $password)
		{
		
			//$email = $_POST['email'];
			//$password = $_POST['password'];
			$idprofile = user_id($email);
			
			$query0="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'password'";
			$result0=mysql_query($query0);
			$num=mysql_numrows($result0);
			$mysql_password = mysql_result($result0,0,"data_value");
			$_SESSION["profile"] = $idprofile;
			$_SESSION["time"]    = time();
			//print "password " . $mysql_password;
			print ($mysql_password != $password) ? invalid_user() :  "";
		}
		
		if(isset($_POST['email']) && isset($_POST['password']))
		{
			$email = $_POST['email'];
			$password = $_POST['password'];
			$idprofile = user_id($email);
		}
		
		/*
		
			Release object-oriented values to run around in the environment
		
		*/
		
		$value = product_count($idprofile);
		$products = session_information($idprofile, $value[0], $value[1]);
		$product = product($products, $value[0]);
		$firstname = firstname($idprofile);
		$lastname = lastname($idprofile);
		$basket = prospective_purchaser($idprofile);
		// $prospective_purchasers_list = $basket[0];
		$wanted = $basket[0];
		$cart = $basket[1];
		$trade_agreement_content = trade_agreement($idprofile);
		$notifications = $trade_agreement_content[0];
		$trade_agreement_management = $trade_agreement_content[1];
		
		/*
			Session information
		*/
		
		
		function firstname($idprofile)
		{
			$query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'firstname'";
			$result=mysql_query($query);
			$num=mysql_numrows($result);
			$firstname = mysql_result($result,0,"data_value");
			//print $firstname;
			return $firstname;
		}
		function lastname($idprofile)
		{
			$query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'lastname'";
			$result=mysql_query($query);
			$num=mysql_numrows($result);
			$lastname = mysql_result($result,0,"data_value");
			return $lastname;
		}
		function product_count($idprofile)
		{
			$query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'product'";
			$result=mysql_query($query);
			$product_count = mysql_numrows($result);
			$values = array();
			array_push($values, $product_count);
			array_push($values, $result);
			return $values;
			//return $product_count;
		}
		//$product_value = product_count($idprofile);
		
		/* Language Translation */
		// function language_translation($phrase, $language)
		function language_translation($language)
		{
			$language_query="SELECT phrase, translation FROM `language_translation` WHERE `language` LIKE '$language'";
			$language_information = mysql_query($language_query);
			$translate = Array();
			while ($row = mysql_fetch_assoc($language_information)) {
				$phrase = $row['phrase'];
				$translation = $row['translation'];
				$translate[$phrase] = $translation;
			}
			return $translate;
		}
		
		/* Currency Converter */
		function currency_converter($from_currency, $to_currency)
		{
			$currency_query="SELECT from_currency_value, to_currency_value FROM `currency_converter` WHERE `from_currency` LIKE '$from_currency' AND `to_currency` LIKE '$to_currency'";
			$currency_information = mysql_query($currency_query);
			$currency = Array();
			while ($row = mysql_fetch_assoc($currency_information)) {
				$from_currency_value = $row['from_currency_value'];
				$to_currency_value = $row['to_currency_value'];
				$currency[$phrase] = $translation;
			}
			return $currency;
		}
		
		function session_information($idprofile, $product_count, $result)
		{	
			
			$product_left = 0;
			$idproduct = Array();
			while($product_left < $product_count)
			{
				array_push($idproduct, mysql_result($result,$product_left,"data_object"));
				$product_left++;
			}
			
			//print_r($idproduct);
			
			//print $idproduct[0];
			$products = array();
			
			
			// for($product_left = 0; $product_left < $product_count;  $product_left++)
			// {
				// $query="SELECT * FROM `product` WHERE `idproduct1` LIKE '$idproduct[$product_left]'";			
				// $p_result=mysql_query($query);
				// $p_num=mysql_numrows($p_result);
				// $start = 0;
				// for($start; $start < $p_num; $start++)
				// {
					// $array_name = mysql_result($p_result,$start,"data_name");
					// $array_value = mysql_result($p_result,$start,"data_value");
					// /* print "$array_name : $array_value <br/>"; */
					// $products[$idproduct[$product_left]][$array_name] = $array_value;
					// /* array_push($product, '$array_name' => $array_value); */
				// }
			// }
			
			//for($product_left = 0; $product_left < $product_count;  $product_left++)
			//{
				$product_left = 0;
				if($product_count == 0)
				{
					$query="SELECT * FROM `product`";
					$p_result=mysql_query($query);
					if($p_result >= 1)
					{
						$p_num=mysql_numrows($p_result);
						$start = 0;
						for($start; $start < $p_num; $start++)
						{
							$array_id = mysql_result($p_result,$start,"idproduct1");
							$array_name = mysql_result($p_result,$start,"data_name");
							$array_value = mysql_result($p_result,$start,"data_value");
							/* print "$array_id : $array_name => $array_value <br/>"; */
							$products[$array_id][$array_name] = $array_value;
							/*array_push($product, '$array_name' => $array_value); */
						}
						foreach($products as $key=> $value)
						{
							//echo $key ."=". $value. "<br/>";
						}
					}
				}
				else
				{
					$query="SELECT * FROM `product` WHERE  ";
					while($product_left < $product_count)
					{
					$query .= "`idproduct1` NOT LIKE '$idproduct[$product_left]'";
						if($product_left+1 < $product_count)
						{
								$query .= " AND ";
						}
					$product_left++;
					}
					$p_result=mysql_query($query);
					if($p_result >= 1)
					{
						$p_num=mysql_numrows($p_result);
						$start = 0;
						for($start; $start < $p_num; $start++)
						{
							$array_id = mysql_result($p_result,$start,"idproduct1");
							$array_name = mysql_result($p_result,$start,"data_name");
							$array_value = mysql_result($p_result,$start,"data_value");
							/* print "$array_name : $array_value <br/>"; */
							$products[$array_id][$array_name] = $array_value;
							/*array_push($product, '$array_name' => $array_value); */
						}
						//print $products;
					}
				}
			return $products;
		}
			
		//}
		
		/*
		
			Tuotetarjonta - Product offering
			
			auto-refreshin yhteydessä vois lähettää realtime-komennon
			receiver.php?showcase=lastupdatetime (aseta noin minuutin viive)
			paluuviestinä sit jokapaikkaan päivitys
		
		*/
		
		function product_offering($idprofile)
		{
			// tuotetarjonta kooste = product selection summary
			$product_selection_summary = Array();

			$product_selection_summary["wanted"] = $wanted;
			$product_selection_summary["change"] = $change;
			$product_selection_summary["auction"] = $auction;
			$product_selection_summary["for_sale"] = $for_sale;
			$product_selection_summary["for_free"] = $for_free;
			
		}
		
		/*
		
			Ostajaehdokkaista ilmoitus
			
		*/
		function prospective_purchaser($idprofile)
		{
		$purchacer_query="SELECT * FROM `profile` WHERE `data_name` LIKE 'a_prospective_purchaser' AND `idprofile1` LIKE '$idprofile' OR `data_value` LIKE '$idprofile'";
		$a_prospective_purchaser_result=mysql_query($purchacer_query);
		$purchaser_num=mysql_numrows($a_prospective_purchaser_result);			
		$purchasers = Array();
		$wanted = Array();
		for($purchaser_count = 0; $purchaser_count < $purchaser_num; $purchaser_count++)
		{
			$purchaser_id = mysql_result($a_prospective_purchaser_result,$purchaser_count,"idprofile1");
			$seller = mysql_result($a_prospective_purchaser_result,$purchaser_count,"data_value");
			$time = mysql_result($a_prospective_purchaser_result,$purchaser_count,"datetime");
			$object_id = mysql_result($a_prospective_purchaser_result,$purchaser_count,"data_object");
			if($idprofile == $purchaser_id)
			{
				$purchasers[$object_id][$purchaser_id]["purchaser_count"] = $purchaser_count;
				$purchacer_query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$purchaser_id'";
				$person_info = mysql_query($purchacer_query);
				$person_num=mysql_numrows($person_info);
				for($go = 0; $go < $person_num; $go++)
				{
					$name = mysql_result($person_info,$go,"data_name");
					$value = mysql_result($person_info,$go,"data_value");
					if($name == "firstname") {$firstname = $value;}
					if($name == "lastname") {$lastname = $value;}
				}
				$purchasers[$object_id][$purchaser_id]["firstname"] = $firstname;
				$purchasers[$object_id][$purchaser_id]["lastname"] = $lastname;
				$purchasers[$object_id][$purchaser_id]["time"] = $time;
			}
			if($idprofile == $seller)
			{
				$wanted[$object_id][$purchaser_id]["purchaser_count"] = $purchaser_count;
				$wanted_query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$seller'";
				$person_info = mysql_query($wanted_query);
				$person_num=mysql_numrows($person_info);
				for($go = 0; $go < $person_num; $go++)
				{
					$name = mysql_result($person_info,$go,"data_name");
					$value = mysql_result($person_info,$go,"data_value");
					if($name == "firstname") {$firstname = $value;}
					if($name == "lastname") {$lastname = $value;}
				}
				$wanted[$object_id][$seller]["firstname"] = $firstname;
				$wanted[$object_id][$seller]["lastname"] = $lastname;
				$wanted[$object_id][$seller]["time"] = $time;
			}
		}
		$cart = "";
		$prospective_purchasers_list = "";
		foreach($purchasers as $object_id => $array)
		{
			// print "0: $object_id => $array<br/>";
			foreach($array as $key => $value)
			{
				// print "0.1 $key => $value<br/>";				
				foreach($value as $subkey => $subvalue)
				{
					// print "0.1.1 $subkey => $subvalue<br/>";
					if($subkey == "firstname") {$firstname = $subvalue;}
					if($subkey == "lastname") {$lastname = $subvalue;}
					if($subkey == "time") {$time = $subvalue;}
					if($subkey == "purchaser_count") {$purchaser_count = $subvalue;}
				}
			}
			$cart .= "<a href=\"object.php?id=$object_id\"><img src=\"\" style=\"width:50px; height: 50px;\" title=\"$object_id ($purchaser_count, $firstname $lastname, $time)\"/></a>";
		}
		// print "STOP <br/>";
		foreach($wanted as $object_id => $array)
		{
			// print "1: $id => $array<br/>";
			foreach($array as $key => $value)
			{
				// print "1.1 \$key: $key => \$value: $value<br/>";
				foreach($value as $subkey => $subvalue)
				{
					// print "1.1.1 $subkey => $subvalue<br/>";
					if($subkey == "firstname") {$firstname = $subvalue;}
					if($subkey == "lastname") {$lastname = $subvalue;}
					if($subkey == "time") {$time = $subvalue;}
					if($subkey == "purchaser_count") {$purchaser_count = $subvalue;}
				}
			}
			$prospective_purchasers_list .= "<a href=\"object.php?id=$object_id\"><img src=\"\" style=\"width:50px; height: 50px;\" title=\"$object_id ($purchaser_count, $firstname $lastname)\"/></a>";
		}
					
			$basket = array();
			array_push($basket, $prospective_purchasers_list);
			array_push($basket, $cart);
		return $basket;
		}
		
		/*
		
			Shop events for selling, confirm, pay and packet send
		
		*/
		
		function trade_agreement($idprofile)
		{
			$query="SELECT * FROM `profile` WHERE `data_name` LIKE 'trade_agreement_valid_status_%' AND `data_value` LIKE '$idprofile'";

			$events=mysql_query($query);
			$events_num=mysql_numrows($events);			
			$event_list = Array();
			for($count = 0; $count < $events_num; $count++)
			{
				$seller_id = mysql_result($events,$count,"idprofile1");
				// $idprofile = mysql_result($events,$count,"data_value");
				$time = mysql_result($events,$count,"datetime");
				$trade_agreement_status = mysql_result($events,$count,"data_name");
				$object_id = mysql_result($events,$count,"data_object");
				// $event_list[$time][$seller_id] = $object_id;
				$event_list[$trade_agreement_status][$time][$seller_id] = $object_id;
			}
			$notification = "";
			foreach($event_list as $trade_agreement_status => $array1)
			{
				$notification .= "Status:  $trade_agreement_status :: <br/>";
				foreach($array1 as $time => $array2)
				{
					foreach($array2 as $seller_id => $object_id)
					{
						$profile_query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$seller_id'";
						$profile_result=mysql_query($profile_query);
						$profile_num=mysql_numrows($profile_result);			
						$profile_list = Array();
						$notification .= "<a href=\"profile.php?id=$seller_id\">";
						for($count1 = 0; $count1 < $profile_num; $count1++)
						{
							$name = mysql_result($profile_result,$count1,"data_name");
							$value = mysql_result($profile_result,$count1,"data_value");
							$profile_list[$name] = $value;
						}
						foreach($profile_list as $key => $value)
						{
							if($key == "firstname") {$notification .= "$value ";}
							if($key == "lastname") {$notification .= "$value";}
						}
						$notification .= "</a> ";
						$notification .= "hyväksyi tarjouksen tuotteesta ";
						
						$object_query="SELECT * FROM `product` WHERE `idproduct1` LIKE '$object_id'";

						$object_result=mysql_query($object_query);
						$object_num=mysql_numrows($object_result);			
						$object_list = Array();
						for($count2 = 0; $count2 < $object_num; $count2++)
						{
							$name = mysql_result($object_result,$count2,"data_name");
							$value = mysql_result($object_result,$count2,"data_value");
							$object_list[$name] = $value;
						}
						$notification .= "<a href=\"object.php?id=$object_id\">";
						foreach($object_list as $key => $value)
						{
							if($key == "manufacturer") {$notification .= "$value ";}
							if($key == "model") {$notification .= "$value";}
						}
						$notification .= "</a> ";
						// $notification .= "<a href=\"javascript:void(0);\"onClick=\"Popup.show(null,null,null,{\'content\':\'This DIV was created dynamically!\',\'width\':200,\'height\':200,\'style\':{\'border\':\'1px solid black\',\'backgroundColor\':\'cyan\'}});return false;\">Maksa tuote</a>";
						// $notification .= "<a href=\"javascript:void(0);\" onClick=\"Popup.show('simplediv');return false\">Maksa tuote</a>";
						$notification .= "<a href=\"javascript:void(0);\" onClick=\"trade_agreement_popup('popup');\">Maksa tuote</a>";
						$notification .= "<div id=\"simplediv\" style=\"background-color:yellow;border:1px solid black;display:none;width:200px;height:200px;\">Click anywhere in the document to auto-close me</div>";
						$notification .= "<hr/>";
					}
				}
			}
		$trade_agreement_notification = Array();
		array_push($trade_agreement_notification, $notification);
		array_push($trade_agreement_notification, $event_list);
		return $trade_agreement_notification;
		}
		
		print "\$notifications: <br/>$notifications";
		// print "<br/><br/>\$trade_agreement_management<br/>$trade_agreement_management";
		// foreach($trade_agreement_management as $class => $array)
		// {
			// $class_count = count($array);
			// print "<br/>$class => $class_count";
		// }
		$trade_agreement_collection = Array("trade_agreement_valid_status_accept_intro_buyer",
											"trade_agreement_valid_status_accept_buyer",
											"trade_agreement_valid_status_confirm_payment",
											"trade_agreement_valid_status_confirm_transfer",
											"trade_agreement_valid_status_confirm_receiving", 
											"trade_agreement_valid_status_confirm_grade");
	$test  =	"<div id=\"popup\" class=\"popup\">";
	$test .=	"<div id=\"popup\" class=\"popup_frame\">";
	$test .=	"<h1 class=\"popup_header\">Trade Agreement</h1>";
	$test .=	"<div>";
	$test .=	"<input type=\"text\" value=\"Search product, property or component\" style=\"width: 300px; height: 25px;\">";
	$test .=	"<input type=\"submit\" value=\"[O--]\" title=\"Etsi\">";
	$test .=	"</div>";
	$test .=	"<ul style=\"padding-left: 20px; border: 1px solid;\">";
	
	// $test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" title=\"5 products waiting your selling\" style=\"text-decoration: none; font-weight: bold;\">Introduction (5)</a></li>";
	// $test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" title=\"3 products waiting your accepting\" style=\"text-decoration: none; font-weight: bold;\">Accepting (3)</a></li>";
	
	/*
	kokeilu, vaikearakenteinen
	foreach($trade_agreement_management as $class => $array)
	{
		$class_count = count($array);
		if($class_count > 0)
		{
			if($class == "trade_agreement_valid_status_accept_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" title=\"3 products waiting your paying\" style=\"text-decoration: none; font-weight: bold;\">Paying ($class_count)</a></li>";
			}
			else
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" title=\"3 products waiting your paying\" style=\"text-decoration: none;\">Paying</a></li>";
			}
		}
	}
	*/
	
	for($complete = 0;$complete < 6; $complete++)
	{
		if(!array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
		{
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_intro_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your interest\" style=\"text-decoration: none;\">Introduction </a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your accepting\" style=\"text-decoration: none;\">Accepting</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_payment")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your paying\" style=\"text-decoration: none;\">Paying</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_transfer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your transforming\" style=\"text-decoration: none;\">Transforming</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_receiving")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your receiving\" style=\"text-decoration: none;\">Receiving</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_grade")
			{
			$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your grade\" style=\"text-decoration: none;\">Grade</a></li>";
			} 
		}
		if(array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
		{
			$class_count = count($trade_agreement_management[$trade_agreement_collection[$complete]]);
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_intro_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your selling\" style=\"text-decoration: none; font-weight: bold;\">Introduction ($class_count)</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your accepting\" style=\"text-decoration: none; font-weight: bold;\">Accepting ($class_count)</li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_payment")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your paying\" style=\"text-decoration: none; font-weight: bold;\">Paying ($class_count)</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_transfer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products is under transforming\" style=\"text-decoration: none; font-weight: bold;\">Transforming ($class_count)</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_receiving")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your receiving\" style=\"text-decoration: none; font-weight: bold;\">Receiving ($class_count)</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_grade")
			{
			$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your receiving\" style=\"text-decoration: none; font-weight: bold;\">Grade ($class_count)</a></li>";
			}
			
		}
	}
	// $test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" title=\"7 products is under transforming\" style=\"text-decoration: none; font-weight: bold;\">Transforming (7)</a></li>";
	// $test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" title=\"3 products waiting your receiving\" style=\"text-decoration: none; font-weight: bold;\">Receiving (3)</a></li>";
	// $test .=	"<li>Grade</li>";
	$test .=	"</ul>";
	$test .= "<div id=\"trade_agreement_content\" class=\"popup_content\">";
	
	$intro  = "Asus P6T myyntiin<br/>";
	$intro .= "Nämä osat kuuluvat mukaan: [list]<br/>";
	$intro .= "Paketti saatavilla kohteesta <a href=\"\">Kierrätyspiste</a> <a href=\"\">Posti</a>: [list]<br/>";
	$intro .= "Myyntialueet: <br/><textarea></textarea><br/>";
	$intro .= "Kohderyhmä: <br/><textarea></textarea><br/>";
	$intro .= "Hinta<br/>";
	
	$sr  =	"<h2>Seurannassa</h2>";
	$sr .=	"<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$sr .=	"<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$sr .=	"Asus P6T <label style=\"float: right;\"><input type=\"checkbox\" /> Seurannassa <a href=\"javascript:void(0);\">Poista</a></label>";
	$sr .=	"<br/>2 minutes ago";
	$sr .=	"<label style=\"float: right;\"><b>Price</b> € 50, <a href=\"\">Maksa</a></label>";
	$sr .=	"</div>";
	
	$sr .=	"<h2>Paying</h2>";
	$sr .=	"<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$sr .=	"<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$sr .=	"Asus P6T <label style=\"float: right;\">Maksettu € 50. <a href=\"\">Ei ole</a></label>";
	$sr .=	"<br/>2 minutes ago";
	$sr .=	"<label style=\"float: right;\">Postin lähetystunnus: <input type=\"text\" name=\"\"><input type=\"submit\" value=\"Lähetä\"></label>";
	$sr .=	"</div>";
	
	$st  =	"<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$st .=	"<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$st .=	"Asus P6T <label style=\"float: right;\">Olet valittu ostajaksi <a href=\"\">Hylkää</a> <a href=\"\">Vapauta 25 muuta kohdetta</a></label>";
	$st .=	"<br/>2 minutes ago";
	$st .=	"<label style=\"float: right;\"><b>Price</b> € 50, <a href=\"\">Maksa</a></label>";
	$st .=	"</div>";
	
	$st .=	"<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$st .=	"<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$st .=	"Asus P6T <label style=\"float: right;\">Maksettu € 50. <a href=\"\">Ei ole</a></label>";
	$st .=	"<br/>2 minutes ago";
	$st .=	"<label style=\"float: right;\">Postin lähetystunnus: <input type=\"text\" name=\"\"><input type=\"submit\" value=\"Lähetä\"></label>";
	$st .=	"</div>";
	
	$st .=	"<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$st .=	"<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$st .=	"Asus P6T <label style=\"float: right;\">Paketti seurannassa, seuraavaksi Helsinki</label>";
	$st .=	"<br/>2 minutes ago";
	$st .=	"<label style=\"float: right;\"><a href=\"\">Seuraa toimitusta</a></label>";
	$st .=	"</div>";
	
	$st .=	"<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$st .=	"<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$st .=	"Asus P6T <label style=\"float: right;\">Posti on saapunut. <a href=\"\">Palauta tavara</a></label>";
	$st .=	"<br/>2 minutes ago";
	$st .=	"<label style=\"float: right;\">Postin lähetystunnus: <input type=\"text\" name=\"\"><input type=\"submit\" value=\"Vahvista vastaanotetuksi\"></label>";
	$st .=	"</div>";
	
	$st .=	"<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$st .=	"<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$st .=	"Asus P6T <label style=\"float: right;\">Tuote käytettävissäsi</label>";
	$st .=	"<br/>2 minutes ago";
	$st .=	"<label style=\"float: right;\">Onko se ok? <input type=\"submit\" value=\"Kyllä\"><input type=\"submit\" value=\"Ei\"></label>";
	$st .=	"</div>";
	
	// $test .= $intro;
	$test .= $sr;
	$test .= "</div>";
	
	
	$test .= "<div id=\"popup\" class=\"popup_footer\">6 000 ostajaehdokasta, 14 maata. ";
	$test .= "<input type=\"submit\" value=\" &times; Sulje\" style=\"float: right;\">";
	$test .= "<input type=\"submit\" value=\"Peruuta\" style=\"float: right;\">";
	$test .= "<input type=\"submit\" value=\"Myyntiin\" style=\"float: right;\">";
	$test .= "</div>";
	$test .= "</div>";
	// $test .= $st;
	// $test .=	"This a vertically and horizontally centered popup.";
	
	$test .=	"</div>";

	// $test .=	"<a onclick=\"showPopup('popup');\">Show Popup</a>";
	// http://www.w3schools.com/cssref/pr_pos_z-index.asp
	// http://www.w3schools.com/css/css_image_transparency.asp
	// http://stackoverflow.com/questions/3202583/how-to-center-align-pop-up-div-using-javascript
	$test .=	"<style type=\"text/css\">
  .popup {
    width:800px;
    height:620px;
    position:fixed;
	z-index: 1;
	opacity: 1;
    top:20%;
    left:25%;
	background-color: #A9A9A9;
    margin:-50px 0 0 -100px; /* [-(height/2)px 0 0 -(width/2)px] */
    display:none;
	
	-webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    -webkit-box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    -moz-box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    box-shadow: -1px -1px 0 rgba(255,255,255,.4);
  }
  .popup_frame{
	opacity:1;
	background-color: #ffffff;
	border: 1px solid;
	height: 585px;
	margin: 15px;
  }
  .popup_content{
	height: 465px;
	/*border: 1px solid;*/
  }
  .popup_footer{
	opacity:1;
	background-color: #CDCDCD;
	padding: 10px;
	border-top: 1px solid;
	height: 20px;
  }
  .popup_header{
	opacity:1;
	background-color:  #000080; /* #191970; */
	
	padding-left: 10px;
	font:   26px Calibri; /* menettelee: 32px Corbel; huonot: 32px Arial Black; 32px Verdana;32px Times New Roman;  32px symbol;  34px Serif; 32px Georgia;*/
	color: #BCD2EE; 	/*	#6E7B8B; #CDAD00;	*/
  }
</style>";

	$test .=	"<script type=\"text/javascript\">
  function trade_agreement_popup(id) {
    var popup = document.getElementById(id);
    popup.style.display = 'block';
  }
</script>";
print $test;
		
		// $de_query ="DELETE FROM `profile` WHERE `data_name` LIKE 'trading_accept_buyer'";
		// $de_query = "UPDATE profile SET `data_name`='trade_agreement_ex_status_confirm_receiving' WHERE `datetime`='2012-07-29 23:15:46' AND `data_object`='3iEYA9dBb3'";
		// mysql_query($de_query);
		
		function product($products, $product_count)
		{
			$product = '';
			$i = 0;
			$size = count($products);
			$product .="<div id=\"content\" style=\"width: 795px; border: 1px solid;height: 200px;\">";
			if($product_count == 0)
			{
				// foreach($products as $key => $value)
				// {
				// $manufacturer = $products[$key]["manufacturer"];
				// $model = $products[$key]["model"];
				// $product .= "<div style=\"margin:10;width:160px;float: left;\"><a href=\"object.php?id=$key\"><img src=\"\" width=\"150px\" height=\"150px\">$manufacturer $model</a></div>";
				// }
			}
			else
			{
				foreach($products as $key => $value)
				{
					if(!array_key_exists("room", $products[$key]))
					{
					$manufacturer = $products[$key]["manufacturer"];
					$model = $products[$key]["model"];
					$product .= "<div style=\"margin:10;width:160px;float: left;\"><a href=\"object.php?id=$key\"><img src=\"\" width=\"150px\" height=\"150px\">$manufacturer $model</a></div>";
					}
				$i++;
				}
			}
			$product .="</div>";
		return $product;
		}
		


if(!empty($_GET['productmanufacturer']) && !empty($_GET['productmodel']) && !empty($_GET['productyear']))
{
	$manufacturer = $_GET['productmanufacturer'];
	$model = $_GET['productmodel'];
	$year = $_GET['productyear'];
	//$query="SELECT * FROM account";
	//$statistics=mysql_query($query);

	//$num=mysql_numrows($statistics);
	//$query="SELECT accountid FROM account";
	function unit_id()
	{ # http://www.lost-in-code.com/programming/php-code/php-random-string-with-numbers-and-letters/
		$length = 10;
		$characters = "_-0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; #63
		$string = "";
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		$query = "SELECT idproduct1 FROM product WHERE idproduct1 LIKE '%$string%'";
		$found = mysql_query($query);
		if($found == $string)
		{
			unit_id();
		}
	else	
		return $string;
	}

	$product_id = unit_id();
	$query = "INSERT INTO profile VALUES ('$idprofile', NOW(), 'product', 'owner','$product_id','','Only Me')";
	mysql_query($query);
	$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'manufacturer', '$manufacturer','','','')";
	mysql_query($query);
	$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'model', '$model','','','')";
	mysql_query($query);
	$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'year', '$year','','','')";
	// if($image)
	// {
		// $query = "INSERT INTO product VALUES ('$multimedia_id', '', 'picture', '$id','','','')";
	// }
	
		
	mysql_query($query);
}		

	if(!empty($_GET['delete_product']))
	{
		$delete_product = $_GET['delete_product'];
		$count_items = count($delete_product);
		$c = 0;
		while($c < $count_items)
		{
		$query = "DELETE FROM product WHERE productid LIKE $delete_product[$c]";
		mysql_query($query);
		//print  $delete_product[$c] . "deleted";
		$c++;
		}
	}


function item_list()
{
	$query="SELECT item FROM `product_info`";
	$result=mysql_query($query);
	// $num=mysql_numrows($result);	
	$item_list ="";
	while ($row = mysql_fetch_assoc($result)) {
		$item = $row['item'];
		$item_list .= "<label class=\"interest\"><input type=\"checkbox\" />$item</label>";
	}
	return $item_list;
}
$item_list = item_list();
print "<body onresize=\"startup_initial();\" onload=\"startup_initial('$idprofile', '','','');\" onmousemove=\"monitor('$idprofile', '')\">";	
$explorer = "<style type=\"text/css\">
<!--
a 
{
	text-decoration:none;
}
a:hover
{
	text-decoration:underline;
}
#welcome_navigation
{
	overflow:auto;
}

input.welcome_content
{
	float:right;
}

li.navigation
{
	float: left;
	background-color: lightblue;
	border: 1px solid;
	font: 24px Lucida Sans Unicode;
}
#alacarte ul
{
	width:180px;
	padding-left: 20px;
}
#notification_content h4
{
	margin-top:0;
	border-top:1px solid;
	border-bottom:1px solid;
	background-color:Bisque;
}
.personal_market_aspect
{
	float:left;
}
div.welcome_content
{
	background-color:LightCyan;
	border-bottom: 1px solid;
	border-top: 1px solid;
	margin: 5;
	padding: 10;
	overflow:auto;
}
.personal_market_aspect
{
	
	padding: 10;
	margin: 2;
	border: 1px dotted;
}
.interest
{
margin: 0 10 0 0;
}
-->
</style>";
$explorer .="<div id=\"cart_popup\" style=\"overflow:auto; position: absolute;z-index: 1; display:none;border: 1px solid; width: 350px;background-color: #ffffff;\">
		<!--<h1 style=\"font: 12px Arial; font-weight:bold; border-bottom:1px solid;\">Cart</h1>-->
		<div id=\"notification_content\"></div>
		<div id=\"notification_bottom\" style=\"border-top:1px solid;text-align: center;\"><a href=\"\">View All</a></div>
		</div>";
$explorer .="
<div id=\"header\" style=\"background-color: #0000CC; height: 35px;margin: 0px; padding: 0px;\"> <!-- background-color:#3579DC;-->";
$explorer .= "<div id=\"navigation\" style=\"position: relative;left:10%;width: 1500px;\">";
$explorer .= "<a href=\"showcase.php\" onclick=\"\" style=\"color: #FFFFFF; text-decoration: none; font-weight: bold;\">Shopstream</a>" ;
$explorer .= "<input id=\"search_utility\" onKeyUp=\"search_utility();\" type=\"text\" name=\"search\" style=\"margin:5 0 0 150; height: 25px\" size=\"40px\" />
<input type=\"submit\" name=\"uutuudet\" value=\" [Tuo] \" style=\"margin: 2 0 0 0;padding:0;width:40px;height:25px;\"/>"; // search-margin: 5 0 0 8.5%

$explorer .= "<span style=\"float: right;margin-right: 200px;margin-top: 10px;font: 12px verdana;font-weight: bold;  \">";
$explorer .= "<a href=\"object.php\" onclick=\"\" style=\"color: #c0c0cc;text-decoration: none;\">";
$explorer .= $firstname. " " .$lastname;
$explorer .= "</a>";
$explorer .= "&nbsp;&nbsp;";
$explorer .= "<a href=\"logout.php\" style=\"color: #FFFFFF; text-decoration: none; font-weight: bold;\">Log out</a>";
$explorer .= "</span>";
$explorer .= "</div>";
$explorer .= "</div>";
print $explorer;


$navi = "
<div id=\"classification\" style=\"width: 200px;float: left;left: 10%; position:relative;\">
<img src=\"\" style=\"height: 50px; width: 50px;float:left;\">
<a href=\"profile.php\" style=\"font-weight: bold;\">$firstname $lastname</a><br/>
<a href=\"security.php\" style=\"\">Security</a>
<div id=\"alacarte\">
<h4 style=\"margin-top: 30px;\">FAVORITES</h4>
<ul>
<li class=\"alacarte_option\"><a href=\"showcase.php\">Shopstream</a></li>
<li class=\"alacarte_option\"><a href=\"showcase.php\">Market Flow</a></li>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement_popup('popup');\">Trade Agreement</a></li>
<li class=\"alacarte_option\"><a href=\"storage.php\">Bookkeeping</a></li>
</ul>
<h4>LOCATIONS</h4>
<ul>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Keittiö')\">Keittiö</a></li>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Makuuhuone')\">Makuuhuone</a></li>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'WC')\">WC</a></li>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Takkahuone')\">Takkahuone</a></li>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Varasto')\">Varasto</a></li>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Kuisti')\">Kuisti</a></li>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Parveke')\">Parveke</a></li>
</ul>
<h4>SERVICES</h4>
<ul>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Keittiö')\">Sähkö</a></li>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Makuuhuone')\">Puhelin- &amp; Internet</a></li>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Makuuhuone')\">Vakuutus</a></li>
<li class=\"alacarte_option\"><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Makuuhuone')\">Decoration</a></li>
</ul>
</div>
</div>
";

$head = "<div id=\"main\" style=\"width: 800px;\" onmouseover=\"testi12();\">"; /* border: 1px solid; */
$head .= "<h1>Welcome to the Stuffwalk</h1>";
//$head .= "<!-- · Ajoneuvot (muut kategoriat + suodatinvaihtoehdot)--> · <a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'marketflow')\">Update</a><br/>";
$head .="<span style=\"color: #000000;text-align: left;padding-left: 10px;text: 12px bold;width: 250px;float: left;\">";
$head .="<b>Getting Started</b>";
$head .="</span>";
$head .= "<div style=\"color: #000000;text-align: right;padding-right: 20px;background-color: #c0c0c0;text: 12px bold;\">Settings</div>";

$head .= "<div id=\"shopstream_content\">"; /* keywords: function baby_monitor & economyflow */ 



//$head .= "<h3>Add information about you &raquo; Your Contact &raquo; Your Interests</h3>";
$head .="<div id=\"welcome_navigation\">";
$head .= "<li id=\"welcome_content_basic_information_menu\" class=\"navigation\"><a href=\"javascript:void(0);\" onclick=\"getting_started('welcome_content_basic_information');\">Basic Information<!-- about you--></a></li>";
$head .= "<li id=\"welcome_content_contact_menu\" class=\"navigation\"><a href=\"javascript:void(0);\" onclick=\"getting_started('welcome_content_contact');\">Contact</a></li>";
$head .= "<li id=\"welcome_content_interest_menu\" class=\"navigation\"><a href=\"javascript:void(0);\" onclick=\"getting_started('welcome_content_interest');\">Your Interests</a></li>";
$head .="</div>";


$head .="<div id=\"welcome_content\">";
//$head .="Mindfuck: ";
$head .="<div id=\"mindfuck\">";
$head .="</div>";

$head .="<div id=\"welcome_content_basic_information\">";
//$head .= "<h4>Add information about you</h4>";
$head .= "<div class=\"welcome_content\">";
$head .= "Photo of you <input type=\"file\">";
$head .="</div>";

$head .= "<div class=\"welcome_content\" id=\"personal_market_aspect\">";
$head .= "Your marketing <!--level--> aspect<br/><br/>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">The previewer</label></div>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Active until friends recommends</label></div>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">The slowest person</label></div>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Hate evolution/technology</label></div>";
$head .="</div>";

$head .= "<div class=\"welcome_content\" id=\"personal_championship_aspect\">";
$head .= "Your championship <!--level--> aspect<br/><br/>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Like championship</label></div>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Everything should be enough</label></div>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Like donate stuff</label></div>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Like exchange stuff</label></div>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Collector</label></div>";
$head .="</div>";

$head .= "<div class=\"welcome_content\" id=\"personal_some_aspect\">";
$head .= "Your some <!--level--> aspect<br/><br/>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Experimentalist/bitch</label></div>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Purposeful</label></div>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Fluctuations in the desire of</label></div>";
$head .="<div  class=\"personal_market_aspect\"><label><input type=\"checkbox\" value=\"OKOYFIHH\">Religion/devoted/domestic</label></div>";
$head .="</div>";
$head .= "<input class=\"welcome_content\" type=\"submit\" value=\"Continue\" onclick=\"getting_started('welcome_content_contact');\">";

$head .="</div>";

$head .="<div id=\"welcome_content_contact\">";
$head .= "<div class=\"welcome_content\">";
$head .= "Post address <br/> Address near you <input type=\"text\" value=\"address\"><br/>";
$head .= "Post address <input type=\"text\" value=\"post address\"><br/>";
$head .= "Post domain <input type=\"text\" value=\"post domain\"><br/>";
$head .= "The packet will delivery for you by your post address";
$head .="</div>";
$head .= "<div class=\"welcome_content\">";
$head .= "<!--Direct location--> Current location <input type=\"text\"><br/>";
$head .= "Market are scoped by direct location";
$head .="</div>";
$head .= "<div class=\"welcome_content\">";
$head .= "Your bank account / credit card<br/>";
$head .="Bank ID: <input type=\"text\" value=\"OKOYFIHH\"> Your bank account number: <input type=\"text\" value=\"ABC-123\"><br/>";
$head .="Credit card: <input type=\"text\" value=\"OKOYFIHH\"> Expiration date: <input type=\"calendar\">";
$head .="</div>";
$head .= "<input class=\"welcome_content\" type=\"submit\" value=\"Continue\" onclick=\"getting_started('welcome_content_interest');\">";

$head .="</div>";

$head .="<div id=\"welcome_content_interest\">";
$head .= "<div class=\"welcome_content\">";
//$head .= "<h4>Tell Something About Your Interests</h4>";
$head .= "(Tämän listan saa kun valitsee kaikki ITEMit tuotelistalta)<br/>";
$head .= "$item_list<br/>";

$head .="</div>";

$head .= "<hr style=\"margin:30 0 -10 0;\"/>";
$head .= "<span style=\"background-color:#ffffff;\">TAI</span>";
$head .= "<h4>Lisää tuote</h4>";
$head .= "<input class=\"welcome_content\" type=\"submit\" value=\"I'm ready\">";
$head .="</div>";

$head .="</div>";

$head .= "<!--";
$head .= "(Tämä on malli)<br/>";
$head .= "<label class=\"interest\"><input type=\"checkbox\" /> Vehicles</label>";
$head .= "<label class=\"interest\"><input type=\"checkbox\" /> Furniture</label>";
$head .= "<label class=\"interest\"><input type=\"checkbox\" /> Clothes</label>";
$head .= "<label class=\"interest\"><input type=\"checkbox\" /> Music Instruments</label>";
$head .= "<label class=\"interest\"><input type=\"checkbox\" /> Cleaning up</label>";
$head .= "<label class=\"interest\"><input type=\"checkbox\" /> Books</label>";
$head .= "<label class=\"interest\"><input type=\"checkbox\" /> Vessel</label>";
$head .= "-->";
$head .= "</div>"; 
$head .= "</div>";
$head .= "</div>";

$column  = "<div id=\"right\" style=\"width: 300px;float: right;padding-top: 10px;\">";
$column .= "<h1 class=\"element-spotlightrightpanel\">Upcoming Notices</h1> <!-- Ilmoitukset -->";
$column .= "<ul style=\"margin-left: 20px;\">";
$column .= "<li><a href=\"\">Invite</a> your favorite organization.</li>";
$column .= "<li><a href=\"\" style=\"text-decoration: none; font-weight: bold;\">3 assets need confirm</a></li>";
$column .= "<li><a href=\"\" style=\"text-decoration: none; font-weight: bold;\">Vuokramaksu</a> ja <a href=\"\" style=\"text-decoration: none; font-weight: bold;\">4 other transcations</a></li>";
$column .= "</ul>";
$column .= "<h1 class=\"element-spotlightrightpanel\">Cart</h1> <!-- Ostoskori -->";
$column .= "<div id=\"cart\">$cart</div>";
$column .= "<h1 class=\"element-spotlightrightpanel\">Compare</h1> <!-- Vertailu -->";
$column .= "<h1 class=\"element-spotlightrightpanel\">Wanted</h1> <!-- Halutaan -->";
$column .= "$wanted";
$column .= "<h1 class=\"element-spotlightrightpanel\">Change</h1> <!-- Vaihdetaan -->";
$column .= "<h1 class=\"element-spotlightrightpanel\">Auction</h1> <!-- Huutokauppa -->";
$column .= "<h1 class=\"element-spotlightrightpanel\">For Sale</h1> <!-- Myydään -->";
$column .= "<div id=\"for_sale\"></div> <!-- Myydään -->";
$column .= "<h1 class=\"element-spotlightrightpanel\">For Free</h1> <!-- Ilmaiseksi -->";
$column .= "</div>";



$mainwindow  = $navi;
$mainwindow .= "<div id=\"mainwindow\" style=\"border: 1px solid;width: 1110px;float: left;position: relative;left:10%;overflow: auto;\">";
$mainwindow .= $column;
$mainwindow .= $head;
$mainwindow .= "</div>";
print $mainwindow;

?>

<script type="text/javascript">

function baby_monitor(profile, category)
{
	var profile = profile;
	var category = category;
	var url = "receiver.php";
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		// itkuhälytin = baby monitor
		// http://www.ozzu.com/programming-forum/ajax-multiple-responses-with-one-request-t89454.html
		var baby_monitor = xmlhttp.responseText.split("\r\n"); // pick a data from url
		// var baby_monitor = xmlhttp.responseText; // pick a data from url
		//document.getElementById("test").value="1: "+baby_monitor[0]+"<br/>"; // pick a data from url
		// document.getElementById("most_used").innerHTML =baby_monitor+"<br/>"; // pick a data from url
		document.getElementById("shopstream_content").innerHTML =baby_monitor[0]; // pick a data from url
		document.getElementById("for_sale").innerHTML =baby_monitor[1]; // pick a data from url
		//document.getElementById("test").innerHTML ="2: "+baby_monitor[1]+"<br/>"; // pick a data from url
		}
	}
	//data="data="+data;
	data="baby_monitor_for="+profile+"&category_filter="+category;
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
}

function trade_agreement(profile, view)
{
	var profile = profile;
	var view = view;
	var url = "receiver.php";
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		// itkuhälytin = baby monitor
		// http://www.ozzu.com/programming-forum/ajax-multiple-responses-with-one-request-t89454.html
		document.getElementById("trade_agreement_content").innerHTML = xmlhttp.responseText; // pick a data from url
		}
	}
	//data="data="+data;
	data="trade_agreement_view="+view+"&profile_id="+profile;
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
}

function confirm_event(event_status, seller_id, buyer_id, product_id)
{
	var event_status = event_status;
	var seller_id = seller_id;
	var buyer_id = buyer_id;
	var product_id = product_id;
	var url = "receiver.php";
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		// itkuhälytin = baby monitor
		// http://www.ozzu.com/programming-forum/ajax-multiple-responses-with-one-request-t89454.html
		var response = xmlhttp.responseText.split("\r\n"); // pick a data from url
		// document.write(xmlhttp.responseText);
		//document.getElementById("product_details").value=baby_monitor; // pick a data from url
			
		}
	}
	//data="data="+data;
	data="event_status="+event_status+"&buyer_id="+buyer_id+"&seller_id="+seller_id+"&product_id="+product_id;
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
}


function add_cart(profile, strange_profile, product)
{
	var profile = profile;
	var seller = strange_profile;
	var product = product;
	var url = "receiver.php";
	// document.write("profile: "+profile+"ja product ="+product+"ja seller ="+seller);
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		// itkuhälytin = baby monitor
		// http://www.ozzu.com/programming-forum/ajax-multiple-responses-with-one-request-t89454.html
		//var baby_monitor = xmlhttp.responseText.split("\r\n"); // pick a data from url
		var cart = xmlhttp.responseText; // pick a data from url
		//document.getElementById("test").value="1: "+baby_monitor[0]+"<br/>"; // pick a data from url
		// document.getElementById("most_used").innerHTML =baby_monitor+"<br/>"; // pick a data from url
		document.getElementById("cart").innerHTML =cart; // pick a data from url
		//document.getElementById("test").innerHTML ="2: "+baby_monitor[1]+"<br/>"; // pick a data from url
		}
	}
	//data="data="+data;
	data="add_cart="+product+"&profile_id="+profile+"&seller_id="+seller;
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
}

/*
var productClass={	//Class1:"Ajoneuvot",
					Class2:"Pukeutuminen",
					Class3:"Koti",
					Class6:"Terveys",
					Class7:"Taide",
					//Class8:"Kirjallisuus ja taide",
					//Class9:"Elokuvat ja musiikki",
					Class10:"Matkustus",
					Class11:"Miljöö",
					};
*/					
// var productClass={	Class1:"Uutuudet",
					// Class2:"Tarjotaan",
					// Class3:"Halutaan",
					// Class4:"Ilmaiseksi",
					// Class5:"Vaihdetaan",
					// Class6:"Huutokauppa",
					// };
					
	var topic_list = '';
	var market_categories  = "";
		market_categories += "ROOMS";
		market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'Keittiö')\">Keittiö</a></li>";
		market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'Makuuhuone')\">Makuuhuone</a></li>";
		market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'WC')\">WC</a></li>";
		market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'Takkahuone')\">Takkahuone</a></li>";
		market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'Varasto')\">Varasto</a></li>";
		market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'Kuisti')\">Kuisti</a></li>";
		market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'Parveke')\">Parveke</a></li>";
		market_categories += "<br/>";
		
		// market_categories += "CATEGORIES";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'milieu')\">Milieu</a></li>";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'art')\">Art</a></li>";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'travel')\">Travel</a></li>";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'electric')\">Electric</a></li>";
		// market_categories += "<br/>";
		// market_categories += "GROUPS";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'koas')\">KOAS</a></li>";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'university_of_jyvaskyla')\">University of Jyväskylä</a></li>";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'aalto_university')\">Aalto-university</a></li>";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'jimms')\">Jimm's PC-store</a></li>";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'apple')\">Apple</a></li>";
		// market_categories += "<a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'other_groups')\">More >></a>";
		// market_categories += "<br/>";
		// market_categories += "LOCATIONS";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'jyväskylä')\">Jyväskylä</a></li>";
		// market_categories += "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'oulu')\">Oulu</a></li>";
		
	topic_list  ="<div class=\"element-spotlightcontainer\" id=\"\" style=\"height: 475px;\" onclick=\"fillAd('')\"><p class=\"empty\" style=\"float:left;\">";
	var idprofile = "<?php print $idprofile; ?>";
	topic_list +="<b><a href=\"javascript:void(0);\" onClick=\"baby_monitor('"+idprofile+"', 'marketflow')\">Passion Flow</a></b></p><div id=\"\" style=\"width: 180px;margin: 75 0 0 -80; float: left; \">"+market_categories+"</div><div id=\"economyflow\" class=\"subCategory\" style=\"border-left: 1px solid;margin-left: 200px;height: 470px;margin-top: 3px;\"> </div></div>";
	// for(topic in productClass)
	// {
		// var theme=productClass[topic];
		// var result=1;
		
		// if(result==0)
		// {
			// topic_list+="<a class=\"element-spotlightcontainer\" onclick=\"view('"+theme+"')\"><p><input type=\"image\" src=\"PSSWCO090P000020.jpg\" width=\"40px\" height=\"40px\" style=\"border: 1px solid;\" />					</p>					<p class=\"productclass\">"+theme+"</p>					</a>";
		// }
		// else
		// {
			// topic_list+="<div class=\"element-spotlightcontainer\" id=\""+theme+"\" style=\"height: 75px;\" onclick=\"fillAd('"+theme+"')\"><p class=\"empty\" style=\"float:left;\"><b>"+theme+"</b></p><div id=\"\" style=\"width: 180px;margin: 75 0 0 -60; float: left; \">"+market_categories+"</div><div id=\"most_used\" class=\"subCategory\" style=\"border-left: 1px solid;margin-left: 200px;height: 70px;margin-top: 3px;\"><div class=\"more\" style=\" width: 50px;padding-top: 5px; \"><a onClick=\"expandShoppingCategory('"+theme+"')\"><img src=\"\" style=\"height: 45px; width: 45px;\">Lisää</a></div> </div></div>";
		// }
	// }
	// document.getElementById("producttopic").innerHTML=topic_list;
	
	
/**
	Valittaessa tyhjä tuotekategoria tai lisää ilmoitus, avataan täyttölomake.
	Tämä pyritään tietokannan kasvaessa automatisoimaan siten, että kun tulee tietoo merkki/malli, aletaan tarjoamaan jo valmisvaihtoehtoa.
**/	
function fillAd(theme)
{
	switch(theme)
	{
	
		case "Ajoneuvot ja kulkuvälineet (estetty)":
			
			var variables ={v1:"Valmistenumero", v2:"Merkki", v3:"Malli", v4:"Polttoainekulutus", v5:"Ovien lkm", v6:"Väri", v7:"Rekisteriote", var8: "image", var8:"imagedesc"};
			var adItems ='';
			/**
				the Stepper menu of future
			**/
			adItems+="<div id=\"cloneOption\">";
			adItems+="<a href=\"\">Shipshop</a>";
			adItems+= " > <a href=\"#Fictitious\" onmouseover=\"c_show('PopupMenu1',event,'targetX','targetY+targetH')\" onmouseout=\"c_hide()\">"+theme+"</a> ";
			adItems+= " > <a href=\"#Fictitious\" onmouseover=\"c_show('PopupMenu2',event,'targetX','targetY+targetH')\" onmouseout=\"c_hide()\">Mitsubishi Lancer</a> ";
			//aditems+= "<a href=\"\" onclick=\"otheravailableoffers(currentselected)\">shipshop</a>";
			//aditems+= " > <a href=\"\" onclick=\"otheravailableoffers("+theme+")\">"+theme+"</a> ";
			adItems+="<a type=\"submit\" onClick=\"dynamicDataProcessing('receiver.php', '1')\" value=\"Pick data up\" >P u d</a>";
			adItems+="</div>";
			/**
			adItems+="<div id=\"cascadeNavigation\"><input type=\"submit\" value=\"Lisää (nuoli alas)\" onClick=\"cascadeNavigation(openCloneOption)\">";
			adItems+="<input type=\"submit\" value=\"Tallenna tietokoneellesi\">";
			adItems+="<input type=\"submit\" value=\"Lisää\" onClick=\"fillAnotherAd()\">";
			adItems+="<input type=\"submit\" value=\"Esikatsele\"></div>";
			adItems+="<div id=\"cloneOption\">";
			adItems+="<input type=\"submit\" value=\"^\" onClick=\"productCount(100)\">";
			adItems+="<input type=\"submit\" value=\"^\" onClick=\"productCount(10)\">";
			adItems+="<input type=\"submit\" value=\"^\" onClick=\"productCount(1)\"><br/>";
			adItems+="<input type=\"text\" value=\"1\" id=\"productCount\" name=\"\" size=\"12\"><br/>";
			adItems+="<input type=\"submit\" value=\"^\" onClick=\"productCount('-100')\">";
			adItems+="<input type=\"submit\" value=\"^\" onClick=\"productCount('-10')\">";
			adItems+="<input type=\"submit\" value=\"^\" onClick=\"productCount('-1')\">";
			adItems+="<a type=\"submit\" onClick=\"dynamicDataProcessing('receiver.php', '1')\" value=\"Pick data up\" >P u d</a>";
			adItems+="</div>"; **/
			adItems+="<div class=\"element-spotlightcontainer-ad\" id=\"1\">";
			adItems+="<input type=\"checkbox\" name=\"checkbox\" onClick=\"Select[]\">"+theme;
			
			//adItems+="<a class=\"editor\" href=\"\" title=\"Poista &amp; Palaa takaisin\">&times;</a>";
			//adItems+="<input type=\"file\" />";
			
			adItems+="<table>";
			var x=1;
			/**
				to onmouseover popup,
				use this one: http://www.dynamicdrive.com/dynamicindex5/popinfo2.htm
				and http://www.google.com/search?q=javascript+bobble&rls=com.microsoft:fi&ie=UTF-8&oe=UTF-8&startIndex=&startPage=1#pq=javascript+click+notification&hl=fi&sugexp=pfwc&cp=26&gs_id=3e&xhr=t&q=javascript+onmouseover+popup&pf=p&sclient=psy&rls=com.microsoft:fi&source=hp&pbx=1&oq=javascript+onmouseover+pop&aq=0&aqi=g1&aql=f&gs_sm=&gs_upl=&bav=on.2,or.r_gc.r_pw.&fp=ca0c7975afa3fe20&biw=1190&bih=830
			**/
			for (unit in variables)
			{
				adItems+="<tr><td>"+variables[unit]+"("+x+"): </td><td><input type=\"text\" name=\""+variables[unit]+"\" size=\"40\" id=\""+x+"\"></td><td><a href=\"\" title=\"Poista tieto\">&times;</a></td></tr>";
				x++;
			};
			adItems+="</table>";
			adItems+="</div>";
			/** add products **/
			adItems+="<div class=\"element-spotlightcontainer-ad\" id=\"1\">";
			adItems+="<div id=\"productCountMeter\" style=\"float: left; border: 1px solid; width: 205px; height: 125px;padding-top: 125px;\">";
			adItems+="Count of products<br/> <input type=\"input\" name=\"productCount\"\">";
			adItems+="</div>";
			adItems+="<div id=\"productType\" style=\"float: left; border: 1px solid; width: 205px; height: 250px;\">";
			adItems+="<li style=\"border-bottom: 1px solid;\"><a name=\"productType\" value=\"\"\">Samaa tuotetta<br/>Mitsubishi Lancer GLX 1.5</a></li>";
			adItems+="<li style=\"border-bottom: 1px solid;\"><a name=\"productType\" value=\"\"\">Eri tuotetta, samaa kategoriaa<br/>"+theme+"</a></li>";
			adItems+="<li style=\"border-bottom: 1px solid;\"><a name=\"productType\" value=\"Eri tuote, eri kategoriassa\"\">Eri tuote, eri kategoriassa<br/>Muu kuin "+theme+"</a></li>";
			adItems+="</div>";	
			adItems+="<div id=\"\" style=\"clear: both; text-align: center;border-top: 1px solid; font: 16px verdana;\">";
			adItems+="Add more products";
	
			adItems+="</div>";		
			adItems+="</div>";
			document.getElementById("producttopic").innerHTML=adItems;
			
		break;
		case "Ajoneuvot ja kulkuvälineet":
			adItems="<a href=\"\">Takaisin</a>";		
			adItems+="<h1>Vehicles</h1>";		
			adItems+="<fieldset><legend>Autot</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Moottoripyörät</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Kevytmoottoripyörät</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Mopot ja skootterit</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Polkupyörät</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Veneet</legend>";
			adItems+="</fieldset>";
			document.getElementById("producttopic").innerHTML=adItems;
		//document.write(theme); 
		break;
		case "Muoti ja pukeutuminen":
			adItems="<a href=\"\">Takaisin</a>";		
			adItems+="<h1>Muoti ja pukeutuminen</h1>";		
			adItems+="<fieldset><legend>Miesten pukeutuminen</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Naisten pukeutuminen</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Lasten pukeutuminen</legend>";
			adItems+="</fieldset>";
			document.getElementById("producttopic").innerHTML=adItems;
			break;
		case "Koti//":
			adItems="<a href=\"\">Takaisin</a>";		
			adItems+="<h1>Asunto ja palvelut</h1>";		
			adItems+="<fieldset><legend>Palveluntarjoajat</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Maanurakointi ja remontointi</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Sisustus ja kalustaminen</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Kartat</legend>";
			adItems+="</fieldset>";
			document.getElementById("producttopic").innerHTML=adItems;
			break;
		case "Puutarha ja kasvillisuus":
			adItems="<a href=\"\">Takaisin</a>";		
			adItems+="<h1>Puutarha ja kasvillisuus</h1>";		
			adItems+="<fieldset><legend>Istutettava kasvillisuus</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Työkalut</legend>";
			adItems+="</fieldset>";
			document.getElementById("producttopic").innerHTML=adItems;
			break;
		//case "Kirjallisuus":document.write(theme); break;
		case "Sisustus ja kalustaminen":
			adItems="<a href=\"\">Takaisin</a>";		
			adItems+="<h1>Sisustus ja kalustaminen</h1>";		
			adItems+="<fieldset><legend>Huonekalut</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Seinäkoristeet</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Valaisimet</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Matot</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Koriste-esineet</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Viihde-elektroniikka</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Kodinkoneet</legend>";
			adItems+="</fieldset>";
			document.getElementById("producttopic").innerHTML=adItems;
			break;
		case "Taide//":
			adItems="<a href=\"\">Takaisin</a>";		
			adItems+="<h1>Taide</h1>";		
			adItems+="<fieldset><legend>Kuvataiteet</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Elokuva- ja mediataiteet</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Taideteollisuus ja taiteellinen suunnittelu</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Käsityötaiteet</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Musiikki</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Kirjallisuus (sanataiteet)</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Tanssitaiteet</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Teatteri- eli näyttämötaiteet</legend>";
			adItems+="</fieldset>";
			document.getElementById("producttopic").innerHTML=adItems;
			break;
		case "Terveys ja elämäntavat":document.write(theme); break;
		//case "Musiikki ja taide":document.write(theme); break;
		case "Miljöö//":
			adItems="<a href=\"\">Takaisin</a>";		
			adItems+="<h1>Miljöö</h1>";		
			adItems+="<fieldset><legend>Metsä</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Eläimet</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Kunnossapito</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Puutarha ja kasvillisuus</legend>";
			adItems+="</fieldset>";
			document.getElementById("producttopic").innerHTML=adItems;
			break;
		case "Matkustus//":
			adItems="<a href=\"\">Takaisin</a>";		
			adItems+="<h1>Matkustus</h1>";		
			adItems+="<fieldset><legend>Ajoneuvot</legend>";
			adItems+="</fieldset>";
			adItems+="<fieldset><legend>Matkailukohteet</legend>";
			adItems+="</fieldset>";
			document.getElementById("producttopic").innerHTML=adItems;
			break;
	}
}
</script>
<?php
print "<script type=\"text/javascript\">
function expandShoppingCategory(theme)
{
		//document.write(\"<a href=\"\">Takaisin</a><br/>\");
		for(topic in productClass)
		{
			var themee=productClass[topic];
			var level = document.getElementById(\"producttopic\");
			var hiddenTopic = document.getElementById(themee);
			//document.write(\"Current theme: \"+theme+\", \");
			//document.write(\"and find: \"+hiddenTopic+\"<br/>\");
			if(theme != themee)
			{
				hiddenTopic.style.visibility = \"hidden\";
				level.removeChild(hiddenTopic);
			}
		}
		var handler = document.getElementById(theme);
		var classHandler = document.getElementById(\"most_used\");
		handler.style.height = 500+\"px\";
		classHandler.style.height = 475+\"px\";
		classHandler.style.padding = 10+\"px\";
		
		var prospective_purchasers_list = \"" . str_replace("\\\\\"","\\\"",str_replace("\"", "\\\"", $wanted)) . "\";
		adItems  = \"<h3>Most recent</h3>\";
		adItems += \"<div id=\\\"economyflow\\\"></div>\";
		adItems += prospective_purchasers_list;
		classHandler.innerHTML=adItems;
		// document.getElementById(\"producttopic\").innerHTML=adItems;
}
</script>";
?>
<script type="text/javascript">
function expandCategory(theme)
{
		//document.write("<a href=\"\">Takaisin</a><br/>");
		for(topic in productClass)
		{
			var themee=productClass[topic];
			var level = document.getElementById("producttopic");
			var hiddenTopic = document.getElementById(themee);
			//document.write("Current theme: "+theme+", ");
			//document.write("and find: "+hiddenTopic+"<br/>");
			if(theme != themee)
			{
				hiddenTopic.style.visibility = "hidden";
				level.removeChild(hiddenTopic);
			}
		}
		var handler = document.getElementById(theme);
		var classHandler = document.getElementById("most_used");
		handler.style.height = 500+"px";
		classHandler.style.height = 475+"px";
		classHandler.style.padding = 10+"px";
		
		/*
			Pääluokitukset
			Most used
			In storage
			Unknown for you
		*/
		adItems  = "<h3>Most used</h3>";
		adItems += "<a onClick=\"expandCategory('"+theme+"')\"><img src=\"\" style=\"height: 45px; width: 45px;\">Lisää</a>";
		adItems += "<h3>In Storage</h3>";
		adItems += "<h3>Unknown items</h3>";
		classHandler.innerHTML=adItems;
		// document.getElementById("producttopic").innerHTML=adItems;
}	
	
</script>
</body>