<?php
    include 'config_s.php';
   
    $url = "http://$hn/server-status";

    $str = file_get_contents($url);
    #echo"$str";
       #print_r(explode(" ",$str));
    $set=explode(" ",$str);
    #echo"$set[8]";
    
    $i=0;
    $j=1;
    $cpu=0;
    $uptime=0;
    while($i <= 100)
    {
      
      if($set[$i] == "day" || $set[$i] == "days")
      {
        $uptime=$uptime + $set[$i-$j]*24*3600;
      }
      elseif($set[$i] == "hour" || $set[$i] == "hours")
      {
        $uptime=$uptime + $set[$i-$j]*3600;
      }
      elseif($set[$i] == "minute" || $set[$i] == "minutes")
      {
        $uptime=$uptime + $set[$i-$j]*60;
        $uptime=$uptime + $set[$i+$j];
      }
      elseif($set[$i] == "second" || $set[$i] == "seconds")
      {
        $uptime=$uptime + $set[$i-$j];
       }
      if ($set[$i] == "Usage:")
        {
            $k=$i+$j;
            $token = strtok($set[$k], "u");
            $cpu=$cpu+$token;
            $k++;
            $token = strtok($set[$k], "s");
            $cpu=$cpu+$token;
            $k++;
            $token = strtok($set[$k], "cu");
            $cpu=$cpu+$token;
            $k++;
            $token = strtok($set[$k], "cs");
            $cpu=$cpu+$token;
            $k++;
            $key= str_split("$set[$k]",1);
            
        }
        
        if ($set[$i] == "requests/sec")
        {
            
            $requests=$set[$i-$j];
            #$temp = strtok($set[$k], " ");
            #$requests=ltrim($requests,"load");
            #$test=strlen($requests);
            $requests=substr($requests,14);
            #echo$test."<br>";
        }
        elseif ($set[$i] == "B/second")
        {
            $m=$i;
            $bytes=$set[$i-$j];
            
        }
        elseif ($set[$i] == "kB/second")
        {
            $m=$i;
            $bytes=$set[$i-$j]*1000;
        }
        elseif ($set[$i] == "MB/second")
        {
            $m=$i;
            $bytes=$set[$i-$j]*1000*1000;
        }
        
        $byr=$set[$m+2];
        $t = strtok($set[$m+3], "/request");
        
        if ($t == "kB")
        {
         $byr= $byr * 1000;
        }
        elseif ($t == "MB")
        {
         $byr= $byr * 1000 * 1000;
        }
        
        
     $i++;
    }
    $cpu= ($cpu/$uptime) * 100;
    
    #echo"1--$cpu<br> 2--$bytes<br> 3--$requests<br> 4--$byr";
    #echo"$uptime";
    
                       $con=mysqli_connect($hn,$usr,$pwd);
	    
    // Check connection
    
        if (mysqli_connect_errno())
              {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
	    
    //connecting to the database
    
        $con=mysqli_connect($hn, $usr, $pwd,$database);  
		
       // Create devicestable
            $sql1="DROP TABLE IF EXISTS serverstatus";
            if (mysqli_query($con,$sql1))
	    {
                #echo "Table serverstatus deleted successfully \n";
	    }
            else
            {
		echo "Error creating table: " . mysqli_error($con) ."\n";
	    }
		
            $sql="CREATE TABLE IF NOT EXISTS serverstatus(
                                                        `ID` int(30) NOT NULL AUTO_INCREMENT,
                                                        `CPU` varchar(30) NOT NULL,
                                                        `BYTES` varchar(30) NOT NULL,
                                                        `REQUESTS` varchar(30) NOT NULL,
                                                        `BYTESREQUESTS` varchar(30) NOT NULL,
                                                         PRIMARY KEY (`id`)
                                                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1" ;

		
            if (mysqli_query($con,$sql))
	    {
                #echo "Table serverstatus created successfully \n";
	    }
            else
            {
		echo "Error creating table: " . mysqli_error($con) ."\n";
	    }
                        
                        //inserting values into the database
                        
                        $sql3= "INSERT INTO serverstatus(CPU,BYTES,REQUESTS,BYTESREQUESTS) VALUES ('$cpu','$bytes','$requests','$byr')" ;
                                                //query
                                                if (mysqli_query($con, $sql3))
                                                {
                                                    #echo "New record created successfully";
                                                }
                                                else
                                                {
                                                    echo "Error: " . $sql3 . "<br>" . mysqli_error($con);
                                                }
  
                        
                                //close the connection
                        mysql_close($db);
    
    
?>