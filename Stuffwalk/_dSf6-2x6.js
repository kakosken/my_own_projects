/*
 * 
 *
 * Vois tehdä siten, että lähettää body onload -homman yhteydessä, että haetaan js-dataa
 * joita sitten käytetään ajon aikana. Tulee siistimpi js-tiedosto.
 * Ja tavaraa ladataan vain käytön mukaan, ei enempää.
 * Tähän riittää ku lähetetään get/post kohteeseen X ja siihen tarvitaan vain istunto-id, että ollaan sisällä.
 * Näin ollen ei tarvitse näitä varsinaisia "ihmisille näkyviä" koodisivuja muutella sen enempää.
 *  
 * Body onload -> javascript-xmlhttp.request (post) -> response (all major data)
 * Script/NoScript -tarkistus
 * >> tällöin ei pitäisi näkyä mitä js-settiä tulee & samoin HTML-settikin saadaan mallikkasti piilotettua!
 * Palvelimelle: white-hat -ohjelma.
 *
SESSION
id tunnusta varten, time milloin istunto alkanut, server hash "varmennusta varten; joka kerralla random -> ei voi haxata
session(id, login time, ip, server hash)
eri koneille eri hash-code, joten konekohtainen hash.

TIPS
http://stackoverflow.com/questions/249074/how-to-change-onclick-handler-dynamically

*/
/*
function timeSince(date) {

    var seconds = Math.floor((new Date() - date) / 1000);

    var interval = Math.floor(seconds / 31536000);

    if (interval > 1) {
        return interval + " years";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) {
        return interval + " months";
    }
    interval = Math.floor(seconds / 86400);
    if (interval > 1) {
        return interval + " days";
    }
    interval = Math.floor(seconds / 3600);
    if (interval > 1) {
        return interval + " hours";
    }
    interval = Math.floor(seconds / 60);
    if (interval > 1) {
        return interval + " minutes";
    }
    return Math.floor(seconds) + " seconds";
}*/


function startup_initial(profile_id, product_id,connector_id,index)
{

	/*
	
		For load new content TO compatiblewith-part.
		
	*/
	var handler = "market_scout=initial&profile_id="+profile_id+"&product_id="+product_id+"&connector_id="+connector_id;
	
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
		// var baby_monitor = xmlhttp.responseText.split("\r\n"); // pick a data from url
		var baby_monitor = xmlhttp.responseText; // pick a data from url
		// document.write(baby_monitor);
		// document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
		// document.getElementById("cx_result").value=baby_monitor[1]; // pick a data from url
		document.getElementById("trade_agreement_content").innerHTML=baby_monitor; // pick a data from url
		
		/*
		document.getElementById("cx_count").innerHTML=baby_monitor[0]; // pick a data from url
		document.getElementById("cx_result").innerHTML=baby_monitor[1]; // pick a data from url
		var cx_array=document.getElementById("connector_array");
		cx_array.innerHTML=baby_monitor[2]; // pick a data from url
		cx_array.style.visibility="visible";
		cx_array.style.display="block";
		*/
			/*
			if(cx_array.length>0)
			{
			cx_array.style.visibility="visible";
			}
			*/
		}
		// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
	};
	var url ="receiver.php";
	// var data ="create_new_connector="+new_connector_info+"&who_did_that="+profile;
	var data =handler;
	// document.write(url+"?"+data);
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();

	/*
		The ordinary/actual boot_init
		http://www.javascripter.net/faq/screensi.htm
		http://stackoverflow.com/questions/2474009/browser-size-width-and-height
	*/
	screenW = screen.width;
	screenH = screen.height;
	winWidth=document.all?document.body.clientWidth:window.innerWidth; 
	winHeight=document.all?document.body.clientHeight:window.innerHeight;
	
	/* sijainnin oikaisu, tarvittaessa piilota kaikki seuraavaan kommenttiin asti */
	
	var el = document.getElementById("classification"), el2=document.getElementById("classification"), element =document.getElementById("classification");
	var el3 = document.getElementById("main"), el4=document.getElementById("main"), element2 =document.getElementById("main");
	var el5 = document.getElementById("mainwindow"), el6=document.getElementById("mainwindow"), element3 =document.getElementById("mainwindow");
	
	//document.write("Ööö...");
	
	for (var plw=0, pl=0;
			 el != null;
			 plw += el.offsetWidth, pl +=el.offsetLeft, el = el.offsetParent);
			 
	for (var p2lw=0, p2l=0, p2t=0, p2h=0;
			 el2 != null;
			 p2lw += el2.offsetWidth, p2l +=el2.offsetLeft, p2t+=el2.offsetTop, p2h+=el2.offsetHeight, el2 = el2.offsetChild);
			 
	for (var p3lw=0, p3l=0;
			 el3 != null;
			 p3lw += el3.offsetWidth, p3l +=el3.offsetLeft, el3 = el3.offsetParent);
			 
	for (var p4lw=0, p4l=0;
			 el4 != null;
			 p4lw += el4.offsetWidth, p4l +=el4.offsetLeft, el4 = el4.offsetChild);

	for (var p5lw=0, p5l=0;
			 el5 != null;
			 p5lw += el5.offsetWidth, p5l +=el5.offsetLeft, el5 = el5.offsetParent);
			 
	for (var p6lw=0, p6l=0;
			 el6 != null;
			 p6lw += el6.offsetWidth, p6l +=el6.offsetLeft, el6 = el6.offsetChild);
	
	//var marginleft = plw/2-p2lw;
	//var marginlefthead = plw/2-p2lw*1.55;
	//element.style.marginLeft=marginleft;
	//document.write("daa");
	//document.write(marginleft);
	
	// document.write("classifciation: "+p2l+", main: "+p4l);
	// alert("classifciation: "+p2l+", classification (width): "+p2lw+", main: "+p4l+", class (top): "+p2t);
	// alert(winWidth/2-(p2lw+p6lw)/2 + "win "+ winWidth);
	if(winWidth/2-(p2lw+p6lw)/2 < 0)
	{
		var location = 0;
	}
	else
	{
		var location = winWidth/2-(p2lw+p6lw)/2;
	}
	var main_location =location+p2lw;
	document.getElementById("classification").style.marginLeft=location;
	document.getElementById("header_content").style.marginLeft=location;
	// document.getElementById("mainwindow").style.marginLeft=p2lw;
	document.getElementById("mainwindow").style.marginLeft=main_location;
	document.getElementById("mainwindow").style.marginTop=-p2h;
	
	//http://bytes.com/topic/javascript/answers/479963-check-if-object-exists
		
	// document.getElementById("main").innerHTML="classification: "+p2l+", main: "+p4l;
	
	//document.getElementById("frame").style.marginLeft=marginleft+"px";
	//document.getElementById("frame").style.marginLeft=marginleft+"px";
	//document.getElementById("classification").style.marginLeft=marginlefthead+"px";
	
	/*
	var location_x = document.getElementById("Favorites");
	<sijainninmäärittämiskoodi>
	document.getElementById("mainwindow").marginLeft=x+location_x;
	
	*/
	//alert("Screen width = "+screenW+", "+"Screen height = "+screenH+"\r\n Window width = "+winWidth+", "+"Window height = "+winHeight);
	
	
	return screenW, screenH, winWidth, winHeight;
}

function bootLoader(profile, product, timer)
{
	mysql_timer();
	test();
	testi12();
	fire_guard(profile, product, timer);
}

function directory_tree_shortcut(product_id, visibility)
{
	var object = document.getElementById("hover_"+product_id).style;
	//var checkbox = document.getElementById("hover_checkbox_"+product_id);
	var compatible = document.getElementById("hover_compatiblestuff_"+product_id);
	var exchange = document.getElementById("hover_exchange_status_"+product_id);
	var default_mode = document.getElementById("houtside_"+product_id).style;
	
	if(visibility =="view")
	{
		default_mode.visibility="hidden";
		default_mode.display="none";
		object.visibility="visible";
		object.position="absolute";
		object.zIndex=2;
		object.marginLeft=2;
		object.marginTop=3;
		//object.style.overflow="auto";
		//object.style.width=111;
		//object.style.height=111;
		object.display="block";
		//checkbox.style.marginLeft=1;
		//checkbox.style.marginTop=1;
		compatible.style.backgroundColor="#ffffff";
		compatible.style.border="1px solid";
		compatible.style.marginLeft=93;
		exchange.style.borderColor="#ccc33";
		compatible.style.position="absolute";
		//compatible.innerHTML="";
		exchange.style.backgroundColor="#ffffff";
		exchange.style.border="1px solid";
		exchange.style.marginTop=80;
		exchange.style.marginLeft=5;
		//exchange.style.zIndex=3;
		exchange.style.position="absolute";
		//exchange.innerHTML="";
		exchange.title="15 buyer (5 new)";
	}
	else
	{
		default_mode.visibility="visible";
		default_mode.display="block";
		object.visibility="hidden";
		object.display="none";
		
	}
}
/*
 * Ei käytössä / Not in use
 * 
 */
function directory_tree_shortcut_summary(tag, visibility)
{
	var object = document.getElementById("hover_"+product_id);
	var compatible = document.getElementById("hover_compatiblestuff_"+product_id);
	var exchange = document.getElementById("hover_exchange_status_"+product_id);
	object.style.visibility="visible";
	object.style.position="absolute";
	object.style.zIndex=2;
	object.style.marginLeft=2;
	object.style.marginTop=2;
	
}

function testi12()
{
	//document.getElementById("mindfuck").innerHTML="laa";
	if (document.getElementById("welcome_navigation") != null)
	{
			//document.getElementById("mindfuck").innerHTML="laa";
			var welcome_navigation = document.getElementById("welcome_navigation");
			var welcome_headers = welcome_navigation.childNodes;
			for(main_width=0;
			welcome_navigation!=null;
			main_width+=welcome_navigation.offsetWidth, welcome_navigation = welcome_navigation.offsetChild);
			
			var headers_width = new Array();
			var scalable_width = new Array();
			
			for(var i= 0; i < welcome_headers.length; i++)
			{
				var welcome_header_width = 0;
				if(welcome_headers[i]!=null)
				{
					welcome_header_width+=welcome_headers[i].offsetWidth, welcome_headers[i] = welcome_headers[i].offsetChild;
					headers_width.push(welcome_header_width);
				}
				
			}
			
			var dx_sum=0;
			for(value in headers_width)
			{
				dx_sum+=headers_width[value];
			}
			
			var dx="";
			var per_cent = "";
			var dx_percent=0;
			var scalable_width = new Array();
			for(value in headers_width)
			{
				dx+=", "+headers_width[value];
				per_cent+=", "+headers_width[value]/main_width*100;
				dx_percent+=", "+headers_width[value]/dx_sum;
				var dx_p="";
				dx_p = headers_width[value]/dx_sum*main_width;
				scalable_width.push(dx_p);
			}
			var xd = Math.max.apply(0,headers_width);
			//document.getElementById("mindfuck").innerHTML=main_width+" &dx "+dx+" <br/>&per_cent: "+per_cent+" <br/>&dx_sum: "+dx_sum+" <br/>&dx_per_cent: "+dx_percent;
			
			for(var i = 0; i < welcome_headers.length; i++) {
				welcome_headers[i].style.width=scalable_width[i]-2; // -2 = delete borders from left and right
			}
			
			var basic_information = document.getElementById("welcome_content_basic_information");
			var info_blocks = basic_information.childNodes;
			for(var i = 0; i < info_blocks.length; i++) {
				var blocks_selectbox = info_blocks[i].childNodes;
				for(var j = 0; j < blocks_selectbox.length; j++) {
					blocks_selectbox[j].onmouseover = function() {
				       //this.parentNode.style.backgroundColor = "#ff0000";
				       this.style.backgroundColor = "#ff0000";
				       //this.style.width=;
				    };
				    blocks_selectbox[j].onmouseout = function() {
				      //this.parentNode.style.backgroundColor = "#fff";  
				      this.style.backgroundColor = "#fff"; 
				      //this.style.width=;
				    };
				} 
			}
		
			var a = document.getElementsByTagName("a");
			for(var i = 0; i < a.length; i++) {
				a[i].onmouseover = function() {
					// this.style.textDecoration="blink";
					// this.style.textDecoration="inherit";
					this.style.textDecoration="underline";
			    };
			    a[i].onmouseout = function() {
			    	this.style.textDecoration="none";
			    };
			}
			
			
			
			var alacarte = document.getElementById("alacarte");
			var alacarte_blocks = alacarte.childNodes;
			for(var k = 0; k < alacarte_blocks.length; k++) {
				var alacarte_link = alacarte_blocks[k].childNodes;
				for(var l = 0; l < alacarte_link.length; l++) {
					alacarte_link[l].onmouseover = function() {
				       //this.parentNode.style.backgroundColor = "#ff0000";
						this.style.backgroundColor = "#D3D3D3";
						this.style.fontWeight="bold";
						/*if(this.childNodes[0].tagName =="a")
				    	{
							this.childNodes[0].style.textDecoration="underline";
				    	}*/
				       //this.style.width=;
				    };
				    alacarte_link[l].onmouseout = function() {
				      //this.parentNode.style.backgroundColor = "#fff";  
				    	this.style.backgroundColor = "#fff";
				    	this.style.fontWeight="";
				    	/*if(this.childNodes[0].tagName =="a")
				    	{
							this.childNodes[0].style.textDecoration="underline";
				    	}*/
				      //this.style.width=;
				    };
				}
			}
			/*
			var cp_width = document.getElementById("ta_content");
			for(var cpw = 0;
				cp_width != null;
				cpw +=cp_width.offsetWidth, cp_width = cp_width.offsetChild);
			var total_width = cpw/2-15;
			// http://stackoverflow.com/questions/5673588/expand-multiple-divs-to-fit-horizontal-width-of-screen
			var block = document.getElementsByClassName("block");
			for(var i = 0; i < block.length; i++)
		   {
				block[i].style.width = total_width;
		         // block.length; // total number of linksCount
		   }
			var block_new_height = new Array();
			for(var i= 0; i < block.length; i++)
			{
				var cph = 0;
				if(block[i]!=null)
				{
					cph+=block[i].offsetHeight, block[i] = block[i].offsetChild;
					block_new_height.push(cph);
				}
			}
			
			var dx = 0;*/
			/*
			for(u in block_new_height)
			{
				dx+=", "+block_new_height[u];
			}
			var xd = Math.max.apply(0,block_new_height);
			*/
			/*for(var i= 0; i < block.length; i++)
		   {
				//block[i].style.height = block_new_height.max;
				block[i].style.height = Math.max.apply(0,block_new_height);
		         // block.length; // total number of linksCount
		   }
			// http://stackoverflow.com/questions/6926167/mouseover-mouseout-change-background-color-on-all-tds-in-a-tr-at-the-same-time
			*/
			for(var i = 0; i < welcome_headers.length; i++) {
			    welcome_headers[i].onmouseover = function() {
			       //this.parentNode.style.backgroundColor = "#ff0000";
			       this.style.backgroundColor = "#ff0000";
			    };
			    welcome_headers[i].onmouseout = function() {
			      //this.parentNode.style.backgroundColor = "#fff";  
			      this.style.backgroundColor = "lightblue";//"#fff";  
			    };
			}
	}
}

function test()
{
	//document.getElementById("mindfuck").innerHTML="laa";
	
	if (document.getElementById("directory_tree_sort") != null)
	{
			//document.getElementById("mindfuck").innerHTML="laa";
			var welcome_navigation = document.getElementById("directory_tree_sort");
			var welcome_headers = welcome_navigation.childNodes;
			for(main_width=0;
			welcome_navigation!=null;
			main_width+=welcome_navigation.offsetWidth, welcome_navigation = welcome_navigation.offsetChild);
			//alert("action!");
			var headers_width = new Array();
			var scalable_width = new Array();
			
			for(var i= 0; i < welcome_headers.length; i++)
			{
				var welcome_header_width = 0;
				if(welcome_headers[i]!=null)
				{
					welcome_header_width+=welcome_headers[i].offsetWidth, welcome_headers[i] = welcome_headers[i].offsetChild;
					headers_width.push(welcome_header_width);
				}
				
			}
			
			var dx_sum=0;
			for(value in headers_width)
			{
				dx_sum+=headers_width[value];
			}
			
			var dx="";
			var per_cent = "";
			var dx_percent=0;
			var scalable_width = new Array();
			for(value in headers_width)
			{
				dx+=", "+headers_width[value];
				per_cent+=", "+headers_width[value]/main_width*100;
				dx_percent+=", "+headers_width[value]/dx_sum;
				var dx_p="";
				dx_p = headers_width[value]/dx_sum*main_width;
				scalable_width.push(dx_p);
			}
			var xd = Math.max.apply(0,headers_width);
			//document.getElementById("mindfuck").innerHTML=main_width+" &dx "+dx+" <br/>&per_cent: "+per_cent+" <br/>&dx_sum: "+dx_sum+" <br/>&dx_per_cent: "+dx_percent;
			//http://en.wikipedia.org/wiki/Web_colors
			for(var i = 0; i < welcome_headers.length; i++) {
				welcome_headers[i].style.width=scalable_width[i]-8; // -2 = delete borders from left and right
				welcome_headers[i].style.border="4px solid";
				welcome_headers[i].style.borderColor="powderBlue";
				welcome_headers[i].style.height=30;
				welcome_headers[i].style.textAlign="center";
				welcome_headers[i].style.padding="10 0 0 0";
				welcome_headers[i].style.backgroundColor = "lightblue";
				welcome_headers[i].style.textDecoration="none";
				//welcome_headers[i].style.verticalAlign="bottom";
			}
			/*
			var basic_information = document.getElementById("directory_tree_sort_tree_stuff");
			var info_blocks = basic_information.childNodes;
			for(var i = 0; i < info_blocks.length; i++) {
				var blocks_selectbox = info_blocks[i].childNodes;
				for(var j = 0; j < blocks_selectbox.length; j++) {
					blocks_selectbox[j].onmouseover = function() {
				       //this.parentNode.style.backgroundColor = "#ff0000";
				       this.style.backgroundColor = "#ff0000";
				       //this.style.width=;
				    };
				    blocks_selectbox[j].onmouseout = function() {
				      //this.parentNode.style.backgroundColor = "#fff";  
				      this.style.backgroundColor = "#fff"; 
				      //this.style.width=;
				    };
				} 
			}*/
		
			var a = document.getElementsByTagName("a");
			for(var i = 0; i < a.length; i++) {
				a[i].onmouseover = function() {
					// this.style.textDecoration="blink";
					// this.style.textDecoration="inherit";
					this.style.textDecoration="underline";
			    };
			    a[i].onmouseout = function() {
			    	this.style.textDecoration="none";
			    };
			}
			for(var i = 0; i < welcome_headers.length; i++) {
			    welcome_headers[i].onmouseover = function() {
			       //this.parentNode.style.backgroundColor = "#ff0000";
			       this.style.backgroundColor = "skyblue";//"#ff0000";
			    };
			    welcome_headers[i].onmouseout = function() {
			      //this.parentNode.style.backgroundColor = "#fff";  
			      this.style.backgroundColor = "lightblue";//"#fff";  
			    };
			}
	}
}
function directory_tree_view(element)
{
	var name = element.name;
	//alert(name);
	var handler = "directory_tree_view_for="+name;
	
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
		document.getElementById("directory_tree_model").innerHTML=baby_monitor[0];
		}
		// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
	};
	var url ="receiver.php";
	// var data ="create_new_connector="+new_connector_info+"&who_did_that="+profile;
	var data =handler;
	// document.write(url+"?"+data);
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();
	
}

function modify_modal_window(parent_product_id, product_id, direction)
{
	
	
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
		document.getElementById("").innerHTML=baby_monitor[0];
		}
		// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
	};
	var url ="receiver.php?";
		url+="modify_modal_window_parent_product="+parent_product_id;
		url+="&modify_modal_window_product="+product_id;
		url+="&modify_modal_window_direction="+direction;
		
	xmlhttp.open("GET",url,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();
}

//function getting_started(step)
function getting_started(step)
{
	//document.writeln(step);
	var content = document.getElementById("welcome_content");
	var welcome_navigation = document.getElementById("welcome_navigation");
	var welcome_headers = welcome_navigation.childNodes;
	
	var content_block = content.childNodes;
	for(var i = 0; i < content_block.length; i++) {
		
		// content_block[i].style.visibility="hidden";
		// content_block[i].style.display="none";
		
		if(content_block[i].id == step)
		{
			content_block[i].style.visibility="visible";
			content_block[i].style.overflow="auto";
			content_block[i].style.display="block";
			/*
			if(welcome_headers[i].id == step)
			{
				this.style.backgroundColor = "#ff0000";
			}*/
			//content[i].childNodes.style.display="block";
			//content[i].childNodes.style.overflow="auto";
		}
		else
		{
			content_block[i].style.visibility="hidden";
			content_block[i].style.overflow="none";
			content_block[i].style.display="none";
			/*
			if(welcome_headers[i].id != step)
			{
				this.style.backgroundColor = "#ff0000";
			}*/
			//content[i].style.height=0;
			//content[i].childNodes.style.display="none";
			//content[i].childNodes.style.height=0;
		}
		
		var basic_information = document.getElementById("welcome_content_basic_information");
		var info_blocks = basic_information.childNodes;
		for(var m = 0; m < info_blocks.length; m++) {
			var blocks_selectbox = info_blocks[m].childNodes;
			for(var j = 0; j < blocks_selectbox.length; j++) {
				blocks_selectbox[j].onmouseover = function() {
			       //this.parentNode.style.backgroundColor = "#ff0000";
			       this.style.backgroundColor = "#ff0000";
			       //this.style.width=;
			    };
			    blocks_selectbox[j].onmouseout = function() {
			      //this.parentNode.style.backgroundColor = "#fff";  
			      this.style.backgroundColor = "#fff"; 
			      //this.style.width=;
			    };
			} 
		}
		
		/*
		welcome_headers[i].onmouseover = function() {
	       //this.parentNode.style.backgroundColor = "#ff0000";
	       this.style.backgroundColor = "#ff0000";
	    };
	    welcome_headers[i].onmouseout = function() {
	      //this.parentNode.style.backgroundColor = "#fff";  
	      //this.style.backgroundColor = "#fff"; 
	    };*/
	}
	
	/*
	var welcome_class = document.getElementById("welcome_content");
	content.style.visibility="hidden";
	current_view.style.visibility="visible";
	//document.getElementById("welcome_content_basic_information").style.visibility="hidden";
	//document.getElementById("welcome_content_basic_information").style.height=0;
	var mindfuck = document.getElementById("mindfuck");
	mindfuck.innerHTML=welcome_class.length;
	mindfuck.style.visibility="visible";*/
	/*for(var i = 0; i < content.length; i++) {
		content[i].style.visibility="hidden";
		//content[i].childNodes.style.display="none";
	}
		/*	
		welcome_headers[i].onmouseover = function() {
	       //this.parentNode.style.backgroundColor = "#ff0000";
	       this.style.backgroundColor = "#ff0000";
	       this.style.width=;
	    };
	    welcome_headers[i].onmouseout = function() {
	      //this.parentNode.style.backgroundColor = "#fff";  
	      //this.style.backgroundColor = "#fff"; 
	      this.style.width=;*/
	    //};
	//}
	
}

// http://www.digimantra.com/tutorials/sleep-or-wait-function-in-javascript/
//function sleep(ms)
function sleep(idprofile, product_id, timer)
{
	//alert(timer);
	var now = new Date();
	var time = new Date(timer);
	//var time = timer.split(/[- :]/);
	//var published = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
	//dt.setTime(dt.getTime() + ms);
	//dt.setTime(dt.getTime() + 4000);
	//while (new Date().getTime() < dt.getTime());
	time.setSeconds(time.getSeconds()+10);
	if((now-time)>0)
	{
		var body = document.body;
		var date = new Date();
		
		// http://stackoverflow.com/questions/221294/how-do-you-get-a-timestamp-in-javascript
		body.setAttribute("onmouseover","fire_guard('"+idprofile+"', '"+product_id+"', '"+Date()+"');");
		body.setAttribute("onmousemove","fire_guard('"+idprofile+"', '"+product_id+"', '"+Date()+"');");
		//this.onmouseover = function(){this.onmouseover="monitor('"+idprofile+"', '"+id+"', '"+dt.getTime()+"');";};
		//return (timer > new Date().getTime()) ? 0 : 1;
		return 0;
	}
	else
	{
		return 1;
	}
}

// fire guard (Castle) from Robin Hood
function fire_guard(profile_id, product_id,timer)
{	
	var now = new Date();
	var t = timer.split(/[- :]/);
	var time = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
	//time.setSeconds(time.getSeconds()+10);
	//time.setUTCDate();
	//document.write(now+" - "+time);
	//document.write(now-timer);
	if((now-time)>0)
	{
		var body = document.body;
		var date = new Date();
		body.setAttribute("onmouseover","fire_guard('"+profile_id+"', '"+product_id+"', '"+Date()+"');");
		body.setAttribute("onmousemove","fire_guard('"+profile_id+"', '"+product_id+"', '"+Date()+"');");
		var discontinue = 0;
		//document.write("discontinue "+discontinue);
	}
	else
	{
		var discontinue = 1;
	}
	//document.write(discontinue);
	//document.write("x "+profile_id+", "+product_id+", "+timer);
	//var discontinue = sleep(profile_id, product_id, timer);
	if(discontinue == 0)
	{
		var handler = "market_scout=monitor&profile_id="+profile_id+"&product_id="+product_id;
		
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
			// var baby_monitor = xmlhttp.responseText.split("\r\n"); // pick a data from url
			var baby_monitor = xmlhttp.responseText; // pick a data from url
			// document.write(baby_monitor);
			// document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
			// document.getElementById("cx_result").value=baby_monitor[1]; // pick a data from url
				/*if(baby_monitor == "")
				{
					document.getElementById("fire_guard").innerHTML="No queries";
				}
				else
				{
				document.getElementById("fire_guard").innerHTML=baby_monitor; // pick a data from url
				}*/
				document.getElementById("fire_guard").innerHTML=baby_monitor; // pick a data from url
			}
		};
		var url ="receiver.php";
		// var data ="create_new_connector="+new_connector_info+"&who_did_that="+profile;
		var data =handler;
		// document.write(url+"?"+data);
		xmlhttp.open("GET",url+"?"+data,true);
		//Send the proper header information along with the request
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", data.length);
		xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();
	}

}

function market_scout(profile_id, product_id, connector_id, index)
{
	/*
	
		For load new content TO compatiblewith-part.
		
	*/
	/*var profile_id = profile_id;
	var product_id = product_id;
	var connector_id = connector_id;
	var index = index;*/
	var handler = "market_scout=update&profile_id="+profile_id+"&product_id="+product_id+"&connector_id="+connector_id+"&index="+index;
	
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
		// document.write(baby_monitor);
		// document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
		// document.getElementById("cx_result").value=baby_monitor[1]; // pick a data from url
		
		// document.getElementById("market_scouting_header").innerHTML=baby_monitor[0]; // pick a data from url
		
		if(index == "refresh")
		{
			document.getElementById("ta_content").innerHTML=baby_monitor[1];
		}
		else
		{
			document.getElementById("trade_agreement_content").innerHTML=baby_monitor[1];
		}
		/*
		if(index != "")
		{
			document.getElementById("market_scouting_progress").innerHTML=baby_monitor[1]; // pick a data from url
		}
		else
		{
			document.getElementById("trade_agreement_content").innerHTML=baby_monitor[1]; // pick a data from url
		}
		/*
		document.getElementById("cx_count").innerHTML=baby_monitor[0]; // pick a data from url
		document.getElementById("cx_result").innerHTML=baby_monitor[1]; // pick a data from url
		var cx_array=document.getElementById("connector_array");
		cx_array.innerHTML=baby_monitor[2]; // pick a data from url
		cx_array.style.visibility="visible";
		cx_array.style.display="block";
		*/
			/*
			if(cx_array.length>0)
			{
			cx_array.style.visibility="visible";
			}
			*/
		}
		/*
		tällä olis tarkoitus suorittaa "thread/moniajo"
		.innerHTML=function()
		{
			setTimer(60*60*10);
			var item = function()
			{
			
			}
		}
		*/
		// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
	};
	var url ="receiver.php";
	// var data ="create_new_connector="+new_connector_info+"&who_did_that="+profile;
	var data =handler;
	// document.write(url+"?"+data);
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();
}


function mysql_timer()
{
	// http://stackoverflow.com/questions/3075577/convert-mysql-datetime-stamp-into-javascripts-date-format
	// http://stackoverflow.com/questions/2090551/parse-query-string-in-javascript
	// http://stackoverflow.com/questions/1968167/difference-between-dates-in-javascript
	// http://stackoverflow.com/questions/2617480/how-to-get-all-elements-which-name-starts-with-some-string
	var ss = []; // time ago
	var tl = []; // time left
	var inputs = document.getElementsByTagName("span");
	for(var i = 0; i < inputs.length; i++) {
	    if(inputs[i].id.indexOf('mysql_timer_') == 0) {
	        ss.push(inputs[i]);
	    }
	    if(inputs[i].id.indexOf('timeleft_timer_') == 0) {
	        tl.push(inputs[i]);
	    }
	}
	//document.getElementsByClassName(ss[0].class).innerHTML=ss.length;
	for(var u=0;u<ss.length;u++)
	{
		// http://stackoverflow.com/questions/3808808/how-to-get-element-by-class-in-javascript
		var t = ss[u].id.split(/mysql_timer_/)[1].split(/[- :]/);
		var q = ss[u].className;
		//var s = ss.id.split(/mysql_timer_/);
		//var t = s[1].split(/[- :]/);
		var now = new Date();
		var published = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
		var duration_ms = now-published;
		// math.ceil, math.floor, math.round
		if(Math.floor(duration_ms/(1000*60*60*24*30*12))>1)
		{
			var n  = Math.round(duration_ms/(1000*60*60*24*30*12));
			    n += " years";
		}
		else if(Math.floor(duration_ms/(1000*60*60*24*30*12))>0)
		{
			var n  = Math.round(duration_ms/(1000*60*60*24*30*12));
			    n += " year";
		}
		else if(Math.floor(duration_ms/(1000*60*60*24*30))>1)
		{
			var n  = Math.round(duration_ms/(1000*60*60*24*30));
				n += " months";
		}
		else if(Math.floor(duration_ms/(1000*60*60*24*30))==1)
		{
			var n  = Math.round(duration_ms/(1000*60*60*24*30));
				n += " month";
		}
		else if(Math.floor(duration_ms/(1000*60*60*24))>1)
		{
			var n  = Math.round(duration_ms/(1000*60*60*24));
				n += " days";
		}
		else if(Math.floor(duration_ms/(1000*60*60*24))==1)
		{
			var n  = Math.round(duration_ms/(1000*60*60*24));
				n += " day";
		}
		else if(Math.floor(duration_ms/(1000*60*60))>1)
		{
			var n  = Math.round(duration_ms/(1000*60*60));
				n += " hours";
		}
		else if(Math.floor(duration_ms/(1000*60*60))>0)
		{
			var n  = Math.round(duration_ms/(1000*60*60));
				n += " hour";
		}
		else if(Math.floor(duration_ms/(1000*60))>1)
		{
			var n  = Math.round(duration_ms/(1000*60));
				n += " minutes";
		}
		else if(Math.floor(duration_ms/(1000*60))>0)
		{
			var n  = Math.round(duration_ms/(1000*60));
				n += " minute";
		}
		else if(Math.floor(duration_ms/(1000))>1)
		{
			var n  = Math.round(duration_ms/(1000*60));
				n += " seconds";
		}
		else if(Math.floor(duration_ms/(1000))>0)
		{
			var n  = Math.round(duration_ms/(1000*60));
				n += " second";
		}
		else if(duration_ms<0)
		{
			
		}
				n += " ago";
		ss[u].innerHTML=n;
	}
	
	for(var u=0;u<tl.length;u++)
	{
		// http://stackoverflow.com/questions/1050720/adding-hours-to-javascript-date-object
		// http://stackoverflow.com/questions/563406/add-days-to-datetime-using-javascript
		var t = tl[u].id.split(/timeleft_timer_/)[1].split(/[- :]/);
		var q = tl[u].className;
		//var s = ss.id.split(/mysql_timer_/);
		//var t = s[1].split(/[- :]/);
		/*Date.prototype.addDays= function(h){
		    this.setDays(this.getDays()+h);
		    return this;
		};
		Date.prototype.addHours= function(h){
		    this.setHours(this.getHours()+h);
		    return this;
		};
		var today = new Date();
		var tomorrow = new Date();
		tomorrow.setDate(today.getDate()+1);*/
		
		var now = new Date();
		var published = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
		published.setDate(published.getDate()+14); // how much time needed to wait (days)
		var duration_ms = published-now;
		if(duration_ms>0)
		{
			if(Math.floor(duration_ms/(1000*60*60*24*30*12))>1)
			{
				var n  = Math.round(duration_ms/(1000*60*60*24*30*12));
				    n += " years";
			}
			else if(Math.floor(duration_ms/(1000*60*60*24*30*12))>0)
			{
				var n  = Math.round(duration_ms/(1000*60*60*24*30*12));
				    n += " year";
			}
			else if(Math.floor(duration_ms/(1000*60*60*24*30))>1)
			{
				var n  = Math.round(duration_ms/(1000*60*60*24*30));
					n += " months";
			}
			else if(Math.floor(duration_ms/(1000*60*60*24*30))>0)
			{
				var n  = Math.round(duration_ms/(1000*60*60*24*30));
					n += " month";
			}
			else if(Math.floor(duration_ms/(1000*60*60*24))>1)
			{
				var n  = Math.round(duration_ms/(1000*60*60*24));
					n += " days";
			}
			else if(Math.floor(duration_ms/(1000*60*60*24))>0)
			{
				var n  = Math.round(duration_ms/(1000*60*60*24));
					n += " day";
			}
			else if(Math.floor(duration_ms/(1000*60*60))>1)
			{
				var n  = Math.round(duration_ms/(1000*60*60));
					n += " hours";
			}
			else if(Math.floor(duration_ms/(1000*60*60))>0)
			{
				var n  = Math.round(duration_ms/(1000*60*60));
					n += " hour";
			}
			else if(Math.floor(duration_ms/(1000*60))>1)
			{
				var n  = Math.round(duration_ms/(1000*60));
					n += " minutes";
			}
			else if(Math.floor(duration_ms/(1000*60))>0)
			{
				var n  = Math.round(duration_ms/(1000*60));
					n += " minute";
			}
			else if(Math.floor(duration_ms/(1000))>1)
			{
				var n  = Math.round(duration_ms/(1000*60));
					n += " seconds";
			}
			else if(Math.floor(duration_ms/(1000))>0)
			{
				var n  = Math.round(duration_ms/(1000*60));
					n += " second";
			}
			n += " left";
		}
		else if(duration_ms<0)
		{
			//var n = q+" "+z.id;
			var n = "";
			// miksei vois olla niin että onclick olis valmiina, mutta input value muuttuis vain.
			var o = {"payment_button":"market_scouting...",
					"delivery_button":"market_scouting...",
					"arrive_button":"market_scouting...",
					"ror_button":"market_scouting..."
					};
			if (document.getElementById(q))
			{
				var m = document.getElementById(q);
				m.removeAttribute("disabled");
				m.value="Let's Pay!";
				m.style.margin="15 5 15 0";
			}
		}
				
		tl[u].innerHTML=n;
	}
	
}

function search_utility()
{
	var topic = "cart";
	var el = document.getElementById("search_utility");
	var query = document.getElementById("search_utility").value;
	var empty_search = document.getElementById(topic+"_popup");
	if(query == "" || query == " ")
	{
		empty_search.style.visibility="hidden";
	}
	else
	{
		empty_search.style.visibility="visible";
		empty_search.style.display="block";
	}
	
	for (var plx=0, ply=0, plw=0, plh=0;
    el != null;
    plx += el.offsetLeft, ply += el.offsetTop, plw += el.offsetWidth, plh += el.offsetHeight, el = el.offsetParent);
	 
	for (var p2lx=0, p2ly=0, p2lw=0, p2lh=0;
    el != null;
    p2lx += el.offsetLeft, p2ly += el.offsetTop, p2lw += el.offsetWidth, p2lh += el.offsetHeight, el = el.offsetChild);
	//var poppari = document.getElementById(topic+"_popup");
	empty_search.style.marginLeft=plx-10;//-p2lx;
	empty_search.style.marginTop=ply;//;+p2lh;
	var content = document.getElementById("notification_content");
	var goodput  = "<h4>Compatible</h4>";
		goodput += "<h4>Uncompatible</h4><h4>In storage</h4>";
	content.innerHTML=goodput;
}

function add_role_for_object(parent_product, product_id, status_now, action, photo, manufacturer, model, name, gender)
{
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
		// document.write(baby_monitor);
		// document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
		// document.getElementById("cx_result").value=baby_monitor[1]; // pick a data from url
		// document.getElementById("cx_result").innerHTML=baby_monitor; // pick a data from url
		var included = document.getElementById("standard_component_included");
		var label = (document.getElementById("lib_"+parent_product) == null)
		?	document.getElementById("lib_"+product_id)	:	document.getElementById("lib_"+parent_product);
		
		if(action == "add_as_part")
			{
			label.innerHTML=baby_monitor[0]; // pick a data from url
			// http://www.dustindiaz.com/add-and-remove-html-elements-dynamically-with-javascript/	
			// http://stackoverflow.com/questions/13763/how-do-i-remove-a-child-node-in-html-using-javascript
				if(included.childNodes.length>0)
				{
					var shot = document.createElement('span');
					shot.setAttribute('id', baby_monitor[2]);
					shot.setAttribute('title', baby_monitor[2]);
					shot.innerHTML=baby_monitor[1];
					//included.firstChild = included.childNodes[0];
					included.insertBefore(shot,included.firstChild);
				}
				else
				{
					var shot = document.createElement('span');
						shot.setAttribute('id', baby_monitor[2]);
						shot.innerHTML=baby_monitor[1];
					included.appendChild(shot);
				}
			}
		else if(action == "release")
			{
			label.innerHTML=baby_monitor[0]; // pick a data from url
			//document.getElementById("standard_component_included").append=baby_monitor[1];
				var oldChild = document.getElementById(baby_monitor[1]);
				for(v=0;v<included.childNodes.length;v++)
				{
					if(included.childNodes[v].id==oldChild.id)
						{
						//alert("Kohde löydetty:"+included.childNodes[v].id+" & "+oldChild.id);
						//thisChildNode.parentNode.removeChild(oldChild);
						included.removeChild(included.childNodes[v]);
						//included.childNodes[v].removeChild(ChildNode.firstChild);
						//included.childNodes[v].removeChild(included.childNodes[v].id);
						}
				}
			}
		//document.getElementById("cx_result").innerHTML=baby_monitor[1]; // pick a data from url		
		}
		// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
	};
	var url ="receiver.php";
	var data ="add_role_for_part="+product_id+"&parent_product_id="+parent_product+"&status_now="+status_now+"&action="+action+"&photo="+photo+"&manufacturer="+manufacturer+"&model="+model+"&name="+name+"&gender="+gender;
	// document.write(url+"?"+data);
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();
}

function start_menu(element, topic,state)
{
	var state = state;
	var topic = topic;
	var el = element;
	var el2 = element;
	
	//child
	/*
	for (var lx=0, ly=0, lw=0, lh=0;
         el != null;
         lx += el.offsetLeft, ly += el.offsetTop, lw += el.offsetWidth, lh += el.offsetHeight, el = el.offsetChild);
		*/ 
	// parent
	if(topic != "photo") // if(element != "photo_popup")
	{
		for (var plx=0, ply=0, plw=0, plh=0;
	         el != null;
	         plx += el.offsetLeft, ply += el.offsetTop, plw += el.offsetWidth, plh += el.offsetHeight, el = el.offsetParent);
			 
		for (var p2lx=0, p2ly=0, p2lw=0, p2lh=0;
	         el2 != null;
	         p2lx += el2.offsetLeft, p2ly += el2.offsetTop, p2lw += el2.offsetWidth, p2lh += el2.offsetHeight, el2 = el2.offsetChild);
	
		 
         // lx += el.offsetLeft, ly += el.offsetTop, lw += el.offsetWidth, el = el.offsetParent);
	    // return {x: lx,y: ly};
	    // alert('x: '+ lx +'px,y: '+ly+'px, width: '+lw+'px, height: '+lh+'px ');
	    // alert('Parent x: '+ plx +'px,y: '+ply+'px, \r\n\twidth: '+plw+'px, height: '+plh+'px\r\nChild x: '+ p2lx +'px,y: '+p2ly+'px,  \r\n\twidth: '+p2lw+'px, height: '+p2lh+'px ');
		var poppari = document.getElementById(topic+"_popup");
		// poppari.style.marginLeft=lx+lw/2;
		poppari.style.marginLeft=plx-p2lx;
		// poppari.style.marginTop=ly+lh;
		poppari.style.marginTop=ply+p2lh;
	}
	if(element == "veneer_photo")
	{
		for (var plx=0, ply=0, plw=0, plh=0;
        el != null;
        plx += el.offsetLeft, ply += el.offsetTop, plw += el.offsetWidth, plh += el.offsetHeight, el = el.offsetParent);
		 
		for (var p2lx=0, p2ly=0, p2lw=0, p2lh=0;
	        el2 != null;
	        p2lx += el2.offsetLeft, p2ly += el2.offsetTop, p2lw += el2.offsetWidth, p2lh += el2.offsetHeight, el2 = el2.offsetChild);
	
		 
	    // lx += el.offsetLeft, ly += el.offsetTop, lw += el.offsetWidth, el = el.offsetParent);
	   // return {x: lx,y: ly};
	   // alert('x: '+ lx +'px,y: '+ly+'px, width: '+lw+'px, height: '+lh+'px ');
	   // alert('Parent x: '+ plx +'px,y: '+ply+'px, \r\n\twidth: '+plw+'px, height: '+plh+'px\r\nChild x: '+ p2lx +'px,y: '+p2ly+'px,  \r\n\twidth: '+p2lw+'px, height: '+p2lh+'px ');
		var poppari = document.getElementById(topic+"_popup");
		if(topic == "photo")
		{
			//poppari.style.marginLeft=plx-p2lx;
			poppari.style.marginLeft=plx+p2lx/4;
			poppari.style.marginTop=ply+p2lh/2;
			//var xx = document.getElementById(topic+"_popup");
		}
		else
		{
		// poppari.style.marginLeft=lx+lw/2;
		poppari.style.marginLeft=plx-p2lx;
		// poppari.style.marginTop=ly+lh;
		poppari.style.marginTop=ply+p2lh;
		//var xx = document.getElementById(topic+"_popup");
		var xy = document.getElementById(topic+"_button");
		}
	}
	// document.write(state);
	if(state == "view")
	{
		poppari.style.display = "block";
		if(topic != "photo")
			{
		xy.onclick = function() {start_menu(topic,'hidden');};
			}
		if(topic == "passion")
		{
			document.getElementById("notification_popup").style.display = "none";
			
		}
		if(topic == "notification")
		{
			document.getElementById("passion_popup").style.display = "none";
		}
	}
	if(state == "hidden")
	{
		poppari.style.display = "none";
		if(topic != "photo")
		{
		xy.onclick = function() {start_menu(topic,'view');};
		}
	}
	
}

function start_knowledge_menu(element,topic,state,product_id)
{	
	var state = state;
	var topic = topic;
	var this_product_id = product_id;
	var el = element;
	var el2 = element;
	
	for (var plx=0, ply=0, plw=0, plh=0;
         el != null;
         plx += el.offsetLeft, ply += el.offsetTop, plw += el.offsetWidth, plh += el.offsetHeight, el = el.offsetParent);
		 
	for (var p2lx=0, p2ly=0, p2lw=0, p2lh=0;
         el2 != null;
         p2lx += el2.offsetLeft, p2ly += el2.offsetTop, p2lw += el2.offsetWidth, p2lh += el2.offsetHeight, el2 = el2.offsetChild);
		 
    // alert('Parent x: '+ plx +'px,y: '+ply+'px, \r\n\twidth: '+plw+'px, height: '+plh+'px\r\nChild x: '+ p2lx +'px,y: '+p2ly+'px,  \r\n\twidth: '+p2lw+'px, height: '+p2lh+'px ');
	
	
	
	if(element.title == "connector_info_ufo")
	{
		var basic_details = element.name;
		var basic_detail = basic_details.split("_");
		document.getElementById("cx_popup").innerHTML=basic_detail[0]+" &amp; "+basic_detail[1]+"<br/>";
	}
	
	var embedded = document.getElementById("connectors_knowledge_embedded");
	// var poppari = document.getElementById("connectors");
	// poppari.style.marginLeft=lx+lw/2;
	// poppari.style.marginLeft=plx-p2lx;
	if(document.getElementById("connectors_info_popup") != null) // tarkista tämä jos object-sivulla homma kusee
	{
	var poppari = document.getElementById("connectors_info_popup");
	poppari.style.marginLeft=10;
	
	// poppari.style.marginTop=ly+lh;
	// poppari.style.marginTop=ply+p2lh;
	
	poppari.style.marginTop=15*p2lh-plh;
	// poppari.style.marginTop=p2lh-plh;
	}
	/*
	document.getElementById("cx").innerHTML=query;
	*/
	
	
	
	// var q_value = query.value;
	// document.write(query_name[0]);
	// document.write("techspecs[\""+query_name[0]+"\"]");
	// document.write("<br/>query: "+query);
	if(topic != "connectors_knowledge")
	{
				
		var empty_search = document.getElementById(topic+"_popup");
			if(query == "" || query == " ")
			{
				empty_search.style.visibility="hidden";
				// document.getElementById(topic+"_popup").innerHTML = "ihQ";
			}
			else
			{
				empty_search.style.visibility="visible";
				empty_search.style.display = "block";
			}
	}
	else
	{
			var empty_embedded_search = document.getElementById(topic+"_embedded");
			
			var query_name = topic.split("_");
			// var query = document.getElementByName("techspecs["+query_name[0]+"]");
			// var query = document.getElementsByName("techspecs[\""+query_name[0]+"\"]");
			var query = document.getElementById(query_name[0]+"_form").value;
			
			if(query == "" || query == " ")
			{
				empty_embedded_search.style.visibility="hidden";
				// document.getElementById(topic+"_popup").innerHTML = "ihQ";
			}
			else
			{
				empty_embedded_search.style.visibility="visible";
				empty_embedded_search.style.display = "block";
			}
	}
	
	
	// document.getElementById("cx").innerHTML=query;
	
	
	// knowledge_search(query);
	
		// var content  ="<a href=\"javascript:void(0);\" onclick=\"cancel_value('"+word+"');\" title=\"cancel\">&times;</a><input type=\"\" name=\"techspecs["+word+"]\" value=\""+word+"_knowledge\" onKeyPress=\"start_knowledge_menu('"+word+"_knowledge','view');\"><input type=\"submit\" value=\"update\">";
	// document.write(state);
	
	
	/*
	if(state == "hidden")
	{
		xx.style.display = "none";
		xy.onclick = function() {start_menu(topic,'view');};
	}
	*/

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
		// document.write(baby_monitor);
		// document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
		// document.getElementById("cx_result").value=baby_monitor[1]; // pick a data from url
		// document.getElementById("cx_result").innerHTML=baby_monitor; // pick a data from url
		if(document.getElementById("cx_visibility") != null && baby_monitor[0] !="0")
		{
		var cx_visibility = document.getElementById("cx_visibility");
		cx_visibility.style.visibility="visible";
		cx_visibility.style.display="display";
		}
		else
		{
			var cx_visibility = document.getElementById("cx_visibility");
			cx_visibility.style.visibility="hidden";
			cx_visibility.style.display="none";
		}
		
		document.getElementById("cx_count").innerHTML=baby_monitor[0]; // pick a data from url
		
		document.getElementById("cx_result").innerHTML=baby_monitor[1]; // pick a data from url		
		}
		// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
	};
	var url ="receiver.php";
	var data ="search_connector="+query+"&this_product_id="+this_product_id;
	// document.write(url+"?"+data);
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();
	
	var xx = document.getElementById(topic+"_popup");
	var xy = document.getElementById(topic+"_button");
	var xz = document.getElementById(topic+"_embedded");
	
	if(state == "view")
	{
		//xx.style.display = "block";
		//xz.style.display = "block";
		//xy.onclick = function() {start_menu(topic,'hidden');};
		if(topic == "passion")
		{
			document.getElementById("notification_popup").style.display = "none";
			
		}
		if(topic == "notification")
		{
			document.getElementById("passion_popup").style.display = "none";
		}
	}
	/*
	// Known Float Object (Not UFO, just KFO)
	// known_float_object(this, profile_id, action, object, at_time);
	// known_float_object({x,y}, profile_id, view, popup, time);
	Veneer * Add Info * Add/Suggest Info to Veneer * Suggested Info
	lahjoituksen vastaanottaja voi valita mitä tavaroita haluaa (vastaanottaa)
	etusivulle valikko: Yhteensopivat / You may interested / Yritys+yksityinen
	"Loading..." -> "Building a view..."
	// rakenna karttapalveluun tavaran kulkeminen as tuulenvirtaukset, yhtiön laajeneminen maanjäristyksenä jne...
	
	// home/etusivu vois olla offtopic -nimellä :D
	*/
	//var el = element;
	
	/* http://www.w3schools.com/jsref/dom_obj_all.asp */
	/*
	for (var lx=0, ly=0, lw=0;
         el != null;
         lx += el.offsetLeft, ly += el.offsetTop, el = el.offsetParent, lw += el.offsetWidth, l += el.offsetHeight);
    // return {x: lx,y: ly};
    alert('x: '+ lx +'px,y: '+ly+'px');*/
}

function block_to_json(element, Object)
{
	// http://stackoverflow.com/questions/5629684/javascript-check-if-element-exists-in-the-dom
	// http://stackoverflow.com/questions/8925820/javascript-object-push-function
	// http://www.json.org/
	var object = (Object == null) ? new Object : Object;
	var block = document.getElementById(element);
	if(block.parentNode.name = "connectors")
	{
		object["connectors"][block.name] = {"id" : block.id, "name" : block.name, "count" : block.value};
	}
	else
	{
		object[block.name] = {"id" : block.id, "name" : block.name, "count" : block.value};
	}
	
	object["compatible"] = {"pre-onclick":"save","onclick":"open_dialog","post-onclick":"new_products"};
	object["potential_buyer"] = {"pre-onclick":"save","onclick":"open_dialog","post-onclick":"new_products"};
	
	document.getElementById("blah").onclick = function ()
	{
		this.onclick = block_to_json(element, object);
	};
}

function select_connector(this_product_id, connector_id, method, quick_charger)
{
	if(this_product_id == "undefined" && quick_charger.length>2) 
	{
		//document.write("jooh");
		// http://stackoverflow.com/questions/6487167/deserialize-from-json-to-javascript-object
		//var reserved_quick_charger = (quick_charger != null) ? JSON.parse(quick_charger) : new Object;
		//	document.write("a: "+typeof (connector_id)+ "<br/> b: "+typeof(quick_charger));
		//document.write(" <br/> ");
		//document.write("a: "+connector_id+ "<br/> b: "+quick_charger);
		//document.getElementById("cx_count").innerHTML=quick_charger+", %"+connector_id+"%<span id=\"cx_conn_rack_notifier\"></span>";
		var connector = JSON.parse(connector_id);
		//document.write("<br/>jee");
		var res_quick_charger = JSON.parse(quick_charger);
		
		//document.write("joo");
		//var goodput = new Object();
		//goodput["connector"] = connector;
		//goodput["quick_charger"] = re_quick_charger;
		//document.write("<br/>2a<br/>");
		//document.write(goodput["connector"].connector_id);
		//document.write("<br/>");
		//document.write(goodput["quick_charger"].connector_id);
		//var json_goodput = JSON.parse(goodput);
		//document.write("<br/>2e<br/>");
		//document.write(typeof(res_quick_charger));
		//var res_quick_charger = quick_charger;
		//document.write("joo");
		//document.write(res_quick_charger);
		//var res_quick_charger = JSON.parse(re_quick_charger);
		
		
		
		//document.write(connector);
		if(method != "add")
		{
			var zup = res_quick_charger["connectors"][connector["connector_id"]]["count"];
			if(zup != "undefined" && zup>1)
			{
				//alert("jee"+res_quick_charger["connectors"][connector["connector_id"]]["count"]);
				res_quick_charger["connectors"][connector["connector_id"]]["count"] -=1;
				//alert("jee"+res_quick_charger["connectors"][connector["connector_id"]]["count"]);
				//res_quick_charger["connectors"][connector["connector_id"]]["count"] -=1;
				//document.getElementById("cx_count").innerHTML=res_quick_charger["connectors"][connector["connector_id"]]["count"];
			}
			else
			{
				delete res_quick_charger["connectors"][connector["connector_id"]];
				//alert("yhyy");
			}

			
			/*if(Math.max(res_quick_charger["connectors"][connector["connector_id"]]["count"])>1)
			{
			//var check_conn = new RegExp(connector["connector_id"], "g");
				//document.write("<br/>"+check_conn.test(quick_charger));
				//if(check_conn.test(quick_charger) == true)
				//{ // http://stackoverflow.com/questions/1098040/checking-if-an-associative-array-key-exists-in-javascript
					res_quick_charger["connectors"][connector["connector_id"]]["count"] -=1;
				//}
					document.getElementById("cx_count").innerHTML="qq(("+quick_charger+"))"+" xx "+ connector["connector_id"] +" xx "+res_quick_charger["connectors"][connector["connector_id"]]["count"]+"<span id=\"cx_conn_rack_notifier\"></span>";
			}
			else
			{
				document.getElementById("conn_mgmt_remove_"+connector["connector_id"]).setAttribute("disabled", "disabled");
				//delete res_quick_charger["connectors"][connector["connector_id"]];
				document.getElementById("cx_count").innerHTML="zz(("+quick_charger+"))"+" xx "+ connector["connector_id"] +" xx "+res_quick_charger["connectors"][connector["connector_id"]]["count"]+"<span id=\"cx_conn_rack_notifier\"></span>";
			}*/
			
			
			//document.write(res_quick_charger);
			var quick_chargerx = JSON.stringify(res_quick_charger);
			//document.getElementById("cx_count").innerHTML=quick_chargerx+"<span id=\"cx_conn_rack_notifier\"></span>";
			//alert("4daadaa<br/>"+quick_chargerx);
			var cma = document.getElementsByClassName("conn_mgmt_add");
			//quick_charger = JSON.stringify(res_quick_charger);
			//document.getElementById("cx_count").innerHTML="hello: "+cma.length;
			//document.write("2daadaa, length: "+cma.length+"<br/>");
			for(a=0;a<cma.length;a++)
			{
				
				//cma[a].onclick = function ()
				//{ // http://stackoverflow.com/questions/651563/get-the-last-element-of-a-splitted-string-array-in-javascript
					//var connector_id = this.id.split("_").pop()
				
					var select_connector_list = cma[a].getAttribute('onclick').split("'");
					//document.write("3daadaa<br/>");
					
					var connector = select_connector_list[3];//.split("'");
					//document.write("4daadaa<br/>"+connector);
					//document.write("4daadaa<br/>");
					//var q = res_quick_charger["connectors"][connector["connector_id"]]["count"];
					//document.write(q);
					//cma[a].setAttribute("value","Add (u,"+q+")");
					//var connector_id = JSON.stringify(connector);
					//document.write("<br/>"+connector_id+"<br/>N.s<br/>");
					cma[a].setAttribute("onclick", "select_connector('"+this_product_id+"', '"+connector+"', 'add', '"+quick_chargerx+"')");
					//document.write("5daadaa<br/>");
					//alert("Täs: "+quick_chargerx);
					var res_quick_chargerx = JSON.parse(quick_chargerx);
					var connectorx = JSON.parse(connector);
					if(res_quick_chargerx["connectors"][connectorx["connector_id"]] == undefined)
					{
						cma[a].setAttribute("value","Add (u)");
						//alert("hai");
					}
					else
					{
						
						var q = res_quick_chargerx["connectors"][connectorx["connector_id"]]["count"];
						//alert(res_quick_chargerx["connectors"][connector["connector_id"]]["count"]);
						//alert("Ja tässä: "+res_quick_chargerx["connectors"][connectorx["connector_id"]]["count"]);
						if(q>0 && q!="undefined")
						{
							cma[a].setAttribute("value","Add (u,"+q+")");
						}
						else
						{
							cma[a].setAttribute("value","Add (u)");
						}
					}
					/*
					var select_connector_list_a = cma[a].getAttribute('onclick').split("'");
					//document.write("3daadaa<br/>");
					//document.write(select_connector_list_a+"<br/>1");
					var connector_idd = select_connector_list_a[3].replace(/\\\"/g,'"');
					//document.write("<br/>"+connector_idd);
					var connector = JSON.parse(connector_idd);
					//document.write("4daadaa<br/>");
					var check_conn = new RegExp(connector["connector_id"], "g");
					var res_quick_charger = JSON.parse(quick_charger);
					// document.write("dabz: "+connector_idd+", "+res_quick_charger["connectors"][connector["connector_id"]]);
					if(check_conn.test(quick_charger) == true && res_quick_charger["connectors"][connector["connector_id"]] != "undefined")
					{
						var q = res_quick_charger["connectors"][connector["connector_id"]]["count"];
						cma[a].setAttribute("value","Add (u,"+q+")");
					}
					else
					{
						cma[a].setAttribute("value","Add (u)");
					}
					*/
					
				//};
			}
			//document.write("3daadaa<br/>");
			var cmr = document.getElementsByClassName("conn_mgmt_remove");
			for(a=0;a<cmr.length;a++)
			{
				//cmr[a].value="sdaa";
				//cmr[a].onclick = function ()
				//{
					//var connector_id = this.id.split("_").pop();
					var select_connector_list_r = cmr[a].getAttribute('onclick').split("'");
					//document.write(cmr[a].getAttribute('onclick')+", "+select_connector_list.length);
					var connector5 = select_connector_list_r[3];//.split("'");
					var connector6 = JSON.parse(connector5);
					var check_conn = new RegExp(connector6["connector_id"], "g");
					//document.write("<br/>"+check_conn.test(quick_charger));
					//if(check_conn.test(quick_charger) == true && res_quick_chargerx["connectors"][connector6["connector_id"]] != undefined)
					var res_quick_chargery = JSON.parse(quick_chargerx);
					var connectory = JSON.parse(connector);
					if(res_quick_chargery["connectors"][connectory["connector_id"]] == undefined)
					{
						cmr[a].setAttribute("disabled", "disabled");
						//alert("hei");
					}
					else
					{
						//cmr[a].removeAttribute("disabled");
					}
					
					var connector_id = JSON.stringify(connector6);
					// alert(connector_id+", "+quick_charger);
					cmr[a].setAttribute("onclick","select_connector('"+this_product_id+"','"+connector_id+"','remove','"+quick_chargerx+"');");
					//var q = res_quick_charger["connectors"][connector["connector_id"]]["count"];
					//document.write(q);
					//cma[a].setAttribute("value","Remove (u,"+q+")");
					/*var res_quick_chargery = JSON.parse(quick_chargerx);
					var connectory = JSON.parse(connector_id);
					var q1 = res_quick_chargery["connectors"][connectory["connector_id"]]["count"];
					if(q1>0 && q1!="undefined")
					{
						cmr[a].setAttribute("value","Remove (u,"+q1+")");
					}
					else
					{
						cmr[a].setAttribute("value","Remove (u)");
					}*/
					
					if(res_quick_chargery["connectors"][connectory["connector_id"]] == undefined)
					{
						cmr[a].setAttribute("value","Remove (u)");
					}
					else
					{
						
						var q1 = res_quick_chargery["connectors"][connectory["connector_id"]]["count"];
						//alert(res_quick_chargerx["connectors"][connector["connector_id"]]["count"]);
						//alert("Ja tässä: "+res_quick_chargerx["connectors"][connectorx["connector_id"]]["count"]);
						if(q1>0 && q1!="undefined")
						{
							cmr[a].setAttribute("value","Remove (u,"+q+")");
						}
						else
						{
							cmr[a].setAttribute("value","Remove (u)");
						}
					}
					/*
					var select_connector_list1 = cmr[a].getAttribute('onclick').split("'");
					//document.write("3daadaa<br/>");
					//document.write(select_connector_list);
					var connector_ide = select_connector_list1[3];//.split("'");
					//document.getElementById("cx_count").innerHTML=connector_ide;
					//document.write(connector_ide);
					var connector1 = JSON.parse(connector_ide);
					//document.write("4daadaa<br/>");
					var check_conn = new RegExp(connector["connector_id"], "g");
					if(check_conn.test(quick_charger) == true)
					{
						var q = res_quick_charger["connectors"][connector["connector_id"]]["count"];
						cma[a].setAttribute("value","Remove (u,"+q+")");
					}
					else
					{
						cma[a].setAttribute("value","Remove (u)");
					}*/
					
				//};
			}
		}
		if(method == "add")
		{	
			//document.write("jooh");
			//if(connector.connector_id in res_quick_charger)
			//	document.write("<br/>"+quick_charger+"<br/>"+connector["connector_id"]+"<br/>");
			//document.write(res_quick_charger+", ress_quick_charger: "+res_quick_charger["connector_id"]+ "<br/> connector id: "+connector["connector_id"]);
			//if(Object.prototype.hasOwnProperty.call(res_quick_charger, connector["connector_id"]))
			var check_conn = new RegExp(connector["connector_id"], "g");
			//document.write("<br/>"+check_conn.test(quick_charger));
			if(check_conn.test(quick_charger) == true)
			{ // http://stackoverflow.com/questions/1098040/checking-if-an-associative-array-key-exists-in-javascript
				//document.write("jooh1<br/>");
				//document.write(res_quick_charger+"<br/>");
				
				/*for(v in res_quick_charger)
				{
					document.write("1-tier key "+Object.keys(res_quick_charger)+" value "+res_quick_charger[v]+"<br/>");
					for(w in res_quick_charger[v])
					{
						document.write("1-tier key "+Object.keys(res_quick_charger[v])+"2-tier "+res_quick_charger[v][w]+"<br/>");
					}
				}*/
				//document.write(res_quick_charger["connector_id"]+"<br/>");
				//document.write(res_quick_charger["connector_id"]["count"]+"<br/>");
				
				//document.write("<br/>ensin: "+res_quick_charger[connector["connector_id"]]["count"] + "<br/>");
				
				//document.write(res_quick_charger[connector["connector_id"]]);
				res_quick_charger["connectors"][connector["connector_id"]]["count"] +=1;
				//document.write("<br/>sitten: "+res_quick_charger[connector["connector_id"]]["count"] + "<br/>");
				//document.write("Result: "+res_quick_charger[connector["connector_id"]]);
			}
			else
			{
				//document.write("<br/>jooh2");
				res_quick_charger["connectors"][connector["connector_id"]] = connector;
				/*res_quick_charger["connectors"][connector["connector_id"]] = {
						"id":connector["connector_id"],
						"name":connector["name"],
						"gender":connector["gender"],
						"count":1
				};*/
			}
			
			
			var cma = document.getElementsByClassName("conn_mgmt_add");
			//quick_charger = JSON.stringify(res_quick_charger);
			//document.getElementById("cx_count").innerHTML="hello: "+cma.length;
			//document.write("2daadaa, length: "+cma.length+"<br/>");
			for(var a=0;a<cma.length;a++)
			{
				
				//cma[a].onclick = function ()
				//{ // http://stackoverflow.com/questions/651563/get-the-last-element-of-a-splitted-string-array-in-javascript
					//var connector_id = this.id.split("_").pop()
					var select_connector_list = cma[a].getAttribute('onclick').split("'");
				//document.write("3daadaa<br/>");
				//document.write(select_connector_list);
					var connector_iddy = select_connector_list[3];
					//alert(connector_idz);
					//var connector_iduu = JSON.stringify(connector_idz);
					var quick_chargertt = JSON.stringify(res_quick_charger);
					//alert(quick_chargertt);
					cma[a].setAttribute("onclick", "select_connector('"+this_product_id+"', '"+connector_iddy+"', 'add', '"+quick_chargertt+"')");
					//document.write("5daadaa<br/>");
					
					//var select_connector_listnn = cma[a].getAttribute('onclick').split("'");
					//document.write("3daadaa<br/>");
					//document.write(select_connector_list);
					//var connector_iddd = select_connector_listnn[3];//.split("'");
					//document.write(connector_idd);
					//alert(connector_iduu);
					var connector_dttt = JSON.parse(connector_iddy);
					//document.write("4daadaa<br/>");
					var res_quick_chargeryy = JSON.parse(quick_chargertt);
					if(res_quick_chargeryy["connectors"][connector_dttt["connector_id"]] == undefined)
					{
						cma[a].setAttribute("value","Add (u)");
					}
					else
					{
						var q = res_quick_chargeryy["connectors"][connector_dttt["connector_id"]]["count"];
						//document.write(q);
						cma[a].setAttribute("value","Add (u,"+q+")");
						//var connector_id = JSON.stringify(connector);//.replace(/&quot;/g,'"');
					}
				//};
			}
			//document.write("3daadaa<br/>");
			var cmr = document.getElementsByClassName("conn_mgmt_remove");
			for(var a=0;a<cmr.length;a++)
			{
				//cmr[a].value="sdaa";
				//cmr[a].onclick = function ()
				//{
					//var connector_id = this.id.split("_").pop();
					//var select_connector_list = cmr[a].getAttribute('onclick').split(",");
					//document.write(cmr[a].getAttribute('onclick')+", "+select_connector_list.length);
					//var connector = select_connector_list[1].split("'");
					var select_connector_listp = cmr[a].getAttribute('onclick').split("'");
					//document.write("3daadaa<br/>");
					//document.write(select_connector_list);
					var connector_idxff = select_connector_listp[3];
					var connector_idzff = JSON.parse(connector_idxff);
					var check_conn = new RegExp(connector_idzff["connector_id"], "g");
					//document.write("<br/>"+check_conn.test(quick_charger));
					if(check_conn.test(quick_charger) == true)
					{
						cmr[a].removeAttribute("disabled");
					}
					else
					{
						cmr[a].setAttribute("disabled", "disabled");
					}
					
					
					//var connector_id = JSON.stringify(connector);//.replace(/&quot;/g,'"');
					var quick_chargerzz = JSON.stringify(res_quick_charger);
					var connector_idyf = JSON.stringify(connector_idzff);
					//alert(connector_idy);
					cmr[a].setAttribute("onclick","select_connector('"+this_product_id+"','"+connector_idyf+"','remove','"+quick_chargerzz+"');");
					
					//var select_connector_list1 = cmr[a].getAttribute('onclick').split("'");
					//document.write("3daadaa<br/>");
					//document.write(select_connector_list);
					//var connector_ide = select_connector_list1[3];//.split("'");
					//document.getElementById("cx_count").innerHTML=connector_ide;
					//document.write(connector_ide);
					var connector1f = JSON.parse(connector_idyf);
					var res_quick_chargerjj = JSON.parse(quick_chargerzz);
					//document.write("4daadaa<br/>");
					if(res_quick_chargerjj["connectors"][connector1f["connector_id"]] == undefined)
					{
						cmr[a].setAttribute("value","Remove (u)");
					}
					else
					{
						var q = res_quick_chargerjj["connectors"][connector1f["connector_id"]]["count"];
						//document.write(q);
						cmr[a].setAttribute("value","Remove (u,"+q+")");//Remove (u,"+q+")");
					}
				//};
			}
		}
		var resqu  = "";
		for(yhyy in res_quick_charger["connectors"])
			{
				//resqu+=res_quick_charger["connectors"][yhyy];
			resqu++;
			}
		//alert(resqu);
		if(resqu>0)
		{
			var l = resqu;
			var rere = JSON.stringify(res_quick_charger["connectors"]);//.replace(/&quot;/g, '\"');
			//var rere = JSON.stringify(res_quick_charger["connectors"]);
			//alert(rere);
			var m  = "<input type=\"hidden\" name=\"product[connectors]\" value=\'"+rere+"\'>";
				m += "<a href=\"javascript:void(0);\" onclick=\"\">"+l+" genres selected</a>, ";
			document.getElementById("cx_conn_rack_notifier").innerHTML = m;
		}
		else
		{
			document.getElementById("cx_conn_rack_notifier").innerHTML = "";
		}
		quick_charger = JSON.stringify(res_quick_charger);
		var cma = document.getElementsByClassName("conn_mgmt_add");
		//quick_charger = JSON.stringify(res_quick_charger);
		//document.getElementById("cx_count").innerHTML="hello: "+cma.length;
		//document.write("2daadaa, length: "+cma.length+"<br/>");
		for(var a=0;a<cma.length;a++)
		{
			
			//cma[a].onclick = function ()
			//{ // http://stackoverflow.com/questions/651563/get-the-last-element-of-a-splitted-string-array-in-javascript
				//var connector_id = this.id.split("_").pop()
			
				var select_connector_list = cma[a].getAttribute('onclick').split("'");
				//document.write("3daadaa<br/>");
				
				var connector_abc = select_connector_list[3];//.split("'");
				//document.write("4daadaa<br/>");
				cma[a].setAttribute("onclick", "select_connector('"+this_product_id+"', '"+connector_abc+"', 'add', '"+quick_charger+"')");
				//document.write("5daadaa<br/>");
			//};
		}
		//document.write("3daadaa<br/>");
		var cmr = document.getElementsByClassName("conn_mgmt_remove");
		for(var a=0;a<cmr.length;a++)
		{
			//cmr[a].value="sdaa";
			//cmr[a].onclick = function ()
			//{
				//var connector_id = this.id.split("_").pop();
				var select_connector_list = cmr[a].getAttribute('onclick').split("'");
				//document.write(cmr[a].getAttribute('onclick')+", "+select_connector_list.length);
				var connector_def = select_connector_list[3];//.split("'");
				/*var check_conn = new RegExp(connector["connector_id"], "g");
				//document.write("<br/>"+check_conn.test(quick_charger));
				if(check_conn.test(quick_charger) == true)
				{
					cmr[a].removeAttribute("disabled");
				}
				else
				{
					cmr[a].setAttribute("disabled", "disabled");
				}*/
				cmr[a].setAttribute("onclick","select_connector('"+this_product_id+"','"+connector_def+"','remove','"+quick_charger+"');");
				
				var connector_deff = JSON.parse(connector_def);
				var res_quick_charger_def = JSON.parse(quick_charger);
				
				if(res_quick_charger_def["connectors"][connector_deff["connector_id"]] == undefined)
				{
					cmr[a].setAttribute("value","Remove (u)");
					cmr[a].setAttribute("disabled", "disabled");
				}
				else
				{
					var q = res_quick_charger_def["connectors"][connector_deff["connector_id"]]["count"];
					//document.write(q);
					cmr[a].setAttribute("value","Remove (u,"+q+")");//Remove (u,"+q+")");
					cmr[a].removeAttribute("disabled");
				}
			//};
		}
	}
	else
	{
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
			// document.write(baby_monitor);
			// document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
			// document.getElementById("cx_result").value=baby_monitor[1]; // pick a data from url
			// document.getElementById("cx_result").innerHTML=baby_monitor; // pick a data from url
				if(baby_monitor[0] == "basic_rack")
				{
				document.getElementById("conn_mgmt_remove_"+connector_id).disabled=baby_monitor[1]; // pick a data from url
				document.getElementById("conn_mgmt_count_"+connector_id).innerHTML=baby_monitor[2]; // pick a data from url	
				}
				if(baby_monitor[0] == "quick_charger")
				{
					
					//quick_charger = JSON.parse(baby_monitor[3]);
					
					var quick_fix = baby_monitor[3].replace(/&quot;/g,'"');
					//var rex = /&quot;/i;
					//document.write(rex.test(quick_fix));
					
					// http://stackoverflow.com/questions/9309278/javascript-regex-replace-all-characters-other-than-numbers
					var quick_charge = new Object();
					var quick_charger1 = JSON.parse(quick_fix);
					quick_charge["connectors"] = {};
					quick_charge["connectors"][quick_charger1["connector_id"]] = quick_charger1;
					//document.write(quick_charge);
					var quick_charger = JSON.stringify(quick_charge);
					
					var search_result = document.getElementById("cx_search_count_aa").innerHTML;
					document.getElementById("cx_count").innerHTML="<span style=\"font-weight:normal;\">("+search_result+", <span id=\"cx_conn_rack_notifier\"><input type=\"hidden\" name=\"product[connectors]\" value=\'"+quick_charger+"\'>"+baby_monitor[1]+"</span> "+baby_monitor[2]+")</span>"; // pick a data from url
					//document.write(quick_charger);
					//var quick_charger = quick_fix.replace("&quot;",'"');
					//quick_charger = "";
					/*var quick_charger = new Object();
					
					var connector = JSON.parse(connector_id);
					document.write(connector["connector_id"]);
					connector_id[connector["connector_id"]] = {
							"connector_id":connector["connector_id"],
							"name":connector["name"],
							"genre":connector["gender"]
							};*/
					//document.write(connector_id + ", " + quick_charger);
					connector_detail = JSON.parse(connector_id);
					
					/*
					document.write(" bon apetit <br/>");
					document.write("1: "+quick_charger+ "("+typeof(quick_charger)+")");
					document.write("<br/>");
					document.write("2: "+connector_id+ "("+typeof(connector_id)+")");
					*/
					
					//var refreshed_quick_charger = JSON.stringify(quick_charger);
					//var qquick_charger = JSON.parse(quick_charger);
					//document.write(refreshed_quick_charger);
					//document.write("joo-o");
					//var id = connector_detail["connector_id"];
					//document.write("conn_mgmt_add_"+connector_detail["connector_id"]+" ("+connector_id+")");
					//document.write("1daadaa<br/>");
					//var cma = document.getElementsByClassName("conn_mgmt_remove1");
					//var cma = document.getElementsByClassName("lsdhuume");
					
					//var cma = document.getElementById("navigation");
					var cma = document.getElementsByClassName("conn_mgmt_add");
					//quick_charger = JSON.stringify(res_quick_charger);
					//document.getElementById("cx_count").innerHTML="hello: "+cma.length;
					//document.write("2daadaa, length: "+cma.length+"<br/>");
					for(var a=0;a<cma.length;a++)
					{
						
						//cma[a].onclick = function ()
						//{ // http://stackoverflow.com/questions/651563/get-the-last-element-of-a-splitted-string-array-in-javascript
							//var connector_id = this.id.split("_").pop()
						
							var select_connector_list = cma[a].getAttribute('onclick').split("'");
							//document.write("3daadaa<br/>");
							
							var connector_ju = select_connector_list[3];//.split("'");
							//document.write("4daadaa<br/>");
							cma[a].setAttribute("onclick", "select_connector('"+this_product_id+"', '"+connector_ju+"', 'add', '"+quick_charger+"')");
							//document.write("5daadaa<br/>");
						//};
					}
					//document.write("3daadaa<br/>");
					var cmr = document.getElementsByClassName("conn_mgmt_remove");
					for(var a=0;a<cmr.length;a++)
					{
						//cmr[a].value="sdaa";
						//cmr[a].onclick = function ()
						//{
							//var connector_id = this.id.split("_").pop();
							var select_connector_listq = cmr[a].getAttribute('onclick').split("'");
							//document.write(cmr[a].getAttribute('onclick')+", "+select_connector_list.length);
							var connector_N = JSON.parse(select_connector_listq[3]);//.split("'");
							var check_conn = new RegExp(connector_N["connector_id"], "g");
							//document.write("<br/>"+check_conn.test(quick_charger));
							if(check_conn.test(quick_charger) == true)
							{
								cmr[a].removeAttribute("disabled");
							}
							else
							{
								cmr[a].setAttribute("disabled", "disabled");
							}
							var condor = JSON.stringify(connector_N);
							cmr[a].setAttribute("onclick","select_connector('"+this_product_id+"','"+condor+"','remove','"+quick_charger+"');");
							
							//document.getElementById("cx_count").innerHTML=connector_N;
						//};
					}
						
					/*
					var cma_x = document.getElementById("conn_mgmt_add_"+connector_detail["connector_id"]);
					//cma_x.onclick="qqselect_connector('"+this_product_id+"', '"+connector_id+"', 'add', 'xx"+quick_charger+"')";
					cma_x.setAttribute("onclick", "select_connector('"+this_product_id+"', '"+connector_id+"', 'add', '"+quick_charger+"')");
					document.getElementById("conn_mgmt_add_"+connector_detail["connector_id"]).onClick = function ()
					{
						//this.value = "Dadd";
						//this.onclick="qqselect_connector('"+this_product_id+"', '"+connector_id+"', 'add', 'xx"+quick_charger+"')";
						//this.onclick="qqselect_connector()";
					};
					//document.getElementById("conn_mgmt_add_"+connector_detail["connector_id"]).value = "Dadd";
					
					document.getElementById("conn_mgmt_remove_"+connector_detail["connector_id"]).onclick = function ()
					{
						this.onclick="select_connector('"+this_product_id+"', '"+connector_id+"', 'remove', '"+quick_charger+"')";
					};
					document.getElementById("conn_mgmt_remove_"+connector_detail["connector_id"]).value="Drem";
					*/
				}
			}
			/*else
			{
				document.getElementById("cx_count").innerHTML=baby_monitor[1]+", "+baby_monitor[2]; // pick a data from url
			}*/
			
			/*var quick_charger = new Object();
			
			var connector = JSON.parse(connector_id);
			//document.write(connector["connector_id"]);
			quick_charger[connector["connector_id"]] = {
					"connector_id":connector["connector_id"],
					"name":connector["name"],
					"genre":connector["gender"],
					"count":"1"
					};
			//quick_charger = JSON.stringify(quick_charger);
			var daa = "";
			for(key in quick_charger[connector["connector_id"]])
			{
				daa +=key+": "+quick_charger[connector["connector_id"]][key]+", ";
			}
			quick_charger = JSON.stringify(quick_charger);
			//document.write(daa);
			document.getElementById("conn_mgmt_add_"+connector["connector_id"]).onclick = function ()
				{
					this.onclick="select_connector('"+this_product_id+"', '"+connector_id+"', 'add', '"+quick_charger+"')";
				};
			document.getElementById("conn_mgmt_remove_"+connector["connector_id"]).onclick = function ()
				{
					this.onclick="select_connector('"+this_product_id+"', '"+connector_id+"', 'remove', '"+quick_charger+"')";
				};
			}*/
			//document.write("joo-o");
			// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
		};
		/*var ju = "";
		for(var u = 0; u<connector_id.length;u++)
		{
			ju+=connector_id[u]+", ";
		}*/
		
		// http://stackoverflow.com/questions/6487167/deserialize-from-json-to-javascript-object
		// var connectorr = JSON.parse(connector_id);
		// document.write(connectorr["name"]);
		
		var url ="receiver.php";
		var data ="add_connector_for_this_product="+this_product_id+"&select_connector="+connector_id+"&method="+method;
		// document.write(url+"?"+data);
		xmlhttp.open("GET",url+"?"+data,true);
		//Send the proper header information along with the request
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", data.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send();
	}
}

function exchange_scouting_popup(profile_id, product_id,connector_id, topic, state)
{
	/*
	 * Voisi sisällyttää nuo funktion muuttuja jo HTML-sisältöön ja
	 * getElementByX-menetelmällä poimia ne sieltä,
	 * for.in-silmukalla pyörittää esille johonkin muuttujaan ja lähettää se
	 * 
	 */
	
	var popup = document.getElementById("market_scouting_frame");
	var index = "initial_market_scouting";
	var topic = topic;
	var profile_id = profile_id;
	var product_id = product_id;
	var connector_id = connector_id;
	//var data = "exchange_scout="+topic+"&profile_id="+profile_id+"&product_id="+product_id+"&connector_id="+connector_id; //+"&index="+index;
	//var hanlder = "";
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
		// document.write(baby_monitor);
		// document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
		// document.getElementById("cx_result").value=baby_monitor[1]; // pick a data from url
		// document.getElementById("cx_result").innerHTML=baby_monitor; // pick a data from url
		document.getElementById("market_scouting_header").innerHTML=baby_monitor[0]; // pick a data from url
		//document.getElementById("ta_content").innerHTML=baby_monitor[1]; // pick a data from url
		document.getElementById("trade_agreement_content").innerHTML=baby_monitor[1];
		document.getElementById("trade_agreement_content").style.height=232;
		document.getElementById("trade_agreement_content").style.overflow="auto";
		//var cp_width = document.getElementById("ta_content");
		var cp_width = document.getElementById("trade_agreement_content");
			/*
			for (var plw=0, pl=0;
			 el != null;
			 plw += el.offsetWidth, pl +=el.offsetLeft, el = el.offsetParent);*/
			 
		for(var cpw = 0;
			cp_width != null;
			cpw +=cp_width.offsetWidth, cp_width = cp_width.offsetChild);
		var total_width = cpw/2-15;
		
		//document.getElementsByClassName("block").style.width=total_width;
		//document.getElementsByClassName("block").innerHTML="jee";
		//document.getElementByClassName("block").style.borderWidth=total_width;
		// http://stackoverflow.com/questions/5673588/expand-multiple-divs-to-fit-horizontal-width-of-screen
		//var block_height = document.getElementsByClassName("block");
		
		var block = document.getElementsByClassName("block");
		for(var i = 0; i < block.length; i++)
	   {
			block[i].style.width = total_width;
	         // block.length; // total number of linksCount
	   }
		var block_new_height = new Array();
		for(var i= 0; i < block.length; i++)
		{
			var cph = 0;
			if(block[i]!=null)
			{
				cph+=block[i].offsetHeight, block[i] = block[i].offsetChild;
				block_new_height.push(cph);
			}
		}
		
		var dx = 0;
		for(var i= 0; i < block.length; i++)
	   {
			//block[i].style.height = block_new_height.max;
			block[i].style.height = Math.max.apply(0,block_new_height);
	         // block.length; // total number of linksCount
	   }
		for(var i = 0; i < block.length; i++) {
		    block[i].onmouseover = function() {
		       //this.parentNode.style.backgroundColor = "#ff0000";
		       this.style.backgroundColor = "#ff0000";
		    };
		    block[i].onmouseout = function() {
		      //this.parentNode.style.backgroundColor = "#fff";  
		      this.style.backgroundColor = "#fff";  
		    };
		}
		
		var panel_navigation = document.getElementById("popup_navigation");
		panel_navigation.innerHTML=baby_monitor[2];
		panel_navigation.style.height=80;
		
		}
		// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
	};
	var data = "exchange_scout="+topic+"&profile_id="+profile_id+"&product_id="+product_id;//+"&connector_id="+connector_id; //+"&index="+index;
	var url ="receiver.php";
	//var data =handler;
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();


	if(state == "open")
	{
	popup.style.display = 'block';
	}
	if(state == "close")
	{
	popup.style.display = 'none';
	}
	
	/*if(topic == "initial_exchange")
	{
	 document.getElementById("ta_content").setAttribute("onmousemove", "market_scout('"+profile_id+"','"+product_id+"', '', 'refresh');");
	 document.getElementById("ta_content").setAttribute("onmouseover", "market_scout('"+profile_id+"','"+product_id+"', '', 'refresh');");
	}*/
}

// function market_scouping_popup($profile_id, $product_id, $topic, 'open')
function market_scouting_popup(profile_id, product_id,connector_id, topic, state)
{
	// var popup = document.getElementById(topic);
	var popup = document.getElementById("market_scouting_frame");
	//var profile_id = profile_id;
	//var product_id = product_id;
	//var connector_id = connector_id;
	//var topic = topic;
	var index="";
	/*if(topic == "initial_exchange" || topic == "initial_market_scouting")
	{
		if(topic == "initial_exchange")
		{
			var topic = "initial_exchange";
			var index = "suggest";
		}
		else if(topic == "initial_market_scouting")
		{
			var topic = "wtf";
			var index = "initial_market_scouting";
		}*/
		var handler = "market_scout="+topic+"&profile_id="+profile_id+"&product_id="+product_id+"&connector_id="+connector_id+"&index="+index;
		
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
			// document.write(baby_monitor);
			// document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
			// document.getElementById("cx_result").value=baby_monitor[1]; // pick a data from url
			// document.getElementById("cx_result").innerHTML=baby_monitor; // pick a data from url
			document.getElementById("market_scouting_header").innerHTML=baby_monitor[0]; // pick a data from url
			//document.getElementById("ta_content").innerHTML=baby_monitor[1]; // pick a data from url
			
			//var panel_navigation = document.getElementById("popup_navigation");
			var panel_navigation = document.getElementById("trade_agreement_content");
			
			panel_navigation.innerHTML=baby_monitor[1];
			//market_scouting(profile_id, product_id,connector_id, '');
			
			//panel_navigation.innerHTML="Knock";
			//panel_navigation.style.height=0;
			//panel_navigation.style.height=47;
			if(panel_navigation.innerHTML=="")
			{
				panel_navigation.style.height=0; //50;
			}
			panel_navigation.style.overflow="auto";
			var ta_content = document.getElementById("ta_content");
			ta_content.innerHTML=baby_monitor[2];
			
			//ta_content.style.height=313; // 263+50
			
			//document.getElementById("trade_agreement_content").style.border="1px solid";
			//document.getElementById("trade_agreement_content").style.overflow="auto";
			//document.getElementById("ta_content").style.overflow="auto";
			//var cp_width = document.getElementById("ta_content");
			//var cp_width = document.getElementById("trade_agreement_content");
			
			
			//document.getElementsByClassName("block").style.width=total_width;
			//document.getElementsByClassName("block").innerHTML="jee";
			//document.getElementByClassName("block").style.borderWidth=total_width;
			// http://stackoverflow.com/questions/5673588/expand-multiple-divs-to-fit-horizontal-width-of-screen
			//var block_height = document.getElementsByClassName("block");
			
			/*
			document.getElementById("cx_count").innerHTML=baby_monitor[0]; // pick a data from url
			document.getElementById("cx_result").innerHTML=baby_monitor[1]; // pick a data from url
			/*
			var cx_array=document.getElementById("connector_array");
			cx_array.innerHTML=baby_monitor[2]; // pick a data from url
			cx_array.style.visibility="visible";
			cx_array.style.display="block";
	
				/*
				if(cx_array.length>0)
				{
				cx_array.style.visibility="visible";
				}
				*/
			}
			// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
			
			/*
			 var toc = document.getElementById("catalog_toc"); // table_of_content
			 var toc_json_mix = baby_monitor[x];
			 var toc_json = JSON.parse(toc_json_mix);
			 var toc_goodput ="<option value=\"\">What's New</option>";
			 for (var goodput in toc_json)
			 {
			 	 toc_goodput += "<optgroup value=\""+toc_json[goodput]+"\">";
			 	 var prop = toc_json[goodput];
				 for(var entity in prop)
				 {
				 	toc_goodput += "<option value=\"\" onchange=\"market_scout('profile','product','','');\">"+prop[entity]+"</option>";
				 }
				 toc_goodput += "</optgroup>";
			}
			 */
		};
		var url ="receiver.php";
		// var data ="create_new_connector="+new_connector_info+"&who_did_that="+profile;
		var data =handler;
		// document.write(url+"?"+data);
		xmlhttp.open("GET",url+"?"+data,true);
		//Send the proper header information along with the request
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", data.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send();
	
	
	
		if(state == "open")
		{
		popup.style.display = 'block';
		}
		if(state == "close")
		{
		popup.style.display = 'none';
		}
		//popup.setAttribute("onmousemove", "market_scout('"+profile_id+"','"+product_id+"', '', 'refresh');");
		//document.getElementById("trade_agreement_content").onMouseOver=function(){market_scout('"+profile_id+"','"+product_id+"', '', 'refresh');};
		//document.getElementById("ta_content").onMouseOver=function(){market_scout('"+profile_id+"','"+product_id+"', '', 'refresh');};
		/*if(topic == "initial_market_scouting")
		{
			document.getElementById("ta_content").setAttribute("onmousemove", "market_scout('"+profile_id+"','"+product_id+"', '', 'initial_market_scouting');");
			document.getElementById("ta_content").setAttribute("onmouseover", "market_scout('"+profile_id+"','"+product_id+"', '', 'initial_market_scouting');");
		}
		else if(topic == "initial_exchange")
		{
		 document.getElementById("ta_content").setAttribute("onmousemove", "market_scout('"+profile_id+"','"+product_id+"', '', 'refresh');");
		 document.getElementById("ta_content").setAttribute("onmouseover", "market_scout('"+profile_id+"','"+product_id+"', '', 'refresh');");
		}*/
		
}

function market_scouting(profile_id, product_id,connector_id, index)
{
	// var popup = document.getElementById(topic);
	// var popup = document.getElementById("market_scouting_frame");
	//var profile_id = profile_id;
	//var product_id = product_id;
	//var connector_id = connector_id;
	//var index = index;
	var handler = "market_scout=1&profile_id="+profile_id+"&product_id="+product_id+"&connector_id="+connector_id;
	
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
		// var baby_monitor = xmlhttp.responseText.split("\r\n"); // pick a data from url
		var baby_monitor = xmlhttp.responseText; // pick a data from url
		// document.write(baby_monitor);
		// document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
		// document.getElementById("cx_result").value=baby_monitor[1]; // pick a data from url
		// if(index != "")
		// {
		// }
		// else
		// {
			document.getElementById("trade_agreement_content").innerHTML=baby_monitor; // pick a data from url
		// }
		/*
		document.getElementById("cx_count").innerHTML=baby_monitor[0]; // pick a data from url
		document.getElementById("cx_result").innerHTML=baby_monitor[1]; // pick a data from url
		var cx_array=document.getElementById("connector_array");
		cx_array.innerHTML=baby_monitor[2]; // pick a data from url
		cx_array.style.visibility="visible";
		cx_array.style.display="block";
		*/
			/*
			if(cx_array.length>0)
			{
			cx_array.style.visibility="visible";
			}
			*/
		}
		// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
	};
	var url ="receiver.php";
	// var data ="create_new_connector="+new_connector_info+"&who_did_that="+profile;
	var data =handler;
	// document.write(url+"?"+data);
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();
	
}

function create_new_connector()
{
	// http://www.webdeveloper.com/forum/showthread.php?257157-document.getElementsBy....-Differences
	// document.write("Toimii sentäs joku!");
	// var new_connector_info = document.getElementsByName("new_connector[name]");
	// document.write(new_connector_info + " count is " + new_connector_info.length+"<br/>");
	// var modifier = modifier;
	
	/*
	var connector_form = new_connector.elements["new_connector["+i+"]"];
	document.write("connector_form: "+connector_form);
	*/
	
	
	var content = document.getElementsByClassName("new_connector");
	// document.write("q: "+q);
	// var s ="Koko: "+si+"<br/>";
	var handler = "";
	var six=content.length;
	/*
	var si=0;
	for(element in content)
	{
		if(element != "length" && element != "item" && element != "namedItem")
		{
		si+=1;
		}
	}*/
		
	var s="";
	for(element in content)
	{
		// works
		// s += d+ ": " + q[d]+ "name: " + q[d].name+ "<br/>";
		if(element != "length" && element != "item" && element != "namedItem")
		{
			s += "<br/>"+element+ ": name: " + content[element].name+ ", value: " + content[element].value+", this is "+(content[element]);
			handler+=content[element].name+"="+content[element].value;
			if((element*1+1) < six*1){handler+="&";}
		}
	}
	// document.write(s+"<br/>"+si+"/ "+six);
	// document.write(s+"<br/>"+six);
	// document.write(s+"<br/>"+handler+"<br/>"+six);
	
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
		// document.write(baby_monitor);
		// document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
		// document.getElementById("cx_result").value=baby_monitor[1]; // pick a data from url
		// document.getElementById("cx_result").innerHTML=baby_monitor; // pick a data from url
		
		document.getElementById("cx_count").innerHTML=baby_monitor[0]; // pick a data from url
		document.getElementById("cx_result").innerHTML=baby_monitor[1]; // pick a data from url
		var cx_array=document.getElementById("connector_array");
		cx_array.innerHTML=baby_monitor[2]; // pick a data from url
		cx_array.style.visibility="visible";
		cx_array.style.display="block";

			/*
			if(cx_array.length>0)
			{
			cx_array.style.visibility="visible";
			}
			*/
		}
		// document.write("state: "+xmlhttp.readyState+", status: "+xmlhttp.status);
	}
	var url ="receiver.php"
	// var data ="create_new_connector="+new_connector_info+"&who_did_that="+profile;
	var data =handler;
	// document.write(url+"?"+data);
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();
	
	
}


// $test .=	"<a onclick=\"showPopup('popup');\">Show Popup</a>";
// http://www.w3schools.com/cssref/pr_pos_z-index.asp
// http://www.w3schools.com/css/css_image_transparency.asp
// http://stackoverflow.com/questions/3202583/how-to-center-align-pop-up-div-using-javascript
function trade_agreement_popup(id, state) {
    var popup = document.getElementById(id);
	if(state == "open")
	{
    popup.style.display = 'block';
	}
	if(state == "close")
	{
    popup.style.display = 'none';
	}
}

function cancel(profile, owner, product)
{
	var profile = profile;
	var owner = owner;
	var product = product;
	// document.write(profile+" "+owner+" "+product);
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
		document.getElementById("buy_"+product).onclick=function() {baby_monitor[0];} // pick a data from url
		document.getElementById("buy_"+product).value=baby_monitor[1]; // pick a data from url
		// document.getElementById("for_sale").innerHTML =baby_monitor[1]; // pick a data from url
		//document.getElementById("test").innerHTML ="2: "+baby_monitor[1]+"<br/>"; // pick a data from url
		}
	}
	//data="data="+data;
	data="trade_agreement_cancel_for="+profile+"&owner="+owner+"&product="+product;
	// document.write(data);
	xmlhttp.open("GET",url+"?"+data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
}

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
		document.getElementById("economyflow").innerHTML =baby_monitor[0]; // pick a data from url
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
		var cart = xmlhttp.responseText.split("\r\n"); // pick a data from url
		// var cart = xmlhttp.responseText; // pick a data from url
		//document.getElementById("test").value="1: "+baby_monitor[0]+"<br/>"; // pick a data from url
		// document.getElementById("most_used").innerHTML =baby_monitor+"<br/>"; // pick a data from url
		document.getElementById("cart").innerHTML =cart[0]; // pick a data from url
		document.getElementById("buy_"+product).onclick=function () {cart[1]}; // pick a data from url
		document.getElementById("buy_"+product).value=cart[2]; // pick a data from url
		document.getElementById("cart_content").innerHTML=" · "+cart[3]; // pick a data from url
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
function refresh_something()
{
	/*
	http://stackoverflow.com/questions/3871547/js-iterating-over-result-of-getelementsbyclassname-using-array-foreach
	var profile = profile;
	var view = view;
	var url = "receiver.php";
	
	var hold_on = document.getElementsByClassName("hold_on");
	var hold_on_array = Array.prototype.slice.call(hold_on, 0);
		hold_on_array.forEach(function(ho)
		{
		// do something interesting
		console.log(el.tagName);
		}
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
		var dynamics = xmlhttp.responseText.split("\r\n"); // content: width\r\n<img><img><img>\r\n
		var process = dynamics.count()/2;
			for(var p=0;p<process;p++)
			{
			document.getElementById("product_"+dynamics[p]).innerHTML = dynamics[p+1]; // pick a data from url
			}
		}
	}
	//data="data="+data;
	data="receiver.php?refresh_hold_on="+hold_on;
	xmlhttp.open("GET",data,true);
	//Send the proper header information along with the request
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", data.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send();	
}
*/

function element_action(element, command)
{
	var o = document.getElementById(element.id);
	var x = document.getElementById("xaA");
	var n = {"Plot": h= { "xaa": "Tonttivalmistaja- tai kustantaja",
							"xab": "Tuotemalli tai -esittäjä",
							"xac": "Tuotetarkennus tai -kuvaus",
							"xad": "Tuote",
							"xae": "Ostettu",
							"xaf": "Sijainti",
							"xag": "Tontti",
							"xah": "Tontti"
							}, 
			"Property": i= {"xaa": "Kiinteistövalmistaja- tai kustantaja",
							"xab": "Kiinteistömalli tai -esittäjä",
							"xac": "Kiinteistötarkennus tai -kuvaus",
							"xad": "Kiinteistö",
							"xae": "Rakennusvuosi",
							"xaf": "Rakennusmaa",
							"xag": "Kiinteistö",
							"xah": "Kiinteistö"
					}, 
			"House": j= {"xaa": "Talovalmistaja- tai kustantaja",
						"xab": "Talomalli tai -esittäjä",
						"xac": "Talotarkennus tai -kuvaus",
						"xad": "Talo",
						"xae": "Rakennusvuosi",
						"xaf": "Rakennusmaa",
						"xag": "Talo",
						"xah": "Talo"
					}, 
			"Room": k= {"xaa": "Huonevalmistaja- tai kustantaja",
						"xab": "Huonemalli tai -esittäjä",
						"xac": "Huonetarkennus tai -kuvaus",
						"xad": "Huone",
						"xae": "Käyttöönottovuosi",
						"xaf": "Käyttöönottomaa",
						"xag": "Huone",
						"xah": "Huone"
					}, 
			"Stuff": l = {"xaa": "Tuotevalmistaja- tai kustantaja",
							"xab": "Tuotemalli tai -esittäjä",
							"xac": "Tuotetarkennus tai -kuvaus",
							"xad": "Tuote",
							"xae": "Valmistusvuosi",
							"xaf": "Valmistusmaa",
							"xag": "Tuote",
							"xah": "Tuote"
							}
			};
	var p = o.parentNode;	
	for(var a=0;a<p.childNodes.length;a++)
	{
		var b = p.childNodes[a];
		//document.write(b.id+ ",");
		if(b.id == o.id)
		{
			b.setAttribute("selected", "selected");
			b.setAttribute("checked","checked");
			b.setAttribute("disabled", true);
			document.getElementById("type_of_object").value=o.value;
			//document.write(object.id+ " onnistui, ");
			//b.value["Tontti"] ? "" : "";
		}
		else
		{
		// http://www.w3schools.com/dom/met_element_removeattribute.asp
		b.removeAttribute("selected");
		b.removeAttribute("checked");
		b.removeAttribute("disabled");
		}
	}
	//http://stackoverflow.com/questions/5223/length-of-javascript-object-ie-associative-array
	//http://stackoverflow.com/questions/2373651/for-loop-for-object
	//http://www.w3schools.com/jsref/event_onfocus.asp
	//http://stackoverflow.com/questions/3446269/javascript-text-input-fields-that-display-instruction-placeholder-text
	//document.write(Object.keys(n.Tontti).length);
	for(key in Object.keys(n.Plot))
	{
		//document.getElementById(Object.keys(n.Tontti)[key]).innerHTML=n[o.value][Object.keys(n.Tontti)[key]];
		var a = document.getElementById(Object.keys(n.Plot)[key]);
		var b = n[o.value][Object.keys(n.Plot)[key]];
		a.innerHTML=b;
		/*a.value=b;
		a.style.color="grey";
		a.onblur=function ()
		{
			this.style.color="grey";
			this.value=b;
		};
		a.onfocus=function ()
		{
			this.style.color="black";
			this.value='';
		};*/
	}
}

function product_form()
{
	var cnt = document.getElementById("most_used");
	var header = document.getElementById("storage_modify");
	form  = "";
	form += "<form method=\"post\" action=\"\"  enctype=\"multipart/form-data\">";
	form += "<input type=\"reset\" value=\" Poista \" style=\"float: right;\">";
	form += "<input type=\"submit\" value=\" Tallenna \" style=\"float: right;\">";
	//form += "<input type=\"button\" value=\" &lt; Preview \" style=\"float: right;\">";
	form += "<input type=\"hidden\" name=\"product[use_of]\" value=\"In_Use\" style=\"\"><br/>";
	form += "<h2 style=\"height: 25px;background-color: #D3D3D3; margin: -20 0 5 0;color: #000000; font: 18px Times New Roman;border-bottom: 1px solid;\">Perustiedot</h2>";
	form += "<div>";
	form += "Object type: ";
	form += "<span id=\"xdA\">";
	form += "<input id=\"xda\" type=\"button\" onclick=\"element_action(this, 'selected');\" value=\"Plot\" name=\"product[type_of_object]\">";
	form += "<input id=\"xdb\" type=\"button\" onclick=\"element_action(this, 'selected');\" value=\"Property\" name=\"product[type_of_object]\">";
	form += "<input id=\"xdc\" type=\"button\" onclick=\"element_action(this, 'selected');\" value=\"House\" name=\"product[type_of_object]\">";
	form += "<input id=\"xdd\" type=\"button\" onclick=\"element_action(this, 'selected');\" value=\"Room\" name=\"product[type_of_object]\">";
	form += "<input id=\"xde\" type=\"button\" onclick=\"element_action(this, 'selected');\" value=\"Stuff\" name=\"product[type_of_object]\"";
	form += "</span>";
	form += "</div>";
	form += "<input id=\"type_of_object\" type=\"hidden\" value=\"\" name=\"product[type_of_object]\">";
	form += "<span id=\"xaA\">";
	form += "<span id=\"xaa\">Tuotevalmistaja tai -kustantaja</span>: <input id=\"xa\" type=\"\" name=\"product[manufacturer]\" style=\"float:right;\"><br/><!--onKeyDown=\"input_value();\" onKeyUp=\"input_value();\"-->";
	form += "<span id=\"xab\">Tuotemalli tai -esittäjä</span>: <input id=\"xa\" type=\"\" name=\"product[model]\" style=\"float:right;\"><br/>";
	form += "<span id=\"xac\">Tuotetarkennus tai -kuvaus</span>: <input id=\"xa\" type=\"\" name=\"product[specification]\" style=\"float:right;\"><br/>";
	form += "<span id=\"xad\">Tuote</span>: <input id=\"xa\" type=\"\" name=\"product[item]\" style=\"float:right;\"><br/> <!-- onKeyDown=\"input_value();\" onKeyUp=\"input_value();\" -->";
	form += "<span id=\"xae\">Valmistusvuosi</span>: <input id=\"xa\" type=\"\" name=\"product[vintage_year]\" style=\"float:right;\"><br/>";
	form += "<span id=\"xaf\">Valmistusmaa</span>: <input id=\"xa\" type=\"\" name=\"product[made_in]\" style=\"float:right;\"><br/>";
	form += "</span>";
	form += "<h4 style=\"border-top: 1px solid;\">Image of <span id=\"xag\"></span></h4>";
	form += "<img src=\"\" style=\"width:75px;height:75px; float: left;border: 1px inner;\">";
	form += "<li>Not a copy, your own</li>";
	form += "<li>Good Quality</li>";
	form += "<li>Clear and cute</li>";
	form += "<li>Presentable</li>";
	form += "Add<input type=\"file\" name=\"picture\" style=\"float: left;\">";
	form += "<div style=\"border-top: 1px solid;margin: 5 0 0 0;\"><h4>Connectors for <span id=\"xah\"></span> <span id=\"cx_visibility\"><span id=\"cx_count\"></span></span>";
	form += "<span style=\"float:right;\"><input id=\"connectors_form\" type=\"text\" onKeyUp=\"start_knowledge_menu(this,'connectors_knowledge','view','undefined');\" title=\"Type help, if you feel empty.\" value=\"Add Connectors...\" /> <!--<a href=\"javascript:void(0);\">3 compatible items</a>--></span></h4></div>";
	form += "<div id=\"connectors_knowledge_embedded\">";
	form += "<div id=\"cx_result\" style=\"border: 1px solid;\">List</div>";
	form += "</div>";
	form += "<input type=\"hidden\" name=\"product[location]\">";
	form += "<input type=\"hidden\" name=\"product[building]\">";
	form += "<input type=\"hidden\" name=\"product[room]\">";
	form += "</form>";
	cnt.innerHTML = form;
	//cnt.onload= function() {element_action(this, 'selected');};
	header.innerHTML = "&raquo; Lisää tavara";
}

/*
// this is original 
function product_form()
{
	var cnt = document.getElementById("most_used");
	var header = document.getElementById("storage_modify");
	form  = "";
	form += "<form method=\"post\" action=\"\"  enctype=\"multipart/form-data\">";
	form += "<input type=\"reset\" value=\" Poista \" style=\"float: right;\">";
	form += "<input type=\"submit\" value=\" Tallenna \" style=\"float: right;\">";
	//form += "<input type=\"button\" value=\" &lt; Preview \" style=\"float: right;\">";
	form += "<input type=\"hidden\" name=\"product[use_of]\" value=\"In_Use\" style=\"\"><br/>";
	form += "<h2 style=\"height: 25px;background-color: #D3D3D3; margin: -20 0 5 0;color: #000000; font: 18px Times New Roman;border-bottom: 1px solid;\">Perustiedot</h2>";
	form += "Object type: ";
	form += "<span id=\"xdA\">";
	form += "<input id=\"xda\" type=\"button\" onclick=\"element_action(this, 'selected');\" value=\"Tontti\" name=\"product[type_of_object]\">";
	form += "<input id=\"xdb\" type=\"button\" onclick=\"element_action(this, 'selected');\" value=\"Kiinteistö\" name=\"product[type_of_object]\">";
	form += "<input id=\"xdc\" type=\"button\" onclick=\"element_action(this, 'selected');\" value=\"Talo\" name=\"product[type_of_object]\">";
	form += "<input id=\"xdd\" type=\"button\" onclick=\"element_action(this, 'selected');\" value=\"Huone\" name=\"product[type_of_object]\">";
	form += "<input id=\"xde\" type=\"button\" onclick=\"element_action(this, 'selected');\" value=\"Tavara\" name=\"product[type_of_object]\">";
	form += "</span>";
	form += "<div style=\"width: 375px;float: right;\">";
	form += "Image<br/>";
	form += "<img src=\"\" style=\"width:75px;height:75px; float: left;border: 1px inner;\">";
	form += "<li>Not a copy, your own</li>";
	form += "<li>Good Quality</li>";
	form += "<li>Clear and cute</li>";
	form += "<li>Presentable</li>";
	form += "Add<input type=\"file\" name=\"picture\" style=\"float: left;\">";
	form += "</div>";
	form += "<div style=\"width: 400px;\">";
	form += "<span id=\"xaA\">";
	form += "<span id=\"xaa\">Tuotevalmistaja tai -kustantaja</span>: <input id=\"xaa\" type=\"\" name=\"product[manufacturer]\" style=\"float:right;\"><br/><!--onKeyDown=\"input_value();\" onKeyUp=\"input_value();\"-->";
	form += "<span id=\"xab\">Tuotemalli tai -esittäjä</span>: <input id=\"xab\" type=\"\" name=\"product[model]\" style=\"float:right;\"><br/>";
	form += "<span id=\"xac\">Tuotetarkennus tai -kuvaus</span>: <input id=\"xac\" type=\"\" name=\"product[specification]\" style=\"float:right;\"><br/>";
	form += "<span id=\"xad\">Tuote</span>: <input id=\"xad\" type=\"\" name=\"product[item]\" style=\"float:right;\"><br/> <!-- onKeyDown=\"input_value();\" onKeyUp=\"input_value();\" -->";
	form += "<span id=\"xae\">Valmistusvuosi</span>: <input id=\"xae\" type=\"\" name=\"product[vintage_year]\" style=\"float:right;\"><br/>";
	form += "<span id=\"xaf\">Valmistusmaa</span>: <input id=\"xaf\" type=\"\" name=\"product[made_in]\" style=\"float:right;\"><br/>";
	form += "</span>";
	form += "</div>";
	form += "<h2 style=\"background-color: #D3D3D3; margin: 5 0;color: #000000; font: 16px Times New Roman;border-bottom: 1px solid;\">Muut tiedot</h2>";
	form += "<div style=\"width: 500px; float: right;\">";
	form += "<b>Mitä sisältyy?</b><br/>";
	form += "Motor, power or battery: <label style=\"float: right; margin-right: 10px;\"><input type=\"radio\" name=\"product[engine]\" value=\"0\" style=\"float: left;\">Ei/En tiedä</label><label style=\"float: right; margin-right: 10px;\"><input type=\"radio\" name=\"product[engine]\" value=\"1\" style=\"float: left;\">Kyllä</label><br/>";
	form += "Measure, color, material or layout: <label style=\"float: right; margin-right: 10px;\"><input type=\"radio\" name=\"product[color]\" value=\"0\" style=\"float: left;\">Ei/En tiedä</label><label style=\"float: right; margin-right: 10px;\"><input type=\"radio\" name=\"product[color]\" value=\"1\" style=\"float: left;\">Kyllä</label><br/>";
	form += "Wheels, suspension, brakes or transmission: <label style=\"float: right; margin-right: 10px;\"><input type=\"radio\" name=\"product[material]\" value=\"0\" style=\"float: left;\">Ei/En tiedä</label><label style=\"float: right; margin-right: 10px;\"><input type=\"radio\" name=\"product[material]\" value=\"1\" style=\"float: left;\">Kyllä</label><br/>";
	form += "Connectors, external buttons, fault, properties: <label style=\"float: right; margin-right: 10px;\"><input type=\"radio\" name=\"product[wheels]\" value=\"0\" style=\"float: left;\">Ei/En tiedä</label><label style=\"float: right; margin-right: 10px;\"><input type=\"radio\" name=\"product[wheels]\" value=\"1\" style=\"float: left;\">Kyllä</label><br/>";
	form += "</div>";
	form += "<div style=\"width: 260px;\">";
	form += "<b>Mistä löytyy?</b><br/>";
	form += "<hr style=\"margin: 10 0 -12 0;\"/><span style=\"background-color: #ffffff; padding-right:10px;\">Valitse sijainti</span><br/>";

	form += "<select name=\"\">";
	form += "<option value=\"\">Koti / Keittiö</option>";
	form += "<option value=\"\">Koti / Olohuone</option>";
	form += "<option value=\"\">Koti / Makuuhuone</option>";
	form += "</select>";
	form += "<hr style=\"margin: 10 0 -12 0;\"/><span style=\"background-color: #ffffff; padding-right:10px;\">Ehdotetut sijainnit</span><br/>";
	form += "<span class=\"capsule\"><a href=\"\" style=\"color:blue; text-decoration:none;\">Kämppä / Solu</a> <a href=\"\" style=\"color:blue; text-decoration:none;\">&times;</a></span>";
	form += "<hr style=\"margin: 10 0 -12 0;\"/><span style=\"background-color: #ffffff; padding-right:10px;\">Tai täydennä tiedot</span><br/>";
	
	form += "Sijainti: <input type=\"hidden\" name=\"product[location]\" style=\"float: right;\"><br/>";
	form += "Rakennuksessa: <input type=\"hidden\" name=\"product[building]\" style=\"float: right;\"><br/>";
	form += "Huone: <input type=\"hidden\" name=\"product[room]\" style=\"float: right;\">";
	form += "</div>";
	form += "</form>";
	cnt.innerHTML = form;
	header.innerHTML = "&raquo; Lisää tavara";
}*/

function inpu_t(input, product_id)
{
	var word = input;
	var product_id = product_id;
	var x = document.getElementById(word);
	// var content  ="<a href=\"javascript:void(0);\" onclick=\"cancel_value('"+word+"');\" title=\"cancel\">&times;</a><input type=\"\" name=\"techspecs["+word+"]\" value=\"Add "+word+"\" onKeyPress=\"start_menu('"+word+"_knowledge_popup','view');\"><input type=\"submit\" value=\"update\">";
	// var content  ="<a href=\"javascript:void(0);\" onclick=\"cancel_value('"+word+"');\" title=\"cancel\">&times;</a><input type=\"\" id=\""+word+"_form\" name=\"techspecs["+word+"]\" value=\""+word+"_knowledge\" onKeyUp=\"start_knowledge_menu('"+word+"_knowledge','view');\" title=\"Type help, if you don't know what to type.\"><input type=\"submit\" value=\"update\">";
	var content  ="<a href=\"javascript:void(0);\" onclick=\"cancel_value('"+word+"');\" title=\"cancel\">&times;</a><input type=\"\" id=\""+word+"_form\" name=\"techspecs["+word+"]\" value=\""+word+"_knowledge\" onKeyUp=\"start_knowledge_menu(this,'"+word+"_knowledge','view','"+product_id+"');\" title=\"Type help, if you feel empty.\"><input type=\"submit\" value=\"update\">";
	
	// query = explode(" ", query) ... jollain tällaisella pitäs saada torjuttua empty search problems eli välilyönnit eli whitespace-tech.
	// lisää etusivulle sellainen filtteri missä on "kiinnostavat tavarat / yhteensopivia tavaroita yksityisiltä+yrityksiltä"
	
	// var content  ="<a href=\"javascript:void(0);\" onclick=\"cancel_value('"+word+"');\" title=\"cancel\">&times;</a><input type=\"\" id=\""+word+"_form\" name=\"techspecs["+word+"]\" value=\""+word+"_knowledge\" onKeyUp=\"start_knowledge_menu('"+word+"_knowledge','view');\" title=\"If you cannot remember or if you don't know the name of connector, write help.\"><input type=\"submit\" value=\"update\">";
		// content += "<input type=\"button\" onclick=\"cancel_value('"+word+"');\" value=\"cancel\">";
	// x.innerHTML=word+content;
	x.innerHTML=content;
}
function cancel_value(input)
{
	var word = input;
	var x = document.getElementById(word);
	x.innerHTML="<a href=\"javascript:void(0);\" onClick=\"inpu_t('"+word+"');\">Add "+word+"</a>";
}

function text_event(text)
{
	var word = text;
	var x = document.getElementById(word);
	x.innerHTML="<a href=\"javascript:void(0);\" onmouseover=\"text_event();\" onmouseout=\"text_event('Add "+word+"');\" onclick=\"cancel_value('"+word+"');\" title=\"cancel\">&times;</a><input type=\"\" name=\"techspecs["+word+"]\" value=\"Add "+word+"\"><input type=\"submit\" value=\"update\">";

}
function inpu_(input)
{
	var word = input;
	var x = document.getElementById(word);
	var content  = "<input type=\"\" name=\"techspecs["+word+"]\" value=\"\"><input type=\"button\" onclick=\"update('"+word+"');\" value=\"update\">";
		content += "<input type=\"\" name=\"techspecs["+word+"]\" value=\"\"><input type=\"button\" onclick=\"add_value('"+word+"');\" value=\"cancel\">";
	x.innerHTML=word+content;
}
function update(input)
{
	var word = input;
	var x = document.getElementById(word);
	var compareline  = "<div>";
		compareline +="This product "+word+" is ... <input type=\"button\" onclick=\"inpu_t('"+word+"')\" value=\"Edit\"><br/>";
		compareline +="Browse other products by "+word;
		compareline +="<div style=\"clear:left;\">";
	var size = 1124;
		for(var i=0;i<6;i++)
		{
		size+=i;
		compareline +="<a href=\"object.php?id=\"><img src=\"\" style=\"width:50;height:50px;\"><span style=\"margin:0 10 0 -40\">"+size+"</span></a>";
		}
		compareline +="</div>";
		compareline +="</div>";
	x.innerHTML=compareline;
}

function change_measurement_detail(value)
{
	var value = value;
	var x = document.getElementById(value);
}

function getPos(el) {
    /* yay readability
	http://stackoverflow.com/questions/288699/get-the-position-of-a-div-span-tag
	http://stackoverflow.com/questions/503992/position-div-depending-on-distance-browser-edge-javascript
	http://www.w3schools.com/Css/css_positioning.asp
	*/
    for (var lx=0, ly=0;
         el != null;
         lx += el.offsetLeft, ly += el.offsetTop, el = el.offsetParent);
    // return {x: lx,y: ly};
    alert('x: '+ lx +'px,y: '+ly+'px');
}