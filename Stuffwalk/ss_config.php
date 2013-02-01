<?php
// http://php.net/manual/en/language.namespaces.basics.php
namespace Shopstream;
/*
http://php.net/manual/en/language.oop5.basic.php

tee harjoitustietokanta screw up (tyriä), missä voi treenata uusia toimintoja.
http://php.net/manual/en/function.session-start.php

tämä sopii tarkistamaan, että voiko vaikka tarjota jotain (arvosanat, testit, pätevyys)
http://www.php.net/manual/en/function.count-chars.php
http://www.php.net/manual/en/session.security.php
http://php.net/manual/en/function.session-cache-expire.php

tuotteen lisäys -kohtaan (storage.php) eli Add object... voi lisätä mitä vaan.
Tontti, kiinteistö/rakennus, huone, tavara.
Tietokantaan lisättävä tätä varten type_of_object, mikä määrittelee edellämainitun.
Myös valinnat Public | Customers | Private.

Etusivulle herätteeksi 
#1 "parhaat tarjoukset" lajiteltuna
* huutokauppa
* annetaan
* myydään
* >>>> nämä sen mukaan mitä alussa on kerrottu omista intresseistä

*/
session_cache_limiter('private');
session_cache_expire(365*24*60*60);
//if (!isset($_SESSION)) 
//{
  session_start();
//}
/* database communication */
// print session_cache_expire();

// Connect to database

$dbhost = 'ip_address:3306'; /* host */ $dbuser = 'username'; /* your username created */ $dbpass = 'password';//'password'; //the password 4 that user
#$dbhost = 'localhost'; /* host */ $dbuser = 'root'; /* your username created */ $dbpass = '';//'password'; //the password 4 that user

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'shipshop';
mysql_select_db($dbname);//your database.
/*
	Delete items
	http://dev.mysql.com/doc/refman/5.6/en/delete.html
*/
// $query="SELECT * FROM account WHERE email='$email'";
// $result=mysql_query($query);
// $i = 0;
// $accountid = mysql_result($result,$i,"accountid");
/*
function invalid_user()
{
		header('Location: http://130.234.191.97:62592/xampp/Shopstream/');
		// print "Nyt meni joku pieleen!";
}
*/

// elseif(isset($_POST['email']) && isset($_POST['password']))
// {
	// $email = $_POST['email'];
	// $password = $_POST['password'];
	// $idprofile = user_id($email);
// }


if(isset($_SESSION["stuffwalk_profile"]) && !empty($_SESSION["stuffwalk_profile"]))// && !isset($_POST["email"]) && !isset($_POST["password"]))
{
	$test  =  "<!--\r\n<code>";
	$test .=  "Refresh";
	$idprofile = $_SESSION["stuffwalk_profile"];
	$test .=  " idprofile: " .$idprofile . "\r\n";
	// http://php.net/manual/en/function.setcookie.php
	if (isset($_COOKIE)) {
    foreach ($_COOKIE as $name => $value) {
        $name = htmlspecialchars($name);
        $value = htmlspecialchars($value);
        $test .= "$name : $value \r\n";
    	}
	}
	/*
	print "<br/>\$_SESSION[\"stuffwalk_profile\"] = " . $_SESSION["stuffwalk_profile"];
	print "<br/>\$_SESSION[\"stuffwalk_time\"] = " . $_SESSION["stuffwalk_time"];
	print "<br/>\$_SESSION[\"stuffwalk_hashtag\"] = " . $_SESSION["stuffwalk_hashtag"];*/
}
else 
//elseif(!isset($_SESSION["stuffwalk_profile"]) && empty($_SESSION["stuffwalk_profile"]) && isset($_POST["email"]) && isset($_POST["password"]))
{
	$idprofile = user($_POST["email"], $_POST["password"]);
	print "Initial";
	print  " idprofile: " .$idprofile . "<br/>";
	if (isset($_COOKIE)) {
    foreach ($_COOKIE as $name => $value) {
        $name = htmlspecialchars($name);
        $value = htmlspecialchars($value);
        echo "$name : $value <br />\n";
    	}
	}
	print_r($_COOKIE);
	/*
	print "<br/>\$_SESSION[\"stuffwalk_profile\"] = " . $_SESSION["stuffwalk_profile"];
	print "<br/>\$_SESSION[\"stuffwalk_time\"] = " . $_SESSION["stuffwalk_time"];
	print "<br/>\$_SESSION[\"stuffwalk_hashtag\"] = " . $_SESSION["stuffwalk_hashtag"];
	print "<br/>\session_module_name = " . session_module_name();*/
}
/*
else
{
	invalid_user();
}*/

/*
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
*/

function authentication($email, $password)
{
	$email = str_replace("'","\'",str_replace('"','\"',$email));
	$password = str_replace("'","\'",str_replace('"','\"',$password));
	$result1=mysql_query("SHOW COLUMNS FROM `account_info`");
	if (!$result1) {
	    echo 'Could not run query: ' . mysql_error();
	    exit;
	}
	$columns = Array();
	if (mysql_num_rows($result1) > 0) {
	    while ($row = mysql_fetch_assoc($result1)) {
	        array_push($columns, $row);// $row['Field']);
	    }
	}
	foreach( $columns as $je => $jo){	$fields[] = $jo["Field"];	}
	
	
	$result=mysql_query("SELECT * FROM `account_info` WHERE `email`='$email' AND `password` LIKE '$password'");
	if (mysql_numrows($result)==0)
	{
		
	}
	else 
	{
		$row = mysql_fetch_assoc($result);
		//if(empty($_SESSION["stuffwalk_profile"]))
		//{
		$_SESSION["stuffwalk_profile"] = $row['idprofile1'];
		$_SESSION["stuffwalk_language"] = $row['language_in_usage'];
		$_SESSION["stuffwalk_currency"] = $row['currency_in_usage'];
		$_SESSION["stuffwalk_time"]    = time();
		//$_SESSION["stuffwalk_hashtag"] = "97ny897ny78YN877f5f9gN7HN";
		setcookie("stuffwalk_profile_id",$idprofile,time()+3600*24);
		//}
		return $idprofile;
	}
	
	
	// print "password " . $mysql_password;
	// print ($mysql_password != $password) ? invalid_user() :  "";
	//print ($mysql_password != $password) ? "What happens?" :  "";
}

function user_id($email)
{
	
	/*if($email == "")
	{
		// print "tööt3";
		invalid_user();
	}*/
	$email = str_replace("'","\'",str_replace('"','\"',$email));
	$query="SELECT * FROM `profile` WHERE data_value LIKE '$email'"; // WHERE data-value='$email'";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	if($num == 0)
	{
		// print "tööt4";
		// invalid_user();
	}
	$idprofile = mysql_result($result,0,"idprofile1");
	// $_SESSION["profile"] = $idprofile;
	return $idprofile;
	/* print "<br/>idprofile " . $idprofile . "<br/>"; */
}

function user($email, $password)
{

	//$email = $_POST['email'];
	//$password = $_POST['password'];
	$idprofile = user_id($email);
	// if($idprofile == "")
	// {
		// invalid_user();
	// }
	$query0="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'password'";
	$result0=mysql_query($query0);
	$num=mysql_numrows($result0);
	$mysql_password = mysql_result($result0,0,"data_value");
	if(empty($_SESSION["stuffwalk_profile"]))
	{
		$_SESSION["stuffwalk_profile"] = $idprofile;
		$_SESSION["stuffwalk_time"]    = time();
		$_SESSION["stuffwalk_hashtag"] = "97ny897ny78YN877f5f9gN7HN";
		setcookie("stuffwalk_profile_id",$idprofile,time()+3600*24);
	}
	// print "password " . $mysql_password;
	// print ($mysql_password != $password) ? invalid_user() :  "";
	print ($mysql_password != $password) ? "What happens?" :  "";
	return $idprofile;
}

/* tietokannan taulu/

$result = mysql_query("SHOW COLUMNS FROM product_info");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$columns = Array();
if (mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_assoc($result)) {
        array_push($columns, $row);// $row['Field']);
    }
}
print "<table>";
foreach( $columns as $je => $jo)
{
	print "<tr>";
	print $jo["Field"];
	foreach( $jo as $jp => $jq)
	{
		print "<td>[ $jp => $jq ]</td>";
	}
	//print "$je => $jo ";
	//print " <br/>";
	print "</tr>";
}
print "</table>";

*/

/*

	Release object-oriented values to run around in the environment

*/
function release_main_values($idprofile)
{
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
	
	$market_content = marketflow($idprofile);
	$cart_status = cart_status($idprofile);
	$cart_shortcut = $cart_status[0];
	$popup_cart_content = $cart_status[1];
	return $k = array($products, $product, $firstname, $lastname, $wanted, $cart, $trade_agreement_content, $notifications,$trade_agreement_management, $market_content, $cart_status, $cart_shortcut, $popup_cart_content);
}

list($products, $product, $firstname, $lastname, $wanted, $cart, $trade_agreement_content, $notifications,$trade_agreement_management, $market_content, $cart_status, $cart_shortcut, $popup_cart_content) = release_main_values($idprofile);

class Marketfeed
{
	 static function head($popup_cart_content,$idprofile,$cart_shortcut,$market_content)
	{
		$head = "<div id=\"main\" style=\"width: 800px;\">"; /* border: 1px solid; */
		$head .= "<div id=\"cart_popup\" style=\"overflow:auto; position: absolute;z-index: 1; display:none;border: 1px solid; width: 250px;background-color: #ffffff;top: 15%; left: 0%;\">
		<h1 style=\"font: 12px Arial; font-weight:bold; border-bottom:1px solid;\">Cart</h1>
		<div id=\"notification_content\">$popup_cart_content</div>
		<div id=\"notification_bottom\" style=\"border-top:1px solid;text-align: center;\"><a href=\"\">View All</a></div>
		</div>";
		// $head .= "<h1><img src=\"\" title=\"Click, to change from public to private\" style=\"width:25px;height: 25px;\">Uutuudet</h1>";
		$head .= "<h1>Markkinavirtaus</h1>";
		//$head .= "<h1><img src=\"\" title=\"Click, to change from public to private\" style=\"width:25px;height: 25px;\">Myydään > " . $products[$idproduct[1]]["manufacturer"] . " " . $products[$idproduct[1]]["model"] . "</h1>";
		$head .= "<!-- · Ajoneuvot (muut kategoriat + suodatinvaihtoehdot)--> · <a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'marketflow')\">Update</a><span id=\"cart_content\"> · $cart_shortcut</span><br/>";
		/* #A4D3EE - ruma sinisävy */
		//$head .="<div style=\"color: #000000;text-align: left;padding-left: 20px;text: 12px bold;width: 250px;float: left;\"><input type=\"checkbox\"><input type=\"button\" value=\"Valitse\"> · Toimenpide</div>";
		// $head .="<span style=\"color: #000000;text-align: left;padding-left: 10px;text: 12px bold;width: 250px;float: left;\"><b>Location</b> <!--<input type=\"button\" id=\"fillad\" value=\"Lisää tavara\" onClick=\"view()\" /> --></span>";
		/*
		$head .="<span style=\"color: #000000;text-align: left;padding-left: 10px;text: 12px bold;width: 250px;float: left;\">";
		$head .="<select name=\"\">";
		$head .="<option value=\"\">Kaikki</option>";
		$head .="<option value=\"\"></option>";
		$head .="</select></span>";
		$head .= "<div style=\"color: #000000;text-align: right;padding-right: 20px;background-color: #c0c0c0;text: 12px bold;\">Global · In Finland · In Jyväskylä · Custom</div>";
		*/
		function item_list()
		{
			$query="SELECT item FROM `product_info`";
			$result=mysql_query($query);
			// $num=mysql_numrows($result);	
			$item_list ="";
			while ($row = mysql_fetch_assoc($result)) {
				$item = $row['item'];
				$item_list .= "<label class=\"interest\" style=\"padding: 0 5;\"><input type=\"checkbox\"/>$item</label>";
			}
			return $item_list;
		}
		$item_list = item_list();
		$head .= "<div id=\"management_viewer_popup\" style=\"position: absolute;z-index: 1; display:none;border: 1px solid; width: 350px; max-height:250px;overflow:auto;background-color: #ffffff;top: 24%; left: 40%;\">";
		$head .= "<h3>Management</h3>";
		$head .= "<select>";
		$head .= "<option>Available</option>";
		$head .= "<option>In use</option>";
		$head .= "</select>";
		$head .= "<input type=\"text\" size=\"30\" value=\"Search...\"/>";
		// $head .= "<div style=\"height:100px;\">$item_list</div>";
		$head .= "<div>$item_list</div>";
		
		$head .= "<h3>Locations</h3>";
		$head .= "<select>";
		$head .= "<option>Blocked</option>";
		$head .= "<option>Allowed</option>";
		$head .= "</select>";
		$head .= "<input type=\"text\" size=\"40\" value=\"Search...\"/>";
		// $head .= "<div style=\"height:100px;\">$item_list</div>";
		$head .= "<div>$item_list</div>";
		
		$head .= "<h3>Networks</h3>";
		$head .= "<select>";
		$head .= "<option>Blocked (Black list)</option>";
		$head .= "<option>Tracking (Grey list)</option>";
		$head .= "<option>Allowed (White list)</option>";
		$head .= "</select>";
		$head .= "<input type=\"text\" size=\"30\" value=\"Search...\"/>";
		// $head .= "<div style=\"height:100px;\">$item_list</div>";
		$head .= "<div>$item_list</div>";
		
		$head .= "<h3>Profiles</h3>";
		$head .= "<select>";
		$head .= "<option>Blocked (Black list)</option>";
		$head .= "<option>Tracking (Grey list)</option>";
		$head .= "<option>Allowed (White list)</option>";
		$head .= "</select>";
		$head .= "<input type=\"text\" size=\"30\" value=\"Search...\"/>";
		// $head .= "<div style=\"height:100px;\">$item_list</div>";
		$head .= "<div>$item_list</div>";
		
		// $head .= "<a href=\"\" onclick=\"start_menu('management_viewer','hidden');\">Sulje</a>";
		$head .= "<input type=\"button\" onclick=\"start_menu('management_viewer','hidden');\" value=\"Done\" style=\"background-color: blue; color: white;font-weight:bold;float:right;\">";
		$head .= "</div>";
		$head .= "<hr style=\"margin: 15 0 -17 0;\"/><a href=\"javascript:void(0);\" onclick=\"start_menu('management_viewer','view');\"><img src=\"SS_Design/settings_icon2.png\" style=\"background-color:#ffffff;margin-left: 715px;padding: 2;\" title=\"Management\"></a>";
		$head .= "<div id=\"economyflow\">$market_content<!--Content--></div>";
		$head .= "</div>";
		$head .= "</div>";
		return $head;
	}
	static function column($cart, $wanted){
		$column  = "<div id=\"right\" style=\"width: 300px;float: right;padding-top: 10px;\">";
		$column .= "<h1 class=\"element-spotlightrightpanel\">Upcoming Notices</h1> <!-- Ilmoitukset -->";
		$column .= "<ul style=\"margin-left: 20px;\">";
		$column .= "<li><a href=\"\">Invite</a> your favorite organization.</li>";
		$column .= "<li><a href=\"\" style=\"text-decoration: none; font-weight: bold;\">3 assets need confirm</a></li>";
		$column .= "<li><a href=\"\" style=\"text-decoration: none; font-weight: bold;\">Vuokramaksu</a> ja <a href=\"\" style=\"text-decoration: none; font-weight: bold;\">4 other transcations</a></li>";
		/*
		$column .= "<li>[Ajoneuvo] katsastusaika on [Aika].</li>";
		$column .= "<li>[Tuote] takuuaika päättyy [Aika].</li>";
		$column .= "<li>[Asunto] vuokramaksu viimeistään [Aika].</li>";
		*/
		$column .= "</ul>";
		// $column .= "<h1 class=\"element-spotlightrightpanel\">Outgoing Transfers</h1> <!-- Lähtevät tilaukset -->";
		// $column .= "<h1 class=\"element-spotlightrightpanel\">Ingoing Transfers</h1> <!-- Saapuvat tilaukset -->";
		//$column .= "<h1 class=\"element-spotlightrightpanel\">Transfers</h1> <!-- Tilaukset -->";
		$column .= "<h1 class=\"element-spotlightrightpanel\">Voit olla kiinnostunut</h1> <!-- Uudet kiinnostukset / You May Interested -->";
		$column .= "<h1 class=\"element-spotlightrightpanel\">Cart</h1> <!-- Ostoskori -->";
		$column .= "<div id=\"cart\">$cart</div>";
		/*
		$column .= "<h1 class=\"element-spotlightrightpanel\">Compare</h1> <!-- Vertailu -->";
		*/
		$column .= "<h1 class=\"element-spotlightrightpanel\">Rooms</h1> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Kitchen\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Bedroom\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"WC\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Living room with fire place\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Living room\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Cell\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Storage\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Balcony\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Veranda\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		
		$column .= "<h1 class=\"element-spotlightrightpanel\">Trade</h1> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Change\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Wanted\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"Auction\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"For Sale\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		$column .= "<img src=\"\" title=\"For Free\" style=\"width:50px;height:50px;\"> <!-- Vaihdetaan -->";
		/*
		$column .= "<h1 class=\"element-spotlightrightpanel\">Change</h1> <!-- Vaihdetaan -->";
		$column .= "<h1 class=\"element-spotlightrightpanel\">Wanted</h1> <!-- Halutaan -->";
		$column .= "$wanted";
		// $column .= "<h1 class=\"element-spotlightrightpanel\">Benefits</h1> <!-- Asiakasedut -->";
		// $column .= "<h1 class=\"element-spotlightrightpanel\">Pre-ordered</h1> <!-- Ennakkotilatut -->";
		$column .= "<h1 class=\"element-spotlightrightpanel\">Auction</h1> <!-- Huutokauppa -->";
		$column .= "<h1 class=\"element-spotlightrightpanel\">For Sale</h1> <!-- Myydään -->";
		$column .= "<div id=\"for_sale\"></div> <!-- Myydään -->";
		$column .= "<h1 class=\"element-spotlightrightpanel\">For Free</h1> <!-- Ilmaiseksi -->";
		*/
		$column .= "</div>";
		return $column;
	}
	static function navigation($idprofile, $firstname, $lastname)
	{
		$navi  = "<div id=\"classification\" style=\"width: 200px;margin-top: 20px;float: left;left: 10%; position:relative;\">";
		$navi .= "<img src=\"\" style=\"height: 50px; width: 50px;float:left;\">";
		$navi .= "<a href=\"profile.php\" style=\"font-weight: bold;\">$firstname $lastname</a><br/>";
		$navi .= "<a href=\"security.php\" style=\"\">Security</a>";
		$navi .= "<h4 style=\"margin-top: 30px;\">FAVORITES</h4>";
		$navi .= "<ul style=\"width:180px;padding-left: 20px;\">";
		$navi .= "<li style=\"\"><a href=\"shopstream.php\">Shopstream</a></li>";
		$navi .= "<li style=\"background-color: #D3D3D3;font-weight: bold;\"><a href=\"showcase.php\">Market Flow</a></li>";
		$navi .= "<li style=\"\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement_popup('popup', 'open');\">Exchange</a></li>";
		//$navi .= "<li style=\"\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement_popup('popup', 'open');\">Trade Agreement</a></li>";
		$navi .= "<li style=\"\"><a href=\"storage.php\">Bookkeeping</a></li>";
		$navi .= "</ul>";
		$navi .= "<h4>NETWORKS</h4>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Keittiö')\">University of Jkl</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Keittiö')\">Jyväskylä</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Keittiö')\">KOAS</a></li>";
		/*
		$navi .= "<h4>LOCATIONS</h4>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Keittiö')\">Keittiö</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Makuuhuone')\">Makuuhuone</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'WC')\">WC</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Takkahuone')\">Takkahuone</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Varasto')\">Varasto</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Kuisti')\">Kuisti</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Parveke')\">Parveke</a></li>";
		*/
		$navi .= "<h4>SERVICES</h4>";
		$navi .= "<ul style=\"width:180px;padding-left: 20px;\">";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Keittiö')\">Sähkö</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Makuuhuone')\">Puhelin- &amp; Internet</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Makuuhuone')\">Vakuutus</a></li>";
		$navi .= "<li><a href=\"javascript:void(0);\" onClick=\"baby_monitor('$idprofile', 'Makuuhuone')\">Decoration</a></li>";
		$navi .= "</ul>";
		$navi .= "</div>";
		return $navi;
	}
	static function Window($meta, $explorer, $navigation, $head, $column)
	{
	$mainwindow  = $meta;
	$mainwindow .= $explorer;
	$mainwindow .= $navigation;
	$mainwindow .= "<div id=\"mainwindow\" style=\"border-left:1px solid; border-bottom:1px solid; border-right:1px solid; width: 1110px;float: left;position: relative;left:10%;overflow: auto;\">";
	$mainwindow .= $column;
	$mainwindow .= $head;
	$mainwindow .= "</div>";

	print $mainwindow;
	} 
}

class Bookkeeping
{
	function navigation($favorites)
	{
		$navi  = "<div id=\"navigation\" style=\"width: 200px;margin:0;float: left;left: 10%; position:relative;\">";
		$navi .= "<!--<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">-->";
		$navi .= "<h4>FAVORITES</h4>";
		$navi .= "<ul style=\"padding-left: 20px;\">";
		$navi .= "<li><a href=\"showcase.php\" style=\"text-decoration: none;\">Shopping</a></li>";
		$navi .= "<li><a href=\"profile.php\" style=\"text-decoration: none;\">Trade Agreement</a></li>";
		$navi .= "<li style=\"width:180px;background-color: #D3D3D3;font-weight: bold;\"><a href=\"storage.php\" style=\"text-decoration: none;\">Bookkeeping</a></li>";
		$navi .= "</ul>";
		$navi .= "<!--";
		$navi .= "<div class=\"menu\" style=\"width:180px;padding-left: 20px;\"><a href=\"showcase.php\" style=\"text-decoration: none;\">Shopping</a></div>";
		$navi .= "<div class=\"menu\" style=\"width:180px;padding-left: 20px;\"><a href=\"profile.php\" style=\"text-decoration: none;\">Trade Agreement</a></div>";
		$navi .= "<div class=\"menu\" style=\"width:180px;padding-left: 20px;background-color: #D3D3D3;font-weight: bold;\"><a href=\"storage.php\" style=\"text-decoration: none;\">Storage</a></div></div>";
		$navi .= "-->";
		// $navi .= "$favorites";
		$navi .= "<h4>EXCHANGE</h4>";
		$navi .= "<ul style=\"padding-left: 20px;\">";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">Income</a></li>";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">Outcome</a></li>";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">Need Action</a></li>";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\" title=\"Update Information\">Needs Update</a></li>";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">Post-Exchange</a></li>";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">Complete</a></li>";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">Incomplete</a></li>";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">Active</a></li>";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">InActive</a></li>";
		$navi .= "</ul>";
		$navi .= "<h4>INTEREST</h4>";
		$navi .= "<ul style=\"padding-left: 20px;\">";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">Katsotuimmat</a></li>";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">Seuratuimmat</a></li>";
		$navi .= "<li><a href=\"\" style=\"text-decoration: none;\">Käytetyimmät</a></li>";
		$navi .= "<li style=\"width:180px;\"><a href=\"\" style=\"text-decoration: none;\">Jotain2</a></li>";
		$navi .= "</ul>";
		$navi .= "</div>";
		return $navi;
	}
	
	/*
	 * 
	 * Custom navigation in da  storage/invention
	 */
	function head($count_of_my_products,$storage)
	{
		$location_query = " SELECT  property.idproduct1 AS property_id,
									property.manufacturer AS property_manufacturer,
									house.idproduct1 AS house_id,
									house.manufacturer AS house_manufacturer,
									room.idproduct1 AS room_id,
									room.manufacturer AS room_manufacturer,
									stuff.idproduct1 AS stuff_id,
									stuff.manufacturer AS stuff_manufacturer
							FROM 	product_info property,
									product_info house,
									product_info room,
									product_info stuff
							WHERE	house.parent_product=property.idproduct1
							and		room.parent_product=house.idproduct1
							and		stuff.idproduct1='10000000000001'";
							// and		stuff.parent_product=room.idproduct1
		$dii = mysql_query($location_query);
		//print $daa = mysql_num_rows($dii);
		while($row = mysql_fetch_assoc($dii))
		{
			$property_id = $row['property_id'];
			$property_manufacturer = $row['property_manufacturer'];
			$house_id = $row['house_id'];
			$house_manufacturer = $row['house_manufacturer'];
			$room_id = $row['room_id'];
			$room_manufacturer = $row['room_manufacturer'];
			$stuff_id = $row['stuff_id'];
			$stuff_manufacturer = $row['stuff_manufacturer'];
			$d  = "<input type=\"button\" name=\"$property_id\" value=\"$property_manufacturer\">";
			$d .="<input type=\"button\" name=\"$house_id\" value=\"$house_manufacturer\">";
			$d .="<input type=\"button\" name=\"$room_id\" value=\"$room_manufacturer\">";
			$d .="<input type=\"button\" name=\"$stuff_id\" value=\"$stuff_manufacturer\">";
			//print $d;
		}
		if(mysql_num_rows($dii)==0)
		{
			//print $d  = "<input type=\"button\" name=\"\" value=\"Add content\">";
		}
		$head = "<div id=\"main\" style=\"width: 800px;padding-top: 7px;\">";
		$head .= "<h1>Inventaario<!--Kirjanpito--> <span id=\"storage_modify\"></span></h1>"; // Varasto
		$head .="$d <br/>";
		//$head .= "<input type=\"button\" value=\"Helsinki (tontti)\" style=\"font-weight:bold;padding: 0 5;\">";
		//$head .= "<input type=\"button\" value=\"Katajanokka (rakennus)\" style=\"font-weight:bold;padding: 0 5;\"><br/>";
		$head .= " · <a href=\"storage.php\">$count_of_my_products tavaraa</a> · X haluttua kohdetta · Y kohdetta myynnissä · Z vioittunutta kohdetta<br/>";
		$head .= "<form method=\"POST\" enctype=\"multipart/form-data\">";
		$head .= "<div id=\"producttopic\">$storage</div>";
		$head .= "</form>";
		$head .= "</div>";
		return $head;
	}
	function column($cart,$other_places, $favorites)
	{
		$column  = "<div id=\"right\" style=\"width: 300px;float: right;padding-top: 10px;\">";
		$column .= "<h1 class=\"element-spotlightrightpanel\">Upcoming Notices</h1> <!-- Ilmoitukset -->";
		$column .= "[Ajoneuvo] katsastusaika on [Aika].<br/>";
		$column .= "[Tuote] takuuaika päättyy [Aika].<br/>";
		$column .= "[Asunto] vuokramaksu viimeistään [Aika].<br/>";
		/*
		$column .= "<h1 class=\"element-spotlightrightpanel\">Transfers <a href=\"\" style=\"float: right;\">View all</a></h1> <!-- Tilaukset -->";
		$column .= "<span style=\"background-color: #FF0000\">Lähtevä</span><br/>";
		$column .= "<span style=\"background-color: #32CD32\">Saapuva</span><br/>";
		*/
		$column .= "<h1 class=\"element-spotlightrightpanel\">Abandoned</h1> <!-- Hylätyt/kierrätyskeskus/Poistetut -->";
		/*
		$column .= "<h1 class=\"element-spotlightrightpanel\">Cart</h1> <!-- Ostoskori -->";
		$column .= "<h1 class=\"element-spotlightrightpanel\">Compare</h1> <!-- Vertailu -->";
		*/
		$column .= "<h1 class=\"element-spotlightrightpanel\">Wanted</h1> <!-- Halutaan -->";
		$column .= "$cart";
		/*
		$column .= "<h1 class=\"element-spotlightrightpanel\">Includes</h1> <!-- Sisältää -->";
		$column .= "<h1 class=\"element-spotlightrightpanel\">A part of</h1> <!-- Kuuluu johonkin -->";
		$column .= "<h1 class=\"element-spotlightrightpanel\">Compatible with <a href=\"\" style=\"float: right;\">View all</a></h1> <!-- Yhteensopiva -->";
		$column .= "<h1 class=\"element-spotlightrightpanel\">Similar parts with</h1> <!-- Samoja osia kuin -->";
		*/
		$column .= "<h1 class=\"element-spotlightrightpanel\">Rooms</h1> <!-- Tavaroiden sijoitus itellä -->";
		$column .= "$favorites";
		$column .= "<h1 class=\"element-spotlightrightpanel\">Visit in Strangers Rooms</h1> <!-- Tavaroiden sijoitus muilla ihmisillä -->";
		$column .= "$other_places";
		$column .= "</div>";
		return $column;
	}
	
	/**

		LISÄÄ TAVARA / ADD ITEM

	**/

	static function add_product($product, $idprofile, $picture)
	{
		// $product = $_POST['product'];
		$_FILES["picture"] = $picture;
		function int_id()
		{
			$free = mysql_query("SELECT idproduct1 FROM product_info WHERE `use_of` LIKE 'Free'");
			$size = mysql_num_rows($free);
			if($size == 0)
			{
			$result = mysql_query("SELECT * FROM product_info");
			$num_rows  = mysql_num_rows($result);
			$num_rows += 10000000000000;
			return $information = Array("$num_rows", "New");
			}
			else
			{
				while ($row = mysql_fetch_assoc($free)) {
				$idproduct = $row['idproduct1'];
				$confirmation = mysql_query("UPDATE product_info SET `use_of`='Reserved' WHERE `use_of` LIKE 'Free' and `idproduct1`='$idproduct'");
					if(! $confirmation )
					{
					  die('Could not update data: ' . mysql_error());
					}
					else
					{
					// echo "Updated data successfully\n";
					return $information = Array("$idproduct", "Reserved");
					}
				}
			}
		}
		
		function int_multimedia_id()
		{
			$free = mysql_query("SELECT object_id FROM multimedia WHERE `use_of` LIKE 'Free'");
			$size = mysql_num_rows($free);
			if($size == 0)
			{
			$result = mysql_query("SELECT * FROM multimedia");
			$num_rows = mysql_num_rows($result);
			$num_rows += 10000000000000;
			return $information = Array("$num_rows", "New");
			}
			else
			{
				while ($row = mysql_fetch_assoc($free1)) {
				$idproduct = $row['idproduct1'];
				$confirmation = mysql_query("UPDATE multimedia SET `Use_of`='Reserved' WHERE `use_of` LIKE 'Free' and `idproduct1`='$idproduct'");
					if(! $confirmation )
					{
					  die('Could not update data: ' . mysql_error());
					}
					else
					{
					// echo "Updated data successfully\n";
					return $information = Array("$idproduct", "Reserved");
					}
				}
			}
		}
		
		function unit_id()
		{ # http://www.lost-in-code.com/programming/php-code/php-random-string-with-numbers-and-letters/
			$length = 10;
			$characters = "_-0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; #63
			$string = "";
			for ($p = 0; $p < $length; $p++) {
				$string .= $characters[mt_rand(0, strlen($characters)-1)];
			}
			$query = "SELECT idproduct1 FROM product_info WHERE idproduct1 LIKE '%$string%'";
			$found = mysql_query($query);
			//$i=0;		print mysql_result($found,$i,"accountid");
			if($found == $string)
			{
				unit_id();
			}
		else	
			return $string;
		}

		$use_of = $product["use_of"];
		$type_of_object = $product["type_of_object"];
		$item = $product["item"];
		$manufacturer = $product["manufacturer"];
		$model = $product["model"];
		$specification = $product["specification"];
		$vintage_year = $product["vintage_year"];
		$made_in = $product["made_in"];
		$location = $product["location"];
		// $energy_intake = "";
		// $energy_intake = $product["energy_intake"];
		// $energy = "";
		// $energy = $product["energy"];
		// $material = $product["material"];
		$material = "";
		// $design = $product["design"];
		// $design = "";
		$building = $product["building"];
		$room = $product["room"];
		// $picture_name = $product["picture"];
		// $multimedia_id = $product["multimedia_id"];
		// $multimedia_id = "";
		// $use_of_space = $product["use_of_space"];
		// $multimedia = $product["multimedia"];
		if(isset($product["connectors"]))
		{
		$jsonconnectors = $product["connectors"];
		$connectors = json_decode($jsonconnectors, true);
		}
		
		/* for product_unifying_factor table */
		// print "\$idprofile: $idprofile<br/>";
		if(!empty($_SESSION["Stuffwalk_profile"]) && !empty($product))
		{
			print "<b style=\"align:center;\">Kirjaudu sisään uudelleen, Shopstreamille lähetetty ilmoitus virheestä.</b>";
		}
		else
		{
			$product_id = int_id();
			$handler_structure = Array("idproduct1","created_stamp","last_updated","use_of","type_of_object","parent_product","item","manufacturer","model","specification","vintage_year","made_in","location","building","room","length", "width","height","depth","weight","capacity","capacity_unit","diameter","skid_load","color","material","cellural","wireless_connection","in_the_box","environment_status_report","integrated_display","integrated_audio", "integrated_headphones", "video", "camera","photos", "language_support", "mail_attachment_support","connectors","input_output", "external_buttons","external_controls", "sensors", "power","environment_requirements","wheels","transmission","suspension","brake","serialnumber","motornumber","framenumber","default_picture", "age_restriction");
			$empty_attributes = "";
			$db_capacity = count($handler_structure)-15;
			for($h=0;$h < $db_capacity;$h++)
			{
				$empty_attributes .= ",''";
			}
			if($product_id[1] == "New")
			{
			$queryx = "INSERT INTO profile VALUES ('$idprofile', NOW(), 'product', 'owner','$product_id[0]','','Only Me')";
			mysql_query($queryx);
			// print $queryx;
			// $dat = "INSERT INTO product_unifying_factor VALUES ('$product_id[0]',NOW(), NOW(),'$use_of', '$item', '$manufacturer','$model','$specification','$vintage_year','$made_in', '$material','$location', '$building', '$room')";
			// mysql_query($dat);
			
			$daa = "INSERT INTO product_info VALUES ('$product_id[0]',NOW(), NOW(),'$use_of','$type_of_object','', '$item', '$manufacturer','$model','$specification','$vintage_year','$made_in','$location', '$building', '$room' $empty_attributes)";
			// print $daa;
			mysql_query($daa);
			
			if($connectors != null)
			{
				$sound_of_music = "";
				foreach($connectors as $connector)
				{
					$zon = $connector["connector_id"];
					//$connector->{'name'};
					//$connector->{'gender'};
					$san = $connector["count"];
					$sound_of_music .= "(ID #) ".$zon." - kpl: ".$san."<br/>";
					$conn_add = "INSERT INTO connectors_on_product VALUES('$product_id[0]',NOW(),'$zon','$san');";
					mysql_query($conn_add);
					$conn_status = "INSERT INTO connector_status_lookup VALUES('$product_id[0]',NOW(),'$zon','','','');";
					mysql_query($conn_status);
				}
			//print $sound_of_music;
			}	
			
			// print $dat;
			
			}
			else if($product_id[1] == "Reserved")
			{
			$queryx = "INSERT INTO profile VALUES ('$idprofile', NOW(), 'product', 'owner','$product_id[0]','','Only Me')";
			mysql_query($queryx);
			// $dat = "UPDATE product_unifying_factor SET `Use_of`='In_Use', `created_stamp`=NOW(), `updated_stamp`=NOW(), `use_of`='$use_of', `item`='$item', `manufacturer`='$manufacturer', `model`='$model', `specification`='$specification', `vintage_year`='$vintage_year', `made_in`='$made_in', `material`='$material', `location`='$location', `building`='$building', `room`='$room' WHERE `idproduct1`='$product_id[0]'";
			// mysql_query($dat);
			mysql_query("UPDATE product_info SET `created_stamp`=NOW(), `last_updated`=NOW(), `use_of`='$use_of', `type_of_object`='$type_of_object', `item`='$item', `manufacturer`='$manufacturer', `model`='$model', `specification`='$specification', `vintage_year`='$vintage_year', `made_in`='$made_in', `material`='$material', `location`='$location', `building`='$building', `room`='$room' WHERE `idproduct1`='$product_id[0]'");
			// $image = "INSERT INTO multimedia VALUES ('$product_id[0]',NOW(),'$use_of', '$object_id[0].$extension','$object_id[0]', '$object_type', '$object_size', '$object_quality','$description','$album_name','$default_picture','$geometry_location')";
			// mysql_query($image);
			}
			
			if($connectors != null)
			{
				$sound_of_music = "";
				foreach($connectors as $connector)
				{
					$zon = $connector["connector_id"];
					//$connector->{'name'};
					//$connector->{'gender'};
					$san = $connector["count"];
					$sound_of_music .= "(ID #) ".$zon." - kpl: ".$san."<br/>";
					$conn_add = "INSERT INTO connectors_on_product VALUES('$product_id[0]',NOW(),'$zon','$san');";
					mysql_query($conn_add);
					$conn_status = "INSERT INTO connector_status_lookup VALUES('$product_id[0]',NOW(),'$zon','','','');";
					mysql_query($conn_status);
				}
			//print $sound_of_music;
			}	
			
			if(isset($_FILES["picture"]) && $_FILES["picture"]["size"] > 0)
			{
				$object_id = int_multimedia_id();
				// print "\$object_id = $object_id<br/>";
				// print "result ". $object_id[0] . " " .  $object_id[1];
				
				$allowedExts = array("jpg","JPG", "jpeg", "gif", "png");
				// print  $_FILES["picture"]["name"] . "<br/>";
				// print  $_FILES["picture"]["type"] . "<br/>";
				// print  $_FILES["picture"]["size"] . "<br/>";
				// $extension = end(explode(".", $_FILES["picture"]["name"]));
				list($name , $extension) = explode(".", $_FILES["picture"]["name"]);
				// print $extension;
				if ((($_FILES["picture"]["type"] == "image/gif")
				|| ($_FILES["picture"]["type"] == "image/jpeg")
				|| ($_FILES["picture"]["type"] == "image/pjpeg"))
				&& ($_FILES["picture"]["size"] < 100000000)
				&& in_array($extension, $allowedExts))
				  {
				  if ($_FILES["picture"]["error"] > 0)
					{
					echo "<b style=\"align:center;\">Kuvansiirto karkasi lapasesta (VahinkoilmoitusN:o " . $_FILES["file"]["error"] . "), yritähän uudelleen</b>>";
					}
				  else
					{
					// echo "Upload: " . $_FILES["file"]["name"] . "<br />";
					// echo "Type: " . $_FILES["file"]["type"] . "<br />";
					$object_type = $_FILES["picture"]["type"];
					// echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
					$object_size = ($_FILES["picture"]["size"] / 1024);
					// echo "Temp file: " . $_FILES["picture"]["tmp_name"] . "<br />";

					// if (file_exists("upload/" . $_FILES["file"]["name"]))
					  // {
					  // echo $_FILES["file"]["name"] . " already exists. ";
					  // }
					// else
					  // {
					  move_uploaded_file($_FILES["picture"]["tmp_name"],
					  // "upload/" . $_FILES["file"]["name"]);
					  "upload/" . $product_id[0] . "." . $object_id[0] . "." . strtolower($extension));
					  // echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
					  // }
					  $object_quality = "";
					  $description = "";
					  $album_name = "Default Album";
					  $default_picture = 1;
					  $geometry_location = "";
					  
						$image = "INSERT INTO multimedia VALUES ('$product_id[0]',NOW(),'$use_of', '$object_id[0].$extension','$object_id[0]', '$object_type', '$object_size','$object_quality','$description','$album_name','$default_picture','$geometry_location')";
						mysql_query($image);
						$default_picture = "UPDATE product_info SET `default_picture`='$product_id[0].$object_id[0].$extension' WHERE `idproduct1`='$product_id[0]'";
						mysql_query($default_picture);
					// print $image;
					}
				}
				else
				{
				  echo "Invalid file";
				}
			}
			// print "product id: $product_id<br/>";
			// print "\$idprofile: $idprofile<br/>";
			// print $product_id[1];
		}
		
		// $abandoned_data = "UPDATE product_unifying_factor SET `use_of`='Free' WHERE `idproduct`='$product_id'";
		// $police_department_data = "UPDATE product_unifying_factor SET `use_of`='Prisoner' WHERE `idproduct`='$product_id'";
		// $recycle_data = "SELECT id_product1 FROM product_unifying_factor WHERE `use_of`='Free'";
		
		/* for product table */
		/*
		$product_id = unit_id();
		$query = "INSERT INTO profile VALUES ('$idprofile', NOW(), 'product', 'owner','$product_id','','Only Me')";
		mysql_query($query);
		$category_data = "INSERT INTO product VALUES ('$product_id', NOW(), 'category', '$category','','','Only Me')";
		mysql_query($category_data);
		$product_type_data = "INSERT INTO product VALUES ('$product_id', NOW(), 'product_type', '$product_type','','','Only Me')";
		mysql_query($product_type_data);
		*/
		//print "product info<br/>";
		
		/*
		foreach($product as $key => $value)
		{
			// print "$key => $value<br/>";
			$query = "INSERT INTO product VALUES ('$product_id', NOW(), '$key', '$value','','','')";
			mysql_query($query);
		}*/
		
		
		if(isset($_GET["fault"])) $fault  = $_GET['fault'] ;
		if(isset($_GET["property"])) 
		{
		$property  = $_GET['property'] ;
		print "cat: " . $_GET["category"] . "<br/>"; // Miljöö
		if($_GET["category"] == "Miljöö")
		{
			foreach($property as $poor => $room)
			{
				$room_id = unit_id();
				print "$poor => $room <br/>";
				$query = "INSERT INTO product VALUES ('$room_id', NOW(), 'room', '$room','$product_id','','Only Me')";
				mysql_query($query);
			}
			}
		}
		//print "connector info<br/>";
		
		/*
			ILMOITUS:
			tietokantaan pitää tallentaa connector-tiedot jotenkin muodossa
			PS/2 Mouse Port (SS), Mouse (Wikipedia), female (SS, uros vai naaras)
			LGA1155 Socket (SS), <jotain> (Wiki), <jotain> (SS, u/n)
		*/
		
		// testaa tää kohta eka printaamalla, että tulee huoneet näkyviin, sit vasta tietokantaan ajo :)
		/*
		if($_GET["category"] == "Miljöö")
		{
			$con = 0;
			foreach($property as $key => $value)
			{
				$room_id = unit_id();
				//print "$key => $value<br/>";
				//$conn_name = "conn".$key;
				//$query = "INSERT INTO product VALUES ('$product_id', NOW(), '$conn_name', '$value','','','')";
				$query = "INSERT INTO product VALUES ('$room_id', NOW(), 'room', '$value','$product_id','','')";
				//print $key. " => " . $value;
				// foreach($value  as $key2 => $value2)
				// {
					// print $key2. " => " . $value2;
					// $conn_name = "conn".$key2;
					//$query = "INSERT INTO product VALUES ('$product_id', NOW(), '$conn_name', '$value2','','','')";
					//mysql_query($query);
				// }
				mysql_query($query);
				$con++;
			}
		}*/
		if(isset($_GET["connector"])) 
		{
			$connector = $_GET['connector'];
			$con = 0;
			foreach($connector as $key => $value)
			{
				print "$key => $value<br/>";
				
				$conn_name = "conn".$key;
				$query = "INSERT INTO product VALUES ('$product_id', NOW(), '$conn_name', '$value','','','')";
				mysql_query($query);
				$con++;
			}
		}
	}
	/**
	
		DELETE ITEM / POISTA TAVARA
	
	**/
		
	static function delete_product($delete)
	{
		foreach($delete as $key => $value)
		{
			if($value == "&times;" || $value == "×")
			{
				//print "$key => $value<br/>";
				unset($delete[$key]);
			}
		}
		//print "<br/>";
		foreach($delete as $key => $value)
		{
			// print "$key => $value<br/>";
			// print "$key => $value <br/>";
			// $to_product="DELETE FROM product WHERE idproduct1 = '$value'";
			// print $to_product . "<br/>";
			// mysql_query($to_product);
			
			//$to_product="UPDATE product_unifying_factor SET `Use_of`='Free' WHERE idproduct1 = '$value'";
			$to_product="UPDATE product_info SET `use_of`='Free' WHERE `idproduct1` = '$value'";
			// print $to_product . "<br/>";
			mysql_query($to_product);
			
			// Voisi ilmoittaa huoneen poiston yhteydessä, että tavarat siirtyy pois huoneesta eli ovat ilman tilaa.
			// $to_refer="DELETE FROM product WHERE data_object = '$value'";
			// print $to_refer . "<br/>";
			// mysql_query($to_refer);
			
			$to_profile="DELETE FROM profile WHERE `data_object` = '$value'";
			// print $to_profile . "<br/>";
			mysql_query($to_profile);
			// kuvat pois
			mysql_query("DELETE FROM multimedia WHERE `idproduct1`='$value'");
			// kytkentöjen tiedot poies
			mysql_query("DELETE FROM connectors_on_product WHERE `idproduct1`='$value'");
			mysql_query("DELETE FROM connector_status_lookup WHERE `idproduct1`='$value'");
		}
	}
	
	function products($idproduct)
	{
			$storage = "";		
			$favorites = "";
			$other_products_query = "";
			$other_places = "";
			$count_of_my_products = "";
			
			$id_limit = count($idproduct);
			// print "\$id_limit: $id_limit<br/>";
			if($id_limit > 0)
			{	
				$other_products_query .="SELECT use_of, manufacturer, model, building, room FROM `product_info`";
				// $favorites .= "<h4>LOCATIONS</h4>";
				$my_products_query="SELECT idproduct1, manufacturer, model, building, room FROM `product_info`";
				$my_products_query .=" WHERE ";
				$other_products_query .=" WHERE ";
				foreach($idproduct as $key => $value)
				{
					# http://php.net/manual/en/function.mysql-query.php
					// print "\$key: $key, \$value: $value <br/>";
					// $d="SELECT data_value FROM `product` WHERE `idproduct1` LIKE '$value'";
					// $d="SELECT manufacturer, model FROM `product_unifying_factor` WHERE `idproduct1` LIKE '$value'";
						$my_products_query .= "`idproduct1` LIKE '$value'";
						$other_products_query .= "`idproduct1` NOT LIKE '$value'";
						if($key < $id_limit-1)
						{
							$my_products_query .= " OR ";
							$other_products_query .= " AND ";
						}
				}
				if(!isset($_GET['option']))
				{
					$option = "";
				}
				else
				{
					$option = $_GET['option'];
				}
				
				if($option == "newest_created")
				{
					$my_products_query .= " ORDER BY created_stamp DESC";
				}
				elseif($option == "oldest_created")
				{
					$my_products_query .= " ORDER BY created_stamp ASC";
				}
				elseif($option == "last_edited")
				{
					$my_products_query .= " ORDER BY updated_stamp DESC";
				}
				elseif($option == "oldest_edited")
				{
					$my_products_query .= " ORDER BY updated_stamp ASC";
				}
				else
				{
					$my_products_query .= " ORDER BY created_stamp DESC";
				}
				$my_products=mysql_query($my_products_query);
				$count_of_my_products = mysql_num_rows($my_products);
				// print "\$rows: $rows<br/>";
				$favorite_list = Array();
				$row_count = 1;
				// $storage .= "<table>";
				while ($row = mysql_fetch_assoc($my_products)) {
					$idproduct = $row['idproduct1'];
					$manufacturer = $row['manufacturer'];
					$model = $row['model'];
					$building = $row['building'];
					$room = $row['room'];
					
					
					if($room == "" && $building == ""){$path = "Unknown";}
					/*
					if($room == "" && $building == ""){$path = "Unknown location";}
					if($building == "" && $room != ""){$building = "Unknown";$path = $building."/".$room;}
					if($room == ""){$room = "Unknown";$path = $building."/".$room;}
					*/
					if($building == "" && $room != ""){$building = "Unknown";$path = $room;}
					if($room == "" && $building != ""){$room = "Unknown";$path = $building;}
					// else $path = $building."/".$room;
					if(empty($favorite_list[$path]))
					{$favorite_list[$path] = 1;}
					else{$favorite_list[$path]+= 1; }
					// else{$favorite_list[$building][$room]+= 1; }
					// print "$row_count => $rows <br/>";
					$link = "";
					$default_picture=mysql_query("SELECT object FROM `multimedia` WHERE `idproduct1`='$idproduct' AND `default_picture`='1'");
					while ($row = mysql_fetch_assoc($default_picture)) {
						$object_id = $row['object'];
						$link .= "upload/$idproduct.$object_id";
					}
					
					/* product -table */
					
					/*
					
					//echo $key ." => ". $value . "<br/>";
					//$query="SELECT data_value FROM `product` WHERE `idproduct1` LIKE '$value' AND `data_name` LIKE 'manufacturer'";
					$query_manufacturer="SELECT data_value FROM `product` WHERE `idproduct1` LIKE '$value' AND `data_name` LIKE 'manufacturer'";
					$c_mf=mysql_query($query_manufacturer);
					
					while ($row = mysql_fetch_assoc($c_mf)) {
						$manufacturer = $row['data_value'];
					}
					//$c_pid=mysql_numrows($c_mf);
					// if(NULL != mysql_result($c_mf,$c_pid,"data_value"))
					// {
						// $manufacturer = mysql_result($c_mf,$c_pid,"data_value");
					// }
					// else
					// {
						// $manufacturer = "<i>Valmistajaa ei tiedossa</i>";
					// }
					
					//$query="SELECT * FROM `product` WHERE `idproduct1` LIKE '$value' AND `data_name` LIKE 'model'";
					
					
					$query_model="SELECT * FROM `product` WHERE `idproduct1` LIKE '$value' AND `data_name` LIKE 'model'";
					$d_mf=mysql_query($query_model);
					while ($row = mysql_fetch_assoc($d_mf)) {
						$model = $row['data_value'];
					}
					//print "$value -> $manufacturer<br/>";
					// $c_pid=mysql_numrows($d_mf);
					// if(NULL != mysql_result($d_mf,0,"data_value"))
					// {
						// $model = mysql_result($d_mf,0,"data_value");
					// }
					// else
					// {
						// $model = "<i>Tuotteen malli ei tiedossa</i>";
					// }
					
					//$storage .="<a href=\"object.php?id=$joo\">$manufacturer $model</a><br/>";
					*/
					if(isset($_GET['location']) && $_GET['location'] != "")
					{
						$location = $_GET['location'];
						list($forced_building, $forced_room) = explode("/", $location);
						if($forced_room == $room && $forced_building == $building)
						{
							$storage .="<div class=\"thumbview\" style=\"height: 125px; width: 125px; float: left;border: 1px solid;margin: 5px;padding: 0.5em;\"><input type=\"checkbox\" name=\"delete[]\" value=\"$idproduct\" style=\"float: left;\"><a href=\"object.php?id=$idproduct\"><img src=\"\" style=\"height: 95px; width: 120px;\" />$manufacturer $model</a></div>";
						}
					}
					else			
					{
						$storage .="<div class=\"thumbview\" style=\"height: 125px; width: 125px;float: left;margin: 5px;padding: 0.5em;\"><input type=\"checkbox\" name=\"delete[]\" value=\"$idproduct\" style=\"float: left;margin: 0 0 -15 0;position: absolute;\"><a href=\"object.php?id=$idproduct\" style=\"text-decoration: none;\"><img src=\"$link\" style=\"height: 95px; width: 120px;\" />$manufacturer $model</a></div>";
					}
					$row_count++;
				}
				foreach($favorite_list as $location => $count)
				{
					// $favorites .= "<li><a href=\"storage.php?location=$location\" style=\"text-decoration: none;\">$location ($count)</a></li>";
					$favorites .= "<a href=\"storage.php?location=$location\" style=\"text-decoration: none;\"><img src=\"\" title=\"$location ($count)\" style=\"width:50px;height:50px;\" /></a>";
				}
			}
			else
			{
				$other_products_query .="SELECT use_of, manufacturer, model, building, room FROM `product_unifying_factor`";
			}
			// print "\$storage: $storage<br/>";
			// print "\$my_products_query : $my_products_query";
			
			$others_products=mysql_query($other_products_query);
			
			$place_list = Array();
			while ($row = mysql_fetch_assoc($others_products)) {
				$use_of = $row['use_of'];
				$manufacturer = $row['manufacturer'];
				$model = $row['model'];
				$building = $row['building'];
				$room = $row['room'];
				// print "$manufacturer - $model - $building - $room <br/>";
				// $favorites .= "<li><a href=\\\"storage.php?location=$building/$room\\\">$building/$room</a></li>";
				if($use_of == "In_Use")
				{
					if($room == "" && $building == ""){$path = "Unknown location";}
					if($building == "" && $room != ""){$building = "Unknown";$path = $building."/".$room;}
					if($room == "" && $building != ""){$room = "Unknown";$path = $building."/".$room;}
					else $path = $building."/".$room;
					if(empty($place_list[$path]))
					{$place_list[$path] = 1;}
					else{$place_list[$path]+= 1; }
				}
				
			}
			if(empty($place_list))
			{
				$other_places .="<div class=\"thumbview\" style=\"height: 50px; border: 1px solid;\"><a href=\"showcase.php?location=\"><img src=\"\" style=\"height: 20px; width: 20px;float: left;\" />Ask your friend!</a></div>";
			}
			
			foreach($place_list as $room => $count)
			{
			if(isset($_GET['location']) && $_GET['location'] != "")
				{
					$location = $_GET['location'];
					list($forced_building, $forced_room) = explode("/", $location);
					if($forced_room == $room && $forced_building == $building)
					{
						$other_places .="<div class=\"thumbview\" style=\"height: 125px; width: 125px; float: left;border: 1px solid;margin: 5px;padding: 0.5em;\"><input type=\"checkbox\" name=\"delete[]\" value=\"$value\" style=\"float: left;\"><a href=\"object.php?id=$value\"><img src=\"\" style=\"height: 95px; width: 120px;\" />$manufacturer $model</a></div>";
					}
				}
				else			
				{
					// $other_places .="<div class=\"thumbview\" style=\"height: 50px; border: 1px solid;\"><a href=\"showcase.php?location=$room\"><img src=\"\" style=\"height: 20px; width: 20px;float: left;\" />$room ($count)<!-- $manufacturer $model--></a></div>";
					$other_places .="<a href=\"javascript:void(0);\" onclick=\"\"><img src=\"\" title=\"$room ($count items)\" style=\"width:50px;height:50px;\"></a>";
				}
			}
			$storage .="</form>";
			if(!isset($favorite_list)){$cfl = "0";}else{$cfl = count($favorite_list);}
			$favorites .= "<br/> <a href=\"javascript:void(0);\" onclick=\"\">".$cfl . " rooms</a>";
			$other_places .= "<br/> <a href=\"javascript:void(0);\" onclick=\"\">".count($place_list) . " rooms</a>";
			if($count_of_my_products == 0){$count_of_my_products = 0;}
		return $products = Array("$favorites", "$storage", "$other_places", "$count_of_my_products");
	}
	
	function product_collection($idprofile)
	{
	$query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'product' AND `data_value` LIKE 'owner'";
	$result=mysql_query($query);
		$product_count = mysql_numrows($result);
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
		return $idproduct;
	}
	static function Window($meta, $explorer, $navigation, $head, $column)
	{
	$mainwindow  = $meta;
	$mainwindow .= $explorer;
	$mainwindow .= $navigation;
	$mainwindow .= "<div id=\"mainwindow\" style=\"border-left:1px solid; border-bottom:1px solid; border-right:1px solid; min-width: 1110px;float: left;position: relative;left:10%;overflow: auto;\">";
	$mainwindow .= $column;
	$mainwindow .= $head;
	$mainwindow .= "</div>";

	print $mainwindow;
	} 
}

// tällä saa muodossa daa.php?id=daa
//$url = explode("/",$_SERVER["REQUEST_URI"]);
// tällä saa muodossa daa.php
// http://tycoontalk.freelancer.com/php-forum/201140-how-get-current-page-url-without.html
$url = explode("/",$_SERVER['SCRIPT_NAME']);
$pUrl = end($url);
/*
$find = "?";
$test = strpos($page,$find);
if($test !== false)
{
	list($pUrl, $pMethod) = explode("?",$page);
}
else 
{
	$pUrl = $page;
}*/
//$pUrl = end($url);
// print $url ."<br/>";
// print $page ."<br/>";
$test .=  $pUrl . "</code>\r\n-->\r\n";

print $test;

switch($pUrl)
{
	CASE "storage.php":
	{
		if(!isset($attr))
		{ // jos tuotetta ei ole määritelty
			
		}
		elseif(isset($attr))
		{ // jos tuote on määritelty
			
		}
		$bookkeeping = new Bookkeeping();
		$idproduct 	= $bookkeeping->product_collection($idprofile);
		list($favorites, $storage, $other_places, $count_of_my_products) = $bookkeeping->products($idproduct);
		
		$meta = meta_data();
		$explorer 	= explorer($idprofile, $firstname, $lastname, $notifications);
		$navigation = $bookkeeping->navigation($favorites);
		$head 		= $bookkeeping->head($count_of_my_products,$storage);
		$column 	= $bookkeeping->column($cart,$other_places, $favorites);
	break;
	}
	CASE "showcase.php":
	{
		$marketfeed = new Marketfeed();
		$meta = meta_data();
		$explorer = explorer($idprofile, $firstname, $lastname, $notifications);
		$navigation = $marketfeed->navigation($idprofile, $firstname, $lastname);
		$head   	= $marketfeed->head($popup_cart_content,$idprofile,$cart_shortcut,$market_content);
		$column 	= $marketfeed->column($cart, $wanted);
	break;
	}
}

/*
	Session information
*/
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
$query="SELECT * FROM `trade_agreement` WHERE `data_name` LIKE 'trade_agreement_valid_status_%' AND `data_value` LIKE '$idprofile'";

$events=mysql_query($query);
$events_num=mysql_numrows($events);		
$notification = "";
$event_list = Array();
if($events_num == 0)
{
	$notification .= "No events.";
}
else
{
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
	
	foreach($event_list as $trade_agreement_status => $array1)
	{
		// $notification .= "Status:  $trade_agreement_status :: <br/>";
		foreach($array1 as $time => $array2)
		{
			foreach($array2 as $seller_id => $object_id)
			{
				$profile = "";
				$profile_query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$seller_id'";
				$profile_result=mysql_query($profile_query);
				$profile_num=mysql_numrows($profile_result);			
				$profile_list = Array();
				$profile .= "<a href=\"profile.php?id=$seller_id\">";
				/*
				for($count1 = 0; $count1 < $profile_num; $count1++)
				{
					$name = mysql_result($profile_result,$count1,"data_name");
					$value = mysql_result($profile_result,$count1,"data_value");
					$profile_list[$name] = $value;
				}
				foreach($profile_list as $key => $value)
				{
					if($key == "firstname") {$profile .= "$value ";}
					if($key == "lastname") {$profile .= "$value";}
				}*/
				/*
				$profile .= "Tarjous hyväksytty";
				$profile .= "</a> ";
				$profile .= " tuotteesta ";
				*/
				
				$profile .= "Ostajaehdokas";
				$profile .= "</a> ";
				$profile .= " tuotteelle ";
				
				// $profile .= "hyväksyi tarjouksen tuotteesta ";
				
				$object_query="SELECT * FROM `product_info` WHERE `idproduct1` LIKE '$object_id'";
				$object_result=mysql_query($object_query);
				/*
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
				$object_result=mysql_query($object_query);
				*/
				while ($row = mysql_fetch_assoc($object_result)) {
							$manufacturer = $row['manufacturer'];
							$model = $row['model'];
							$default_picture = $row['default_picture'];
							$t = "$manufacturer $model";
				}
				$notification .= "<div style=\"border-bottom: 1px solid; overflow:auto;\">";
				$notification .= "<img src=\"upload/$default_picture\" style=\"width: 75px; height: 75px;  float: left;\">";
				$notification .= $profile;
				$notification .= "<a href=\"object.php?id=$object_id\">";
				$notification .= $t;
				$notification .= "</a> ";
				// $notification .= "<a href=\"javascript:void(0);\"onClick=\"Popup.show(null,null,null,{\'content\':\'This DIV was created dynamically!\',\'width\':200,\'height\':200,\'style\':{\'border\':\'1px solid black\',\'backgroundColor\':\'cyan\'}});return false;\">Maksa tuote</a>";
				// $notification .= "<a href=\"javascript:void(0);\" onClick=\"Popup.show('simplediv');return false\">Maksa tuote</a>";
				// $notification .= "<a href=\"javascript:void(0);\" onClick=\"trade_agreement_popup('popup','open');\" style=\"float:right;\">Maksa tuote</a>";
				$notification .= "<a href=\"javascript:void(0);\" onClick=\"trade_agreement_popup('popup','open');\" style=\"float:right;\">Hyväksy</a>";
				// $notification .= "<div id=\"simplediv\" style=\"background-color:yellow;border:1px solid black;display:none;width:200px;height:200px;\">Click anywhere in the document to auto-close me</div>";
				// $notification .= "<hr/>";
				$notification .= "</div>";
			}
		}
	}
}
$trade_agreement_notification = Array();
array_push($trade_agreement_notification, $notification);
array_push($trade_agreement_notification, $event_list);
return $trade_agreement_notification;
}
		
		// print "<br/><br/>\$trade_agreement_management<br/>$trade_agreement_management";
		// foreach($trade_agreement_management as $class => $array)
		// {
			// $class_count = count($array);
			// print "<br/>$class => $class_count";
		// }
	$trade_agreement_collection = Array("trade_agreement_valid_status_accept_intro_buyer",
										"trade_agreement_valid_status_a_prospective_purchaser",
										// "trade_agreement_valid_status_accept_buyer",
										"trade_agreement_valid_status_confirm_payment",
										"trade_agreement_valid_status_confirm_transfer",
										"trade_agreement_valid_status_confirm_receiving", 
										"trade_agreement_valid_status_confirm_grade");
	$test  =	"<div id=\"popup\" class=\"popup\" style=\"display:none;\">";
	$test .=	"<div class=\"popup_frame\">";
	$test .=	"<h1 class=\"popup_header\">Trade Agreement</h1>";
	$test .=	"<div>";
	$test .=	"<input type=\"text\" value=\"Search product, property or component\" style=\"width: 300px; height: 25px;\">";
	$test .=	"<input type=\"submit\" value=\"[O--]\" title=\"Etsi\">";
	$test .=	"</div>";
	$test .=	"<ul style=\"padding-left: 20px; border: 1px solid;\">";
	
	// $test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" title=\"5 products waiting your selling\" style=\"text-decoration: none; font-weight: bold;\">Introduction (5)</a></li>";
	// $test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" title=\"3 products waiting your accepting\" style=\"text-decoration: none; font-weight: bold;\">Accepting (3)</a></li>";
	
	
	for($complete = 0;$complete < 6; $complete++)
	{
		if(!array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
		{
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_intro_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your interest\" style=\"text-decoration: none;\">Introduction </a></li>";
			}
			// if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_buyer")
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_a_prospective_purchaser")
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
	$test .= "<input type=\"submit\" value=\" &times; Sulje\" onclick=\"trade_agreement_popup('popup', 'close')\" style=\"float: right;\">";
	$test .= "<input type=\"submit\" value=\"Peruuta\" style=\"float: right;\">";
	$test .= "<input type=\"submit\" value=\"Myyntiin\" style=\"float: right;\">";
	$test .= "</div>";
	$test .= "</div>";
	// $test .= $st;
	// $test .=	"This a vertically and horizontally centered popup.";
	
	$test .=	"</div>";

	


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

	$product .="</div>";
	return $product;
}


/*
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
		//$i=0;		print mysql_result($found,$i,"accountid");
		if($found == $string)
		{
			unit_id();
		}
	else	
		return $string;
	}

	// function GenerateID()
	// {
		// $num = rand(0000000000, 9999999999);
		// $query = "SELECT productid FROM product WHERE productid LIKE '%$num%'";
		// $found = mysql_query($query);
		/*$i=0;		print mysql_result($found,$i,"accountid");*
		// if($found == $num)
		// {
			// GenerateID();
		// }
		// else return $num;
	// }
	//$num = GenerateID();
	//$query = "INSERT INTO product VALUES ('$accountid','$num', '', '$manufacturer', '$model', '$year')";
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
*/
function marketflow($idprofile)
{
	$profile = $idprofile;
	$dbhost = '130.234.191.97:3306'; /* host */ $dbuser = 'q#¤%_GD4jjt34w_S'; /* your username created */ $dbpass = 'cytBdSpWr3deJpfX';//'password'; //the password 4 that user
	//$dbhost = 'localhost'; /* host */ $dbuser = 'root'; /* your username created */ $dbpass = '';//'password'; //the password 4 that user
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	$dbname = 'shipshop';
	mysql_select_db($dbname);//your database.
	//$query = $state . " &amp; " . $product_id  . " &amp; " . $idprofile .  "\r\n";
	
	if(isset($_GET['ln']))
	{ // show products categorized by room
		$ln=$_GET['ln'];
		$query = "SELECT p2.manufacturer, p2.model, p2.default_picture  
				FROM product_info p1, product_info p2
				WHERE p1.name='$ln' and p1.idproduct1=p2.parent_product";
		$info  = "";
	}
	
	$info  = "";
	$info .= "<div style=\"overflow:auto;\">";
	$info .= "<div style=\"float:left;padding: 0 5;border: 1px solid;\"><a href=\"\">New fashion (NaN)</a></div>";
	$info .= "<div style=\"float:left;padding: 0 5;border: 1px solid;\"><a href=\"\">Compatible stuff (NaN)</a></div>";
	$info .= "<div style=\"float:left;padding: 0 5;border: 1px solid;\"><a href=\"\">Wanted (NaN)</a></div>";
	$info .= "<div style=\"float:left;padding: 0 5;border: 1px solid;\"><a href=\"\">Upgrades (NaN)</a></div>";
	$info .= "<div style=\"float:left;padding: 0 5;border: 1px solid;\"><a href=\"\">Updates (NaN)</a></div>";
	$info .= "</div>";
	$view = "";
	$shortcut = "";
	$buttons = "";
		//$query = "SELECT * FROM trade_agreement WHERE `data_name`='proprietor_status_change'"; // AND `idprofile1` LIKE '$profile'";
		$query = "SELECT * FROM trade_agreement t WHERE t.idprofile1!='$profile' and t.data_name='proprietor_status_change'"; // AND `idprofile1` LIKE '$profile'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		// $info = "Tuotteita: $num<br/>";
		
		$market_content = Array();
		for($i = 0; $i < $num; $i++)
		{
			$data_id = mysql_result($result,$i,"idprofile1");
			if($data_id != $profile)
			{
			//$data_name = mysql_result($result,$i,"data_name");
			//$data_value = mysql_result($result,$i,"data_value");
			$data_object = mysql_result($result,$i,"data_object");
			$market_content[$data_object]["profile_id"] = $data_id;
			}
		}
		$dii = "";
		foreach($market_content as $product_id => $content)
		{
			foreach($content as $name => $value)
			{
				if($name == "profile_id") {$strange_profile_id = $value;}
			
			$showcase_content = mysql_query("SELECT * FROM product_info WHERE `idproduct1`='$product_id'"); // AND `idprofile1` LIKE '$profile'";
				while ($row = mysql_fetch_assoc($showcase_content)) {
						$idproduct = $row['idproduct1'];
						$product_time = $row['last_updated']; /* $updated_stamp */
						$manufacturer = $row['manufacturer'];
						$model = $row['model'];
						$specification = $row['specification'];
						$product_desc ="$manufacturer $model $specification";
					$picture = mysql_query("SELECT object FROM multimedia WHERE `idproduct1`='$product_id'");
					$link = "";
					while ($row = mysql_fetch_assoc($picture)) {
						$image = $row['object'];
						
						$link .= "upload/$product_id.$image";
					}
				$info .= "<div id=\"$product_time\" style=\"margin: 5px;width: 155px; float: left;\">";
				$trade_status = mysql_query("SELECT * FROM trade_agreement WHERE `data_object`='$product_id' AND `idprofile1`='$profile'");
				$t_status = mysql_num_rows($trade_status);
				if($t_status > 0)
				{
				$buttons .= "<input type=\"button\" id=\"buy_$idproduct\" value=\"X\" title=\"En ostakaan\" onClick=\"cancel('$profile','$strange_profile_id', '$product_id');\" style=\"float: left;margin-top: -25px;margin-left: 115px; position: absolute;\">";
				}
				else
				{
				$buttons .= "<input type=\"button\" id=\"buy_$idproduct\" value=\"Osta\" onclick=\"market_scouting_popup('$idprofile', '$product_id','', 'initial_exchange', 'open');\" onClick=\"add_cart('$profile','$strange_profile_id', '$product_id');\" style=\"float: left;margin-top: -25px;margin-left: 115px; position: absolute;\">";
				}
				$buttons .= "<input type=\"button\" value=\"Tutustu\" style=\"float: left;margin-top: -25px;margin-left: 65px; position: absolute;\">";
				// $buttons .= "<input type=\"button\" value=\"Vertaa\" style=\"float: left;margin-top: -25px;margin-left: 20px; position: absolute;\">";
				$info .= "<img src=\"$link\" style=\"width:150px;height:150px;\" /><br/>";
				$info .= $buttons;
				$info .= "<a href=\"object.php?id=$product_id\">".$product_desc."</a>";
				// $info .= "<br/> ".timeSince("$product_time");
				$info .= "<br/> Added ".$product_time . " " . date("F j, Y, g:i a");
				$info .= "</div>";
				$shortcut .= "<a href=\"object.php?id=$product_id\"><img src=\"\" style=\"width:50px; height: 50px;\" title=\"$product_desc\"></a>";
				}
			}
		}
		$info .="<div style=\"clear: left; border: 1px solid; border-color: navyblue;margin: 5;padding: 10 20;background-color: lightblue;\">";
		$info .="Millainen olisi järkevä etusivu-look? Opasteet. Ei tarvi olla kaikkea, mutta jotain uusia aiheita http://en.wikipedia.org/wiki/AIDA_%28marketing%29<br/>";
		$info .="Tilausjärjestys: tarve, sijainti, uusin ensin<br/>";
		$info .="No more content to view. <a href=\"\">Add</a> a product to Market Flow. <!-- <a>Begin</a> the trade agreement with your product. -->";
		$info .="</div>";
	return $info;
}

function cart_status($idprofile)
{
	$profile_id = $idprofile;
	$cart = mysql_query("SELECT data_object, datetime FROM trade_agreement WHERE `idprofile1` LIKE '$profile_id' AND `data_name`='a_prospective_purchaser'");
	$num= mysql_num_rows($cart);
	$popup_cart_content = "";
	while ($row = mysql_fetch_assoc($cart)) {
			$product = $row['data_object'];
			$datetime = $row['datetime'];
			$image = mysql_query("SELECT object FROM multimedia WHERE `idproduct1` LIKE '$product'");
			$link ="";
			while ($row = mysql_fetch_assoc($image)) {
				$object= $row['object'];
				$link .="upload/$product.$object";
			}
			$product_topic = mysql_query("SELECT manufacturer, model FROM product_unifying_factor WHERE `idproduct1` LIKE '$product'");
			$topic ="";
			while ($row = mysql_fetch_assoc($product_topic)) {
			$manufacturer= $row['manufacturer'];
			$model= $row['model'];
			$topic .="$manufacturer $model";
			}
			$popup_cart_content .= "<div><img src=\"$link\" style=\"width:50px;height:50px;\">$topic<span style=\"float:right;\"><input type=\"button\" value=\"Cancel\"></span></div>";
	}
	if($num > 0)
	{
	$link = "<a id=\"cart_button\" href=\"javascript:void(0);\" onClick=\"start_menu('cart','view');\"><b>$num</b> try in a cart</a>";
	}
	else
	{
	$link = "<a id=\"cart_button\" href=\"javascript:void(0);\" onClick=\"start_menu('cart','view');\">Empty cart</a>";
	$popup_cart_content = "No content";
	}
	return Array("$link","$popup_cart_content");
}

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

function meta_data()
{
	$meta  = "<html>";
	$meta .= "<head>";
	//$meta .= "<script type=\"text/javascript\" src=\"csspopup.js\"></script>";
	$meta .= "<script type=\"text/javascript\" src=\"_dSf6-2x6.js\"></script>";
	$meta .= "<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" href=\"daadaa.css\">";
	$meta .= "</head>";
	if(isset($_GET['id']))
	{
		$product_id = $_GET['id'];
	}else
	{
		$product_id = "";
	}
	$date_now  = date( "Y-m-d H:i:s" ); // get the date
	$time_now  = time( $date_now ); // convert it to time
	$time_next = $time_now + 1 * 60 * 60; // add 3 hours (3 x 60mins x 60sec)
	$now = date( "Y-m-d H:i:s", $time_next); // convert it back to date
	$meta .= "<body onload=\"bootLoader('".$_SESSION["stuffwalk_profile"]."','$product_id','$now')\" onmousemove=\"bootLoader('".$_SESSION["stuffwalk_profile"]."','$product_id','$now');\" onmouseover=\"bootLoader('".$_SESSION["stuffwalk_profile"]."','$product_id','$now');\" onresize=\"bootLoader('','','')\">";
	return $meta;
}

function explorer($idprofile, $firstname, $lastname, $notifications)
{
	/*
	
		Product Connections Pop-Up
		now div id=""
		original div id="popup"
	
	*/
	$test  =	"<div id=\"market_scouting_frame\" class=\"popup\">";
	$test .=	"<div id=\"market_scouting_frame\" class=\"popup_frame\">";
	$test .=	"<div id=\"market_scouting_header\"><h1 class=\"popup_header\">Connection</h1></div>";
	$test .=	"<div id=\"popup_navigation\">";
	$test .=	"<div style=\"overflow:auto;\">";
	$test .=	"<input type=\"text\" value=\"Search product, property or component\" style=\"width: 300px; height: 25px;float:left;\">";
	$test .=	"<input type=\"image\" src=\"SS_design/etsi_nappi.png\" title=\"Etsi\" style=\"margin: -5 0 0 0;padding:0;float:left;\">";
	// $test .=	"<input type=\"submit\" value=\"[O--]\" title=\"Etsi\">";
	$test .=	"</div>";
	$test .=	"</div>";
	// $test .=	"<ul style=\"padding-left: 20px; border: 1px solid;\">";
	
	$test .=	"<ul id=\"popup_menu\" style=\"border: 1px solid;height: 21px;\">";
	
	$test .=	"<select id=\"connection_menu_select\" name=\"connection_o\" style=\"float: left; background-color: #CECECE; font-weight: bold;\" onChange=\"connection_menu();\">";
	$test .=	"<option value=\"similar\" onClick=\"connection_menu('New');\">What's New</option>";
	$test .=	"<optgroup label=\"My library\">";
	$test .=	"<option value=\"similar\" style=\"padding-left: 20;\" onClick=\"connection_menu('all_products');\">All</option>";
	$test .=	"<option value=\"part_of\" style=\"padding-left: 20;\" onClick=\"connection_menu('post_exchanges');\">Post Exchanges</option>";
	$test .=	"<option value=\"part_of\" style=\"padding-left: 20;\" onClick=\"connection_menu('archived_exchanges');\">Archived Exchanges</option>";
	$test .=	"<option value=\"similar\" style=\"padding-left: 20;\" onClick=\"connection_menu('similar_product');\">Similar/Vastaavat</option>";
	$test .=	"<option value=\"includes\" style=\"padding-left: 20;\" onClick=\"connection_menu('includes');\">Includes</option>";
	$test .=	"<option value=\"part_of\" style=\"padding-left: 20;\" onClick=\"connection_menu('part_of');\">Part of</option>";
	//$test .=	"<option value=\"compatible\" style=\"padding-left: 20;\" onClick=\"connection_menu('compatible');\">Compatible</option>";
	$test .=	"</optgroup>";
	$test .=	"<optgroup label=\"For Sale\">";
	$test .=	"<option value=\"similar\" style=\"padding-left: 20;\" onClick=\"connection_menu('A');\">A</option>";
	$test .=	"<option value=\"includes\" style=\"padding-left: 20;\" onClick=\"connection_menu('B');\">B</option>";
	$test .=	"<option value=\"part_of\" style=\"padding-left: 20;\" onClick=\"connection_menu('C');\">C</option>";
	$test .=	"<option value=\"compatible\" style=\"padding-left: 20;\" onClick=\"connection_menu('D');\">D</option>";
	$test .=	"</optgroup>";

	$test .=	"</select>";
	
	$trade_agreement_management = Array();
	/*
	$trade_agreement_collection = Array("trade_agreement_valid_status_accept_intro_buyer",
										"trade_agreement_valid_status_accept_buyer",
										"trade_agreement_valid_status_confirm_payment",
										"trade_agreement_valid_status_confirm_transfer",
										"trade_agreement_valid_status_confirm_receiving", 
										"trade_agreement_valid_status_confirm_grade");
	
	for($complete = 0;$complete < 6; $complete++)
	{
		if(!array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
		{
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_intro_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your interest\" style=\"text-decoration: none;\">Compatible with</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your accepting\" style=\"text-decoration: none;\">A standard Part Of</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_payment")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your paying\" style=\"text-decoration: none;\">An Add-On Of</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_transfer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your transforming\" style=\"text-decoration: none;\">Standards Included</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_receiving")
			{
			// $test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your receiving\" style=\"text-decoration: none;\">Add-Ons Included</a></li>";
			$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your receiving\" style=\"text-decoration: none;\">Add-Ons Included</a></li>";
			}
			/
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_grade")
			{
			$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your grade\" style=\"text-decoration: none;\">Recommendations</a></li>";
			} /
		}
		if(array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
		{
			$class_count = count($trade_agreement_management[$trade_agreement_collection[$complete]]);
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_intro_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your selling\" style=\"text-decoration: none; font-weight: bold;\">Compatible with ($class_count)</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your accepting\" style=\"text-decoration: none; font-weight: bold;\">A standard Part Of ($class_count)</li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_payment")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your paying\" style=\"text-decoration: none; font-weight: bold;\">An Add-On Of ($class_count)</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_transfer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products is under transforming\" style=\"text-decoration: none; font-weight: bold;\">Standards Included ($class_count)</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_receiving")
			{
			// $test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your receiving\" style=\"text-decoration: none; font-weight: bold;\">Add-Ons Included ($class_count)</a></li>";
			$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your receiving\" style=\"text-decoration: none; font-weight: bold;\">Add-Ons Included ($class_count)</a></li>";
			}
			//
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_grade")
			{
			$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your receiving\" style=\"text-decoration: none; font-weight: bold;\">Recommendations ($class_count)</a></li>";
			}//
			
		}
	}*/
		$trade_agreement_collection = Array("trade_agreement_valid_status_compatible_products",
											"trade_agreement_valid_status_exchanges_in_progress", 
											"trade_agreement_valid_status_archived_exchanges");
		
for($complete = 0;$complete < 3; $complete++)
	{
		if(!array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
		{
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_compatible_products")
			{
			$test .=	"<li style=\"float: left; width: 175px;margin-left:20px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your interest\" style=\"text-decoration: none;\">Compatible</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_exchanges_in_progress")
			{
			$test .=	"<li style=\"float: left; width: 175px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your accepting\" style=\"text-decoration: none;\">Exchanges in progress</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_archived_exchanges")
			{
			$test .=	"<li style=\"float: left; width: 175px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your paying\" style=\"text-decoration: none;\">Archived Exchanges</a></li>";
			}

		}
		if(array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
		{
			$class_count = count($trade_agreement_management[$trade_agreement_collection[$complete]]);
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_compatible_products")
			{
			$test .=	"<li style=\"float: left; width: 175px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your selling\" style=\"text-decoration: none; font-weight: bold;\">Compatible ($class_count)</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_exchanges_in_progress")
			{
			$test .=	"<li style=\"float: left; width: 175px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your accepting\" style=\"text-decoration: none; font-weight: bold;\">Exchanges in progress ($class_count)</li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_archived_exchanges")
			{
			$test .=	"<li style=\"float: left; width: 175px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your paying\" style=\"text-decoration: none; font-weight: bold;\">Archived Exchanges ($class_count)</a></li>";
			}			
		}
	}
	
	$test .= "</ul>";
	//$test .= "<div id=\"trade_agreement_content\" class=\"popup_content\" style=\"overflow: auto;\" onload=\"market_scouting('$idprofile', '$id','','');\">";
	$test .= "<div id=\"trade_agreement_content\" class=\"popup_content\" style=\"overflow: auto;\">";
	$test .= "<div id=\"ta_content\" style=\"overflow: auto;\">";
	$test .= "</div>";
	// varmaan olis hyvä siirtää onload body-kohtaan.
	// $test .= "<div id=\"trade_agreement_content\" class=\"popup_content\" style=\"overflow: auto;\" onload=\"market_scouting($profile_id, $product_id,connector_id,index_type)\">";
	
	// $sr  =	"<h2>Compatible With</h2>";
	$sr  =	"";
	$sr .=	"<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$sr .=	"<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$sr .=	"Corsair <label style=\"float: right;\"><input type=\"button\" value=\"Lisää\" /><input type=\"button\" value=\"Hylkää\" /></label>";
	$sr .=	"<br/>2 minutes ago  · Via <a href=\"\">DDR2</a>  · <a href=\"\">Advantages</a>";
	$sr .=	"<label style=\"float: right;\"><b>Price</b> € 50, <a href=\"\">Maksa</a></label>";
	$sr .=	"</div>";
	
	// $test .= $sr;
	$test .= "</div>";
	
	
	$test .= "<div id=\"market_scouting_frame\" class=\"popup_footer\">6 002 osaa, 14 maata. ";
	//$test .= "<input type=\"button\" value=\" &times; Sulje\" onclick=\"market_scouting_popup('$idprofile', '$id','', 'market_scouting_frame', 'close');\" style=\"float: right; \">";
	$test .= "<input type=\"button\" value=\" &times; Sulje\" onclick=\"market_scouting_popup('$idprofile', '','', 'market_scouting_frame', 'close');\" style=\"float: right; \">";
	// $test .= "<input type=\"submit\" value=\"Peruuta\" style=\"float: right;\">";
	// $test .= "<input type=\"submit\" value=\"Myyntiin\" style=\"float: right;\">";
	$test .= "</div>";
	$test .= "</div>";
	// $test .= $st;
	// $test .=	"This a vertically and horizontally centered popup.";
	
	$test .=	"</div>";

	// $test .=	"<a onclick=\"showPopup('popup');\">Show Popup</a>";
	// http://www.w3schools.com/cssref/pr_pos_z-index.asp
	// http://www.w3schools.com/css/css_image_transparency.asp
	// http://stackoverflow.com/questions/3202583/how-to-center-align-pop-up-div-using-javascript
	$test .="<script type=\"text/javascript\">
	function swot()
	{
		var xx = document.getElementById(\"swot\");
		xx.style.display = \"block\";
		// xx.style.z-index = \"2\";
		xx.style.position = \"absolute\";
		// document.write(\"jee\");
		
	}
	</script>
	";
	$test .=	"<style type=\"text/css\">
  .popup {
    width:600px; /* 600*/
    height:420px; /* 620px; */
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
	height: 385px; /*585px;*/
	margin: 15px;
  }
  .popup_content{
	height: 265 /* 465px; */
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
	height: 31px;
	padding-left: 10px;
	font:   26px Calibri; /* menettelee: 32px Corbel; huonot: 32px Arial Black; 32px Verdana;32px Times New Roman;  32px symbol;  34px Serif; 32px Georgia;*/
	color: #BCD2EE; 	/*	#6E7B8B; #CDAD00;	*/
  }
</style>";

	$test .=	"<script type=\"text/javascript\">
  function trade_agreement_popup(id, state) {
    var popup = document.getElementById(id);
	if(state == \"open\")
	{
    popup.style.display = 'block';
	}
	if(state == \"close\")
	{
    popup.style.display = 'none';
	}
	
  }
</script>";
// print $test;	
	
$explorer  = "";
$explorer .= $test;
$explorer .= "<div id=\"fire_guard\"></div>";
$explorer .= "<div id=\"header\" style=\"height: 45px;margin: 0 0 -7 0; padding: -5 0 0 0;background-image:url('SS_design/headerbg_80.png');\">";
$explorer .= "<div id=\"navigation\" style=\"position: relative;left:10%;width: 1310px;height: 35px;padding: 5 0 0 0;\">";

$explorer .= "<div id=\"notification_popup\" style=\"position: absolute;z-index: 1; display:none;border: 1px solid; width: 250px;background-color: #ffffff;top: 74%; left: 7%;\">
<h1 style=\"font: 12px Arial; border-bottom:1px solid;\">Trade agreement<span style=\"float:right;margin-right: 5px;\"><a href=\"\">Add product</a></span></h1>
<div id=\"notification_content\" style=\"overflow:auto;\">$notifications</div>
<div id=\"notification_bottom\" style=\"border-top:1px solid;text-align: center;\"><a href=\"\">View All</a></div>
</div>";
$explorer .= "<div id=\"passion_popup\" style=\"position: absolute;z-index: 1; display:none;border: 1px solid; width: 250px;background-color: #ffffff;top: 74%; left: 5%;\">
<h1 style=\"font: 12px Arial; font-weight:bold; border-bottom:1px solid;\">You may have</h1>
<div id=\"notification_content\">$notifications</div>
<div id=\"notification_bottom\" style=\"border-top:1px solid;text-align: center;\"><a href=\"\">View All</a></div>
</div>";

// $explorer .= "<a href=\"showcase.php\" onclick=\"\" style=\"color: #FFFFFF; text-decoration: none; font-weight: bold;float: left;\">Shopstream</a>" ;
$explorer .= "<a href=\"showcase.php\"  style=\"height:35px; margin:-7 0 -5 0; text-decoration: none; font-weight: bold;float: left;\"><img src=\"SS_design/logo.png\" /></a>" ;
$explorer .= "<input type=\"button\" id=\"passion_button\" onClick=\"start_menu('passion','view');\" value=\" P \" style=\"height:35px; margin:-7 0 -5 0; text-decoration: none; font-weight: bold;float: left;\" />" ;
$explorer .= "<input type=\"button\" id=\"notification_button\" onClick=\"start_menu('notification','view');\" value=\" N \" style=\"height:35px; margin:-7 0 -5 0; text-decoration: none; font-weight: bold;float: left;\" />" ;
$explorer .= "<input type=\"text\" name=\"search\" value=\"Search / Offer\" style=\"margin: 0 0 0 2.3%; height: 25px;float: left;\" size=\"40px\" />";
$explorer .= "<input type=\"image\" src=\"SS_design/etsi_nappi.png\" name=\"uutuudet\" title=\"5 suggest\" style=\"margin: 0;padding:0;width:25px;height:25px; float: left;\"/>";

$explorer .= "<span style=\"background-color:red; font:12px arial black;font-weight:bold; color:#ffffff; height:5px; padding:0 1;margin:0 0 0 -10;\">5</span>";
// $explorer .= "<a href=\"\" style=\"color: #ffffff;\">(5 new suggestions)</a>";

$explorer .= "<span style=\"float: right;margin-right: 10px;margin-top: 5px;font: 12px verdana;font-weight: bold;  \">";
$explorer .= "<a href=\"object.php\" onclick=\"\" style=\"color: #c0c0cc;text-decoration: none;\">";
$explorer .= $firstname. " " .$lastname;
$explorer .= "</a>";
$explorer .= "&nbsp;&nbsp;";
$explorer .= "<a href=\"logout.php\" style=\"color: #FFFFFF; text-decoration: none; font-weight: bold;\">Log out</a>";
$explorer .= "</span>";
$explorer .= "</div>";
$explorer .= "</div>";

return $explorer;
}


// itimeSince = timeSince 
function itimeSince($date) {
	// $date = $date;
	$today = getdate();
    // $seconds = round(("$today[6]-$today[5]-$today[3] $today[2]-$today[1]-$today[0]" - $date) / 1000);
    $seconds = round($date / 1000);
    // $seconds = round((idate("Y-m-d h-i-s") - $date) / 1000);

    $interval = round($seconds / 31536000);

    if ($interval > 1) {
        return $interval + " years";
    }
    $interval = round($seconds / 2592000);
    if ($interval > 1) {
        return $interval + " months";
    }
    $interval = round($seconds / 86400);
    if ($interval > 1) {
        return $interval + " days";
    }
    $interval = round($seconds / 3600);
    if ($interval > 1) {
        return $interval + " hours";
    }
    $interval = round($seconds / 60);
    if ($interval > 1) {
        return $interval + " minutes";
    }
    return round($seconds) + " seconds";
}

//mysql_close();
session_write_close();
?>