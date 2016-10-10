<?php 

  session_start();
  
?>
<html>
<head>
<script type="text/javascript" src="dropdown_SS3.js"></script>
<script type="text/javascript" src="_dSf6-2x6.js"></script>
<!-- <script type="text/javascript">
$(function() {
	$("a").click(function() {
		alert("Hello world!");
	});
 });
</script>-->
<link rel="stylesheet" media="screen" type="text/css" href="daadaa.css">
<!--  korjaa dropdown -menu, kuten sample_attach-kohdat joka puolelta koodia (ei omaa koodia) :) -->
<style type="text/css">
<!--
.round_corner{
 -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    -moz-box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    box-shadow: -1px -1px 0 rgba(255,255,255,.4);
}

a.sample_attach, a.sample_attach:visited, div.sample_attach
{
  display: block;
  width:   100px;

  border:  1px solid black;
  padding: 2px 5px;

  text-decoration: none;
  font-family: Verdana, Sans-Sherif;
}
a.sample_attach:hover
{
	background-color: #c0c0c0;
	width:   140px;
}

a.sample_attach, a.sample_attach:visited, a.search_attach, a.search_attach:visited { border: none; }

div#sample_attach_menu_child, div#search_attach_menu_child
{
	border: 1px solid black;
	margin-top: -3px;
	margin-left: 0px;
	width: 350px;
	font: 12px Arial Black;
	background-color: #ffffff;
	
	-webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    -moz-box-shadow: -1px -1px 0 rgba(255,255,255,.4);
    box-shadow: -1px -1px 0 rgba(255,255,255,.4);
}
div#sample_attach_menu_child.subcontent
{
	border: 1px solid;
}
form.sample_attach
{
  position: absolute;
  visibility: hidden;

  border:  1px solid black;
  padding: 0px 5px 2px 5px;

  background: #FFFFEE;
}

form.sample_attach b
{
  font-family: Verdana, Sans-Sherif;
  font-weight: 900;
  font-size: 1.1em;
}

input.sample_attach { margin: 1px 0px; width: 170px; }


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
$id = $_GET['id'];

// $name = $_GET['name'];
// $lastname = $_GET['lastname'];
// $email = $_GET['email'];
// $password = $_GET['password'];


// $name = $_POST['name'];
// $lastname = $_POST['lastname'];
// $email = $_POST['email'];
// $password = $_POST['password'];



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
		
		if(!empty($_SESSION["stuffwalk_profile"]))
		{
			//print $_SESSION["profile"];
			$idprofile = $_SESSION["stuffwalk_profile"];
			//print $_SESSION["time"];
			if(!empty($_POST['a_prospective_purchaser']))
{
			$a_prospective_purchaser = $_POST['a_prospective_purchaser'];
			print $a_prospective_purchaser;
			$query = "INSERT INTO profile VALUES ('$idprofile', NOW(), 'a_prospective_purchaser', '','$id','0','Owner')";
			mysql_query($query);
}
		}
		else
		{
		$email = $_GET['email'];
		$password = $_GET['password'];
		
		$query="SELECT * FROM `profile` WHERE data_value LIKE '$email'"; // WHERE data-value='$email'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		$idprofile = mysql_result($result,0,"idprofile1");
		/* print "<br/>idprofile " . $idprofile . "<br/>"; */
		
		$query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'password'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		$mysql_password = mysql_result($result,0,"data_value");
		$_SESSION["profile"] = $idprofile;
		$_SESSION["time"]    = time();
		//print "password " . $mysql_password;
		//print ($mysql_password != $password) ? "Poistu!" :  "Oikeudet kunnossa!";
		}
		
		/*
		
			Session information
			
		*/

		$query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'firstname'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		$firstname = mysql_result($result,0,"data_value");

		$query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'lastname'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		$lastname = mysql_result($result,0,"data_value");
		
		$query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'product'";
		$result=mysql_query($query);
		$product_count = mysql_numrows($result);
		$product_left = 0;
		$idproduct = Array();
		while($product_left < $product_count)
		{
			array_push($idproduct, mysql_result($result,$product_left,"data_object"));
			$product_left++;
		}
		
		
print "<body onresize=\"startup_initial();\" onload=\"startup_initial('$idprofile', '$id','','');\" onmousemove=\"fire_guard('$idprofile', '$id')\">";
		
		//print_r($idproduct);
		
		//print $idproduct[0];
		/*
		
			Photo Uploader
		
		*/
		
		if(isset($_POST['photo_uploader']) && isset($_FILES["photo"]))
		{
		$photo_uploader_content = $_POST['photo_uploader'];
			/*
			foreach($photo_uploader_content as $n => $v)
			{
				print "$n => $v<br/>";
			}
			*/
			$product_id = $photo_uploader_content["product_id"];
			// $_FILES["picture"] = $photo_uploader_content["photo"];
			// $_FILES["photo"] = $photo;
			function int_multimedia_id($product_id)
			{
				$free = mysql_query("SELECT object_id FROM multimedia WHERE `use_of` LIKE 'Free' AND `idproduct1`='$product_id'");
				$size = mysql_num_rows($free);
				if($size == 0)
				{
				$result = mysql_query("SELECT * FROM multimedia WHERE `idproduct1`='$product_id'");
				$num_rows = mysql_num_rows($result);
				$num_rows += 10000000000000;
				return $information = Array("$num_rows", "New");
				}
				else
				{
					while ($row = mysql_fetch_assoc($free1)) {
					$idproduct = $row['idproduct1'];
					$confirmation = mysql_query("UPDATE multimedia SET `Use_of`='Reserved' WHERE `use_of` LIKE 'Free'");
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
			// if(isset($_FILES["photo"]) && $_FILES["photo"]["size"] > 0)
			if(isset($_FILES["photo"]) && $_FILES["photo"]["size"] > 0)
			{
				$object_id = int_multimedia_id($product_id);
				// print "\$object_id = $object_id<br/>";
				// print "result ". $object_id[0] . " " .  $object_id[1];
				
				$allowedExts = array("jpg","JPG", "jpeg", "gif", "png");
				// print  $_FILES["picture"]["name"] . "<br/>";
				// print  $_FILES["picture"]["type"] . "<br/>";
				// print  $_FILES["picture"]["size"] . "<br/>";
				// $extension = end(explode(".", $_FILES["picture"]["name"]));
				list($name , $extension) = explode(".", $_FILES["photo"]["name"]);
				// print $extension;
				if ((($_FILES["photo"]["type"] == "image/gif")
				|| ($_FILES["photo"]["type"] == "image/jpeg")
				|| ($_FILES["photo"]["type"] == "image/png")
				|| ($_FILES["photo"]["type"] == "image/pjpeg"))
				&& ($_FILES["photo"]["size"] < 1000000)
				&& in_array($extension, $allowedExts))
				  {
				  if ($_FILES["photo"]["error"] > 0)
					{
					echo "<b style=\"align:center;\">Kuvansiirto karkasi lapasesta (VahinkoilmoitusN:o " . $_FILES["file"]["error"] . "), yritähän uudelleen</b>>";
					}
				  else
					{
					// echo "Upload: " . $_FILES["file"]["name"] . "<br />";
					// echo "Type: " . $_FILES["file"]["type"] . "<br />";
					$use_of = "In_Use";
					$object_type = $_FILES["photo"]["type"];
					// echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
					$object_size = ($_FILES["photo"]["size"] / 1024);
					// echo "Temp file: " . $_FILES["picture"]["tmp_name"] . "<br />";

					// if (file_exists("upload/" . $_FILES["file"]["name"]))
					  // {
					  // echo $_FILES["file"]["name"] . " already exists. ";
					  // }
					// else
					  // {
					  move_uploaded_file($_FILES["photo"]["tmp_name"],
					  // "upload/" . $_FILES["file"]["name"]);
					  "upload/" . $product_id . "." . $object_id[0] . "." . strtolower($extension));
					  // echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
					  // }
					  $object_quality = "";
					  $description = "";
					  $album_name = "Default Album";
					  $default_picture = 1;
					  $geometry_location = "";
					  
						$image = "INSERT INTO multimedia VALUES ('$product_id',NOW(),'$use_of', '$object_id[0].$extension','$object_id[0]', '$object_type', '$object_size','$object_quality','$description','$album_name','$default_picture','$geometry_location')";
						mysql_query($image);
						if($default_picture == 1)
						{
						$default_picture = "UPDATE product_info SET `default_picture`='$product_id.$object_id[0].$extension' WHERE `idproduct1`='$product_id'";
						mysql_query($default_picture);
						// print $image;
						}
					}
				  }
				else
				{
					echo "Invalid file";
				}
			}
		}
		/*
		
			Tech Specs -update/create
		
		*/
		if(isset($_GET['techspecs']))
		{
			tech_specs_handler($_GET['techspecs']);
		}
		
		function tech_specs_handler($techspecs)
		{
			/*
			$handler_structure = Array("product","last_update","length", "width", "weight", "measurement", "engine_power_and_battery",
											"color","material","cellural_and_wireless_connection","in_the_box","environment","display",
											"audio", "headphones", "video", "camera_and_photos", "language_support", "mail_attachment_support",
											"connectors_and_input_output", "external_buttons_and_controls", "sensors", "wheel");
			*/
			/*
			$product = $techspecs["product"];
			$length = $techspecs["length"];*/
			/*
			if(mysql_num_rows(mysql_query("SELECT * FROM `product_technical_specification` WHERE `idproduct1`='$product'")) == 0)
			{
				$attributes = "";
				for($s=0;$s<count($handler_structure);$s++)
				{
					$attributes .= ",''";
				}
				
				mysql_query("INSERT INTO `product_technical_specification` values('$product',NOW(),'','','','','','','','','','','','','','','','','','','','','')");
			}
			else
			{
				$set_value = "";
				$i=0;
				foreach($techspecs as $attribute => $value)
				{
					$set_value .="`$attribute`='$value'";
					if($i+1 < count($techspecs)){$set_value .=", ";}
					$i++;
				}
				mysql_query("UPDATE `product_technical_specification` SET $set_value WHERE `idproduct1`='$product'");
			}*/
			$set_value = "";
			$i=0;
			$product = $techspecs["product"];
			$firsttime = $techspecs["firstime"];
			array_shift($techspecs);
			array_shift($techspecs);
			foreach($techspecs as $attribute => $value)
			{
				$set_value .="`$attribute`='$value'";
				if($i+1 < count($techspecs)){$set_value .=", ";}
				$i++;
			}
			print $set_value;
			mysql_query("UPDATE `product_info` SET $set_value WHERE `idproduct1`='$product'");
			
			// mysql_query("INSERT INTO `product_technical_specification` values('$product',NOW(),'$length','$width','$weight','$measurement','$engine','$color','$material','$cellural','$in_the_box','$environment','$display','$audio','$headphones','$video','$camera_and_photos','$language_support','$mail_attachment_support','$connectors','$external_buttons','$sensors','$wheel')");
		}
		
		/* product_unifying_factor - taulu */
		
		// $other_product_list = Array();
		$other_product_list = "";
		// $similar_product_list = Array();
		$similar_product_list = "";
		$manufacturer_list = "";
		$part_of_list = "";
		
		$factor_query="SELECT * FROM `product_info` WHERE `idproduct1` LIKE '$id'";
		$product_information =mysql_query($factor_query);
		
		while ($row = mysql_fetch_assoc($product_information)) {
				$present_product_id = $row['idproduct1'];
				$present_item = $row['item'];
				$present_manufacturer = $row['manufacturer'];
				$present_model = $row['model'];
				$present_specification = $row['specification'];
				$present_building = $row['building'];
				$present_room = $row['room'];
				$product_topic = "$present_manufacturer $present_model $present_specification";
				$part_of_list .= "<div class=\"thumbview\" style=\"height: 50px; border: 1px solid;\"><a href=\"storage.php?location=$present_building/$present_room\"><img src=\"\" style=\"height: 20px; width: 20px;float: left;\" />$present_building/$present_room</a></div>";
				
		}
		
		$other_manufacturers="SELECT idproduct1, manufacturer, model, specification, location FROM `product_info` WHERE `idproduct1` NOT LIKE '$id' AND `manufacturer` NOT LIKE '$present_manufacturer' AND `item` LIKE '$present_item'";
		$other_manufacturer_information =mysql_query($other_manufacturers);
		
		while ($row = mysql_fetch_assoc($other_manufacturer_information)) {
				$other_product_id = $row['idproduct1'];
				// tähän semmoinen security-tauluun yhdistys, missä tarkistetaan onko sallittua näyttää tavaraa
				$other_manufacturer = $row['manufacturer'];
				$other_model = $row['model'];
				$other_specification = $row['specification'];
				$other_location = $row['location'];
				$manufacturer_list .= "<div class=\"thumbview\" style=\"height: 50px; border: 1px solid;\"><a href=\"object.php?manufacturer=$other_manufacturer\"><img src=\"\" style=\"height: 20px; width: 20px;float: left;\" />$other_manufacturer</a></div>";
		}
		
		$manufacturer_and_other_models="SELECT idproduct1, manufacturer, model, specification, location FROM `product_unifying_factor` WHERE `idproduct1` NOT LIKE '$id' AND `manufacturer` LIKE '$present_manufacturer' AND `model` NOT LIKE '$present_model'";
		$other_product_information =mysql_query($manufacturer_and_other_models);
		
		while ($row = mysql_fetch_assoc($other_product_information)) {
				$other_models_product_id = $row['idproduct1'];
				// tähän semmoinen security-tauluun yhdistys, missä tarkistetaan onko sallittua näyttää tavaraa
				$other_models_manufacturer = $row['manufacturer'];
				$other_models_model = $row['model'];
				$other_models_specification = $row['specification'];
				$other_models_location = $row['location'];
				$other_product_list .= "<div class=\"thumbview\" style=\"height: 50px; border: 1px solid;\"><a href=\"showcase.php?product=$other_models_manufacturer!$other_models_model\"><img src=\"\" style=\"height: 20px; width: 20px;float: left;\" />$other_models_manufacturer $other_models_model $other_models_specification</a></div>";
		}
		
		$manufacturer_and_similar_models="SELECT idproduct1, manufacturer, model, specification, location FROM `product_unifying_factor` WHERE `idproduct1` NOT LIKE '$id' AND manufacturer LIKE '$present_manufacturer' AND `model` LIKE '$present_model'";
		$similar_product_information =mysql_query($manufacturer_and_similar_models);
		
		while ($row = mysql_fetch_assoc($similar_product_information)) {
				$similar_other_product_id = $row['idproduct1'];
				// tähän semmoinen security-tauluun yhdistys, missä tarkistetaan onko sallittua näyttää tavaraa
				$similar_manufacturer = $row['manufacturer'];
				$similar_model = $row['model'];
				$similar_specification = $row['specification'];
				$similar_location = $row['location'];
				$similar_product_list .= "<div class=\"thumbview\" style=\"height: 50px; border: 1px solid;\"><a href=\"showcase.php?product=$similar_manufacturer/$similar_model\"><img src=\"\" style=\"height: 20px; width: 20px;float: left;\" />$similar_manufacturer $similar_model $similar_specification</a></div>";
				
		}
		
		/*

		Product basic information

		*/
		
		// $widget = product_details($present_product_id, $idprofile, $product_topic);
		// list($product, $proprietor, $compatible_result, $compatible_query, $compatible_suggest) = $widget;
		
		$widget = present_product_facade($present_product_id, $idprofile, $product_topic);
		list($product, $link, $proprietor, $compatible_result, $compatible_query,$compatible_suggest, $table_of_content, $detail_widget, $compatible_goodies,$included_items) = $widget;
		
		function present_product_facade($product_id, $profile_id, $product_topic)
		{
			$js  = "<script type=\"text/javascript\">";
			$js .= "function add_data()";
			$js .= "{";
			$js .= "var c = document.getElementByClass();";
			$js .= "c.innerHTML=\"\"";
			$js .= "}";
			$js .= "</script>";
			$product_info = "";
			$idproduct = $product_id = $product_id;
			$link = "";
			$default_picture=mysql_query("SELECT object FROM `multimedia` WHERE `idproduct1`='$idproduct' AND `default_picture`='1'");
				while ($row = mysql_fetch_assoc($default_picture)) {
					$object_id = $row['object'];
					$link .= "upload/$idproduct.$object_id";
				}
			
			$basic_info=mysql_query("SELECT * FROM `product_info` WHERE `idproduct1` LIKE '$product_id'");
			while ($row = mysql_fetch_assoc($basic_info)) {
				$item = $row['item'];
				$created_stamp = $row['created_stamp'];
				$last_updated = $row['last_updated'];
				$manufacturer = $row['manufacturer'];
				$model = $row['model'];
				$specification = $row['specification'];
				$vintage_year = $row['vintage_year'];
				$made_in = $row['made_in'];
			}
			/*
			
			
			*/
			// $queryq="SELECT * FROM `trade_agreement` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'proprietor_status_change' AND `data_object` LIKE '$product_id'";
			$trade_agreement_info=mysql_query("SELECT * FROM `trade_agreement` WHERE `idprofile1` LIKE '$profile_id' AND `data_object` LIKE '$product_id'");
			$status = "";
			while ($row = mysql_fetch_assoc($trade_agreement_info)) {
				$profile_id = $row['idprofile1'];
				$data_name = $row['data_name'];
				if($data_name == "proprietor_status_change"){$status .= 1;}
			}
			// $num22=mysql_numrows($resultq);
			// print "proprietor result: $num22";
			$proprietor  = "";
			// if($num22 == "0")
			$trade_agreement=mysql_query("SELECT * FROM `trade_agreement` WHERE `data_object` LIKE '$product_id' AND `data_value` LIKE '$profile_id'");
			$purchaser_count = mysql_num_rows($trade_agreement);
			// $purchasers = Array();
			$purchasers = "";
			while ($row = mysql_fetch_assoc($trade_agreement)) {
				$strange_profile = $row['idprofile1'];
				$profile_info=mysql_query("SELECT data_name, data_value FROM `profile` WHERE `idprofile1` LIKE '$strange_profile'");
				$profile_name = "<div style=\"height:25px;border-bottom:1px solid;\"><a href=\"profile.php?id=$strange_profile\">";
					while ($row = mysql_fetch_assoc($profile_info)) {
					if($row['data_name'] == "firstname"){$profile_name .= $row['data_value'] . " ";}
					if($row['data_name'] == "lastname"){$profile_name .= $row['data_value'];}
					}
				$profile_name .= "</a><label style=\"float:right\"><input type=\"button\" value=\"Myy\" /></label></div>";
				$purchasers .= "$profile_name";
			}
			
			// foreach($purchasers as $key => $id)
			// {
				// $purchasers_list .= "<li>$id</li>";
			// }
			/*
			$trade_agreement_view  = "<h3 style=\"clear: left;\">Trade Agreement</h3>";
			$trade_agreement_view .= "<div class=\"round_corner\" style=\"width: 250px;border:2px inset;overflow:auto;float:left;margin: 5px;\"><h4>Who Wants Product</h4>";
			$trade_agreement_view .= "</div>";
			$trade_agreement_view .= "<div class=\"round_corner\" style=\"width: 250px;border:2px inset;overflow:auto;float:left;margin: 5px;\"><h4>Prospective Purchasers ($purchaser_count)</h4>";
			$trade_agreement_view .= "$purchasers</div>";
			$trade_agreement_view .= "<div class=\"round_corner\" style=\"width: 250px;border:2px inset;overflow:auto;float:left;margin: 5px;\"><h4>Suggestions for trade</h4>";
			$trade_agreement_view .= "</div>";
			*/
			$idprofile = $profile_id;
			if($status == "")
			{		
				// TARKISTETAAN onko jo myynnissä, ettei tuu duplicate -ilmoituksia.
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Olet omistaja\" text=\"Olet omistaja\" style=\"float: right;margin: 4 7 4 0;border-left: 1px solid;background-image:url('SS_design/button3_1.png');background-color:green;\">";
				$proprietor .= "<input type=\"image\" src=\"SS_design/button3_1.png\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Vikailmoitus\"  title=\"Report bug...\" style=\"float: right;margin: 4 0;border-left: 1px solid; \">";
				$proprietor .= "<input type=\"image\" src=\"SS_design/button3_1.png\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Vahinkoilmoitus\"  title=\"Report damage...\" style=\"float: right;margin: 4 0 4 7 \">";
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Muutosilmoitus\"  title=\"Report change notification...\" style=\"float: right;margin: 4 7; width:100; \">";
				$proprietor .= "<div id=\"sample_attach_menu_child\">";
				$proprietor .= "<div id=\"business_navigation\" style=\"border: 1px solid; width: 150px;float: left;\">";
				$proprietor .= "	<!--";
				$proprietor .= "	Tuote on ollut sinulla alkaen: pvm.<br/>";
				$proprietor .= "	Ostettu käytettynä yksityiskäyttäjältä / <br/>";
				$proprietor .= "	uutena / alennusmyynnistä kohteesta Gigantti.<br/>";
				$proprietor .= "	Tuotteen käyttöhistoriaa:<br/>";

				$proprietor .= "	<a class=\"sample_attach\" href=\"\">Katso lisää....</a>";
				$proprietor .= "	<br/>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:alert('Haltijat');\">Haltijat</a>";
				$proprietor .= "	<br/>-->";
				$proprietor .= "	<div class=\"subcontent\">";
				$proprietor .= "	<a class=\"sample_attach\"  href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'product','$product_id');\">$product_topic</a>";
				$proprietor .= "	Omistajan vaihto";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onclick=\"exchange_scouting_popup('$idprofile', '$product_id', '','initial_market_scouting','open');\">[X] Myyntiin...</a> <!-- market_scouting_popup(...)-->";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'sell','$product_id');\">Myyntiin...</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'change','$product_id');\">Vaihtoon...</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'give','$product_id');\">Anna ilmaiseksi...</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'donate','$product_id');\">Lahjoitetaan...</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'auction','$product_id');\">Huutokaupataan...</a>";
				$proprietor .= "	</div>";
			
				$proprietor .= "	<div class=\"subcontent\">";
				$proprietor .= "	Huollettavaksi";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','recycle','$product_id');\">Kierrätykseen...</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','warranty','$product_id');\">Takuuseen...</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','repair','$product_id');\">Huoltoon...</a><!-- Korjaukseen -->";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','reclamation','$product_id');\">Reklamoi...</a>";
				$proprietor .= "	</div>";
				
				$proprietor .= "	<div class=\"subcontent\">";
				$proprietor .= "	Live-tapahtumat";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','general_category','$product_id');\">Rompetori...</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','flea_market','$product_id');\">Kirpputori...</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','market','$product_id');\">Tori...</a>";
				$proprietor .= "	</div>";
				$proprietor .= "</div>";
				$proprietor .= "<div id=\"sale_options\">";
				//$proprietor .= "<form action=\"\" method=\"get\">";
				$proprietor .= "Tuoteinfoa<br/>";
				$proprietor .= "Ostettu {pvm}<br/>";
				$proprietor .= "600 muulla ihmisellä on sama tuote";
				//$proprietor .= "</form>";
				$proprietor .= "</div>";
				$proprietor .= "</div>";

				$proprietor .= "<script type=\"text/javascript\">";
				$proprietor .= "at_attach(\"sample_attach_menu_parent\", \"sample_attach_menu_child\", \"hover\", \"y\", \"pointer\");";
				$proprietor .= "</script>";
			}
			else
			{
				// http://answers.yahoo.com/question/index?qid=20100819144054AAutScN
				//	http://www.fileformat.info/info/unicode/char/2713/index.htm
				
			
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"&#x2713; Myynnissä\" style=\"float: right;margin: 4 7 4 0;background-color: lime; \">";
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Vika-/korjauspäivitys\" style=\"float: right;margin: 4 0 \">";
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Vahinkoilmoitus\" style=\"float: right;margin: 4 0 \">";
				$proprietor .= "<div id=\"sample_attach_menu_child\">";
				
				$proprietor .= "Product for sale since<br/><hr/>";
				$proprietor .= "Tapahtuman vaihto:";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'change','$product_id');\">Vaihtoon</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'give','$product_id');\">Anna ilmaiseksi</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'donate','$product_id');\">Lahjoitetaan</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'auction','$product_id');\">Huutokaupataan</a>";
				$proprietor .= "<hr/>Huollettavaksi:";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','recycle','$product_id');\">Kierrätykseen</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','warranty','$product_id');\">Takuuseen</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','repair','$product_id');\">Huoltoon</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','reclamation','$product_id');\">Reklamoi</a>";
				$proprietor .= "<hr/>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onClick=\"proprietor_status_price();\">Muuta hintaa</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onClick=\"update_proprietor_status('$idprofile','$product_id', 'cancel');\">En myykään</a>\r\n";
				$proprietor .= "</div>";
				$proprietor .= "<script type=\"text/javascript\">";
				$proprietor .= "at_attach(\"sample_attach_menu_parent\", \"sample_attach_menu_child\", \"hover\", \"y\", \"pointer\");";
				$proprietor .= "</script>";
			}
			$product_info .= $proprietor;
			
			/* new version of sorted catalog*/
			/*
			 	$field_result = mysql_query("SHOW COLUMNS FROM product_info");
			 	if (!$field_result) {
				    echo 'Could not run query: ' . mysql_error();
				    exit;
				}
				$columns = Array();
				if (mysql_num_rows($field_result) > 0) {
				    while ($row = mysql_fetch_assoc($field_result)) {
				        	array_push($columns, $row);// $row['Field']);
				    }
				}
				foreach( $columns as $je => $jo){	
					if($jo["Field"] != idproduct1 || $jo["Field"] != created_stamp || 
					$jo["Field"] != updated_stamp || $jo["Field"] != use_of || 
					$jo["Field"] != parent_product || $jo["Field"] != location || 
					$jo["Field"] != building || $jo["Field"] != room)
						$fields[] = $jo["Field"];	
				}
				
				$sel_q = "";$from_q = "";$where_q = "";
				foreach($fields as $property)
				{
					$sel_q .= "	, show_product_smaller.$property, show_product_large.$property";
					$from_q .= "	, show_product_smaller.$property, show_product_large.$property";
					$where_q .= "	, show_product_smaller.$property, show_product_large.$property";
				}
				$func_query  = "SELECT 	facade_product.*";
				$func_query .= "FROM 	product_info facade_product,";
										product_info showed_product_smaller,
										product_info showed_product_larger
								WHERE 	facade_product.idproduct1 LIKE '$product_id'"
				mysql_query($func_query);
			 */
			
			/* END new version of sorted catalog */
			
			// Product tech specs (if available)
			$technical_specification=mysql_query("SELECT * FROM `product_info` WHERE `idproduct1` LIKE '$product_id'");
			$tech_specs_count = mysql_num_rows($technical_specification);
			// $tech_specs_widget = "<h3>Technical Specification</h3>";
			// $tech_specs_widget = "<h1>Facade</h1>";
			$tech_specs_widget  = "<br/><br/><h1><a href=\"javascript:void(0);\" onClick=\"start_menu(this, 'product_empty_contain_viewer','view');\" title=\"Add info\"><img src=\"\" style=\"width:25px;height:25px;margin: 0 0 0 5;\" /></a> Veneer</h1>";
			// $tech_specs_widget .= "";
			if($tech_specs_count == 0)
			{
					$tech_specs_widget .= "<form method=\"GET\">";
					$tech_specs_widget .= "<div id=\"product_container\" style=\"float: left; margin: 10;\">";
					$tech_specs_widget .= "<input type=\"hidden\" name=\"id\" value=\"$product_id\">";
					$tech_specs_widget .= "<input type=\"hidden\" name=\"techspecs[firstime]\" value=\"yes\">";
					$tech_specs_widget .= "<input type=\"hidden\" name=\"techspecs[product]\" value=\"$product_id\">";
					$tech_specs_widget .= "<h4>Measurement</h4>";
					$tech_specs_widget .= "<li id=\"length\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('length');\">Add length</a></li>";
					$tech_specs_widget .= "<li id=\"width\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('width');\">Add width</a></li>";
					$tech_specs_widget .= "<li id=\"weight\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('weight');\">Add weight</a></li>";
					$tech_specs_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
					$tech_specs_widget .= "</div>";
					$tech_specs_widget .= "<div style=\"float: left; margin: 10;\">";
					$tech_specs_widget .= "<h4>Appearance</h4>";
					$tech_specs_widget .= "<li id=\"color\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('color');\">Add color</a></li>";
					$tech_specs_widget .= "<li id=\"material\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('material');\">Add material</a></li>";
					$tech_specs_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
					$tech_specs_widget .= "</div>";
					$tech_specs_widget .= "<div style=\"float: left; margin: 10;\">";
					$tech_specs_widget .= "<h4>Energy</h4>";
					$tech_specs_widget .= "<li id=\"motor\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('motor');\">Add motor</a></li>";
					$tech_specs_widget .= "<li id=\"transmission\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('transmission');\">Add transmission</a></li>";
					$tech_specs_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
					$tech_specs_widget .= "</div>";
					$tech_specs_widget .= "<div style=\"float: left; margin: 10;\">";
					$tech_specs_widget .= "<h4>Optional</h4><!--Additional information-->";
					$tech_specs_widget .= "<li id=\"display\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('display');\">Add display</a></li>";
					$tech_specs_widget .= "<li id=\"audio\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('audio');\">Add audio</a></li>";
					$tech_specs_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
					$tech_specs_widget .= "</div>";
					$tech_specs_widget .= "<div style=\"float: left; margin: 10;\">";
					$tech_specs_widget .= "<h4>Security</h4>";
					$tech_specs_widget .= "<li id=\"sn\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('sn');\">Add Serial number</a></li>";
					$tech_specs_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
					$tech_specs_widget .= "</div>";
					$tech_specs_widget .= "</form>";
			}
			else
			{

				$tech_specs_structure = Array("idproduct1","created_stamp","last_updated","use_of","item","manufacturer","model","specification","vintage_year","made_in","location","building","room","length","width","height","depth","weight","capacity","capacity_unit","diameter","skid_load","color","material","cellural","wireless_connection","in_the_box","environmental_status_report","integrated_display","integrated_audio", "integrated_headphones", "video", "camera","photos", "language_support", "mail_attachment_support","connectors","input_output", "external_buttons","external_controls", "sensors", "power","environmental_requirements","wheels","transmission","suspension","brake","serialnumber","motornumber","framenumber","default_picture","age_restriction");
				$specs_directory = Array();

				while ($row = mysql_fetch_assoc($technical_specification)) {
					for($i = 13; $i < count($tech_specs_structure);$i++)
					{
						$d = $tech_specs_structure[$i];
						// $key = $row['$d'];
						$key = $row[$d];
						if($key != "0" && $key != "")
						{
						$specs_directory[$d][$key] = $product_id;
						$specs_directory_product[$d][$key] = $product_id;
						}
					
					}
				}
				// print_r($specs_directory);
				// print count($specs_directory);
				foreach($specs_directory as $attr => $x)
				{
					// print "$attr => $x<br/>";
					foreach($x as $value => $product)
					{
						// print "$value => $product<br/>";
						// $specs_directory[$d][$key] = $product_id;
						$de_max = "SELECT idproduct1, $attr FROM `product_info` WHERE `$attr` > '$value' AND `$attr` != '0' ORDER BY $attr ASC LIMIT 2";
						// print $de_max . "<br/>";
						$detail_max=mysql_query($de_max);
						while ($row = mysql_fetch_assoc($detail_max)) {
							$another_product_id_more = $row['idproduct1'];
							$specs_more = $row[$attr];
							$specs_directory[$attr][$specs_more] = $another_product_id_more;
						}
						$de_min = "SELECT idproduct1, $attr FROM `product_info` WHERE `$attr` < '$value' AND `$attr` != '0' ORDER BY $attr DESC LIMIT 2";
						// print $de_min . "<br/>";
						$detail_min=mysql_query($de_min);
						while ($row = mysql_fetch_assoc($detail_min)) {
							$another_product_id_less = $row['idproduct1'];
							$specs_less = $row[$attr];
							$specs_directory[$attr][$specs_less] = $another_product_id_less;
						}
					}
				ksort($specs_directory[$attr]);
				}
						
						
				$this_product_id = $_GET['id'];
				
				// print_r($specs_directory);
				$tech_specs_widget .= "<form method=\"GET\">";
				$tech_specs_widget .= "<input type=\"hidden\" name=\"id\" value=\"$product_id\">";
				$tech_specs_widget .= "<input type=\"hidden\" name=\"techspecs[firstime]\" value=\"yes\">";
				$tech_specs_widget .= "<input type=\"hidden\" name=\"techspecs[product]\" value=\"$product_id\">";
				$s = 12;
				// foreach($specs_directory as  $value => $length)
				$measurement = "";
				$measurement_empty = "";
				$appearance = "";
				$appearance_empty = "";
				$energy = "";
				$energy_empty = "";
				$optional = "";
				$optional_empty = "";
				$security = "";				
				$security_empty = "";				
				$photos = "";				
				$photos_empty = "";
				$connector = "";				
				$connector_empty = "";
				$table_of_content = Array();
				for($tss=12;$tss < count($tech_specs_structure);$tss++)
				{
					// if($s == 0 || $s == 1) {}
					// else 
					// {
						$value = $tech_specs_structure[$s];
						// print "\"$value\"<br/>";
						$measurement_list["width"] = 0;
						$measurement_list["length"] = 0;
						$measurement_list["weight"] = 0;
						$measurement_list["height"] = 0;
						$measurement_list["depth"] = 0;
						$measurement_list["capacity"] = 0;
						$measurement_list["capacity_unit"] = 0;
						$measurement_list["diameter"] = 0;
						$measurement_list["skid_load"] = 0;
						$appearance_list["color"] = 0;
						$appearance_list["material"] = 0;
						$appearance_list["camera"] = 0;
						$appearance_list["video"] = 0;
						$appearance_list["integrated_headphones"] = 0;
						$appearance_list["integrated_display"] = 0;
						$appearance_list["integrated_audio"] = 0;
						$security_list["serialnumber"] = 0;
						$security_list["motornumber"] = 0;
						$security_list["framenumber"] = 0;
						$security_list["age_restriction"] = 0;
						$energy_list["suspension"] = 0;
						$energy_list["transmission"] = 0;
						$energy_list["wheels"] = 0;
						$energy_list["brake"] = 0;
						$energy_list["power"] = 0;
						$environment_list["temperature"] = 0;
						$environment_list["noise"] = 0;
						$connector_list["connectors"] = 0;
						$photo_list["default_picture"] = 0;
						// if($value == "width" || $value == "length" || $value == "weight" || $value == "height" || $value == "depth" || $value == "capacity" || $value == "capacity_unit")
						if(array_key_exists($value, $measurement_list))
						{
							$class = "measurement";
							$class_empty = "measurement_empty";
						}
						// elseif($value == "color" || $value == "material")
						elseif(array_key_exists($value, $appearance_list))
						{
							$class = "appearance";
							$class_empty = "appearance_empty";
						}
						// elseif($value == "motor" || $value == "wheel" || $value=="engine_power_and_battery")
						elseif(array_key_exists($value, $photo_list))
						{
							$class = "photos";
							$class_empty = "photos_empty";
						}
						elseif(array_key_exists($value, $energy_list))
						{
							$class = "energy";
							$class_empty = "energy_empty";
						}
						elseif($value == "display" || $value == "audio" || $value == "cellural_and_wireless_connection" || $value == "in_the_box" || $value == "environment")
						{
							$class = "optional";
							$class_empty = "optional_empty";
						}
						// elseif($value == "serial_number")
						elseif(array_key_exists($value, $security_list))
						{
							$class = "security";
							$class_empty = "security_empty";
						}
						elseif(array_key_exists($value, $connector_list))
						{
							$class = "connector";
							$class_empty = "connector_empty";
						}
						else 
						{
							$class ="optional";
							$class_empty ="optional_empty";
						}
						
						if(array_key_exists($value, $specs_directory))
						{	
							foreach($specs_directory_product[$value] as $mea => $i)
							{
							$notifications = "Product list...";
							$$class .="<div style=\"width:800px;overflow: auto;\"><div id=\"$value\" style=\"width:220px;height:50px;border-right:100px;float:left; \"> <img src=\"\" title=\"$value\" style=\"width:75px;height:75px;float:left;\">$value <b>$mea</b> <a id=\"measurement_button\" href=\"javascript:void(0);\" onclick=\"start_menu('measurement','view');\">mm</a> <a href=\"\" onclick=\"edit_variable('$value','$mea','$product_id')\">Edit</a>
							<div id=\"measurement_popup\" style=\"position: absolute;z-index: 1; display:none;border: 1px solid; width: 250px;background-color: #ffffff;top: 25%; left: 7%;\">
							<h1 style=\"font: 14px Arial; border-bottom:1px solid; border-top:1px solid;\">SI-units</h1>
							<h1 style=\"font: 12px Arial; border-bottom:1px solid;\">Kilometres<span style=\"float:right;margin-right: 5px;\"><a href=\"\">Add product</a></span></h1>
							<div id=\"notification_content\">$notifications</div>
							<h1 style=\"font: 12px Arial; border-bottom:1px solid; border-top:1px solid;\">Metres</h1>
							<div id=\"notification_content\">$notifications</div>
							<h1 style=\"font: 12px Arial; border-bottom:1px solid; border-top:1px solid;\">Centimetres</h1>
							<div id=\"notification_content\">$notifications</div>
							<h1 style=\"font: 12px Arial; border-bottom:1px solid; border-top:1px solid;\">Millimetres</h1>
							<div id=\"notification_content\">$notifications</div>
							<h1 style=\"font: 14px Arial; border-bottom:1px solid; border-top:1px solid;\">US customary/Imperial units</h1>
							<h1 style=\"font: 12px Arial; border-bottom:1px solid; border-top:1px solid;\">Miles</h1>
							<div id=\"notification_content\">$notifications</div>
							<h1 style=\"font: 12px Arial; border-bottom:1px solid; border-top:1px solid;\">Thou</h1>
							<div id=\"notification_content\">$notifications</div>
							<h1 style=\"font: 12px Arial; border-bottom:1px solid; border-top:1px solid;\">Foot</h1>
							<div id=\"notification_content\">$notifications</div>
							<h1 style=\"font: 12px Arial; border-bottom:1px solid; border-top:1px solid;\">Inch</h1>
							<div id=\"notification_content\">$notifications</div>
							<div id=\"notification_bottom\" style=\"border-top:1px solid;text-align: center;\">
							<a href=\"\">View All</a></div></div>
							</div>";
							}
							$$class .= "<div style=\"width: 180px;float:left;\"><img src=\"\" title=\"Connect to...\" style=\"width:60px;height:60px;float:left;\">Connected to<br/><a href=\"\">5</a> / <a href=\"\" title=\"Compatible with 20+ items\">20+ items</a></div>";
							$$class .= "<div style=\"float:left;\">Browse corresponding/comparable products by <a href=\"\" onmouseover=\"change_measurement_detail('$value');\" title=\"Vaihda yksikkö tai tarkkuus\">$value</a><br/>";
							foreach($specs_directory[$value] as $product_width => $product_id)
							{$teh_link = "";
								$detail_min=mysql_query("SELECT object FROM `multimedia` WHERE `idproduct1`='$product_id'");
									while ($row = mysql_fetch_assoc($detail_min)) {
										$object = $row['object'];
										$teh_link = "upload/$product_id.$object";
								}
								// $tech_specs_widget .= "<img src=\"$link\" style=\"width:50;height:50;\"><li>$product_width => $product_id</li>";
								$$class .= "<a href=\"object.php?id=$product_id\"><img src=\"$teh_link\" style=\"width:50;height:50;\" />
								<span style=\"background-color: #ffffff;margin: -15 20 0 -55;\"><input class=\"hold_on\" type=\"checkbox\" onclick=\"refresh_something();\" name=\"holdon[$value]\" value=\"$product_width\" title=\"Hold on\"> $product_width</span></a>";
								$table_of_content[$class] = 0;
								
							}
							$$class .= "</div></div><br/>";
						}
						else
						{
							$$class_empty .= "<li id=\"$value\"><a href=\"javascript:void(0);\" onClick=\"inpu_t('$value','$this_product_id');\">Add $value</a></li>";
							if($class_empty == "connector_empty")
							{
							$$class_empty .= "<div id=\"connector_array\" style=\"display:none;border: 1px solid;width:300px;height:50px;\"></div>";
							}
						}
					// }
					// print "<br/>$tech_specs_structure[$s]<br/>";
				$s++;
				}
				$tech_specs_widget .= "<div id=\"product_container\" style=\"float: left; margin: 10 0 -13 5;width:800px;border-bottom: 1px solid;\">";
				$tech_specs_widget .= "<div id=\"measurement_viewer_popup\" style=\"position: absolute;z-index: 1; display:none;border: 1px solid; width: 400px; background-color: #ffffff;top: 24%; left: -2%;\">";
				$tech_specs_widget .= "Tiedetyt arvot: <b>length</b>, <b>width</b><br/>";
				$tech_specs_widget .= "Voidaan laskea: <b>pinta-ala</b>";
				$tech_specs_widget .= "<a href=\"\" onclick=\"start_menu('measurement_viewer','hidden');\">Sulje</a>";
				$tech_specs_widget .= "</div>";
				// $tech_specs_widget .= "<h4><a href=\"javascript:void(0);\" onclick=\"start_menu('measurement_viewer','view');\">Measurement</a></h4>";
				$tech_specs_widget .= "<h4 style=\"background-color:lightgrey;margin: 0 0 10 0;\"><a href=\"javascript:void(0);\" onclick=\"getPos(this);start_menu('measurement_viewer','view');\" style=\"text-decoration:none;color:black;\">Measurement</a></h4>";
				// $tech_specs_widget .= "<p title=\"To help product visibility in market you can add more data as you know\">More info is more visibility in market</p>";
				$tech_specs_widget .= $measurement;
				$tech_specs_widget .= "</div>";
				$tech_specs_widget .= "<div style=\"padding: 0 0 0 330;\"><a href=\"\" style=\"text-align:center;background-color: #ffffff;padding: 0 5;\">View more (NaN unit)</a></div>";
				if($appearance != "")
				{
					$tech_specs_widget .= "<div style=\"float: left; margin: 10;\">";
					$tech_specs_widget .= "<h4>Appearance</h4>";
					$tech_specs_widget .= $appearance;
					$tech_specs_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
					$tech_specs_widget .= "</div>";
				}
				if($energy != "")
				{
					$tech_specs_widget .= "<div style=\"float: left; margin: 10;\">";
					$tech_specs_widget .= "<h4>Energy (<a href=\"javascript:void(0);\" onclick=\"exclude('energy');\">Exclude</a>)</h4>";
					$tech_specs_widget .= $energy;
					$tech_specs_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
					$tech_specs_widget .= "</div>";
				}
				if($optional != "")
				{
					$tech_specs_widget .= "<div style=\"float: left; margin: 10;\">";
					$tech_specs_widget .= "<h4>Optional</h4><!--Additional information-->";
					$tech_specs_widget .= $optional;
					$tech_specs_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
					$tech_specs_widget .= "</div>";
				}
				if($security != "")
				{
					$tech_specs_widget .= "<div style=\"float: left; margin: 10;\">";
					$tech_specs_widget .= "<h4>Security</h4>";
					$tech_specs_widget .= $security;
					$tech_specs_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
					$tech_specs_widget .= "</div>";
				}
				
		/*
		 * Connectors on stuff / product
		 * 
		 */
		function connector_info($this_product_id)
		{
			$connectors_query = "SELECT cop.connector_id, cop.count, ci.name, ci.gender 
			FROM connectors_on_product cop, connector_info ci 
			WHERE cop.idproduct1='$this_product_id'
			and ci.connector_id = cop.connector_id";
			$connectors_result = mysql_query($connectors_query);
			$connectors_items = "";
			
			if (mysql_numrows($connectors_result) > 0)
			{
				while ($row = mysql_fetch_assoc($connectors_result)) {
					/*
					$inc_product = $row['idproduct1'];
					$default_picture = $row['default_picture'];
					$manufacturer = $row['manufacturer'];
					$model = $row['model'];
					*/
					$connector_id = $row['connector_id'];
					$count = $row['count'];
					$name = $row['name'];
					$gender = $row['gender'];
					
					$connectors_items .= "<span id=\"$connector_id\" style=\"background-color:#bac;\">";
					$connectors_items .= "<a href=\"javascript:void(0);\" name=\"connector_$connector_id\" onclick=\"start_knowledge_menu(this,'connectors_info','view','$this_product_id');\" title=\"connector_info_ufo\">";
					$connectors_items .= "$name - $gender ($count)";
					$connectors_items .= "</a>";
					$connectors_items .= "</span>";
						
				}
				
			}
			else 
			{
				$connectors_items .= "<a href=\"javascript:void(0);\">Add connectors</a>";
				// To do nothing
			}
			return $connectors_items;
		}
		
		$connectors_items = connector_info($this_product_id);
				
				$detail_widget  = "<div id=\"product_empty_contain_viewer_popup\" style=\"margin: 10;display:none;border:1px solid;position:absolute;z-index:2;background-color:#ffffff;\">";
				$detail_widget .= "<div id=\"product_containerrrrr\" style=\"float: left; margin: 10;\">";
				$detail_widget .= "<p title=\"To help product visibility in market you can add more data as you know\">More info is more visibility in market</p>";
				$detail_widget .= "<h4>Measurement</h4>";
				// $detail_widget .= "<h4><a href=\"javascript:void(0);\" onclick=\"getPos(this);start_menu('measurement_viewer','view');\">Measurement</a></h4>";
				$detail_widget .= $measurement_empty;
				$detail_widget .= "<a href=\"javascript:void(0);\" onClick=\"getPos(this);\">Add more</a>";
				$detail_widget .= "</div>";
				$detail_widget .= "<div style=\"float: left; margin: 10;\">";
				$detail_widget .= "<h4>Appearance</h4>";
				$detail_widget .= $appearance_empty;
				$detail_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
				$detail_widget .= "</div>";
				$detail_widget .= "<div style=\"float: left; margin: 10;\">";
				$detail_widget .= "<h4>Energy (<a href=\"javascript:void(0);\" onclick=\"exclude('energy');\">Exclude</a>)</h4>";
				$detail_widget .= $energy_empty;
				$detail_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
				$detail_widget .= "</div>";
				$detail_widget .= "<div style=\"float: left; margin: 10;\">";
				$detail_widget .= "<h4>Optional</h4><!--Additional information-->";
				$detail_widget .= $optional_empty;
				$detail_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
				$detail_widget .= "</div>";
				$detail_widget .= "<div style=\"float: left; margin: 10;\">";
				$detail_widget .= "<h4>Security</h4>";
				$detail_widget .= $security_empty;
				$detail_widget .= "<a href=\"javascript:void(0);\" onClick=\"\">Add more</a>";
				$detail_widget .= "</div>";
				

				$detail_widget .= "<div style=\"float: left; margin: 10;\">";
				$detail_widget .= "<h4>Connections</h4>";
				
				$detail_widget .= "<div id=\"connectors_info_popup\" style=\"position: absolute;z-index: 1; display:none;border: 1px solid; width: 300px; background-color: #ffffff;height:100px;\">";
				/*$detail_widget .= "<hr style=\"margin: 13 0 -13 0;border-color:#66CCFF;\"/>";
				$detail_widget .= "<span style=\"background-color:#ffffff;padding: 0 3 0 0;\">Recent updated <span id=\"cx\"></span></span>";
				
				$detail_widget .= "<hr style=\"margin: 13 0 -13 0;border-color:#66CCFF;\"/>";
				$detail_widget .= "<span style=\"background-color:#ffffff;padding: 0 3 0 0;\"><span id=\"cx_recent_created\"></span> Recent created <span id=\"cx_recent_created_count\"></span></span>";
				
				$detail_widget .= "<hr style=\"margin: 13 0 -13 0;border-color:#66CCFF;\"/>";
				$detail_widget .= "<span style=\"background-color:#ffffff;padding: 0 3 0 0;\"><span id=\"cx_suggestion_count\"></span> Suggestions <span id=\"cx_suggestion\"></span></span>";
				
				$detail_widget .= "<hr style=\"margin: 13 0 -13 0;border-color:#66CCFF;\"/>";
				$detail_widget .= "<span style=\"background-color:#ffffff;padding: 0 3 0 0;\"><span id=\"cx_count\"></span> Result <span id=\"cx\"></span></span>";
				$detail_widget .= "<div id=\"cx_result\"></div>";*/
				$detail_widget .= "<span id=\"cx_popup\"></span>";
				$detail_widget .= "Popup";
				$detail_widget .= "</div>";
				
				$detail_widget .= "<h5>In use</h5>";
				$detail_widget .= "<div id=\"cx_list-ready\">";
				$detail_widget .= "$connectors_items";
				$detail_widget .= "</div>";
				
				$detail_widget .= "<h5>Other people uses</h5>";
				$detail_widget .= "<div id=\"cx_embedded_knowledge\">";
				$detail_widget .= "";
				$detail_widget .= "</div>";
				
				$detail_widget .= $connector_empty;
				
				$detail_widget .= "<div id=\"connectors_knowledge_embedded\" style=\" display:none;overflow: auto;border: 1px solid; width: 300px; background-color: #ffffff;height:300px;\">";
				$detail_widget .= "<hr style=\"margin: 13 0 -13 0;border-color:#66CCFF;\"/>";
				$detail_widget .= "<span style=\"background-color:#ffffff;padding: 0 3 0 0;\">Recent updated <span id=\"cx\"></span></span>";
				
				$detail_widget .= "<hr style=\"margin: 13 0 -13 0;border-color:#66CCFF;\"/>";
				$detail_widget .= "<span style=\"background-color:#ffffff;padding: 0 3 0 0;\"><span id=\"cx_recent_created\"></span> Recent created <span id=\"cx_recent_created_count\"></span></span>";
				
				$detail_widget .= "<hr style=\"margin: 13 0 -13 0;border-color:#66CCFF;\"/>";
				$detail_widget .= "<span style=\"background-color:#ffffff;padding: 0 3 0 0;\"><span id=\"cx_suggestion_count\"></span> Suggestions <span id=\"cx_suggestion\"></span></span>";
				
				$detail_widget .= "<hr style=\"margin: 13 0 -13 0;border-color:#66CCFF;\"/>";
				$detail_widget .= "<span style=\"background-color:#ffffff;padding: 0 3 0 0;\"><span id=\"cx_count\"></span> Result <span id=\"cx\"></span></span>";
				$detail_widget .= "<div id=\"cx_result\"></div>";
				$detail_widget .= "Embedded";
				$detail_widget .= "</div>";
				

				$detail_widget .= "</div>";
				$detail_widget .= "</form>";
				$detail_widget .= "</div>";
				

			}
			// $product  = "";
			$product_info .= $tech_specs_widget;
			// $product_info .= $trade_agreement_view;
		
		/*
		$godies=mysql_query("SELECT p2.product_id, p2.manufacturer, p2.model
							FROM connector_type ct1, connector_status_lookup c1, connector_info c2, product_info p1, product_info p2
							WHERE p1.product_id like '$product_id'
							and p1.product_id=c1.on_product
							and c1.type_id=ct1.type_id
							and ct1.type_id IN (select ct2.type_id
												from connector_type ct2
												where ct2.typename=ct1.typename
												and ct2.gender<>ct1.gender
												and ct2.type_id=c2.type_id
												and c2.on_product=p2.product_id)");
		*/		
		// $goodies=mysql_query("SELECT p2.idproduct1, p2.manufacturer, p2.model FROM product_info p2 WHERE p2.idproduct1 like '$product_id'");
		// $goodies=mysql_query("SELECT idproduct1 FROM product_info WHERE idproduct1='$product_id'");
		
		/*
		$goodies=mysql_query("SELECT p2.idproduct1, p2.manufacturer, p2.model, ci2.gender, ci2.name
							FROM connector_info ci1, connector_status_lookup c1, connector_status_lookup c2, product_info p1, product_info p2
							WHERE p1.idproduct1='$product_id'
							and c1.idproduct1=p1.idproduct1
							and ci1.connector_id=c1.connector_id
							and ci1.name IN (select ci2.name
											from connector_info ci2
											where 
											and ci2.gender<>ci1.gender
											and ci2.connector_id=c2.connector_id
											and c2.idproduct1=p2.idproduct1)");	
		*/
		
		$goodies=mysql_query("SELECT p2.idproduct1, p2.manufacturer, p2.model, p2.default_picture, ci2.name, ci2.gender
							FROM connector_info ci1, connector_status_lookup c1, product_info p1, connector_info ci2, product_info p2, connector_status_lookup c2
							WHERE p1.idproduct1='$this_product_id'
							and c1.idproduct1=p1.idproduct1
							and ci1.connector_id=c1.connector_id
							and ci2.gender<>ci1.gender
							and ci1.name=ci2.name
							and c2.connector_id=ci2.connector_id
							and p2.idproduct1=c2.idproduct1
							");	
													/*
							SELECT p2.idproduct1, p2.manufacturer, p2.model, ci2.gender, ci2.name
							<>>>>>>>
							
							
							and ci1.name=ci2.name
							and ci1.gender<>ci2.gender
							and ci1.connector_id<>ci2.connector_id
							and c2.connector_id=ci2.connector_id						
							and p2.idproduct1=c2.idproduct1
							*/
		$goodies_count = mysql_numrows($goodies);
		$compatible_goodies = ""; //$this_product_id<br/>";
		while ($row = mysql_fetch_assoc($goodies)) {
				/*
				$product_id = $row['p2.idproduct1'];
				$manufacturer = $row['p2.manufacturer'];
				$model = $row['p2.model'];
				$type = $row['ci2.name'];
				$gender = $row['ci2.gender'];
				$connector_info = $row['connector_id'];
				$gender = $row['gender'];
				$name = $row['name'];
				*/
				$product_id = $row['idproduct1'];
				$manufacturer = $row['manufacturer'];
				$model = $row['model'];
				$photo = $row['default_picture'];
				$name = $row['name'];
				$gender = $row['gender'];
			// $compatible_goodies .= "<a href=\"object.php?id=$product_id\"><img src=\"\" style=\"width:50px;height:50px;\" title=\"$manufacturer $mdel (via $type - $gender)\"></a>";
			$compatible_goodies .= "<a href=\"object.php?id=$product_id\"><img src=\"upload/$photo\" style=\"width:50px;height:50px;\" title=\"$manufacturer $model via $name ($gender)\"></a>";
		}
		$compatible_goodies .= "<br/>";
		// $compatible_goodies .= "<a href=\"javascript:void(0);\" onclick=\"market_scouping_popup($profile_id, $product_id, $topic, 'open');\" title=\"\">"; topic = 'usb' || ''
		// $compatible_goodies .= "<a href=\"javascript:void(0);\" onclick=\"trade_agreement_popup('popup', 'open');\" title=\"market scouping\">";
		$compatible_goodies .= "<a href=\"javascript:void(0);\" onclick=\"market_scouting_popup('".$_SESSION['stuffwalk_profile']."', '$this_product_id','', 'initial', 'open');\" title=\"market scouping\"><!-- market_scouting_frame -> update-->";
		if($goodies_count > 20)
		{
			$compatible_goodies .= "20+ connections available";
		}
		elseif($goodies_count > 1)
		{
			$compatible_goodies .= "$goodies_count connections available";
		}
		else
		{
			$compatible_goodies .= "$goodies_count connection available";
		}
		$compatible_goodies .= "</a>";
		// $compatible_goodies .="--end--";
		
		/*
		 * Connectors on stuff / product
		 * 
		 */
		
		$included_query = "SELECT * FROM product_info WHERE `parent_product`='$this_product_id'";
		$included_result = mysql_query($included_query);
		$included_items = "";
		if (mysql_numrows($included_result) > 0)
		{
			while ($row = mysql_fetch_assoc($included_result)) {
				$inc_product = $row['idproduct1'];
				$default_picture = $row['default_picture'];
				$manufacturer = $row['manufacturer'];
				$model = $row['model'];
				
				$included_items .= "<span id=\"$inc_product\">";
				$included_items .= "<a href=\"object.php?id=$inc_product\">";
				$included_items .= "<img src=\"upload/$default_picture\" style=\"width:45px;height:45px;\" title=\"$manufacturer $model\" />";
				$included_items .= "</a>";
				$included_items .= "</span>";
					
			}
			
		}
		else 
		{
			$included_items .= "<a href=\"javascript:void(0);\">Include compatible stuff</a>";
			// To do nothing
		}
		
		
		
			$proprietor = "";
			$compatible_result = "";
			$compatible_query = "";
			$compatible_suggest = "";
			return $j = Array("$product_info", "$link", "$proprietor", "$compatible_result", "$compatible_query", "$compatible_suggest", $table_of_content, $detail_widget, $compatible_goodies, $included_items);
		}
		
		function product_details($product_id, $profile_id, $product_topic)
		{
			$product_topic = $product_topic;
			$id = $product_id;
			$idprofile = $profile_id;
			$products = array();
				$query="SELECT * FROM `product_unifying_factor` WHERE `idproduct1` LIKE '$id'";
				$p_result=mysql_query($query);
				$p_num=mysql_numrows($p_result);
				$start = 0;
				for($start; $start < $p_num; $start++)
				{
					/*
					$array_name = mysql_result($p_result,$start,"data_name");
					$array_value = mysql_result($p_result,$start,"data_value");
					*/
					$array_name = "1";
					$array_value = "1";
					//print "$array_name : $array_value <br/>";
					$products[$id][$array_name] = $array_value;
					//array_push($product, '$array_name' => $array_value); 
				}
			$product = '';
			$i = 0;
			$size = count($products);
			// print "\$size: $size <br/>";
			$product .="<div id=\"content\" style=\"width: 795px; border: 1px solid;height: 200px;\">";
			
			while ($i < $size) {
			
			//$manufacturer = $products[$id]["manufacturer"];
			//$model = $products[$id]["model"];
			$product .="<h2>Product Details</h2>";
			$product_details  = "";
			$product_details .= "<div id=\"product_details\" style=\"border: 1px solid;\">";
			$product_details .= "<h3 style=\"padding: 0 0 0 5; background-color: #D3D3D3;border-bottom: 1px solid; border-color: #c0c0c0;\">Basic information</h3>";
			$basic_information  ="<div style=\"width: 290px; border: 1px solid; float: left;\">";
			$basic_information .="<table style=\"width: 290px; border: 1px solid;\">";
			$connectorlist  = "Connections: ";
			$connectorlist .= "<ul style=\"padding-left: 75px;\"> ";
			
			$information_update  = "<div id=\"information_update\" style=\"margin-left: 320px; border: 1px solid;\">";
			// $information_update .= "<h3>Täydennä tiedot</h2><ul>";
			$information_update .= "<h3>Täydennä puuttuvat kohdat</h2><ul style=\"padding-left: 20px;\">";
			$enforced_information = "";
			
			/* This content is temporarily  */
			// print $products[$id] . "<br/>";
			if(!array_key_exists("category", $products[$id]))
			{
				$enforced_information .= "<div id=\"enforced_information\" style=\"margin-left: 300px; margin-top: 5px; border: 1px solid;\">";
				$enforced_information .= "<h3>Lisää tiedot välittömästi</h2><p style=\"padding-left: 20px;\">";
				$enforced_information .= "<tr><td>Category</td><td><select name=\"category\">";
				$enforced_information .= "<option value=\"art\">Art</option>";
				$enforced_information .= "<option value=\"electric\">Electric</option>";
				$enforced_information .= "<option value=\"milieu\">Milieu</option>";
				$enforced_information .= "<option value=\"transfer\">Transfer</option>";
				$enforced_information .= "</select></td></tr>";
				$enforced_information .= "</p></div>";
			}
			foreach($products[$id] as $key => $value)
			{
				if($key == "room")
				{
					$product_topic = "$value";
				}
				
				if($key == "manufacturer")
				{
					$product_topic = "$value";
				}
				
				if($key == "model")
				{
					$product_topic .= " $value";
				}
				
				if(substr($key,0,4) == "conn")
				{ # http://php.net/manual/en/function.substr.php
					//print "$key => $value";
					/*
						kaikki vaan ensin taulukkoon ja sitten muotoon txt1, txt2, txt3 and txt4
						sen sijaan, että olisi
						txt1, txt2, txt3, txt4,
					*/
					$connectorlist .= "<li><a href=\"component/index.php?id=$value\">$value</a></li>";
				}
				
				if(substr($key,0,4) != "conn" && $value != "")
				{
					if($key == "category" || $key == "product_type")
					{
						$basic_information .= "<tr><td>" . $key . "</td><td><input id=\"update_information+".$id."+$key\" type=\"text\" name=\"$key\" value=\"$value\" disabled=\"disabled\">";
					}
					else
					{
						$basic_information .= "<tr><td>" . $key . "</td><td><input id=\"update_information+".$id."+$key\" type=\"text\" name=\"$key\" value=\"$value\">";
						$basic_information .= "<input type=\"submit\" onClick=\"update_information('update', '$idprofile', '$id', '$key', '$value');\" value=\" &#128177; \" title=\"Change\">";
						$basic_information .= "<input type=\"submit\" onClick=\"update_information('delete', '$idprofile', '$id', '$key', '$value');\" value=\" &times; \" title=\"Delete\"></td></tr>";
					}
				}
				
				if($key != "" && $value == "")
				{
					$information_update .= "<li>" . $key . "<input id=\"update_information+".$id."+$key\" type=\"text\" name=\"$key\" value=\"$value\">";
					//$information_update .= "<input type=\"submit\" value=\"Lisää\" onClick=\"update_information(\'$idprofile\', \'$id\', \'$key\', \'$value\');\"></li>";
					$information_update .= "<input type=\"submit\" value=\"Lisää\" onClick=\"update_information('add', '$idprofile', '$id', '$key', '$value');\"></li>";
				}			
			}
			$connectorlist .= "</ul> ";
			$information_update .= "</ul></div>";
			
			$purchacer_query="SELECT * FROM `profile` WHERE `data_name` LIKE 'a_prospective_purchaser' AND `data_value` LIKE '$idprofile' AND `data_object` LIKE '$id'";
			$a_prospective_purchaser_result=mysql_query($purchacer_query);
			$purchaser_num=mysql_numrows($a_prospective_purchaser_result);	
			$purchasers = Array();
			for($purchaser_count = 0; $purchaser_count < $purchaser_num; $purchaser_count++)
			{
				$purchaser_id = mysql_result($a_prospective_purchaser_result,$purchaser_count,"idprofile1");
				$purchasers[$purchaser_id]["purchaser_count"] = $purchaser_count;
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
				$purchasers[$purchaser_id]["firstname"] = $firstname;
				$purchasers[$purchaser_id]["lastname"] = $lastname;
				$time = mysql_result($a_prospective_purchaser_result,$purchaser_count,"datetime");
				$purchasers[$purchaser_id]["time"] = $time;
				$object_id = mysql_result($a_prospective_purchaser_result,$purchaser_count,"data_object");
				$purchasers[$purchaser_id]["object_id"] = $object_id;
			}
			$purchaser_list = "";
			foreach($purchasers as $purchaser_id => $array)
			{
				foreach($array as $key1 => $value1)
				{
					if($key1 == "firstname") {$firstname = $value1;}
					if($key1 == "lastname") {$lastname = $value1;}
					if($key1 == "time") {$time = $value1;}
					if($key1 == "purchaser_count") {$purchaser_count = $value1;}
				}
				$purchaser_list .= "<div class=\"purchaser\"><a href=\"profile.php?id=$purchaser_id\">$firstname $lastname </a> ($purchaser_count) - <input type=\"button\" value=\"Hyväksy\" onClick=\"confirm_event('trade_agreement_valid_status_accept_buyer', '$idprofile', '$purchaser_id', '$object_id');\"><input type=\"button\" value=\"Hylkää\" onClick=\"decline('$id')\"><input type=\"button\" value=\"Torju\" onClick=\"block_user('$id')\"><br/>$time</div>";
			}
			if(count($purchasers) > 5) {$purchaser_list .= "<a href=\"\">View more</a>";}
			
			$a_prospective_purchaser  = "<div id=\"a_prospective_purchaser\" style=\"margin-left: 300px; margin-top: 5px; border: 1px solid;\">";
			$a_prospective_purchaser .= "<h3>Tällä tuotteella on ostajia (5 new request)<input type=\"button\" value=\"Rights for...\" style=\"float: right;\"></h3><p style=\"padding-left: 20px;\">";
			$a_prospective_purchaser .= "$purchaser_list";
			$a_prospective_purchaser .= "</p></div>";
			
			$a_wanted_product  = "<div id=\"a_wanted_product\" style=\"margin-left: 300px; margin-top: 5px; border: 1px solid;\">";
			$a_wanted_product .= "<h3>Tämä tuote on kysytty (5 new request)<input type=\"button\" value=\"Rights for...\" style=\"float: right;\"></h3><p style=\"padding-left: 20px;\">";
			$a_wanted_product .= "<h4>Korkeimmat hintapyynnöt</h4>";
			$a_wanted_product .= "<li>Mikko Mallikas &#45; 1000 € &#45; 31.07.2012 mennessä</li>";
			$a_wanted_product .= "<li>Maija Meikäläinen &#45; 700 € &#45; 01.08.2012 mennessä</li>";
			$a_wanted_product .= "<a href=\"\">View more</a>";
			$a_wanted_product .= "</p></div>";
			
			$marketing_feed  = "<div id=\"marketing_feed\" style=\"margin-left: 300px; margin-top: 5px; border: 1px solid;\">";
			$marketing_feed .= "<h3>Uusimmat tarjoukset<input type=\"button\" value=\"Rights for...\" style=\"float: right;\"></h3><p style=\"padding-left: 20px;\">";
			$marketing_feed .= "<h4>tälle tavaralle</h4>";
			$marketing_feed .= "<a href=\"http://www.autoverhoilu.fi\">Tuningstyle Oy</a>";
			$marketing_feed .= "<h4>kaikille samanlaisille tuotteille</h4>";
			$marketing_feed .= "<a href=\"\">View more</a>";
			$marketing_feed .= "</p></div>";
			
			$statistic_feed  = "<div id=\"statistic_feed\" style=\"margin-left: 300px; margin-top: 5px; border: 1px solid;\">";
			//$statistic_feed .= "<h3>Pysy ajantasalla</h2><p style=\"padding-left: 20px;\">";
			$statistic_feed .= "<h3>Huoltopäiväkirja<input type=\"button\" value=\"Rights for...\" style=\"float: right;\"></h3><p style=\"padding-left: 20px;\">";
			$statistic_feed .= "Kilometrit: <input type=\"\"><br/>";
			$statistic_feed .= "Viimeksi huollettu: <input type=\"\"><br/>";
			$statistic_feed .= "Katsastettu: <input type=\"\"><br/>";
			$statistic_feed .= "Öljyt vaihdettu: <input type=\"\"><br/>";
			$statistic_feed .= "Takuuta jäljellä: <input type=\"\"><br/>";
			$statistic_feed .= "Tankkasit bensiiniä: <input type=\"\"><br/>";
			$statistic_feed .= "Renkaat: <input type=\"\"><br/>";
			$statistic_feed .= "<a href=\"\">View more</a>";
			$statistic_feed .= "</p></div>";
			
			$design_and_beaty_specs  = "<div id=\"design_and_beaty_specs\" style=\"margin: 5 0 0 5;\">";
			$design_and_beaty_specs .= "<h3 style=\"padding: 0 0 0 5; background-color: #D3D3D3;border-bottom: 1px solid; border-color: #c0c0c0;\">Ulkoasu &amp; Muotoilu<input type=\"button\" value=\"Rights for...\" style=\"float: right;\"></h3><p style=\"padding-left: 20px;\">";
			$design_and_beaty_specs .= "<li><table style=\"margin: -20 0 0 15\">
										<tr><th style=\"text-align: left;\">Kojelauta</th><td>Alcantara</td></tr><tr><th>Valmistaja</th><td><a href=\"http://www.autoverhoilu.fi\">Tuningstyle Oy</a></td></tr></table></li>";
			$design_and_beaty_specs .= "<li><table style=\"margin: -20 0 0 15\">
										<tr><th style=\"text-align: left;\">Katto</th><td>Alcantara</td></tr><tr><th>Valmistaja</th><td><a href=\"http://www.autoverhoilu.fi\">Tuningstyle Oy</a></td></tr></table></li>";
			$design_and_beaty_specs .= "<li><table style=\"margin: -20 0 0 15\">
										<tr><th style=\"text-align: left;\">Penkit</th><td>Alcantara (nahkapenkit)</td></tr><tr><th>Valmistaja</th><td><a href=\"http://www.autoverhoilu.fi\">Tuningstyle Oy</a></td></tr></table></li>";
			$design_and_beaty_specs .= "<li><table style=\"margin: -20 0 0 15\">
										<tr><th style=\"text-align: left;\">Matot</th><td>Alcantara</td></tr><tr><th>Valmistaja</th><td><a href=\"http://www.autoverhoilu.fi\">Tuningstyle Oy</a></td></tr></table></li>";
			$design_and_beaty_specs .= "<a href=\"\">View more</a>";
			$design_and_beaty_specs .= "</p></div>";

			$green_economy_and_performance_specs  = "<div id=\"green_economy_and_performance_specs\" style=\"margin: 5 0 0 5;\">";
			$green_economy_and_performance_specs .= "<h3 style=\"padding: 0 0 0 5; background-color: #D3D3D3; border-bottom: 1px solid; border-color: #c0c0c0;\">Suorituskyky &amp; Taloudellisuus<input type=\"button\" value=\"Rights for...\" style=\"float: right;\"></h3><p style=\"padding-left: 20px;\">";
			$green_economy_and_performance_specs .= "<li>Channel-type: 3-channel</li> <!-- http://h18000.www1.hp.com/products/quickspecs/13277_na/13277_na.HTML-->";
			$green_economy_and_performance_specs .= "<li>Kellotaajuus: 3.6 / 3.8 GHz</li>";
			$green_economy_and_performance_specs .= "<li>TDP: 95W</li>";
			$green_economy_and_performance_specs .= "<li>CO<sub>2</sub> &ndash; päästöt</li>";
			$green_economy_and_performance_specs .= "<li>Vaihteisto</li>";
			$green_economy_and_performance_specs .= "<li>Sylinteritilavuus</li>";
			$green_economy_and_performance_specs .= "<li>Pesulämpötila 40 &deg;C </li>";
			$green_economy_and_performance_specs .= "</p></div>";
			
			$operating_environment  = "<div id=\"operating_environment\" style=\"margin: 5 0 0 5; border: 1px solid;\">";
			$operating_environment .= "<h3>Käyttöympäristö<input type=\"button\" value=\"Rights for...\" style=\"float: right;\"></h3><p style=\"padding-left: 20px;\">";
			$operating_environment .= "<label><input type=\"radio\"> Maantieajo</label>";
			$operating_environment .= "<label><input type=\"radio\"> Kaupunkiajo</label>";
			$operating_environment .= "<label><input type=\"radio\"> Kaupunkiajo</label>";
			$operating_environment .= "<label><input type=\"radio\"> Seisonta</label>";
			$operating_environment .= "<label><input type=\"radio\"> Käytössä</label>";
			$operating_environment .= "<h4>kaikille samanlaisille tuotteille</h4>";
			$operating_environment .= "<a href=\"\">View more</a>";
			$operating_environment .= "</p></div>";
			
			$specifications  = "<div id=\"specifications\" style=\"margin: 5 0 0 5;\">";
			$specifications .= "<h3 style=\"padding: 0 0 0 5; background-color: #D3D3D3; border-bottom: 1px solid; border-color: #c0c0c0;\">Tekniset tiedot<input type=\"button\" value=\"Rights for...\" style=\"float: right;\"></h3><ul style=\"padding-left: 20px;\">";
			$specifications .= "<li>Hevosvoimat</li>";
			$specifications .= "<li>Vääntö</li>";
			$specifications .= "<li><b>Materiaali</b> Puu</li>";
			$specifications .= "<li>Pituus</li>";
			$specifications .= "<li>Leveys</li>";
			$specifications .= "<li>Korkeus</li>";
			$specifications .= "<li>Syvyys</li>";
			$specifications .= "<li>Halkaisija</li>";
			$specifications .= "<li>Omamassa</li>";
			$specifications .= "<li>Kokonaismassa</li>";
			$specifications .= "<li>Vetotapa</li>";
			$specifications .= "<li>Korimalli</li>";
			$specifications .= "<li>Värikoodi</li>";
			$specifications .= "<li>Sähkö: jännite, teho</li>";
			$specifications .= "<li>Kohderyhmä (ketkä kyllä, ketkä ei: kehitysvammaiset)</li>";
			$specifications .= "<li>Kohdemaat (ketkä kyllä, ketkä ei: venäjä)</li>";
			$specifications .= "<li><label><input type=\"checkbox\"> Iskunkestävä</label></li>";
			$specifications .= "<li><label><input type=\"checkbox\"> Vedenkestävä</label></li>";
			$specifications .= "<li><label><input type=\"checkbox\"> Tärinänkestävä</label></li>";
			$specifications .= "<li><label><input type=\"checkbox\"> Mattapinta</label></li>";
			$specifications .= "<li><label><input type=\"checkbox\"> Kiiltopinta</label></li>";
			$specifications .= "<li><label><input type=\"checkbox\"> UV-suojattu</label></li>";
			$specifications .= "<li><label><input type=\"checkbox\"> Puuvillaa</label></li>";
			$specifications .= "<li><label><input type=\"checkbox\"> Vaatekoko</label></li>";
			$specifications .= "</ul></div>";
			
			$buttons  = "<div id=\"buttons\" style=\"margin-left: 300px; margin-top: 5px; border: 1px solid;\">";
			$buttons .= "<h3>Napit<input type=\"button\" value=\"Rights for...\" style=\"float: right;\"></h3><p style=\"padding-left: 20px;\">";
			$buttons .= "<h4>Kuva</h4>";
			$buttons .= "<li><input type=\"button\" value=\"Tykkää kuvasta\" /></li>";
			$buttons .= "<li><input type=\"button\" value=\"Haluan paremman kuvan\" /></li>";
			$buttons .= "<li><input type=\"button\" value=\"Ehdota lisää kuvia\" /></li>";
			$buttons .= "<h4>Tiedot</h4>";
			$buttons .= "<li><input type=\"button\" value=\"Ehdota tietojen lisäämistä\" /></li>";
			$buttons .= "<li><input type=\"button\" value=\"Ehdota hinnan nostamista\" /></li>";
			$buttons .= "<li><input type=\"button\" value=\"Ehdota tuotteen vaihtoa\" /></li>";
			$buttons .= "<li><input type=\"button\" value=\"Ehdota Huutokaupattavaksi\" /></li>";
			$buttons .= "<li><input type=\"button\" value=\"Ehdota yhteydenottoa\" /></li>";
			$buttons .= "<li><input type=\"button\" value=\"Ehdota vuokrattavaksi\" /></li>";
			$buttons .= "<li><input type=\"button\" value=\"Ehdota rompetorille/torille\" /></li>";
			$buttons .= "<li><input type=\"button\" value=\"Ehdota näyttelyyn\" /></li>";
			$buttons .= "</p></div>";
			
			$basic_information	.= "</table>";
			$basic_information 	.= "$connectorlist";
			$basic_information 	.= "</div>";
			$product_details 	.= "$basic_information";
			$product_details 	.= "$enforced_information";
			$product_details 	.= "$information_update";
			$product_details 	.= "</div>";
			$product .= "$product_details";
			$product .= "$a_prospective_purchaser";
			$product .= "$a_wanted_product";
			$product .= "$marketing_feed";
			$product .= "$statistic_feed";
			$product .= "$design_and_beaty_specs";
			$product .= "$green_economy_and_performance_specs";
			$product .= "$specifications";
			$product .= "$buttons";
			
			//$product .= "<div style=\"margin:10;width:160px;float: left;\"><a href=\"object.php?id=$id\"><img src=\"\" width=\"150px\" height=\"150px\">$manufacturer $model</a></div>";
			
			/**
			
				CHANGE / VAIHDA
				i)  keskenään omien laitteiden kanssa
				ii) vaihda jonkun muun myyjän kanssa tavaroita keskenään
				iii)Asiakasetuna annat pois jotain, ja saat tilalle jotain
			
			**/
			
			// TARKISTETAAN onko jo myynnissä, ettei tuu duplicate -ilmoituksia.
			$queryq="SELECT * FROM `trade_agreement` WHERE `idprofile1` LIKE '$idprofile' AND `data_name` LIKE 'proprietor_status_change' AND `data_object` LIKE '$id'";
			$resultq=mysql_query($queryq);
			$num22=mysql_numrows($resultq);
			// print "proprietor result: $num22";
			$product_id = $id;
			$proprietor  = "";
			if($num22 == "0")
			{		
				
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Olet omistaja\" style=\"float: right;margin: 4 7 \">";
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Vikailmoitus\" style=\"float: right;margin: 4 7 \">";
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Vahinkoilmoitus\" style=\"float: right;margin: 4 7 \">";
				$proprietor .= "<div id=\"sample_attach_menu_child\">";
				$proprietor .= "<div id=\"business_navigation\" style=\"border: 1px solid; width: 150px;float: left;\">";
				$proprietor .= "	<!--";
				$proprietor .= "	Tuote on ollut sinulla alkaen: pvm.<br/>";
				$proprietor .= "	Ostettu käytettynä yksityiskäyttäjältä / <br/>";
				$proprietor .= "	uutena / alennusmyynnistä kohteesta Gigantti.<br/>";
				$proprietor .= "	Tuotteen käyttöhistoriaa:<br/>";

				$proprietor .= "	<a class=\"sample_attach\" href=\"\">Katso lisää....</a>";
				$proprietor .= "	<br/>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:alert('Haltijat');\">Haltijat</a>";
				$proprietor .= "	<br/>-->";
				$proprietor .= "	<div class=\"subcontent\">";
				$proprietor .= "	<a class=\"sample_attach\"  href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'product','$product_id');\">$product_topic</a>";
				$proprietor .= "	Omistajan vaihto:";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'sell','$product_id');\">Myyntiin</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'change','$product_id');\">Vaihtoon</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'give','$product_id');\">Anna ilmaiseksi</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'donate','$product_id');\">Lahjoitetaan</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'auction','$product_id');\">Huutokaupataan</a>";
				$proprietor .= "	</div>";
			
				$proprietor .= "	<div class=\"subcontent\">";
				$proprietor .= "	Huollettavaksi:";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','recycle','$product_id');\">Kierrätykseen</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','warranty','$product_id');\">Takuuseen</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','repair','$product_id');\">Huoltoon</a><!-- Korjaukseen -->";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','reclamation','$product_id');\">Reklamoi</a>";
				$proprietor .= "	</div>";
				
				$proprietor .= "	<div class=\"subcontent\">";
				$proprietor .= "	Live-tapahtumat:";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','general_category','$product_id');\">Rompetori</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','flea_market','$product_id');\">Kirpputori</a>";
				$proprietor .= "	<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','market','$product_id');\">Tori</a>";
				$proprietor .= "	</div>";
				$proprietor .= "</div>";
				$proprietor .= "<div id=\"sale_options\">";
				//$proprietor .= "<form action=\"\" method=\"get\">";
				$proprietor .= "Tuoteinfoa<br/>";
				$proprietor .= "Ostettu {pvm}<br/>";
				$proprietor .= "600 muulla ihmisellä on sama tuote";
				//$proprietor .= "</form>";
				$proprietor .= "</div>";
				$proprietor .= "</div>";

				$proprietor .= "<script type=\"text/javascript\">";
				$proprietor .= "at_attach(\"sample_attach_menu_parent\", \"sample_attach_menu_child\", \"hover\", \"y\", \"pointer\");";
				$proprietor .= "</script>";
			}
			else
			{
				// http://answers.yahoo.com/question/index?qid=20100819144054AAutScN
				//	http://www.fileformat.info/info/unicode/char/2713/index.htm
				
			
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"&#x2713; Myynnissä\" style=\"float: right;margin: 4 7 4 0;background-color: lime; \">";
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Vika-/korjauspäivitys\" style=\"float: right;margin: 4 0 \">";
				$proprietor .= "<input type=\"button\" id=\"sample_attach_menu_parent\" class=\"sample_attach\" value=\"Vahinkoilmoitus\" style=\"float: right;margin: 4 0 \">";
				$proprietor .= "<div id=\"sample_attach_menu_child\">";
				
				$proprietor .= "Product for sale since<br/><hr/>";
				$proprietor .= "Tapahtuman vaihto:";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'change','$product_id');\">Vaihtoon</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'give','$product_id');\">Anna ilmaiseksi</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'donate','$product_id');\">Lahjoitetaan</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile', 'auction','$product_id');\">Huutokaupataan</a>";
				$proprietor .= "<hr/>Huollettavaksi:";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','recycle','$product_id');\">Kierrätykseen</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','warranty','$product_id');\">Takuuseen</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','repair','$product_id');\">Huoltoon</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onmouseover=\"proprietor_state('$idprofile','reclamation','$product_id');\">Reklamoi</a>";
				$proprietor .= "<hr/>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onClick=\"proprietor_status_price();\">Muuta hintaa</a>";
				$proprietor .= "<a class=\"sample_attach\" href=\"javascript:void(0);\" onClick=\"update_proprietor_status('$idprofile','$product_id', 'cancel');\">En myykään</a>\r\n";
				$proprietor .= "</div>";
				$proprietor .= "<script type=\"text/javascript\">";
				$proprietor .= "at_attach(\"sample_attach_menu_parent\", \"sample_attach_menu_child\", \"hover\", \"y\", \"pointer\");";
				$proprietor .= "</script>";
			}
		
		
			/**
			
				Compatible with
				
				ONGELMA: hyppii divien päälle. Pitää säätää joku korkeus matikan avulla: 
				N(max 20), vaikka N%5, jolloin tulee siistin näköinen käyttöliittymä hallitusti.
				
				linkki yli 20 ehdotuksen tapauksille:
				/object.php?id=x&and=compatiblewith
			
			**/
			function compatible_with($product_id)
			{
			
			}
			
			$available_connectors = Array();
			foreach($products[$id] as $key => $value)
			{	# http://php.net/manual/en/function.strpos.php
				$findme = "conn";
				$pos = strpos($key, $findme);
				// if ($pos !== false) {
					// echo "The string '$findme' was found in the string '$mystring'";
					// echo " and exists at position $pos ($key -> $value)";
					// } else {
					// }
				if ($pos !== false) {
					 //echo "($key -> $value)<br/>";
					 array_push($available_connectors, $value);
					}
			}
			
			//print count($available_connectors);
			$combatility_check_query="SELECT idproduct1 FROM `product_unifying_factor` WHERE `data_value` LIKE ";
			// $combatility_check_query="SELECT idproduct1 FROM `product` WHERE `data_value` LIKE ";
			for($i = 0; $i < count($available_connectors); $i++)
			{
				$combatility_check_query .= "'$available_connectors[$i]'";
				if($i+1 < count($available_connectors))
				$combatility_check_query .= " OR `data_value` LIKE ";
			}
			//print $combatility_check_query;
			$cdd_result=mysql_query($combatility_check_query);
			//print "result: $compatiblewith_result<br/>";
			// $cdd_num=mysql_numrows($cdd_result);
			$cdd_num=1;
			$combatile_products_id = Array();
			for($i = 0; $i < $cdd_num; $i++)
			{
				// $id = mysql_result($cdd_result,$i,"idproduct1");
				$id = 1;
				// $data_name = mysql_result($cdd_result,$i,"data_name");
				// $data_value = mysql_result($cdd_result,$i,"data_value");
				array_push($combatile_products_id, $id);
				//print "($id)Name: $data_name, Value: $data_value  <br/>";
			}
			$combatile_products_id = array_unique($combatile_products_id);
			array_multisort($combatile_products_id, SORT_NUMERIC);
			/*
			foreach($combatile_products_id as $a => $b)
			{
				//echo "$a => $b <br/>";
			}
			*/
			$combatility_query="SELECT * FROM `product` WHERE `idproduct1` LIKE ";
			for($i = 0; $i < count($combatile_products_id); $i++)
			{
				$combatility_query .= "'$combatile_products_id[$i]'";
				if($i+1 < count($combatile_products_id))
				$combatility_query .= " OR `idproduct1` LIKE ";
			}
			//print $combatility_query;
			$cde_result=mysql_query($combatility_query);
			//print "result: $cde_result<br/>";
			$cde_num=mysql_numrows($cde_result);
			//print "cde_num: $cde_num<br/>";
			//$compatible_result = "<div id=\"compatibleresult\" style=\"width: 200px;\">";
			$compatible_array = Array();
			for($i = 0; $i < $cde_num; $i++)
			{
				$id = mysql_result($cde_result,$i,"idproduct1");
				$datetime = mysql_result($cde_result,$i,"datetime");
				$data_name = mysql_result($cde_result,$i,"data_name");
				if($data_name == "product_type")
				{
					$compatible_array["$id"]["datetime"] = $datetime;
				}
				$data_value = mysql_result($cde_result,$i,"data_value");
				//print "($id)Name: $data_name, Value: $data_value  <br/>";
				$compatible_array["$id"]["$data_name"] = $data_value;	
			}
			
			/**
			
				SITÄ VARTEN, ETTÄ EI TULE KILOMETRIN MITTAISTA TARJONTAA
				PÄIVITÄ COUNT -MUUTTUJA
			
			**/
			
			$compatible_result = "";
			$compatible_query = "";
			$compatible_suggest = "";
			foreach($compatible_array as $id => $b)
			{
				foreach($b as $name => $value)
				{
					if ("manufacturer" == $name)
					{
						$manufacturer = "$value ";
					}
					if ("model" == $name)
					{
						$model = "$value";
					}
					if ("datetime" == $name)
					{
						$datetime = "$value";
					}
				}
				$compatible_result  .= "<a id=\"result_$datetime\" href=\"object.php?id=$id\"><img src=\"\" style=\"width: 45px; height: 45px;margin-bottom: 5px;\" title=\"$manufacturer $model\"/></a>";
				$compatible_query   .= "<a id=\"$datetime\" href=\"object.php?id=$id\" style=\"width:76px;\"><img src=\"\" style=\"width: 75px; height: 75px;\" title=\"$manufacturer $model\"/>$manufacturer $model</a>";
				// $compatible_suggest .= "<a id=\"$datetime\" href=\"object.php?id=$id\" onClick=\"add_as_part('$product_id', '$id','$datetime','$manufacturer','$model');\" style=\"width:76px;\"><img src=\"\" style=\"width: 75px; height: 75px;\" title=\"Add $manufacturer $model ($datetime)\"/></a>";
				$compatible_suggest .= "<a id=\"suggest_$datetime\" href=\"javascript:void(0);\" onClick=\"change_component_status('add_as_part','$product_id', '$id','$datetime','$manufacturer','$model');\" style=\"width:76px;\"><img src=\"\" style=\"width: 75px; height: 75px;\" title=\"Add $manufacturer $model ($datetime)\"/></a>";
				//$compatible_result .= "</a></div>";
				//$compatible_result .= "</div>";
			}
			
			
			
			/*
			$product .= "<tr><td><input type=\"checkbox\" name=\"delete_product[]\" value=\"$idproduct[$i]\"></td>";
			$product .= "<td>".$products[$idproduct]. "</td>";
			$product .= "<td>" .$products[$idproduct[$i]]["manufacturer"]. "</td><td>" . $products[$idproduct[$i]]["model"]. "</td><td>" .$products[$idproduct[$i]]["year"]."</td></tr>";
			*/
			$i++;
			}
			$product .="</div>";
			return $output = Array("$product", "$proprietor", "$compatible_result", "$compatible_query", "$compatible_suggest");
		}
		
		/* 
		
		Static business logic

		*/
		
		if(isset($_GET['product']))
		{
			$product = $_GET['product'];
		}
		function business_logic($product)
		{
			proprietor_status_change($product[0], $product[1], $product[2]);
		}
		
		function proprietor_status_change($product_id, $previous_status, $current_status)
		{
			switch($current_status)
			{
				CASE "Change":
				{
					$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'proprietor_status_change', 'change','$object','','Public')";
					//jotain
					break;
				}
				CASE "Sell":
				{
					$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'proprietor_status_change', 'sell','','','Public')";
					//jotain
					break;
				}
				CASE "Give": // anna
				{
					$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'proprietor_status_change', 'give','$object','','Public')";
					//jotain
					break;
				}
				CASE "Donate":
				{
					$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'proprietor_status_change', 'donate','$object','','Public')";
					//jotain
					break;
				}
				CASE "Want":
				{
					//$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'proprietor_status_change', 'donate','$object','','Public')";
					//jotain
					break;
				}
				CASE "Auction": // huutokauppa
				{
					$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'proprietor_status_change', 'auction','','','Public')";
					//jotain
					break;
				}
				CASE "Warranty":
				{
					$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'proprietor_status_change', 'warranty','','','Public')";
					//jotain
					break;
				}
				CASE "Recycling":
				{
					$query = "INSERT INTO product VALUES ('$product_id', NOW(), 'proprietor_status_change', 'recycle','$object_place','','Public')";
					//jotain
					break;
				}
			}
		}
	
	/*
	
		Product Connections Pop-Up
		now div id=""
		original div id="popup"
	
	*/
	$test  =	"<div id=\"market_scouting_frame\" class=\"popup\">";
	$test .=	"<div id=\"market_scouting_frame\" class=\"popup_frame\">";
	$test .=	"<div id=\"market_scouting_header\"><h1 class=\"popup_header\">Connection</h1></div>";
	
	//$test .=	"<div>";
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
	$test .=	"<option value=\"similar\" onClick=\"connection_menu('similar_product');\">Similar</option>";
	$test .=	"<option value=\"includes\" onClick=\"connection_menu('includes');\">Includes</option>";
	$test .=	"<option value=\"part_of\" onClick=\"connection_menu('part_of');\">Part of</option>";
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Compatible</option>";
	$test .=	"</select>";
	
	$trade_agreement_management = Array();
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
			/*
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_grade")
			{
			$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your grade\" style=\"text-decoration: none;\">Recommendations</a></li>";
			} */
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
			/*
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_grade")
			{
			$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"$class_count products waiting your receiving\" style=\"text-decoration: none; font-weight: bold;\">Recommendations ($class_count)</a></li>";
			}*/
			
		}
	}
	$test .= "</ul>";
	//$test .= "</div>";
	$test .= "<div id=\"trade_agreement_content\" class=\"popup_content\" style=\"overflow: auto;\">";// height: 265; onload=\"market_scouting('$idprofile', '$id','','');\">";
	$test .= "<div id=\"ta_content\" style=\"overflow: auto;\">";
	$test .="</div>";
	// varmaan olis hyvä siirtää onload body-kohtaan.
	// $test .= "<div id=\"trade_agreement_content\" class=\"popup_content\" style=\"overflow: auto;\" onload=\"market_scouting($profile_id, $product_id,connector_id,index_type)\">";
	
	// $sr  =	"<h2>Compatible With</h2>";
	/*$sr  =	"";
	$sr .=	"<div class=\"transform\" style=\"padding: 5px; height: 50px; border-bottom: 1px solid;\">";
	$sr .=	"<img src=\"\" style=\"width:50px; height: 50px; float: left;\">";
	$sr .=	"Corsair <label style=\"float: right;\"><input type=\"button\" value=\"Lisää\" /><input type=\"button\" value=\"Hylkää\" /></label>";
	$sr .=	"<br/>2 minutes ago  · Via <a href=\"\">DDR2</a>  · <a href=\"\">Advantages</a>";
	$sr .=	"<label style=\"float: right;\"><b>Price</b> € 50, <a href=\"\">Maksa</a></label>";
	$sr .=	"</div>";*/
	
	// $test .= $sr;
	$test .= "</div>";
	
	
	$test .= "<div id=\"market_scouting_frame\" class=\"popup_footer\">60<!--6 000 osaa, 14 maata. -->";
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
    width:800px;
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
	/*height: 265*/ /* 465px; */
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
print $test;
		
		//print "manu ". $products["manufacturer"] . "<br/>";
		// foreach($products as $key => $value)
		// {
			// print "$key : $value<br/>";
		// }
		$query="SELECT * FROM `product` WHERE `idproduct1` LIKE '$idproduct' AND `data_name` LIKE 'manufacturer'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		//$manufacturer = mysql_result($result,0,"data_value");
		//print $manufacturer;
		


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
		/*$i=0;		print mysql_result($found,$i,"accountid");*/
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

function getImageInfo($img) {
	// http://snipplr.com/view/30063/
	$ret = array("title"=>"","description"=>"");
	if(!file_exists($img)) return $ret;
	$size = getimagesize($img, $info);
	if(!isset($info['APP13'])) return $ret;
	$iptc = iptcparse($info['APP13']);
 
	if(is_array($iptc["2#025"]) && count($iptc["2#025"])>0) $ret["tag"] = implode(", ", $iptc["2#025"]);
	if($iptc["2#005"][0] != null) $ret["title"] = $iptc["2#005"][0];
	if($iptc["2#080"][0] != null) $ret["author"] = $iptc["2#080"][0];
	if($iptc["2#085"][0] != null) $ret["credit"] = $iptc["2#085"][0];
	if($iptc["2#090"][0] != null) $ret["city"] = $iptc["2#090"][0];
	if($iptc["2#095"][0] != null) $ret["state"] = $iptc["2#095"][0];
	if($iptc["2#101"][0] != null) $ret["country"] = $iptc["2#101"][0];
	if($iptc["2#105"][0] != null) $ret["title"] = $iptc["2#105"][0];
	if($iptc["2#116"][0] != null) $ret["copyright"] = $iptc["2#116"][0];
	if($iptc["2#120"][0] != null) $ret["description"] = $iptc["2#120"][0];
	if($iptc["2#122"][0] != null) $ret["author"] = $iptc["2#122"][0];
 
	$xmp = getImageXMP($img);
	foreach($xmp as $key => $value) {
		if($value != null && $value != "") $ret[$key] = $value;
	}
	return $ret;
}
 
function getImageXMP($filename) {
	// http://snipplr.com/view/30063/
    $file = fopen($filename, 'r');
		$source = fread($file, filesize($filename));
    	$xmpdata_start = strpos($source,"<x:xmpmeta");
    	$xmpdata_end = strpos($source,"</x:xmpmeta>");
    	$xmplenght = $xmpdata_end-$xmpdata_start;
    	$xmpdata = substr($source,$xmpdata_start,$xmplenght+12);
	fclose($file);
    $xmp_parsed = array();
    $regexps = array(
		array("name" => "copyright", "regexp" => "/<dc:rights>\s*<rdf:Alt>\s*<rdf:li xml:lang=\"x-default\">(.+)<\/rdf:li>\s*<\/rdf:Alt>\s*<\/dc:rights>/"),
	    array("name" => "author", "regexp" => "/<dc:creator>\s*<rdf:Seq>\s*<rdf:li>(.+)<\/rdf:li>\s*<\/rdf:Seq>\s*<\/dc:creator>/"),
		array("name" => "title", "regexp" => "/<dc:title>\s*<rdf:Alt>\s*<rdf:li xml:lang=\"x-default\">(.+)<\/rdf:li>\s*<\/rdf:Alt>\s*<\/dc:title>/"),
		array("name" => "description", "regexp" => "/<dc:description>\s*<rdf:Alt>\s*<rdf:li xml:lang=\"x-default\">(.+)<\/rdf:li>\s*<\/rdf:Alt>\s*<\/dc:description>/"),
	    array("name" => "camera model", "regexp" => "/tiff:Model=\"(.[^\"]+)\"/"),
	    array("name" => "maker", "regexp" => "/tiff:Make=\"(.[^\"]+)\"/"),
		array("name" => "width", "regexp" => "/tiff:ImageWidth=\"(.[^\"]+)\"/"),
		array("name" => "height", "regexp" => "/tiff:ImageLength=\"(.[^\"]+)\"/"),
	    array("name" => "exposure time", "regexp" => "/exif:ExposureTime=\"(.[^\"]+)\"/"),
	    array("name" => "f number", "regexp" => "/exif:FNumber=\"(.[^\"]+)\"/"),
	    array("name" => "iso", "regexp" => "/<exif:ISOSpeedRatings>\s*<rdf:Seq>\s*<rdf:li>(.+)<\/rdf:li>\s*<\/rdf:Seq>\s*<\/exif:ISOSpeedRatings>/"),
	    array("name" => "focal lenght", "regexp" => "/exif:FocalLength=\"(.[^\"]+)\"/"),
		array("name" => "user comment", "regexp" => "/<exif:UserComment>\s*<rdf:Alt>\s*<rdf:li xml:lang=\"x-default\">(.+)<\/rdf:li>\s*<\/rdf:Alt>\s*<\/exif:UserComment>/"),
		array("name" => "datetime original", "regexp" => "/xmp:CreateDate=\"(.[^\"]+)\"/"),
	    array("name" => "lens", "regexp" => "/aux:Lens=\"(.[^\"]+)\"/")
    );
    foreach ($regexps as $key => $k) {
		unset($r);
		preg_match ($k["regexp"], $xmpdata, $r);
		$xmp_item = @$r[1];
		// print $xmp_item;
		// if(in_array($k["name"], array("f number", "focal lenght"))) eval("\$xmp_item = ".$xmp_item.";");
		$xmp_parsed[$k["name"]] = str_replace("&#xA;", "\n", $xmp_item);
    }
	return $xmp_parsed;
}

function photos($product_id)
{
	$f = mysql_query("SELECT idproduct1, object FROM multimedia WHERE `use_of` LIKE 'In_Use' AND `idproduct1`='$product_id'");
	$num = mysql_num_rows($f);
	$photo_link = "";
	while ($row = mysql_fetch_assoc($f)) {
		$product_id = $row['idproduct1'];
		$object = $row['object'];
		$photo_link .= "upload/$product_id.$object";
	}
	$photo_info = array($num, $photo_link);
	return $photo_info;
}
$photo_info = photos($id);
$photo_count = $photo_info[0];
$photo_link = $photo_info[1];

print $detail_widget;
print "<style type=\"text/css\">
*{margin: 0; padding: 0;}

.photo_viewer_header{
	font: 16px Arial;
	font-weight: bold;
	background-color: lightgrey;
}
</style>
<!--
<input type=\"button\" value=\"seek\" onClick=\"baby_monitor('$idprofile')\" />
-->
<div id=\"test\"></div>";
print "<div id=\"photo_popup\" onmouseover=\"start_menu(this, 'photo','view');\" onmouseout=\"start_menu(this, 'photo','hidden');\" style=\"position: absolute;z-index: 2; display:none;border: 1px solid; width: 200px; height: 20px;background-color: #ffffff;\">
<h1 style=\"font: 14px Arial; font-weight:bold;margin:-1 0 0 0;\">";
print "<a href=\"javascript:void(0);\" onclick=\"trade_agreement_popup('photo_uploader_popup', 'open');\" >+ Add photo</a></h1>
</div>";
$header  = "<div id=\"headernavigation\" style=\"background-color:#3579DC; height: 35px;margin: 0px; padding: 0px;\">";
$header .= "<div id=\"header_content\" style=\"width:1310px;\">";

 //<a href=\"showcase.php?email=$email&amp;password=$password\" onclick=\"\">Shopstream</a>
 
$header .= "<a href=\"showcase.php\" onclick=\"\">Shopstream</a>";
$header .= " 
<!--<input type=\"text\" name=\"search\" style=\"margin:5 0 0 15%; height: 25px\" size=\"40px\" />-->
<input type=\"text\" name=\"search\" style=\"margin:5 0 0 125; height: 25px\" size=\"40px\" />
<input type=\"button\" name=\"uutuudet\" value=\"Suosikit / Kaupasta / Yksityiseltä\" style=\"margin: 2 0 0 0;padding:0;\"/>

<!--
<input type=\"button\" name=\"uutuudet\" value=\"uutuudet\" style=\"margin: 2 0 0 0;padding:0;\"/>
<input type=\"button\" name=\"alennusmyynti\" value=\"alennusmyynti\" style=\"margin: 2 0 0 0;padding:0;\"/>
<input type=\"button\" name=\"käytetyt\" value=\"käytetyt\" style=\"margin: 2 0 0 0;padding:0;\"/>
<input type=\"button\" name=\"ilmaisjakelut\" value=\"ilmaisjakelut\" style=\"margin: 2 0 0 0;padding:0;\"/>
-->
<!--
<a href=\"object.php\" onclick=\"\" style=\"float: right;margin-right: 200px;margin-top: 10px;font: 12px verdana;font-weight: bold; color: #c0c0cc; text-decoration: none;\">-->";
$header .= "<span style=\"float: right;margin-top: 10px;font: 12px verdana;font-weight: bold; color: #c0c0cc;\">";
$header .= "<a href=\"object.php\" onclick=\"\" style=\"text-decoration: none; color: #c0c0cc;\">";
if(!empty($firstname) && !empty($lastname))
{ 
	$header .= $firstname. " " .$lastname;
}
else
{
	$header .= "Vieras"; 
}
$header .= "</a>";
$header .= "<a href=\"veneer.php\" style=\"text-decoration: none; color: #c0c0cc;border-left: 1px solid;padding: 0 0 0 5;margin: 0 0 0 5;\" title=\"Aspect for your device life\">This Device</a>";
$header .= "<a href=\"veneer.php\" style=\"text-decoration: none; color: #c0c0cc;border-right: 1px solid;border-left: 1px solid;padding: 0 5;margin: 0 5;\" title=\"Go to Home\">Veneer</a>";
$header .= "<a href=\"logout.php\" style=\"text-decoration: none; color: #c0c0cc;\" title=\"(Yksityinen/Yritys-profiili)\">Log out</a>";


$header .= "</span>";
$header .= "</div>";
$header .= "</div>";

print($header);
/*
print "<div id=\"photo_uploader_popup\" onmouseover=\"start_menu('photo_uploader','view');\" onmouseout=\"start_menu('photo_uploader','hidden');\" style=\"position: absolute;z-index: 1; display:none;border: 1px solid; width: 200px; height: 20px;background-color: #ffffff;margin-left: -1000px;\">
<h1 style=\"font: 14px Arial; font-weight:bold;\"><a href=\"javascript:void(0);\" onclick=\"trade_agreement_popup('photo_uploader_popup', 'open')\">+ Add photo</a></h1>
</div>";*/
/*
print "<div id=\"business_card\" style=\"border:1px solid;background-color:lightblue;overflow:auto;\">";
print "<img src=\"\" onmouseover=\"start_menu('photo_uploader','view');\" onmouseout=\"start_menu('photo_uploader','hidden');\" style=\"margin-left: -1300px;float: left;height:125px;width:125px;border:1px solid;\">";
print "<span style=\"margin-left: -1170px;float: left;color:#000000;font: 24px Arial;\">$product_topic</span>";
print "<span style=\"margin-top:25px;margin-left: -1170px;float: left;color:#000000;font: 24px Arial;\">";
print "<img src=\"\" style=\"float: left;height:100px;width:100px;border:1px solid;\">";
print "<img src=\"\" style=\"float: left;height:100px;width:100px;border:1px solid;\">";
print "<img src=\"\" style=\"float: left;height:100px;width:100px;border:1px solid;\">";
print "<img src=\"\" style=\"float: left;height:100px;width:100px;border:1px solid;\">";
print "</span>";
print "</div>";
*/

$toc = "";
foreach($table_of_content as $name => $value)
{
	if($name == "photos")
	{
	$toc .= "<li class=\"menu\" style=\"width:170px;padding-left: 20px;\"><a href=\"object.php?id=$id&amp;h=$name\">" . ucfirst($name) . "</a> <span style=\"float:right;\">($photo_count)</span></li>";
	}
	else
	{
	$toc .= "<li class=\"menu\" style=\"width:170px;padding-left: 20px;\"><a href=\"object.php?id=$id&amp;h=$name\">" . ucfirst($name) . "</a></li>";
	}
	
}


$pro  = "<h3><img id=\"veneer_photo\" src=\"$photo_link\" onClick=\"start_menu(this, 'photo_viewer','view');\" onmouseover=\"start_menu(this,'photo','view');\" onmouseout=\"start_menu(this, 'photo','hidden');\" title=\"Click, to change from public to private\" style=\"width:200px;height: 200px;margin: 0;\">";
$pro .= "<div style=\"padding: 0 0 0 20;\">" . $product_topic . "</div></h3>";
$navi = "
<!--<div id=\"classification\" style=\"width: 200px;float: left;position: relative;left:10%;\">-->
<div id=\"classification\" style=\"width: 200px;float: left;\">
<!--
<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">Keskustelu</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Yhteydenotot (pos/neg)</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">Tilaukset</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Palvelut</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Tuotteet</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">Ilmoitukset (positiiviset)</a></div>
</div>
-->

<!--
<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">
<input type=\"button\" value=\"NEW STUFF\" style=\"background-color: red; font: bold;\" />
</div>
-->
$pro
<!--
<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">
<li class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"showcase.php\">Shopping</a></li>
<li class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"profile.php\">Transfer</a></li>
<li class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"storage.php\">Storage</a></li>
</div>
-->
<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">
$toc
<!--
<li class=\"menu\" style=\"width:170px;padding-left: 20px;\"><a href=\"javascript:void(0);\" onClick=\"object_view('bookkeeping','".$present_product_id."');\">Bookkeeping</a></li>
-->
<!--
<li class=\"menu\" style=\"width:170px;padding-left: 20px;\"><a href=\"javascript:void(0);\" onClick=\"object_view('veneer','".$present_product_id."');\">Veneer</a></li>
<li class=\"menu\" style=\"width:170px;padding-left: 20px;\"><a href=\"javascript:void(0);\" onClick=\"object_view('appearance','".$present_product_id."');\">Appearance</a></li>
<li class=\"menu\" style=\"width:170px;padding-left: 20px;\"><a href=\"javascript:void(0);\" onClick=\"object_view('info','".$present_product_id."');\">Info</a></li>
<li class=\"menu\" style=\"width:170px;padding-left: 20px;\"><a href=\"javascript:void(0);\" onClick=\"object_view('life_cycle','".$present_product_id."');\">Life Cycle</a></li>
<li class=\"menu\" style=\"width:170px;padding-left: 20px;\"><a href=\"javascript:void(0);\" onClick=\"object_view('asset','".$present_product_id."');\">Asset</a></li>
<li class=\"menu\" style=\"width:170px;padding-left: 20px;\"><a href=\"javascript:void(0);\" onClick=\"object_view('photos','".$present_product_id."');\">Photos</a> <span style=\"float:right;\">($photo_count)</span></li>
-->
<li class=\"menu\" style=\"width:170px;padding-left: 20px;\"><a href=\"javascript:void(0);\" onClick=\"object_view('science','".$present_product_id."');\">Science</a></li>
</div>";
if(isset($_GET['and']) && $_GET['and'] == "compatiblewith")
{
$navi .="
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"object.php?id=$id&amp;and=compatiblewith\" onclick=\"category('motor')\">Moottorinosat</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"object.php?id=$id&amp;and=compatiblewith\" onclick=\"category('gear')\">Vaihdelaatikon osat</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"object.php?id=$id&amp;and=compatiblewith\" onclick=\"category('electric')\">Sähköosat</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"object.php?id=$id&amp;and=compatiblewith\" onclick=\"category('book')\">Kirjallinen aineisto</a></div>
";
}

else
{
	$navi .= "<hr style=\"margin: 0 10;\"/>";
	// <h4 style=\"margin: 0 15;\">Photos / Other Objects</h4>
	$navi .= "<h4 style=\"margin: 0 15;\">&copy; Stuffwalk</h4>";
	/*
	$navi .="
	<h3>Limited beta-tests</h3>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>

	<h3>Limited availability</h3>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>

	<h3>Limited life span</h3>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>

	<h3>Closeout</h3>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>
	<a href=\"\"><img src=\"\" style=\"width: 50px; height: 50px;\" /></a>";
	*/
}


$navi .="

<!--
<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">Uutuudet</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">$firstname $lastname</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">Kaatopaikka/Kierrätys</a></div></div>
-->
<!--
<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">Uutuudet</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">$firstname $lastname</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Omistaja/Myyjä</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Arvostelut</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Taloushistoria</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Turva-asetukset</a></div>
</div>

<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">Tuotteet</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Myynnissä</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Käytössä</a></div>
</div>

<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">Verkosto</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Kaikki</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">KOAS</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Uni. Jyväskylä</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">[Lisää...]</a></div>
</div>

<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">Liikkeet</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Stockmann</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Prisma</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">K-kauppa</a></div>
</div>

<div class=\"menuheader\" style=\"width:195px;padding: 20 0\">
<div class=\"menu\" style=\"width:190px;padding-left: 20px;\"><a href=\"\">Valittu kategoria</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Alakategoria</a></div>
<div class=\"menu\" style=\"width:190px;padding-left: 30px;\"><a href=\"\">Alakategoria</a></div>
</div>-->
</div>
";

/*
$main = "<div id=\"main\" style=\"float: left;border: 1px solid;width: 800px;\">";
$main .= "<h1><img src=\"\" title=\"Click, to change from public to private\" style=\"width:25px;height: 25px;\">Myydään > " . $products[$id]["manufacturer"] . " " . $products[$id]["model"] . "</h1>";
$main .= "[Maapallonkuva (sijainnit+verkosto)] · Ajoneuvot (muut kategoriat + suodatinvaihtoehdot)";
$main .="<span style=\"color: #000000;text-align: left;padding-left: 10px;text: 12px bold;width: 250px;float: left;\"><input type=\"button\" id=\"fillad\" value=\"Lisää tavara\" onClick=\"view()\" /></span>";
$main .= "<div style=\"color: #000000;text-align: right;padding-right: 20px;background-color: #c0c0c0;text: 12px bold;\">Myydään · Ostetaan · Ilmaisjakelut/Vaihdetaan · Huutokauppa</div>";
$main .="View: Want list &amp; Buy/Sell it &#45; Logistics&amp;Transport &#45; <span style=\"text-decoration: underline;\">Arriving &amp; Use</span>";
$main .="<div id=\"specs\">";
$main .="<form action=\"\" method=\"POST\">";
$main .="<input type=\"submit\" style=\"float: right; margin: 5px;background-color: #0000CC; color: #FFFFFF; font-weight: bold;\" value=\" Ostajaehdokkaaksi \">";
$main .="<input type=\"hidden\" name=\"a_prospective_purchaser\"value=\"$id\">";
//$main .="<input type=\"submit\" style=\"float: right;\" value=\"Olet ostajaehdokkaana\" disabled=disabled>";
$main .="</form>";
$main .= "Kuljetus tapa: Posti | Nouto";
$main .= "Maksu: Tilisiirto | joku tekniikka";
$main .="</div>";
$main .= "</div>";
$main .= "</div>";
$main .= "</div>";
$main .= "</div>"; */

// <a onclick=\"fillAd\" href=\"\">Lisää tavara</a>";

$head = "<div id=\"main\" style=\"width: 800px;\">";
if(isset($_GET['and']) && $_GET['and'] == "compatiblewith")
{
	$head .= "Yhteensopivia osia tavaralle <b><a href=\"object.php?id=$id\">$product_topic</a></b><br/>";
	$head .= "<a href=\"object.php?id=$id\"><img src=\"\" title=\"\" style=\"width:75px;height: 75px;margin: 2 0 0 5; float: left;\"></a>";
	$head .= "<br/><br/><br/><br/>Tarkenna hakua: ";
	$head .= "<select name=\"type\">";
	$head .= "<option value=\"\">Kaikki</option>";
	$head .= "<option value=\"connector\">Liittimet</option>";
	$head .= "<option value=\"toolkit\">Työkalut</option>";
	$head .= "</select>";
	$head .= "<div style=\"color: #000000;text-align: left;padding-left: 10px;background-color: #c0c0c0;text: 12px bold;\">Tarjolla olevat tavarat</div>";
	$head .= $compatible_query;
}
else
{
//$head .= "<h1><img src=\"\" title=\"Click, to change from public to private\" style=\"width:25px;height: 25px;\">Myydään > " . $product_topic . "</h1>";
$test  =	"<div id=\"photo_uploader_popup\" class=\"popup\" style=\"display:none;\">";
$test .=	"<div class=\"popup_frame\">";
$test .=	"<h1 class=\"popup_header\">Photo Uploader</h1>";
$test .=	"<div>";
$test .=	"Select photos to upload.";
// $test .=	"<input type=\"text\" value=\"Search product, property or component\" style=\"width: 300px; height: 25px;\">";
// $test .=	"<input type=\"submit\" value=\"[O--]\" title=\"Etsi\">";
$test .=	"</div>";
$test .=	"<ul style=\"padding-left: 20px; border: 1px solid;\">";
$test .=	"</ul>";
$test .= "<div id=\"trade_agreement_content\" class=\"popup_content\" style=\"height:290px;\">";
$test .= "<form method=\"POST\" enctype=\"multipart/form-data\" />";
$test .= "<input type=\"hidden\" name=\"photo_uploader[product_id]\" value=\"$id\" />";
$test .= "<img src=\"\" style=\"width:150px;height:150px;\"><br/>";
$test .= "<input type=\"file\" name=\"photo\">";
$test .= "<input type=\"submit\">";
$test .= "</form>";
$test .= "</div>";
$test .= "<div id=\"popup\" class=\"popup_footer\">";
// $test .= "6 000 ostajaehdokasta, 14 maata. ";
$test .= "<input type=\"submit\" value=\" &times; Sulje\" onclick=\"trade_agreement_popup('photo_uploader_popup', 'close')\" style=\"float: right;\">";
// $test .= "<input type=\"submit\" value=\"Peruuta\" style=\"float: right;\">";
// $test .= "<input type=\"submit\" value=\"Myyntiin\" style=\"float: right;\">";
$test .= "</div>";
$test .= "</div>";
$test .= "</div>";

$head .= $test;
$photo_popup = "<div id=\"photo_viewer_popup\" style=\"position: absolute;z-index: 1; display:none;border: 1px solid; width: 900px; background-color: #ffffff;top: 4%; left: -2%;\">";
$photo_popup .= "<img src=\"$photo_link\" style=\"float:left;width:640px;height:480px;\"/>";
$photo_popup .= "<div style=\"width:260px;height: 480px;float:left;overflow:auto;\">";
$photo_popup .= $product_topic;
$photo_popup .= "<h1 class=\"photo_viewer_header\">Photo (Camera)</h1>";
if(!empty($photo_link))
{
	foreach(getImageInfo($photo_link) as $d => $n)
	{
		$photo_popup .= "$d => $n<br/>";
	}
	foreach(getImageXMP($photo_link) as $d => $n)
	{
		$photo_popup .= "$d => $n<br/>";
	}
}
$photo_popup .= "<h1 class=\"photo_viewer_header\">Touring &amp; Services</h1>";
$photo_popup .= "Tourism?<br/>";
$photo_popup .= "Location: Lapland<br/>";
$photo_popup .= "Hotels: Lapland<br/>";
$photo_popup .= "Attractions: Korvatunturi<br/>";
$photo_popup .= "<h1 class=\"photo_viewer_header\">You may need</h1>";
$photo_popup .= "Clothes: Umbrella<br/>";
$photo_popup .= "Permit: <a href=\"\">Passport</a><br/>";
$photo_popup .= "Permit: <a href=\"\">Inoculation</a><br/>";
$photo_popup .= "Travel: <a href=\"\">Package Tour</a><br/>";
$photo_popup .= "Travel: <a href=\"\">Package Holiday</a><br/>";
$photo_popup .= "Travel: <a href=\"\">All-in Tour</a><br/>";
$photo_popup .= "<h1 class=\"photo_viewer_header\">Stuff tagged</h1>";
$photo_popup .= "[Metsä] [Taivas] [Hiekka] [Mitsubishi Pajero]<br/>";
$photo_popup .= "<input type=\"button\" onclick=\"start_menu('photo_viewer','hidden');\" value=\"close\">";
$photo_popup .= "</div>";
$photo_popup .= "</div>";
$head .= $photo_popup;
// $head .= "<div id=\"photo_popup\" onmouseover=\"start_menu('photo','view');\" onmouseout=\"start_menu('photo','hidden');\" style=\"position: absolute;z-index: 1; display:none;border: 1px solid; width: 200px; height: 20px;background-color: #ffffff;top: 4%; left: 5%;\">
// <h1 style=\"font: 14px Arial; font-weight:bold;\"><a href=\"javascript:void(0);\" onclick=\"trade_agreement_popup('photo_uploader_popup', 'open')\">+ Add photo</a></h1>
// </div>";
// $head .= "<h1><img src=\"$photo_link\" onClick=\"start_menu('photo_viewer','view');\" onmouseover=\"start_menu('photo','view');\" onmouseout=\"start_menu('photo','hidden');\" title=\"Click, to change from public to private\" style=\"width:125px;height: 125px;margin: 5 0 0 5; float: left;\">";
// $head .= "<div style=\"padding: 0 0 0 0;\">" . $product_topic . "</div>";
$head .= "<div style=\"overflow:auto;\">";
for($p=0;$p<8;$p++)
{
	$head .= "<img src=\"\" title=\"Click, to change from public to private\" style=\"width:95px;height:95px;margin: 18 0 0 5; float: left;\">";
}
// $head .= "<img src=\"\" title=\"Click, to change from public to private\" style=\"width:95px;height:95px;margin: 18 0 0 5;\">";
$head .= "</div>";
$head .= "</h1>";

/*
$head .= "[Maapallonkuva (sijainnit+verkosto)] · Ajoneuvot (muut kategoriat + suodatinvaihtoehdot)";
 #A4D3EE - ruma sinisävy */
 
//$head .="<div style=\"color: #000000;text-align: left;padding-left: 20px;text: 12px bold;width: 250px;float: left;\"><input type=\"checkbox\"><input type=\"button\" value=\"Valitse\"> · Toimenpide</div>";


/*
$head .="<span style=\"color: #000000;text-align: left;padding-left: 10px;text: 12px bold;width: 250px;float: left;\"><input type=\"button\" id=\"fillad\" value=\"Lisää tavara\" onClick=\"view()\" /></span>";
$head .= "<div style=\"color: #000000;text-align: right;padding-right: 20px;background-color: #c0c0c0;text: 12px bold;\">Myydään · Ostetaan · Ilmaisjakelut/Vaihdetaan · Huutokauppa</div>";
$head .="View: Want list &amp; Buy/Sell it &#45; Logistics&amp;Transport &#45; <span style=\"text-decoration: underline;\">Arriving &amp; Use</span>";
*/


// $head .= "<br/>Viime käyntisi jälkeen on tullut uusia tuotteita";
// $head .= "<br/>Lähialueeltasi <a href=\"\">Joutsa</a> ei löydy liikettä. <a href=\"\">Kutsu liike mukaan</a>. (Tee nyt lisää toimintoja, innovoinnit myöhemmin.)";
// $head .= "<form action=\"object.php\">";
// $head .= "<input type=\"hidden\" name=\"email\" value=\"$email\" />";
// $head .= "<input type=\"hidden\" name=\"password\" value=\"$password\" />";
// $head .= "Sijainti: <input type=\"text\" name=\"productlocation\"><br/>";
// $head .= "Merkki: <input type=\"text\" name=\"productmanufacturer\"><br/>";
// $head .= "Malli: <input type=\"text\" name=\"productmodel\"><br/>";
// $head .= "Vuosi: <input type=\"text\" name=\"productyear\"><br/>";
// $head .= "<input type=\"submit\" value=\"Lisää\">";
// $head .= "</form>";
//$head .= "<div id=\"header\">$stats<br/>";

/* Trade messages */
$visibility_list  = "<select>";
$visibility_list .= "<option>Visibility: </option>";
$visibility_list .= "<option>Only Me</option>";
$visibility_list .= "<option>For sale: Sell</option>";
$visibility_list .= "</select>";
$trade_agreement_view  = "<div style=\"overflow:auto;\">";
$trade_agreement_view .= "<h3 style=\"clear: left;float:left;\"><a href=\"javascript:void(0);\" onclick=\"start_menu('product_label','view');\" style=\"text-decoration:none;color:black;\">Trade Info</a><span style=\"margin:-5 0 5 -5;background-color:red;font-size: 16px;\">5</span></h3>";
// $trade_agreement_view .= "<div class=\"round_corner\" style=\"width: 250px;border:2px inset;overflow:auto;float:left;margin: 5px;\"><h4>Who Wants Product</h4>";
// $trade_agreement_view .= "</div>";
// $trade_agreement_view .= "<div class=\"round_corner\" style=\"width: 250px;border:2px inset;overflow:auto;float:left;margin: 5px;\"><h4>Prospective Purchasers ($purchaser_count)</h4>";
// $trade_agreement_view .= "$purchasers</div>";
// $trade_agreement_view .= "<div class=\"round_corner\" style=\"width: 250px;border:2px inset;overflow:auto;float:left;margin: 5px;\"><h4>Suggestions for trade</h4>";
// $trade_agreement_view .= "</div>";
$trade_agreement_view .="<li style=\"float:left;width:140px; margin: 0 0 0 5;\"><a href=\"\">(Num) Wants Product</a></li>";
$trade_agreement_view .="<li style=\"float:left;width:190px;\"><a href=\"\">(Num) Prospective Purchasers</a></li>";
$trade_agreement_view .="<li style=\"float:left;width:190px;\"><a href=\"\">(Num) Suggestions for trade</a></li>";
$trade_agreement_view .="<li style=\"float:left;\">$visibility_list</li>";
$trade_agreement_view .= "</div>";
$head .= $trade_agreement_view;
$head .= "<div id=\"product_label_popup\" style=\"background-color: orange;margin: 5 5; padding: 2 5;display:none;\">You are <a href=\"object.php?id=$id\">$product_topic</a>'s owner. Right of return is 14 days (Bought 1 day ago). <a href=\"object.php?id=$id&amp;change_state=return\">Return<a>. <a href=\"\" style=\"float: right; margin-right: 5px;font-weight: bold;\">Hidden</a><hr/>";

// $head .= "<div style=\"background-color: orange;margin: 5 5; padding: 2 5;\">Product is sold to Estonia (since unavailable for you). Buyer is <a href=\"object.php?id=$id\">grateful for the trading</a>. <a href=\"object.php?id=$id&amp;change_state=\">Undo<a>. <a href=\"\" style=\"float: right; margin-right: 5px;font-weight: bold;\">Hidden</a></div>";

// $head .= "<div style=\"background-color: orange;margin: 5 5; padding: 2 5;\">This product is compatible with <b>Part</b>. <a href=\"object.php?id=$id&amp;partof=$id\">Add product as part<a>.";
// $head .= "<div style=\"background-color: orange;margin: 5 5; padding: 2 5;\">This product is compatible with <a href=\"javascript:void(0);\" onClick=\"standard_part('$product_id');\"><b>Standard Part (NaN)</b></a> and <a href=\"javascript:void(0);\" onClick=\"standard_part('$product_id');\"><b>Add-on Part (NaN)</b></a>.";
$head .= "This product is compatible with <a href=\"javascript:void(0);\"  onClick=\"trade_agreement_popup('popup', 'open');\"><b>Standard Part (NaN)</b></a> and <a href=\"javascript:void(0);\"  onClick=\"trade_agreement_popup('popup');\"><b>Add-on Part (NaN)</b></a>.";
$head .= "<a href=\"\" style=\"float: right; margin-right: 5px;font-weight: bold;\">Hidden</a><br/>";
$head .= "<div id=\"compatible_suggest\">$compatible_suggest</div>";
$head .= "</div>";
//$head .= "<input type=\"button\" value=\" +Owner/Myynnissä/Vaihdetaan.../Annetaan/Lahjoitetaan/Huutokaupataan/Kierrätykseen/Takuuseen \" style=\"float: right;margin: 4 7 \">";
$head .= $proprietor;
$head .= "$product";
$head .= "</div>";
$head .= "</div>";
$head .= "</div>";
}
$head .= "</div>";
//$head .= "</div>";

$column  = "<div id=\"right\" style=\"width: 280px;float: right;padding-top: 10px; margin: 0 10 0 0;\">";
if(isset($_GET['and']) && $_GET['and'] == "compatiblewith")
{
	$column .= "<h1 class=\"element-spotlightrightpanel\">Groups</h1> <!-- Seuroilta yms. -->";
	$column .= "<h1 class=\"element-spotlightrightpanel\">Private</h1> <!-- Yksityisiltä saatavat tuotteet -->";
}
else
{
	// $column .= "<h1 class=\"element-spotlightrightpanel\">Upcoming Notices</h1> <!-- Ilmoitukset -->";
	// $column .= "[Ajoneuvo] katsastusaika on [Aika].<br/>";
	// $column .= "[Tuote] takuuaika päättyy [Aika].<br/>";
	// $column .= "[Asunto] vuokramaksu viimeistään [Aika].<br/>";
	// $column .= "<h1 class=\"element-spotlightrightpanel\">Outgoing Transfers <a href=\"transfer.php#outgoing\" style=\"float: right;\">View all</a></h1> <!-- Lähtevät tilaukset -->";
	// $column .= "<h1 class=\"element-spotlightrightpanel\">Ingoing Transfers <a href=\"transfer.php#ingoing\" style=\"float: right;\">View all</a></h1> <!-- Saapuvat tilaukset -->";
	//$column .= "<h1 class=\"element-spotlightrightpanel\">Transfers <a href=\"transfer.php\" style=\"float: right;\">View all</a></h1> <!-- Tilaukset -->";
	//$column .= "<span style=\"background-color: #FF0000\">Lähtevä</span><br/>";
	//$column .= "<span style=\"background-color: #32CD32\">Saapuva</span><br/>";
	// $column .= "<h1 class=\"element-spotlightrightpanel\">Cart</h1> <!-- Ostoskori -->";
	// $column .= "<h1 class=\"element-spotlightrightpanel\">Compare</h1> <!-- Vertailu -->";
	$column .= "<h1 class=\"element-spotlightrightpanel\">$present_manufacturer's Competitors</h1> <!-- Other Manufacturers -->";
	$column .= "$manufacturer_list";
	$column .= "<h1 class=\"element-spotlightrightpanel\">$present_manufacturer's Products</h1> <!-- Other Products by [Manufacturer]/Other models by manufacturer -->";
	$column .= "$other_product_list";
	$column .= "<h1 class=\"element-spotlightrightpanel\">Similar Products</h1> <!-- Similar Products -->";
	$column .= "$similar_product_list";
	// $column .= "<h1 class=\"element-spotlightrightpanel\">Wanted</h1> <!-- (Muut ihmiset haluaa jotain) Halutaan -->";
	// $column .= "$cart";
	// $column .= "<h1 class=\"element-spotlightrightpanel\">Standards Included</h1> <!-- Sisältää vakiovarusteen -->";
	// $column .= "<div id=\"standard_component_included\"></div>";
	// $column .= "<h1 class=\"element-spotlightrightpanel\">Add-Ons Included</h1> <!-- Sisältää lisäosan -->";
	// $column .= "<h1 class=\"element-spotlightrightpanel\">A Standard Part of</h1> <!-- Vakio-osa (kuuluu) johonkin -->";
	// $column .= "<h1 class=\"element-spotlightrightpanel\">An Add-On of</h1> <!-- Lisäosa johonkin -->";
	$column .= "<h1 class=\"element-spotlightrightpanel\">Part of</h1> <!-- Kuuluu johonkin -->";
	$column .= "$part_of_list";
	$column .= "<h1 class=\"element-spotlightrightpanel\">Included</h1> <!-- Sisältää osan -->";
	$column .= "<div id=\"standard_component_included\">$included_items</div>";
	$column .= "<h1 class=\"element-spotlightrightpanel\">Compatible with <a href=\"object.php?id=$id&amp;and=compatiblewith\" style=\"float: right;\">View all</a></h1> <!-- Yhteensopiva -->";
	$column .= $compatible_goodies;
	$column .= "<div id=\"compatible_result\">$compatible_result</div>";
	$column .= "<h1 class=\"element-spotlightrightpanel\">Similar parts with</h1> <!-- Samoja osia kuin -->";
	$column .= "Search by Components, part of name, picture, material, features, environment";
	$column .= "<h1 class=\"element-spotlightrightpanel\">Recommended for</h1> <!-- Suositeltava johonkin / esim. tämän yhteyteen suositeltavia ruokia -->";
	$column .= "Mihin tarkoitukseen / käyttökohde. Mihin käyttöön asia soveltuu. \"luettelo eri caseista\"";
}
$column .= "</div>";

$mainwindow  = $navi;
$mainwindow .= "<div id=\"mainwindow\" style=\"margin:0;border: 1px solid;width: 1110px;float: left;\">";
// $mainwindow .= "<div id=\"mainwindow\" style=\"margin:0;border: 1px solid;width: 1110px;float: left;position: relative;left:10%;\">";
$mainwindow .= $column;
$mainwindow .= $head;
$mainwindow .= "</div>";
print $mainwindow;

/*
$mainwindow = "<div id=\"mainwindow\" style=\"margin:0;border: 1px solid;margin-left: 20px;\">";
$mainwindow .= $navi;
//$mainwindow .= $head;
$mainwindow .= $main;
$mainwindow .= "</div>";
print $mainwindow;
*/

/***
	Database connections
***/

 
/* database communication */

/**
	First we want all FUCKING NEEDED DATA from 'shipshop' database, so we complete it before start HTML-language
	THIS PHP DATA NEEDS space from line 30 to line 112, after it HTML-language will start on line 113.
**/

// Connect to database

		//$dbhost = 'ip_address:3306'; /* host */ $dbuser = 'username'; /* your username created */ $dbpass = 'password';//'password'; //the password 4 that user
		#$dbhost = 'localhost'; /* host */ $dbuser = 'root'; /* your username created */ $dbpass = '';//'password'; //the password 4 that user
		
		//$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
		
		//$dbname = 'database_name';
		//mysql_select_db($dbname);//your database.*/



// Database


	//$query = "INSERT INTO course VALUES ('1','Ohjelmointitekniikan koulutusohjelma','HTML-kieli', 'English', 'Finnish', '', '30')";

	// mysql_query($query);

	// $query = "UPDATE course SET ('','Ohjelmointitekniikan koulutusohjelma','MySQL Tietokannat')";

	//mysql_query($query);
// Database
//$query="SELECT * FROM account";
// $query="SELECT * FROM account WHERE email='$email'";
// $result=mysql_query($query);
// $num=mysql_numrows($result);


// mysql_close();

// $i=0;
// while ($i < $num) {

// $accountid = mysql_result($result,$i,"accountid");
// $email = mysql_result($result,$i,"email");
// $password = mysql_result($result,$i,"password");
// $name = mysql_result($result,$i,"name");
// $lastname = mysql_result($result,$i,"lastname");

//$products[] = "$productname";
//print $accountid. " " .$email. " " . $password. " " .$name. " " .$lastname."<br/>";

// $i++;
// }

mysql_close();
?>
<script type="text/javascript">
function baby_monitor(profile)
{
	var profile = profile;
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
		//var baby_monitor = xmlhttp.responseText.split("\r\n"); // pick a data from url
		var baby_monitor = xmlhttp.responseText; // pick a data from url
		//document.getElementById("test").value="1: "+baby_monitor[0]+"<br/>"; // pick a data from url
		document.getElementById("test").innerHTML ="1: "+baby_monitor+"<br/>"; // pick a data from url
		//document.getElementById("test").innerHTML ="2: "+baby_monitor[1]+"<br/>"; // pick a data from url
		}
	}
	//data="data="+data;
	data="baby_monitor_for="+profile;
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
}

// confirm_event('accept_buyer', '$id', '$product_id');
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

// function connection_menu(view)
function connection_menu()
{
	// var view = view;
	var selectBox = document.getElementById("connection_menu_select");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	var view = selectedValue;
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
		var content = xmlhttp.responseText.split("\r\n"); // pick a data from url
		document.getElementById("popup_menu").innerHTML = content[0]; // pick a data from url
		document.getElementById("trade_agreement_content").innerHTML = content[1]; // pick a data from url
		}
	}
	//data="data="+data;
	data="connection_menu="+view;
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
}

// function add_as_part(product_id, part_id, datetime, manufacturer, model)
function change_component_status(status, product_id, part_id, datetime, manufacturer, model)
{
	var mode_status = status;
	var product_id = product_id;
	var part_id = part_id;
	var datetime = datetime;
	var manufacturer = manufacturer;
	var model = model;
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
		var item = xmlhttp.responseText.split("\r\n"); // pick a data from url
		// document.write(xmlhttp.responseText);
		//document.getElementById("product_details").value=baby_monitor; // pick a data from url
		// document.getElementById(element).value=baby_monitor; // pick a data from url
		// var compatible_suggest = document.getElementById("compatible_suggest");
		// var part = document.getElementById(item[0]);
		// compatible_suggest.removeChild(part);
		// insertBefore(item[1],document.getElementById("standards_included").firstChild);
		// document.write(item[1]);
		// $part .= "<a id=\"$datetime\" href=\"object.php?id=$part_id\" onClick=\"release_part('$product_id', '$part_id');\" style=\"width:76px;\"><img src=\"\" style=\"width: 75px; height: 75px;\" title=\"Release $manufacturer $model\"/></a>";
			if(item[0] == "add_as_part")
			{
				var content = document.createElement("a");
					content.setAttribute("id", item[1]);
					// content.setAttribute("href", "object.php?id="+item[3]);
					content.setAttribute("onClick", "change_component_status('release_part','"+item[2]+"', '"+item[3]+"', '"+item[1]+"', '"+item[5]+"', '"+item[6]+"');");
					content.style.width = 50+'px';
					content.innerHTML = item[4];
				// document.getElementById("standard_component_included").innerHTML=item[1];
				// document.getElementById("standard_component_included").appendChild(content);
				var from_suggest = document.getElementById("compatible_suggest");
				var from_result = document.getElementById("compatible_result");
				var to = document.getElementById("standard_component_included");
				var suggest_component_id = document.getElementById("suggest_"+item[1]);
				var result_component_id = document.getElementById("result_"+item[1]);
				to.insertBefore(content, to[0]);
				from_suggest.removeChild(suggest_component_id);
				from_result.removeChild(result_component_id);
			}
			if(item[0] == "release_part")
			{
				var result = document.createElement("a");
					result.setAttribute("id", item[1]);
					result.setAttribute("href", "object.php?id="+item[3]);
					result.setAttribute("onClick", "change_component_status('add_as_part','"+item[2]+"', '"+item[3]+"', '"+item[1]+"', '"+item[6]+"', '"+item[7]+"');");
					result.style.width = 50+'px';
					result.innerHTML = item[4];
				var suggest = document.createElement("a");
					suggest.setAttribute("id", item[1]);
					suggest.setAttribute("href", "object.php?id="+item[3]);
					suggest.setAttribute("onClick", "change_component_status('add_as_part','"+item[2]+"', '"+item[3]+"', '"+item[1]+"', '"+item[6]+"', '"+item[7]+"');");
					suggest.style.width = 75+'px';
					suggest.innerHTML = item[5];
				// document.getElementById("standard_component_included").innerHTML=item[1];
				// document.getElementById("standard_component_included").appendChild(content);
				var from = document.getElementById("standard_component_included");
				var to_suggest = document.getElementById("compatible_suggest");
				var to_result = document.getElementById("compatible_result");
				var component_id = document.getElementById(item[1]);
				from.removeChild(component_id);
				to_result.insertBefore(result, to_result[0]);
				to_suggest.insertBefore(suggest, to_suggest[0]);
				
			}
		}
	}
	//data="data="+data;
	data="mode_status="+mode_status+"&part_id="+part_id+"&product_id="+product_id+"&datetime="+datetime+"&manufacturer="+manufacturer+"&model="+model;
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
}

//function update_information(\'$idprofile\', \'$id\', \'$key\', \'$value\')
function update_information(status, profile_id, product_id, product_property_name, product_property_value)
{
	var status = status;
	var profile_id = profile_id;
	var product_id = product_id;
	var product_property_name = product_property_name;
	var product_property_value = product_property_value;
	
	var element = "update_information+"+product_id+"+"+product_property_name;
	//update_information_$id_$key
	
	//var value = newproduct.elements["product_offer"].value;
	
	//var value = elements[element].value;
	var value = document.getElementById(element).value;
	//var value = elements["update_information+"+product_id+"+"+product_property_name+""].value;
	
	//document.write("profile: "+profile_id);
	//document.write("profile: "+value);
	//document.write("profile: "+profile_id+", product: "+ product_id+", property_name: "+product_property_name+"value: "+value);
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
		var baby_monitor = xmlhttp.responseText; // pick a data from url
		//document.getElementById("product_details").value=baby_monitor; // pick a data from url
		document.getElementById(element).value=baby_monitor; // pick a data from url
		}
	}
	//data="data="+data;
	data="update_information="+status+"&profile_id="+profile_id+"&product_id="+product_id+"&product_property_name="+product_property_name+"&product_property_value="+value;
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
}

function update_proprietor_status(user_id, product_id, state)
{
	//var data = input_value();	
	//var data = selected_status();
	
	var user_id = user_id;
	var product_id = product_id;
	var product_state = state;
	//document.write(product_status+" &amp; "+product_id);
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
		// document.write(baby_monitor[0]); // pick a data from url
		document.getElementById("sample_attach_menu_parent").value=baby_monitor[0]; // pick a data from url
		//document.getElementById("test").innerHTML=baby_monitor[0]; // pick a data from url
		document.getElementById("sample_attach_menu_child").innerHTML =baby_monitor[1]; // pick a data from url
		// document.write(baby_monitor[2]); // pick a data from url
		document.getElementById("product_label_popup").innerHTML =baby_monitor[2]; // pick a data from url
		//document.getElementById("test").innerHTML+="3: "+baby_monitor[2]+"<br/>"; // pick a data from url
		//document.getElementById("test").innerHTML+="4: "+baby_monitor[3]+"<br/>"; // pick a data from url
		//document.getElementById("test").innerHTML+="5: "+baby_monitor[4]+"<br/>"; // pick a data from url
		//document.getElementById("test").innerHTML=xmlhttp.responseText; // pick a data from url
		}
	}
	//data="data="+data;
	data="state="+product_state+"&product_id="+product_id+"&user_id="+user_id;
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
	
}

function proprietor_state(id, state, product)
{
	//var options = "<form action=\"\" method=\"get\">";
	var options = "";
	// $product_topic
	switch(state)
	{
		case "product":
		{
			options += "Tuoteinfoa "+product+"<br/>";
			options += "Ostettu {pvm}<br/>";
			options += "600 muulla ihmisellä on sama tuote";
			break;
		}
		case "sell":
		{
			options += "Myy <br/>";
			options += "<input type=\"hidden\" name=\"product[id]\" value=\""+product+"\">";
			options += "<input type=\"hidden\" name=\"product[state]\" value=\""+state+"\">";
			options += "Following people needs this product:";
			options += "<a href=\"\">View all (x)</a>";
			options += "Price (€)";
			options += "<input type=\"text\" name=\"price\">";
			options += "<input type=\"submit\" name=\"\" onClick=\"update_proprietor_status('"+id+"', '"+product+"', '"+state+"')\" value=\"Myyntiin\">";
			//options += "<input type=\"submit\" name=\"\" value=\"Myyntiin\">";
			break;
		}
		case "change":
		{
			options += "Vaihda toiseen tuotteeseen "+product+"<br/>";
			options += "<input type=\"hidden\" name=\"product[id]\" value=\""+product+"\">";
			options += "<input type=\"hidden\" name=\"product[state]\" value=\""+state+"\">";
			options += "Following people needs this product:";
			options += "<a href=\"\">View all (x)</a>";
			options += "What you need? <input type=\"text\" name=\"change_for\">";
			break;
		}
		case "give":
		{
			options += "Anna ilmaiseksi "+product+"<br/>";
			options += "<input type=\"hidden\" name=\"product[id]\" value=\""+product+"\">";
			options += "<input type=\"hidden\" name=\"product[state]\" value=\""+state+"\">";
			options += "Following people needs this product:";
			options += "<a href=\"\">View all (x)</a>";
			options += "<input type=\"submit\" value=\"Anna tuote\">";
			break;
		}
		case "donate":
		{
			options += "Lahjoita "+product+"<br/>";
			options += "<input type=\"hidden\" name=\"product[id]\" value=\""+product+"\">";
			options += "<input type=\"hidden\" name=\"product[state]\" value=\""+state+"\">";
			options += "Following organization needs this product:";
			options += "<a href=\"\">View all (x)</a>";
			options += "<input type=\"submit\" value=\"Lahjoita\">";
			break;
		}
		case "auction":
		{
			options += "Huutokauppa "+product+"<br/>";
			options += "<input type=\"hidden\" name=\"product[id]\" value=\""+product+"\">";
			options += "<input type=\"hidden\" name=\"product[state]\" value=\""+state+"\">";
			options += "About 30 organization needs this product:";
			options += "<input type=\"submit\" value=\"Aloita huudatus\">";
			break;
		}
		case "recycle":
		{
			options += "Kierrätä "+product+"<br/>";
			options += "<input type=\"hidden\" name=\"product[id]\" value=\""+product+"\">";
			options += "<input type=\"hidden\" name=\"product[state]\" value=\""+state+"\">";
			options += "About 30 recycle place available:";
			options += "<input type=\"submit\" value=\"Kierrätä\">";
			break;
		}
		case "warranty":
		{
			options += "warranty "+product+"<br/>";
			options += "<input type=\"hidden\" name=\"product[id]\" value=\""+product+"\">";
			options += "<input type=\"hidden\" name=\"product[state]\" value=\""+state+"\">";
			options += "About 15 days left for this product:";
			options += "<input type=\"submit\" value=\"Vie takuuseen\">";
			break;
		}
		case "repair":
		{
			options += "repair "+product+"<br/>";
			options += "<input type=\"hidden\" name=\"product[id]\" value=\""+product+"\">";
			options += "<input type=\"hidden\" name=\"product[state]\" value=\""+state+"\">";
			options += "About 30 organization available:";
			options += "<input type=\"submit\" value=\"Vie huoltoon\">";
			break;
		}
		case "reclamation":
		{
			options += "reclamation "+product+"<br/>";
			options += "<input type=\"hidden\" name=\"product[id]\" value=\""+product+"\">";
			options += "<input type=\"hidden\" name=\"product[state]\" value=\""+state+"\">";
			options += "Kuvaa ongelma:";
			options += "<input type=\"text\" name=\"reclamation_description\" />";
			options += "<input type=\"submit\" value=\"Reklamoi tuote\">";
			break;
		}
		default:
		{
			options += "Tuoteinfoa "+product+"<br/>";
			options += "Ostettu {pvm}<br/>";
			options += "600 muulla ihmisellä on sama tuote";
			break;
		}
	}
		//options += "</form>";
	document.getElementById("sale_options").innerHTML=options;
}

</script>