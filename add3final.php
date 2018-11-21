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
                               $id=$row['ID'];
                               $ip=$row['IP'];
                               $community=$row['COMMUNITY'];
                               $PORT=$row['PORT'];
                               $size=$row['SIZE'];
                               $interfaces=$row['INAME'];
                               $iorder=$row['IORDER'];
                             }
                             endwhile;
                             $a=$_POST['1'];
                             #echo"$a\n";
                             $set="start";
                             $no="0";
                             #echo"$size<br>";
                             $k=1;
                             $j=0;
                             $keywords = explode('-', $interfaces);
                             $keywords2 = explode('-', $iorder);
                             
                             while($k <= $size)
                             {
                               $interfaces=$_POST[$k];
                               #echo"$interfaces-";
                               #echo"$keywords[$k] -";
                                                if($keywords[$k] == $interfaces)
                                                {
                                                   $set=$set."-".$keywords[$k];
                                                   $j++;
                                                   $no=$no."-".$keywords2[$k];
                                                }
                               #echo"$k<br>";
                              $k++;                  
                             }
                             #echo"$set<br>";
                            
                            $query4=mysql_query("UPDATE assignment3_interfaces SET UNAME='$set', UORDER='$no', ISTATUS='SELECTED', USIZE='$j' WHERE ID='$id'"); 
                           
                           echo"<h3><br><br> Your Device has been successfully added to the database.<br><br>";
                           echo"The Device information is as follows:<br><br>";
                           echo "<table border='1' align='center'>";
                               echo "<tr><td>&nbsp; IP address &nbsp; </td><td>&nbsp;". $ip."&nbsp;</td></tr>";
                               echo "<tr><td>&nbsp; Community&nbsp; </td><td>&nbsp;". $community."&nbsp;</td></tr>";
                               echo "<tr><td>&nbsp; Port&nbsp; </td><td>&nbsp;". $PORT."&nbsp;</td></tr>";
                               echo "</table>";
                           
                           echo"<br>The interfaces selected for monitoring are as follows:<br><br>";
                           echo "<table border='1' align='center'>";
                           $uinterfaces=explode('-', $set);
                           $i=1;
                           while($i <= $j)
                           {
                            echo"<tr><td>&nbsp;". $i ."&nbsp;</td><td>&nbsp;".$uinterfaces[$i]."&nbsp;</td></tr>";
                            $i++;
                           }
                           echo"</table>";
                           echo"<br><a href='add3.php'>Click here to add more devices </h3><br><br>";
                           
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

