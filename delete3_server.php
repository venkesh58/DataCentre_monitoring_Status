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
						       Deletion of a Server
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
						   &nbsp;&nbsp;&nbsp;<a href="add3_server.php">Add a Server</a><br><br>
						   &nbsp;&nbsp;&nbsp;<a href="delete3_server.php">Delete a Server</a><br><br>
						   &nbsp;&nbsp;&nbsp;<a href="display3_server.php">Display Metrics</a><br><br>
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
                                    
                                    echo "<br><br><h2>Click on the Device IP to delete it</h2><br> \n";
                                    
                                    //select a database to work with
                                    $s = mysql_select_db("$database",$db)
                                      or die("Could not select $database");
                                    
                                    //show the devices present in the database
                                    
				    echo"<font face='arial' size='5'>";
				    
                                    $query = mysql_query("SELECT *FROM assignment3_server");
                                    
                                    //fetch results
                                            
                                           echo "<table border='1'>
                                                 <tr><td> S.NO
                                                 </td><td> NAME
						 </td><td> IP
                                                 </td> <td> PORT
                                                 </td> <td> COMMUNITY
						 
                                                 </td></tr>";                        
                                    $i=1;
                                    while ($rows= mysql_fetch_array($query)):
                                    { $ID=$rows['ID'];
                                           echo "<tr><td>" . $i .
					        "</td><td>" . $rows ['NAME'] .
                                                "</td><td>" . "<a href='delete3connect_server.php?id=$ID'>" .$rows['IP'] . "</a>" .
                                                "</td><td>" . $rows ['PORT'] .
                                                "</td><td>" . $rows['COMMUNITY']  .
						
                                                "</td></tr>";
                                    $i++;
                                    }
                                    endwhile;
                                    echo "</table></font><br>";
                                    
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

