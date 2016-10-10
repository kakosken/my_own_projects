<?php
include_once 'ss_config.php';

if(isset($_POST["product"]))
{
	$idprofile = $_SESSION["stuffwalk_profile"];
	$product = $_POST["product"];
	if(isset($_FILES["picture"]))
		$picture = $_FILES["picture"];
	if(!isset($_FILES["picture"]))
		print "Problem detected under handling photo!";
	\Shopstream\Bookkeeping::add_product($product, $idprofile, $picture);
}
elseif(isset($_POST['delete']))
{
	$delete = $_POST['delete'];
	\Shopstream\Bookkeeping::delete_product($delete);
}
\Shopstream\bookkeeping::Window($meta, $explorer, $navigation, $head, $column);


/*
 * Directory Tree
 * 
 * 
 */

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
	$this_profile = $_SESSION["stuffwalk_profile"];
	$rows = mysql_query("SELECT * 
						FROM product_info pi, profile p
						WHERE pi.use_of='In_Use' and pi.idproduct1=p.data_object 
						and p.idprofile1='$this_profile'");
	
	while($input = mysql_fetch_assoc($rows))
	{
		$inputs[] = $input;
	}
	$trees = sort_items_into_tree($inputs);
	
	$directory_tree  = "";//"<div id=\"directory_tree_model\">";
	//$directory_tree .= "Directory Tree";
	$tree_wide = 800;
	$stuff_per_row = 5;
	$bmi= 1; // border-margin-index
	$photo_width = ($tree_wide-$stuff_per_row*$bmi)/$stuff_per_row;
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
		$directory_tree .= "<a href=\"javascript:void(0);\" onclick=\"market_scouting_popup(\'".$_SESSION['stuffwalk_profile']."\',\'".$b['idproduct1']."\',\'\',\'my_library\',\'open\');\" style=\"color: grey; font-weight: normal;text-decoration:none;\" title=\"Last upgraded: ".date(DATE_RFC822)."\">Upgraded a moment ago (5 new upgrades)</a> ";
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
	//$directory_tree .= "</div>";
return $directory_tree;
}
$index ="";
$directory_tree = directory_tree($index);
		
/*
	Tyhjään storageen alku-look
	[Mobile Device] [Device] [Vehicle] [Property/Home] [Furniture]
*/

/*
 * Ostajaehdokkaista ilmoitus
 * 
 * 
 * 	
 */
		
		$query="SELECT * FROM `profile` WHERE `data_name` LIKE 'a_prospective_purchaser'";
		$a_prospective_purchaser_result=mysql_query($query);
		$purchaser_num=mysql_numrows($a_prospective_purchaser_result);
		$purchaser_count = 0;
		
		$prospective_purchasers = Array();
		for($purchaser_count; $purchaser_count < $purchaser_num; $purchaser_count++)
		{
			$purchaser_id = mysql_result($a_prospective_purchaser_result,$purchaser_count,"idprofile1");
			$time = mysql_result($a_prospective_purchaser_result,$purchaser_count,"datetime");
			$object_id = mysql_result($a_prospective_purchaser_result,$purchaser_count,"data_object");
			$prospective_purchasers[$purchaser_id]["object_id"] = $object_id;
			//$prospective_purchasers[$time][$object_id]["purchaser_id"] = $purchaser_id;
		}
		
		$prospective_purchasers_list = '<form action=\"showcase.php\" method=\"post\">';
		$cart = '';
		
		foreach($prospective_purchasers as $key => $value)
		{
			$query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$key' AND `data_name` LIKE 'firstname'";
			$person=mysql_query($query);
			$pid=mysql_numrows($person);
			$purchaser_firstname = mysql_result($person,0,"data_value");
			$query="SELECT * FROM `profile` WHERE `idprofile1` LIKE '$key' AND `data_name` LIKE 'lastname'";
			$person=mysql_query($query);
			$pid=mysql_numrows($person);
			$purchaser_lastname = mysql_result($person,0,"data_value");
			$joo = $prospective_purchasers[$key]["object_id"];
			$query="SELECT * FROM `product` WHERE `idproduct1` LIKE '$joo' AND `data_name` LIKE 'manufacturer'";
			$p=mysql_query($query);
			$manufacturer = mysql_result($p,0,"data_value");
			$query="SELECT * FROM `product` WHERE `idproduct1` LIKE '$joo' AND `data_name` LIKE 'model'";
			$p=mysql_query($query);
			$model = mysql_result($p,0,"data_value");
			// $query="SELECT * FROM `product` WHERE `idproduct1` LIKE '$joo' AND `data_name` LIKE 'specification'";
			// $p=mysql_query($query);
			// $specification = mysql_result($p,0,"data_value");
			//print "\$key =". $key . " ja \$idprofile =". $idprofile;
			if($key != $idprofile)
			{
			$prospective_purchasers_list .= "<input type=\"hidden\" name=\"owner_id\" value=\"$key\">";
			$prospective_purchasers_list .= "<span style=\"margin: 5px;\"><b><a href=\"profile.php?id=$key\" style=\"text-decoration: none;\">". $purchaser_firstname ." ". $purchaser_lastname ."</a></b> on ostamassa tuotetta <b><a href=\"object.php?id=$joo\" style=\"text-decoration: none;\">".$manufacturer . " " . $model . "</a></b>.</span> <input type=\"submit\" value=\" Peruuta \" style=\"float: right;margin: 5px; border-color: #FFFFFF; background-color: #FFFFFF; color: #0000CC;  font-weight: bold;  \"/><input type=\"submit\" value=\"    Myy    \" style=\"float: right;margin: 5px; background-color: #0000CC; color: #FFFFFF; font-weight: bold;\"/> <!-- value=\" Hyväksy \" border-color: #0033FF; -->";
			$prospective_purchasers_list .="<hr style=\"margin-top: 15px;\"/>";
			
			
			//$storage .="<a href=\"object.php?id=$joo\">$manufacturer $model $specification</a><br/>";
			}
			if($key == $idprofile)
			{
				$cart .="<a href=\"object.php?id=$joo\" style=\"text-decoration: none;\" title=\"$manufacturer $model\" ><div class=\"cart_product\" style=\"width:50px;height:50px;border: 1px solid;margin: 5px;\"></div></a>";
			}
			
		}
		$prospective_purchasers_list .= "</form>";
		

	$test  =	"<div id=\"popup\" class=\"popup\">";
	$test .=	"<div id=\"popup\" class=\"popup_frame\">";
	$test .=	"<h1 class=\"popup_header\">Categories</h1>";
	$test .=	"<div>";
	$test .=	"<input type=\"text\" value=\"Search product, property or component\" style=\"width: 300px; height: 25px;\">";
	$test .=	"<input type=\"submit\" value=\"[O--]\" title=\"Etsi\">";
	$test .=	"<label style=\"float: right; margin: 0 5 0 0;\">";
	$test .=	"Puuttuuko jotain? <a href=\"suggest_product();\">Ehdota tuotevalikoimaa</a>";
	$test .=	"</label>";
	$test .=	"</div>";
	// $test .=	"<ul style=\"padding-left: 20px; border: 1px solid;\">";
	$test .=	"<ul id=\"popup_menu\" style=\"border: 1px solid;\">";
	$test .=	"<select id=\"connection_menu_select\" name=\"connection_o\" style=\"float: left; background-color: #CECECE; font-weight: bold;\" onChange=\"connection_menu();\">";
	$test .=	"<option value=\"similar\" onClick=\"connection_menu('similar_product');\">The general</option>";
	$test .=	"<option value=\"includes\" onClick=\"connection_menu('includes');\">Art</option>";
	$test .=	"<option value=\"includes\" onClick=\"connection_menu('includes');\">Media</option>";
	/*
	$test .=	"<option value=\"part_of\" onClick=\"connection_menu('part_of');\">Books</option>";
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Movies</option>";
	*/
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Cameras</option>";
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Phones</option>";
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Dressing</option>";
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Computers</option>";
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Consumer Electronics</option>";
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Crafts</option>";
	
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Vehicles</option>";
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\">Musical Instruments</option>";
	$test .=	"<option value=\"compatible\" onClick=\"connection_menu('compatible');\"><img src=\"\" style=\"width:25px;height:25px;\" />Perfume, Jewelry &amp; Watches</option>";
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
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your interest\" style=\"text-decoration: none;\">Maa</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_accept_buyer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your accepting\" style=\"text-decoration: none;\">Vesi</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_payment")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your paying\" style=\"text-decoration: none;\">Ilma</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_transfer")
			{
			$test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your transforming\" style=\"text-decoration: none;\">Sekalaiset</a></li>";
			}
			if($trade_agreement_collection[$complete] == "trade_agreement_valid_status_confirm_receiving")
			{
			// $test .=	"<li style=\"float: left; width: 125px;\"><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your receiving\" style=\"text-decoration: none;\">Add-Ons Included</a></li>";
			$test .=	"<li><a href=\"javascript:void(0);\" onClick=\"trade_agreement('$idprofile','$trade_agreement_collection[$complete]');\" title=\"3 products waiting your receiving\" style=\"text-decoration: none;\">Nähtävyydet</a></li>";
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
	$test .= "<div id=\"trade_agreement_content\" class=\"popup_content\" style=\"overflow: auto;\">";
	$names = Array("Auto", "Moottoripyörä", "Mopo", "Polkupyörä", "Potkulauta");
	$pox = count($names);
	$sr  = "";
	$sr .=	"<h2 style=\"margin: 0 0 0 10; border-bottom: 1px solid;\">Autot</h2>";
	for($go=0;$go < $pox; $go++)
	{
	$sr .=	"<div class=\"transform\" style=\"padding: 5px; width: 85px; height: 95px; float: left;\">";
	$sr .=	"<a href=\"\"><img src=\"\" style=\"width:80px; height: 80px; float: left;\">";
	$sr .=	"$names[$go]</a>";
	$sr .=	"</div>";
	}
	$sr .=	"<h2 style=\"margin: 0 0 0 10; border-bottom: 1px solid;\">Autojen varaosat</h2>";
	$test .= $sr;
	$test .= "</div>";
	
	
	$test .= "<div id=\"popup\" class=\"popup_footer\">6 000 osaa, 14 maata. ";
	$test .= "<input type=\"submit\" value=\" &times; Sulje\" style=\"float: right; \">";
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
	$test .=	"<style type=\"text/css\">
  .popup {
    width:1024px;
    height:420px; /* 620px; */
    position:fixed;
	z-index: 1;
	opacity: 1;
    top:15%;
    left:20%;
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
print "
<script type=\"text/javascript\">			
	
	var area = document.getElementById(\"producttopic\");";

	print " var storage = '".$storage."';";
	print " var directory_tree = '".$directory_tree."';";
	print "	
		var topic_list = '';
		topic_list += \"<div id=\\\"most_used\\\" style=\\\"\\\">\";		
		topic_list += \"<h3 style=\\\" height:22px; background-color:#c0c0c0;\\\"><span style=\\\"float: left;margin: 1 0 0 5\\\">\";
		topic_list += \"<select name=\\\"q\\\" style=\\\"margin: 1 0 0 0;\\\">\";
		topic_list += \"<option value=\\\"last_created\\\">Uusimmat</option>\";
		topic_list += \"<option value=\\\"last_created\\\">Viimeksi lisätyt</option>\";
		topic_list += \"<option value=\\\"last_created\\\">Viimeksi hankitut</option>\";
		topic_list += \"<option value=\\\"last_created\\\">Viimeksi muokatut</option>\";
		topic_list += \"<option value=\\\"last_created\\\">Omat asunnot</option>\";
		topic_list += \"<option value=\\\"last_created\\\">Omat palvelut</option>\";
		topic_list += \"<optgroup label=\\\"Kaupankäynti\\\">\";
		topic_list += \"<option value=\\\"wanted\\\" style=\\\"margin-left: 10px;\\\">Halutuimmat</option>\";
		topic_list += \"<option value=\\\"sell\\\" style=\\\"margin-left: 10px;\\\">Myynnissä</option>\";
		topic_list += \"<option value=\\\"change\\\" style=\\\"margin-left: 10px;\\\">Vaihdetaan</option>\";
		topic_list += \"<option value=\\\"steal\\\" style=\\\"margin-left: 10px;\\\">Varastetut</option>\";
		topic_list += \"</optgroup>\";
		topic_list += \"<optgroup label=\\\"Palaute\\\">\";
		topic_list += \"<option value=\\\"wanted\\\" style=\\\"margin-left: 10px;\\\">Puutteelliset</option>\";
		topic_list += \"<option value=\\\"sell\\\" style=\\\"margin-left: 10px;\\\">Katsotuimmat</option>\";
		topic_list += \"<option value=\\\"change\\\" style=\\\"margin-left: 10px;\\\">Jaetuimmat</option>\";
		topic_list += \"</optgroup>\";
		topic_list += \"<optgroup label=\\\"Lajittele\\\">\";
		topic_list += \"<option value=\\\"wanted\\\" style=\\\"margin-left: 10px;\\\">Tuotteittain</option>\";
		topic_list += \"<option value=\\\"sell\\\" style=\\\"margin-left: 10px;\\\">Markkina-arvo</option>\";
		topic_list += \"<option value=\\\"sell\\\" style=\\\"margin-left: 10px;\\\">A-Ö</option>\";
		topic_list += \"<option value=\\\"change\\\" style=\\\"margin-left: 10px;\\\">Ö-A</option>\";
		topic_list += \"</optgroup>\";
		topic_list += \"</select>\";
		topic_list += \"</span>\";
		topic_list += \"<input type=\\\"submit\\\" name=\\\"delete[]\\\" value=\\\"&times;\\\" title=\\\"Delete Selected\\\" style=\\\"float: left; height: 22px; width: 22px;\\\">\";
		topic_list += \"<label style=\\\"float: right;\\\">\";
		//topic_list += \"<span style=\\\"height: 12px;margin: -2 0 0 0;\\\">Lisää</span>\";
		
		//topic_list += \"<input type=\\\"button\\\" onClick=\\\"product_form();\\\" value=\\\" tavara \\\" style=\\\"float: right;margin: -1 0 0 0; \\\">\";
		topic_list += \"<input type=\\\"button\\\" onClick=\\\"product_form();\\\" value=\\\" Lisää kohde... \\\" style=\\\"float: right;margin: -1 0 0 0; \\\">\";
		// topic_list += \"<input type=\\\"button\\\" id=\\\"sample_attach_menu_parent\\\" class=\\\"sample_attach\\\" value=\\\" palvelu \\\" style=\\\"float: right;margin: 0 0; \\\">\";
		// topic_list += \"<input type=\\\"button\\\" id=\\\"sample_attach_menu_parent\\\" class=\\\"sample_attach\\\" value=\\\" tavara \\\" style=\\\"float: right;margin: 0 0; \\\">\";
		// topic_list += \"<input type=\\\"button\\\" onClick=\\\"trade_agreement_popup('popup');\\\" value=\\\" tavara \\\" style=\\\"float: right;margin: 0 0; \\\">\";
		// topic_list += \"<input type=\\\"button\\\" id=\\\"sample_attach_menu_parent\\\" class=\\\"sample_attach\\\" value=\\\" asunto \\\" style=\\\"float: right;margin: 0 0; \\\">\";
		topic_list += \"</label>\";
		topic_list += \"</h3>\";
		var menu  =\"<div id=\\\"directory_tree_sort\\\" style=\\\"overflow:auto;width:100%;\\\">\"; 
			menu +=\"<div id=\\\"directory_tree_sort_tree_stuff\\\" style=\\\"float:left;\\\"><a href=\\\"javascript:void(0);\\\" name=\\\"stuff_tree\\\" onclick=\\\"directory_tree_view(this);\\\">Stuff tree</a></div>\";
			menu +=\"<div style=\\\"float:left;\\\"><a href=\\\"javascript:void(0);\\\" name=\\\"independent_compilations\\\" onclick=\\\"directory_tree_view(this);\\\">Independent Compilations</a></div>\";
			menu +=\"<div style=\\\"float:left;\\\"><a href=\\\"javascript:void(0);\\\" name=\\\"independent_stuffs\\\" onclick=\\\"directory_tree_view(this);\\\">Independent Stuffs</a></div>\";
			menu +=\"</div>\"; 
		topic_list+=menu;
		//topic_list+=storage;
		topic_list+=\"<div id=\\\"directory_tree_model\\\">\";
		topic_list+=directory_tree;
		topic_list+=\"</div></div></div>\";
		area.innerHTML=topic_list;
		

</script>";
mysql_close();
?>