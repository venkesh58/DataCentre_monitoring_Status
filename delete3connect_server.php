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
						       Deletion of the Server
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
                        
                    
                    $ID=$_GET['id'];
                    
                    $query = mysql_query("SELECT *FROM assignment3_server WHERE ID='$ID'");
		    $i=1;
                                    while ($rows= mysql_fetch_array($query)):
                                    {
					$IP=$rows['IP'];
					$COMMUNITY=$rows['COMMUNITY'];
					$NAME=$rows['NAME'];
                                    }
                                    endwhile;
                    
		    $myFile="server-".$COMMUNITY."-".$NAME.".rrd";
		    unlink($myFile);
                    
                    $sql="DELETE FROM assignment3_server WHERE ID='$ID'";
                    
                    //query
                    if (!mysql_query($sql) )
                    {
                        die('Error: ' . mysql_error() );
                    }
                    else
                    {
                    echo "<br><br><br><h2> Your server data is deleted !</h2><br><br>";
                    }
                    
                    echo"<a href='display3_server.php'><h2> Click here to view the devices which are being monitored </h2> </a>";
                    
                    //close the connection
                    mysql_close($db);
                ?>   
                                        
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
