 <!DOCTYPE html>
<html>       
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
						       Server Status
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
						   &nbsp;&nbsp;&nbsp;<a href="add3_server.php">Add a Device</a><br><br>
						   &nbsp;&nbsp;&nbsp;<a href="delete3_server.php">Delete a Device</a><br><br>
						   &nbsp;&nbsp;&nbsp;<a href="display3_server.php">Display Devices</a><br><br> 
					  </font>	
				   </div>
			    </td>
			    <td style="background-color:#EEEEEE;height:550px;width:1050px;;vertical-align:top;">
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
                        
                        
                        echo"<font face='arial' size='5' align='left'>";
                        
                        
                        
                        $ID=$_GET['id'];
			 $ip=$_GET['ip'];
			 $name=$_GET['name'];
			 $community=$_GET['community'];
			 $start=$_POST['start'];
			 $end=$_POST['end'];
			 
			 echo"<br><br>The Device information is as follows: <br><br>";
                         echo "<table border='1' align='center'>";
			 echo "<tr><td>&nbsp;IP&nbsp;</td><td>&nbsp;Community&nbsp;</td><td>&nbsp;Name&nbsp;</td></tr>";
			 echo "<tr><td>&nbsp;$ip&nbsp;</td><td>&nbsp;$community&nbsp;</td><td>&nbsp;$name&nbsp;</td></tr></table>";
	                 
			 
			 
			 #echo"<a href='generate3_server.php?id=$ID&community=$community&name=$name&type=2'> Click Here </a><br>";
			  #echo "<img src='generate3_server.php?id=$ID&community=$community&name=$name&type=2' alt='Generated RRD image'>";
			  
                           echo"<br>The Graphs for the Server are as follows:<br>";
					     echo "<table>";
					     echo "<td><tr><br>";
					     echo "<img src='generate3_server.php?id=$ID&community=$community&name=$name&type=1&start=$start&end=$end' alt='Generated RRD image'>";
					     echo "</tr><tr><br>";
					     echo "<img src='generate3_server.php?id=$ID&community=$community&name=$name&type=2&start=$start&end=$end' alt='Generated RRD image'>";
					     echo "</tr><tr><br>";
					     echo "<img src='generate3_server.php?id=$ID&community=$community&name=$name&type=3&start=$start&end=$end' alt='Generated RRD image'>";
					     echo "</tr><tr><br>";
					     echo "<img src='generate3_server.php?id=$ID&community=$community&name=$name&type=4&start=$start&end=$end' alt='Generated RRD image'>";
					     echo "</tr></td>";
					     echo "</table>";
					     
					     
					    
                        //close the connection
                        mysql_close($db);
                    ?> 		       <br>
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

