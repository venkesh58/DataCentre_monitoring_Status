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
						       Servers Under Monitoring
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
					     echo"<font face='arial' size='5' align='center'>";
					     
					     echo" <br>The server status of the following  devices is being collected:<br>";
					     echo"<br>Click on the Name for detailed status of the device<br>";
					     
					     $query2= mysql_query("SELECT *FROM assignment3_server");
					     
					     //fetch results
						     
						    echo "<br><table border='1' align='center'>
							  <tr><td> S.No </td>
							      <td> NAME </td>
							      <td> IP </td>
							      <td> PORT </td>
							      <td> COMMUNITY </td>
                                                              <td> STATUS </td> 
							     
							      
							 </tr>";
					     
					     $j=1;
					     while ($row= mysql_fetch_array($query2)):
					     {
						    
						    $ID=$row['ID'];
						    $STATUS=$row['STATUS'];
                                                    if ($STATUS == ""){$STATUS="Not Responding";}
						    echo "<tr><td>" . $j .
						    "</td><td>" ."<a href='detaildisplay3_server.php?id=$ID'>". $NAME= $row['NAME'] ."</a>".
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
		     <tr>
			    <td colspan="2" style="background-color:#FF6666;text-align:center;">
				   vekb15@student.bth.se
			    </td>
		     </tr>
	      </table>
       </body>
</html>

