<!DOCTYPE html>
<html>
    <body bgcolor="#666699">
           
        <div id="container" style="width:1250px">
                
            <div id="header" style="background-color:#FF6666;height:40px; " >
                
                    <font face="Arial" size="6">
                        <center>
                            Data monitoring Status
                        </center>
                    </font>
                    
            </div>
                
            <div id="tab" style="background-color:#CCCCCC;height:80px;width:1250px;float:left;">
                <center>
                    <font face="arial" size="5">
                        <br>
                        Devices Page
                    </font>
                </center>    
            </div>
            
      <div id="menu" style="background-color:#FFFF66;height:550px;width:200px;float:left;">   
                
                    <font face="arial" size="5">
                        <br><br><br>
                        &nbsp;&nbsp;&nbsp;<a href="index.php">Home</a><br><br>
                        &nbsp;&nbsp;&nbsp;<a href="add3.php">Add a Device</a><br><br>
                        &nbsp;&nbsp;&nbsp;<a href="delete3.php">Delete a Device</a><br><br>
                        &nbsp;&nbsp;&nbsp;<a href="display3.php">Display Devices</a><br><br>                        
                    </font>    
                    
            </div>
                
          <div id="content" style="background-color:#EEEEEE;height:550px;width:1050px;float:left;">
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
					     echo"<font face='arial' size='5' align='center'>";
					      echo"<br><br>Click on the IP address of a device for more details <br>";
					     echo" <br>The devices under monitoring are as follows:";
					     
					     
					     $query2= mysql_query("SELECT *FROM assignment3_interfaces");
					     
					     //fetch results
						     
						    echo "<br><table border='1' align='center'>
							  <tr><td> S.No </td>
							      <td> IP </td>
							      <td> PORT </td>
							      <td> COMMUNITY </td>
							      <td> STATUS </td>
							 </tr>";
					     
					     $j=1;
					     while ($row= mysql_fetch_array($query2)):
					     {
						    
						    $ID=$row['ID'];
						    echo "<tr><td>" . $j .
						    "</td><td>" . "<a href='detaildisplay3.php?id=$ID'>" .  $IP=$row['IP'] . "</a>" .
						    "</td><td>" . $PORT= $row['PORT'] .
						    "</td><td>" . $COMMUNITY= $row['COMMUNITY'].
						    "</td><td>" . $COMMUNITY= $row['STATUS'];
					     $j++;
					     }
					     endwhile;
					     echo "</table></font><br><br><br>";
					     //close the connection
					     mysql_close($db);
					 ?>           
				       
				   <br>   
            </center>   
            </div>
                
            <div id="footer" style="background-color:#FF6666;clear:both;text-align:center;">
                vekb15@student.bth.se
            </div>
        </div>
    </body>
</html>
