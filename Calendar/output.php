<?php	header("Content-Type: application/json; charset=utf-8");
/**
 * 
 * Interface for Calendar
 * 
 * This is an interface between end-user and database. 
 * 
 * @package		Interface for Calendar
 * @author		Kalle K.
 * @copyright	Kalle K. (c) 2000 - now
 * @license		Private
 * @link		Unavailable
 * @since		2016
 * @filesource	Unavailable
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
	$dbhost = '130.234.191.71:3306';	/* host */ 
	$dbuser = 'q#¤%_GD4jjt34w_S';		/* your username created */ 
	$dbpass = 'cytBdSpWr3deJpfX';		//'password'; //the password 4 that user
	$dbname = 'calendar';				/* database name */
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	mysqli_select_db($conn, $dbname);
	print $query = (isset($_GET['query'])) ? Output::main($conn, $_GET['query']) : "";
	mysqli_close($conn);

/**
 * 
 * Output class with Main function
 * 
 * @conn	Param for SQL query connections
 * @query	Return parameter for main activity
 */



abstract class Output {
	public static function main($conn, $query)
	{
			
		
		// --------------------------------------------------------------------------------------------------------------------

		/**
		 * 
		 * The Function farm
		 * 
		 * This area includes all of them function what program needs to work correct
		 * Find 'Function exists part'-part later this file, where more info.
		 * 
		 * @conn	Param for SQL query connections
		 * @query	Return parameter for main activity
		 */
		
		
				// --------------------------------------------------------------------------------------------------------------------

				/**
				 * 
				 * Function course_mgmt__add_course
				 * 
				 * 
				 * 
				 * @query["object_group"]	Param for function name
				 * @conn					Param for SQL query connections
				 * @query					Return parameter for main activity
				 */
		
				//if($query["object_group"] == "course_mgmt__add_courseX")
				function course_mgmt__add_course($conn, $query)
				{
					function evaluate_datetime($query)
					{		
						$date = new DateTime($query["course_duration_1"]);
						$date2 = new DateTime($query["course_duration_1"]);
						// if duration 1 > duration 2
						if($date->format('Y-m-d H:i:s')>$date2->format('Y-m-d H:i:s'))
						{
							$temp = $query["course_duration_2"];
							$query["course_duration_2"] = $query["course_duration_1"];
							$query["course_duration_1"] = $temp;
								
						}
						return $query;
					}
					
					$query = evaluate_datetime($query);
			
					function mysql_row_exists($conn, $query)
					{
					
							// tää on vähä huono tyyli tässä, mut menköt
							// laita alempaan queryyn myös alku ja päättymisaika, jos useampi käyttäjä
							if(!isset($query["course_code"]))
									$query["course_code"] = '';
									
							$result = mysqli_query($conn, "SELECT s.*
													FROM schema s
													WHERE s.code='".$query["course_code"]."'
													and use_of='In_Use'
												");
							return $result;
					}
					$result = mysql_row_exists($conn, $query);
					
					function mysql_check_row_exists_result($result)
					{
						return $query["result"] = ($result !== false && mysqli_num_rows($result)>0)? -1 : 0 ;
					}
					
					$query["result"] = mysql_check_row_exists_result($result);
					
					//function row_not_exists($query)
					function row_not_exists_set_values($query)
					{
						if($query["result"] == 0)
						{
							if(!isset($query["course_code"]))
								$query["course_code"] = '';
							if(!isset($query["course_name"]))
								$query["course_name"] = '';
							if(!isset($query["course_ects"]))
								$query["course_ects"] = '';
							if(!isset($query["course_material"]))
								$query["course_material"] = '';
							if(!isset($query["course_max_count_of_participants"]))
								$query["course_max_count_of_participants"] = '';
						}
						return $query;
					}
					
					$query = row_not_exists_set_values($query);
					
					function update_mysql_row($conn, $query)
					{
						if($query["result"] == 0)
						{	
								$confirmation = mysqli_query($conn,"UPDATE schema_detail 
																SET created=NOW(),
																use_of='In_Use',
																code='".$query["course_code"]."',
																name='".$query["course_name"]."',
																ects='".$query["course_ects"]."',
																type_of_coursematerial='".$query["course_material"]."',
																max_count_of_participant='".$query["course_max_count_of_participants"]."',
																schema_begin='".$query["course_duration_1"]."',
																schema_end='".$query["course_duration_2"]."'
																WHERE use_of='Free'
																LIMIT 1
														");
						}
						else
							$confirmation = '';
						return $confirmation;
					}
					
					$confirmation = update_mysql_row($conn, $query);
					
					function check_mysql_confirmation($conn, $confirmation)
					{			
						return $query["result"] = ($confirmation !== false &&  mysqli_affected_rows($conn)==0) ? 0 : -1;
					}
					
					$query["result"] = check_mysql_confirmation($conn, $confirmation);
					$query = row_not_exists_set_values($query);
					
					function mysql_insert_row($conn, $query)
					{
						if($query["result"] == 0)
						{			
									$result = mysqli_query($conn, "INSERT INTO schema_detail
															SET created=NOW(),
																use_of='In_Use',
																code='".$query["course_code"]."',
																name='".$query["course_name"]."',
																ects='".$query["course_ects"]."',
																type_of_coursematerial='".$query["course_material"]."',
																max_count_of_participant='".$query["course_max_count_of_participants"]."',
																schema_begin='".$query["course_duration_1"]."',
																schema_end='".$query["course_duration_2"]."'
																");
						}
						else 
						{
							$result = 0;
						}
					
						return $result;			
					}
					
					$result = mysql_insert_row($conn, $query);
									
					function select_most_recent_row($conn, $query)	
					{		
						$result = mysqli_query($conn, "SELECT *
													FROM schema_detail
													WHERE name='".$query["course_name"]."'
													LIMIT 1
													");
								
						while($row = mysqli_fetch_assoc($result))
							$query["result"] = $row;
							
						return $query["result"];
					}
						$query["result"] = select_most_recent_row($conn, $query);	
			
			
					return $query;
				}
				
				// --------------------------------------------------------------------------------------------------------------------

				/**
				 * 
				 * Function course_mgmt__delete_course
				 * 
				 * 
				 * 
				 * @query["object_group"]	Param for function name
				 * @conn					Param for SQL query connections
				 * @query					Return parameter for main activity
				 */
				
				//if($query["object_group"] == "course_mgmt__delete_course")
				function course_mgmt__delete_course($conn, $query)
				{
					
					function check_if_row_exists($conn, $query)
					{
						$result = mysqli_query($conn, "SELECT s.*
														FROM schema_detail s
														WHERE s.id='".$query["object_id"]."'
														and s.use_of='In_Use'
															");
						return $result;
					}
					
					$result = check_if_row_exists($conn, $query);
						
					function result_status($result)
					{
						return $query["result"] = ($result !== false && mysqli_num_rows($result)>0) ? 0 : -1;
					}
					$query["result"] = result_status($result);
					
					function update_row($conn, $query)
					{
						if($query["result"]==0)
						{
							$result = mysqli_query($conn, "UPDATE schema_detail
													SET use_of='Free',
														created='0000-00-00 00:00:00',
														code='',
														name='',
														ects='',
														type_of_coursematerial='',
														max_count_of_participant=''
													WHERE id='".$query["object_id"]."'
													and use_of='In_Use'
														");
						}
						else 
						{
							$result=0;
						}
						return $result;
					}
					
					$result = update_row($conn, $query);
					
					function mysql_update_row_status($conn, $result)
					{
						return $query["result"] = ($result !== false  && mysqli_affected_rows($conn)>0) ? 1 : 0;
					}
					
					$query["result"] = update_row($conn, $result);
					
					return $query;
					
				}
				
				// --------------------------------------------------------------------------------------------------------------------

				/**
				 * 
				 * Function boot_type__launch_calendar
				 * 
				 * 
				 * 
				 * @query["object_group"]	Param for function name
				 * @conn					Param for SQL query connections
				 * @query					Return parameter for main activity
				 */
				
				//if($query["object_group"] == "boot_type__launch_calendar")
				function boot_type__launch_calendar($conn, $query)
				{
					function week_calendar_components()
					{
						date_default_timezone_set('Europe/Helsinki');
						// date('W', strtotime('monday this week')); // date('W', strtotime('monday last week'));
						$week_compontent["this_week"] = date('W', strtotime('monday this week'));
						$week_compontent["first_day"] = date('d', strtotime('monday this week'));
						$week_compontent["month"] = date('m', strtotime('monday this week'));
						$week_compontent["year"] = date('Y', strtotime('monday this week'));
						$week_compontent["last_day"] = $first_day+7;
						$week_compontent["first_day_of_week"] = date('Y-m-d', strtotime('monday this week'));
						$week_compontent["now"] = date('Y-m-d', strtotime('now'));
						return week_compontent;
					}
					$week_compontent = week_calendar_components();
					
					function date_order($week_compontent)
					{
						$week_look='';
						while($week_compontent["first_day"]<$week_compontent["last_day"])
						{	
							$bk_color = ($week_compontent["year"]."-".$week_compontent["month"]."-".$week_compontent["first_day"] == $week_compontent["now"])?"background-color:yellow;":"";
							$week_look .= "<div id=\"".$week_compontent["year"]."-".$week_compontent["month"]."-".$week_compontent["first_day"]."\" style=\"float:left;border:1px solid;padding: 0 3.8;".$bk_color."\">";
							$week_look .= $week_compontent["first_day"]."</div>";
							$week_compontent["first_day"]++;
						}
						return $week_look;
					}
					
					function date_design($week_compontent, $week_details)
					{
						$week_look  = "<div id=\"week_line:".$week_compontent["this_week"]."\" overflow:auto;>";
						$week_look .= "<div id=\"week:".$week_compontent["this_week"]."\" style=\"float:left;border:1px solid;font-weight:bold;width:22;\">";
						$week_look .= $week_compontent["this_week"]."</div>";
						$week_look .= $week_details;
						$week_look .="</div>";
						
						return $week_look;
					}
					
					$week_look = date_design($week_compontent, date_order($week_compontent));
					
					function week_numbers($week_compontent)
					{
						$this_week_number = $week_compontent["this_week"]-1;
						for(; $this_week_number  > 0; $this_week_number --)
							$week_list_prev[] = $this_week_number;
							return $week_list_prev;
					}
					
					$week_list_prev = week_numbers($week_compontent);
					
					function week_conclusion($week_look, $week_compontent, $week_list_prev)
					{
						$query["result"]["week_look"] = $week_look;
						$query["result"]["week"] = $week_compontent["this_week"];
						$query["result"]["now"] = $week_compontent["now"];
						$query["result"]["week_list"] = json_encode($week_list_prev,  JSON_FORCE_OBJECT);
						
						return $query["result"];
					}
					$query["result"] = week_conclusion($week_look, $week_compontent, $week_list_prev);
					return $query;
				}
				
				// --------------------------------------------------------------------------------------------------------------------

				/**
				 * 
				 * Function boot_type__launch_week_notifier
				 * 
				 * 
				 * 
				 * @query["object_group"]	Param for function name
				 * @conn					Param for SQL query connections
				 * @query					Return parameter for main activity
				 */
				
				
				// tämä jaettu 2 funktioon - sama koodi. etsi jälkimmäinen _only -kohta myöhempää, jos tarve
				//if($query["object_group"] == "boot_type__launch_week_notifier" || 
				//	$query["object_group"] == "boot_type__launch_week_notifier_only")
				function boot_type__launch_week_notifier($conn, $query)
				{
					
					function ongoing_week_details($conn)
					{
						$today = date('Y-m-d', strtotime('now'));
						$result = mysqli_query($conn, "SELECT name, code
													FROM schema_detail
													WHERE attention_begin>'".$today."'
													and attention_end<'".$today."'
															");
						return $result;
					}
					
					$result = ongoing_week_details($conn);
					
					function check_week_details_result($result)
					{
						return $query["result"] = ($result !== false && mysqli_num_rows($result)>0) ? 0 : -1;
					}
					
					$query["result"] = check_week_details_result($result);
					
					function tabulate_ongoing_week_details($result, $query)
					{
						if($query["result"]==0)
						{
							$i=0;
							while($row = mysqli_fetch_assoc($result))
							{
								$query["result"][$i] = $row;
								$i++;
							}
						}
						return $query;			
					}
					
					$query["result"] = tabulate_ongoing_week_details($result, $query);
			
					function available_week_details($conn)
					{
						return $result = mysqli_query($conn, "SELECT distinct schema_begin
																FROM schema_detail
																WHERE use_of='In_Use'");
					}
					
					
					$result = available_week_details($conn);
					$query["result"] = check_week_details_result($result);
					
					function tabulate_week_details($result, $query)
					{
						if($query["result"]==0)
						{
							$week_detail["week_list"] = Array();
							$week_detail["week_array"] = Array();
							while($row = mysqli_fetch_assoc($result))
							{
								// http://php.net/manual/en/function.date.php, etsi week
								$week_detail["week_list"][date("W", strtotime($row['schema_begin']))] = 0;
								$week_detail["week_array"][] = date("W", strtotime($row['schema_begin']));
							}
						}
						return $week_detail;
					}
					
					$week_detail = tabulate_week_details($result, $query);
					
					
					function week_available($week_detail)
					{
						$weeks_available = "";
						foreach($week_detail["week_list"] as $week => $count)
							$weeks_available .= "<a name=\"week::38\" href=\"javascript:;\">".$week."</a>, ";
						return $weeks_available;
					}
				
					$weeks_available = week_available($week_detail);
					
					function datetime_specs($week_detail, $weeks_available)
					{
						// http://stackoverflow.com/questions/1659551/how-to-get-the-first-day-of-a-given-week-number-in-php-multi-platform
						$query["datetime_specs"]["available"] = $weeks_available;
						$query["datetime_specs"]["now_week"] = $w =  date("W", strtotime('now'));
						$query["datetime_specs"]["now_year"] = $yr = date("Y", strtotime('now'));
						$query["datetime_specs"]["selected"] = $week_detail["week_array"][0];
						$query["datetime_specs"]["fdow"] = $fdow = date('Y-m-d',strtotime($yr.'W'.$week_detail["week_array"][0]));
						$ldow = date('Y-m-d',strtotime($fdow . "+1 week"));
						return $query["datetime_specs"];
					}
					
					$query["datetime_specs"] = datetime_specs($week_detail, $weeks_available);
					
					function all_available_week_details($conn)
					{
						return	$result = mysqli_query($conn, "SELECT *
																FROM schema_detail
																WHERE use_of='In_Use'
																");
					}
					
					$result = all_available_week_details($conn);
					
					
					$timetable_list = Array();
					$timetable_limits = Array();
					
					if($result !== false && mysqli_num_rows($result)>0)
					{
						$day = 0;		
						$round = 0;
						$timetable_limits["weekly"]["earliest_time"]="";
						$timetable_limits["weekly"]["latest_time"]="";
						$timetable_limits["daily"]["earliest_time"]="";
						$timetable_limits["daily"]["latest_time"]="";
						
						while($row = mysqli_fetch_assoc($result))
						{
							// periaatteessa tähän voisi laittaa sen toiminnon, että
							// minä viikonpäivänä jutut alkaa aikaisimpaan, ja milloin päättyy
							// myöhäisimpään kun kerta tehdään päiväkohtaiset tapahtumatiedot¨
							$date = explode(" ",$row['schema_begin']);
							
							if($day != $date[0])
							{
								$round = 0;
								$timetable_list[$date[0]][$date[1]][$round] = $row;
								
								// päivän tapahtumat järjestykseen, ongelmia muuten myöhemmin
								ksort($timetable_list[$date[0]]);
								
								$day=$date[0];
							}
							else
							{
								$timetable_list[$date[0]][$date[1]][$round] = $row;
								
								// päivän tapahtumat järjestykseen, ongelmia muuten myöhemmin
								ksort($timetable_list[$date[0]]);
							}
							
							$round++;
							
							
							// Weekly detail
							
							if($timetable_limits["weekly"]["earliest_time"]=="")
								$timetable_limits["weekly"]["earliest_time"]=$date[1];
								
							if($timetable_limits["weekly"]["latest_time"]=="")
								$timetable_limits["weekly"]["latest_time"]=$date[1];
							
							if(strtotime($timetable_limits["weekly"]["earliest_time"])>strtotime($date[1]))
								  $timetable_limits["weekly"]["earliest_time"]=$date[1];
								  
							if(strtotime($timetable_limits["weekly"]["latest_time"])<strtotime($date[1]))
								  $timetable_limits["weekly"]["latest_time"]=$date[1];
								  
							// Daily detail
							
							if(!isset($timetable_limits["daily"]["earliest_time"][$date[0]])) 
								$timetable_limits["daily"]["earliest_time"][$date[0]]=$date[1];
								
							if(!isset($timetable_limits["daily"]["latest_time"][$date[0]])) 
								$timetable_limits["daily"]["latest_time"][$date[0]]=$date[1];
								
							if(strtotime($timetable_limits["daily"]["earliest_time"][$date[0]])>strtotime($date[1]))
								  $timetable_limits["daily"]["earliest_time"][$date[0]]=$date[1];
								  
							if(strtotime($timetable_limits["daily"]["latest_time"][$date[0]])<strtotime($date[1]))
								  $timetable_limits["daily"]["latest_time"][$date[0]]=$date[1];
								
								  
							
						}
					
					$query["timetable_list"] = $timetable_list;
					$query["timetable_limits"]["week_e"] = $er = $timetable_limits["weekly"]["earliest_time"];
					$query["timetable_limits"]["week_l"] = $la = $timetable_limits["weekly"]["latest_time"];
					$query["timetable_limits"]["week_d"] = $la-$er;
					$query["timetable_limits"]["week_2hours_dimensions"] = floor($query["timetable_limits"]["week_d"]/2)+1;
					$query["timetable_limits"]["time_dimensions"] = Array();
					
					$date = new DateTime($er);
					array_push($query["timetable_limits"]["time_dimensions"],$date->format("H:i:sO"));
					
					for($ajan_alku = 1; $ajan_alku<$query["timetable_limits"]["week_2hours_dimensions"]; $ajan_alku++)
					{
						$date = new DateTime($query["timetable_limits"]["time_dimensions"][$ajan_alku-1]);
						$date->modify("+2 hours");
						//array_push($query["timetable_limits"]["time_dimensions"],$date->format("Y-m-d H:i:sO")); 
						array_push($query["timetable_limits"]["time_dimensions"],$date->format("H:i:sO")); 
					}
					
					$query["timetable_limits"]["daily"] = $timetable_limits["daily"];
					//date('Y-m-d',strtotime($yr.'W'.$week_array[0]));
					$week_number = $week_detail["week_array"][0];
					
					if($week_number<10)
						$week_number="0".$week_number;
					
					
						
					$week_days_list = Array();
					$max_days = 5;// 7 = default;
					
						for($day=1; $day<=$max_days; $day++)
						{
						    unset($month);
						    unset($first_day);
						    $month = date('m', strtotime($query["datetime_specs"]["now_year"]."W".$week_number.$day));
						    $first_day = date('d', strtotime($query["datetime_specs"]["now_year"]."W".$week_number.$day));
						    $month_bk = ($month%2==0)?"background-color:lightgreen;":"";
						    $week_days_list[$day]["date"] = $first_day.".".$month.".";
						    $week_days_list[$day]["id"] = $query["datetime_specs"]["now_year"].".".$month.".".$first_day.".";
						    $week_days_list[$day]["color"] = $month_bk;
			
						}
						
						$query["week_days_list"] = $week_days_list;
					}
					else 
					{
						$query["week_days_list"] = '';
						$query["timetable_list"] = '';
						$query["timetable_limits"] = '';
					}
					return $query;
				}
				
				// --------------------------------------------------------------------------------------------------------------------

				/**
				 * 
				 * Function boot_type__launch_week_notifier_only
				 * 
				 * 
				 * 
				 * @query["object_group"]	Param for function name
				 * @conn					Param for SQL query connections
				 * @query					Return parameter for main activity
				 */
				
				function boot_type__launch_week_notifier_only($conn, $query)
				{
					
					function ongoing_week_details($conn)
					{
						$today = date('Y-m-d', strtotime('now'));
						$result = mysqli_query($conn, "SELECT name, code
													FROM schema_detail
													WHERE attention_begin>'".$today."'
													and attention_end<'".$today."'
															");
						return $result;
					}
					
					$result = ongoing_week_details($conn);
					
					function check_week_details_result($result)
					{
						return $query["result"] = ($result !== false && mysqli_num_rows($result)>0) ? 0 : -1;
					}
					
					$query["result"] = check_week_details_result($result);
					
					function tabulate_ongoing_week_details($result, $query)
					{
						if($query["result"]==0)
						{
							$i=0;
							while($row = mysqli_fetch_assoc($result))
							{
								$query["result"][$i] = $row;
								$i++;
							}
						}
						return $query;			
					}
					
					$query["result"] = tabulate_ongoing_week_details($result, $query);
			
					function available_week_details($conn)
					{
						return $result = mysqli_query($conn, "SELECT distinct schema_begin
																FROM schema_detail
																WHERE use_of='In_Use'");
					}
					
					
					$result = available_week_details($conn);
					$query["result"] = check_week_details_result($result);
					
					function tabulate_week_details($result, $query)
					{
						if($query["result"]==0)
						{
							$week_detail["week_list"] = Array();
							$week_detail["week_array"] = Array();
							while($row = mysqli_fetch_assoc($result))
							{
								// http://php.net/manual/en/function.date.php, etsi week
								$week_detail["week_list"][date("W", strtotime($row['schema_begin']))] = 0;
								$week_detail["week_array"][] = date("W", strtotime($row['schema_begin']));
							}
						}
						return $week_detail;
					}
					
					$week_detail = tabulate_week_details($result, $query);
					
					
					function week_available($week_detail)
					{
						$weeks_available = "";
						foreach($week_detail["week_list"] as $week => $count)
							$weeks_available .= "<a name=\"week::38\" href=\"javascript:;\">".$week."</a>, ";
						return $weeks_available;
					}
				
					$weeks_available = week_available($week_detail);
					
					function datetime_specs($week_detail, $weeks_available)
					{
						// http://stackoverflow.com/questions/1659551/how-to-get-the-first-day-of-a-given-week-number-in-php-multi-platform
						$query["datetime_specs"]["available"] = $weeks_available;
						$query["datetime_specs"]["now_week"] = $w =  date("W", strtotime('now'));
						$query["datetime_specs"]["now_year"] = $yr = date("Y", strtotime('now'));
						$query["datetime_specs"]["selected"] = $week_detail["week_array"][0];
						$query["datetime_specs"]["fdow"] = $fdow = date('Y-m-d',strtotime($yr.'W'.$week_detail["week_array"][0]));
						$ldow = date('Y-m-d',strtotime($fdow . "+1 week"));
						return $query["datetime_specs"];
					}
					
					$query["datetime_specs"] = datetime_specs($week_detail, $weeks_available);
					
					function all_available_week_details($conn)
					{
						return	$result = mysqli_query($conn, "SELECT *
																FROM schema_detail
																WHERE use_of='In_Use'
																");
					}
					
					$result = all_available_week_details($conn);
					
					
					$timetable_list = Array();
					$timetable_limits = Array();
					
					if($result !== false && mysqli_num_rows($result)>0)
					{
						$day = 0;		
						$round = 0;
						$timetable_limits["weekly"]["earliest_time"]="";
						$timetable_limits["weekly"]["latest_time"]="";
						$timetable_limits["daily"]["earliest_time"]="";
						$timetable_limits["daily"]["latest_time"]="";
						
						while($row = mysqli_fetch_assoc($result))
						{
							// periaatteessa tähän voisi laittaa sen toiminnon, että
							// minä viikonpäivänä jutut alkaa aikaisimpaan, ja milloin päättyy
							// myöhäisimpään kun kerta tehdään päiväkohtaiset tapahtumatiedot¨
							$date = explode(" ",$row['schema_begin']);
							
							if($day != $date[0])
							{
								$round = 0;
								$timetable_list[$date[0]][$date[1]][$round] = $row;
								
								// päivän tapahtumat järjestykseen, ongelmia muuten myöhemmin
								ksort($timetable_list[$date[0]]);
								
								$day=$date[0];
							}
							else
							{
								$timetable_list[$date[0]][$date[1]][$round] = $row;
								
								// päivän tapahtumat järjestykseen, ongelmia muuten myöhemmin
								ksort($timetable_list[$date[0]]);
							}
							
							$round++;
							
							
							// Weekly detail
							
							if($timetable_limits["weekly"]["earliest_time"]=="")
								$timetable_limits["weekly"]["earliest_time"]=$date[1];
								
							if($timetable_limits["weekly"]["latest_time"]=="")
								$timetable_limits["weekly"]["latest_time"]=$date[1];
							
							if(strtotime($timetable_limits["weekly"]["earliest_time"])>strtotime($date[1]))
								  $timetable_limits["weekly"]["earliest_time"]=$date[1];
								  
							if(strtotime($timetable_limits["weekly"]["latest_time"])<strtotime($date[1]))
								  $timetable_limits["weekly"]["latest_time"]=$date[1];
								  
							// Daily detail
							
							if(!isset($timetable_limits["daily"]["earliest_time"][$date[0]])) 
								$timetable_limits["daily"]["earliest_time"][$date[0]]=$date[1];
								
							if(!isset($timetable_limits["daily"]["latest_time"][$date[0]])) 
								$timetable_limits["daily"]["latest_time"][$date[0]]=$date[1];
								
							if(strtotime($timetable_limits["daily"]["earliest_time"][$date[0]])>strtotime($date[1]))
								  $timetable_limits["daily"]["earliest_time"][$date[0]]=$date[1];
								  
							if(strtotime($timetable_limits["daily"]["latest_time"][$date[0]])<strtotime($date[1]))
								  $timetable_limits["daily"]["latest_time"][$date[0]]=$date[1];
								
								  
							
						}
					
					$query["timetable_list"] = $timetable_list;
					$query["timetable_limits"]["week_e"] = $er = $timetable_limits["weekly"]["earliest_time"];
					$query["timetable_limits"]["week_l"] = $la = $timetable_limits["weekly"]["latest_time"];
					$query["timetable_limits"]["week_d"] = $la-$er;
					$query["timetable_limits"]["week_2hours_dimensions"] = floor($query["timetable_limits"]["week_d"]/2)+1;
					$query["timetable_limits"]["time_dimensions"] = Array();
					
					$date = new DateTime($er);
					array_push($query["timetable_limits"]["time_dimensions"],$date->format("H:i:sO"));
					
					for($ajan_alku = 1; $ajan_alku<$query["timetable_limits"]["week_2hours_dimensions"]; $ajan_alku++)
					{
						$date = new DateTime($query["timetable_limits"]["time_dimensions"][$ajan_alku-1]);
						$date->modify("+2 hours");
						//array_push($query["timetable_limits"]["time_dimensions"],$date->format("Y-m-d H:i:sO")); 
						array_push($query["timetable_limits"]["time_dimensions"],$date->format("H:i:sO")); 
					}
					
					$query["timetable_limits"]["daily"] = $timetable_limits["daily"];
					//date('Y-m-d',strtotime($yr.'W'.$week_array[0]));
					$week_number = $week_detail["week_array"][0];
					
					if($week_number<10)
						$week_number="0".$week_number;
					
					
						
					$week_days_list = Array();
					$max_days = 5;// 7 = default;
					
						for($day=1; $day<=$max_days; $day++)
						{
						    unset($month);
						    unset($first_day);
						    $month = date('m', strtotime($query["datetime_specs"]["now_year"]."W".$week_number.$day));
						    $first_day = date('d', strtotime($query["datetime_specs"]["now_year"]."W".$week_number.$day));
						    $month_bk = ($month%2==0)?"background-color:lightgreen;":"";
						    $week_days_list[$day]["date"] = $first_day.".".$month.".";
						    $week_days_list[$day]["id"] = $query["datetime_specs"]["now_year"].".".$month.".".$first_day.".";
						    $week_days_list[$day]["color"] = $month_bk;
			
						}
						
						$query["week_days_list"] = $week_days_list;
					}
					else 
					{
						$query["week_days_list"] = '';
						$query["timetable_list"] = '';
						$query["timetable_limits"] = '';
					}
					return $query;
				}
				
				
				// --------------------------------------------------------------------------------------------------------------------

				/**
				 * 
				 * Function boot_type__build_calendar
				 * 
				 * 
				 * 
				 * @query["object_group"]	Param for function name
				 * @conn					Param for SQL query connections
				 * @query					Return parameter for main activity
				 */
				
				//if($query["object_group"] == "boot_type__build_calendar")
				function boot_type__build_calendar($conn, $query)
				{
						$query["week_list"] = json_decode($query["week_list"],true);
						$query["week_id"] = reset($query["week_list"]); //$first_value
						$first_key = key($query["week_list"]);
						unset($query["week_list"][$first_key]);
					
					//$week_number = 40;
					$week_number = $query["week_id"];
					$year = 2014;
					$week_look  = "<div id=\"week:".$week_number."\" style=\"float:left;border:1px solid;font-weight:bold;width:22;\">";
					$week_look .= $week_number."</div>";
					
					if($week_number<10)
						$week_number="0".$week_number;
					
					for($day=1; $day<=7; $day++)
					{
					    //echo date('m/d/Y', strtotime($year."W".$week_number.$day))."\n";
					    unset($month);
					    unset($first_day);
					    $month = date('m', strtotime($year."W".$week_number.$day));
					    $first_day = date('d', strtotime($year."W".$week_number.$day));
					    $month_bk = ($month%2==0)?"background-color:lightgreen;":"";
					    $week_look .= "<div id=\"calendar:".$year."-".$month."-".$first_day.":set_up\" onclick=\"quick_handler(this);\"";
					    $week_look .= "style=\"float:left;border:1px solid;padding: 0 3.8;$month_bk\">";
						$week_look .= $first_day."</div>";
					    
					}
					//$week_look .="</div>";
					
					$query["result"]["week_look"] = $week_look;
					
					$query["result"]["week_list"] =json_encode($query["week_list"], JSON_FORCE_OBJECT);
				}
				
				// --------------------------------------------------------------------------------------------------------------------

				/**
				 * 
				 * Function boot_type__new_set_up_calendar
				 * 
				 * 
				 * 
				 * @query["object_group"]	Param for function name
				 * @conn					Param for SQL query connections
				 * @query					Return parameter for main activity
				 */
				
				//if($query["object_group"] == "boot_type__new_set_up_calendar")
				function boot_type__new_set_up_calendar($conn, $query)
				{
					$this_week_number = $this_week+1;
					for(; $this_week_number  < 52; $this_week_number ++)
						$week_list_prev[] = $this_week_number;
						
					$query["result"]["week_list"] = json_encode($week_list_prev,  JSON_FORCE_OBJECT);
				}
	
				
	// --------------------------------------------------------------------------------------------------------------------
		
		
	/**
	 * 
	 * Query : JSON decoding and string replacing part
	 * 
	 * First decoding query fron JSON, then replacing a couple of letters.
	 * 
	 * @query["object_group"]	Param for function name
	 * @conn					Param for SQL query connections
	 * @query					Return parameter for main activity
	 */

	$query = json_decode($query,true);
	
	// http://php.net/manual/en/function.str-replace.php
	// When you will update following arrays, find all similar arrays in this file
	$search = array("[ae]","[Ae]","[oe]","[Oe]","[ar]","[Ar]");
	$replace = array("ä",  "Ä",   "ö",   "Ö",   "å",   "Å");
	
	$query = str_replace($search,$replace,$query);
	// http://stackoverflow.com/questions/1005857/how-to-call-php-function-from-string-stored-in-a-variable		
	
				
	// --------------------------------------------------------------------------------------------------------------------

	/**
	 * 
	 * Function exists part
	 * 
	 * Check if function available. This uses string as function name
	 * 
	 * @query["object_group"]	Param for function name
	 * @conn					Param for SQL query connections
	 * @query					Return parameter for main activity
	 */
		
		// Funktio pitää olla mainittu ennen kuin sen olemassaolo voidaan tarkistaa
		$query = (function_exists($query["object_group"])) ? $query["object_group"]($conn, $query) : "not exists";
		
	// --------------------------------------------------------------------------------------------------------------------

	/**
	 * 
	 * Query encoding and JSON encoding part
	 * 
	 * First encoding query to UTF-8 format, then to JSON format.
	 * 
	 * @query["object_group"]	Param for function name
	 * @conn					Param for SQL query connections
	 * @query					Return parameter for main activity
	 */

		function encode_items($array)
		{
		    foreach($array as $key => $value)
		    {
		        if(is_array($value))
		        {
		            $array[$key] = encode_items($value);
		        }
		        else
		        {
		            $array[$key] = mb_convert_encoding($value,'UTF-8');
		        }
		    }
		
		    return $array;
		}
		$query = encode_items($query);
		$query = json_encode($query,  JSON_FORCE_OBJECT);
	
		
		unset($q);
		return $query;
		
		
	}
}
?>