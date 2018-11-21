use LWP::Simple;
use Data::Dumper qw(Dumper);
use Net::SNMP;
use DBI;
use RRD::Editor;
use FindBin '$Bin';
   #require 'db.conf';
$bin=substr($Bin,0, -11);
$bin=$bin."db.conf";
$path=$bin;
require "$path";
#print"serverhiiiiiiiii\n";
$hostname=$host;
#---------------subroutine for database access---------------------------------------------
   sub database
   {
      my $table = $_[0];
      my $sql= $_[1];
      my $dbx = DBI -> connect ("dbi:mysql:$database:$hostname:$port", $username, $password) or die;
      my $stx = $dbx-> prepare($sql);
     
      return $stx;
   }
   sub database1
   {
      #my $table = $_[0];
      my $sql= $_[0];
      my $dbx = DBI -> connect ("dbi:mysql:$database:$hostname:$port", $username, $password) or die;
      my $stx = $dbx-> prepare($sql);
     
      return $stx;
   }   
#---------------------------------------------Main Script---------------------------------------------------

#while()
#{
#--------------------------------Create Table if not exists-----------------------------------------------
$sth_y = database1 ("CREATE TABLE IF NOT EXISTS assignment3_server(
                                                        `ID` int(30) NOT NULL AUTO_INCREMENT,
                                                        `NAME` varchar(30) NOT NULL,
                                                        `IP` tinytext NOT NULL,
                                                        `PORT` int(30) NOT NULL,
                                                        `COMMUNITY` varchar(30) NOT NULL,
							`METHOD`varchar(30) NOT NULL,
							`OID` varchar (3000) NOT NULL,
							`STATUS` varchar (30) NOT NULL,
							`CPU` varchar(30) NOT NULL,
                                                        `BYTES` varchar(30) NOT NULL,
                                                        `REQUESTS` varchar(30) NOT NULL,
                                                        `BYTESREQUESTS` varchar(30) NOT NULL,
                                                         PRIMARY KEY (`ID`)
                                                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
                      
        $sth_y -> execute() or die DBI->errstr;



#---------------------------------------Retrieving server credentials---------------------------------------
        my $stx = database ("assignment3_server" , "SELECT * FROM assignment3_server" );
                    $stx-> execute or die "SQL error : ".$stx->errstr;
   
        while ($device = $stx-> fetchrow_hashref())   
   
         {
          
                    $ID = $device -> {'ID'};
                    $NAME = $device -> {'NAME'};
                    $HOST = $device -> {'IP'};
                    $PORT = $device -> {'PORT'};
                    $COMMUNITY = $device -> {'COMMUNITY'};
                    
                    
         
                    $HOSTNAME=$HOST.":".$PORT;
                    $content = get("http://$HOSTNAME/server-status");
                    print "Couldn't get it!" unless defined $content;
                
                    my @set = split / /, $content;
                    #print Dumper \@set;
                    
                    print"$set[8]\n";
                if($set[8] eq 'Server')    
                  { 
                    $i=0;
                    $j=1;
                    $cpu=0;
                    $uptime=0;
                    
                    while($i <= 100)
                    {
                      #print"$set[$i]\n";
                      if($set[$i] eq "day" || $set[$i] eq "days")
                      {
                        $uptime=$uptime + $set[$i-$j]*24*3600;
                      }
                      elsif($set[$i] eq "hour" || $set[$i] eq "hours")
                      {
                        $uptime=$uptime + $set[$i-$j]*3600;
                      }
                      elsif($set[$i] eq "minute" || $set[$i] eq "minutes")
                      {
                        $uptime=$uptime + $set[$i-$j]*60;
                        $uptime=$uptime + $set[$i+$j];
                      }
                      elsif($set[$i] eq "second" || $set[$i] eq "seconds")
                      {
                        $uptime=$uptime + $set[$i-$j];
                       }
                      if ($set[$i] eq "Usage:")
                        {
                            $k=$i+$j;
                            #print"$set[$k]\n";
                            $token = substr($set[$k], 1);
                            #print"$token\n";
                            $cpu=$cpu+$token;
                            $k++;
                            $token = substr($set[$k], 1);
                            $cpu=$cpu+$token;
                            $k++;
                            $token = substr($set[$k], 2);
                            $cpu=$cpu+$token;
                            $k++;
                            $token = substr($set[$k], 2);
                            $cpu=$cpu+$token;
                            $k++;
                            $cpu=$cpu*10;
                            $cpu=$cpu/10;
                            #print"$cpu\n";
                            #$key= strsplit("$set[$k]",1);
                            
                        }
                        
                        if ($set[$i] eq "requests/sec")
                        {
                           $requests=$set[$i-$j];
                           $requests=substr($requests,14);
                           $requests=$requests*10;
                           $requests=$requests/10;
                            #print"$requests\n"; 
                        }
                        elsif ($set[$i] eq "B/second")
                        {
                            $m=$i;
                           $bytes=$set[$i-$j];
                           $bytes=$bytes*10;
                           $bytes=$bytes/10;
                           $b=1;
                           #print"$bytes\n";
                           #print"$m\n";
                        }
                        elsif ($set[$i] eq "kB/second")
                        {
                           $m=$i;
                          $bytes=$set[$i-$j]*1000;
                          $b=1;
                         #print"$bytes\n";
                        }
                        elsif ($set[$i] eq "MB/second")
                        {
                           $m=$i;
                           $bytes=$set[$i-$j]*1000*1000;
                           $b=1;
                          #print"$bytes\n";
                        }
                        
                        if ($b eq '1')
                        {
                            $n=$m+2;
                            $byr=$set[$n];
                            $byr=$byr*10;
                            $byr=$byr/10;
                            #print"$byr\n";
                            $n++;
                            $t=substr($set[$n],0, -19);
                            #print"$t\n";
                                if ($t eq "kB")
                                 {
                                     $byr= $byr * 1000;
                                 }
                                elsif ($t eq "MB")
                                 {
                                     $byr= $byr * 1000 * 1000;
                                 }
                            $b++;
                        }
                 
                     $i++;
                    }
                    #print"$uptime\n$cpu\n";
                    if ($uptime eq! '0')
                    {
                        $cpu= ($cpu/$uptime) * 100;
                    }
                    
                    
                    #print"$cpu\n$byr\n$bytes\n$requests\n";
                    #print"$uptime\n";
                    $status="Device responding";
                    $sth_p = database ("assignment3_server","UPDATE assignment3_server SET
                                        STATUS='$status',
                                        CPU='$cpu',
                                        BYTES='$bytes',
                                        REQUESTS='$requests',
                                        BYTESREQUESTS ='$byr'
                                        WHERE ID='$ID'
                                        ");
                      
                    $sth_p -> execute() or die DBI->errstr;
                    rrd($HOST,$COMMUNITY,$NAME,$bytes,$requests,$byr,$cpu);
                  }
                else
                  {
                    $status="Device not responding";
                    $sth_p = database ("assignment3_server","UPDATE assignment3_server SET
                                        STATUS='$status'
                                        WHERE ID='$ID'
                                        ");
                  }
           }
    sub rrd
      {
                          
             #$ip=$_[0];
             $communityname=$_[1];
             $servername=$_[2];
             $bytes=$_[3];
             $requests=$_[4];
             $br=$_[5];
             $cpu=$_[6];
                
            #naming the rrd file    
             $rrdfile="server-$communityname-$servername.rrd";
             my $rrd = RRD::Editor->new();
             
         #creating the datasources based on number of interfaces
       
            if (! -e $rrdfile)
             {
              
                     
               $str="DS:bytes:GAUGE:600:U:U DS:requests:GAUGE:600:U:U DS:br:GAUGE:600:U:U DS:cpu:GAUGE:600:U:U RRA:AVERAGE:0.5:1:288 RRA:AVERAGE:0.5:12:168 RRA:AVERAGE:0.5:228:365";
                                       
            
              #print $str."\n";
             
             #creating the rrd file     
              $rrd->create($str);
                 
              # Save RRD to a file
              $rrd->save($rrdfile);
           } 
       
           #updating the rrdfile
            $rrd->open($rrdfile);
 
          
            $up="N".":".$bytes.":".$requests.":".$br.":".$cpu;
            
            #print $up."\n";
          
            $rrd->update($up);
            
            #print $rrd->info();
    
    
            # Get the time when the RRD was last updated (as a unix timestamp)
            #printf "RRD last updated at %d\n", $rrd->last();
            
            # Get the measurements added when the RRD was last updated
            #print $rrd->lastupdate();
     }        
     sub callback2()
      
      {  
          $session= $_[0];
          $ID= $_[1];
         
          print"$HOST-$COMMUNITY-$PORT\n";
         
          my $result= $session-> var_bind_list();
      if (!defined $result)
            {
               printf "ERROR: %s.\n", $session->error();
               $status="Device not responding";
               #print"$ID\n";
                $sth_p = database ("assignment3_server","UPDATE assignment3_server SET
                        STATUS='$status' WHERE ID='$ID'
                        ");
                      
               $sth_p -> execute() or die DBI->errstr;
               #print"ok\n";
            }
      else
         {
            print"Woah!\n";
            #print"$OID_inoctets[$j] \n";
            
            $cpu = $result->{$OIDCPU};
            $bytes = $result->{$OIDBYTES};
            $requests = $result->{$OIDREQUESTS};
            $byr = $result->{$OIDBR};
            
            print"$cpu-$bytes-$requests-$byr\n";
            $status="Device responding";
                    $sth_p = database ("assignment3_server","UPDATE assignment3_server SET
                                        STATUS='$status',
                                        CPU='$cpu',
                                        BYTES='$bytes',
                                        REQUESTS='$requests',
                                        BYTESREQUESTS ='$byr'
                                        WHERE ID='$ID'
                                        ");
                      
                    $sth_p -> execute() or die DBI->errstr;
            rrd($HOST,$COMMUNITY,$NAME,$bytes,$requests,$byr,$cpu);
            return;
         }
      }
