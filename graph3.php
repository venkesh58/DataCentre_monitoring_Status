<!DOCTYPE html>
<html>
     <head>
               <meta http-equiv="refresh" content="60" />
    </head> 
       
     <body bgcolor="#666699">
	      <table style="width:1250px;" cellpadding="0" cellspacing="0">
		     <tr>
			    <td colspan="2" style="background-color:#FF6666;height:40px;">
	      			    <font face="Arial" size="6">
					  <center>
						 Data monitoring Status
					  </center>
				    </font>
			    </td>
		     </tr>
		     <tr>
			    <td colspan="2" style="background-color:#CCCCCC;height:80px;width:1250px;">
				  <center>
					 <font face="arial" size="5">
						       Devices Page
					 </font>
				   </center>    
			    </td>
		     </tr>
		     	   
		     <tr>
			    <td style="background-color:#FFFF66;width:200px;vertical-align:top;">
				   <div id="nav">
					  <font face="arial" size="5">
					  	  <br><br><br>
					  	   &nbsp;&nbsp;&nbsp;<a href="index.php">Home</a><br><br>
					  	   &nbsp;&nbsp;&nbsp;<a href="add3.php">Add a Device</a><br><br>
					  	   &nbsp;&nbsp;&nbsp;<a href="delete3.php">Delete a Device</a><br><br>
					  	   &nbsp;&nbsp;&nbsp;<a href="display3.php">Display Devices</a><br><br>
					  </font>	
				   </div>
			    </td>
			    <td style="background-color:#EEEEEE;height:550px;width:1050px;;vertical-align:top;">
				   <center>
					  <?php
					  
					     
					    $ID=$_GET['k'];
					     $ip=$_GET['ip'];
					     $iname=$_GET['iname'];
					     $community=$_GET['community'];
					     $dsno=$_GET['i'];
					     $start=$_POST['start'];
					     $end=$_POST['end'];
					     if($start == "")
					     {
						  $start='-1h';
					     }
					     if($end == "")
					     {
						  $end='now';
					     }
					     
					#echo"$ID-$dsno-$start-$end";
					     
					     echo"<br><br><b>The Device information is as follows:</b> <br><br>";
                          echo "<table border='1' align='center'>";
			  echo "<tr><td>&nbsp;IP&nbsp;</td><td>&nbsp;Community&nbsp;</td><td>&nbsp;Interface Name&nbsp;</td></tr>";
			 echo "<tr><td>&nbsp;$ip&nbsp;</td><td>&nbsp;$community&nbsp;</td><td>&nbsp;$iname&nbsp;</td></tr></table>";
			  #echo"<a href='generator3.php?id=$ID&community=$community&iname=$iname&dsno=$dsno&start=$start&end=$end'>Click Here</a>";
			  
			   echo"<form action='graph3.php?i=$dsno&k=$ID&ip=$ip&community=$community&iname=$iname' method='POST'>";
                           echo"<br> To change the graph time span enter the Start time and End time.<br><br><b>The Graph for the interface is as follows:</b><br>";
					     echo "<table border='2' colspan='2' style='background-color:#FFCCCC;'>";
					     echo "<tr><td colspan='2'>";
					     echo "<img src='generator3.php?id=$ID&community=$community&iname=$iname&dsno=$dsno&start=$start&end=$end' alt='Generated RRD image'>";
					     echo "</td></tr><br><tr align='center'><td>Start Time</td><td>End time</td</tr>
						      <tr align='center'><td><input type='tinytext' name='start' aria-describedby='number-format' required aria-required='true'>
						      </td><td><input type='tinytext' name='end' aria-describedby='number-format' required aria-required='true'></td</tr>
						      <tr align='center'><td colspan='2' align='center'><input type='submit' name='formsubmit' value='View Graph'></td></tr></table>";
					     
					     echo"<br>Enter the start and end time in the following format: '<b>-(number)(timescale)</b>'.
	     Number is a integer greater than zero.
	     For timescale use <b>y</b>(years),<b>m</b>(month),<b>h</b>(hours), <b>s</b>(seconds), <b>now</b>(present time). Ex: <b>-1h</b>(for one hour)
	       ";
					 ?>           
				       
							       <br>
				   <br>
				   </center>
			    </td>
			    </tr>
		     <tr>
			    <td colspan="2" style="background-color:#FF6666;text-align:center;">
				   vekb15@student.bth.se
			    </td>
		     </tr>
	      </table>
       </body>
</html>

