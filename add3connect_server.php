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
						       Servers - Status of the credentials entered
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
                        
                        
                        //select a database to work with
                        $s = mysql_select_db("$database",$db)
                          or die("Could not select $database");
                        
                        //entering data in database
                        echo"<br><br><br><br>";
                        $COMMUNITY=$_POST["COMMUNITY"];
                        $IP=$_POST["IP"];
                        $PORT=$_POST["PORT"];
                        $NAME=$_POST["NAME"];
			
			
                        #echo"$CPU-$BYTES-$REQUESTS-$BYTESREQUESTS<br>";
                        //creating table for assignment3 if not exists
                         $sql="CREATE TABLE IF NOT EXISTS assignment3_server(
                                                        `ID` int(30) NOT NULL AUTO_INCREMENT,
                                                        `NAME` varchar(30) NOT NULL,
                                                        `IP` tinytext NOT NULL,
                                                        `PORT` int(30) NOT NULL,
                                                        `COMMUNITY` varchar(30) NOT NULL,
							`STATUS` varchar (30) NOT NULL,
							`CPU` varchar(30) NOT NULL,
                                                        `BYTES` varchar(30) NOT NULL,
                                                        `REQUESTS` varchar(30) NOT NULL,
                                                        `BYTESREQUESTS` varchar(30) NOT NULL,
                                                         PRIMARY KEY (`ID`)
                                                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1" ;

		
                        if (mysql_query($sql))
                            {
                                 #echo "Table assignment3_server created successfully \n";
                            }
                        else
                            {
                                echo "Error creating table: " . mysqli_error($con) ."\n";
                            }
                        
			//checking for SNMP response
			
			
			
			    //query to check if server with same community and ip exists
			    $query2= mysql_query("SELECT *FROM assignment3_server");
			      
			      while ($row= mysql_fetch_array($query2)):
			    {
				   
				   if ($NAME==$row['NAME'] || $IP==$row['IP'] && $COMMUNITY==$row['COMMUNITY'])
				   {
				    echo "<br><br><br><br>";
				    echo "<h3><br><br>Server with same NAME or the same IP and COMMUNITY Exists<br><br>Check the Available Devices and add again</h3>";
				    $i=1;
				   }
			       
			    
			    }
			    endwhile;
			    mysql_close($db);
			
			    
			    if($i==1)
				{
				echo"<h3>"."<a href='add3_server.php'>"."Click here to add a new device"."</a><br><br>";
			    
				echo"<a href='display3_server.php'>". "Click here to view the information of the devices" ."</a>"."</h3>";
			    
				} 
		    	    else
				{
				   $db = mysql_connect($hostname, $username, $password)
				    or die("Unable to connect to MySQL");
			    
				    //select a database to work with
				    $s = mysql_select_db("$database",$db)
				      or die("Could not select $database");
				    		$sql= "INSERT INTO assignment3_server (NAME,IP,PORT,COMMUNITY) VALUES ('$NAME','$IP','$PORT','$COMMUNITY')" ;
						    //query
						    if (!mysql_query($sql) )
							{
							    die('Error: ' . mysql_error() );
							}
				    echo"<h3>"."<br><br>Your new Device data has been sucessfully added to the database<br><br>";
				    echo"<a href='display3_server.php'>". "Click here to view the status of the devices" ."</a>"."</h3>";
				
				    //close the connection
				    mysql_close($db);	
				    
				}
			  
		    ?>
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
