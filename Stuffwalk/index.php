<?php

$dbhost = 'ip_address:3306'; /* host */ $dbuser = 'username'; /* your username created */ $dbpass = 'password';//'password'; //the password 4 that user
#$dbhost = 'localhost'; /* host */ $dbuser = 'root'; /* your username created */ $dbpass = '';//'password'; //the password 4 that user

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'shipshop';
mysql_select_db($dbname);//your database.
/*
	http://php.net/manual/en/function.get-browser.php
*/
$browser = $_SERVER['HTTP_USER_AGENT'];
$ip=$_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
if($ip != "ip_address")
{
mysql_query("INSERT INTO tracking values(NOW(), '$ip','$hostname','$browser')");
}
if(!empty($_POST['name'])){$name = $_POST['name'];}
if(!empty($_POST['lastname'])){$lastname = $_POST['lastname'];}
if(!empty($_POST['email'])){$email = $_POST['email'];}
if(!empty($_POST['domain'])){$domain = $_POST['domain']; }
if(!empty($_POST['password'])){$password = $_POST['password']; }


if(!empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['domain']) && !empty($_POST['password']))
{
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$domain = $_POST['domain']; 
$password = $_POST['password']; 

// The message
$message = "Hi $name!\nWelcome to use new network.\nConfirm your email with link:";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70);


$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n";
// Send
mail("$email@$domain", "Shopstream: Welcome to the new service", $message, $headers);
}

$command = "<script type=\"text/javascript\">
function registeration(firstname)
{
	var firstname = firstname;
	var lastname = lastname;
	var email = email;
	var domain = domain;
	var password = password;
	var url = \"receiver.php\";
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\);
	}
	xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		// itkuhälytin = baby monitor
		// http://www.ozzu.com/programming-forum/ajax-multiple-responses-with-one-request-t89454.html
		//var baby_monitor = xmlhttp.responseText.split(\"\r\n\"); // pick a data from url
		var status = xmlhttp.responseText; // pick a data from url
		document.getElementById(\"register\").innerHTML =status; // pick a data from url
		}
	}
	//data=\"data=\"+data;
	data=\"firstname=\"+profile;
	xmlhttp.open(\"POST\",url+\"?\"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader(\"Content-type\", \"application/x-www-form-urlencoded\");
	xmlhttp.setRequestHeader(\"Content-length\", data.length);
	xmlhttp.setRequestHeader(\"Connection\", \"close\");
	xmlhttp.send();	
}";

/* database communication */


// Connect to database

		$dbhost = 'ip_address:3306'; /* host */ $dbuser = 'username'; /* your username created */ $dbpass = 'password';//'password'; //the password 4 that user
		#$dbhost = 'localhost'; /* host */ $dbuser = 'root'; /* your username created */ $dbpass = '';//'password'; //the password 4 that user
		
		$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
		
		$dbname = 'database_name';
		mysql_select_db($dbname);//your database.



// Database

if(empty($email) && !empty($password) && !empty($name) && !empty($lastname))
{
	//$query="SELECT * FROM account";
	//$statistics=mysql_query($query);

	//$num=mysql_numrows($statistics);
	//$query="SELECT accountid FROM account";
	// function unit_id()
	// { # http://www.lost-in-code.com/programming/php-code/php-random-string-with-numbers-and-letters/
		// $length = 10;
		// $characters = ’0123456789abcdefghijklmnopqrstuvwxyz’;
		// $string = ”;    
		// for ($p = 0; $p < $length; $p++) {
			// $string .= $characters[mt_rand(0, strlen($characters))];
		// }
    // return $string;
	// }
	
	function unit_id()
	{ # http://www.lost-in-code.com/programming/php-code/php-random-string-with-numbers-and-letters/
		$length = 10;
		$characters = "_-0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; #63
		$string = "";
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		$query = "SELECT idprofile1 FROM profile WHERE idprofile1 LIKE '%$string%'";
		$result = mysql_query($query);
		//$i=0;		print mysql_result($found,$i,"accountid");
		if($result == $string)
		{
			unit_id();
		}
    return $string;
	}
	
	function GenerateID()
	{
		$num = rand(0000000000, 9999999999);
		//$num = rand(999999999991, 99999999999);
		$query = "SELECT idprofile1 FROM profile WHERE idprofile1 LIKE '%$num%'";
		$found = mysql_query($query);
		//$i=0;		print mysql_result($found,$i,"accountid");
		if($found == $num)
		{
			GenerateID();
		}
		else return $num;
		
	}
	$string = unit_id();
	//$query = "INSERT INTO account VALUES ('$num','$email', '$password', '$name', '$lastname')";
	$query = "INSERT INTO profile VALUES ('$string', NOW(),'email', '$email','0','0','0')";
	mysql_query($query);
	$query = "INSERT INTO profile VALUES ('$string', NOW(), 'password', '$password','0','0','1')";
	mysql_query($query);
	$query = "INSERT INTO profile VALUES ('$string', NOW(), 'firstname', '$name','0','0','0')";
	mysql_query($query);
	$query = "INSERT INTO profile VALUES ('$string', NOW(), 'lastname', '$lastname','0','0','0')";
	mysql_query($query);
	
}

	//$query = "INSERT INTO course VALUES ('1','Ohjelmointitekniikan koulutusohjelma','HTML-kieli', 'English', 'Finnish', '', '30')";

	// mysql_query($query);

	// $query = "UPDATE course SET ('','Ohjelmointitekniikan koulutusohjelma','MySQL Tietokannat')";

	//mysql_query($query);
// Database
//$query="SELECT * FROM account";
$query="SELECT * FROM profile";
$result=mysql_query($query);
$num=mysql_numrows($result);


mysql_close();

$i=0;
while ($i < $num) {

$email = mysql_result($result,$i,"idprofile1");
$emai = mysql_result($result,$i,"datetime");
$password = mysql_result($result,$i,"data_name");
$name = mysql_result($result,$i,"data_value");
$lastname = mysql_result($result,$i,"data_object");
$le = mysql_result($result,$i,"data_priority");
$me = mysql_result($result,$i,"data_security");

//$products[] = "$productname";
//print $email. " " . $emai. " " . $password. " " .$name. " " .$lastname. " $le / $me <br/>";

$i++;
}
// function unit_id()
	// { # http://www.lost-in-code.com/programming/php-code/php-random-string-with-numbers-and-letters/
		// $length = 10;
		// $characters = "_-0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; #63
		// $string = "";
		// for ($p = 0; $p < $length; $p++) {
			// $string .= $characters[mt_rand(0, strlen($characters)-1)];
		// }
    // return $string;
	// }
// print unit_id();
?>

<div id="headernavigation" style="background-color: #d0d0d0; height: 30px;margin: -8; padding: 0;border-bottom: 1px solid;">
<a onclick="" style="font: 24px times new roman; margin-left: 15px;">Shopstream</a>
<!--
<input type="text" name="search" style="margin:0 0 0 40%"/>
<input type="button" name="uutuudet" value="uutuudet" style="margin: 2 0 0 0;padding:0;"/>
<input type="button" name="alennusmyynti" value="alennusmyynti" style="margin: 2 0 0 0;padding:0;"/>
<input type="button" name="käytetyt" value="käytetyt" style="margin: 2 0 0 0;padding:0;"/>
<input type="button" name="ilmaisjakelut" value="ilmaisjakelut" style="margin: 2 0 0 0;padding:0;"/>
-->
<form action="showcase.php" method="post" style="margin: -26 0 0 0; padding: 0;">
<span style="float: right;">User name: <input type="text" name="email"> Password: <input type="password" name="password"><input type="submit" value="Kirjaudu"></span>
</form>
</div>

<div id="brochyre" style="margin: 50 20%; height: 600px;width: 1024px;">
<div id="service_description" style="float: left; padding: 0 15px; border-right: 1px solid;">
<h1 style="margin-top: 0px;">Missä olet?</h1>
<p>
	<!-- The market utility for online shopping between students.-->
	Markkinatyökalu kaupankäyntiin opiskelijoiden välillä
</p>
<p>
	This service is available now: / Palvelu saatavilla alueille:
	<ul>
	<li>Jyväskylä</li>
	</ul>
</p>
<p>
You can use Shopstream to
<ul>
<li>Search for product from everywhere</li>
<li>Check component compatibility with your product</li>
<li>Change, buy and sell stuff with other students</li>
<li>Build your combination of interests</li>
</ul>
</p>

Voit käyttää Shopstream -palvelua
<ul>
<li>Etsiessäsi tavaroita mistä vaan</li>
<li>Varmistamaan tavaroiden yhteensopivuus</li>
<li>Tavaroiden vaihtoon, ostoon ja myyntiin opiskelijoiden kesken</li>
<li>Rakentamaan oma intohimosi maailma</li>
</ul>
</div>

<div id="register" style="margin-left: 450px;padding-left: 25px;">
<form action="index.php" method="post">
<h1>Rekisteröidy ilmaiseksi</h1>
<p>Se on ilmaista nyt ja aina.</p>
<table>
<tr><td>Etunimi </td><td> <input type="text" name="name"></td></tr>
<tr><td>Sukunimi </td><td> <input type="text" name="lastname"></td></tr>
<tr><td>Sähköposti </td><td> <input type="text" name="email"> @ 
<select name="domain">
	<option>-- Select an University --</option>
	<option value="jyu.fi">University of Jyväskylä &#45; Staff</option>
	<option value="student.jyu.fi">University of Jyväskylä &#45; Student</option>
	<option value="jamk.fi">JAMK University of Applied Sciences</option>
	<option value="myy.haaga-helia.fi">Haaga-Helia University of Applied Sciences</option>
	<option value="gmail.com">Google Mail</option>
</select>
<label><input type="checkbox" name="staff" value="yes" />I'm staff.</label>
</td></tr>
<tr><td>Salasana </td><td><input type="text" name="password"></td></tr>
</table>
<p>Rekisteröitymisen jälkeen voit käydä kauppaa <b>missä vain</b>, <b>milloin vain</b> ja <b>lähes millä vain</b> luotettavasti.</p>
<input type="submit" value="Rekisteröidy"/>
</form>
</div>
</div>