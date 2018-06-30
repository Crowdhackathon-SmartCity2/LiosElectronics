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
//session_destroy();
session_write_close();
session_start();

$view_type      = null;
$view_type_sn   = null;

if (isset($_GET['view_type']))          {$view_type = $_GET['view_type'];}              else        {$view_type = null;}
if (isset($_GET['view_type_sn']))       {$view_type_sn = $_GET['view_type_sn'];}        else        {$view_type_sn = null;}                                                                                                                                                                                                      
?>
<?php
date_default_timezone_set('Europe/Athens');
$current_date_time = date('Y-m-d H:i:s');
$_SESSION['session_current_date_time'] = $current_date_time ;

$db_table             	= 'add table name'; 
$dbhost         	= 'xxx.xxx.xxx.xxx:xxxx';
$dbuser         	= 'add db user name';
$dbpass         	= 'add db password';
$db             	= 'add database name';
                    
function mysql_con()
                    {
                    $_SESSION['conn']=mysqli_connect($dbhost,$dbuser,$dbpass);
                    mysqli_select_db($_SESSION['conn'],$db)or die(mysql_error("prosoxi"));
                    mysqli_query($_SESSION['conn'], "SET NAMES 'utf8'");
                    mysqli_query($_SESSION['conn'], "SET CHARACTER SET 'utf8'");
                    }

function secondsToTime($seconds)
                                {
                                $dtF = new DateTime("@0");
                                $dtT = new DateTime("@$seconds");
                                return $dtF->diff($dtT)->format('%DΗμ. %H:%I:%S');
                                }
function secondsToHour($seconds)
                                {
                                return sprintf("%08d", floor($seconds/3600), ($seconds/60)%60);                           
                                }
                                
                                
if($view_type=="home")
                            {
                            mysql_con();
                            $query = "SELECT * FROM ".$db_table." where pcb_serial = '".$view_type_sn."'";
                            $results = mysqli_query($_SESSION['conn'],$query) or die ($error_log = mysqli_error($_SESSION['conn']) );
                            //******************************************************  close connection to mysql
                            mysqli_close($_SESSION['conn']);									
                            //******************************************************  close connection to mysql
                            echo "<table border=\"0\" bordercolor=\"red\" id=\"list_view_table\"  cellspacing=\"3\" cellpadding=\"3\" style=\"background:rgba(255,255,255,0.6); -webkit-user-select:none; display:inline-table;  height:auto; width:100%;\">";
                            
                            $u=0;
                            foreach ($results as $result)
                                                        {
                                                        $antliostasio_view_title                            = null;
                                                        $pcb_status                                         = $result['pcb_status'];
                                                        $pcb_serial                                         = $result['pcb_serial'];
                                                        $pcb_name_viologikou                                = $result['pcb_name_viologikou'];
                                                        
                                                        $controller_inputs_levels_parts                     = explode("_",$result['controller_inputs_levels']);
                                                        $controller_input_1_parts		                    = explode(".",$controller_inputs_levels_parts[0]);	
                                                        $controller_input_2_parts		                    = explode(".",$controller_inputs_levels_parts[1]);	
                                                        $controller_input_3_parts		                    = explode(".",$controller_inputs_levels_parts[2]);	
                                                        $controller_outputs_status_parts					= explode("_",$result['controller_outputs_status']);
                                                        //0_0_0_0_0_0_0_0_000_000_000_000_000_000
                                                        $_0_main_power_monitor_measurements_parts			= explode("_",$result['_0_main_power_monitor_measurements']);
                                                        //0_0_0_0_0_0_000_000_000_000_000_000
                                                        $_M_motor_1_monitor_measurements_parts				= explode("_",$result['_M_motor_1_monitor_measurements']);
                                                        $_M_motor_2_monitor_measurements_parts				= explode("_",$result['_M_motor_2_monitor_measurements']);
                                                        $_M_motor_3_monitor_measurements_parts				= explode("_",$result['_M_motor_3_monitor_measurements']);
                                                        $_M_motor_4_monitor_measurements_parts				= explode("_",$result['_M_motor_4_monitor_measurements']);
                            
                                                        $pcb_cell_operator                                  = $result['pcb_cell_operator'];
                                                        $pcb_cell_signal                                    = $result['pcb_cell_signal'];
                                                        
                                                        $date_time_last_status                              = $result['date_time_last_status'];
                                                        $pcb_time_to_send_data                              = $result['pcb_time_to_send_data'];
                                                        
                                                        $date_time_last_status_diffrence =0;
                                                        $date1 = new DateTime($date_time_last_status);                                              //kanoume date type to mysql
                                                        $date2 = new DateTime($current_date_time);                                                  //kanoume date type to tin trexousa hmera
                                                        $int  = abs(strtotime($current_date_time) - strtotime($date_time_last_status));             //permoume tin diafora se seconds
                                                        $minutes   =intval($int);///60);                                                            //strogkylopioume
                                                        $interval = $date1->diff($date2);                                                           // permoume tin diafora se seconds
                                                        $days_last_update = sprintf('%03d', $interval->days);
                                                        $hour_last_update = sprintf('%02d', $interval->h);
                                                        $minu_last_update = sprintf('%02d', $interval->i);
                                                        $seco_last_update = sprintf('%02d', $interval->s);
                                                        if($int>=$pcb_time_to_send_data+15) {$offline_status = 1;} else {$offline_status = 0;}
                                                        $date_time_last_status_diffrence = $days_last_update." Ημέρες ".$hour_last_update.":".$minu_last_update.":".$seco_last_update;  //  &nbsp;&nbsp;&nbsp;&nbsp; ====================  [Δουλεθω εγω τα χρωματα αυτην τιν στιγμη] 
                                                         
                                                         
                                                         
                                                         
                                                         
                                                          
                                                        $cell_title_color               = "";
                                                        $cell_class                     = "";
                                                        $cell_collor                    = "";
                                                        $cell_text                      = "";
                                                        $no_use_cell_collor             = "";
                                                        
                                                        
                                                        //=========================
                                                        $tank_cell_color_1              = "";
                                                        $tank_clas_color_1              = "";
                                                        
                                                        $tank_cell_color_2              = "";
                                                        $tank_clas_color_2              = "";
                                                        
                                                        $tank_cell_color_3              = "";
                                                        $tank_clas_color_3              = "";
                                                        
                                                        //=========================
                                                        $ups_power_cell_color           = "";
                                                        $ups_power_clas_color           = "";
                                                        $ups_power_text                 = "";
                                                        
                                                        $ups_battery_cell_color         = "";
                                                        $ups_battery_clas_color         = "";
                                                        $ups_battery_text               = "";
                                                        //=========================
                                                        $offline_cell_color             = "";
                                                        $offline_clas_color             = "";
                                                        $offline_text                   = "";
                                                        
                                                        //=========================
                                                        $L1_V_cell_color                = "";
                                                        $L1_V_clas_color                = "";
                                                        
                                                        $L2_V_cell_color                = "";
                                                        $L2_V_clas_color                = "";
                                                        
                                                        $L3_V_cell_color                = "";
                                                        $L3_V_clas_color                = "";
                                                        
                                                        //=========================
                                                        $L1_A_cell_color                = "";
                                                        $L1_A_clas_color                = "";
                                                        
                                                        $L2_A_cell_color                = "";
                                                        $L2_A_clas_color                = "";
                                                        
                                                        $L3_A_cell_color                = "";
                                                        $L3_A_clas_color                = "";
                                                        
                                                        
                                                         //=========================
                                                        $M1_start_cell_color            = "";
                                                        $M1_start_clas_color            = "";
                                                        $M1_thermal_cell_color          = "";
                                                        $M1_thermal_clas_color          = "";
                                                        
                                                        $M2_start_cell_color            = "";
                                                        $M2_start_clas_color            = "";
                                                        $M2_thermal_cell_color          = "";
                                                        $M2_thermal_clas_color          = "";
                                                        
                                                        $M3_start_cell_color            = "";
                                                        $M3_start_clas_color            = "";
                                                        $M3_thermal_cell_color          = "";
                                                        $M3_thermal_clas_color          = "";
                                                        
                                                        $M4_start_cell_color            = "";
                                                        $M4_start_clas_color            = "";
                                                        $M4_thermal_cell_color          = "";
                                                        $M4_thermal_clas_color          = "";
                                                        
                                                        
                                                        if($controller_input_1_parts[0]=="1")   {$tank_clas_color_1 = "blink_r"; $tank_cell_color_1 = "#ffffff";}   else    {$tank_clas_color_1 = ""; $tank_cell_color_1 = "#71da71";}
                                                        if($controller_input_2_parts[0]=="1")   {$tank_clas_color_2 = "blink_r"; $tank_cell_color_2 = "#cccccc";}   else    {$tank_clas_color_2 = ""; $tank_cell_color_2 = "#cccccc";}
                                                        if($controller_input_3_parts[0]=="1")   {$tank_clas_color_3 = "blink_r"; $tank_cell_color_3 = "#cccccc";}   else    {$tank_clas_color_3 = ""; $tank_cell_color_3 = "#cccccc";}
                                                        
                                                        if($result['ups_status']    == "1")     {$ups_power_clas_color = "blink_r";     $ups_power_cell_color = "";     $ups_power_text   = "ER";}   else    {$ups_power_clas_color = "";   $ups_power_cell_color = "#71da71";          $ups_power_text   = "OK";}      
                                                        if($result['ups_battery']   == "1")     {$ups_battery_clas_color = "blink_r";   $ups_battery_cell_color = "";   $ups_battery_text = "ER";}   else    {$ups_battery_clas_color = ""; $ups_battery_cell_color = "#71da71";        $ups_battery_text = "OK";}
                            
                                                        
                                                        //======================================================================
                                                        if($_0_main_power_monitor_measurements_parts[8]  >= 210)     {$L1_V_clas_color = ""; $L1_V_cell_color = "#47d147";} else {$L1_V_clas_color = ""; $L1_V_cell_color = "#cc7a00";}
                                                        
                                                        if($_0_main_power_monitor_measurements_parts[9]  >= 210)     {$L2_V_clas_color = ""; $L2_V_cell_color = "#47d147";} else {$L2_V_clas_color = ""; $L2_V_cell_color = "#cc7a00";}
                                                        
                                                        if($_0_main_power_monitor_measurements_parts[10] >= 210)    {$L3_V_clas_color = ""; $L3_V_cell_color = "#47d147";} else {$L3_V_clas_color = ""; $L3_V_cell_color = "#cc7a00";}
                                                        
                                                        
                                                        
                                                        if(     ($_0_main_power_monitor_measurements_parts[11] >= 0) && ($_0_main_power_monitor_measurements_parts[11] < 9)     )           {$L1_A_clas_color = ""; $L1_A_cell_color = "#ccccb3";}
                                                        if(     ($_0_main_power_monitor_measurements_parts[11] >= 9) && ($_0_main_power_monitor_measurements_parts[11] < 15)    )           {$L1_A_clas_color = ""; $L1_A_cell_color = "#99ff99";}
                                                        if      ($_0_main_power_monitor_measurements_parts[11] >= 15)                                                                       {$L1_A_clas_color = ""; $L1_A_cell_color = "#ff9900";}
                                                        
                                                        
                                                        if(     ($_0_main_power_monitor_measurements_parts[12] >= 0) && ($_0_main_power_monitor_measurements_parts[11] < 9)     )           {$L2_A_clas_color = ""; $L2_A_cell_color = "#ccccb3";}
                                                        if(     ($_0_main_power_monitor_measurements_parts[12] >= 9) && ($_0_main_power_monitor_measurements_parts[11] < 15)    )           {$L2_A_clas_color = ""; $L2_A_cell_color = "#99ff99";}
                                                        if      ($_0_main_power_monitor_measurements_parts[12] >= 15)                                                                       {$L2_A_clas_color = ""; $L2_A_cell_color = "#ff9900";}
                                                        
                                                        
                                                        if(     ($_0_main_power_monitor_measurements_parts[13] >= 0) && ($_0_main_power_monitor_measurements_parts[11] < 9)     )           {$L3_A_clas_color = ""; $L3_A_cell_color = "#ccccb3";}
                                                        if(     ($_0_main_power_monitor_measurements_parts[13] >= 9) && ($_0_main_power_monitor_measurements_parts[11] < 15)    )           {$L3_A_clas_color = ""; $L3_A_cell_color = "#99ff99";}
                                                        if      ($_0_main_power_monitor_measurements_parts[13] >= 15)                                                                       {$L3_A_clas_color = ""; $L3_A_cell_color = "#ff9900";}
                                                        
                            
                                                        if($_M_motor_1_monitor_measurements_parts[0] == "1") {$M1_start_clas_color = "blink_g";     $M1_start_cell_color = "white";}                                            else    {$M1_start_clas_color = "";     $M1_start_cell_color = "#d9d9d9";}
                                                        if($_M_motor_1_monitor_measurements_parts[1] == "1") {$M1_thermal_clas_color = "blink_r";   $M1_thermal_cell_color = "white";   $M1_start_clas_color = "blink_r";}      else    {$M1_thermal_clas_color = "";   $M1_thermal_cell_color = "orange";}
                                                        
                                                        if($_M_motor_2_monitor_measurements_parts[0] == "1") {$M2_start_clas_color = "blink_g";     $M2_start_cell_color = "white";}                                            else    {$M2_start_clas_color = "";     $M2_start_cell_color = "#d9d9d9";}
                                                        if($_M_motor_2_monitor_measurements_parts[1] == "1") {$M2_thermal_clas_color = "blink_r";   $M2_thermal_cell_color = "white";   $M2_start_clas_color = "blink_r";}      else    {$M2_thermal_clas_color = "";   $M2_thermal_cell_color = "orange";}
                                                       
                                                        if($_M_motor_3_monitor_measurements_parts[0] == "1") {$M3_start_clas_color = "blink_g";     $M3_start_cell_color = "white";}                                            else    {$M3_start_clas_color = "";     $M3_start_cell_color = "#d9d9d9";}
                                                        if($_M_motor_3_monitor_measurements_parts[1] == "1") {$M3_thermal_clas_color = "blink_r";   $M3_thermal_cell_color = "white";   $M3_start_clas_color = "blink_r";}      else    {$M3_thermal_clas_color = "";   $M3_thermal_cell_color = "orange";}
                                                                            
                                                        if($_M_motor_4_monitor_measurements_parts[0] == "1") {$M4_start_clas_color = "blink_g";     $M4_start_cell_color = "white";}                                            else    {$M4_start_clas_color = "";     $M4_start_cell_color = "#d9d9d9";}
                                                        if($_M_motor_4_monitor_measurements_parts[1] == "1") {$M4_thermal_clas_color = "blink_r";   $M4_thermal_cell_color = "white";   $M4_start_clas_color = "blink_r";}      else    {$M4_thermal_clas_color = "";   $M4_thermal_cell_color = "orange";}
                                                                            
                            
                                                        if($result['pcb_synolo_antlion']=="1")
                                                                                                {
                                                                                                $M2_start_clas_color = "";              $M2_start_cell_color = "gray";
                                                                                                $M2_thermal_clas_color = "";            $M2_thermal_cell_color = "gray";
                                                                                                
                                                                                                $M3_start_clas_color = "";              $M3_start_cell_color = "gray";
                                                                                                $M3_thermal_clas_color = "";            $M3_thermal_cell_color = "gray";
                                                                                                
                                                                                                $M4_start_clas_color = "";              $M4_start_cell_color = "gray";
                                                                                                $M4_thermal_clas_color = "";            $M4_thermal_cell_color = "gray";
                                                                                                }
                                                        if($result['pcb_synolo_antlion']=="2")
                                                                                                {
                                                                                                $M3_start_clas_color = "";              $M3_start_cell_color = "gray";
                                                                                                $M3_thermal_clas_color = "";            $M3_thermal_cell_color = "gray";
                                                                                                
                                                                                                $M4_start_clas_color = "";              $M4_start_cell_color = "gray";
                                                                                                $M4_thermal_clas_color = "";            $M4_thermal_cell_color = "gray";   
                                                                                                }
                                                        if($result['pcb_synolo_antlion']=="3")
                                                                                                {
                                                                                                $M4_start_clas_color = "";              $M4_start_cell_color = "gray";
                                                                                                $M4_thermal_clas_color = "";            $M4_thermal_cell_color = "gray";
                                                                                                }
                                                        
                                                        
                                                        
                                                        if($offline_status==1)
                                                                                {
                                                                                $offline_clas_color                 = "blink_r";
                                                                                //$offline_cell_color                 = "rgba(170, 170, 170, 0.9);";
                                                                                $offline_cell_color                 = "rgba(255,255,255,0.6);";
                                                                                $offline_text                       = "Εκτός Δικτύου";
                                                                                }
                                                        else
                                                                                {
                                                                                $offline_clas_color                 = "";
                                                                                $offline_cell_color                 = "rgba(255,255,255,0.7);";
                                                                                $offline_text                       = "Siginal ".$pcb_cell_signal."%";
                                                                                }
                            
                            
                                                        if($pcb_status=='0')
                                                                                {
                                                                                //den einai eggatestimeno
                                                                                //$antliostasio_view_title        = "Μη Εγκατεστημένο";
                                                                                $antliostasio_view_title        = $pcb_name_viologikou."</br>Μη Εγκατεστημένο";
                                                                                
                                                                                $main_cell_color = "";//"rgba(180, 180, 180, 0.9);";
                                                                                
                                                                                $tank_clas_color_1 = "";
                                                                                $tank_cell_color_1 = "#cccccc";
                                                                                $tank_clas_color_2 = "";
                                                                                $tank_cell_color_2 = "#cccccc";
                                                                                $tank_clas_color_3 = "";
                                                                                $tank_cell_color_3 = "#cccccc";
                                                                                
                                                                                $ups_power_clas_color = "";
                                                                                $ups_power_cell_color = "gray";
                                                                                $ups_power_text   = "--";
                                                                                
                                                                                
                                                                                
                                                                                $ups_battery_clas_color = "";
                                                                                $ups_battery_cell_color = "gray";
                                                                                $ups_battery_text = "--";
                                                                                
                                                                                $L1_V_clas_color        = "";
                                                                                $L1_V_cell_color        = "gray";
                                                                                
                                                                                $L2_V_clas_color        = "";
                                                                                $L2_V_cell_color        = "gray";
                                                                                
                                                                                $L3_V_clas_color        = "";
                                                                                $L3_V_cell_color        = "gray";
                                                                                
                                                                                $L1_A_clas_color        = "";
                                                                                $L1_A_cell_color        = "gray";
                                                                                
                                                                                $L2_A_clas_color        = "";
                                                                                $L2_A_cell_color        = "gray";
                                                                                
                                                                                $L3_A_clas_color        = "";
                                                                                $L3_A_cell_color        = "gray";
                                                                                
                                                                                $M1_start_clas_color    = "";           $M1_thermal_clas_color  = "";
                                                                                $M1_start_cell_color    = "gray";       $M1_thermal_cell_color  = "gray";
                                                                                
                                                                                $M2_start_clas_color    = "";           $M2_thermal_clas_color  = "";
                                                                                $M2_start_cell_color    = "gray";       $M2_thermal_cell_color  = "gray";
                                                                                
                                                                                $M3_start_clas_color    = "";           $M3_thermal_clas_color  = "";
                                                                                $M3_start_cell_color    = "gray";       $M3_thermal_cell_color  = "gray";
                                                                                
                                                                                $M4_start_clas_color    = "";           $M4_thermal_clas_color  = "";
                                                                                $M4_start_cell_color    = "gray";       $M4_thermal_cell_color  = "gray";
                                                                                
                                                                                $offline_clas_color     = "";
                                                                                $operator_logo          = "<font color=\"#333333\" style=\"display:block; font-size:1vw;\">------------</font>";
                                                                                $offline_text           = "Μη Εγκατεστημένο";
                                                                                $date_time_last_status_diffrence    = " - - - - - - - - - - ";
                                                                                }
                                                        else
                                                        if($pcb_status=='1')
                                                                                {
                                                                                $main_cell_color = "rgba(255,255,255,0.7);";
                                                                                $antliostasio_view_title        = $pcb_name_viologikou;//."</br>".$pcb_serial;
                                                                                
                                                                                
                                                                                $operator_logo = "<img src=\"/images/vodafone_logo.png\" alt=\"Mountain View\" 	style=\"display:block; width:100%; height:100%;\">";
                                                                                }
                                                        
                                                        $title_font_size = "3.5vh";
                                                        echo "
                                                           
                                                            <tr class=\"\" style=\"background: {$main_cell_color}\">
                                                            <td bgcolor=\"\" width=\"\" colspan=\"1\" rowspan=\"1\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:{$title_font_size};\">Κατάσταση Δεξαμενών</font></center></td>
                                                            </tr>
                                                            
                                                            <tr class=\"\" style=\" background: {$main_cell_color}\">
                                                                <td colspan=\"1\" rowspan=\"1\">
                                                                    <center>
                                                                            <table border=\"0\" cellspacing=\"5\" cellpadding=\"0\" id=\"paroxi_deh_table\" style=\"display:block;  width:100%; height:auto;  \" >
                                                                                    <tr>
                                                                                        <td class=\"{$tank_clas_color_1}\"  bgcolor=\"{$tank_cell_color_1}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><img src=\"waste_tank_error.png\" alt=\"Mountain View\" 	style=\"display:block; width:60%; height:auto;\"></center></td>
                                                                                        <td class=\"{$tank_clas_color_2}\"  bgcolor=\"{$tank_cell_color_2}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><img src=\"waste_tank_error.png\" alt=\"Mountain View\" 	style=\"display:block; width:60%; height:auto;\"></center></td>
                                                                                        <td class=\"{$tank_clas_color_3}\"  bgcolor=\"{$tank_cell_color_3}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><img src=\"waste_tank_error.png\" alt=\"Mountain View\" 	style=\"display:block; width:60%; height:auto;\"></center></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class=\"{$tank_clas_color_1}\"  bgcolor=\"{$tank_cell_color_1}\" width=\"2%\" colspan=\"1\" rowspan=\"1\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.4vh;\">Δεξαμενη [1]</font></center></td>
                                                                                        <td class=\"{$tank_clas_color_2}\"  bgcolor=\"{$tank_cell_color_2}\" width=\"2%\" colspan=\"1\" rowspan=\"1\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.4vh;\">Δεξαμενη [2]</font></center></td>
                                                                                        <td class=\"{$tank_clas_color_3}\"  bgcolor=\"{$tank_cell_color_3}\" width=\"2%\" colspan=\"1\" rowspan=\"1\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.4vh;\">Δεξαμενη [3]</font></center></td>
                                                                                     </tr>
                                                                            </table>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            ";
                                                        echo "
                                                            <tr class=\"\" style=\" background: {$main_cell_color}\">
                                                            <td bgcolor=\"\" width=\"\" colspan=\"1\" rowspan=\"1\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:{$title_font_size};\">Κατάσταση UPS</font></center></td>
                                                            </tr>
                                                            
                                                            
                                                            <tr class=\"\"  style=\"background:#ffffff;\">
                                                                <td colspan=\"1\" rowspan=\"1\">
                                                                    <center>
                                                                            <table border=\"0\" bordercolor=\"red\" cellspacing=\"5\" cellpadding=\"0\" id=\"paroxi_deh_table\" style=\"display:block;  width:100%; height:auto;  \" >
                                                                                <tr>
                                                                                    <td class=\"{$ups_power_clas_color}\"       bgcolor=\"{$ups_power_cell_color}\"     width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"background: rgba(255,255,255,0.9);\"><center><img src=\"deh_logo_1.png\" alt=\"Mountain View\" 	style=\"display:block; width:30%; height:auto;\"></center></td>
                                                                                    <td class=\"{$ups_battery_clas_color}\"     bgcolor=\"{$ups_battery_cell_color}\"   width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"background: rgba(255,255,255,0.9);\"><center><img src=\"battery_1.png\"  alt=\"Mountain View\" 	style=\"display:block; width:30%; height:auto;\"></center></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class=\"{$ups_power_clas_color}\"       bgcolor=\"{$ups_power_cell_color}\"     width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"background: rgba(255,255,255,0.9);\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">Παροχή Ρέυματος</font></center></td>
                                                                                    <td class=\"{$ups_battery_clas_color}\"     bgcolor=\"{$ups_battery_cell_color}\"   width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"background: rgba(255,255,255,0.9);\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">Μπαταρία UPS</font></center></td>
                                                                                </tr>
                                                                                
                                                                                
                                                                            </table>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr class=\"\" style=\" background: {$main_cell_color}\">
                                                            <td bgcolor=\"\" width=\"\" colspan=\"1\" rowspan=\"1\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:{$title_font_size};\">Κατάσταση Παροχής</font></center></td>
                                                            </tr>
                                                            
                                                            <tr class=\"\" style=\"background: #ffffff;\">
                                                                <td colspan=\"1\" rowspan=\"1\">
                                                                <center>
                                                                            <table border=\"0\" cellspacing=\"8\" cellpadding=\"0\" id=\"paroxi_deh_table\" style=\"display:block;  width:100%; height:auto;  \" >
                                                                                    
                                                                                    <tr>
                                                                                        
                                                                                        <td class=\"\"  bgcolor=\"#99bbff\" width=\"2%\" colspan=\"3\" rowspan=\"1\" style=\"\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">VOLT</font></center></td>
                                                                                        <td class=\"\"  bgcolor=\"#ccb3ff\" width=\"2%\" colspan=\"3\" rowspan=\"1\" style=\"\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">AMPERE</font></center></td>
                                                                                    </tr>
                                                                                    
                                                                                    <tr>
                                                                                        
                                                                                        <td class=\"\"  bgcolor=\"#99bbff\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">L1</font></center></td>
                                                                                        <td class=\"\"  bgcolor=\"#99bbff\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">L2</font></center></td>
                                                                                        <td class=\"\"  bgcolor=\"#99bbff\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">L3</font></center></td>
                                                                                        
                                                                                        <td class=\"\"  bgcolor=\"#ccb3ff\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">L1</font></center></td>
                                                                                        <td class=\"\"  bgcolor=\"#ccb3ff\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">L2</font></center></td>
                                                                                        <td class=\"\"  bgcolor=\"#ccb3ff\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">L3</font></center></td>
                                                                                    </tr>
                                                                                    
                                                                                    <tr>
                                                                                        
                                                                                        <td class=\"{$L1_V_clas_color}\"   bgcolor=\"{$L1_V_cell_color}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" \"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">{$_0_main_power_monitor_measurements_parts[8]}V</font></center></td>
                                                                                        <td class=\"{$L2_V_clas_color}\"   bgcolor=\"{$L2_V_cell_color}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" \"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">{$_0_main_power_monitor_measurements_parts[9]}V</font></center></td>
                                                                                        <td class=\"{$L3_V_clas_color}\"   bgcolor=\"{$L3_V_cell_color}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" \"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">{$_0_main_power_monitor_measurements_parts[10]}V</font></center></td>
                                                                                        
                                                                                        <td class=\"{$L1_A_clas_color}\"   bgcolor=\"{$L1_A_cell_color}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" \"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">{$_0_main_power_monitor_measurements_parts[11]}A</font></center></td>
                                                                                        <td class=\"{$L2_A_clas_color}\"   bgcolor=\"{$L2_A_cell_color}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" \"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">{$_0_main_power_monitor_measurements_parts[12]}A</font></center></td>
                                                                                        <td class=\"{$L3_A_clas_color}\"   bgcolor=\"{$L3_A_cell_color}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" \"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">{$_0_main_power_monitor_measurements_parts[13]}A</font></center></td>    
                                                                                    </tr>
                                                                            </table>
                                                                    
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            
                                                           <tr class=\"\" style=\" background: {$main_cell_color}\">
                                                            <td bgcolor=\"\" width=\"\" colspan=\"1\" rowspan=\"1\"><center><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:{$title_font_size};\">Κατάσταση Αντλιων</font></center></td>
                                                            </tr>
                                                            
                                                            <tr class=\"\"  style=\"background:#ffffff;\">
                                                                <td colspan=\"1\" rowspan=\"1\">
                                                                    <center>
                                                                            <table border=\"0\" bordercolor=\"red\" cellspacing=\"5\" cellpadding=\"0\" id=\"paroxi_deh_table\" style=\"display:block;  width:100%; height:auto;  \" >
                                                                                <tr>
                                                                                    <td class=\"{$M1_start_clas_color}\" bgcolor=\"{$M1_start_cell_color}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><img src=\"/images/w_pump_1_black.png\" alt=\"Mountain View\" 	style=\"display:block; width:75%; height:auto;\"></center></td>
                                                                                    <td class=\"{$M2_start_clas_color}\" bgcolor=\"{$M2_start_cell_color}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><img src=\"/images/w_pump_1_black.png\" alt=\"Mountain View\" 	style=\"display:block; width:75%; height:auto;\"></center></td>
                                                                                    <td class=\"{$M3_start_clas_color}\" bgcolor=\"{$M3_start_cell_color}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><img src=\"/images/w_pump_1_black.png\" alt=\"Mountain View\" 	style=\"display:block; width:75%; height:auto;\"></center></td>
                                                                                    <td class=\"{$M4_start_clas_color}\" bgcolor=\"{$M4_start_cell_color}\" width=\"2%\" colspan=\"1\" rowspan=\"1\" style=\"\"><center><img src=\"/images/w_pump_1_black.png\" alt=\"Mountain View\" 	style=\"display:block; width:75%; height:auto;\"></center></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class=\"{$M1_thermal_clas_color}\"  bgcolor=\"{$M1_thermal_cell_color}\"    width=\"2%\" colspan=\"1\" rowspan=\"1\"><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">θερμικό</font></td>
                                                                                    <td class=\"{$M2_thermal_clas_color}\"  bgcolor=\"{$M2_thermal_cell_color}\"    width=\"2%\" colspan=\"1\" rowspan=\"1\"><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">θερμικό</font></td>
                                                                                    <td class=\"{$M3_thermal_clas_color}\"  bgcolor=\"{$M3_thermal_cell_color}\"    width=\"2%\" colspan=\"1\" rowspan=\"1\"><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">θερμικό</font></td>
                                                                                    <td class=\"{$M4_thermal_clas_color}\"  bgcolor=\"{$M4_thermal_cell_color}\"    width=\"2%\" colspan=\"1\" rowspan=\"1\"><font color=\"#333333\" align=\"center\" style=\"display:block; font-size:2.8vh;\">θερμικό</font></td>
                                                                                </tr>
                                                                            </table>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr class=\"\" height= \"20\" style=\"background:#ffffff;\">
                                                                <td colspan=\"1\" rowspan=\"1\" style=\" \"></td>
                                                            </tr>
                                                            ";
                                                        $u++;
                                                        }
                            echo "</table>";   
                            }
?>