 <!DOCTYPE html>
<html>
     <head>
               <meta http-equiv="refresh" content="10" />
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
						       Servers and Devices - Select the devices and enter the time <br>
						<b>Note:</b> If you select the devices and servers which are not responding then the graphs will not be generated.
					 </font>
				   </center>    
			    </td>
		     </tr>
		     <tr>
			    <td  style="background-color:#FFFF66;height:80px;width:1250px;">
				  <center>
					 <font face="arial" size="5">
						 <a href='index.php'>Home</a>       
					 </font>
				   </center>    
			    </td>
			    <td  style="background-color:#FFFF66;height:80px;width:1250px;">
				  <center>
					 <font face="arial" size="5">
						   <a href='monitoring.php'> Monitoring </a>     
					 </font>
				   </center>    
			    </td>
			    
		     </tr>
		     	                       <form action="monitoringconnect.php" method="POST">
		     <tr>
			  <td style="background-color:#EEEEEE;width:650px;;vertical-align:top;">
				   <center>
					  <?php
					     $path= dirname(__FILE__);
			$path=substr($path, 0, -11);
			$file="db.conf";
			$path=$path.$file;
			$k= explode("\n",file_get_contents($path));
			$hostname=substr($k[0],9,-2);
			$port=substr($k[1],9,-2);
			$database=substr($k[2],13,-2);
			$username=substr($k[3],13,-2);
			$password=substr($k[4],13,-2);
			#echo"$hostname\n$port\n$database\n$username\n$password\n";
                        
                        //connection to the database
                        $db = mysql_connect($hostname, $username, $password)
                         or die("Unable to connect to MySQL");
					     //select a database to work with
					     $s = mysql_select_db("$database",$db)
					       or die("Could not select $database");
					     echo"<font face='arial' size='5' align='center'>";
					     
					     echo" <br><b><u> Network Devices </u></b><br>";
					     
					     
					     $query2= mysql_query("SELECT *FROM assignment3_interfaces");
					     
					     //fetch results
						     
						    echo "<br><table border='1' align='center'>
							  <tr><td></td>
							      <td> IP </td>
							      <td> PORT </td>
							      <td> COMMUNITY </td>
							      <td> STATUS </td>
							 </tr>";
					     
					     $j=1;
					     while ($row= mysql_fetch_array($query2)):
					     {
						    $d="d".$j;
						    #echo"$d<br>";
						    $ID1=$row['ID'];
						    $STATUS= $row['STATUS'];
						    if ($STATUS=="Responding"){		
						    #echo"$ID1<br>";
						    echo "<tr><td>" ."&nbsp;<input type='checkbox' name='$d'  value='$ID1' >&nbsp;";}
						    else{echo"<tr><td>";}	
						    echo "</td><td>" .   $IP=$row['IP'] .
						    "</td><td>" . $PORT= $row['PORT'] .
						    "</td><td>" . $COMMUNITY= $row['COMMUNITY'].
						    "</td><td>" . $STATUS= $row['STATUS'];
					     $j++;
					     }
					     endwhile;
					     echo "</table></font><br><br><br>";
					     //close the connection
					     mysql_close($db);
					 ?>           
				       
							       <br>
				   <br>
				   </center>
			    </td>
			    <td style="background-color:#EEEEEE;width:650px;;vertical-align:top;">
				   <center>
					  <?php
					     $path= dirname(__FILE__);
			$path=substr($path, 0, -11);
			$file="db.conf";
			$path=$path.$file;
			$k= explode("\n",file_get_contents($path));
			$hostname=substr($k[0],9,-2);
			$port=substr($k[1],9,-2);
			$database=substr($k[2],13,-2);
			$username=substr($k[3],13,-2);
			$password=substr($k[4],13,-2);
			#echo"$hostname\n$port\n$database\n$username\n$password\n";
                        
                        //connection to the database
                        $db = mysql_connect($hostname, $username, $password)
                         or die("Unable to connect to MySQL");
					     //select a database to work with
					     $s = mysql_select_db("$database",$db)
					       or die("Could not select $database");
					     echo"<font face='arial' size='5' align='center'>";
					     
					    echo" <br><b><u> Servers </u></b><br>";
					   
					     
					     $query2= mysql_query("SELECT *FROM assignment3_server");
					     
					     //fetch results
						     
						    echo "<br><table border='1' align='center'>
							  <tr><td>  </td>
							      <td> NAME </td>
							      <td> IP </td>
							      <td> PORT </td>
							      <td> COMMUNITY </td>
							      <td> STATUS </td>
							      
							 </tr>";
					     #echo"<input type='checkbox' name='s$j'  value='$ID2' >";
					     $j=1;
					     while ($row= mysql_fetch_array($query2)):
					     {
						    
						    $ID2=$row['ID'];
						    $s="s".$j;
						     $STATUS=$row['STATUS'];
                                                    if ($STATUS == ""){$STATUS="Not Responding";}
	                                            if($STATUS=="Not Responding"){
							echo"<tr><td>";}
						    else{echo "<tr><td>" . "&nbsp;<input type='checkbox' name='$s'  value='$ID2' 								>&nbsp;";}							

						    echo "</td><td>" . $NAME= $row['NAME'] .
						    "</td><td>" . $IP=$row['IP'] . 
						    "</td><td>" . $PORT= $row['PORT'] .
						    "</td><td>" . $COMMUNITY= $row['COMMUNITY'].
						    "</td><td>" . $STATUS.
						    "</tr>";
					     $j++;
					     }
					     endwhile;
					     echo "</table></font><br><br><br>";
					     //close the connection
					   
					     mysql_close($db);
					 ?>           
				      
							       <br>
				   <br>
				   </center>
			    </td>
			    
			    </tr>
		     <tr><td colspan="2" style="background-color:#FFFF66;">
		     <?php
		       echo "<br><table border='2' align='center'>";
					      echo"<tr><td colspan='2' style='background-color:#EEEEEE;'><center>Enter the time span for the graphs</center></td></tr>";
					     echo"<tr><td align='center' style='background-color:#EEEEEE;'>START TIME</td><td align='center' style='background-color:#EEEEEE;'>END TIME</td></tr>";
					     echo"<tr><td style='background-color:#EEEEEE;'><input type='tinytext' name='start' aria-describedby='number-format' required aria-required='true'></td>";
					     echo"<td style='background-color:#EEEEEE;'><input type='tinytext' name='end' aria-describedby='number-format' required aria-required='true'></td></tr>";
					     echo"<tr><td colspan='2' align='center' style='background-color:#EEEEEE;'><input type='submit' name='formsubmit' value='View Graphs'></td></tr>";
					        echo "</table></font>";
						echo"<center>Enter the start and end time in the following format: '<b>-(number)(timescale)</b>'.
	     Number is a integer greater than zero.
	     For timescale use <b>y</b>(years),<b>m</b>(month),<b>h</b>(hours), <b>s</b>(seconds), <b>now</b>(present time). Ex: <b>-1h</b>(for one hour)
	       </center><br>";
		     
		     
		    ?></tr></td>
			     
		     
		     <tr>
			    <td colspan="2" style="background-color:#FF6666;text-align:center;">
				   vekb15@student.bth.se
			    </td>
		     </tr>
	      </table>
       </body>
</html>

