<?php	header("Content-Type: text/html; charset=iso-8859-1");
/**
 * 
 * Main Activity for Calendar
 * 
 * This is a main activity part for Calendar.
 * 
 * @package		Main Activity for Calendar
 * @author		Kalle K.
 * @copyright	Kalle K. (c) 2000 - now
 * @license		Private
 * @link		Unavailable
 * @since		2016
 * @filesources	Unavailable
 */

// --------------------------------------------------------------------------------------------------------------------

/**
 * 
 * Database connection
 * 
 * @dbhost	Param for hostname like address
 * @dbuser	Param for username
 * @dbpass	Param for password
 * @conn	Param for SQL query connections
 * @dbname	Name of Database
 * @query	Return parameter for main activity
 */
	$dbhost = '';	/* host */ 
	$dbuser = '';		/* your username created */ 
	$dbpass = '';		//'password'; //the password 4 that user
	$dbname = 'calendar';				/* database name */
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	mysqli_select_db($conn, $dbname);
	

	// --------------------------------------------------------------------------------------------------------------------
	
	/**
	 * 
	 * Main part
	 * 
	 * Functions for End-user content
	 * 
	 * @conn			Param for SQL query connections
	 * @result			Param for SQL query results
	 * @override_prev	Param for time dimensions
	 * @return			Param for happiness
	 */
		
	print $return = main($conn);
	mysqli_close($conn);
	
	function main($conn)
	{
		$o  = "";
		$o .= "<script type=\"text/javascript\" src=\"jquery-1.12.4.min.js\" charset=\"iso-8859-1\"></script>";
		$o .= "<script type=\"text/javascript\" src=\"config.js\" charset=\"iso-8859-1\"></script>";
		
		$o .= "<script language=\"javascript\" type=\"text/javascript\">
				
				</script>";
		$o .= "<div id=\"floating_element\" style=\"position:absolute;\"></div>";
		$o .= "<div id=\"main_window\" style=\"\">";
		$o .= "<div id=\"calendar\" style=\"float:left;border:1px solid;width:900;\">";
		$o .= "<div id=\"calendar_week_notification\">";
		$o .= "</div>";
		$o .= "<hr style=\"margin:0 0 -10 0;\"/>";
		$o .= "<span style=\"background-color:#ffffff;padding: 0 10;\">Week 31</span>";
		$o .= "<div id=\"calendar_week\" style=\"margin: 10 0 0 10;height:700;\">";
		$o .= "</div>";
		$o .= "</div>";
		$o .= "<div id=\"navigation_list\" style=\"float:left;border:1px solid;width:400;height:900;\">";
		
		function select_data_from_database($conn)
		{
			return $result = mysqli_query($conn, "SELECT *,
											(SELECT count(sd2.schema_begin)
											FROM schema_detail sd2
											WHERE sd2.use_of='In_Use'
											and sd2.schema_begin=sd.schema_begin
											) as override
										FROM schema_detail sd
										WHERE sd.use_of='In_Use'
										ORDER BY sd.schema_begin ASC
										");
		}
		
		$result = select_data_from_database($conn);
		
		function neutral_thing($result)
		{
			$o = '';
			if($result !== false && mysqli_num_rows($result)>0)
			{
				
				$o .= "<h4 style=\"margin-bottom:0;border-bottom:1px solid;\">";
				$o .= "<a name=\"calendar_detail::now\" href=\"javascript:;\" onclick=\"quick_handler(this);\">Nyt</a> | ";
				$o .= "<a id=\"calendar_detail::add_new_thing::Add1\" name=\"calendar_detail::add_new_thing::Add1\" ";
				$o .= "href=\"javascript:;\" onclick=\"quick_handler(this);\">Lis‰‰...</a>";
				$o .= "</h4>";
				$o .= "<input id=\"course_mgmt::course_name\" placeholder=\"Find your needs...\" />";
				$o .= "<h4>Current available/available since... <span style=\"float:right;\">";
				$o .= "[<a href=\"javascript:;\" id=\"calendar_detail::add_new_thing::Add2\" ";
				$o .= "name=\"calendar_detail::add_new_thing::Add2\" onclick=\"quick_handler(this);\">Lis‰‰...</a>]</span></h4>";
				$o .= "<div id=\"eventlist\">";
				
				
				$time_previous = 0;$time_difference=0;
				$override_prev = 0;
				while($row = mysqli_fetch_assoc($result))
				{
					$schema_begin = explode(" ",$row["schema_begin"]);
					$time = explode(":",$schema_begin[1]);
					
					// aikaero!
					$time_difference = $time[0]-$time_previous;
					$time_previous = $time[0];
					
					//function check_event_overlap($row)

					if($override_prev != $row["schema_begin"] && $row['override']>1)
					{
						$o = "<hr style=\"margin: 13 0 -11 0;padding: 0 5 0 5;\"/>";
						$o .= "<span style=\"background-color:#ffffff;padding: 0 10 0 0;\">Since ".$schema_begin[0]." ".$time[0]." ".$time[1]." (".$row['override'].")</span>";
						$override_prev = $row["schema_begin"];
					}

					
					
					if($override_prev == $row["schema_begin"] && $row['override']>1)
					{
					
						$color = ($time[0]%2==0)?"#aaa666":"#eee333";
						$o .= "<div id=\"course_mgmt:".$row["id"].":list_element\" style=\"min-height:25;background-color:$color;\">";
						$o .= "<div style=\"height:22;padding: 2 0;\">";
						$o .= "[<span style=\"font-size:12;\"><a href=\"javascript:;\" name=\"event_settings\">".$schema_begin[0]." ".$time[0]." ".$time[1]."</a></span>, $time_difference] <a href=\"javascript:;\">(".$row["max_count_of_participant"].") ".$row["code"]. " ".$row["name"]. " (".$row["ects"]." ects)</a>";
						$o .= "<a name=\"course_mgmt:".$row["id"].":delete_course\" href=\"javascript:;\" style=\"float:right;margin: 2 2 0 0;\" onclick=\"handler(this);\">&times;</a>";
						$o .= "<input type=\"button\" value=\"ilmoittaudu\" style=\"float:right;\" />";
						$o .= "</div>";
						$o .= "<div class=\"daily_times:".$schema_begin[0]."\" style=\"background-color:lightgrey;\">Now used: 00:00 - 12:00. Vaihda aika:</div>";
						$o .= "</div>";
					}
					else
					{
						$color = ($time[0]%2==0)?"#aaa666":"#eee333";
						$o .= "<div id=\"course_mgmt:".$row["id"].":list_element\" style=\"height:25;background-color:$color;\">";
						
						$o .= "[<span style=\"font-size:12;\"><a href=\"javascript:;\" name=\"event_settings\">".$schema_begin[0]." ".$time[0]." ".$time[1]."</a></span>, $time_difference] <a href=\"javascript:;\">(".$row["max_count_of_participant"].") ".$row["code"]. " ".$row["name"]. " (".$row["ects"]." ects)</a>";
						$o .= "<a name=\"course_mgmt:".$row["id"].":delete_course\" href=\"javascript:;\" style=\"float:right;margin: 2 2 0 0;\" onclick=\"handler(this);\">&times;</a>";
						$o .= "<input type=\"button\" value=\"ilmoittaudu\" style=\"float:right;\" />";
						$o .= "</div>";
					}
				}
				$o .= "</div>";
				
				$o .= "<div id=\"testlisst\">";
				$o .= "</div>";
				
				$o .= "<script>bootloader('boot_type__launch_week_notifier_only');</script>";
				
				$o .= "<h4>Ihmiset, joilla t‰m‰ kalenteri k‰ytˆss‰</h4>";
				$o .= "<div>";
				$o .= "</div>";
				
				$o .= "<h4>Kalenterit, joissa samanlaisia tapahtumia</h4>";
				$o .= "<div>";
				$o .= "</div>";
				
			}
			else 
			{
				$o .= "<h4 style=\"margin-bottom:0;border-bottom:1px solid;\">";
				$o .= "<a name=\"calendar_detail::now\" href=\"javascript:;\" onclick=\"quick_handler(this);\">Nyt</a> | ";
				$o .= "<a name=\"calendar_detail::add_new_thing\" href=\"javascript:;\" onclick=\"quick_handler(this);\">Lis‰‰...</a>";
				$o .= "</h4>";
				
				$o .= "<h4>Current available/available since... <span style=\"float:right;\">[<a href=\"javascript:;\" id=\"calendar_detail::add_new_thing\" name=\"calendar_detail::add_new_thing\" onclick=\"quick_handler(this);\">Lis‰‰...</a>]</span></h4>";
				$o .= "<div id=\"eventlist\">";
				$o .= "</div>";
				$o .= "<div id=\"sidebar_list\">";
				
				$o .= "<p>Saatavilla on X tapahtumaa.";
				$o .= "<p>Aiheuta s‰pin‰‰ ja sutinaa kavereillesi luomalla  <input id=\"event_shortcut\" placeholder=\"lis‰‰ h‰ppeninki‰!\" /></p>";
		
				$o .= "<script>bootloader('boot_type__launch_week_notifier_only');</script>";
				$o .= "</div>";
				
				
				
			}
		
			$o .= "</div>";
			$o .= "</div>";
			return $o;
		}
		$o .= neutral_thing($result);
		
		return $o;
	
	}


?>