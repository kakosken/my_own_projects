/**
 * 
 * JavaScript file for Calendar
 * 
 * This is an interface between end-user and output-file. 
 * 
 * @package		JavaScript file for Calendar
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
	 * Calendar handler
	 * 
	 * @el	Param for element variable
	 */

	function handler(el)
	{
		
		if(el.id.split(":")[0]=="course_mgmt" && el.id.split(":")[2]=="add_course")
		{
			variables["object_group"] = el.id.split(":")[0]+"__"+el.id.split(":")[2];
			variables["result_screen"] = "course_list";
			variables["course_name"] = document.getElementById("course_mgmt::course_name").value;
			if(document.getElementById("course_mgmt::course_code"))
				variables["course_code"] = document.getElementById("course_mgmt::course_code").value;
			if(document.getElementById("course_mgmt::course_ects"))
				variables["course_ects"] = document.getElementById("course_mgmt::course_ects").value;
			if(document.getElementById("course_mgmt::course_material"))
				variables["course_material"] = document.getElementById("course_mgmt::course_material").value;
			if(document.getElementById("course_mgmt::course_max_count_of_participants"))
				variables["course_max_count_of_participants"] = document.getElementById("course_mgmt::course_max_count_of_participants").value;
			//alert(document.getElementById("calendar_duration").childNodes[0].childNodes[0].innerHTML);
			variables["course_duration_1"] = document.getElementById("calendar_duration").childNodes[0].childNodes[0].innerHTML;
			variables["course_duration_2"] = document.getElementById("calendar_duration").childNodes[1].childNodes[0].innerHTML;
		}
		
		if(el.name.split(":")[0]=="course_mgmt" && el.name.split(":")[2]=="delete_course")
		{
			variables["object_group"] = el.name.split(":")[0]+"__"+el.name.split(":")[2];
			variables["object_id"] = el.name.split(":")[1];
			variables["object_id_to_remove"] = el.name.split(":")[0]+":"+el.name.split(":")[1]+":list_element";
			variables["result_screen"] = "course_list";
		}	
		
		if(variables["modal_window_exit"] == "" && variables["modal_window_status"] == "close")
			document.getElementById("market_scouting_frame").style.display = 'none';
		else
		{
		
			
		var json_variables = JSON.stringify(variables);
		
		json_variables = json_variables.replace(/�/g,"[ae]")
										.replace(/�/g,"[Ae]")
										.replace(/�/g,"[oe]")
										.replace(/�/g,"[Oe]")
										.replace(/�/g,"[ar]")
										.replace(/�/g,"[Ar]");
		get_information(json_variables);
		}
	}
	
	// --------------------------------------------------------------------------------------------------------------------

	/**
	 * 
	 * XMLHttpRequest - part
	 * 
	 * NOT return val
	 * 
	 * @variables		Param for variables
	 * @XMLHttpRequest	Param for XMLHttpRequest
	 */

	function get_information(variables)
	{
										// code for IE7+, Firefox, Chrome, Opera, Safari // code for IE6, IE5 
		xmlhttp=(window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			// http://www.ozzu.com/programming-forum/ajax-multiple-responses-with-one-request-t89454.html
				if(xmlhttp.responseText.search("<b>Warning</b>:")>0)
					alert("Content: <br/> "+xmlhttp.responseText);
				secretary(xmlhttp.responseText);
			}
		};
		
		var o ="output.php?query="+variables;
		xmlhttp.open("GET",o,true);
		//Send the proper header information along with the request
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// http://stackoverflow.com/questions/7210507/ajax-post-error-refused-to-set-unsafe-header-connection
		// xmlhttp.setRequestHeader("Content-length", o.length);
		// xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send();
	}
	
	//--------------------------------------------------------------------------------------------------------------------
	
	/**
	 * 
	 * Data handling
	 * 
	 * @conn	Param for SQL query connections
	 * @query	Return parameter for main activity
	 */
	
	function secretary(information_without_parse)
	{
		information = JSON.parse(information_without_parse);
		
		if(typeof eval(information["object_group"]) == 'function')
		{
			var output = "";
			eval(information["object_group"])(information);
		}
		
		//--------------------------------------------------------------------------------------------------------------------
	
		/**
		 * 
		 * The function farm
		 * 
		 * Includes all data, which is from database.
		 * 
		 * @information	Param for data
		 */
		
			//--------------------------------------------------------------------------------------------------------------------
		
			/**
			 * 
			 * Function course_mgmt__add_course
			 * 
			 * @information	Param for data
			 */
			function course_mgmt__add_course(information)
			{
				a=document.getElementById("eventlist");
				b=document.createElement("div");
				b.id="course_mgmt:"+information["result"]["id"]+":list_element";
				b.style.height="25";
				b.style.backgroundColor="#aaa666";
				c ="";
				c+= "[<span style=\"font-size:12;\"><a href=\"javascript:;\" name=\"event_settings\">"
						+information["course_duration_1"]+"</a></span>]"; // </span>, $time_difference]
				c+= "<a href=\"javascript:;\">("+information["result"]["max_count_of_participant"]+") "
					+information["result"]["code"]+ " "+information["result"]["name"]+ " ("+information["result"]["ects"]+" ects)</a>";
				c+= "<a name=\"course_mgmt:"+information["result"]["id"]+":delete_course\" href=\"javascript:;\" " +
						"style=\"float:right;margin: 2 2 0 0;\" onclick=\"handler(this);\" style=\"float:right;\" >&times;</a>";
				c+= "<input type=\"button\" value=\"ilmoittaudu\" style=\"float:right;\" />";
				b.innerHTML=c;
				a.appendChild(b);
				d=document.getElementById("floating_element").style;
				d.visibility="hidden";
				d.display="none";
				
				bootloader('boot_type__launch_week_notifier_only');
			}
			
			//--------------------------------------------------------------------------------------------------------------------
			
			/**
			 * 
			 * Function course_mgmt__delete_course
			 * 
			 * @information	Param for data
			 */
			
			function course_mgmt__delete_course(information)
			{
				if(document.getElementById(information["object_id_to_remove"]))
				{
					
					a=document.getElementById(information["object_id_to_remove"]);
					a.parentNode.removeChild(a);
				}
				
				
				// t�� lis�tty, niin kalenteri p�ivittyy automatic
				bootloader('boot_type__launch_week_notifier_only');
			}
			
			//--------------------------------------------------------------------------------------------------------------------
			
			/**
			 * 
			 * Function boot_type__launch_week_notifier_only
			 * 
			 * @information	Param for data
			 */
			
			function boot_type__launch_week_notifier_only(information)
			{
				aa ="";
				if(information["result"]!=0)	{
					aa+="<p>Ilmoittautumisajat t�lle viikolle ";
					for(a in information["result"])
						aa+="<div>"+information["result"][a]["code"]+" "+information["result"][a]["name"]+"</div>";
					aa+="</p>";
				}	else	{
					aa+="<p>Ilmoittautumisajat t�lle viikolle: ";
					aa+="<b>Aiheuta s�pin�� ja sutinaa kavereillesi luomalla <input id=\"create_event_shortcut\" " +
							"placeholder=\"lis�� h�ppeninki�!\" /></b>";
					aa+="</p>";
				}
	
				aa+= "<br/>Nyt on vuoden "+information["datetime_specs"]["now_year"]+" " +
						"viikko "+information["datetime_specs"]["now_week"]+", ";
				aa+= "saatavilla tietoja viikoille "+information["datetime_specs"]["available"]+". " +
						"N�ytet��n viikko "+information["datetime_specs"]["selected"]+".";
				aa+= "daa"+information["datetime_specs"]["fdow"];
				
				aa+= "Viikoille muutoksia: ...";//+" "+information["query_size"];
				aa+= "<br/>N�ytetylle viikolle "+Object.keys(information["timetable_list"]).length+" pv:lle tapahtumaa";
				aa+= "<br/>Earliest time: "+information["timetable_limits"]["week_e"]+", ";
				aa+= "latest: "+information["timetable_limits"]["week_l"]+", ";
				aa+= "aikaero: "+information["timetable_limits"]["week_d"]+" tuntia. ";
				aa+= "kahden tunnin jaksoja: <span id=\"week_2hours_dimensions\">" +
						""+information["timetable_limits"]["week_2hours_dimensions"]+"</span> kappaletta";
				aa+= "<br/>P��llekk�isyydet/Huomioitavaa: (laita t�� tohon alemman Week-rivin oikeaan laitaan)";
				aa+= "<br/>&nbsp;";
				aa+= "</div>";
				document.getElementById(information["result_screen"]).innerHTML=aa;
				
				wa = "";
				for(i=1;i<6;i++)
				{
					wa+= "<div id=\"day_"+i+"\" style=\"width:150;border:1px solid;margin: 0 5;float:left;\">";
					wa+= "</div>";
				}
				document.getElementById("calendar_week").innerHTML=wa;
				
				w= {1: "Maantani", 2: "Tiistai", 3: "Keskiviikko", 4: "Torstai", 5: "Perjantai"};
				
				for(d in information["week_days_list"])
				{
					dtp = information["week_days_list"][d]["date"].split(".");
					datetime = information["datetime_specs"]["now_year"]+"-"+dtp[1]+"-"+dtp[0];
					daily_datetime = information["timetable_list"][datetime];
					
					x="";
					xz = document.createElement("div");
					// kalenterip�iv�n pvm + "x tapahtumaa" -kohdan korkeus
					xz.style.height="35";
					
					//x+="<div>";
					x+="<a href=\"javascript:;\" id=\"calendar_detail::add_new_thing::"+w[d]+"\" " +
							"name=\"calendar_detail::add_new_thing::"+w[d]+"::"+information["week_days_list"][d]["date"]+"\" " +
									"onclick=\"quick_handler(this);\" title=\"Lis�� tapahtuma...\">";
					x+=w[d]+" ("+information["week_days_list"][d]["date"]+")</a></div>";
					x+="<div style=\"border-bottom:1px solid;font-weight:bold;background-color:lightblue;\">";
					x+="<center>";
					if(typeof information["timetable_list"][datetime] == 'object')
					{
						x+= Object.keys(information["timetable_list"][datetime]).length + " tapahtumaa";
						if(Object.keys(information["timetable_list"][datetime]).length>0)
							n = "1px solid";
							bk= "skyblue";
					}	else	{
						x+= "Ei tapahtumia";
						n = "1px dotted";
						bk="#ffffff";
					}
					//x+="10 tapahtumaa";
					x+="</center>";
					//x+="</div>";
					xz.innerHTML=x;
					xx= "";
					day_agenda = document.createElement("div");
					x1=document.getElementById("week_2hours_dimensions").innerHTML;
					x2=(x1*75)+42;
					day_agenda.style.height=x2;
					
					// t�h�n p��ttyy p�iv�n pituuden m��ritys
					
					day_agenda.appendChild(xz);
					
					
					for(dimension in information["timetable_limits"]["time_dimensions"])
					{
						dim = information["timetable_limits"]["time_dimensions"][dimension].split("+0200")[0];
						if(typeof daily_datetime == 'object')
						{
							if(dim in daily_datetime)
							{
								//console.log("up2")
								for(k in daily_datetime[dim])
								{
									xy="<a name=\"course_mgmt:"+daily_datetime[dim][k]["id"]+":delete_course\" " +
											"href=\"javascript:;\" style=\"float:right;margin: 0 5;\" title=\"Delete this\"  " +
											"onclick=\"handler(this);\">&times;</a>";
									xy+= "klo " + dim + "<br/> "+daily_datetime[dim][k]["name"];
									xy+= "<br/><a name=\"event_modify:"+daily_datetime[dim][k]["name"]+":change_duration:up\" " +
											"href=\"javascript:;\" onclick=\"handler(this);\">Up</a> / ";
									xy+= "<a name=\"event_modify:"+daily_datetime[dim][k]["name"]+":change_duration:down\" " +
											"href=\"javascript:;\" onclick=\"handler(this);\">Down</a>";
									xy+= "<br/>^ ei viel� toimi!";
									
									day_moment = document.createElement("div");
									day_moment.id="event_"+datetime+" "+dim;
									day_moment.style.height="75";
									day_moment.style.border="1px solid";
									day_moment.innerHTML=xy;
									
									day_agenda.appendChild(day_moment);
									delete daily_datetime[dim][k];
								}
							}	else	{ 
									day_moment = document.createElement("div");
									day_moment.id="event_"+datetime+" "+dim;
									day_moment.style.height="75";
									day_moment.style.border="0px solid";								
									day_agenda.appendChild(day_moment);
							}
						}
						
					}
					
					document.getElementById("day_"+d).appendChild(day_agenda);
					document.getElementById("day_"+d).style.border=n;
					document.getElementById("day_"+d).style.backgroundColor=bk;
					
					
					nn = document.createElement("div");
					nn.id="event_2016-04-11 08:00:00";
					document.getElementById("day_"+d).appendChild(nn);
								
					var list = document.getElementsByClassName("day_length");
					for (var i = 0; i < list.length; i++) {
					    list[i].style.margin="5 2";
					}
				}
		
				if(typeof(information["timetable_limits"]) === "object")
				{
					for(a in information["timetable_limits"]["daily"]["earliest_time"])
					{
						times = document.getElementsByClassName("daily_times:"+a);
						zxc=information["timetable_limits"]["daily"]["earliest_time"][a]+" - " +
								""+information["timetable_limits"]["daily"]["latest_time"][a];
						for(i=0;i<times.length;i++)
						{	
							zxc+= " Vapaita aikoja (1): <a href=\"javascript:;\">2.15 - 4.00</a>";
							times[i].innerHTML=zxc;
						}
					}
					
				}
			}
			
			//--------------------------------------------------------------------------------------------------------------------
			
			/**
			 * 
			 * Function boot_type__launch_week_notifier
			 * 
			 * @information	Param for data
			 */
	
			function boot_type__launch_week_notifier(information)
			{
				if(information["result"]!=0){
					
					aa="<p>Ilmoittautumisajat t�lle viikolle ";
					for(a in information["result"])
					{
						aa+="<div>"+information["result"][a]["code"]+" "+information["result"][a]["name"]+"</div>";
					}
					
					aa+="</p>";
				}else{
					aa="<p>Ilmoittautumisajat t�lle viikolle ";
					aa+="<b>Aiheuta s�pin�� ja sutinaa kavereillesi luomalla <input id=\"create_event_shortcut\" " +
							"placeholder=\"lis�� h�ppeninki�!\" /></b>";
					aa+="</p>";
					
				}
				
				document.getElementById(information["result_screen"]).innerHTML=aa;
				bootloader('boot_type__launch_calendar');
			}
			
			//--------------------------------------------------------------------------------------------------------------------
			
			/**
			 * 
			 * Function boot_type__launch_calendar
			 * 
			 * @information	Param for data
			 */
			
			function boot_type__launch_calendar(information)
			{
				a=information["result"]["week_look"];
				document.getElementById("calendar_this_week").value=information["result"]["week"];
				document.getElementById("calendar_under_const").value=information["result"]["week_list"];
				document.getElementById(information["result_screen"]).innerHTML=a;
				
				bootloader('boot_type__build_calendar');
			}
			
			//--------------------------------------------------------------------------------------------------------------------
			
			/**
			 * 
			 * Function boot_type__build_calendar
			 * 
			 * @information	Param for data
			 */
	
			function boot_type__build_calendar(information) 
			{
				document.getElementById("calendar_under_const").value=information["result"]["week_list"];
				a=document.getElementById(information["result_screen"]);
				b = document.createElement("div");
				b.id="week_line:"+information["week_id"];
				b.style.overflow="auto";
				b.innerHTML=information["result"]["week_look"];
				a.insertBefore(b, a.childNodes[0]);
				
				if(document.getElementById("calendar_under_const").value!="{}")
					bootloader('boot_type__build_calendar');
			}
	}
	
	//--------------------------------------------------------------------------------------------------------------------
	
	/**
	 * 
	 * Bootloader
	 * 
	 * This part launch calendar and rebuild it if needed
	 * 
	 * @o	Param for data
	 */
	
	function bootloader(o)
	{
		if (typeof eval(o) == 'function')
		{
			variables = {};
			variables = eval(o)(o);
			
			if(variables["modal_window_exit"] == "" && variables["modal_window_status"] == "close")
				document.getElementById("market_scouting_frame").style.display = 'none';
			else
			{
				
			var json_variables = JSON.stringify(variables);
			
			json_variables = json_variables.replace(/�/g,"[ae]")
											.replace(/�/g,"[Ae]")
											.replace(/�/g,"[oe]")
											.replace(/�/g,"[Oe]")
											.replace(/�/g,"[ar]")
											.replace(/�/g,"[Ar]");
			get_information(json_variables);
			}
		}
	
		//--------------------------------------------------------------------------------------------------------------------
	
		/**
		 * 
		 * The function farm
		 * 
		 * @o		Param for input data
		 * @return	Param for return data
		 */
		
		
		
		function boot_type__launch_week_notifier(o)
		{
			variables["object_group"]=o;
			variables["result_screen"]="calendar_week_notification";
			return variables;
		}
		
		function boot_type__launch_week_notifier_only(o)
		{
			variables["object_group"]=o;
			variables["result_screen"]="calendar_week_notification";
			return variables;
		}
		
		function boot_type__launch_calendar(o)
		{
			variables["object_group"]=o;
			variables["result_screen"]="course_mgmt::timetable_mgmt";
			return variables;
		}
		
		function boot_type__build_calendar(o)
		{
			variables["object_group"]=o;
			variables["week_list"] = document.getElementById("calendar_under_const").value;
			variables["result_screen"]="course_mgmt::timetable_mgmt";
			return variables;
		}
		
		function boot_type__new_set_up_calendar(o)
		{
			variables["object_group"]=o;
			variables["result_screen"]="course_mgmt::timetable_mgmt";
			variables["this_week"] = document.getElementById("calendar_this_week").value;
			return variables;
		}
		
	}
	
	function quick_handler(el)
	{
		if(el.id.split(":")[0]=="calendar" && el.id.split(":")[2]=="set_up")
		{
			x=document.getElementById("calendar_duration");
			if(x.children.length<2)
			{
				a=document.createElement("span");
				a.id="calendar:"+el.id.split(":")[1]+":duration";
				a.innerHTML="<span>"+el.id.split(":")[1]+ "</span><a name=\"calendar:"+el.id.split(":")[1]+":duration\" href=\"javascript:;\" onclick=\"quick_handler(this);\">&times;</a>";
				a.style.border="1px solid";
				a.style.padding="0 2";
				document.getElementById("calendar_duration").appendChild(a);
				document.getElementById(el.id).style.backgroundColor="skyblue";
				document.getElementById("calendar_notification").innerHTML="Valittuna "+x.children.length+" elementti�.";
			}
			else
				document.getElementById("calendar_notification").innerHTML="Kerrallaan voi olla valittuna 2 pvm.";
		}
		if(el.id.split(":")[0]=="calendar" && el.id.split(":")[4]=="set_time")
		{
			x=document.getElementById("calendar_duration");
			if(x.children.length<2)
			{
				a=document.createElement("span");
				a.id="calendar:"+el.id.split(":")[1]+":"+el.id.split(":")[2]+ ":"+el.id.split(":")[3]+ ":time_duration";
				b="<span>"+el.id.split(":")[1]+ ":"+el.id.split(":")[2]+ ":"+el.id.split(":")[3]+ "</span>";
				b+="<a name=\"calendar:"+el.id.split(":")[1]+":"+el.id.split(":")[2]+ ":"+el.id.split(":")[3]+ ":time_duration\" " +
						"href=\"javascript:;\" onclick=\"quick_handler(this);\">&times;</a>";
				a.innerHTML=b;
				a.style.border="1px solid";
				a.style.padding="0 2";
				document.getElementById("calendar_duration").appendChild(a);
				document.getElementById(el.id).style.backgroundColor="skyblue";
				document.getElementById("calendar_notification").innerHTML="Valittuna "+x.children.length+" elementti�.";
			}
			else
				document.getElementById("calendar_notification").innerHTML="Kerrallaan voi olla valittuna 2 pvm.";
		}
		else if(el.name.split(":")[0]=="calendar" && el.name.split(":")[2]=="duration")
		{
			document.getElementById(el.name.split(":")[0]+":"+el.name.split(":")[1]+":set_up").style.backgroundColor="white";
			a=document.getElementById(el.name);
			a.parentNode.removeChild(a);
			x=document.getElementById("calendar_duration");
			if(x.children.length>2)
				document.getElementById("calendar_notification").innerHTML="Valittuna "+x.children.length+" elementti�.";
			if(x.children.length<2)
				document.getElementById("calendar_notification").innerHTML="Valittuna "+x.children.length+" elementti.";
			if(x.children.length==0)
				document.getElementById("calendar_notification").innerHTML="Valitse alku- ja loppupvm.";
		}
		else if(el.name.split(":")[0]=="calendar" && el.name.split(":")[4]=="time_duration")
		{
			document.getElementById(el.name.split(":")[0]+":"+el.name.split(":")[1]+":"+el.name.split(":")[2]+":"+el.name.split(":")[3]+":set_time").style.backgroundColor="white";
			a=document.getElementById(el.name);
			a.parentNode.removeChild(a);
			x=document.getElementById("calendar_duration");
			if(x.children.length>2)
				document.getElementById("calendar_notification").innerHTML="Valittuna "+x.children.length+" elementti�.";
			if(x.children.length<2)
				document.getElementById("calendar_notification").innerHTML="Valittuna "+x.children.length+" elementti.";
			if(x.children.length==0)
				document.getElementById("calendar_notification").innerHTML="Valitse alku- ja loppupvm.";
		}
		else if(el.name.split(":")[0]=="calendar_detail" && el.name.split(":")[2]=="add_new_thing")
		{
			o  = "<h4 style=\"margin:2;\">Lis�� h�ppeninki�.";
			o += "<input id=\"course_mgmt::add_course\" type=\"button\" value=\"Done\" onclick=\"handler(this);\" " +
					"style=\"float:right;\"/>";
			o += "</h4>";
			o += "<input id=\"course_mgmt::course_name\" placeholder=\"Name your course...\" />";
				
			if(el.name.split(":")[4]=="Add2")
			{
					o += "<h4 style=\"margin-bottom:0;border-bottom:1px solid;\">Additional Information</h4>";
							o += "<div id=\"course_list\">";
					o += "<input id=\"course_mgmt::course_code\" placeholder=\"Give a coursecode\" />";
					o += "<input id=\"course_mgmt::course_ects\" placeholder=\"ECTS\" />";
					o += "<input id=\"course_mgmt::course_material\" placeholder=\"Course Material\" />";
					o += "<h4 style=\"margin-bottom:0;border-bottom:1px solid;\">Reserve a space</h4>";
					o += "<input id=\"course_mgmt::course_max_count_of_participants\" placeholder=\"Max count of participants\" />";
					o += "<br/>Montako osallistujaa kurssilla on yleens� ollut &amp; mink�kokoisia tiloja on olemassa -> voi automaattisesti";
					o += "valita/ehdottaa sopivat tilat.<br/>";
					o += "<a href=\"\">Enint��n tai hieman yli 20</a> <a href=\"\">Enint��n tai hieman yli 50</a>";
					o += "<a href=\"\">Enint��n tai hieman yli 100</a> <a href=\"\">Enint��n tai hieman yli 200</a>";
					o += "<h4 style=\"margin-bottom:0;border-bottom:1px solid;\">Tarvittava aika</h4>";
					o += "T�m�n avulal voidaan tilakalenterista valita tilanteeseen sopivin vaihtoehto.<br/>";
					o += "<a href=\"javascript:;\">2h</a> <a href=\"javascript:;\">4h</a>";
					o += " <a href=\"javascript:;\">6h</a> <a href=\"javascript:;\">8h</a>";
					o += "<h4 style=\"margin-bottom:0;border-bottom:1px solid;\">N�kyvyys</h4>";
					o += "Mainos n�kyy kaikille vain klo 8-10 / Mainos n�kyy mainostajille / n�kyy muulloinkin kuin py�ritysaikana";
					
					o += "<h4 style=\"margin-bottom:0;border-bottom:1px solid;\">Calendar Spectrum</h4>"; // ...and physics is boring?
					o += "<label><input type=\"radio\" />Ilmoittautumisaika</label><br/>"; 
					o += "<label><input type=\"radio\" />K�ynniss�olon aika</label><br/>"; // tapahtuman kesto/aikataulu
					o += "<label><input type=\"radio\" />Teht�v�n voimassaoloaika</label><br/>";
			}
			o += "<p>Selected Dates: <span id=\"calendar_duration\"></span><br/>";
			o += "<span id=\"calendar_notification\"></span></p>";
			if(el.name.split(":")[4]=="Add2")
			{
				
				o += "<div id=\"course_mgmt::timetable_mgmt\" style=\"overflow:auto;border:1px solid;\">";
				
				o += "</div>";
				
				o += "</div>";
		
				o += "<div id=\"register_mgmt\">";
				o += "<input id=\"calendar_this_week\" type=\"hidden\" value=\"\" />";
				o += "<input id=\"calendar_under_const\" type=\"hidden\" value=\"\" />";
				o += "</div>";
			}
				if(el.name.split("::")[3])
				{
					daytime = "2016-"+el.name.split("::")[3].split(".")[1]+"-"+el.name.split("::")[3].split(".")[0];
					o+= "<br/>Mist� - Mihin:<br/>";
					o+= "<div style=\"overflow:auto;\">";
					o+= "<div style=\"float:left;margin: 5px;\">";
						for(kello=0;kello<24;kello++)
						{
							if((kello%2)==0)
							{
								if(kello<10)
								{
									o+= "<div id=\"calendar:"+daytime+" 0"+kello+":00:00:set_time\" onclick=\"quick_handler(this);\">" +
											"<a href=\"javascript:;\">";
								
									o+= daytime+" 0"+kello+":00:00";
									o+= "</a></div>";
								}
								else
								{
									o+= "<div id=\"calendar:"+daytime+" "+kello+":00:00:set_time\" onclick=\"quick_handler(this);\">" +
											"<a href=\"javascript:;\">";
									o+= daytime+" "+kello+":00:00";
									o+= "</a></div>";
								}
							}
						}
					o+= "</div>";
					o+= "</div>";
				}
				
			float_ele = el.name.split("::")[0]+"::"+el.name.split("::")[1]+"::"+el.name.split("::")[2];
			floating_element(float_ele, "floating_element", o);
			
			bootloader('boot_type__launch_week_notifier_only');
		}
		else if(el.name.split(":")[0]=="calendar_detail" && el.name.split(":")[2]=="now")
		{
			o  = "<p>Saatavilla on X tapahtumaa.</p>";
			o += "<p>Aiheuta s�pin�� ja sutinaa kavereillesi luomalla  <input id=\"event_shortcut\" " +
					"placeholder=\"lis�� h�ppeninki�!\" /></p>";
			document.getElementById("sidebar_list").innerHTML=o;
		}
		
	}
	
	//--------------------------------------------------------------------------------------------------------------------
	
	/**
	 * 
	 * Floating element
	 * 
	 * @element_name	Param for element. This coordinates location for result_screen
	 * @result_screen	Param for result screen
	 * @output			Param for output data
	 */
	
	function floating_element(element_name, result_screen, output)
	{
		var information = {};
		information["element_name"] = element_name;
		information["result_screen"] = result_screen;
		
		var el = document.getElementById(information["element_name"]);
		for (var plx=0, ply=0, plw=0, plh=0;
	    el != null;
	    plx += el.offsetLeft, ply += el.offsetTop, plw += el.offsetWidth, plh += el.offsetHeight, el = el.offsetParent);
		 
		for (var p2lx=0, p2ly=0, p2lw=0, p2lh=0;
	    el != null;
	    p2lx += el.offsetLeft, p2ly += el.offsetTop, p2lw += el.offsetWidth, p2lh += el.offsetHeight, el = el.offsetChild);
		
		var search_content = document.getElementById(information["result_screen"]);
		var empty_search = document.getElementById(information["element_name"]);
		
		new_sc = (search_content.style.width.split("px")[0]*1)/2;
		search_content.style.marginLeft=plx-new_sc;//plx/2;
		var content_height = empty_search.style.height.split("px")[0]*1+ply+8;//+ply/1.5;
		search_content.style.marginTop=content_height;
		
		screen = document.getElementById(information["result_screen"]);
		
		screen.innerHTML=output;
		screen.style.visibility="visible";
		screen.style.display="block";
		screen.style.backgroundColor="#ffffff";
		screen.style.border="1px solid";
		screen.style.width="400";
	}