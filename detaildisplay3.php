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
                        $host=$hostname.":".$port;
                        $db = mysql_connect($host, $username, $password)
                         or die("Unable to connect to MySQL");
                        
                        //select a database to work with
                        $s = mysql_select_db("$database",$db)
                          or die("Could not select $database");
					    echo"<font face='arial' size='5' align='left'>";
                        
                        
                        
                        $ID=$_GET['id'];
                        
                        $query2= mysql_query("SELECT *FROM assignment3_interfaces where ID='$ID'");
                        
                        echo"<br><br>The detailed information of the device is as follows:<br><br>";
                        //fetch results
                                
                               
                        
                        $j=1;
                        while ($row= mysql_fetch_array($query2)):
                        {
                               $IP=$row['IP'];
			       $COMMUNITY= $row['COMMUNITY'];
                               echo "<table border='1' align='center'>";
                               echo "<tr><td> S.No </td><td>IP </td><td>Port </td><td>Community </td></tr>" ;
			       echo "<tr><td>". $j ."</td><td>". $IP ."</td><td>". $PORT= $row['PORT'] ."</td><td>". $COMMUNITY."</td></tr>";                                
                               
				$noi=$row['UNAME']; 
                               
                        $j++;
                        }
                        endwhile;
			echo "</table>";
			
			$keywords = explode('-', $noi);
			$size=  sizeof($keywords);
			$size--;
			
			echo"<br>Total number of interfaces for the device selected for probing is:<b> ".$size." </b>";
			echo"<br>The interface list is given below. Click on the interface name to view individual graphs<br><br>";
			$token = strtok($string, "-");
                          
			  $k=1;
			  echo "<table border='1' align='center'>";
			  echo"<tr><td> S.no</td><td> Interface Name </td></tr>";
                                
				while ($k <= $size)
                                    {
				
					$m=$keywords[$k];
					
					echo "<tr><td>&nbsp;&nbsp;".$k."</td><td><a href='graph3.php?i=$k&k=$ID&ip=$IP&community=$COMMUNITY&iname=$m'>".$keywords[$k]."</a></td></tr>";
                                       $k++;
				    }
                          echo"</table></font>";
                        echo"<br><br>";
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
