 <!DOCTYPE html>
<html>

       
     <body bgcolor="#666699">
	      <table style="width:1250px;" cellpadding="0" cellspacing="0">
		     <tr>
			    <td colspan="2" style="background-color:#FF6666;height:40px;">
	      			    <font face="Arial" size="6">
					  <center>
						 Applied Network Management Lab Assignments-2
					  </center>
				    </font>
			    </td>
		     </tr>
		     <tr>
			    <td colspan="2" style="background-color:#CCCCCC;height:80px;width:1250px;">
				  <center>
					 <font face="arial" size="5">
						       Selected Servers and Devices 
					 </font>
				   </center>    
			    </td>
		     </tr>
		     <tr>
			    <td  style="background-color:#FFFF66;height:80px;width:1250px;">
				  <center>
					 <font face="arial" size="5">
						 <a href='index.php'>Home</a>       
					 </font>
				   </center>    
			    </td>
			    <td  style="background-color:#FFFF66;height:80px;width:1250px;">
				  <center>
					 <font face="arial" size="5">
						   <a href='monitoring.php'> Monitoring </a>     
					 </font>
				   </center>    
			    </td>
			    
		     </tr>
		     	                       <form action="montoringconnect.php" method="POST">
		     <tr>
			  <td style="background-color:#EEEEEE;width:650px;;vertical-align:top;">
				   <center>
					  <?php
					  $start=$_POST['start'];
					  $end=$_POST['end'];
					  
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
					     
					     echo" <br><b><u> Network Devices </u></b><br>";
					     $j=1;
					     echo"<br><br>The Selected Devices information is as follows: <br><br>";
                         echo "<table border='1' align='center'>";
			 echo "<tr><td>&nbsp;IP&nbsp;</td><td>&nbsp;Community&nbsp;</td></tr>";
					     $query2= mysql_query("SELECT *FROM assignment3_interfaces");
					      while ($row= mysql_fetch_array($query2)):
					     {
						    $d="d".$j;
						    #echo"$d=";
						    $d1=$_POST[$d];
						    #echo"$d1<br>";
						    $ID1=$row['ID'];
						    #echo"$ID1\n";
						    $IP=$row['IP'];
						    $PORT= $row['PORT'];
						    $COMMUNITY= $row['COMMUNITY'];
						    $UNAME=$row['UNAME'];
						    $USIZE=$row['USIZE'];
						    if($d1 == $ID1)
						    {
						       
						        
			 
			 echo "<tr><td>&nbsp;$IP&nbsp;</td><td>&nbsp;$COMMUNITY&nbsp;</td></tr>";
					     
					     
						       
						       #echo"<a href='generate3_interfaces.php?id=$ID1&community=$COMMUNITY&uname=$UNAME&usize=$USIZE&start=$start&end=$end'>Click Here</a>";
						    }
					     $j++;
					     }	     
					     endwhile;
					     echo "</table>";
					     echo"<br>The Graphs of the interfaces of the devices are as follows:<br>";
					     echo "<table>";
					     $j=1;
					     $query3= mysql_query("SELECT *FROM assignment3_interfaces");
					      while ($row= mysql_fetch_array($query3)):
					     {
						    $d="d".$j;
						    #echo"$d=";
						    $d1=$_POST[$d];
						    #echo"$d1<br>";
						    $ID1=$row['ID'];
						    #echo"$ID1\n";
						    $IP=$row['IP'];
						    $PORT= $row['PORT'];
						    $COMMUNITY= $row['COMMUNITY'];
						    $UNAME=$row['UNAME'];
						    $USIZE=$row['USIZE'];
						    if($d1 == $ID1)
						    {
						       
						        
					     
					     echo "<td><tr><br>";
					     echo "<img src='generate3_interfaces.php?id=$ID1&community=$COMMUNITY&uname=$UNAME&usize=$USIZE&start=$start&end=$end' alt='Generated RRD image'>";
					     echo "</tr></td>";
						       
						       #echo"<a href='generate3_interfaces.php?id=$ID1&community=$COMMUNITY&uname=$UNAME&usize=$USIZE&start=$start&end=$end'>Click Here</a>";
						    }
					     $j++;
					     }	     
					     endwhile;
					     echo"</table><br>";
					     //fetch results

					     //close the connection
					     mysql_close($db);
					 ?>           
				       
							       <br>
				   <br>
				   </center>
			    </td>
			    <td style="background-color:#EEEEEE;width:650px;;vertical-align:top;">
				   <center>
					  <?php
					   $start=$_POST['start'];
					  $end=$_POST['end'];
					  #echo"$start-$end<br>";
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
					     
					    echo" <br><b><u> Servers </u></b><br>";
					    
					     $FID='start';
					     $FCOMMUNITY='start';
					     $fname='start';
					     $query2= mysql_query("SELECT *FROM assignment3_server");
					     
					     //fetch results
						     echo"<br><br>The selected Servers information is as follows: <br><br>";
                         echo "<table border='1' align='center'>";
			 echo "<tr><td>&nbsp;IP&nbsp;</td><td>&nbsp;Community&nbsp;</td><td>&nbsp;Name&nbsp;</td></tr>";
						
					     $m=0;
					     $j=1;
					     while ($row= mysql_fetch_array($query2)):
					     {
						    $s="s".$j;
						    #echo"$s<br>";
						    $s1=$_POST[$s];
						    #echo"$s1<br  >";
						    $ID2=$row['ID'];
						    #echo"$ID2\n";
						    $IP=$row['IP'];
						    $PORT= $row['PORT'];
						    $COMMUNITY= $row['COMMUNITY'];
						    $name=$row['NAME'];
						    if($s1 == $ID2)
						    {
						       $m++;
						        
			 
			 echo "<tr><td>&nbsp;$IP&nbsp;</td><td>&nbsp;$COMMUNITY&nbsp;</td><td>&nbsp;$name&nbsp;</td></tr>";
	                 
						  $FID=$FID."-".$ID2;
						  $FCOMMUNITY=$FCOMMUNITY."-".$COMMUNITY;
						  $fname=$fname."-".$name;
			 
			 #echo"<a href='generate3_server.php?id=$ID&community=$community&name=$name&type=2'> Click Here </a><br>";
			  #echo "<img src='generate3_server.php?id=$ID&community=$community&name=$name&type=2' alt='Generated RRD image'>";
			  
                    
						       
						    }
					     $j++;
					     }endwhile;
					     
					     echo"</table>";
					echo"<br>The Graphs for the Servers are as follows:<br>";
					    echo "<table>";
					     echo "<td><tr><br>";
					     echo "<img src='generate3_fserver.php?id=$FID&community=$FCOMMUNITY&name=$fname&type=1&start=$start&end=$end&total=$m' alt='Generated RRD image'>";
					     echo "</tr><tr><br>";
					     echo "<img src='generate3_fserver.php?id=$FID&community=$FCOMMUNITY&name=$fname&type=2&start=$start&end=$end&total=$m' alt='Generated RRD image'>";
					     echo "</tr><tr><br>";
					     echo "<img src='generate3_fserver.php?id=$FID&community=$FCOMMUNITY&name=$fname&type=3&start=$start&end=$end&total=$m' alt='Generated RRD image'>";
					     echo "</tr><tr><br>";
					     echo "<img src='generate3_fserver.php?id=$FID&community=$FCOMMUNITY&name=$fname&type=4&start=$start&end=$end&total=$m' alt='Generated RRD image'>";
					     echo "</tr></td>";
					     echo "</table>";
					     
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
				   magu14@student.bth.se
			    </td>
		     </tr>
	      </table>
       </body>
</html>

