<?php
  session_start();
// include 'ss_config.php';
/*
 * vosi olla muodossa receiver.php?packet["product_id"]=daa&packet["market_scout"]=1
 * jolloin riittäis kun ottais yhden muuttujan $_GET["packet"]; 
*/
function initial_db_connection()
{
	$dbhost = 'ip_address:3306'; /* host */ $dbuser = 'username'; /* your username created */ $dbpass = 'password';//'password'; //the password 4 that user
	#$dbhost = 'localhost'; /* host */ $dbuser = 'root'; /* your username created */ $dbpass = '';//'password'; //the password 4 that user
	
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	
	$dbname = 'shipshop';
	mysql_select_db($dbname);//your database.
}
initial_db_connection();
//$status = $_GET['status'];

/*
	if(empty($data)) {$data = "Muuttuja oli tyhj&auml;";}
	else {}
	$file = "datatext.txt";
	$fh = fopen($file, 'w+');
	fwrite($fh, $data);
	fclose($fh);
*/

if(isset($_GET['data']))
{	
	//$query = "SELECT * FROM product WHERE `data_name`='manufacturer' AND `data_value`='%$data%'";
	//$query = "SELECT * FROM product WHERE `manufacturer` LIKE `%$data%` AND WHERE `model` LIKE `%$data%`";
	//toimii
	//$query = "SELECT * FROM product WHERE `data_value` LIKE '%$data%'";
	//toimii
	$query = "SELECT * FROM product WHERE `data_value` LIKE '%$data%' AND `data_name` LIKE 'manufacturer'";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	$offer = Array();
	for($i = 0; $i < $num; $i++)
	{
		//$firstname = mysql_result($result,0,"data_value");
		$data_id = mysql_result($result,$i,"idproduct1");
		$data_name = mysql_result($result,$i,"data_name");
		$data_value = mysql_result($result,$i,"data_value");
		$offer[$data_id][$data_name] = $data_value;
	}
	$offer_query ="<div id=\"offer_result\" style=\"margin: 0 0 10 0\">\r\n";
	//$offer_query .="Query ($data) begin:";
	$offer_query .="<h5 style=\"border-bottom: 1px solid;\">Tulokset haulle $data (Yhteens&auml; $num)</h5>";
	//$offer_query .="\r\n Row numbers: $num, array look: $offer";
	foreach($offer as $a => $b)
	{
		$size = count($offer[$a]);
		//$offer_query .= "\r\n $a ($b, size: $size)  ::";
		/*
		
		vertailuoperaattori (matemaattisemmin)
		
		$compare1 = 0; $compare2 = 1; $index = 0;
		$a[$compare1]["index"] = $index;
		for($compare1; $compare1 < $num; $compare1++)
		{
			for($compare2; $compare2 < $num; $compare2++)
			{
				if($a[$compare1] == $a[$compare2])
				{
					$a[$compare1]["index"] += 1;
					array_delete($a[$compare2]);
				}
			}
		}
		*/
		
		
		// vertailuoperaattori (tietokanta-querymmin)
		/*
		for($compare =0; $compare < $num; $compare++)
		{
			$query = "SELECT * FROM product WHERE `data_value` LIKE '$a[$compare]' AND `data_name` LIKE 'manufacturer'";
			$result=mysql_query($query);
			$num=mysql_numrows($result);
			$offer_count = Array();
			$num +=1;
			$offer_count[$a[$compare]] = $num;
			
			// for($i = 0; $i < $num; $i++)
			// {
				// $data_id = mysql_result($result,$i,"idproduct1");
				// $data_value = mysql_result($result,$i,"data_value");
				// $offer_count[$data_value] = $num;
			// }
			
		}
		
		$offer_query .= "Cell: $offer_count\r\n";
		foreach($offer_count as $key => $value)
			{
				$offer_query .= "Name: $key \r\n Count: ($value)\r\n";
			}
		*/
		
		foreach ($b as $c)
		{
			$offer_query .= " $c ($size) <br/>";
			//$offer_query .= " $c ($size) \r\n";
		}
	}
	//$offer_query .= "\r\nEnd of query";
	$offer_query .= "<a href=\"\" style=\"\">N&auml;yt&auml; lis&auml;&auml;</a>";
	$offer_query .= "</div>";
	/*
	$file = "datatext.txt";
	$fh = fopen($file, 'w+');
	fwrite($fh, $offer_query);
	fclose($fh);
	*/
	print $offer_query;
}
else
{
	$data = "";
}

if(isset($_GET['state']) && isset($_GET['product_id']) && isset($_GET['user_id']))
{
	$state = $_GET['state'];
	$product_id = $_GET['product_id'];
	$idprofile = $_GET['user_id'];
	//$product = $_GET['product'];
	//$query = "UPDATE * FROM product WHERE `data_value` LIKE '%$data%' AND `data_name` LIKE 'manufacturer'";
	if($state != "owner" && $state != "cancel")
	{
		//$query = $state . " &amp; " . $product_id  . " &amp; " . $idprofile .  "\r\n";
		$query = "INSERT INTO trade_agreement VALUES ('$idprofile', NOW(), 'proprietor_status_change', '$state','$product_id','','Public')";
		mysql_query($query);
		// $file = "datatext.txt";
		// $fh = fopen($file, 'w+');
		// fwrite($fh, $query);
		// fclose($fh);
		/*
			Varmistus, että kaikki ok. (milloin laitettu myyntiin, millä hinnalla, ...)
		*/
		$query = "SELECT * FROM trade_agreement WHERE `data_name` LIKE 'proprietor_status_change' AND `data_object` LIKE '$product_id'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		for($i = 0; $i < $num; $i++)
		{
			$data_id = mysql_result($result,$i,"idprofile1");
			$data_time = mysql_result($result,$i,"datetime");
			$data_object = mysql_result($result,$i,"data_object");
			$data_value = mysql_result($result,$i,"data_value");
		}
		// $feedpak = "Product $data_object is $data_value since $data_time by $data_id";
		// $file = "datatext.txt";
		// $fh = fopen($file, 'w+');
		// fwrite($fh, $feedpak);
		// fclose($fh);
		
		/*
			AJAX MULTIPLE RESPONSES WITH ONE REQUEST
			http://www.ozzu.com/programming-forum/ajax-multiple-responses-with-one-request-t89454.html
		*/
		
			//print "Product $data_object is  $data_value since $data_time by $data_id";
			$cmd  = "Myynnissä \r\n";
			
			$cmd .= "Product for sale since<br/> $data_time <hr/>";
			$cmd .= "Tapahtuman vaihto:";
			$cmd .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'change','$product_id');\">Vaihtoon</a>";
			$cmd .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'give','$product_id');\">Anna ilmaiseksi</a>";
			$cmd .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'donate','$product_id');\">Lahjoitetaan</a>";
			$cmd .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'auction','$product_id');\">Huutokaupataan</a>";
			$cmd .= "<hr/>Huollettavaksi:";
			$cmd .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','recycle','$product_id');\">Kierrätykseen</a>";
			$cmd .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','warranty','$product_id');\">Takuuseen</a>";
			$cmd .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','repair','$product_id');\">Huoltoon</a>";
			$cmd .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','reclamation','$product_id');\">Reklamoi</a>";
			$cmd .= "<hr/>";
			$cmd .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onClick=\"proprietor_status_price();\">Muuta hintaa</a>";
			$cmd .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onClick=\"update_proprietor_status('$idprofile','$product_id', 'cancel');\">En myyk&auml;&auml;n</a>";
			
			//$cmd .= "Product $data_object is  $data_value since $data_time by $data_id \r\n";
			
			//$cmd .= "(1) \r\n";
			
			//$cmd .= "Buyer available \r\n";;
			$trans = array("ö" => "&ouml;", "ä" => "&auml;", "Ö" => "&Ouml;", "Ä" => "&Auml;", "€" => "&euro;", "—" => "&mdash;");
			// $trans = array("ö" => "&ouml;", "Ö" => "&Ouml;", "Ä" => "&Auml;", "€" => "&euro;", "—" => "&mdash;");
			$cmd .= "\r\n";
			$cmd .= "Product is for sale now. <a href=\"javascript:void(0);\" onClick=\"update_proprietor_status('$idprofile','$product_id', 'cancel');\">Undo<a>. <!--<a href=\"\" style=\"float: right; margin-right: 5px;font-weight: bold;\">Hidden</a>-->";
			$cmd = strtr($cmd, $trans);
			print $cmd;
		
	}
	elseif($state != "owner" && $state == "cancel")
	{
		//$query = $state . " &amp; " . $product_id  . " &amp; " . $idprofile .  "\r\n";
		$query = "DELETE FROM trade_agreement WHERE `idprofile1`='$idprofile' AND `data_name`='proprietor_status_change' AND `data_object`='$product_id'";
		mysql_query($query);
		$product_result = mysql_query("SELECT manufacturer, model, specification FROM product_unifying_factor WHERE `idproduct1`='$product_id'");
		while ($row = mysql_fetch_assoc($product_result)){
			$product_topic = $row['manufacturer'] . " " .$row['model'] . " " .$row['specification'];
		}
		// $file = "datatext.txt";
		// $fh = fopen($file, 'w+');
		// fwrite($fh, $query);
		// fclose($fh);
		/*
			Varmistus, että kaikki ok. (milloin laitettu myyntiin, millä hinnalla, ...)
		*/
		/*
		$query = "SELECT * FROM profile WHERE `data_name` LIKE 'proprietor_status_change' AND `data_object` LIKE '$product_id'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		for($i = 0; $i < $num; $i++)
		{
			$data_id = mysql_result($result,$i,"idprofile1");
			$data_time = mysql_result($result,$i,"datetime");
			$data_object = mysql_result($result,$i,"data_object");
			$data_value = mysql_result($result,$i,"data_value");
		}
		*/
		// $feedpak = "Product $data_object is $data_value since $data_time by $data_id";
		// $file = "datatext.txt";
		// $fh = fopen($file, 'w+');
		// fwrite($fh, $feedpak);
		// fclose($fh);
		
		/*
			AJAX MULTIPLE RESPONSES WITH ONE REQUEST
			http://www.ozzu.com/programming-forum/ajax-multiple-responses-with-one-request-t89454.html
		*/
		
			//print "Product $data_object is  $data_value since $data_time by $data_id";
			
			$cmd  = "Olet omistaja \r\n";
			
			$cmd .= "<div id=\"business_navigation\" style=\"border: 1px solid; width: 150px;float: left;\">";
			$cmd .= "	<!--";
			$cmd .= "	Tuote on ollut sinulla alkaen: pvm.<br/>";
			$cmd .= "	Ostettu käytettynä yksityiskäyttäjältä / <br/>";
			$cmd .= "	uutena / alennusmyynnistä kohteesta Gigantti.<br/>";
			$cmd .= "	Tuotteen käyttöhistoriaa:<br/>";

			$cmd .= "	<a class=\"sample_attach\" href=\"\">Katso lisää....</a>";
			$cmd .= "	<br/>";
			$cmd .= "	<a class=\"sample_attach\" href=\"javascript:alert('Haltijat');\">Haltijat</a>";
			$cmd .= "	<br/>-->";
			$cmd .= "	<div class=\"subcontent\">";
			$cmd .= "	Omistajan vaihto:";
			$cmd .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'sell','$product_id');\">Myyntiin</a>";
			$cmd .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'change','$product_id');\">Vaihtoon</a>";
			$cmd .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'give','$product_id');\">Anna ilmaiseksi</a>";
			$cmd .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'donate','$product_id');\">Lahjoitetaan</a>";
			$cmd .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'auction','$product_id');\">Huutokaupataan</a>";
			$cmd .= "	</div>";
		
			$cmd .= "	<div class=\"subcontent\">";
			$cmd .= "	Huollettavaksi:";
			$cmd .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','recycle','$product_id');\">Kierrätykseen</a>";
			$cmd .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','warranty','$product_id');\">Takuuseen</a>";
			$cmd .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','repair','$product_id');\">Huoltoon</a><!-- Korjaukseen -->";
			$cmd .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','reclamation','$product_id');\">Reklamoi</a>";
			$cmd .= "	</div>";
			$cmd .= "</div>";
			$cmd .= "<div id=\"sale_options\">";
			//$cmd .= "<form action=\"\" method=\"get\">";
			$cmd .= "Tuoteinfoa<br/>";
			$cmd .= "Ostettu {pvm}<br/>";
			$cmd .= "600 muulla ihmisellä on sama tuote";
			//$cmd .= "</form>";
			$cmd .= "</div>";
			$cmd .= "\r\n";
			$cmd .= "You are <a href=\"object.php?id=$product_id\">$product_topic</a>'s owner. Right of return is 14 days (Bought 1 day ago). <a href=\"object.php?id=$product_id&amp;change_state=return\">Return<a>. <a href=\"\" style=\"float: right; margin-right: 5px;font-weight: bold;\">Hidden</a>";
			$cmd .= "<hr/>";
			$cmd .= "This <a href=\"object.php?id=$product_id\">$product_topic</a> is compatible with <a href=\"javascript:void(0);\"  onClick=\"trade_agreement_popup('popup', 'open');\"><b>Standard Part (NaN)</b></a> and <a href=\"javascript:void(0);\"  onClick=\"trade_agreement_popup('popup');\"><b>Add-on Part (NaN)</b></a>.";
			$cmd .= "<a href=\"\" style=\"float: right; margin-right: 5px;font-weight: bold;\">Hidden</a><br/>";
			// $cmd .= "<div id=\"compatible_suggest\">$compatible_suggest</div>";
			//$cmd .= "Product $data_object is  $data_value since $data_time by $data_id \r\n";
			
			//$cmd .= "(1) \r\n";
			
			//$cmd .= "Buyer available \r\n";
			print $cmd;
			
	}
	else
	{
	$file = "datatext.txt";
	$fh = fopen($file, 'w+');
	fwrite($fh, "Owner");
	fclose($fh);
	//$query = "INSERT INTO profile VALUES ('$idprofile', NOW(), 'proprietor_status_change', '$status','$product_id','','Public')";
	}
	//$query = "SELECT * FROM product WHERE `data_value` LIKE '%$data%' AND `data_name` LIKE 'manufacturer'";
	
	// $query = "SELECT * FROM profile WHERE `data_name` LIKE 'proprietor_status_change' AND `data_object` LIKE '$product_id'";
	// $result=mysql_query($query);
	// $num=mysql_numrows($result);
	
	// $proprietor_status = Array();
	// for($i = 0; $i < $num; $i++)
	// {
		// $data_id = mysql_result($result,$i,"idprofile1");
		// $data_name = mysql_result($result,$i,"data_name");
		// $data_value = mysql_result($result,$i,"data_value");
		// $proprietor_status[$data_id][$data_name] = $data_value;
	// }
	// $proprietor_status_content = "";
	// foreach($proprietor_status as $id)
	// {
		// foreach($id as $value)
		// {
			// $status_query .= "$value";
		// }
	// }
	// $file = "datatext.txt";
	// $fh = fopen($file, 'w+');
	// fwrite($fh, $status_query);
	// fclose($fh);
	
}

/*
	
	Frontside SHOWCASE
	- must be lock-in, efficiency and repeat novelty
	
*/
if(isset($_GET['trade_agreement_cancel_for']) && isset($_GET['owner']) && isset($_GET['product']))
{
	$profile = $_GET['trade_agreement_cancel_for'];
	$owner = $_GET['owner'];
	$product_id = $_GET['product'];
	
	mysql_query("DELETE FROM trade_agreement WHERE `idprofile1`='$profile' AND `data_object`='$product_id'");
	print "add_cart($profile,$owner_id,$product_id)\r\nOsta";
}
if(isset($_GET['baby_monitor_for']))
{
	$profile = $_GET['baby_monitor_for'];
	$category_filter = $_GET['category_filter'];
	//$query = $state . " &amp; " . $product_id  . " &amp; " . $idprofile .  "\r\n";
	$info = "";
	$view = "";
	$shortcut = "";
	$buttons = "";
	if($category_filter == "marketflow")
	{
		// $view .= "MARKET FLOW <BR/><br/>";
		$query = "SELECT * FROM trade_agreement WHERE `data_name`='proprietor_status_change'"; // AND `idprofile1` LIKE '$profile'";
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
		// foreach($market_content as  $product_id => $profile_id)
		foreach($market_content as $product_id => $content)
		{
			// print "0: $product_id => $content <br/>";
			foreach($content as $name => $value)
			{
				// print "$name => $value";
				// if($name == "category") {$category = $value;}
				if($name == "profile_id") {$strange_profile_id = $value;}
				

			// $dii .= "$profile_id => $product_id";
			// print $dii;
			
			/*	user info	
			$query = "SELECT * FROM profile WHERE `idprofile1`='$profile_id'"; // AND `idprofile1` LIKE '$profile'";
			$user_result=mysql_query($query);
			$user_num=mysql_numrows($user_result);
			
			$product_content = Array();
			for($i = 0; $i < $user_num; $i++)
			{
				//$product_id = mysql_result($result,$i,"idprofile1");
				$product_name = mysql_result($user_result,$i,"data_name");
				$product_value = mysql_result($user_result,$i,"data_value");
				//$product_object = mysql_result($result,$i,"data_object");
				$product_content[$product_name] = $product_value;
			}
			
			
			foreach($product_content as $name => $value)
			{
				if($name == "firstname") {$info .= "$value";}
				if($name == "lastname") {$info .= " $value";}
			} */
			
			/*	 product info	*/
			
			$showcase_content = mysql_query("SELECT * FROM product_unifying_factor WHERE `idproduct1`='$product_id'"); // AND `idprofile1` LIKE '$profile'";
			while ($row = mysql_fetch_assoc($showcase_content)) {
					$idproduct = $row['idproduct1'];
					$product_time = $row['updated_stamp']; /* $updated_stamp */
					$manufacturer = $row['manufacturer'];
					$model = $row['model'];
					$specification = $row['specification'];
					$product_desc ="$manufacturer $model $specification";
			$info .= "<div id=\"$product_time\" style=\"margin: 5px;width: 155px; float: left;\">";
			$buttons .= "<input type=\"button\" value=\"Osta\" onClick=\"add_cart('$profile','$strange_profile_id', '$product_id');\" style=\"float: left;margin-top: -25px;margin-left: 115px;  position: absolute;\">";
			$buttons .= "<input type=\"button\" value=\"Tutustu\" style=\"float: left;margin-top: -25px;margin-left: 65px;\">";
			$buttons .= "<input type=\"button\" value=\"Vertaa\" style=\"float: left;margin-top: -25px;margin-left: 20px;\">";
			$info .= "<img src=\"\" style=\"width:150px;height:150px;\" /><br/>";
			$info .= $buttons;
			$info .= "<a href=\"object.php?id=$product_id\">".$product_desc."</a>";
			$info .= "<br/> Added ".$product_time . " " . date("F j, Y, g:i a");
			$info .= "</div>";
			$shortcut .= "<a href=\"object.php?id=$product_id\"><img src=\"\" style=\"width:50px; height: 50px;\" title=\"$product_desc\"></a>";
			}
			/*
			$query = "SELECT * FROM product WHERE `idproduct1`='$product_id'"; // AND `idprofile1` LIKE '$profile'";
			$product_result=mysql_query($query);
			$product_num=mysql_numrows($product_result);
			
			// tätä pitää muokata enemmän
			// $info .= " myy tuotetta ";
			
			$product_content = Array();
			for($i = 0; $i < $product_num; $i++)
			{
				//$product_id = mysql_result($result,$i,"idprofile1");
				$product_time = mysql_result($product_result,$i,"datetime");
				$product_name = mysql_result($product_result,$i,"data_name");
				$product_value = mysql_result($product_result,$i,"data_value");
				//$product_object = mysql_result($result,$i,"data_object");
				$product_content[$product_name] = $product_value;
			}
			$product_desc = "";
			$buttons = "";
			$info .= "<div id=\"$product_time\" style=\"margin: 5px;width: 155px; float: left;\">";
			foreach($product_content as $name => $value)
			{
				if($name == "category") {$category = "$value <br/>";}
				if($name == "manufacturer") {$product_desc .= "$value ";}
				if($name == "model") {$product_desc .= "$value ";}
				if($name == "specification") {$product_desc .= "$value ";}
			}
			// $buttons .= "<a href=\"\" value=\"Osta\" onClick=\"add_cart(\'$profile_id\', \'$product_id\');\" style=\"float: left;margin-top: 0px;margin-left: 115px;\">Osta</a>";
			$buttons .= "<input type=\"button\" value=\"Osta\" onClick=\"add_cart('$profile','$strange_profile_id', '$product_id');\" style=\"float: left;margin-top: -25px;margin-left: 115px;  position: absolute;\">";
			$buttons .= "<input type=\"button\" value=\"Tutustu\" style=\"float: left;margin-top: -25px;margin-left: 65px;\">";
			$buttons .= "<input type=\"button\" value=\"Vertaa\" style=\"float: left;margin-top: -25px;margin-left: 20px;\">";
			// $info .= "<br/>";
			$info .= "<img src=\"\" style=\"width:150px;height:150px;\" /><br/>";
			$info .= $buttons;
			$info .= "<a href=\"object.php?id=$product_id\">".$product_desc."</a>";
			// $info .= "<img src=\"\" style=\"width:50px;height:50px;\" />";
			// $info .= "<img src=\"\" style=\"width:50px;height:50px;\" />";
			// $info .= "<img src=\"\" style=\"width:50px;height:50px;\" />";
			// $info .= "<img src=\"\" style=\"width:50px;height:50px;\" />";
			// $info .= "<img src=\"\" style=\"width:50px;height:50px;\" />";
			// $view .= strtoupper($category);
			$info .= "<br/> Added ".$product_time . " " . date("F j, Y, g:i a");
			// $info .= "<hr style=\"margin-top: 15px;\"/>";
			$info .= "</div>";
			$shortcut .= "<a href=\"object.php?id=$product_id\"><img src=\"\" style=\"width:50px; height: 50px;\" title=\"$product_desc\"></a>";
			
			// $info .= "<br/>";
			*/
			}
		}
	}
	else
	{
		$view .= strtoupper($category_filter);
	}
	// print "<fieldset style=\"border: 1 0 solid;\"><legend> Classified by Category / Market model / Location / Deals / Domain</legend>";
	$info .="<div style=\"clear: left; border: 1px solid; border-color: navyblue;margin: 5;padding: 10 20;background-color: lightblue;\">";
	$info .="No more content to view. <a href=\"\">Begin</a> the trade agreement with your product.";
	$info .="</div>";
	
	$view .= $info;
	$view .= "\r\n";
	$view .= $shortcut;
	print $view;
	// print "</fieldset>";
	//print $dii;
	// $file = "datatext.txt";
	// $fh = fopen($file, 'w+');
	// fwrite($fh, "tulos: $dii");
	// fclose($fh);
	
	//$alarm = "\r\n";
}
function estimate_picture($picture_id, $profileid, $tags)
{
	$good_quality_basics = Array("Luontokuva", "Ryhmäkuva", "digi/filmi","mustavalko/värillinen", "Design","");
	$poor_quality_basics = Array("");
}
if(isset($_GET['add_cart']))
{
	
	$product_id = $_GET['add_cart'];
	$profile_id = $_GET['profile_id'];
	$seller_id = $_GET['seller_id'];
	$query = "INSERT INTO trade_agreement VALUES ('$profile_id',NOW(),'trade_agreement_valid_status_a_prospective_purchaser','$seller_id','$product_id','','Public')";
	// $query = "INSERT INTO profile VALUES ('$idprofile', NOW(), 'product', 'owner','$product_id','','Only Me')";
	
	mysql_query($query);
	$cart_query = "SELECT * FROM trade_agreement WHERE `idprofile1` LIKE '$profile_id' AND `data_name`='trade_agreement_valid_status_a_prospective_purchaser'";
	$result=mysql_query($cart_query);
	$num=mysql_numrows($result);
	$cart_list = Array();
	for($i = 0; $i < $num; $i++)
	{
		$seller = mysql_result($result,$i,"data_value");
		$object = mysql_result($result,$i,"data_object");
		$cart_list[$seller] = $object;
	}
	$cart  = "";
	foreach($cart_list as $seller => $object)
	{
		// $product_query = "SELECT * FROM product WHERE `idproduct1` LIKE '$object'";
		$product_query = mysql_query("SELECT * FROM product_unifying_factor WHERE `idproduct1` LIKE '$object'");
		while ($row = mysql_fetch_assoc($product_query)) {
					$manufacturer = $row['manufacturer'];
					$model = $row['model'];
					$specification = $row['specification'];
					$link = "";
					$image = mysql_query("SELECT object FROM multimedia WHERE `idproduct1` LIKE '$object'");
					while ($row = mysql_fetch_assoc($image)) {
						$picture = $row['object'];
						$link .= "upload/$object.$picture";
					}
					$cart .= "<img src=\"$link\" style=\"width:50px; height:50px;\" title=\"";
					$cart .= "$manufacturer $model $specification";
					$cart .= "\" />";
		}
		// $cart_content_query = mysql_query("SELECT * FROM trade_agreement WHERE `idprofile1` LIKE '$profile_id'");
		// $cart_content_size = mysql_num_rows($cart_content_query);
		/*
		$product_result=mysql_query($product_query);
		$product_num=mysql_numrows($product_result);
		// $cart_list = Array();
		$cart .= "<img src=\"\" style=\"width:50px; height:50px;\" title=\"";
		for($i = 0; $i < $product_num; $i++)
		{
			$name = mysql_result($product_result,$i,"data_name");
			$value = mysql_result($product_result,$i,"data_value");
			if($name == "manufacturer") {$cart .= "$value ";}
			if($name == "model") {$cart .= "$value ";}
			if($name == "specification") {$cart .= "$value ";}
			// $cart_list[$seller] = $object;
		}
		$cart .= "\" />";
		*/
	}
	print "$cart\r\n cancel('$profile_id','$seller_id', '$product_id'); \r\n X \r\n<a id=\"cart_button\" href=\"javascript:void(0);\" onClick=\"start_menu('cart','view');\"><b>$num</b> try in a cart</a>";
}

// testiosa, poista toinen 's' kohdasta sstorage_id seuraavalta riviltä 
if(isset($_GET['sstorage_id']) && isset($_GET['profile_id']))
{ // category
	
	print "joo";
}

/*

	FOR INTERIOIR DESIGN TOOL

*/

/*
	see place_in
*/

// if(isset($_GET['place_in']) && isset($_GET['product_id']) && isset($_GET['profile_id']))

if(isset($_GET['product_id']) && isset($_GET['profile_id']) && isset($_GET['this_content_is_unavailable_not_NEEDED']))
{
	// $place_in = $_GET['place_in'];
	
	$product_id = $_GET['product_id'];
	$profile_id = $_GET['profile_id'];
	
	// if(($_GET['move_from_storage'] == "") && isset($_GET['move_to_storage']))
	print " from ". $_GET['move_from_storage'] . " to " . $_GET['move_to_storage'] . "<br/>";
	if("unseeded" == $_GET['move_from_storage'])
	{	
		$move_to_storage = $_GET['move_to_storage'];
		$query = "UPDATE product SET `data_object`='$move_to_storage' WHERE `idproduct1`='$product_id' AND `data_name`='category'";
		$query .= "<br/>1. vaihtoehto";
		print $query;
		// $move_from_storage = $move_to_storage;
		// $move_to_storage = ""; // $move_from_storage
		
	}
	elseif("unseeded" == $_GET['move_to_storage'])
	{
		$move_to_storage = "";
		$query = "UPDATE product SET `data_object`='$move_to_storage' WHERE `idproduct1`='$product_id' AND `data_name`='category'";
		$query .= "<br/>2. vaihtoehto";
		print $query;
	}
	else
	{
		$move_to_storage = $_GET['move_to_storage'];
		$query = "UPDATE product SET `data_object`='$move_to_storage' WHERE `idproduct1`='$product_id' AND `data_name`='category'";
		$query .= "<br/>3. vaihtoehto";
		print $query;
		// $move_from_storage = $move_to_storage;
		// $move_to_storage = ""; // $move_from_storage
	}
	/*
	print "place in: $place_in";
	$cancel = strpos('unseeded_', $place_in);
	print "joo: $cancel";
	if($cancel === false)
	{
		list($storage_id, $place_in) = split('#', $place_in);
		print "storage: $storage_id &amp; cmd: $place_in";
		if($place_in == "unseeded")
		{
			$place_in = "";
			// connect product for virtual room via category
			$query = "UPDATE product SET `data_object`='$place_in' WHERE `idproduct1`='$product_id' AND `data_name`='category'";
			$query .= "<br/>profile: $profile_id";
			$query .= "<br/>storage: $storage_id";
			print $query;
		}
	}
	else
	{
		$query = "UPDATE product SET `data_object`='$place_in' WHERE `idproduct1`='$product_id' AND `data_name`='category'";
		$query .= "<br/>profile: $profile_id";
		print $query;
	}*/
	
	
	// mysql_query($query);
	// interior_design_tool($storage_id, $profile_id);
	// interior_design_tool($move_from_storage, $move_to_storage, $profile_id);
}

/*
	see place_in
*/
if(isset($_GET['move_to_storage']) && isset($_GET['profile_id']))
{
	if(isset($_GET['move_from_storage']))
	{
	$move_from_storage = $_GET['move_from_storage'];
	}
	else { $move_from_storage = ""; }
	$move_to_storage = $_GET['move_to_storage'];
	$profile_id = $_GET['profile_id'];
	
	interior_design_tool($move_from_storage, $move_to_storage, $profile_id);
}
/*
	functions for IDT
*/

if(isset($_GET['place_in']))
{
	if(isset($_GET['product_id']))
	{
		if(isset($_GET['move_from_storage']) && "" != $_GET['move_from_storage'])
		{
			$move_from_storage = $_GET['move_from_storage'];
		}
		else {$move_from_storage = "unseeded";}
		$move_to_storage = $_GET['move_to_storage'];
		$product_id = $_GET['product_id'];
		$profile_id = $_GET['profile_id'];
		
		idt_save_changes($move_from_storage, $move_to_storage, $product_id, $profile_id);
		
	}
	elseif(isset($_GET['move_to_storage']))
	{
		if(isset($_GET['move_from_storage']))
		{
			$move_from_storage = $_GET['move_from_storage'];
		}
		else { $move_from_storage = ""; }
		$move_to_storage = $_GET['move_to_storage'];
		$profile_id = $_GET['profile_id'];
		
		interior_design_tool($move_from_storage, $move_to_storage, $profile_id);
	}
	
}
function idt_save_changes($move_from_storage, $move_to_storage, $product_id, $profile_id)
{
	
	// $place_in = $_GET['place_in'];
	
	$product_id = $_GET['product_id'];
	$profile_id = $_GET['profile_id'];
	
	// if(($_GET['move_from_storage'] == "") && isset($_GET['move_to_storage']))
	// print " from ". $_GET['move_from_storage'] . " to " . $_GET['move_to_storage'] . "<br/>";
	// if("unseeded" == $_GET['move_from_storage'])
	if("unseeded" == $move_from_storage)
	{	
		// $move_to_storage = $_GET['move_to_storage'];
		$query = "UPDATE product SET `data_object`='$move_to_storage' WHERE `idproduct1`='$product_id' AND `data_name`='category'";
		
		mysql_query($query);
		
		$query .= "<br/>1. vaihtoehto";
		print $query;
		// $move_from_storage = $move_to_storage;
		// $move_to_storage = ""; // $move_from_storage
		interior_design_tool($move_from_storage, $move_to_storage, $profile_id);
	}
	// elseif("unseeded" == $_GET['move_to_storage'])
	elseif("unseeded" == $move_to_storage)
	{
		$move_to_storage = "";
		$query = "UPDATE product SET `data_object`='$move_to_storage' WHERE `idproduct1`='$product_id' AND `data_name`='category'";
		mysql_query($query);
		$query .= "<br/>2. vaihtoehto";
		// print $query;
		interior_design_tool($move_from_storage, $move_to_storage, $profile_id);
	}
	else
	{
		// $move_to_storage = $_GET['move_to_storage'];
		$query = "UPDATE product SET `data_object`='$move_to_storage' WHERE `idproduct1`='$product_id' AND `data_name`='category'";
		
		// print $query;
		mysql_query($query);
		$query .= "<br/>3. vaihtoehto";
		// $move_from_storage = $move_to_storage;
		// $move_to_storage = ""; // $move_from_storage
		interior_design_tool($move_from_storage, $move_to_storage, $profile_id);
	}
}

if(isset($_GET['profile_id']) && isset($_GET['profile_id']) && isset($_GET['product_id']) && isset($_GET['product_property_name']) && isset($_GET['product_property_value']))
{
	$update_information = $_GET['update_information'];
	$product_id = $_GET['product_id'];
	$profile_id = $_GET['profile_id'];
	$product_property_name = $_GET['product_property_name'];
	$product_property_value = $_GET['product_property_value'];
	update_information($update_information, $profile_id, $product_id, $product_property_name, $product_property_value);
}

function update_information($update_information, $profile_id, $product_id, $product_property_name, $product_property_value)
{
	if($update_information == "add")
	{
		$query = "UPDATE product SET `data_value`='$product_property_value' WHERE `idproduct1`='$product_id' AND `data_name`='$product_property_name'";
		mysql_query($query);
	}
	if($update_information == "update")
	{
		$query = "UPDATE product SET `data_value`='$product_property_value' WHERE `idproduct1`='$product_id' AND `data_name`='$product_property_name'";
		mysql_query($query);
	}
	if($update_information == "delete")
	{
		$query = "UPDATE product SET `data_value`='' WHERE `idproduct1`='$product_id' AND `data_name`='$product_property_name'";
		mysql_query($query);
	}
}

if(isset($_GET['shared_room']) && isset($_GET['residential_target']))
{
	$shared_room = $_GET['shared_room'];
	$residential_target = $_GET['residential_target'];
	shared_room($residential_target, $shared_room);
}

function shared_room($residential_target, $shared_room)
{
	$view  = "";
	$view .= "<table>";
	$view .= "<tr><th rows=\"2\">Laite</th><th>Monday<";
}

if(isset($_GET['suggest_product']))
{
	$suggest_product = $_GET['suggest_product'];
	// $profile_id = $_GET['profile_id'];
	// connection_menu($profile_id, $connection_menu);
	suggest_product($suggest_product, $idprofile, $category, $name);
}

function suggest_product($suggest_product, $idprofile, $category, $name)
{
	$view  = "";
	$view .= "<h2>Mitä puuttuu?</h2>";
	$view .= "<ul>";
	$view .= "<li>Kategoria <input type=\"text\" name=\"category\"> (e.g. Vehicle)</li>";
	$view .= "<li>Tavara <input type=\"text\" name=\"product\"> (e.g. Motorcycle)</li>";
	$view .= "</ul>";
	$view .= "<input type=\"submit\" value=\"Ehdota\" />";
}

// if(isset($_GET['connection_menu']) && isset($_GET['profile_id']))
if(isset($_GET['connection_menu']))
{
	$connection_menu = $_GET['connection_menu'];
	// $profile_id = $_GET['profile_id'];
	// connection_menu($profile_id, $connection_menu);
	connection_menu($connection_menu);
}

// function connection_menu($profile_id, $connection_menu)
function connection_menu($connection_menu)
{
	
	$trade_agreement_collection = Array("trade_agreement_valid_status_accept_intro_buyer",
											"trade_agreement_valid_status_accept_buyer",
											"trade_agreement_valid_status_confirm_payment",
											"trade_agreement_valid_status_confirm_transfer",
											"trade_agreement_valid_status_confirm_receiving", 
											"trade_agreement_valid_status_confirm_grade");
	$trade_agreement_management = Array();
	$test = "";
	if($connection_menu == "similar")
	{
		$test .=	"<select id=\"connection_menu_select\" name=\"connection_o\" style=\"float: left; background-color: #CECECE; font-weight: bold;\" onChange=\"connection_menu();\">";
		$test .=	"<option value=\"similar\" onClick=\"connection_menu('similar');\" selected=\"selected\">Similar</option>";
		$test .=	"<option value=\"includes\" onClick=\"connection_menu('includes');\">Includes</option>";
		$test .=	"<option value=\"part_of\" onClick=\"connection_menu('part_of');\">Part of</option>";
		$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Compatible</option>";
		$test .=	"</select>";
		for($complete = 0;$complete < 6; $complete++)
		{
			if(!array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
			{
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_intro_buyer")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your interest\" style=\"text-decoration: none;\">Name</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_buyer")
				{
				$test .=	"<li style=\"float: left; width: 85px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your accepting\" style=\"text-decoration: none;\">Location</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_payment")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your paying\" style=\"text-decoration: none;\">Price</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_transfer")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your transforming\" style=\"text-decoration: none;\">Newness</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_receiving")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your receiving\" style=\"text-decoration: none;\">Discount</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_grade")
				{
				$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your grade\" style=\"text-decoration: none;\">Grade</a></li>";
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
	$list  = "";
	$list .= "<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$list .= "<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$list .= "Asus P6T <label style=\"float: right;\"><input type=\"button\" value=\"Osta\" /></label>";
	$list .= "<br/>2 minutes ago";
	$list .= "<label style=\"float: right;\"><b>Hinta</b> 500 €</label>";
	$list .= "</div>";
	$list .= "<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$list .= "<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$list .= "Asus P6T <label style=\"float: right;\"><input type=\"button\" value=\"Osta\" /></label>";
	$list .= "<br/>2 minutes ago";
	$list .= "<label style=\"float: right;\"><b>Hinta</b> 500 €</label>";
	$list .= "</div>";
	$list .= "<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$list .= "<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$list .= "Asus P6T <label style=\"float: right;\"><input type=\"button\" value=\"Osta\" /></label>";
	$list .= "<br/>2 minutes ago";
	$list .= "<label style=\"float: right;\"><b>Hinta</b> 500 €</label>";
	$list .= "</div>";
	$list .= "<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$list .= "<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$list .= "Asus P6T <label style=\"float: right;\"><input type=\"button\" value=\"Osta\" /></label>";
	$list .= "<br/>2 minutes ago";
	$list .= "<label style=\"float: right;\"><b>Hinta</b> 500 €</label>";
	$list .= "</div>";
	}
	if($connection_menu == "includes")
	{
		$test .=	"<select id=\"connection_menu_select\" name=\"connection_o\" style=\"float: left; background-color: #CECECE; font-weight: bold;\" onChange=\"connection_menu();\">";
		$test .=	"<option value=\"similar\" onClick=\"connection_menu('similar');\">Similar</option>";
		$test .=	"<option value=\"includes\" onClick=\"connection_menu('includes');\" selected=\"selected\">Includes</option>";
		$test .=	"<option value=\"part_of\" onClick=\"connection_menu('part_of');\">Part of</option>";
		$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Compatible</option>";
		$test .=	"</select>";
		for($complete = 0;$complete < 6; $complete++)
		{
			if(!array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
			{
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_intro_buyer")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your interest\" style=\"text-decoration: none;\">Standard Parts</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_buyer")
				{
				$test .=	"<li style=\"float: left; width: 85px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your accepting\" style=\"text-decoration: none;\">Add-Ons</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_payment")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your paying\" style=\"text-decoration: none;\">Open Positions</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_transfer")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your transforming\" style=\"text-decoration: none;\">Broken Positions</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_receiving")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your receiving\" style=\"text-decoration: none;\">Active Positions</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_grade")
				{
				$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your grade\" style=\"text-decoration: none;\">Grade</a></li>";
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
	$list  = "<h2>Includes</h2>";
	$list .= "<div id=\"swot\" style=\"display:none;background-color: #ffffff;top: 41%;left: 25%;width: 300px;border: 1px solid;\">";
	$list .="<h4>Vahvuudet</h4>";
	$list .="<li>Powerpoint</li>";
	$list .="<li>Word</li>";
	$list .="<li>Excl</li>";
	$list .="<h4>Heikkoudet</h4>";
	$list .="Doesn't work without components:<br/>";
	$list .="Ei tukea käyttöjärjestelmille:";
	$list .="<h4>Mahdollisuudet</h4>";
	$list .="You can upload your documents to ...";
	$list .="<h4>Uhat</h4>";
	$list .="Competitors<br/>";
	$list .="<a href=\"\">OpenOffice</a>";
	$list .="</div>";
	$list .= "<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$list .= "<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$list .= "Microsoft Office 2013 <label style=\"float: right;\"><input type=\"button\" value=\"Päivitä\" /><input type=\"button\" value=\"Poista\" /></label>";
	$list .= "<br/>2 minutes ago  · Via <a href=\"\">Windows 7</a>  · <a href=\"javascript:void(0);\" onmouseover=\"swot();\">SWOT</a><!--· <a href=\"\">Advantages</a>  · <a href=\"\">7 dependences</a>-->";
	// $list .= "<label style=\"float: right;\">Käytössäsi on versio 1. Päivitä se versioon 2.</label>";
	$list .= "</div>";
	$list .= "<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$list .= "<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$list .= "Minecraft <label style=\"float: right;\"><input type=\"button\" value=\"Päivitä\" /><input type=\"button\" value=\"Poista\" /></label>";
	$list .= "<br/>2 minutes ago";
	// $list .= "<label style=\"float: right;\">Käytössäsi on versio 2. Päivitä se versioon 3.</label>";
	$list .= "</div>";
	$list .= "<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$list .= "<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$list .= "F-Secure <label style=\"float: right;\"><input type=\"button\" value=\"Päivitä\" /><input type=\"button\" value=\"Poista\" /></label>";
	$list .= "<br/>2 minutes ago";
	// $list .= "<label style=\"float: right;\">Käytössäsi on versio 3. Päivitä se versioon 4.</label>";
	$list .= "</div>";
	$list .= "<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$list .= "<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$list .= "Mozilla Firefox 11 <label style=\"float: right;\"><input type=\"button\" value=\"Päivitä\" /><input type=\"button\" value=\"Poista\" /></label>";
	$list .= "<br/>2 minutes ago";
	// $list .= "<label style=\"float: right;\">Käytössäsi on versio 10. Päivitä se versioon 11.</label>";
	$list .= "</div>";
	}
	if($connection_menu == "part_of")
	{
		$test .=	"<select id=\"connection_menu_select\" name=\"connection_o\" style=\"float: left; background-color: #CECECE; font-weight: bold;\" onChange=\"connection_menu();\">";
		$test .=	"<option value=\"similar\" onClick=\"connection_menu('similar');\">Similar</option>";
		$test .=	"<option value=\"includes\" onClick=\"connection_menu('includes');\">Includes</optiond>";
		$test .=	"<option value=\"part_of\" onClick=\"connection_menu('part_of');\" selected=\"selected\">Part of</option>";
		$test .=	"<option value=\"compatible\" onClick=\"connection_menu('');\">Compatible</option>";
		$test .=	"</select>";
		
		for($complete = 0;$complete < 6; $complete++)
		{
			if(!array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
			{
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_intro_buyer")
				{
				$test .=	"<li style=\"float: left; width: 85px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your interest\" style=\"text-decoration: none;\">Current</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_buyer")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your accepting\" style=\"text-decoration: none;\">Other You Have</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_payment")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"Products from private sellers\" style=\"text-decoration: none;\">Second-hand</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_transfer")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"Products from public organizations\" style=\"text-decoration: none;\">Newness</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_receiving")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your receiving\" style=\"text-decoration: none;\">Receiving</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_grade")
				{
				$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your grade\" style=\"text-decoration: none;\">Grade</a></li>";
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
	$list  = "<h2>Part Of</h2>";
	$list .= "<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$list .= "<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$list .= "Keskusyksikkö <label style=\"float: right;\"><input type=\"button\" value=\"Päivitä\" /><input type=\"button\" value=\"Poista\" /></label>";
	$list .= "<br/>2 minutes ago";
	$list .= "<label style=\"float: right;\">Käytössäsi on versio 1. Päivitä se versioon 2.</label>";
	$list .= "</div>";
	}
	if($connection_menu == "compatible")
	{
		$test .=	"<select id=\"connection_menu_select\" name=\"connection_o\" style=\"float: left; background-color: #CECECE; font-weight: bold;\" onChange=\"connection_menu();\">";
		$test .=	"<option value=\"similar\" onClick=\"connection_menu('similar');\">Similar</option>";
		$test .=	"<option value=\"includes\" onClick=\"connection_menu('includes');\">Includes</option>";
		$test .=	"<option value=\"part_of\" onClick=\"connection_menu('part_of');\">Part of</option>";
		$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\" selected=\"selected\">Compatible</option>";
		$test .=	"</select>";
		
		for($complete = 0;$complete < 6; $complete++)
		{
			if(!array_key_exists($trade_agreement_collection[$complete], $trade_agreement_management))
			{
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_intro_buyer")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"Standard Parts from Private Sellers\" style=\"text-decoration: none;\">Standard Parts</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_buyer")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"Add-On Parts from Private Sellers\" style=\"text-decoration: none;\">Add-On Parts</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_payment")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"Standard Parts from Your Storage\" style=\"text-decoration: none;\">Standard Parts</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_transfer")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"Add-On Parts from Your Storage\" style=\"text-decoration: none;\">Add-On Parts</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_receiving")
				{
				$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your receiving\" style=\"text-decoration: none;\">Receiving</a></li>";
				}
				if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_grade")
				{
				$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$trade_agreement_collection[$complete]');\" title=\"3 products waiting your grade\" style=\"text-decoration: none;\">Grade</a></li>";
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
	$list  = "<h2>Compatible</h2>";
	$list .= "<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$list .= "<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$list .= "PS/2 Mouse <label style=\"float: right;\"><input type=\"button\" value=\"Osta\" /><input type=\"button\" value=\"Poista\" /></label>";
	$list .= "<br/>2 minutes ago";
	$list .= "<label style=\"float: right;\">Käytössäsi on versio 1. Päivitä se versioon 2.</label>";
	$list .= "</div>";
	}
	$test .=	"</ul>";
	

	$return = $test;
	$return .= "\r\n";
	$return .= $list;
	$trans = array("ö" => "&ouml;", "ä" => "&auml;", "Ö" => "&Ouml;", "Ä" => "&Auml;", "€" => "&euro;", "—" => "&mdash;");
	$return = strtr($return, $trans);
	print $return;
}

if(isset($_GET['search_connector']))
{
	$q = $_GET['search_connector'];
	$this_product_id = $_GET['this_product_id'];
	
	
	//if($q == 1337)
	//{
		$q_split = explode(" ", $q);
		//count($q_split);
		$conn_name = !empty($q_split[0]) ? $q_split[0] : "name";
		$conn_model = !empty($q_split[1]) ? $q_split[1] : "model";
		$conn_specification = !empty($q_split[2]) ? $q_split[2] : "specification/version";
		$conn_gender = !empty($q_split[3]) ? $q_split[3] : "gender";
		$conn_year = !empty($q_split[4]) ? $q_split[4] : "year";
	//}
	
	if(isset($_GET['search_limit']))
	{
		$sl = $_GET['search_limit'];
		list($from, $end) = explode(",", $sl);
		$limit = "limit ".$from.",".$end;
	}
	else
	{
		$limit = "limit 0,5;";
	}
	$result = mysql_query("select * from connector_info where `name`='$q' $limit");
	$result_info  = "";
	$num=mysql_numrows($result);
	if($this_product_id != "undefined")
	{ // mikäli ei tuote-id tuntematon, laitetaan liitintiedot taulukkoon.
		if($num > 0)
		{
			while ($row = mysql_fetch_assoc($result)) {
						$connector_id = $row['connector_id'];
						$name = $row['name'];
						$gender = $row['gender'];
			$result_info .= "<div id=\"$connector_id\" style=\"border-bottom:1px solid;border-color:#bbb;padding:5;\">";
			$result_info .= "<a href=\"javascript:void(0);\" onClick=\"select_connector('target','id');\" title=\"this id: $this_product_id, $connector_id\"><img src=\"\">$name ($gender)</a>";
			$result_info .= "<span id=\"conn_mgmt_$connector_id\" style=\"float:right;margin: 0 5 0 0;\">";
			$result_info .= "<input id=\"conn_mgmt_remove_$connector_id\" class=\"conn_mgmt_remove\" type=\"button\" value=\"Remove\" onClick=\"select_connector('$this_product_id','$connector_id','remove','');\" disabled=\"disabled\"> <!-- select_connector('target','id'); -->";
			$result_info .= "<span id=\"conn_mgmt_count_$connector_id\"></span>";
			$result_info .= "<input id=\"conn_mgmt_add_$connector_id\" class=\"conn_mgmt_add\" type=\"button\" value=\"Add\" onClick=\"select_connector('$this_product_id','$connector_id','add','');\">";
			$result_info .= "</span></div>";
			// $result_info .= "<div id=\"id\"><a href=\"javascript:void(0);\" onClick=\"select_connector('target','id');\"><img src=\"\">$object[name]</a></div>";
			}
			$result_info .= "<br/>or <a href=\"javascript:void(0);\" onclick=\"\">add</a> new connector.";
		}
		else
		{
			// $result_info .= "...So <a href=\"javascript:void(0);\" onclick=\"\">add</a> new connector.";
			$result_info .= "...So add new connector.";
			$result_info .= "<form method=\"get\" name=\"new_connector\">";
			$result_info .= "<input type=\"hidden\" class=\"new_connector\" name=\"action_for_new_connector\" value=\"create\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"hidden\" class=\"new_connector\" name=\"new_connector[product_id]\" value=\"$this_product_id\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"\" class=\"new_connector\" name=\"new_connector[name]\" value=\"$conn_name\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"\" class=\"new_connector\" name=\"new_connector[model]\" value=\"$conn_model\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"\" class=\"new_connector\" name=\"new_connector[specification]\" value=\"$conn_specification\" style=\"margin:5 10;\">";
			// $result_info .= "<input type=\"\" value=\"genre\" style=\"margin:5 10;\">";
			$result_info .= "<select class=\"new_connector\" name=\"new_connector[gender]\" value=\"$conn_gender\" style=\"margin:5 10;\">";
			$result_info .= "<option value=\"\">Gender:</option>";
			$result_info .= "<option value=\"male\">male</option>";
			$result_info .= "<option value=\"female\">female</option>";
			$result_info .= "</select>";
			$result_info .= "<input type=\"\" class=\"new_connector\" name=\"new_connector[year]\" value=\"$conn_year\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"file\" class=\"new_connector\" name=\"new_connector[photo]\" value=\"connector_photo\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"button\" onclick=\"create_new_connector();\" value=\"Done\" style=\"margin:5 10;float:right;background-color:blue;color:#ffffff;\">";
			$result_info .= "</form>";
			// $result_info .= "sooo";
		}
	}
	else
	{
		if($num > 0)
		{
			while ($row = mysql_fetch_assoc($result)) {
						$connector_id = $row['connector_id'];
						$name = $row['name'];
						$gender = $row['gender'];
						$connector = Array();
						$connector["connector_id"] = $connector_id;
						$connector["name"] = $name;
						$connector["gender"] = $gender;
						$connector["count"] = 1;
						// http://php.net/manual/en/function.json-encode.php
						//$jsonconnector = addslashes(json_encode($connector, JSON_FORCE_OBJECT));
						$jsonconnector = str_replace('"','&quot;',json_encode($connector, JSON_FORCE_OBJECT));
						// http://stackoverflow.com/questions/4638089/json-string-as-javascript-function-argument
						// http://stackoverflow.com/questions/2843808/php-how-to-replace-quotes
						// http://stackoverflow.com/questions/6502107/how-to-pass-php-array-parameter-to-javascript-function/6502154#6502154
						
						//$jsonconnector = 1;
			$result_info .= "<div id=\"$connector_id\" style=\"border-bottom:1px solid;border-color:#bbb;padding:5;\">";
			$result_info .= "<a href=\"javascript:void(0);\" onClick=\"select_connector('target','id');\" title=\"this id: $this_product_id, $connector_id\"><img src=\"\">$name ($gender)</a>";
			$result_info .= "<span id=\"conn_mgmt_$connector_id\" style=\"float:right;margin: 0 5 0 0;\">";
			$result_info .= "<input id=\"conn_mgmt_remove_$connector_id\" class=\"conn_mgmt_remove\" type=\"button\" value=\"Remove (u)\" disabled=\"disabled\"";
			$result_info .= " onClick=\"select_connector('$this_product_id','$jsonconnector','remove','');\">";
			$result_info .= "<span id=\"conn_mgmt_count_$connector_id\"></span>";
			$result_info .= "<input id=\"conn_mgmt_add_$connector_id\" class=\"conn_mgmt_add\" type=\"button\" value=\"Add (u)\" onClick=\"select_connector('$this_product_id','$jsonconnector','add','');\">";
			$result_info .= "</span></div>";
			// $result_info .= "<div id=\"id\"><a href=\"javascript:void(0);\" onClick=\"select_connector('target','id');\"><img src=\"\">$object[name]</a></div>";
			}
			$result_info .= "<br/>or <a href=\"javascript:void(0);\" onclick=\"\">add</a> new connector.";
		}
		else
		{
			// $result_info .= "...So <a href=\"javascript:void(0);\" onclick=\"\">add</a> new connector.";
			$result_info .= "...So add new connector.";
			$result_info .= "<form method=\"get\" name=\"new_connector\">";
			$result_info .= "<input type=\"hidden\" class=\"new_connector\" name=\"action_for_new_connector\" value=\"create\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"hidden\" class=\"new_connector\" name=\"new_connector[product_id]\" value=\"$this_product_id\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"\" class=\"new_connector\" name=\"new_connector[name]\" value=\"$conn_name\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"\" class=\"new_connector\" name=\"new_connector[model]\" value=\"$conn_model\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"\" class=\"new_connector\" name=\"new_connector[specification]\" value=\"$conn_specification\" style=\"margin:5 10;\">";
			// $result_info .= "<input type=\"\" value=\"genre\" style=\"margin:5 10;\">";
			$result_info .= "<select class=\"new_connector\" name=\"new_connector[gender]\" value=\"$conn_gender\" style=\"margin:5 10;\">";
			$result_info .= "<option value=\"\">Gender:</option>";
			$result_info .= "<option value=\"male\">male</option>";
			$result_info .= "<option value=\"female\">female</option>";
			$result_info .= "</select>";
			$result_info .= "<input type=\"\" class=\"new_connector\" name=\"new_connector[year]\" value=\"$conn_year\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"file\" class=\"new_connector\" name=\"new_connector[photo]\" value=\"connector_photo\" style=\"margin:5 10;\">";
			$result_info .= "<input type=\"button\" onclick=\"create_new_connector();\" value=\"Done\" style=\"margin:5 10;float:right;background-color:blue;color:#ffffff;\">";
			$result_info .= "</form>";
			// $result_info .= "sooo";
		}
	}
	if($q == "help")
	{
		$result_info  = "Begin with connectors...";
		$result_info .= "<br/>The case of foreign you can upload photo of the suspect object. You'll get a notification, when the name of the suspect object is solved.";
	}
	// print $result_info;
	 $callback  = "(<span id=\"cx_search_count_aa\" value=\"$num\" style=\"font-weight:normal;\"><a href=\"javascript:void(0);\">$num showed</a></span>";
	 $callback .= "<span id=\"cx_bungalow\" style=\"font-weight:normal;\">";
	 $callback .= "<span id=\"cx_conn_rack_notifier\"></span>";
	 //$callback .= ", <a href=\"javascript:void(0);\" title=\"5 compatible stuff enabled\">5 compatibles</a>";
	 //$callback .= ", <a href=\"javascript:void(0);\">5 potential buyer</a>";
	 $callback .= "</span>)";
	 $callback .= "\r\n$result_info";
	 print $callback;
}

if(isset($_GET['add_connector_for_this_product']))
{
	$this_product_id = !empty($_GET['add_connecor_for_this_product']) ? $_GET['add_connecor_for_this_product'] : "undefined";
	$idprofile = $_SESSION["stuffwalk_profile"];
	$connector = $_GET['select_connector'];
	$method = $_GET['method'];
	//	$object_status = $_GET['method']; kirjoitus/luku/suoritus
		
	$count_append = ($method == "add") ? 1 : -1;
	if($this_product_id == "undefined")
	{
		/*
		 * Huomioi, että palautetaan
		 * yhteensopivat osat, connectorin nimi & määrä,
		 * nappi, jolla voidaan yhteensopivien lisäämisen yhteydessä tallentaa tavara.
		 */
		$connector = json_decode($connector);
		$connector_id = $connector->{'connector_id'};
		$goodies=mysql_query("SELECT p2.idproduct1, p2.manufacturer, p2.model, p2.default_picture, ci2.name, ci2.gender
							FROM connector_info ci1, connector_status_lookup c1, product_info p1, connector_info ci2, product_info p2, connector_status_lookup c2
							WHERE ci1.connector_id='$connector_id'
							and ci2.gender<>ci1.gender
							and ci1.name=ci2.name
							and c2.connector_id=ci2.connector_id
							and p2.idproduct1=c2.idproduct1
							");	
							/*
							 	WHERE p1.idproduct1='$this_product_id'
							and c1.idproduct1=p1.idproduct1
							and ci1.connector_id=c1.connector_id
							 */

		$goodies_count = mysql_numrows($goodies);
		$compatible_goodies = ""; //$this_product_id<br/>";
		while ($row = mysql_fetch_assoc($goodies)) {
				$product_id = $row['idproduct1'];
				$manufacturer = $row['manufacturer'];
				$model = $row['model'];
				$photo = $row['default_picture'];
				$name = $row['name'];
				$gender = $row['gender'];
			//$compatible_goodies .= "<a href=\"object.php?id=$product_id\"><img src=\"upload/$photo\" style=\"width:50px;height:50px;\" title=\"$manufacturer $model via $name ($gender)\"></a>";
		}
		//$compatible_goodies .= "<br/>";
		$compatible_goodies .= "<span id=\"cx_conn_rack_notifier\"><a href=\"javascript:void(0);\" onclick=\"market_scouting_popup('$idprofile', '$this_product_id','', 'initial', 'open');\" title=\"market scouping\"><!-- market_scouting_frame -> update-->";
		if($goodies_count > 20)
		{
			$compatible_goodies .= "20+ compatible parts";// "20+ connections available";
		}
		elseif($goodies_count > 1)
		{
			$compatible_goodies .= "$goodies_count compatible parts";
		}
		else
		{
			$compatible_goodies .= "$goodies_count compatible parts";
		}
		$compatible_goodies .= "</a></span>";
		
		
		
		//$compatible_measurement  = "<a href=\"\" onmouseover=\"\" onclick=\"\">3 compatible parts</a>";
		$zz = "";
		$compatible_measurement  = $compatible_goodies;
		/*
		$compatible_measurement .= " (<a href=\"\" onmouseover=\"\" onclick=\"\">5 new</a>";
		$compatible_measurement .= " in <a href=\"\" onmouseover=\"\" onclick=\"\">6 rooms</a>)";
		/*
		$new_connector  = "<span id=\"$connector_id\" onmouseover=\"connector_details();\" onclick=\"\">";
		$new_connector .= "[".$connector->{'name'}." (".$connector->{'count'}.")";
		$new_connector .= "<a href=\"javascript:void(0);\" onmouseover=\"\" onclick=\"\">&times;</a>]";
		$new_connector .= "</span>";
		*/
		$new_basket = "<a href=\"javascript:void(0);\" onclick=\"\">1 genre selected</a>, ";
		
		 $jsonconnector = str_replace('"','&quot;',json_encode($connector, JSON_FORCE_OBJECT));
		
		$return  = "quick_charger";
		$return .= "\r\n";
		//$return .= $new_connector;
		$return .= $new_basket;
		$return .= "\r\n";
		$return .= $compatible_measurement;
		$return .= "\r\n";
		$return .= $jsonconnector;
		print $return;
	}
	else 
	{
		$test = "SELECT count FROM connectors_on_product WHERE `idproduct1`='$this_product_id' and `connector_id`='$connector_id'";
		$result = mysql_query($test);
		
		if(mysql_num_rows($result)>0)
		{
			while($row = mysql_fetch_assoc($result))
			{
				if($row['count'] == 1  && $count_append == -1)
				{
				$query = "DELETE FROM connectors_on_product WHERE `idproduct1`='$this_product_id' and `connector_id`='$connector_id'";
				mysql_query($query);
				$query = "DELETE FROM connector_status_lookup WHERE `idproduct1`='$this_product_id' and `connector_id`='$connector_id'";
				mysql_query($query);
				$remove = "disabled";
				}
				else //if($row['count'] >= 1 && $count_append != -1)
				{
				$count = $row['count'] + $count_append;
				$update = "UPDATE connectors_on_product SET count='$count' WHERE `idproduct1`='$this_product_id' and `connector_id`='$connector_id'";
				mysql_query($update);
				$remove = "";
				}
			}
		}
		else 
		{
			
			$query = "INSERT into connectors_on_product values('$this_product_id',NOW(),'$connector_id','1')";
			mysql_query($query);
			$query = "INSERT into connector_status_lookup values('$this_product_id',NOW(),'$connector_id','','','')";
			mysql_query($query);
			$count = 1;
			$remove = "";
		}
		
		$return  = "basic_rack";
		$return .= "\r\n";
		$return .= $remove;
		$return .= "\r\n";
		$return .= $count;
		print $return;
	}
}

// if("add_new_connector="+new_connector_info+"&who_did_that="+profile)
// if(isset($_GET['create_new_connector']) && isset($_GET['who_did_that']))
if(isset($_GET['action_for_new_connector']) && $_GET['action_for_new_connector'] == "create")
{
	$new_connector = $_GET['new_connector'];
	
	
	function int_id()
		{
			$free = mysql_query("SELECT connector_id FROM connector_info WHERE `use_of` LIKE 'Free'");
			$size = mysql_num_rows($free);
			if($size == 0)
			{
			$result = mysql_query("SELECT * FROM connector_info");
			$num_rows  = mysql_num_rows($result);
			$num_rows += 10000000000000;
			return $information = Array("$num_rows", "New");
			}
			else
			{
				while ($row = mysql_fetch_assoc($free)) {
				$idproduct = $row['idproduct1'];
				$confirmation = mysql_query("UPDATE connector_info SET `Use_of`='Reserved' WHERE `use_of` LIKE 'Free'");
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
	
	
	$content = "";
	$da_name = "";
	$round_current = 0;
	$product_id = $new_connector["product_id"];
	foreach($new_connector as $key => $value)
	{
		if($key == $value || $value == "" || $key == "product_id")
		{
			unset($new_connector[$key]);
		}
	}
	
	$round_max = count($new_connector);
	foreach($new_connector as $key => $value)
	{
		if($key != $value && $value != "")
		{
			$content .= "`$key`='$value'";
			$da_name .= "$value ";
			if($round_current*1+1 < $round_max*1)
			{
				$content .=",";
			}
		}
		$round_current++;
	}
	list($connector_id, $info) = int_id();
	$view  = "";
	$count = 1;
	if($info == "New")
	{
		mysql_query("INSERT INTO connector_info values('$connector_id',NOW(),'','In_Use','','','','','','')");
		mysql_query("UPDATE connector_info SET $content WHERE `connector_id`='$connector_id'");
		// mysql_query("INSERT INTO connector values('$product_id',NOW(),'$connector_id','$reverse_connector_id','$converse_product_id','$connector_condition')");
		mysql_query("INSERT INTO connector_status_lookup values('$product_id',NOW(),'$connector_id','','','')");
		mysql_query("INSERT INTO connectors_on_product values('$product_id',NOW(),'$connector_id','$count')");
	}
	elseif($info == "Reserved")
	{
		// mysql_query("UPDATE connector_info SET $content WHERE `connector_id`='$connector_id'");
		// mysql_query("INSERT INTO connector_available values('$product_id',NOW(),'$connector_id','$count')");
	}
	/*
	tallennuksen jälkee haetaan tallennettu tieto (missä voidaan vielä höylätä liittimen lukumäärää laitteessa, ja sitten myös valmisluetteloon laitetaan samainen liitin "auto-update"
	*/
	$view .= "(1)";
	$view .= "\r\n";
	$view .= "<div style=\"border-bottom:1px solid;padding: 5;\">$da_name ' $new_connector[gender] <span style=\"float:right;\">";
	$view .= "<select onchange=\"\">";
	for($n=0;$n<20;$n++)
	{
	$view .= "<option value=\"$n\">$n</option>";
	}
	$view .= "</select>";
	$view .= "<span style=\"padding:5;\">&times;</span>";
	$view .= "</span></div>";
	// $view .= $round_max . " " .$content;
	$view .= "\r\n";
	$view .= "<span style=\"border:1px solid; padding:1 2;background-color:lightblue;color:blue;\">$da_name ($n) <a hfer=\"javascript:void(0);\" onclick=\"\">&times;</a></span>";
	
	print $view;
	// print "<div>Connector  ' male ' blabla [float luku]</div>\r\nConnector(1)";
}

if(isset($_GET['directory_tree_view_for']))
{
	$name = $_GET['directory_tree_view_for'];
	if($name == "stuff_tree")
	{
		function directory_tree($index)
		{
			function _sort_helper($input, $output, $parent_id) {
			    foreach ($input as $key => $item)
			        if ($item['parent_product'] == $parent_id && $item['type_of_object']=="Room") { // ToO=room on filtteri
			            $output[] = $item;
			            unset($input[$key]);
			            _sort_helper($input, $output, $item['idproduct1']);
			        }
			        return $output;
			}
			
			function sort_items_into_tree($items) {
			    $tree = array();
			    $tree = _sort_helper($items, $tree, null);
			    return $tree;
			}
			
			//$rows = mysql_query("SELECT * FROM product_info WHERE `use_of`='In_Use'");
			$this_profile = $_SESSION["stuffwalk_profile"];
			$rows = mysql_query("SELECT * 
						FROM product_info pi, profile p
						WHERE pi.use_of='In_Use' and pi.idproduct1=p.data_object 
						and p.idprofile1='$this_profile'");
			
			while($input = mysql_fetch_assoc($rows)){$inputs[] = $input;}
			$trees = sort_items_into_tree($inputs);
			
			$directory_tree  = "";
			
		foreach($trees as $a => $b)
		{
		$directory_tree .= "<h4 style=\"background-color:#eee;margin: 10 0;border-bottom: 1px solid; border-color: #0ee;\">";
		$directory_tree .= "<input type=\"checkbox\" name=\"delete[]\" value=\"".$b['idproduct1']."\" style=\"float: left;margin: 4 0 -15 2;\">";
		$directory_tree .= "<span style=\"padding: 0 0 0 5;\">";
		$directory_tree .= "<a href=\"object.php?id=".$b['idproduct1']."\" style=\"text-decoration:none;\">" . $b['manufacturer'] . " " . $b['model'] . "</a>";
		$directory_tree .= " <span id=\"header_timetable\">";
		// original
		// $directory_tree .= "<a href=\"javascript:void(0);\" onclick=\"market_scouting_popup(\'".$_SESSION['stuffwalk_profile']."\',\'".$b['idproduct1']."\',\'\',\'initial\',\'open\');\" style=\"color: grey; font-weight: normal;text-decoration:none;\" title=\"Last upgraded: ".date(DATE_RFC822)."\">Upgraded a moment ago (5 new upgrades)</a> ";
		// simpler/more usability
		$directory_tree .= "<a href=\"javascript:void(0);\" onclick=\"market_scouting_popup('".$_SESSION['stuffwalk_profile']."','".$b['idproduct1']."','','my_library','open');\" style=\"color: grey; font-weight: normal;text-decoration:none;\" title=\"Last upgraded: ".date(DATE_RFC822)."\">Upgraded a moment ago (5 new upgrades)</a> ";
		//$directory_tree .= " - <a href=\"javascript:void(0);\" onclick=\"\">Check new upgrades</a>";
		$directory_tree .= "</span>";
		$directory_tree .= "</span>";
		$directory_tree .= "</h4>";
		$directory_tree .= "<div style=\"overflow:auto;\">";
		$directory_tree .= "<ul>";
		foreach($inputs as $ids => $idt)
		{
			
			if($idt['parent_product'] == $b['idproduct1'])
			{
				$dt_product_id = $idt['idproduct1'];
				$directory_tree .= "<span style=\"float:left;margin:1;\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\"  onmouseout=\"directory_tree_shortcut(\'$dt_product_id\',\'hidden\');\">";
				
				$directory_tree .= "<div id=\"hover_".$idt['idproduct1']."\" style=\"visibility:hidden;display:none;\">";
				$directory_tree .= "<input id=\"hover_checkbox_".$idt['idproduct1']."\" type=\"checkbox\" name=\"delete[]\" value=\"".$idt['idproduct1']."\" style=\"float: left;margin: 0 0 -15 0;position: absolute;\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\">";
				$directory_tree .= "<div id=\"hover_compatiblestuff_".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\"><a href=\"javascript:void(0);\" onclick=\"market_scouting_popup(\'".$_SESSION['stuffwalk_profile']."\',\'$dt_product_id\',\'\',\'initial\',\'open\');\" style=\"margin: 0 5;\" title=\"33 compatible part (5 new)\">33</a></div><!-- href=object.php?id=&amp;and=tree-->";
				$directory_tree .= "<div id=\"hover_exchange_status_".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\"><a href=\"javascript:void(0);\" onclick=\"alert(\'Ohhoi!\');\" style=\"margin: 0 10;\" title=\"15 buyer (5 new)\">Sell</a></div>";
				$directory_tree .= "</div>";
				
				$directory_tree .= "<div id=\"houtside_".$idt['idproduct1']."\" style=\"visibility:visible;display:block;\">";
				$directory_tree .= "<span id=\"houtside_compatiblestuff_".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\" style=\"float: left;margin: 4 0 0 102;position: absolute;background-color:white;color:#c0c0c0;padding: 0 2;\">12</span>";
				$directory_tree .= "<span id=\"houtside_exchange_status_".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\"></span>";
				$directory_tree .= "</div>";
				
				$directory_tree .= "<div class=\"stuff\" style=\"float:left;height:150;\">";
				$directory_tree .= "<a href=\"object.php?id=".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\" onmouseout=\"directory_tree_shortcut(\'$dt_product_id\',\'hidden\');\">";
				$directory_tree .= "<img src=\"upload/".$idt['default_picture']."\" style=\"width:127.5px;height:127.5px;\" title=\" " . $idt['manufacturer'] ."\"/>";
				$directory_tree .= "</a>";
				$directory_tree .= "<div><span id=\"mysql_timer_".$idt['last_updated']."\" title=\"Last updated: ".$idt['last_updated']."\"></span></div>";
				$directory_tree .= "</div>";
				$directory_tree .= "</span>";
			}
		}
	$directory_tree .= "</ul>";
	$directory_tree .= "</div>";
	}
			
			
			
			/*foreach($trees as $a => $b)
			{
				$directory_tree .= "<h4 style=\"background-color:#eee;margin: 10 0;border-bottom: 1px solid; border-color: #0ee;\"><li><input type=\"checkbox\" name=\"delete[]\" value=\"".$b['idproduct1']."\" style=\"float: left;margin: 0 0 -15 0;\"><a href=\"object.php?id=".$b['idproduct1']."\" style=\"text-decoration:none;\">" . $b['manufacturer'] . " " . $b['model'] . "</a></li></h4>";
				$directory_tree .= "<div style=\"overflow:auto;\">";
				$directory_tree .= "<ul>";
				foreach($inputs as $ids => $idt)
				{
					
					if($idt['parent_product'] == $b['idproduct1'])
					{
						$dt_product_id = $idt['idproduct1'];
						$directory_tree .= "<span style=\"float:left;\">";
						$directory_tree .= "<div id=\"hover_".$idt['idproduct1']."\" style=\"visibility:hidden;display:none;margin:1;\">";
						$directory_tree .= "<input id=\"hover_checkbox_".$idt['idproduct1']."\" type=\"checkbox\" name=\"delete[]\" value=\"".$idt['idproduct1']."\" style=\"float: left;margin: 0 0 -15 0;position: absolute;\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\">";
						$directory_tree .= "<span id=\"hover_compatiblestuff_".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\"></span>";
						$directory_tree .= "<span id=\"hover_exchange_status_".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\"></span>";
						$directory_tree .= "</div>";
						$directory_tree .= "<a href=\"object.php?id=".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\" onmouseout=\"directory_tree_shortcut(\'$dt_product_id\',\'hidden\');\">";
						$directory_tree .= "<img src=\"upload/".$idt['default_picture']."\" style=\"width:111.4px;height:111.4px;\" title=\" " . $idt['manufacturer'] ."\"/>";
						$directory_tree .= "</a>";
						$directory_tree .= "</span>";
					}
				}
			$directory_tree .= "</ul>";
			$directory_tree .= "</div>";
			}*/
		return $directory_tree;
		}
		$index ="";
		$directory_tree = directory_tree($index);
	}
	elseif($name == "independent_compilations")
	{
		function directory_tree($index)
		{
			function _sort_helper($input, $output, $parent_id) {
			    foreach ($input as $key => $item)
			        if ($item['parent_product'] == $parent_id && $item['type_of_object']=="Stuff") { // ToO=room on filtteri
			            $output[] = $item;
			            unset($input[$key]);
			            _sort_helper($input, $output, $item['idproduct1']);
			        }
			        return $output;
			}
			
			function sort_items_into_tree($items) {
			    $tree = array();
			    $tree = _sort_helper($items, $tree, null);
			    return $tree;
			}
			
			//$rows = mysql_query("SELECT * FROM product_info WHERE `use_of`='In_Use'");
			$this_profile = $_SESSION["stuffwalk_profile"];
			$rows = mysql_query("SELECT * 
						FROM product_info pi, profile p
						WHERE pi.use_of='In_Use' and pi.idproduct1=p.data_object 
						and p.idprofile1='$this_profile'");
			
			while($input = mysql_fetch_assoc($rows)){$inputs[] = $input;}
			$trees = sort_items_into_tree($inputs);
			
			$directory_tree  = "";
			foreach($trees as $a => $b)
			{
				$directory_tree .= "<h4 style=\"background-color:#eee;margin: 10 0;border-bottom: 1px solid; border-color: #0ee;\"><li><input type=\"checkbox\" name=\"delete[]\" value=\"".$b['idproduct1']."\" style=\"float: left;margin: 0 0 -15 0;\"><a href=\"object.php?id=".$b['idproduct1']."\" style=\"text-decoration:none;\">" . $b['manufacturer'] . " " . $b['model'] . "</a></li></h4>";
				$directory_tree .= "<div style=\"overflow:auto;\">";
				$directory_tree .= "<ul>";
				foreach($inputs as $ids => $idt)
				{
					
					if($idt['parent_product'] == $b['idproduct1'])
					{
						$dt_product_id = $idt['idproduct1'];
						$directory_tree .= "<span style=\"float:left;\">";
						$directory_tree .= "<div id=\"hover_".$idt['idproduct1']."\" style=\"visibility:hidden;display:none;margin:1;\">";
						$directory_tree .= "<input id=\"hover_checkbox_".$idt['idproduct1']."\" type=\"checkbox\" name=\"delete[]\" value=\"".$idt['idproduct1']."\" style=\"float: left;margin: 0 0 -15 0;position: absolute;\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\">";
						$directory_tree .= "<span id=\"hover_compatiblestuff_".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\"></span>";
						$directory_tree .= "<span id=\"hover_exchange_status_".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\"></span>";
						$directory_tree .= "</div>";
						$directory_tree .= "<a href=\"object.php?id=".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\" onmouseout=\"directory_tree_shortcut(\'$dt_product_id\',\'hidden\');\">";
						$directory_tree .= "<img src=\"upload/".$idt['default_picture']."\" style=\"width:111.4px;height:111.4px;\" title=\" " . $idt['manufacturer'] ."\"/>";
						$directory_tree .= "</a>";
						$directory_tree .= "</span>";
					}
				}
			$directory_tree .= "</ul>";
			$directory_tree .= "</div>";
			}
		return $directory_tree;
		}
		$index ="";
		$directory_tree = directory_tree($index);
	}
	elseif($name == "independent_stuffs")
	{
		function directory_tree($index)
		{
			function _sort_helper($input, $output, $parent_id) {
			    foreach ($input as $key => $item)
			        if ($item['parent_product'] == "" && $item['type_of_object']=="Stuff") { // ToO=room on filtteri
			            $output[] = $item;
			            unset($input[$key]);
			            _sort_helper($input, $output, $item['idproduct1']);
			        }
			        return $output;
			}
			
			function sort_items_into_tree($items) {
			    $tree = array();
			    $tree = _sort_helper($items, $tree, null);
			    return $tree;
			}
			
			//$rows = mysql_query("SELECT * FROM product_info WHERE use_of='In_Use'");
								/*FROM product_info p1, product_info p2 
								WHERE p1.use_of='In_Use' and p2.use_of='In_Use'
								and p1.parent_product='' and p1.idproduct1 <> p2.parent_product");*/
			$this_profile = $_SESSION["stuffwalk_profile"];
			$rows = mysql_query("SELECT * 
						FROM product_info pi, profile p
						WHERE pi.use_of='In_Use' and pi.idproduct1=p.data_object 
						and p.idprofile1='$this_profile'");
			
			while($input = mysql_fetch_assoc($rows)){$inputs[] = $input;}
			$trees = sort_items_into_tree($inputs);
			
			$directory_tree  = "";
			if(count($inputs)==0)
			{
			$directory_tree .= "in =0!";
			}
			else {
				$directory_tree .= "in>0!".count($inputs);
			}
			foreach($trees as $a => $b)
			{
				$directory_tree .= "<h4 style=\"background-color:#eee;margin: 10 0;border-bottom: 1px solid; border-color: #0ee;\"><li><input type=\"checkbox\" name=\"delete[]\" value=\"".$b['idproduct1']."\" style=\"float: left;margin: 0 0 -15 0;\"><a href=\"object.php?id=".$b['idproduct1']."\" style=\"text-decoration:none;\">" . $b['manufacturer'] . " " . $b['model'] . "</a></li></h4>";
				$directory_tree .= "<div style=\"overflow:auto;\">";
				$directory_tree .= "<ul>";
				foreach($inputs as $ids => $idt)
				{
					
					if($idt['parent_product'] == $b['idproduct1'])
					{
						$dt_product_id = $idt['idproduct1'];
						$directory_tree .= "<span style=\"float:left;\">";
						$directory_tree .= "<div id=\"hover_".$idt['idproduct1']."\" style=\"visibility:hidden;display:none;margin:1;\">";
						$directory_tree .= "<input id=\"hover_checkbox_".$idt['idproduct1']."\" type=\"checkbox\" name=\"delete[]\" value=\"".$idt['idproduct1']."\" style=\"float: left;margin: 0 0 -15 0;position: absolute;\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\">";
						$directory_tree .= "<span id=\"hover_compatiblestuff_".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\"></span>";
						$directory_tree .= "<span id=\"hover_exchange_status_".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\"></span>";
						$directory_tree .= "</div>";
						$directory_tree .= "<a href=\"object.php?id=".$idt['idproduct1']."\" onmouseover=\"directory_tree_shortcut(\'$dt_product_id\',\'view\');\" onmouseout=\"directory_tree_shortcut(\'$dt_product_id\',\'hidden\');\">";
						$directory_tree .= "<img src=\"upload/".$idt['default_picture']."\" style=\"width:111.4px;height:111.4px;\" title=\" " . $idt['manufacturer'] ."\"/>";
						$directory_tree .= "</a>";
						$directory_tree .= "</span>";
					}
					else 
					{
						$directory_tree .= " null null";
					}
				}
			$directory_tree .= "</ul>";
			$directory_tree .= "</div>";
			}
		return $directory_tree;
		}
		$index ="";
		$directory_tree = directory_tree($index);
	}
	$callback  = $directory_tree;
	$callback .= "\r\n";
	print $callback;
	// mysql_query("INSERT INTO connector_info values('')");
}

if(isset($_GET['add_new_connector']) && isset($_GET['who_did_that']))
{
	// mysql_query("INSERT INTO connector_info values('')");
}

if(isset($_GET['exchange_scout']) && isset($_GET['profile_id']) && isset($_GET['product_id']))
{
	$exchange_scout_type = $_GET['exchange_scout'];
	$profile_id = $_GET['profile_id'];
	$this_product_id = $_GET['product_id'];
	
	$session_profile_id = $_SESSION["stuffwalk_profile"];
		// profile taulu vois olla jatkossa esim. ownership
		/*$check_owner = mysql_query("SELECT idprofile1 FROM profile WHERE `data_object`='$this_product_id' and `data_value`='owner'");
		while ($row = mysql_fetch_assoc($check_owner)) {
					$owner_id = $row['idprofile1'];
					if($owner_id == $session_profile_id)
					{
						$status = "seller";
					}
					else 
					{
						$status = "buyer";
					}
		}*/
	
	$mq_result = mysql_query("SELECT p.manufacturer, p.model, p.default_picture 
									FROM product_info p	
									WHERE p.idproduct1='$this_product_id'");
		$this_product = "";
		if(mysql_num_rows($mq_result) > 0)
		{
			while ($row = mysql_fetch_assoc($mq_result)) {
						//$buyer_id = $row['buyer_id'];
						$manufacturer = $row['manufacturer'];
						$model = $row['model'];
						$default_picture = $row['default_picture'];
				
				// $this_product .= "<img src=\"upload/$default_picture\" style=\"width:50px;height:50px;\"/> $manufacturer, $model<input type=\"button\" value=\"&times; Cancel Reservation\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', '');\" style=\"float: right;margin: 15 0;\" /><hr/>";
				$this_product .= "<div id=\"seller_control_panel_navigation\"><img src=\"upload/$default_picture\" style=\"width:75px;height:75px;\"/> $manufacturer $model <a href=\"javascript:void(0);\">Optional stuff to add</a></div>";
			}
		}
		else $this_product .= "Product details aren't available, try again in a few hours.";	
			
			// $view = "text/standard";
			// $view .= "\r\n";
			$view  = "<h1 class=\"popup_header\"><center>Seller Control Panel</center></h1>";
			$view .= "\r\n";
			$view .= "<input type=\"hidden\" name=\"this_product_id\" value=\"$this_product_id\">";
			$view .= "<div style=\"overflow: auto;\">";
			$view .= "<div class=\"block\" style=\"float: left;margin: 5;border: 1px solid;\" onmouseover=\"\" onmouseout=\"\">";
			$view .= "<h4>Kohderyhmä, Target group</h4>";
			$view .= "<a href=\"\">University of Jyväskylä</a>, <a href=\"\">Keski-Suomi</a>";
			$view .= "<br/>20+ potential buyer, 20+ compatible stuff from other accounts";
			$view .= "</div>";
			$view .= "<div class=\"block\" style=\"float: left;margin: 5;border: 1px solid;\">";
			$view .= "<h4>Brändisi, Your level</h4>";
			$view .= "<a href=\"\">Good-standing, stability</a>";
			$view .= "</div>";
			$view .= "<div class=\"block\" style=\"float: left;margin: 5;border: 1px solid;\">";
			$view .= "<h4>Markkinatiedot, Price, pankkiyhteys</h4>";
			$view .= "<a href=\"\" title=\"20 buyers uses this bank\">Pankki</a>, 40e (lowest - highest price)";
			$view .= "<br/>Nordea - 1 day, Sampo Bank - 2 days";
			$view .= "</div>";
			$view .= "<div class=\"block\" style=\"float: left;margin: 5;border: 1px solid;\">";
			$view .= "<h4>Logistiikka, Paketin kuljetustapa</h4>";
			$view .= "<a href=\"\"  title=\"20 buyers allow this\">Nouto</a>, <a href=\"\"  title=\"20 buyers allow this\">Posti</a>";
			$view .= "</div>";
			$view .= "</div>";
			$view .= "<input type=\"button\" value=\"Begin\" onclick=\"update_proprietor_status('$session_profile_id', '$this_product_id', 'sell');\">"; //onclick=\"update_proprietor_status('"+id+"', '"+product+"', '"+state+"');\">"; //onClick=\"proprietor_state('$session_profile_id','sell','$this_product_id');\">";
			$view .= "\r\n";
			$view .= $this_product;
			print $view;
}

if(isset($_GET['add_role_for_part']) && isset($_GET['parent_product_id']))
{
	$this_product_id = $_GET['add_role_for_part']; // child_product
	$parent_product_id = $_GET['parent_product_id'];
	$status_now = $_GET['status_now'];
	$action = $_GET['action'];
	$photo = $_GET['photo'];
	$manufacturer = $_GET['manufacturer'];
	$model = $_GET['model'];
	$name = $_GET['name'];
	$gender = $_GET['gender'];
	
	//add_role_for_part="+product_id+"&parent_product_id="+parent_product
	
	$part_connection_status  = "<a href=\"object.php?id=$this_product_id\"><img src=\"upload/$photo\" style=\"width:50px;height:50px;float:left;\" title=\"$manufacturer $model via $name ($gender)\"></a></span>";
	$part_connection_status .= "$manufacturer $model";
	// $my_lib_connection_index .= "$name ($gender)";
	// included, another product, add as part
	if($action == "add_as_part") // && 
	{
		$part_connection_status .= "<label style=\"float:right;\"><input type=\"button\" value=\"&#10004; Included\" style=\"margin: 15 5;\"/>(<a href=\"javascript:void(0);\" onclick=\"add_role_for_object('$parent_product_id','$this_product_id', 'included', 'release','$photo','$manufacturer', '$model', '$name', '$gender');\">Disconnect</a>)</label>";
		$to_included = "<a href=\"javascript:void(0);\"><img src=\"upload/$photo\" style=\"width:45px;height:45px;\" title=\"$manufacturer $model\"></a>";
		
		$query ="UPDATE product_info SET `parent_product`='$parent_product_id' WHERE `idproduct1`='$this_product_id'";
	}
	elseif($action == "release" && $status_now == "included")
	{
		$part_connection_status .= "<label style=\"float:right;\"><input type=\"button\" value=\"Add as part\" onclick=\"add_role_for_object('$this_product_id','$parent_product_id', 'free','add_as_part','$photo','$manufacturer', '$model', '$name', '$gender');\" style=\"float:right; margin: 15 5;\"/></label>";
		$to_included = $this_product_id;
		
		$query ="UPDATE product_info SET `parent_product`='' WHERE `idproduct1`='$this_product_id'";
	}
	elseif($action == "release" && $status_now == "in_another_product")
{
		$part_connection_status .= "<label style=\"float:right;\"><input type=\"button\" value=\"&#10004; Included\" onclick=\"add_role_for_object('$this_product_id','$parent_product_id', 'free','release','$photo','$manufacturer', '$model', '$name', '$gender');\" style=\"margin: 15 5;\"/>";
		$part_connection_status .= "(<a href=\"javascript:void(0);\" onclick=\"add_role_for_object('$parent_product_id','$this_product_id', 'included', 'release','$photo','$manufacturer', '$model', '$name', '$gender');\">Disconnect</a>)</label>";
		$to_included = $this_product_id;
		
		//$query ="UPDATE product_info SET `parent_product`='$this_product_id' WHERE `idproduct1`='$product_id'";
		$query ="UPDATE product_info SET `parent_product`='$this_product_id' WHERE `idproduct1`='$parent_product_id'";
	}
	mysql_query($query);
	
	$view  = "";
	$view .= $part_connection_status;
	$view .= "\r\n";
	$view .= $to_included;
	$view .= "\r\n";
	$view .= $this_product_id;
	//return view;
	// print -komento ei ole pakollinen. Toimii ilmankin o_O Works without print.
	print $view;
}

// market_scoup=1&profile_id="+profile_id+"&product_id="+product_id+"&connector_id="+connector_id
if(isset($_GET['market_scout']) && isset($_GET['profile_id']) && isset($_GET['product_id']))
{
	$market_scout_type = $_GET['market_scout'];
	$profile_id = $_GET['profile_id'];
	$this_product_id = $_GET['product_id'];
	
	if($market_scout_type == "initial")
	{
		/*
		$goodies=mysql_query("SELECT p2.idproduct1, p2.manufacturer, p2.model, p2.default_picture, ci2.name, ci2.gender
								FROM connector_info ci1, connector_status_lookup c1, product_info p1, connector_info ci2, product_info p2, connector_status_lookup c2
								WHERE p1.idproduct1='$this_product_id'
								and c1.idproduct1=p1.idproduct1
								and ci1.connector_id=c1.connector_id
								and ci1.gender<>ci2.gender
								and ci1.name = ci2.name
								and c2.connector_id=ci2.connector_id
								and p2.idproduct1=c2.idproduct1
								");*/
		$goodies=mysql_query("SELECT p2.idproduct1, p2.manufacturer, p2.model, p2.default_picture, ci2.name, ci2.gender
								FROM connector_info ci1, connector_status_lookup c1, product_info p1, product_info p2, connector_status_lookup c2, connector_info ci2
								WHERE p1.idproduct1='$this_product_id'
								and c1.idproduct1=p1.idproduct1
								and ci1.connector_id=c1.connector_id
								and ci1.name = ci2.name 
								and ci1.gender <> ci2.gender
								and c2.connector_id=ci2.connector_id
								and p2.idproduct1=c2.idproduct1
								GROUP BY ci2.name, p2.default_picture
								");	
													/*
									and ci1.gender <> ci2.gender						
								
								SELECT p2.idproduct1, p2.manufacturer, p2.model, ci2.gender, ci2.name
								<>>>>>>>
								
								
								and ci1.name=ci2.name
								and ci1.gender<>ci2.gender
								and ci1.connector_id<>ci2.connector_id
								and c2.connector_id=ci2.connector_id						
								and p2.idproduct1=c2.idproduct1
								*/
								
			$num = mysql_numrows($goodies);
			
			$connection_index_list_com = "";
			$name_index = "";
			$round = 0;
			while ($row = mysql_fetch_assoc($goodies)) {

					$product_id = $row['idproduct1'];
					$manufacturer = $row['manufacturer'];
					$model = $row['model'];
					$photo = $row['default_picture'];
					$name = $row['name'];
					$gender = $row['gender'];
				// $connection_index[$name] = $gender;
				// $connection_index[$name][$product_id];
			// }
			// foreach($connection_index as $name)
				if($name_index != $name)
				{ $name_index = $name;
					$connection_index_list_com .= "<div id=\"\" style=\"border-bottom:1px dotted;padding-left: 5px;\">Plug &amp; Play content<br/> <span style=\"margin-left: 15px;\">";
				}
				$connection_index_list_com .= "<a href=\"object.php?id=$product_id\"><img src=\"upload/$photo\" style=\"width:50px;height:50px;\" title=\"$manufacturer $model via $name ($gender)\"></a></span>";
				if($name_index != $name || $round+1 == $num)
				{ $name_index = $name;
					$connection_index_list_com .= "<input type=\"button\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', '');\" value=\"More...\" title=\"Click to view more stuff.\" style=\"float:right;margin: 13 10;\"/><br/>
					<span style=\"color:darkgrey;\">20+ items via <a href=\"\">".strtoupper($name)."[$gender]</a></span></div>";
				}
				$round++;
			}
			$connection_index_list_com .= "<div id=\"\" style=\"margin: 15 15;background-color: heavyblue;text-align:center;\"><a href=\"javascript:void(0);\" onclick=\"\">View more</a></div>";
			/*
			$compatible_goodies = ""; //$this_product_id<br/>";
			while ($row = mysql_fetch_assoc($goodies)) {

					$product_id = $row['idproduct1'];
					$manufacturer = $row['manufacturer'];
					$model = $row['model'];
					$photo = $row['default_picture'];
					$name = $row['name'];
					$gender = $row['gender'];
				$compatible_goodies .= "<a href=\"object.php?id=$product_id\"><img src=\"upload/$photo\" style=\"width:50px;height:50px;\" title=\"$manufacturer $model via $name ($gender)\"></a>";
			}
		
		$goodies = "mysql_command";
		$num = mysql_num_rows($goodies);
		$connection_index_list = "";
		$connectory_type_list["Connector-free"] = 0;
		$connectory_type_list["Plug & Play"] = 1;
		$connectory_type_list["Plug & Play"] = 2;
		while ($row = mysql_fetch_assoc($goodies)) {
			$product_id = $row['idproduct1'];
			$object = $row['object'];
			$photo_link .= "upload/$product_id.$object";
			
			$connection_index_list .= "<div id=\"\">Plug &amp; Play content <input type=\"button\" value=\"More...\" title=\"Click to view more stuff.\"/><br/>20+ items via <a href=\"\">USB</a></div>";
		}
		$connection_index_list .= "<div id=\"\">End. View more...</div>";
		*/
		$view  = "";
		
		// the topic of Compatible Stuff
		
		if($profile_id == "undefined")
		{
			$view .= "<h1 class=\"popup_header\" style=\"position:fixed;index:2;\">Something went wrong, <a href=\"javascript:void(0);\" onclick=\"market_scouting_popup('$profile_id','$this_product_id','','initial','open');\">refresh</a>. Try to fix js-file.</h1>";
			$view .= "\r\n";
			$view .= "Error 404.";
			$view .= "\r\n";
			$view .= "End.";
		}
		else
		{
			$view .= "<h1 class=\"popup_header\"><input type=\"button\" value=\"Connection\" onclick=\"\" style=\"margin-top: 5px;\"/><center style=\"margin-top: -30px;\">Cell room's Catalog<!--Compatible stuff--></center></h1>";
			$view .= "\r\n";
			// the content category list
			$view .= "<div id=\"\" style=\"margin: 15 15;background-color: heavyblue;text-align:center;\"><a href=\"javascript:void(0);\" onclick=\"\">View mores</a></div>";
			//$view .= "T";
			$view .= "\r\n";
			$view .= "<div id=\"tata_vigation\" style=\"overflow:auto;\">";
			$view .= "<li style=\"float:left;\"><a href=\"javascript:void(0);\" onclick=\"market_scouting_popup('$profile_id','$this_product_id','','my_library','open');\">My library</a></li>";
			$view .= "<li style=\"float:left;\"><a href=\"javascript:void(0);\" onclick=\"market_scouting_popup('$profile_id','$this_product_id','','initial','open');\">Public library</a></li>";
			$view .= "<li style=\"float:left;\">Underpowered parts</a></li>";
			$view .= "</div>";
			// the content
			$view .= $connection_index_list_com;
			// $view .= "<br/>Daa.";
		}
		print $view;
	}
	
	elseif($market_scout_type == "my_library")
	{
		/*
		 * Tuote 
		 * -> haetaan profiilista muut omistetut tuotteet
		 * -> tarkistetaan että ne ovat eri sukupuolta kuin alkup.
		 * 
		 */
		 /*Tämän pitäis tarkistaa omistaja samalla, kun taas tuo toinen tarkistaa mitä löytyy yleensä
		 * $goodies=mysql_query("SELECT p2.idproduct1, p2.parent_product, p2.manufacturer, p2.model, p2.default_picture, ci2.name, ci2.gender
								FROM connector_info ci1, connector_status_lookup c1, product_info p1, product_info p2, connector_status_lookup c2, connector_info ci2, profile pr1, profile pr2
								WHERE p1.idproduct1='$this_product_id'
								and pr1.data_object = p1.idproduct1
								and pr1.idprofile1=pr2.idprofile1
								and pr2.data_object=pr1.data_object
								and c2.idproduct1=pr2.data_object
								and ci2.connector_id=c2.connector_id
								and ci1.name = ci2.name
								and ci1.gender<>ci2.gender
								and ci1.connector_id = c1.connector_id
								and c1.idproduct1 = p2.idproduct1
								
								
								GROUP BY ci2.name, p2.default_picture
								");	*/
		
		$goodies=mysql_query("SELECT p2.idproduct1, p2.parent_product, p2.manufacturer, p2.model, p2.default_picture, 
							ci2.connector_id, ci2.name, ci2.gender, pr2.idprofile1, pr2.data_value
							FROM connector_info ci1, connector_status_lookup c1, product_info p1, 
							connector_info ci2, product_info p2, connector_status_lookup c2,
							profile pr2
							WHERE p1.idproduct1='$this_product_id'
							and c1.idproduct1=p1.idproduct1
							and ci1.connector_id=c1.connector_id
							and ci2.gender<>ci1.gender
							and ci1.name=ci2.name
							and c2.connector_id=ci2.connector_id
							and p2.idproduct1=c2.idproduct1
							and pr2.data_object=p2.idproduct1
							");												
													/*
									
									and c1.idproduct1=p1.idproduct1
									and ci1.gender <> ci2.gender
									
									and ci1.connector_id=c1.connector_id
									and ci1.name = ci2.name 
									and ci1.gender = ci2.gender
									and c2.connector_id=ci2.connector_id
									and p2.idproduct1=c2.idproduct1						
								
								SELECT p2.idproduct1, p2.manufacturer, p2.model, ci2.gender, ci2.name
								<>>>>>>>
								
								
								and ci1.name=ci2.name
								and ci1.gender<>ci2.gender
								and ci1.connector_id<>ci2.connector_id
								and c2.connector_id=ci2.connector_id						
								and p2.idproduct1=c2.idproduct1
								*/
			/*
			 $toc = mysql_query("SELECT distinct toc.item
			 					FROM 	product_info toc_parent,
			 							product_info toc
			 							product_info toc_updated_recent
			 							product_info toc_for_market
			 					WHERE	toc_parent.idproduct1='$this_product_id'
			 					and		toc.parent_product=toc_parent.idproduct1");
			 */
								
			$num = mysql_numrows($goodies);
			
			$my_lib_connection_index = "";
			$name_index = "";
			$round = 0;
			while ($row = mysql_fetch_assoc($goodies)) {
			if($row['data_value'] != "ex-owner")
			{
					unset($product_id);
					unset($parent_product_id);
					unset($product_owner_id);
					unset($product_ownership);
					$product_owner_id = $row['idprofile1'];
					$product_ownership = $row['data_value'];
					
					$product_id = $row['idproduct1'];
					$manufacturer = $row['manufacturer'];
					$parent_product_id = $row['parent_product'];
					$model = $row['model'];
					$photo = $row['default_picture'];
					$name = $row['name'];
					$gender = $row['gender'];
					$connector_id = $row['connector_id'];
					
					if($_SESSION["stuffwalk_profile"] == $product_owner_id && $product_ownership == "owner")
					{ // omistaja kirjautuneena, tarjonta omistajan omaa, ei käynnistetä tarjontaa
						if(!empty($parent_product_id) && $parent_product_id == $this_product_id)
						{ // on osa tätä tuotetta
							$connection_status  = "<label style=\"float:right;\">";
							$connection_status .= "<input type=\"button\" value=\"&#10004; Included\" style=\"margin: 15 5;\"/>";
							$connection_status .= "(<a href=\"javascript:void(0);\" onclick=\"add_role_for_object('$parent_product_id','$product_id', 'included','release','$photo','$manufacturer', '$model', '$name', '$gender');\">Disconnect</a>)";
							$connection_status .= "</label>";
						}
						else if(!empty($parent_product_id) && $parent_product_id != $this_product_id)
						{ // on toisessa tavarassa kiinni
							$connection_status = "<label style=\"float:right;\"><input type=\"button\" value=\"In another product\" style=\"margin: 15 5;\"/>(<a href=\"javascript:void(0);\" onclick=\"add_role_for_object('$product_id','$this_product_id','in_another_product', 'release','$photo','$manufacturer', '$model', '$name', '$gender');\">Add as part</a>)</label>";
						}
						else 
						{ // ei missään kiinni
							$connection_status = "<label><input type=\"button\" onclick=\"add_role_for_object('$this_product_id','$product_id','free','add_as_part','$photo','$manufacturer', '$model', '$name', '$gender');\" value=\"Add as Part\" style=\"float:right; margin: 15 5;\"/></label>";
						}
					}
					elseif($_SESSION["stuffwalk_profile"] == $product_owner_id && $product_ownership == "holder")
					{ // omistaja kirjautuneena, tarjonta haltijan silmin, ei käynnistetä tarjontaa
						
					}
					elseif($_SESSION["stuffwalk_profile"] != $product_owner_id && $product_ownership == "owner")
					{ // omistaja kirjautuneena, tarjonta ei kuulu omistajalle, käynnistetään tarjonta
						$connection_status  = "<label style=\"float:right;\">";
						$connection_status .= "<input type=\"button\" value=\"+ Investion request\" onclick=\"market_scouting_popup('".$_SESSION["stuffwalk_profile"]."', '$product_id','$connector_id', 'update', 'open');\" style=\"margin: 15 5;\">";
						$connection_status .= "<input type=\"button\" value=\"Compare\" onclick=\"market_scouting_popup('".$_SESSION["stuffwalk_profile"]."', '$product_id','$connector_id', 'update', 'open');\" disabled=\"true\" style=\"margin: 15 5;\">";
						$connection_status .= "</label>";	
					}
				// $connection_index[$name] = $gender;
				// $connection_index[$name][$product_id];
			// }
			// foreach($connection_index as $name)
				/*if($name_index != $name)
				{ $name_index = $name;
					$connection_index_list_com .= "<div id=\"\" style=\"border-bottom:1px dotted;padding-left: 5px;\">Plug &amp; Play content<br/> <span style=\"margin-left: 15px;\">";
				}*/
				$my_lib_connection_index .= "<div id=\"lib_$product_id\" style=\"border-bottom:1px dotted;padding: 5;overflow:auto;\">";
				$my_lib_connection_index .= "<a href=\"object.php?id=$product_id\"><img src=\"upload/$photo\" style=\"width:50px;height:50px;float:left;\" title=\"$manufacturer $model via $name ($gender)\"></a></span>";
				$my_lib_connection_index .= "$manufacturer $model";
				// $my_lib_connection_index .= "$name ($gender)";
				$my_lib_connection_index .= $connection_status;
				$my_lib_connection_index .= "</div>";
				/*if($name_index != $name || $round+1 == $num)
				{ $name_index = $name;
					$connection_index_list_com .= "<input type=\"button\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', '');\" value=\"More...\" title=\"Click to view more stuff.\" style=\"float:right;margin: 13 10;\"/><br/>
					<span style=\"color:darkgrey;\">20+ items via <a href=\"\">".strtoupper($name)."[$gender]</a></span></div>";
				}*/
				$round++;
				}
			}
			$my_lib_connection_index .= "<div id=\"\" style=\"margin: 15 15;background-color: heavyblue;text-align:center;\"><a href=\"javascript:void(0);\" onclick=\"\">View moree</a></div>";
		$view  = "";
		
		// the topic of Compatible Stuff
		$view .= "<h1 class=\"popup_header\"><input type=\"button\" value=\"Connection\" onclick=\"\" style=\"margin-top: 5px;\"/><center style=\"margin-top: -30px;\">Cell room's Catalog <!--Compatible stuff--></center></h1>";
		$view .= "\r\n";
		// the content category list
		//$view .= "<div id=\"\" style=\"margin: 15 15;background-color: heavyblue;text-align:center;\"><a href=\"javascript:void(0);\" onclick=\"\">View morex</a></div>";
		//$view .= "T";
		$view .= "\r\n";
		$view .= "<div id=\"tata_vigation\" style=\"overflow:auto;\">";
		$view .= "<li style=\"float:left;\"><a href=\"javascript:void(0);\" onclick=\"market_scouting_popup('$profile_id','$this_product_id','','my_library','open');\">My library</a></li>";
		$view .= "<li style=\"float:left;\"><a href=\"javascript:void(0);\" onclick=\"market_scouting_popup('$profile_id','$this_product_id','','initial','open');\">Public library</a></li>";
		$view .= "<li style=\"float:left;\">Underpowered parts</a></li>";
		$view .= "</div>";
		//$view .= "\r\n";
		// the content
		$view .= $my_lib_connection_index;
		// $view .= "<br/>Daa.";
		print $view;
	}
	
	
	//elseif($market_scout_type == "update" && ((isset($_GET['index']) && $_GET['index'] == "") || !isset($_GET['index'])))
	elseif($market_scout_type == "update" && isset($_GET['index']) && $_GET['index'] == "" && isset($_GET['indexx']))
	{
		if(isset($_GET['connector_id']))
		{
			$connector_id = $_GET['connector_id'];
		}
		/*
		$goodies=mysql_query("SELECT p2.idproduct1, p2.manufacturer, p2.model, p2.default_picture, ci2.name, ci2.gender
								FROM connector_info ci1, connector_status_lookup c1, product_info p1, connector_info ci2, product_info p2, connector_status_lookup c2
								WHERE p1.idproduct1='$this_product_id'
								and c1.idproduct1=p1.idproduct1
								and ci1.connector_id=c1.connector_id
								and ci1.gender<>ci2.gender
								and ci1.name = ci2.name
								and c2.connector_id=ci2.connector_id
								and p2.idproduct1=c2.idproduct1
								");*/
		/* WORKS *
		$goodies=mysql_query("SELECT p2.idproduct1, p2.manufacturer, p2.model, p2.default_picture, ci2.name, ci2.gender
								FROM connector_info ci1, connector_status_lookup c1, product_info p1, product_info p2, connector_status_lookup c2, connector_info ci2
								WHERE p1.idproduct1='$this_product_id'
								and c1.idproduct1=p1.idproduct1
								and ci1.connector_id=c1.connector_id
								and ci2.name = '$connector_id'
								and ci1.gender<>ci2.gender
								and p2.idproduct1=c2.idproduct1
								and c2.connector_id=ci2.connector_id
								GROUP BY ci2.name, p2.default_picture
								");	*/
		
		/* WORKS */
		$goodies=mysql_query("SELECT p1.idproduct1, p1.manufacturer, p1.model, p1.default_picture, ci2.name, ci2.gender
								FROM connector_info ci1, connector_status_lookup c1, product_info p1, product_info p2, connector_status_lookup c2, connector_info ci2
								WHERE p1.idproduct1='$this_product_id'
								or ci2.name = '$connector_id'
								GROUP BY ci2.name, p1.default_picture
								");	

		/*$goodies=mysql_query("SELECT p1.idproduct1, p1.manufacturer, p1.model, p1.default_picture
								FROM product_info p1
								WHERE p1.idproduct1='$this_product_id'");*/
		
		/*		
								SELECT p2.idproduct1, p2.manufacturer, p2.model, ci2.gender, ci2.name
								<>>>>>>>
								
								
								and ci1.name=ci2.name
								and ci1.gender<>ci2.gender
								and ci1.connector_id<>ci2.connector_id
								and c2.connector_id=ci2.connector_id						
								and p2.idproduct1=c2.idproduct1
								*/
								
			$num = mysql_numrows($goodies);
			print "NUM: $num, $this_product_id, $connector_id";
			$connection_index_list = "";
			$name_index = "";
			$name_index_footer = "";
			$round = 0;
			$connection_list = Array();
			while ($row = mysql_fetch_assoc($goodies)) {

					$product_id = $row['idproduct1'];
					$manufacturer = $row['manufacturer'];
					$model = $row['model'];
					$photo = $row['default_picture'];
					$name = $row['name'];
					$gender = $row['gender'];
				/*	
				$connection_index[$name] = $gender;
				$connection_index[$name][$product_id];
				$connection_index[$name][$product_id]["manufacturer"] = $manufacturer;
				$connection_index[$name][$product_id]["model"] = $model;
				$connection_index[$name][$product_id]["photo"] = $photo;
				
				*
				
				$connection_index[$product_id]["manufacturer"] = $manufacturer;
				$connection_index[$product_id]["model"] = $model;
				$connection_index[$product_id]["photo"] = $photo;
				
				*
				
				foreach($connection_index as $manufacturer)
				{
					if($name_index != $manufacturer)
					{ $name_index = $manufacturer;
						$connection_index_list .= "<input type=\"button\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', '');\" value=\"Reservation [Buy...] [Pending Delivery & Feedback]\" title=\"Click to view more stuff.\" style=\"float:right;margin: 13 10;\"/><br/>
						<span style=\"color:darkgrey;\">20+ items via <a href=\"\">".strtoupper($name)."[$gender]</a></span></div>";
						$connection_index_list .= "<div id=\"\" style=\"border-bottom:1px dotted;padding-left: 5px;\">$manufacturer<br/> <span style=\"margin-left: 15px;\">";
					}
					$connection_index_list .= "<a href=\"object.php?id=$product_id\"><img src=\"upload/$photo\" style=\"width:50px;height:50px;\" title=\"$manufacturer $model via $name ($gender)\"></a></span>";
					if($round+1 == $num)
					{ // $name_index = $manufacturer;
						$connection_index_list .= "<input type=\"button\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', '');\" value=\"Reservation [Buy...] [Pending Delivery & Feedback]\" title=\"Click to view more stuff.\" style=\"float:right;margin: 13 10;\"/><br/>
						<span style=\"color:darkgrey;\">20+ items via <a href=\"\">".strtoupper($name)."[$gender]</a></span></div>";
					}
					$round++;
				}
				*/
				$connection_index[$manufacturer][$product_id]["model"] = $model;
				$connection_index[$manufacturer][$product_id]["photo"] = $photo;
				$connection_index[$manufacturer][$product_id]["connector"] = $name;
				$connection_index[$manufacturer][$product_id]["gender"] = $gender;
			}
			foreach($connection_index as $manufacturer => $array_1)
			{
				$connection_index_list .= "<div id=\"\" style=\"border-bottom:1px dotted;padding-left: 5px;\">$manufacturer<br/> <span style=\"margin-left: 15px;\">";
				foreach($array_1 as $this_product_id => $array_2)
				{
					// $connection_index_list .= "\$product_id: $product_id<br/>";
					/*
					foreach($array_2 as $key => $value)
					{
						
					}*/
					$model = $array_2["model"];
					$photo = $array_2["photo"];
					$name = $array_2["connector"];
					$gender = $array_2["gender"];
					$connection_index_list .= "<a href=\"object.php?id=$product_id\"><img src=\"upload/$photo\" style=\"width:50px;height:50px;\" title=\"$manufacturer $model via $name ($gender)\"></a>";
					$connection_index_list .= "<span  style=\"margin: 25 0 0 0;padding: -25 0 0 0;\"><a href=\"object.php?id=$product_id\"><img src=\"upload/$photo\" style=\"width:25px;height:25px;\" title=\"$manufacturer $model via $name ($gender)\"></a></span>";
					$connection_index_list .= "<a href=\"object.php?id=$product_id\"><img src=\"upload/$photo\" style=\"width:25px;height:25px;\" title=\"$manufacturer $model via $name ($gender)\"></a>";
				}
				$connection_index_list .= "</span><input type=\"button\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', 'suggest');\" value=\"Reservation\" title=\"Click to view more stuff.\" style=\"float:right;margin: 13 10;\"/><br/><span style=\"color:darkgrey;\">20+ items via <a href=\"\">".strtoupper($name)."[$gender]</a></span></div>";
			}
			$connection_index_list .= "<div id=\"\" style=\"margin: 15 15;background-color: heavyblue;text-align:center;\"><a href=\"javascript:void(0);\" onclick=\"\">View mored</a></div>";
			
			/*
			$compatible_goodies = ""; //$this_product_id<br/>";
			while ($row = mysql_fetch_assoc($goodies)) {

					$product_id = $row['idproduct1'];
					$manufacturer = $row['manufacturer'];
					$model = $row['model'];
					$photo = $row['default_picture'];
					$name = $row['name'];
					$gender = $row['gender'];
				$compatible_goodies .= "<a href=\"object.php?id=$product_id\"><img src=\"upload/$photo\" style=\"width:50px;height:50px;\" title=\"$manufacturer $model via $name ($gender)\"></a>";
			}
		
		$goodies = "mysql_command";
		$num = mysql_num_rows($goodies);
		$connection_index_list = "";
		$connectory_type_list["Connector-free"] = 0;
		$connectory_type_list["Plug & Play"] = 1;
		$connectory_type_list["Plug & Play"] = 2;
		while ($row = mysql_fetch_assoc($goodies)) {
			$product_id = $row['idproduct1'];
			$object = $row['object'];
			$photo_link .= "upload/$product_id.$object";
			
			$connection_index_list .= "<div id=\"\">Plug &amp; Play content <input type=\"button\" value=\"More...\" title=\"Click to view more stuff.\"/><br/>20+ items via <a href=\"\">USB</a></div>";
		}
		$connection_index_list .= "<div id=\"\">End. View more...</div>";
		*/
		$view  = "";
		
		// the topic
		$view .= "<h1 class=\"popup_header\"><input type=\"button\" value=\"Connection\" onclick=\"\" style=\"margin-top: 5px;\"/><center style=\"margin-top: -30px;\">Connections by USB</center></h1>";
		// $view .= "<a href=\"javascript:void(0);\" onclick=\"\">Connectionz</a>";
		// $view .= "<h1 class=\"popup_header\">ConnectionzZzZ</h1>";
		$view .= "\r\n";
		$view .= "Fix this text.";
		$view .= "\r\n";
		/*
		// the content category list
		$view .= "T";
		$view .= "\r\n";
		*/
		// the content
		$view .="Daa";
		$view .= "<div id=\"market_scouting_progress\" style=\"float:left;border: 0px solid;overflow:auto;width:550px;\">";
		$view .= $connection_index_list;
		$view .= "</div>";
		$view .= "<div style=\"border-left: 1px dotted;overflow:auto;height:265px;padding: 0 0 0 5;\">";
		// $view .= "<h3>The Agenda</h3>";
		$view .= "<h4>The stuff</h4>";
		// $view .= "Stuff I ";
		$view .= "I ";
		$view .= "<input type=\"button\" value=\"have\">";
		$view .= "<input type=\"button\" value=\"haven't\">";
		$view .= "<input type=\"button\" value=\"need better\">";
		$view .= "<input type=\"button\" value=\"need newer\">";
		$view .= "<br/> my friends ";
		// $view .= "<br/>Stuff my friends ";
		$view .= "<input type=\"button\" value=\"have\">";
		$view .= "<input type=\"button\" value=\"haven't\">";
		$view .= "<h4>The bank</h4> ";
		$view .= "<input type=\"text\" value=\"\">";
		$view .= "<input type=\"password\" value=\"\">";
		$view .= "<input type=\"button\" value=\"Access\">";
		$view .= "<br/><input type=\"image\" value=\"[Pankki]\">";
		//$view .= "<h4>The delivery &amp; Feedback</h4> ";
		// $view .= "The Packet I got";
		$view .= "<h4>The Packet I got</h4>";
		$view .= "<input type=\"button\" value=\"is clear\">";
		$view .= "<input type=\"button\" value=\"has correct content\">";
		$view .= "<h4>Finally, I feel</h4>";
		$view .= "<input type=\"button\" value=\"good\">";
		$view .= "<input type=\"button\" value=\"bad\">";
		$view .= "</div>";
		// $view .= "<br/>Daa.";
		//$view .= "\r\n";
		//$view .= "<h1 class=\"popup_header\"><input type=\"button\" value=\"Connection\" onclick=\"\" style=\"margin-top: 5px;\"/><center style=\"margin-top: -30px;\">Connections by USB</center></h1>";
		print $view;
	}
	
	//elseif(isset($_GET['index']) && !empty($_GET['index']))
	
	elseif($market_scout_type == "update")// && ((isset($_GET['index']) && $_GET['index'] == "") || !isset($_GET['index'])))
	{
		$name = $_GET['connector_id'];
		$session_profile_id = $_SESSION["stuffwalk_profile"];
		// profile taulu vois olla jatkossa esim. ownership
		$check_owner = mysql_query("SELECT idprofile1 FROM profile WHERE `data_object`='$this_product_id' and `data_value`='owner'");
		while ($row = mysql_fetch_assoc($check_owner)) {
					$owner_id = $row['idprofile1'];
					if($owner_id == $session_profile_id)
					{
						$status = "seller";
					}
					else 
					{
						$status = "buyer";
					}
		}
		// katso jostain kauppakirjasta mallia, mitä kaikkee kuuluu nii saa tänkin simpleksi.
		/*
			Waiting for (x time left for cancel)
			tee se realtime-latauspalkki, et miltä näyttäis joka kohdassa :D
			Tuotteen omistajan vois hakea profile_info taulusta mistä näkyy kuka omistaa, ja trade_agreementista näkee vain ostajan.
		*/
		/*if ($_GET['index'] == "initial_market_scouting")
		{
			// $view  = "<h1 class=\"popup_header\"><input type=\"button\" value=\"Connection\" onclick=\"\" style=\"margin-top: 5px;\"/><center style=\"margin-top: -30px;\">Market Scouting (Connections by USB)</center></h1>";
		$mq_result = mysql_query("SELECT p.manufacturer, p.model, p.default_picture 
									FROM product_info p	
									WHERE p.idproduct1='$this_product_id'");
			$this_product = "";
		if(mysql_num_rows($mq_result) > 0)
		{
			while ($row = mysql_fetch_assoc($mq_result)) {
						//$buyer_id = $row['buyer_id'];
						$manufacturer = $row['manufacturer'];
						$model = $row['model'];
						$default_picture = $row['default_picture'];
				
				// $this_product .= "<img src=\"upload/$default_picture\" style=\"width:50px;height:50px;\"/> $manufacturer, $model<input type=\"button\" value=\"&times; Cancel Reservation\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', '');\" style=\"float: right;margin: 15 0;\" /><hr/>";
				$this_product .= "<div id=\"seller_control_panel_navigation\"><img src=\"upload/$default_picture\" style=\"width:75px;height:75px;\"/> $manufacturer $model <a href=\"javascript:void(0);\">Optional stuff to add</a></div>";
			}
		}
		else $this_product .= "????";	
			
			$view  = "<h1 class=\"popup_header\"><center>Seller Control Panel</center></h1>";
			$view .= "\r\n";
			$view .= "<input type=\"hidden\" name=\"this_product_id\" value=\"$this_product_id\">";
			//$view .= "<h4>Include or Exclude stuff</h4>";
			//$view .= "Doh: <div id=\"daalee\"></div>";
			$view .= "<div style=\"overflow: auto;\">";
			$view .= "<div class=\"block\" style=\"float: left;margin: 5;border: 1px solid;\" onmouseover=\"\" onmouseout=\"\">";
			$view .= "<h4>Kohderyhmä, Target group</h4>";
			$view .= "<a href=\"\">University of Jyväskylä</a>, <a href=\"\">Keski-Suomi</a>";
			$view .= "<br/>20+ potential buyer, 20+ compatible stuff from other accounts";
			$view .= "</div>";
			$view .= "<div class=\"block\" style=\"float: left;margin: 5;border: 1px solid;\">";
			$view .= "<h4>Brändisi, Your level</h4>";
			$view .= "<a href=\"\">Good-standing, stability</a>";
			$view .= "</div>";
			$view .= "<div class=\"block\" style=\"float: left;margin: 5;border: 1px solid;\">";
			$view .= "<h4>Markkinatiedot, Price, pankkiyhteys</h4>";
			$view .= "<a href=\"\" title=\"20 buyers uses this bank\">Pankki</a>, 40e (lowest - highest price)";
			$view .= "<br/>Nordea - 1 day, Sampo Bank - 2 days";
			$view .= "</div>";
			$view .= "<div class=\"block\" style=\"float: left;margin: 5;border: 1px solid;\">";
			$view .= "<h4>Logistiikka, Paketin kuljetustapa</h4>";
			$view .= "<a href=\"\"  title=\"20 buyers allow this\">Nouto</a>, <a href=\"\"  title=\"20 buyers allow this\">Posti</a>";
			$view .= "</div>";
			$view .= "</div>";
			$view .= "<input type=\"button\" value=\"Begin\" onClick=\"update_proprietor_status('$session_profile_id', '$this_product_id, 'sell')\">";
			$view .= "\r\n";
			$view .= $this_product;
			print $view;
		}*/
		
	function time_interval($terms){
					// http://stackoverflow.com/questions/136782/format-mysql-datetime-with-php
					// http://www.richardlord.net/blog/dates-in-php-and-mysql
					// http://php.net/manual/en/datetime.diff.php
					// http://php.net/manual/en/datetime.gettimestamp.php
					// http://stackoverflow.com/questions/3727615/adding-days-to-date-in-php
					$now = new DateTime();
						if(empty($terms[1]))
						{
							$time_difference = date_timestamp_get($now)-$terms[0];
							if($time_difference>0)
							{
								if(floor($time_difference/(60*60*24*30*12))>1)
								{
									$ti = floor($time_difference/(60*60*24*30*12))." years";
								}
								elseif(floor($time_difference/(60*60*24*30*12))>0)
								{
									$ti = floor($time_difference/(60*60*30*12))." year";
								}
								elseif(floor($time_difference/(60*60*24*30))>1)
								{
									$ti = floor($time_difference/(60*60*24*30))." months";
								}
								elseif(floor($time_difference/(60*60*24*30))>0)
								{
									$ti = floor($time_difference/(60*60*30))." month";
								}
								elseif(floor($time_difference/(60*60*24))>1)
								{
									$ti = floor($time_difference/(60*60*24))." days";
								}
								elseif(floor($time_difference/(60*60*24))>0)
								{
									$ti = floor($time_difference/(60*60*24))." day";
								}
								elseif(floor($time_difference/(60*60))>1)
								{
									$ti = floor($time_difference/(60*60))." hours";
								}
								elseif(floor($time_difference/(60*60))>0)
								{
									$ti = floor($time_difference/(60*60))." hour";
								}
								elseif(floor($time_difference/(60))>1)
								{
									$ti = floor($time_difference/(60))." minutes";
								}
								elseif(floor($time_difference/(60))>0)
								{
									$ti = floor($time_difference/(60))." minute";
								}
								elseif(floor($time_difference)>1)
								{
									$ti = floor($time_difference)." seconds";
								}
								elseif(floor($time_difference)>0)
								{
									$ti = floor($time_difference)." second";
								}
								$ti .= " ago";
							}
							else
							{
								$ti .= "a moment ago";
							}
						}
					elseif(!empty($terms[1]))
						{
							$time_difference = $terms[1]-date_timestamp_get($now);
							if($time_difference>0)
							{
								if(floor($time_difference/(60*60*24*30*12))>1)
								{
									$ti = floor($time_difference/(60*60*24*30*12))." years";
								}
								elseif(floor($time_difference/(60*60*24*30*12))>0)
								{
									$ti = floor($time_difference/(60*60*30*12))." year";
								}
								elseif(floor($time_difference/(60*60*24*30))>1)
								{
									$ti = floor($time_difference/(60*60*24*30))." months";
								}
								elseif(floor($time_difference/(60*60*24*30))>0)
								{
									$ti = floor($time_difference/(60*60*30))." month";
								}
								elseif(floor($time_difference/(60*60*24))>1)
								{
									$ti = floor($time_difference/(60*60*24))." days";
								}
								elseif(floor($time_difference/(60*60*24))>0)
								{
									$ti = floor($time_difference/(60*60*24))." day";
								}
								elseif(floor($time_difference/(60*60))>1)
								{
									$ti = floor($time_difference/(60*60))." hours";
								}
								elseif(floor($time_difference/(60*60))>0)
								{
									$ti = floor($time_difference/(60*60))." hour";
								}
								elseif(floor($time_difference/(60))>1)
								{
									$ti = floor($time_difference/(60))." minutes";
								}
								elseif(floor($time_difference/(60))>0)
								{
									$ti = floor($time_difference/(60))." minute";
								}
								elseif(floor($time_difference)>1)
								{
									$ti = floor($time_difference)." seconds";
								}
								elseif(floor($time_difference)>0)
								{
									$ti = floor($time_difference)." second";
								}
								$ti .= " left";
							}
							else
							{
								$ti .= "the_end";
							}
						}
					return $ti;
				}
		
		
		if($_GET['index'] == "refresh")
		{
			$mq_result = mysql_query("SELECT m.buyer_id, m.publish_time, m.accept_price, m.accept_datetime, m.pay_amount, m.pay_datetime, m.delivery_datetime, m.feedback, m.feedback_datetime, p.manufacturer, p.model, p.default_picture 
									FROM market_scouting m, product_info p	
									WHERE m.idproduct1='$this_product_id' and m.idproduct1=p.idproduct1");
			$view  = "<h1 class=\"popup_header\"><input type=\"button\" value=\"Connection\" onclick=\"\" style=\"margin-top: 5px;\"/><center style=\"margin-top: -30px;\">Market Scouting (Connections by USB)</center></h1>";
			// $view  = "\$this_product_id: $this_product_id";
			// $view  .= "Rows: " . mysql_numrows($mq_result) . "<br/>dx";
			while ($row = mysql_fetch_assoc($mq_result)) {
						$buyer_id = $row['buyer_id'];
						$manufacturer = $row['manufacturer'];
						$model = $row['model'];
						$default_picture = $row['default_picture'];
						$layout = 1;
			if($buyer_id != "0")
						{	
							$accept_price = $row['accept_price'];
							$waiting_for_product = 1;
							if($accept_price != "0")
							{$pay = 1;}else{$pay = 0;}
							$suggestion_datetime = $row['publish_time'];
							$published = strtotime($suggestion_datetime);
							$terms = Array($published, "");
							//$time_interval = time_interval($terms);
							$agreement_deadline = strtotime($suggestion_datetime . ' + 14 days');
							$terms_agreement = Array($published, $agreement_deadline);
							$time_interval["_agreement"] = time_interval($terms_agreement);
							// $layout = 1;
						}
						
						$accept_price = $row['accept_price'];
						if($accept_price != "0")
						{
							$waiting_for_seller = 1;
							$seller = 1;
							$accept_datetime = $row['accept_datetime'];
							$payment_deadline = strtotime($accept_datetime . ' + 14 days');
							$terms_payment = Array($published, $payment_deadline);
							$time_interval["_payment"] = time_interval($terms_payment);
						}
						else {
							$waiting_for_seller = 0;
							$seller = 0;
						}
						
						$pay_amount = $row['pay_amount'];
						$pay_datetime = $row['pay_datetime'];
						if($pay_amount != "0" && $pay_datetime != "0000-00-00 00:00:00")
						{
							$waiting_for_pay = 1;
							$delivery = 1;
							
							$delivery_deadline = strtotime($pay_datetime. ' + 14 days');
							$terms_delivery = Array($published, $delivery_deadline);
							$time_interval["_delivery"] = time_interval($terms_delivery);
						}
						else {
							$waiting_for_pay = 0;
							$delivery = 0;
						}
											
						$delivery_datetime = $row['delivery_datetime'];
						if($delivery_datetime != "0000-00-00 00:00:00")
						{
							$waiting_for_delivery = 1;
							$arrive_deadline = strtotime($delivery_datetime . ' + 14 days');
							$terms_arrive = Array($published, $arrive_deadline);
							$time_interval["_arrive"] = time_interval($terms_arrive);
							
						}
						else {
							$waiting_for_delivery = 0;
						}
						
						$feedback = $row['feedback'];
						if($feedback != "0")
						{
							$waiting_for_feedback = 1;
							$feedback = 1;
							$feedback_datetime = $row['feedback_datetime'];
							$ror_deadline = strtotime($feedback_datetime . ' + 14 days'); // rights_of_return
							$terms_ror = Array($published, $ror_deadline);
							$time_interval["_ror"] = time_interval($terms_ror);
							$done = 1;
						}
						else {
							$feedback = 0;
							$waiting_for_feedback = 0;
							$done = 0;
						}
						
				$view .= "\r\n";
				$view .= "[[Delete this ]]";
				$view .= "\r\n";
				/*
				//$status["Accept"] = "Seller is accept you as official buyer. Pay -- It's that! <input type=\"button\" value=\"Buy\" onclick=\"\"> ";
				$status_accept = "Seller is accept you as official buyer. Pay -- It's that! [<a href=\"javacript:void(0);\">This seller has X compatible stuff</a>] <input type=\"button\" value=\"Buy\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'pay');\"><br/>Suggested since $suggestion_datetime, accepted since $accept_datetime ";
				//$status["Accept"] = "Seller ";
				//print $status["Accept"];
				//print $s;
				
				$view .= "<img src=\"upload/$default_picture\" style=\"width:50px;height:50px;\"/> $manufacturer, $model<input type=\"button\" value=\"&times; Cancel Reservation\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', '');\" style=\"float: right;margin: 15 0;\" /><hr/>";
				$view .=($waiting_for_product) ?(($pay) ? (($layout) ? $status_accept : "In Progress") : "<div style=\"background-color:Khaki;\">Seller - Pending (7 days left)</div>") : "<div style=\"background-color:lightgrey;\">Seller -</div>";
	
				$view .= "<hr/>";
				$status_pay = "Buyer has payed stuff and wait your response about delivery. <input type=\"button\" value=\"Begin Delivery\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'pay');\"><br/>Since $pay_datetime ";
				$view .=($waiting_for_seller) ?(($seller) ? (($layout) ? $status_pay : "In Progress") : "<div style=\"background-color:lightorange;\">Pay - Pending</div>") : "<div style=\"background-color:lightgrey;\">Pay -</div>";
				$view .= "<hr/>";
				$status_delivery = "Seller has sent stuff for you. Please wait a moment of delivery. <input type=\"button\" value=\"Check Delivery\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'delivery');\"> <br/> Since $delivery_datetime ";
				$view .=($waiting_for_pay) ?(($delivery) ? (($layout) ? $status_delivery : "In Progress") : "<div style=\"background-color:lightorange;\">Delivery - Pending") : "<div style=\"background-color:lightgrey;\">Delivery -</div>";
				$view .= "<hr/>";
				$status_feedback = "Stuff is arrived near your home. The last activity is update idiot/immersion indicator (feedback). Current stats: [<a href=\"javascript:void(0);\" title=\"Reliability: Excellent\">*</a>] <input type=\"button\" value=\"Update\" onclick=\"\"> <!--<input type=\"button\" value=\"Give Feedback\" onclick=\"\">-->";
				$view .=($waiting_for_delivery) ?(($feedback) ? (($layout) ? $status_feedback : "In Progress") : "<div style=\"background-color:lightorange;\">Feedback - Pending") : "<div style=\"background-color:lightgrey;\">Feedback -</div>";
				$view .= "<hr/>";
				$status_done = "This exchange is archived. [<a href=\"javacript:void(0);\">You have X compatible stuff</a>] [<a href=\"javacript:void(0);\">Founded X compatible stuff to new scouting</a>] <input type=\"button\" value=\"Browse archives\" onclick=\"\"> <br/>Since $feedback_datetime <input type=\"button\" value=\"Continue other exchanges\" onclick=\"\"> <input type=\"button\" value=\"Return stuff.\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'right_of_return');\">";
				$view .=($waiting_for_feedback) ?(($done) ? (($layout) ? $status_done : "In Progress") : "<div style=\"background-color:lightorange;\">Done - Pending") : "<div style=\"background-color:lightgrey;\">Done -</div>";
				$view .= "<hr/>";*/
			$layout = 2;
				if($layout == 1)
				{
				$view .= "<div style=\"overflow:auto;\"><span><img src=\"upload/$default_picture\" style=\"width:50px;height:50px;float:left;\" /> $manufacturer $model  (hinta, ehdot)</span><input type=\"button\" value=\"&times; Cancel Reservation\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', 'abort');\" style=\"float: right;margin: 15 0;\" /></div><hr/>";
				$view .=($waiting_for_product) ?(($pay) ? (($layout) ? $status_accept : "In Progress") : "<div style=\"background-color:Khaki;\">Seller - Pending (7 days left)") : "<div style=\"background-color:lightgrey;\">Seller -</div>";
				$view .= "<hr/>";
				$status_pay = "Buyer has payed stuff and wait your response about delivery. <input type=\"button\" value=\"Begin Delivery\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'pay');\"> ";
				$view .=($waiting_for_seller) ?(($seller) ? (($layout) ? $status_pay : "In Progress") : "<div style=\"background-color:lightorange;\">Pay - Pending</div>") : "<div style=\"background-color:lightgrey;\">Pay -</div>";
				$view .= "<hr/>";
				$status_delivery = "Seller has sent stuff for you. Please wait a moment of delivery. <input type=\"button\" value=\"Check Delivery\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'delivery');\"> ";
				$view .=($waiting_for_pay) ?(($delivery) ? (($layout) ? $status_delivery : "In Progress") : "<div style=\"background-color:lightorange;\">Delivery - Pending") : "<div style=\"background-color:lightgrey;\">Delivery -</div>";
				$view .= "<hr/>";
				$status_feedback = "Stuff is arrived near your home. The last activity is feedback. <input type=\"button\" value=\"Give Feedback\" onclick=\"\"> ";
				$view .=($waiting_for_delivery) ?(($feedback) ? (($layout) ? $status_feedback : "In Progress") : "<div style=\"background-color:lightorange;\">Feedback - Pending") : "<div style=\"background-color:lightgrey;\">Feedback -</div>";
				$view .= "<hr/>";
				$status_done = "This exchange is archived. [<a href=\"javacript:void(0);\">You have X compatible stuff</a>] [<a href=\"javacript:void(0);\">Founded X compatible stuff to new scouting</a>] <input type=\"button\" value=\"Browse archives\" onclick=\"\"> <input type=\"button\" value=\"Continue other exchanges\" onclick=\"\"> <input type=\"button\" value=\"Return stuff.\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'right_of_return');\">";
				$view .=($waiting_for_feedback) ?(($done) ? (($layout) ? $status_done : "In Progress") : "<div style=\"background-color:lightorange;\">Done - Pending") : "<div style=\"background-color:lightgrey;\">Done -</div>";
				$view .= "<hr/>";
				}
				elseif($layout == 2)
				{
				$view .= "<div style=\"overflow:auto;\"><div style=\"width:400px;float:left;\"><img src=\"upload/$default_picture\" style=\"width:75px;height:75px;float:left;\" /> $manufacturer $model with(hinta, ehdot)<br/>";
				$view .= "<a href=\"javascript:void(0);\"><img src=\"\" style=\"width:50px;height:50px;\" /></a>";
				$view .= "<a href=\"javascript:void(0);\"><img src=\"\" style=\"width:50px;height:50px;\" /></a>";
				$view .= "<a href=\"javascript:void(0);\"><img src=\"\" style=\"width:50px;height:50px;\" /></a>";
				$view .= "</div><input type=\"button\" value=\"&times; Cancel Reservation\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', 'abort');\" style=\"float: right;margin: 25 5 25 0;\" /></div>";
				$view .=($waiting_for_product) ?
							(($waiting_for_pay) ? (($layout) ? $status_accept : "In Progress") : 
							"<div style=\"border-top:1px solid;border-bottom:1px solid;overflow:auto;background-color:Khaki;\" onmousemove=\"mysql_timer();\"> Payment <label style=\"float:right;\"><input id=\"payment_button\" type=\"button\" value=\"Pending seller\" disabled=\"true\" style=\"margin:15 5 0 0\" market_scout('$profile_id', '$this_product_id', '', 'pay');><br/><span id=\"timeleft_timer_$suggestion_datetime\" class=\"payment_button\" title=\"$suggestion_datetime\">".$time_interval["_agreement"]."</span></label></div>") : "<div style=\"background-color:lightgrey;\">Seller -</div>";
				
				$status_done = "Introduction <label style=\"float:right;\"><input type=\"button\" value=\"Pending delivery (7d left)\" disabled=\"true\" style=\"margin:15 5 15 0\"></label>";		
				$view .= ($waiting_for_delivery) ?
							(($done) ? (($layout) ? $status_done : "In Progress") : 
								"<div style=\"border-bottom:1px solid;overflow:auto;background-color:lightorange;height:80px;padding: 5% 0 0 0;\">Pending Delivery") : 
								"<div style=\"border-bottom:1px solid;overflow:auto;background-color:lightgrey;height:80px;padding: 5% 0 0 0;text-align:center;\">Pending begin after Payment</div>";

				}
				
			}
			print $view;
		}
		else{
			if(mysql_numrows(mysql_query("SELECT * FROM market_scouting WHERE `idproduct1`='$this_product_id' and `buyer_id`='$profile_id'"))==0 && ($_GET['index'] == "" || $_GET['index'] == "suggest"))
			{
				$_GET['index'] = "suggest";
			}
			
			switch($_GET['index'])
			{
				case "suggest":
				{	// buyer suggest the trade agreement
					
					// market_scout('$profile_id', '$this_product_id', '$name', 'suggest')
					// mysql_query("INSERT INTO trade_agreement_info VALUES('$this_product_id',NOW(),'$profile_id','','','','','','','','')");
					$check = mysql_query("SELECT * FROM market_scouting WHERE `idproduct1`='$this_product_id' and `buyer_id`='$profile_id'");
					$being_check = mysql_numrows($check);
					if ($being_check > 0)
					{	/* Nothing happen */	}
					else {
						$suggest_time = "1";
						mysql_query("INSERT INTO market_scouting VALUES('$this_product_id',NOW(),'$profile_id','$suggest_time','','','','','','','')");
					}
					// mysql_query("UPDATE trade_agreement_info SET `suggest_datetime`=NOW() WHERE `idproduct1`= '$this_product_id'");
					$option = "buyer_id, suggestion_datetime";
					break;
				}
				case "accept":
				{	// seller accept the trade agreement
					$accept_price = "10";
					mysql_query("UPDATE market_scouting SET `accept_price`='$accept_price', `accept_datetime`=NOW() WHERE `idproduct1`= '$this_product_id'");
					//mysql_query("UPDATE trade_agreement_info SET `accept_price`='$accept_price', `accept_datetime`=NOW() WHERE `idproduct1`= '$this_product_id'");
					$option = "buyer_id, suggestion_datetime, accept_price, accept_datetime";
					break;
				}
				case "pay":
				{	// buyer pay the trade agreement
					$pay_amount = "10";
					mysql_query("UPDATE market_scouting SET `pay_amount`='$pay_amount', `pay_datetime`=NOW() WHERE `idproduct1`= '$this_product_id'");
					//mysql_query("UPDATE trade_agreement_info SET `pay_amount`='$pay_amount', `pay_datetime`=NOW() WHERE `idproduct1`= '$this_product_id'");
					$option = "buyer_id, suggestion_datetime, accept_price, accept_datetime, pay_amount, pay_datetime";
					break;
				}
				case "delivery":
				{	// seller delivery the trade agreement
					mysql_query("UPDATE market_scouting SET `delivery_datetime`=NOW() WHERE `idproduct1`= '$this_product_id'");
					// mysql_query("UPDATE trade_agreement_info SET `delivery_datetime`=NOW() WHERE `idproduct1`= '$this_product_id'");
					$option = "buyer_id, suggestion_datetime, accept_price, accept_datetime, pay_amount, pay_datetime, delivery_datetime";
					break;
				}
				case "feedback":
				{	// buyer give feedback about the trade agreement
					$feedback = "1";
					mysql_query("UPDATE market_scouting SET `feedback`='$feedback', `feedback_datetime`=NOW() WHERE `idproduct1`= '$this_product_id'");
					// mysql_query("UPDATE trade_agreement_info SET `feedback`='$feedback', `feedback_datetime`=NOW() WHERE `idproduct1`= '$this_product_id'");
					$option = "buyer_id, suggestion_datetime, accept_price, accept_datetime, pay_amount, pay_datetime, delivery_datetime, feedback, feedback_datetime";
					
					$market_node = mysql_query("SELECT m.buyer_id, p.idprofile1
								FROM market_scouting m, profile p
								WHERE m.idproduct1='$this_product_id'
								and m.idproduct1=p.data_object
								and p.data_value='owner'
								ORDER BY datetime DESC LIMIT 1
								");
								// ORDER BY datetime DESC LIMIT 0, 10
					while ($row = mysql_fetch_assoc($market_node)) {
						$buyer_id = $row['buyer_id'];
						$previous_owner_id = $row['idprofile1'];
					
					mysql_query("UPDATE product_info SET `parent_product`='' WHERE `idproduct1`='$this_product_id'");
					mysql_query("UPDATE profile SET `data_value`='ex-owner' WHERE `idprofile1`='$previous_owner_id' and `data_object`='$this_product_id'");
					mysql_query("INSERT INTO profile VALUES('$session_profile_id',NOW(),'product','owner','$this_product_id','','Only Me')");
					/*
					mysql_query("INSERT INTO profile_info VALUES('$this_product_id',NOW(),'','','','','','')");
					mysql_query("UPDATE profile_info SET `feedback`='$feedback', `feedback_datetime`=NOW() WHERE `idproduct1`= '$this_product_id'");
					*/
					}
					break;
				}
				case "right_of_return":
				{
					
					// ensin listataan uusin ex-owner, sitten palautus
					$market_node = mysql_query("SELECT m.buyer_id, p.idprofile1
								FROM market_scouting m, profile p
								WHERE m.idproduct1='$this_product_id'
								and m.idproduct1=p.data_object
								and p.data_value='ex-owner'
								ORDER BY p.datetime DESC LIMIT 1
								");
								// ORDER BY datetime DESC LIMIT 0, 10
					while ($row = mysql_fetch_assoc($market_node)) {
						$buyer_id = $row['buyer_id'];
						$previous_owner_id = $row['idprofile1'];
						
					
						/*
						mysql_query("DELETE FROM profile WHERE `data_value`='owner' and `data_object`='$this_product_id'");
						mysql_query("UPDATE profile SET `data_value`='owner' WHERE `data_value`='ex-owner' and `data_object`='$this_product_id'");
						mysql_query("DELETE FROM market_scouting WHERE `idproduct1`='$this_product_id'");
						*/
					}
					break;
				}
				case "abort":
				{
					mysql_query("DELETE FROM market_scouting WHERE `idproduct1`='$this_product_id' and `buyer_id`='$profile_id'");
					//mysql_query("UPDATE profile SET `data_value`='owner' WHERE `data_value`='ex-owner' and `data_object`='$this_product_id'");
					//mysql_query("DELETE FROM market_scouting WHERE `idproduct1`='$this_product_id'");
					break;
				}
			}
			/*	Elä lisää case-kohtiin optionia, vaan suoraan tähän alas, koska muuten while-silmukka tökkii virhettä. tarkista silmukassa vasta missä mennään.	*/ 
			// $ms_result = mysql_query("SELECT $option FROM trade_agreement WHERE `idproduct1`='$this_product_id'");
			// $ms_result = mysql_query("SELECT $option FROM market_scouting WHERE `idproduct1`='$this_product_id'");
			// $ms_result = mysql_query("SELECT m.byer_id, m.suggestion_datetime, m.accept_price, m.accept_datetime, m.pay_amount, m.pay_datetime, m.delivery_datetime, m.feedback, m.feedback_datetime, p.manufacturer, p.model, p.specification FROM market_scouting m, product_info p WHERE m.idproduct1='$this_product_id' and m.idproduct1=p.idproduct1");
			
			
			
			$mq_result = mysql_query("SELECT m.buyer_id, m.publish_time, m.accept_price, m.accept_datetime, m.pay_amount, m.pay_datetime, m.delivery_datetime, m.feedback, m.feedback_datetime, p.manufacturer, p.model, p.default_picture 
									FROM market_scouting m, product_info p	
									WHERE m.idproduct1='$this_product_id' and m.idproduct1=p.idproduct1");
			$view  = "";
			// $view  = "\$this_product_id: $this_product_id";
			// $view  .= "Rows: " . mysql_numrows($mq_result) . "<br/>dx";
			while ($row = mysql_fetch_assoc($mq_result)) {
						$buyer_id = $row['buyer_id'];
						$manufacturer = $row['manufacturer'];
						$model = $row['model'];
						$default_picture = $row['default_picture'];
						$layout = 1;
						if($buyer_id != "0")
						{	
							$accept_price = $row['accept_price'];
							$waiting_for_product = 1;
							if($accept_price != "0")
							{$pay = 1;}else{$pay = 0;}
							$suggestion_datetime = $row['publish_time'];
							$published = strtotime($suggestion_datetime);
							$terms = Array($published, "");
							//$time_interval = time_interval($terms);
							$agreement_deadline = strtotime($suggestion_datetime . ' + 14 days');
							$terms_agreement = Array($published, $agreement_deadline);
							$time_interval["_agreement"] = time_interval($terms_agreement);
							// $layout = 1;
						}
						
						$accept_price = $row['accept_price'];
						if($accept_price != "0")
						{
							$waiting_for_seller = 1;
							$seller = 1;
							$accept_datetime = $row['accept_datetime'];
							$payment_deadline = strtotime($accept_datetime . ' + 14 days');
							$terms_payment = Array($published, $payment_deadline);
							$time_interval["_payment"] = time_interval($terms_payment);
						}
						else {
							$waiting_for_seller = 0;
							$seller = 0;
						}
						
						$pay_amount = $row['pay_amount'];
						$pay_datetime = $row['pay_datetime'];
						if($pay_amount != "0" && $pay_datetime != "0000-00-00 00:00:00")
						{
							$waiting_for_pay = 1;
							$delivery = 1;
							
							$delivery_deadline = strtotime($pay_datetime. ' + 14 days');
							$terms_delivery = Array($published, $delivery_deadline);
							$time_interval["_delivery"] = time_interval($terms_delivery);
						}
						else {
							$waiting_for_pay = 0;
							$delivery = 0;
						}
											
						$delivery_datetime = $row['delivery_datetime'];
						if($delivery_datetime != "0000-00-00 00:00:00")
						{
							$waiting_for_delivery = 1;
							$arrive_deadline = strtotime($delivery_datetime . ' + 14 days');
							$terms_arrive = Array($published, $arrive_deadline);
							$time_interval["_arrive"] = time_interval($terms_arrive);
							
						}
						else {
							$waiting_for_delivery = 0;
						}
						
						$feedback = $row['feedback'];
						if($feedback != "0")
						{
							$waiting_for_feedback = 1;
							$feedback = 1;
							$feedback_datetime = $row['feedback_datetime'];
							$ror_deadline = strtotime($feedback_datetime . ' + 14 days'); // rights_of_return
							$terms_ror = Array($published, $ror_deadline);
							$time_interval["_ror"] = time_interval($terms_ror);
							$done = 1;
						}
						else {
							$feedback = 0;
							$waiting_for_feedback = 0;
							$done = 0;
						}
				
				/*$deadline = date('Y-m-d  H:i:s',strtotime($suggestion_datetime . ' + 14 days'));
				$pub_mysqldate = date( 'Y-m-d H:i:s', $published);
				$deadline_sqldate = $pub_mysqldate->modify('+14 day');
				$deadline = strtotime($deadline_sqldate);*/		
				
				
				/*$time_interval["_agreement"] = time_interval($terms_agreement);
				$time_interval["_payment"] = time_interval($terms_payment);
				$time_interval["_delivery"] = time_interval($terms_delivery);
				$time_interval["_arrive"] = time_interval($terms_arrive);
				$time_interval["_ror"] = time_interval($terms_ror);*/
				
				$view .= "<h1 class=\"popup_header\"><input type=\"button\" value=\"Connection\" onclick=\"\" style=\"margin-top: 5px;\"/><center style=\"margin-top: -30px;\">Market Scouting for $manufacturer $model <!-- (Connections by USB)--></center></h1>";		
				$view .= "\r\n";
				$view .= "[Delete this]";
				$view .= "\r\n";
				//$status["Accept"] = "Seller is accept you as official buyer. Pay -- It's that! <input type=\"button\" value=\"Buy\" onclick=\"\"> ";
				//$status_accept = "Seller is accept you as official buyer. Pay -- It's that! [<a href=\"javacript:void(0);\">This seller has X compatible stuff</a>] <input type=\"button\" value=\"Buy\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'pay');\"> ";
				if($waiting_for_pay == 1){$disabled = "disabled=\"true\"";$payment_message="&#10004; Completed Successfully";}
				else{$disabled = "";$payment_message="Let's Pay";}
				$status_accept = "<div style=\"border-top:1px solid;border-bottom:1px solid;overflow:auto;background-color:Khaki;\"> Payment <label style=\"float:right;\"><input id=\"payment_button\" type=\"button\" value=\"$payment_message\" style=\"margin:15 5 15 0\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'pay');\" $disabled></label></div>";
				//$status["Accept"] = "Seller ";
				//print $status["Accept"];
				//print $s;

				
				$layout = 2;
				if($layout == 1)
				{
				$view .= "<div style=\"overflow:auto;\"><span><img src=\"upload/$default_picture\" style=\"width:50px;height:50px;float:left;\" /> $manufacturer $model  (hinta, ehdot)</span><input type=\"button\" value=\"&times; Cancel Reservation\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', 'abort');\" style=\"float: right;margin: 15 0;\" /></div><hr/>";
				$view .=($waiting_for_product) ?(($pay) ? (($layout) ? $status_accept : "In Progress") : "<div style=\"background-color:Khaki;\">Seller - Pending (7 days left)") : "<div style=\"background-color:lightgrey;\">Seller -</div>";
				$view .= "<hr/>";
				$status_pay = "Buyer has payed stuff and wait your response about delivery. <input type=\"button\" value=\"Begin Delivery\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'pay');\"> ";
				$view .=($waiting_for_seller) ?(($seller) ? (($layout) ? $status_pay : "In Progress") : "<div style=\"background-color:lightorange;\">Pay - Pending</div>") : "<div style=\"background-color:lightgrey;\">Pay -</div>";
				$view .= "<hr/>";
				$status_delivery = "Seller has sent stuff for you. Please wait a moment of delivery. <input type=\"button\" value=\"Check Delivery\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'delivery');\"> ";
				$view .=($waiting_for_pay) ?(($delivery) ? (($layout) ? $status_delivery : "In Progress") : "<div style=\"background-color:lightorange;\">Delivery - Pending") : "<div style=\"background-color:lightgrey;\">Delivery -</div>";
				$view .= "<hr/>";
				$status_feedback = "Stuff is arrived near your home. The last activity is feedback. <input type=\"button\" value=\"Give Feedback\" onclick=\"\"> ";
				$view .=($waiting_for_delivery) ?(($feedback) ? (($layout) ? $status_feedback : "In Progress") : "<div style=\"background-color:lightorange;\">Feedback - Pending") : "<div style=\"background-color:lightgrey;\">Feedback -</div>";
				$view .= "<hr/>";
				$status_done = "This exchange is archived. [<a href=\"javacript:void(0);\">You have X compatible stuff</a>] [<a href=\"javacript:void(0);\">Founded X compatible stuff to new scouting</a>] <input type=\"button\" value=\"Browse archives\" onclick=\"\"> <input type=\"button\" value=\"Continue other exchanges\" onclick=\"\"> <input type=\"button\" value=\"Return stuff.\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'right_of_return');\">";
				$view .=($waiting_for_feedback) ?(($done) ? (($layout) ? $status_done : "In Progress") : "<div style=\"background-color:lightorange;\">Done - Pending") : "<div style=\"background-color:lightgrey;\">Done -</div>";
				$view .= "<hr/>";
				}
				elseif($layout == 2)
				{
				$view .= "<div style=\"overflow:auto;\"><div style=\"width:400px;float:left;\"><img src=\"upload/$default_picture\" style=\"width:75px;height:75px;float:left;\" /> $manufacturer $model with(hinta, ehdot)<br/>";
				$view .= "<a href=\"javascript:void(0);\"><img src=\"\" style=\"width:50px;height:50px;\" /></a>";
				$view .= "<a href=\"javascript:void(0);\"><img src=\"\" style=\"width:50px;height:50px;\" /></a>";
				$view .= "<a href=\"javascript:void(0);\"><img src=\"\" style=\"width:50px;height:50px;\" /></a>";
				$view .= "</div><input type=\"button\" value=\"&times; Cancel Reservation\" onclick=\"market_scout('$profile_id', '$this_product_id', '$name', 'abort');\" style=\"float: right;margin: 25 5 25 0;\" /></div>";
				//$view .="<hr/>";
				$view .=($waiting_for_product) ?
							(($pay) ? (($layout) ? $status_accept : "In Progress") : 
							"<div style=\"border-top:1px solid;border-bottom:1px solid;overflow:auto;background-color:Khaki;\" onmousemove=\"mysql_timer();\"> Payment <label style=\"float:right;\"><input id=\"payment_button\" type=\"button\" value=\"Pending seller\" disabled=\"true\" style=\"margin:15 5 0 0\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'pay');><br/><span id=\"timeleft_timer_$suggestion_datetime\" class=\"payment_button\" title=\"$suggestion_datetime\">".$time_interval["_agreement"]."</span></label></div>") : "<div style=\"background-color:lightgrey;\">Seller -</div>";
				//$view .= "<div style=\"border-bottom:1px solid;overflow:auto;\">";
				//$status_done = "Introduction <label style=\"float:right;\"><input type=\"button\" value=\"Pending delivery (7d left)\" disabled=\"true\" style=\"margin:15 5 15 0\"></label>";
				$status_done = "<div style=\"border-bottom:1px solid;overflow:auto;background-color:lightorange;height:80px;padding: 5% 0 0 0;\">Introduction. It seems like this product's <a href=\"\">catalog</a> has something interesting to show, and it is also possible to  <input type=\"button\" value=\"re-sell\"> this stuff.<label style=\"float:right;\"><input type=\"button\" value=\"&#10004; Completed Successfully\" disabled=\"true\" style=\"margin: 0 5 0 0;\"></label><br/></div>";
				//$view .=($waiting_for_feedback) ?(($done) ? (($layout) ? $status_done : "In Progress") : "<div style=\"background-color:lightorange;\">Done - Pending") : "<div style=\"background-color:lightgrey;\">Done -</div>";
				/*$view .= ($waiting_for_pay) ?
							(($done) ?	(
											($layout) ? $status_done : "In Progress") : 
											"<div style=\"background-color:lightorange;\">Pending Pay") : 
								"<div style=\"background-color:lightgrey;\">Pending, Pay Pending</div>";
						($waiting_for_feedback) ?
							(($done) ? (($layout) ? $status_done : "In Progress") : 
								"<div style=\"background-color:lightorange;\">Done - Pending") : 
								"<div style=\"background-color:lightgrey;\">Done - B</div>";*/
				if($waiting_for_delivery == 1){$d_disabled = "";$delivery_message="Check delivery status";$arrive_status="<input id=\"arrive_button\" type=\"button\" value=\"Arrival &amp; Update immersion indicator\" style=\"margin:15 5 0 0\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'feedback');\" $d_disabled>";}
				else{$d_disabled = "disabled=\"true\"";$delivery_message="Pending delivery";}			
				$view .= ($waiting_for_pay) ?
							(($done) ? (($layout) ? $status_done : "In Progress") : 
								"<div style=\"border-bottom:1px solid;overflow:auto;background-color:lightorange;height:80px;padding: 5% 0 0 0;\">Pending Delivery <label style=\"float:right;\"><input id=\"delivery_button\" type=\"button\" value=\"$delivery_message\" style=\"margin:15 5 0 0\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'pay');\" $d_disabled>$arrive_status<br/>".$time_interval["_delivery"]."</label></div>") : 
								"<div style=\"border-bottom:1px solid;overflow:auto;background-color:lightgrey;height:80px;padding: 5% 0 0 0;text-align:center;\">Pending begin after Payment</div>";
				//$view .= $status_done;
				///$view .= "</div>";
				}
				
			}
			print $view;
		}
	}
	if($market_scout_type == "monitor")
	{
	function time_interval($terms){
					// http://stackoverflow.com/questions/136782/format-mysql-datetime-with-php
					// http://www.richardlord.net/blog/dates-in-php-and-mysql
					// http://php.net/manual/en/datetime.diff.php
					// http://php.net/manual/en/datetime.gettimestamp.php
					// http://stackoverflow.com/questions/3727615/adding-days-to-date-in-php
					$now = new DateTime();
						if(empty($terms[1]))
						{
							$time_difference = date_timestamp_get($now)-$terms[0];
							if($time_difference>0)
							{
								if(floor($time_difference/(60*60*24*30*12))>1)
								{
									$ti = floor($time_difference/(60*60*24*30*12))." years";
								}
								elseif(floor($time_difference/(60*60*24*30*12))>0)
								{
									$ti = floor($time_difference/(60*60*30*12))." year";
								}
								elseif(floor($time_difference/(60*60*24*30))>1)
								{
									$ti = floor($time_difference/(60*60*24*30))." months";
								}
								elseif(floor($time_difference/(60*60*24*30))>0)
								{
									$ti = floor($time_difference/(60*60*30))." month";
								}
								elseif(floor($time_difference/(60*60*24))>1)
								{
									$ti = floor($time_difference/(60*60*24))." days";
								}
								elseif(floor($time_difference/(60*60*24))>0)
								{
									$ti = floor($time_difference/(60*60*24))." day";
								}
								elseif(floor($time_difference/(60*60))>1)
								{
									$ti = floor($time_difference/(60*60))." hours";
								}
								elseif(floor($time_difference/(60*60))>0)
								{
									$ti = floor($time_difference/(60*60))." hour";
								}
								elseif(floor($time_difference/(60))>1)
								{
									$ti = floor($time_difference/(60))." minutes";
								}
								elseif(floor($time_difference/(60))>0)
								{
									$ti = floor($time_difference/(60))." minute";
								}
								elseif(floor($time_difference)>1)
								{
									$ti = floor($time_difference)." seconds";
								}
								elseif(floor($time_difference)>0)
								{
									$ti = floor($time_difference)." second";
								}
								$ti .= " ago";
							}
							else
							{
								$ti = "a moment ago";
							}
						}
					elseif(!empty($terms[1]))
						{
							$time_difference = $terms[1]-date_timestamp_get($now);
							if($time_difference>0)
							{
								if(floor($time_difference/(60*60*24*30*12))>1)
								{
									$ti = floor($time_difference/(60*60*24*30*12))." years";
								}
								elseif(floor($time_difference/(60*60*24*30*12))>0)
								{
									$ti = floor($time_difference/(60*60*30*12))." year";
								}
								elseif(floor($time_difference/(60*60*24*30))>1)
								{
									$ti = floor($time_difference/(60*60*24*30))." months";
								}
								elseif(floor($time_difference/(60*60*24*30))>0)
								{
									$ti = floor($time_difference/(60*60*30))." month";
								}
								elseif(floor($time_difference/(60*60*24))>1)
								{
									$ti = floor($time_difference/(60*60*24))." days";
								}
								elseif(floor($time_difference/(60*60*24))>0)
								{
									$ti = floor($time_difference/(60*60*24))." day";
								}
								elseif(floor($time_difference/(60*60))>1)
								{
									$ti = floor($time_difference/(60*60))." hours";
								}
								elseif(floor($time_difference/(60*60))>0)
								{
									$ti = floor($time_difference/(60*60))." hour";
								}
								elseif(floor($time_difference/(60))>1)
								{
									$ti = floor($time_difference/(60))." minutes";
								}
								elseif(floor($time_difference/(60))>0)
								{
									$ti = floor($time_difference/(60))." minute";
								}
								elseif(floor($time_difference)>1)
								{
									$ti = floor($time_difference)." seconds";
								}
								elseif(floor($time_difference)>0)
								{
									$ti = floor($time_difference)." second";
								}
								$ti .= " left";
							}
							else
							{
								$ti = "the_end";
							}
						}
					return $ti;
				}
		
		
		
		$product_id = $_GET['product_id'];
		$session_profile_id = $_SESSION["stuffwalk_profile"];
		$exchange_info = "";
		if(empty($product_id))
		{
			$query = 	"SELECT p.idprofile1, t.idproduct1, t.publish_time, t.buyer_id, t.suggest_datetime, t.accept_price, t.accept_datetime,
					t.pay_amount, t.pay_datetime, t.delivery_datetime, t.feedback, t.feedback_datetime
					FROM market_scouting t, profile p
					WHERE p.idprofile1='$session_profile_id'
					and (t.idproduct1=p.data_object or t.buyer_id='$session_profile_id')
					and p.data_value='owner'
					ORDER BY p.datetime DESC";
					/*
					 WHERE p.idprofile1='$session_profile_id'
					and (t.idproduct1=p.data_object or t.buyer_id='$session_profile_id')
					and p.data_value='owner'
					ORDER BY p.datetime DESC";
					 */
		}
		elseif(!empty($product_id))
		{
			$query = 	"SELECT p.idprofile1, t.idproduct1, t.publish_time, t.buyer_id, t.suggest_datetime, t.accept_price, t.accept_datetime,
					t.pay_amount, t.pay_datetime, t.delivery_datetime, t.feedback, t.feedback_datetime
					FROM market_scouting t, profile p
					WHERE t.idproduct1='$product_id'
					and t.idproduct1=p.data_object
					and p.data_value='owner'
					ORDER BY p.datetime DESC LIMIT 1";
		}
		
		$result = mysql_query($query);
		$num = mysql_num_rows($result);
		if ($num > 0)
		{
			$exchange_info .= ($num > 1)?"Exchanges ($num):<br/>":"$num Exchange:<br/>";
			/*
			 * WebOS:n vasempaan linkkilistaan saadaan lukemat tällä tavoin kuhunkin ryhmään
			 * http://www.w3schools.com/sql/sql_func_count.asp
			 * SELECT COUNT(idproduct1) AS Incomplete FROM market_scouting
			 * WHERE feedback_datetime='0'
			 * muuttuvien, ei vakiona olevien listojen lisäys tapahtuu queryyn lisämällä ne muotoon
			 * count(joku) AS nimitys_luvulle
			 */
			/*
			 $query = " SELECT  count(incomplete.idproduct1) as inComplete, 
			 					count(complete.idproduct1) as complete
			 					count(income.idproduct1) as income
			 					count(outcome.idproduct1) as outcome
			 			FROM 	market_scouting incomplete, 
			 					market_scouting complete,
			 					market_scouting income,
			 					market_scouting outcome
			 			WHERE 	incomplete.feedback_datetime='0000-00-00 00:00:00'
			 			and 	complete.feedback_datetime!='0000-00-00 00:00:00'
			 			and		income.buyer='$session_profile_id'";
			 */

			while($row = mysql_fetch_assoc($result))
			{
				unset($product_owner_id);
				$market_product_id = $row['idproduct1'];
				$product_owner_id = $row['idprofile1'];
				$publish_datetime = $row['publish_time'];
				$buyer_id = $row['buyer_id'];
				$suggest_datetime = $row['suggest_datetime'];
				$accept_price = $row['accept_price'];
				$accept_datetime = $row['accept_datetime'];
				$pay_amount = $row['pay_amount'];
				$pay_datetime = $row['pay_datetime'];
				$delivery_datetime = $row['delivery_datetime'];
				$feedback = $row['feedback'];
				$feedback_datetime = $row['feedback_datetime'];
				
				$published = strtotime($publish_datetime);
				$agreement_deadline = strtotime($publish_datetime . ' + 14 days');
				$payment_deadline = strtotime($accept_datetime . ' + 14 days');
				$delivery_deadline = strtotime($pay_datetime. ' + 14 days');
				$arrive_deadline = strtotime($delivery_datetime . ' + 14 days');
				$ror_deadline = strtotime($feedback_datetime . ' + 14 days'); // rights_of_return
				$terms_agreement = Array($published, $agreement_deadline);
				$terms_payment = Array($published, $payment_deadline);
				$terms_delivery = Array($published, $delivery_deadline);
				$terms_arrive = Array($published, $arrive_deadline);
				$terms_ror = Array($published, $ror_deadline);
				$time_interval["_agreement"] = time_interval($terms_agreement);
				$time_interval["_payment"] = time_interval($terms_payment);
				$time_interval["_delivery"] = time_interval($terms_delivery);
				$time_interval["_arrive"] = time_interval($terms_arrive);
				$time_interval["_ror"] = time_interval($terms_ror);
				
				if($_SESSION["stuffwalk_profile"] == $buyer_id)
				{ // aspect of buyer
					// message for both of exchangers
					if (!empty($feedback) && !empty($feedback_datetime) && $feedback != "0")
					{
						//$exchange_info .="Exchange done - This stuff is compatible with... <input type=\"button\" value=\"See All\" onClick=\"\"><br/>";
						//$exchange_info .="Exchange done - You have enough or more money for ... and you can still sell following stuff. <input type=\"button\" value=\"See All\" onClick=\"\"><br/>";
						$exchange_info .="Exchange done ($market_product_id) - Buyer has right of return (".$time_interval["_ror"].") <input type=\"button\" value=\"Call stuff back &amp; return money\" onclick=\"market_scout('$profile_id', '$this_product_id', '', 'right_of_return');\"><br/>";
					}
					// message for buyer
					elseif (!empty($delivery_datetime) && $delivery_datetime != "0000-00-00 00:00:00")
					{
						$exchange_info .="Delivery began (product_id) - Estimated at most ".$time_interval["_arrive"]." to arrival. <input type=\"button\" value=\"Check Delivery\" onClick=\"\"> <input type=\"button\" value=\"Arrival & Update Immersion Indicator\" onClick=\"market_scout('$profile_id', '$product_id','', 'feedback');\"><br/>";
					}
					// message for seller
					elseif (!empty($pay_amount) && !empty($pay_datetime) && $pay_amount != "0")
					{
						// $exchange_info .="Buyer payment done - Please begin delivery. <input type=\"button\" value=\"Begin delivery\" onClick=\"market_scout('$profile_id', '$product_id','', 'delivery');\"> or <input type=\"button\" value=\"Return Payment\" onClick=\"\"><br/>";
						$exchange_info .="Your payment is done, seller has ".$time_interval["_delivery"]." to send packet - <input type=\"button\" value=\"Abort & Call Payment Back\" onClick=\"\"><br/>";
					}
					// message for buyer
					elseif (!empty($accept_price) && !empty($accept_datetime) && $accept_price != "0")
					{
						$exchange_info .="Exchange agreed - Delivery will start after your payment. <input type=\"button\" value=\"Begin Payment\" onClick=\"market_scout('$profile_id', '$product_id','', 'pay');\"><br/>";
					}
					// message for seller
					elseif (!empty($buyer_id) && !empty($publish_time))
					{
						$exchange_info .="Exchange activated - X buyers (7 days left) <input type=\"button\" value=\"Let's exchange\" onClick=\"market_scout('$profile_id', '$product_id','', 'accept');\"><br/>";
					}
				}
				elseif($_SESSION["stuffwalk_profile"] == $product_owner_id)
				{ // aspect of seller
					// message for both of exchangers
					if (!empty($feedback) && !empty($feedback_datetime) && $feedback != "0")
					{
						//$exchange_info .="Exchange done - This stuff is compatible with... <input type=\"button\" value=\"See All\" onClick=\"\"><br/>";
						//$exchange_info .="Exchange done - You have enough or more money for ... and you can still sell following stuff. <input type=\"button\" value=\"See All\" onClick=\"\"><br/>";
						$exchange_info .="Exchange done - Buyer has right of return (".$time_interval["_ror"].") <input type=\"button\" value=\"Call stuff back &amp; return money\" onclick=\"market_scout('$profile_id', '$market_product_id', '', 'right_of_return');\"><br/>";
					}
					// message for buyer
					elseif (!empty($delivery_datetime) && $delivery_datetime != "0000-00-00 00:00:00")
					{
						$exchange_info .="Your stuff has been sent - Please wait a delivery time. <input type=\"button\" value=\"Check Delivery\" onClick=\"\"> <input type=\"button\" value=\"Give feedback\" onClick=\"market_scout('$profile_id', '$product_id','', 'feedback');\"><br/>";
					}
					// message for seller
					elseif (!empty($pay_amount) && !empty($pay_datetime) && $pay_amount != "0")
					{
						$exchange_info .="Buyer payment done - Please, <input type=\"button\" value=\"Begin delivery\" onClick=\"market_scout('$profile_id', '$market_product_id','', 'delivery');\"> or <input type=\"button\" value=\"Abort, Return Payment\" onClick=\"\"><br/>";
					}
					// message for buyer
					elseif (!empty($accept_price) && !empty($accept_datetime) && $accept_price != "0")
					{
						$exchange_info .="Exchange activated - Waiting buyer's payment action. <input type=\"button\" value=\"Abort exchange\" onClick=\"market_scout('$profile_id', '$product_id','', 'accept');\"><br/>";
					}
					// message for seller
					elseif (!empty($buyer_id) && !empty($publish_datetime))
					{
						$exchange_info .=" Wanted - $market_product_id buyers (".$time_interval["_agreement"].") <input type=\"button\" value=\"Let's exchange\" onClick=\"market_scout('$session_profile_id', '$market_product_id','', 'accept');\"><br/>";
					}
					
				}
			}
			print $exchange_info;
		}
		else 
		{
			$exchange_info .="No queries";
			print $exchange_info;
		}
	}
	
}

if(isset($_GET['modify_modal_window_direction']))
{
	$parent_product_id=$_GET['modify_modal_window_parent_product'];
	$product_id=$_GET['&modify_modal_window_product'];
	$direction=$_GET['&modify_modal_window_direction'];
	
}

if(isset($_GET['trade_agreement_view']) && isset($_GET['profile_id']))
{
	$view = $_GET['trade_agreement_view'];
	$profile_id = $_GET['profile_id'];
	trade_agreement_view($profile_id, $view);
}

function trade_agreement_view($profile_id, $view)
{	
	$trade_agreement_collection = Array("trade_agreement_valid_status_accept_intro_buyer",
										"trade_agreement_valid_status_a_prospective_purchaser",
										// "trade_agreement_valid_status_accept_buyer",
										"trade_agreement_valid_status_confirm_payment",
										"trade_agreement_valid_status_confirm_transfer",
										"trade_agreement_valid_status_confirm_receiving", 
										"trade_agreement_valid_status_confirm_grade");
	$collection_num = count($trade_agreement_collection);
	for($a = 0; $a < $collection_num; $a++)
	{
		if($view == current($trade_agreement_collection))
		{
			$next_view = next($trade_agreement_collection);
		}
		else
		{
			next($trade_agreement_collection);
		}
	}
	$query = "SELECT * FROM trade_agreement WHERE `data_name`='$view' AND `idprofile1`='$profile_id'";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	$trade_agreement_list_content = Array();
	for($i = 0; $i < $num; $i++)
	{
		// $seller_id = mysql_result($result,$i,"idprofile1");
		$time = mysql_result($result,$i,"datetime");
		$seller_id = mysql_result($result,$i,"data_value");
		$object_id = mysql_result($result,$i,"data_object");
		$trade_agreement_list_content[$time][$seller_id] = $object_id;
	}
	$notification = "";
	foreach($trade_agreement_list_content as $time => $array)
	{
		$notification .= "<div class=\"\" style=\"height: 50px; border-bottom: 1px solid; padding: 5px;\">";
		foreach($array as $seller_id => $object_id)
		{
			// $notification .= "<img src=\"\" style=\"width: 50px; height: 50px;  float: left;\">";
			$object_query="SELECT * FROM `product_info` WHERE `idproduct1` LIKE '$object_id'";
			$object_result=mysql_query($object_query);
			
			while ($row = mysql_fetch_assoc($object_result)) {
						$manufacturer = $row['manufacturer'];
						$model = $row['model'];
						$default_picture = $row['default_picture'];
						$t = "$manufacturer $model";
			}
			$notification .= "<img src=\"upload/$default_picture\" style=\"width: 50px; height: 50px;  float: left;\">";
			$notification .= "<a href=\"object.php?id=$object_id\">";
			$notification .= $t;
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
			*/
			$notification .= "</a> ";
			$notification .= "<label style=\"float: right;\">";
			
			$profile_query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$seller_id'";
			$profile_result=mysql_query($profile_query);
			$profile_num=mysql_numrows($profile_result);			
			$profile_list = Array();
			$notification .= "<a href=\"profile.php?id=$seller_id\" title=\"";
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
			
			// $notification .= "\$view $view, \$next_view $next_view";
			
			
			if($view == $trade_agreement_collection[0]) // "trade_agreement_valid_status_accept_intro_buyer"
			{
				$notification .= "<a href=\"javascript:void(0);\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\">Siirry verkkopankkiin</a>";
			}
			if($view == $trade_agreement_collection[1]) // "trade_agreement_valid_status_accept_buyer"
			{
				$notification .= "\">Hyväksytty";
				$notification .= "</a></label><br/>";
				$notification .= "$time";
				$notification .= "<label style=\"float: right;\">";
				// $notification .= "<a href=\"javascript:void(0);\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\">Siirry verkkopankkiin</a>";
				$notification .= "<input type=\"button\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\" value=\"Siirry verkkopankkiin\" />";
			}
			if($view == $trade_agreement_collection[2]) // "trade_agreement_valid_status_confirm_payment"
			{
				$notification .= "\">Maksettu";
				$notification .= "</a></label><br/>";
				$notification .= "$time";
				$notification .= "<label style=\"float: right;\">";
				$notification .= "Lähetystunnus: <input type=\"text\" name=\"reference_number\"> ";
				// $notification .= "<a href=\"javascript:void(0);\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\">Vientiin</a>";
				$notification .= "<input type=\"button\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\" value=\"Vientiin\" />";
			}
			if($view == $trade_agreement_collection[3]) // "trade_agreement_valid_status_confirm_transfer"
			{
				$notification .= "\">Paketti lähetetty";
				$notification .= "</a></label><br/>";
				$notification .= "$time";
				$notification .= "<label style=\"float: right;\">";
				// $notification .= "<a href=\"javascript:void(0);\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\">Nouda postista</a>";
				$notification .= "<input type=\"button\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\" value=\"Nouda postista\" />";
			}
			if($view == $trade_agreement_collection[4]) // "trade_agreement_valid_status_confirm_receiving"
			{
				$notification .= "\">Saatavilla postissa";
				$notification .= "</a></label><br/>";
				$notification .= "$time";
				$notification .= "<label style=\"float: right;\">";
				$notification .= "Lähetystunnus: <input type=\"text\" name=\"reference_number\"> ";
				// $notification .= "<a href=\"javascript:void(0);\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\">Vahvista</a>";
				$notification .= "<input type=\"button\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\" value=\"Vahvista\" />";
			}
			if($view == $trade_agreement_collection[5]) // "trade_agreement_valid_status_confirm_grade"
			{
				$notification .= "\">Vastaanotettu";
				$notification .= "</a></label><br/>";
				$notification .= "$time";
				$notification .= "<label style=\"float: right;\">";
				// $notification .= "<a href=\"javascript:void(0);\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\" title=\"Toimeenpiteen jälkeen saat tuotehallinnan käyttöösi\">Arvioi tuote</a>";
				$notification .= "<input type=\"button\" onClick=\"confirm_event('$next_view','$seller_id','$profile_id','$object_id');\" title=\"Toimeenpiteen jälkeen saat tuotehallinnan käyttöösi\" value=\"Arvioi tuote\">";
			}
			$notification .= "</label>";
			$notification .= "</div>";
		}
	}
	print $notification;
}
if(isset($_GET['event_status']) && isset($_GET['buyer_id']) && isset($_GET['seller_id']) && isset($_GET['product_id']))
{
	$event_status = $_GET['event_status'];
	$buyer_id = $_GET['buyer_id'];
	$seller_id = $_GET['seller_id'];
	$product_id = $_GET['product_id'];
	confirm_event($event_status, $buyer_id, $seller_id, $product_id);
}

function confirm_event($event_status, $buyer_id, $seller_id, $product_id)
{	
	if($event_status == "trade_agreement_valid_status_accept_intro_buyer")
	{
		$query = "INSERT INTO trade_agreement VALUES ('$seller_id',NOW(),'trade_agreement_valid_status_accept_intro_buyer','$buyer_id','$product_id','','Public')";
		mysql_query($query);
		print "Message has been sent";
	}
	
	if($event_status == "trade_agreement_valid_status_accept_buyer")
	{
		$query = "INSERT INTO trade_agreement VALUES ('$seller_id',NOW(),'trade_agreement_valid_status_accept_buyer','$buyer_id','$product_id','','Public')";
		mysql_query($query);
		// $query = "UPDATE profile SET `data_name`='trade_agreement_ex_status_accept_intro_buyer' WHERE `data_name`='trade_agreement_valid_status_accept_intro_buyer' AND `idprofile1`='$seller_id' AND `data_value`='$buyer_id' AND `data_object`='$product_id'";
		// mysql_query($query);
		print "Message has been sent";
	}
	
	if($event_status == "trade_agreement_valid_status_confirm_payment")
	{
		$query = "INSERT INTO trade_agreement VALUES ('$buyer_id',NOW(),'trade_agreement_valid_status_confirm_payment','$seller_id','$product_id','','Public')";
		mysql_query($query);
		$query = "UPDATE profile SET `data_name`='trade_agreement_ex_status_accept_buyer' WHERE `data_name`='trade_agreement_valid_status_accept_buyer' AND `idprofile1`='$seller_id' AND `data_value`='$buyer_id' AND `data_object`='$product_id'";
		mysql_query($query);
		print "Message has been sent";
	}
	
	if($event_status == "trade_agreement_valid_status_confirm_transfer")
	{
		$query = "INSERT INTO trade_agreement VALUES ('$seller_id',NOW(),'trade_agreement_valid_status_confirm_transfer','$buyer_id','$product_id','','Public')";
		mysql_query($query);
		$query = "UPDATE profile SET `data_name`='trade_agreement_ex_status_confirm_payment' WHERE `data_name`='trade_agreement_valid_status_confirm_payment' AND `idprofile1`='$buyer_id' AND `data_value`='$seller_id' AND `data_object`='$product_id'";
		mysql_query($query);
		print "Message has been sent";
	}
	
	if($event_status == "trade_agreement_valid_status_confirm_receiving")
	{
		$query = "INSERT INTO trade_agreement VALUES ('$buyer_id',NOW(),'trade_agreement_valid_status_confirm_receiving','$seller_id','$product_id','','Public')";
		mysql_query($query);
		$query = "UPDATE profile SET `data_name`='trade_agreement_ex_status_confirm_transfer' WHERE `data_name`='trade_agreement_valid_status_confirm_transfer' AND `idprofile1`='$seller_id' AND `data_value`='$buyer_id' AND `data_object`='$product_id'";
		mysql_query($query);
		print "Message has been sent";
	}
	
	if($event_status == "trade_agreement_valid_status_confirm_grade")
	{
		$query = "INSERT INTO trade_agreement VALUES ('$buyer_id',NOW(),'trade_agreement_valid_status_confirm_grade','$seller_id','$product_id','','Public')";
		mysql_query($query);
		$query = "UPDATE trade_agreement SET `data_value`='ex-owner' WHERE `idprofile1`='$seller_id' AND `data_name`='product' AND `data_value`='owner' AND `data_object`='$product_id'";
		mysql_query($query);
		$query = "UPDATE trade_agreement SET `data_name`='trade_agreement_ex_status_confirm_receiving' WHERE `data_name`='trade_agreement_valid_status_confirm_receiving' AND `idprofile1`='$buyer_id' AND `data_value`='$seller_id' AND `data_object`='$product_id'";
		mysql_query($query);
		$query = "INSERT INTO trade_agreement VALUES ('$buyer_id',NOW(),'product','owner','$product_id','','Public')";
		mysql_query($query);
		print "Message has been sent";
	}
	
	if($event_status == "cancel_buyer")
	{
		$query = "DELETE FROM profile WHERE `idprofile1` LIKE '$seller_id' AND `data_name` LIKE 'accept_buyer' AND `data_value` LIKE '$buyer_id' AND `data_object` LIKE '$product_id'";
	}
	if($event_status == "block_buyer")
	{
		$query = "INSERT INTO profile VALUES ('$seller_id',NOW(),'block_profile','$buyer_id','','','Public')";
	}
}

if(isset($_GET['mode_status']) && isset($_GET['part_id']) && isset($_GET['product_id']) && isset($_GET['datetime']) && isset($_GET['manufacturer']) && isset($_GET['model']))
{
	$mode_status = $_GET['mode_status'];
	$part_id = $_GET['part_id'];
	$product_id = $_GET['product_id'];
	$datetime = $_GET['datetime'];
	$manufacturer = $_GET['manufacturer'];
	$model = $_GET['model'];
	add_as_part($mode_status, $part_id, $product_id, $datetime, $manufacturer, $model);
}

function add_as_part($mode_status, $part_id, $product_id, $datetime, $manufacturer, $model)
{
	if($mode_status == "add_as_part")
	{
		$query = "UPDATE product SET `data_object`='$product_id' WHERE `idproduct1`='$part_id' AND `data_name`='product_type'";
		
		$part  = "$mode_status";
		$part .= "\r\n";
		$part .= "$datetime";
		$part .= "\r\n";
		$part .= "$product_id";
		$part .= "\r\n";
		$part .= "$part_id";
		$part .= "\r\n";
		// $part .= "<a id=\"$datetime\" href=\"object.php?id=$part_id\" onClick=\"release_part('$product_id', '$part_id');\" style=\"width:76px;\"><img src=\"\" style=\"width: 75px; height: 75px;\" title=\"Release $manufacturer $model\"/></a>";
		$part .= "<img src=\"\" style=\"width: 45px; height: 45px;\" title=\"Release $manufacturer $model\"/>";
		$part .= "\r\n";
		$part .= "$manufacturer";
		$part .= "\r\n";
		$part .= "$model";
	
		print $part;
	}
	if($mode_status == "release_part")
	{
		$query = "UPDATE product SET `data_object`='' WHERE `idproduct1`='$part_id' AND `data_name`='product_type'";
		
		$part  = "$mode_status";
		$part .= "\r\n";
		$part .= "$datetime";
		$part .= "\r\n";
		$part .= "$product_id";
		$part .= "\r\n";
		$part .= "$part_id";
		$part .= "\r\n";
		// $part .= "<a id=\"$datetime\" href=\"object.php?id=$part_id\" onClick=\"release_part('$product_id', '$part_id');\" style=\"width:76px;\"><img src=\"\" style=\"width: 75px; height: 75px;\" title=\"Release $manufacturer $model\"/></a>";
		$part .= "<img src=\"\" style=\"width: 45px; height: 45px;\" title=\"Add $manufacturer $model\"/>";
		$part .= "\r\n";
		$part .= "<img src=\"\" style=\"width: 74px; height: 74px;\" title=\"Add $manufacturer $model\"/>";
		$part .= "\r\n";
		$part .= "$manufacturer";
		$part .= "\r\n";
		$part .= "$model";
	
		print $part;
	}

}
function product_details($product_id)
{
	// copypaste tänne se object.php-kohdan tuotetiedot, niin saadaan päivittyy tiedot automatik myös käyttäjän näkymään ilman erillistä refreshiä.
}

function interior_design_tool($move_from_storage, $move_to_storage, $profile_id)
{
// category
	
	/*
		katso mallia:
		* asunto
		http://www.nettiasunto.com/jamsa/53857
		* tontti
		http://www.nettiasunto.com/kauhajoki/53900
	*/

	$view  = "";
	//$query = "SELECT * FROM product WHERE `data_object`='$storage_id'";
	print "IDT -> from ". $move_from_storage . " to " . $move_to_storage . "<br/>";
	if("unseeded" != $move_to_storage)
	{
		$query = "SELECT * FROM product WHERE `idproduct1`='$move_to_storage'";
		//print $query;
	}
	else
	{
		$query = "SELECT * FROM product WHERE `idproduct1`='$move_from_storage'";
		//print $query;
	}
	//$view  .= "result: ".$query . "<br/>";
	$result=mysql_query($query);
	//$view  .= "result: ".$result . "<br/>";
	$num=mysql_numrows($result);
	//$view .= "num: $num<br/>";
	
	$room = mysql_result($result,0,"data_value");
	$room_id = mysql_result($result,0,"idproduct1");
	
	$query1 = "SELECT * FROM profile WHERE `idprofile1`='$profile_id' AND `data_name`='product' AND `data_value`='owner'";
	//$view  .= "result1: ".$query1 . "<br/>";
	$result1=mysql_query($query1);
	//$view  .= "result1: ".$result1 . "<br/>";
	$num1=mysql_numrows($result1);
	//$view  .= "num1: ".$num1 . "<br/>";
	$product_content = Array();
	$query2 = "SELECT * FROM product WHERE ";
	for($i = 0; $i < $num1; $i++)
	{
		//$product_id = mysql_result($result1,$i,"idprofile1");
		//$name = mysql_result($result1,$i,"data_name");
		//$value = mysql_result($result1,$i,"data_value");
		$object = mysql_result($result1,$i,"data_object");
		//$product_content[$i] = $object;
		$query2 .= "`idproduct1`='$object'";
		if($i+1 < $num1)
		{
			$query2 .= " OR ";
		}
	}
	
	// $view  .= "q: ".$query2 . "<br/>";
	$result2=mysql_query($query2);
	// $view  .= "result2: ".$result2 . "<br/>";
	$num2=mysql_numrows($result2);
	//$view  .= "num2: " . $num2 . "<br/>";
	$category_content = Array();
	for($i = 0; $i < $num2; $i++)
	{
		$id_product = mysql_result($result2,$i,"idproduct1");
		$name_product = mysql_result($result2,$i,"data_name");
		$value_product = mysql_result($result2,$i,"data_value");
		$object_product = mysql_result($result2,$i,"data_object");
		//$view .= "$name_product  == $value_product<br/>";
		if($name_product == "category" && $object_product == "")
		{ 
			$category = $value_product;
			$refer = "unseeded"; 
			//$view .= "category: $value_product";
		}
		if($name_product == "category" && $object_product != "")
		{ 
			$category = $value_product;
			$refer = $object_product;
		}
		
		$category_content[$refer][$category][$id_product][$name_product] = $value_product;
		//$category_content[$category][$id_product][$name_product] = $value_product;
		//$category_content[$id_product][$name_product] = $value_product;
		
	}
	//$unplaced = count($category_content);
	$unplaced  = "";
	$unplaced_items = "";
	$placed = "";
	$placed_items = "";
	
	// http://www.php.net/manual/en/function.strtr.php
	$trans = array("ö" => "&ouml;", "ä" => "&auml;", "Ö" => "&Ouml;", "Ä" => "&Auml;");
	
	/*
	
	kohteiden välillä vaihteluun tee joku komento move_to_storage('__id__') laatikoiden keskelle tms, klikkaamalla sitä
	päivitetään tavaroita varten koodit kohdalleen.
	
	tällä saa muutettua ristiin:
	if($placed_in == "unseeded") { $change_from_and_to}
	else { $do_nothing}
	*/
	foreach($category_content as $placed_in => $content)
	{
		// print "0: $placed_in => $content<br/>";
				
		if($placed_in == "unseeded")
		{
			if($move_to_storage == "unseeded")
			{
			$temp = $move_from_storage;
			$move_from_storage = $move_to_storage;
			$move_to_storage = $temp;
			}
			// for $unplaced_items
			foreach($content as $category => $product_content)
			{
				// print "1: $category => $product_content<br/>";
				$category = strtr($category, $trans);
				$unplaced_items .="<b><i>$category</i></b>";
				$d = count($product_content);
				$unplaced_items .=" ($d)";
				// http://fi2.php.net/manual/en/function.count.php
				$unplaced += $d;
				foreach($product_content as $product_id => $product_info)
				{
					// print "2: $product_id => $product_info<br/>";
					$desc = "";
					foreach($product_info as $content_name => $content_value)
					{
						// print "3: $content_name => $content_value<br/>";
						$content_value = strtr($content_value, $trans);
						if($content_name == "room") {$desc .= "$content_value ";}
						if($content_name == "manufacturer") {$desc .= "$content_value ";}
						if($content_name == "model") {$desc .= "$content_value ";}
					}
					
					//$unplaced_items .= "<li><a href=\"javascript:void(0);\" onClick=\"place_in('$product_id','$storage_id', '$profile_id');\">$desc</a></li>";
					//$unplaced_items .= "<li><a href=\"javascript:void(0);\" onClick=\"place_in('$move_from_storage','$move_to_storage', '$product_id', '$profile_id');\">$desc</a></li>";
					$unplaced_items .= "<li><a href=\"javascript:void(0);\" onClick=\"place_in('$move_from_storage','$move_to_storage', '$product_id', '$profile_id');\">$desc</a> ($move_from_storage # $move_to_storage # $product_id # $profile_id)</li>";
				}
			}
		}
		
		// if($placed_in == $storage_id)
		if($placed_in == $room_id)
		{
			// for $unplaced_items
			foreach($content as $category => $product_content)
			{
				// print "1: $category => $product_content<br/>";
				$category = strtr($category, $trans);
				$placed_items .="<b><i>$category</i></b>";
				$d = count($product_content);
				$placed_items .=" ($d)";
				// http://fi2.php.net/manual/en/function.count.php
				$placed += $d;
				foreach($product_content as $product_id => $product_info)
				{
					// print "2: $product_id => $product_info<br/>";
					$desc = "";
					foreach($product_info as $content_name => $content_value)
					{
						// print "3: $content_name => $content_value<br/>";
						$content_value = strtr($content_value, $trans);
						if($content_name == "room") {$desc .= "$content_value ";}
						if($content_name == "manufacturer") {$desc .= "$content_value ";}
						if($content_name == "model") {$desc .= "$content_value ";}
						
						$move_to_storage = "unseeded";
						$move_from_storage = $placed_in;
					}
					//$object = "unseeded_$storage_id";
					// $placed_items .= "<li><a href=\"javascript:void(0);\" onClick=\"place_in('$product_id','$object', '$profile_id');\">$desc</a> ($object) </li>";
					$placed_items .= "<li><a href=\"javascript:void(0);\" onClick=\"place_in('$move_from_storage', '$move_to_storage', '$product_id', '$profile_id');\">$desc</a>  ($move_from_storage # $move_to_storage # $product_id # $profile_id)</li>";
				}
			}
		}
	}
	if($placed == "") {$placed = "0";}
	if($unplaced == "") {$unplaced = "0";}
	/*
	foreach($category_content as $category => $id)
	{
		$category = strtr($category, $trans);
		$unplaced_items .="<b><i>$category</i></b>";
		//$desc .="$category";
		//print "1: $category => $id<br/>";
		$d = count($id);
		$unplaced_items .=" ($d)";
		// http://fi2.php.net/manual/en/function.count.php
		$unplaced += $d;
		foreach($id as $product_id => $value)
		{
			//print "2: $product_id => $value<br/>";
			$desc = "";
			foreach($value as $subkey => $subvalue)
			{
				//print "3: $subkey => $subvalue<br/>";
				$subvalue = strtr($subvalue, $trans);
				if($subkey == "room") {$desc .= "$subvalue ";}
				if($subkey == "manufacturer") {$desc .= "$subvalue ";}
				if($subkey == "model") {$desc .= "$subvalue ";}
			/*
			if($name == "specification") {$view .= "$value ";}
			*
			}
			$unplaced_items .= "<li><a href=\"javascript:void(0);\" onClick=\"place_in('$product_id','$storage_id');\">$desc</a></li>";
		}
	} */
		/*
		foreach($category_content as $id => $array)
		{
		//	$view .= "ID: $id => $array<br/>";
			
			foreach($array as $key => $value)
			{
			//	 $view .= "Data: $key => $value<br/>";
			
			if($key == "room") {$desc .= "$value ";}
			if($key == "manufacturer") {$desc .= "$value ";}
			if($key == "model") {$desc .= "$value ";}
			/*
			if($name == "specification") {$view .= "$value ";}
			*
			}
			$unplaced_items .= "<li><a href=\"javascript:void(0);\" onClick=\"place_in(\'$id\',\'$storage_id\');\">$desc</a></li>";
	
		}*/
	/*
	$category_content = Array();
	
	for($i = 0; $i < $num; $i++)
	{
		//$product_id = mysql_result($result,$i,"idprofile1");
		$name = mysql_result($result,$i,"data_name");
		$value = mysql_result($result,$i,"data_value");
		//$product_object = mysql_result($result,$i,"data_object");
		$category_content[$name] = $value;
		
	}
	foreach($category_content as $name => $value)
	{
		$view .= "$name => $value <br/>";
		/*
		if($name == "room") {$view .= "$value ";}
		if($name == "model") {$view .= "$value ";}
		if($name == "specification") {$view .= "$value ";}
		/
	}
	*/
	//output structure
	
	//$view .= "$storage_id";
	//$view .= "$storage_id";
	$view .= "<br/>";
	$view .= "<div id=\"\" style=\"border: 1px solid;width:200px;float: left;margin-left: 10px;\">Sijoittamatta ($unplaced)<br/>";
	$view .= "$unplaced_items";
	//$view .= "<i><b>Milj&ouml;&ouml;</b></i><br/>";
	//$view .= "<i><b>Taide</b></i><br/>";
	//$view .= "<i><b>Matkailu</b></i><br/>";
	$view .= "</div>";
	$view .= "<div id=\"\" style=\"border: 1px solid;width:200px;float: left;\">$room ($placed)<br/>";
	$view .= "$placed_items";
	//$view .= "<i><b>Milj&ouml;&ouml;</b></i><br/>";
	//$view .= "<i><b>Taide</b></i><br/>";
	//$view .= "<i><b>Matkailu</b></i><br/>";
	$view .= "</div>";
	
	print $view;
}
?>