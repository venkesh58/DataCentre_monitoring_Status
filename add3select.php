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
                             
                             $query3= mysql_query("SELECT * FROM assignment3_interfaces WHERE ISTATUS='SELECTION'");
                             while ($row= mysql_fetch_array($query3)):
                             {
                               $ip=$row['IP'];
                               $community=$row['COMMUNITY'];
                               $port=$row['PORT'];
                               $size=$row['SIZE'];
                               $interfaces=$row['INAME'];
                               $iorder=$row['IORDER'];
                             }
                        endwhile;
                        #echo"size=$size";
                        echo"<br><br><h3>The Detailed information of the device you wish to add is as follows:<br><br>";
                        echo "<table border='1' align='center'>";
                               echo "<tr><td>IP </td><td>Port </td><td>Community </td></tr>" ;
                               echo "<tr><td>$ip </td><td>$port </td><td>$community </td></tr>" ;
                               echo"</table>";
                        echo"<br><br>Select the interfaces you want to monitor:</h3><br>";
                             $keywords = explode('-', $interfaces);
                             $keywords2= explode('-', $iorder);
                             echo"<form action='add3final.php' method='POST'>";
                             echo "<table border='1' align='center'>";
                                $j=1;
                              
                                     while($j <= $size)
                                        {
                                            echo "<tr><td>&nbsp; $j &nbsp; </td><td><input type='checkbox' name='$j' value='$keywords[$j]'></td><td> &nbsp; $keywords[$j]&nbsp;  </td></tr>";$j++;    
                                        }
                                
                             echo "<tr><td colspan=3 align='center'><input type='submit' name='formsubmit' value='ADD'></td></tr>";
                             echo"</table>";
                             #echo"$i";  
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

