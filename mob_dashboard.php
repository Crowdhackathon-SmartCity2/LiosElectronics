<?php
//#####################################################################################################################################
//#####################################################################################################################################
//#####################################################################################################################################
//#####################################################################################################################################
//#####################################################################################################################################
//################
//################		S P E C I A L  	 V E R S I O N	 F O R	 H A C K A T H O N	 2 0 1 8
//################		N E E D M Y S Q L  	C O N E C T I O N 	I N F O 
//#####################################################################################################################################
//#####################################################################################################################################
//#####################################################################################################################################
//#####################################################################################################################################
//#####################################################################################################################################
//#####################################################################################################################################
//#####################################################################################################################################

session_unset();
session_write_close();
session_start();

date_default_timezone_set('Europe/Athens');
$current_date_time = date('Y-m-d H:i:s');
$_SESSION['session_current_date_time'] = $current_date_time ;


																																																	header('Location: /userlogout.php');																																																		}
?>


<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">		
<html>
		<head>
				<title>d-tel.eu</title>
				<meta http-equiv="content-type" 	content="text/html; charset=UTF8" >
				<meta name="viewport" 				content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
				<script type="text/javascript" 	src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
				<link rel="stylesheet" type="text/css" href="mob_dash.css?<?php echo "Thursday 24th of April 2008 ".date('h:i:s A'); ?>" />				
		</head>
<div style="display:block; width:auto; height:100vh;">
<body onresize="page_size_change()" onload="" bgcolor="#ffffff" >
	
<!-- #####################################################  ALARM  ############################################## -->
<div id="myModal" class="modal">
<!-- ######### ALARM  MESSAGE ##########-->
		<div class="modal-content">
				
				<table border="0" id="user_info" cellspacing="0" cellpadding="0" style="-webkit-user-select: none; background:rgba(255,255,255,0.6); height:auto; width:100%;" >
						<tr>
								<td>
									<font color="red" align="center" style="display:block; font-size:6.0vw;" >ΠΡΟΣΟΧΗ!!!</font>
								</td>
						</tr>
						<tr>
								<td>
									<font color="black" align="center" style="display:block; font-size:4.5vw;" >Δεν Υπάρχει Επικοινωνία Με Το Server</font>
								</td>
						</tr>
						<tr>
								<td>
									<center><font color="black" align="center" style="display:block; font-size:2.5vw;" >Ελέγξτε την τοπική σας σύνδεση </font> <button onclick="alarm_button(this.id)" id="alarm_close_button" style="font-size: 4.5vh;">Close</button></center>
								</td>
						</tr>
						
				</table>
		</div>
</div>



<center>
		<table border="0" id="main_info" cellspacing="3" cellpadding="3" style="background:rgba(255,255,255,0.6); height:auto; width:95%;" >
				<tr>
						<img id="MindThePump_logo" align="center" src="MindThePump_logo.png"  style="display:block; width:90%; height:auto;">	
				</tr>				
		</table>
</center>


<center>
		<table border="0" bordercolor="lime" id="main_table"  cellspacing="3" cellpadding="0" style="background:rgba(255,255,255,0.6); -webkit-user-select:none; display:inline-table;  height:auto; width:99%;">
				<tr>
						<td>
							<center><div id="main_view_div" 	style="background:rgba(255,255,255,0.6); border-style:none; border-color:red; overflow-x: hidden; width:auto; height:auto;"></div></center>
						</td>
				</tr>
		</table>				
</center>




</body>
</div>
</html>






<script type="text/javascript">

var epilegmeno_serial_pcb;

		
var window_Width;
var window_Height;

var page_Height;
var page_Width;

var screen_Height;
var screen_Width;

var table_Width;
var table_Height;

var login_image_button_Width;
var login_image_button_Height;

var view_type 				= "home";
var view_type_sn			= "99:99:00:00:00:00:00:99";
var view_one_time 			= 0;
var view_stat_cells 			= 0;



var view_mia_fora_mono      = 0;

var myTimer = setInterval(function()	{ looptime(); }, 100);
var loop_time   = 15;
var loop_cnt    = 0;

var d=0;

var l1_v_gauge;
var l2_v_gauge;
var l3_v_gauge;

var l1_a_gauge;
var l2_a_gauge;
var l3_a_gauge;


var network_error_cnt =0;
var network_error_max =5;

var numb_gauge_init =0;
//#######################################################################################
//########## MAPS VARIABLES ############################
//include_maps_library_one=0;
var include_maps_library_one=0;
var map;
var getjs = "";
var tr_info_1 ="";
var tr_info_2 ="";
var tr_info_3 ="";
var tr_info_4 ="";
var map;
var marker;
var markers_arr = [];
var markers =[];
var circles =[];
var infowindows =[];



function looptime()
{
loop_cnt++;
if (loop_cnt>=loop_time)
                        {
                        loop_cnt=0;
                        call_board_table();
                        }
                        
if (loop_cnt<0)         {loop_cnt=0;}
}

function page_reload()
{
Location.reload();
}

$(document).ready(function()
								{
								page_size_change();
								call_board_table();
								});

function alarm_button(clicked_id)
{
if(clicked_id == "alarm_close_button")
                                                {
                                                var modal = document.getElementById('myModal');
                                                modal.style.display = "none";
                                                network_error_cnt=-10;
                                                }      
}


function network_alarm(st)
								{
								if(st==1)
										{
										network_error_cnt++;
										if (network_error_cnt>=network_error_max)
																				{
																				var modal = document.getElementById('myModal');
																				modal.style.display = "block";
																				}
										}
								if(st==0)
										{
										network_error_cnt=0;
										var modal = document.getElementById('myModal');
										if (modal.style.display == "block") {modal.style.display = "none"; }
										}
								
								
								}


function page_size_change()
								{
								//##################################################################################
								window_Width 	= window.innerWidth;
								window_Height 	= window.innerHeight; 
								
								screen_Width 	= window.screen.width;
								screen_Height 	= window.screen.height; 
		
                               table_Width 	= parseInt(((98/100)*window_Width));//"95%";//220;//	parseInt(((16/100)*window_Width));
								table_Height     = window_Height - 80;
															
                                                                
                                                                
                                document.getElementById("main_view_div").style.width 	    = table_Width+"px";
                                document.getElementById("main_view_div").style.maxHeight 	= table_Height+"px";
                                
                                document.getElementById("main_view_div").style.width 	    = table_Width+"px";
                                document.getElementById("main_view_div").style.maxHeight 	= table_Height+"px";
                                
                                document.getElementById("main_view_div").style.width 	    = table_Width+"px";
                                document.getElementById("main_view_div").style.maxHeight 	= table_Height+"px";
                                
                                
                                
                               }



function call_board_table()
                            {
                            loop_cnt=0;
                            if(view_type == "home")
														{
														console.log("\r\nview_type = [" + view_type + "]" + "\r\nview_one_time = [" + view_one_time + "]" + "\r\nview_stat_cells = [" + view_stat_cells + "]");
														$.ajax(
																{
																url: "mob_dashboard_scr.php?view_type="+view_type+"&view_type_sn="+view_type_sn,
																cache: false,
																async: false,
																timeout:100,
																success: function(data)
																						{
																								console.log("\r\n ajax ok");
																						$("#main_view_div").html(data);
																						view_stat_cells =0;
																						view_one_time = 0;		
																															
																						network_alarm(0); 
																						},
																error: function(data)
																						{
																						console.log("\r\n ajax error");
																						network_alarm(1);    
																						}
																						
																						
																
																
																});    
														}

							}

</script> 


