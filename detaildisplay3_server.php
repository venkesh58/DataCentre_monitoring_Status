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
                        
                        $query2= mysql_query("SELECT *FROM assignment3_server where id='$ID'");
                        
                        echo"<h3><br><br>The detailed information of the server is as follows:<br>
			Click on the IP to view the graphs<br></h3>";
                        //fetch results
						    echo "<br><table border='1' align='center'>";
					     
					     $j=1;
					     while ($row= mysql_fetch_array($query2)):
					     {
						    
						    $ID=$row['ID'];
						    $NAME=$row['NAME'];
						
						    $IP=$row['IP'];
						    $PORT= $row['PORT'];
						     $COMMUNITY= $row['COMMUNITY'];
						     $BYTES= $row['BYTES'];
						    $REQUESTS= $row['REQUESTS'];
						    $BR= $row['BYTESREQUESTS'];
						   $CPU= $row['CPU'];
						    $STATUS=$row['STATUS'];
                                                    if ($STATUS == ""){$STATUS="Not Responding";}
						    echo "<tr><td>". "NAME"."</td><td>" . $NAME.
						    "</td></tr><tr><td>IP" ."</td><td>".$IP . 
						    "</td></tr><tr><td>PORT" ."</td><td>". $PORT .
						    "</td></tr><tr><td>COMMUNITY" ."</td><td>". $COMMUNITY.
						    "</td></tr><tr><td>BYTES/SEC"."</td><td>" . $BYTES.
						    "</td></tr><tr><td>REQUEST/SEC" ."</td><td>". $REQUESTS.
						    "</td></tr><tr><td>BYTES/REQUEST" ."</td><td>". $BR.
						    "</td></tr><tr><td>CPU LOAD (%)" ."</td><td>". $CPU.
						    "</td></tr><tr><td>STATUS" ."</td><td>". $STATUS.	
						    "</td></tr>";
					     $j++;
					     }
					     endwhile;
					     echo"<form action='graph3_server.php?ip=$IP&name=$NAME&community=$COMMUNITY&id=$ID' method='POST'>";
					     echo"<tr><td colspan='2'><center>Enter the time span for the graphs</center></td></tr>";
					     echo"<tr><td>START TIME</td><td>END TIME</td></tr>";
					     echo"<tr><td><input type='tinytext' name='start' aria-describedby='number-format' required aria-required='true'></td>";
					     echo"<td><input type='tinytext' name='end' aria-describedby='number-format' required aria-required='true'></td></tr>";
					     echo"<tr><td colspan='2' align='center'><input type='submit' name='formsubmit' value='View Graphs'></td></tr>";
					  
					     
	    
					        echo "</table></font><br>";
						echo"Enter the start and end time in the following format: '<b>-(number)(timescale)</b>'.
	     Number is a integer greater than zero.
	     For timescale use <b>y</b>(years),<b>m</b>(month),<b>h</b>(hours), <b>s</b>(seconds), <b>now</b>(present time). Ex: <b>-1h</b>(for one hour)
	       ";
					    
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

