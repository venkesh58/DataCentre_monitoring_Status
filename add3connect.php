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
                        Devices Home Page
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
                        
                        //creating table if not present
                         $sql="CREATE TABLE IF NOT EXISTS assignment3_interfaces(
                                                        `ID` int(30) NOT NULL AUTO_INCREMENT,
                                                        `IP` tinytext NOT NULL,
                                                        `PORT` int(30) NOT NULL,
                                                        `COMMUNITY` varchar(30) NOT NULL,
                                                        `SIZE` int(30) NOT NULL,
                                                        `STATUS` varchar(30) NOT NULL,
                                                        `ISTATUS` varchar(30) NOT NULL,
                                                        `INAME` varchar(300000) NOT NULL,
                                                        `IORDER` varchar(300000) NOT NULL,
                                                        `UNAME` varchar(300000) NOT NULL,
                                                        `UORDER` varchar(300000) NOT NULL,
                                                        `USIZE` int(30) NOT NULL,
                                                         PRIMARY KEY (`id`)
                                                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1" ;

		        
                        if (mysql_query($sql))
                            {
                                #echo "Table assignment3_interfaces created successfully \n";
                            }
                        else
                            {
                                echo "Error creating table: " . mysql_error($con) ."\n";
                            }
                        
                        //retrieving data from  previous page
                        $COMMUNITY=$_POST["COMMUNITY"];
                        $IP=$_POST["IP"];
                        $PORT=$_POST["PORT"];
                        $NAME=$_POST["NAME"];
                        $HOST=$IP.":".$PORT;
                        $ifindices="1.3.6.1.2.1.2.2.1.1";
                        $ifname="1.3.6.1.2.1.2.2.1.2";
			#echo"Hiii";
                        $a = snmpwalk($HOST, $COMMUNITY, $ifindices); 
                        $b = snmpwalk($HOST, $COMMUNITY, $ifname);
                        $c= sizeof($a);
                        $i=0;
                        $iorder="start";
                        $iname="start";
                        $query2= mysql_query("SELECT *FROM assignment3_interfaces");
                          #echo"Hiii";
                          while ($row= mysql_fetch_array($query2)):
                        {
                               
                               if ($IP==$row['IP'] && $COMMUNITY==$row['COMMUNITY'])
                               {
                                echo "<br><br><br><br>";
                                echo "<h3><br><br>Device with the same IP and COMMUNITY Exists<br><br></h3>";
                                $i=1;
                               }
                           
                        
                        }
                        endwhile;
                        
                        
                        if($i==1)
                            {
                            echo"<h3>"."<a href='add3.php'>"."Click here to add a new device"."</a><br><br>";
                        
                            echo"<a href='display3.php'>". "Click here to view the information of the devices" ."</a>"."</h3>";
                        mysql_close($db);
                            }
                        elseif($a[0] == '')
                        {
                            echo "<br><br><br><br>";
                            echo "<h3>Device is not responding to SNMP request</h3> \n";
                            echo"<h3>"."<a href='add3.php'>"."Click here to add a new device"."</a><br><br>";
                            echo"<a href='display3.php'>". "Click here to view the information of the devices" ."</a>"."</h3>";
                        mysql_close($db);
                        }
                        else
                        {
                        while($i < $c)
                            {
                             $a[$i] = substr($a[$i],9);
                             #echo"$a[$i]\n";
                             $b[$i] = substr ($b[$i],9,-1);
                             #echo"$b[$i]\n";
                             $iorder = $iorder."-".$a[$i];  
                             $iname = $iname."-".$b[$i];
                             $i++;
                            }
                            $status='SELECTION';
                        //Entering new data into the device                               
                        $sql= "INSERT INTO assignment3_interfaces (IP,PORT,COMMUNITY,IORDER,INAME,ISTATUS,SIZE) VALUES ('$IP','$PORT','$COMMUNITY','$iorder','$iname','$status','$c')" ;
                                                //query
                                                if (!mysql_query($sql) )
                                                    {
                                                        die('Error: ' . mysql_error() );
                                                    }
                        
                        //close the connection
                        mysql_close($db);
                        header( 'Location: add3select.php' ) ;
                        }
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
