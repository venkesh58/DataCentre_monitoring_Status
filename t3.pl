#! /usr/local/bin/perl


   use Net::SNMP;
   use DBI;
   use RRD::Editor;
   use FindBin '$Bin';
   use Data::Dumper;
   #require 'db.conf';
   $actual=substr($Bin,0, -11);
   $path=$actual."db.conf";
   
   require "$path";
   print"$path\n";
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
 
#---------------------Create Table if not exists------------------------------------------
 $sth_y = database1 ("CREATE TABLE IF NOT EXISTS assignment3_interfaces(
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
                                                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
                      
        $sth_y -> execute() or die DBI->errstr;




#------------------Script Start- Accessing DEVICES from the database------------------------
    my $stx = database ("assignment3_interfaces" , "SELECT * FROM assignment3_interfaces" );
      $stx-> execute or die "SQL error : ".$stx->errstr;
   
   while ($device = $stx-> fetchrow_hashref())   
   
   {
          
                    $ID = $device -> {'ID'};
                    $HOST = $device -> {'IP'};
                    $PORT = $device -> {'PORT'};
                    $COMMUNITY = $device -> {'COMMUNITY'};
                    $SIZE =$device -> {'USIZE'};
                    $UINTERFACES=$device -> {'UORDER'}; 
      
      my @uinter = split /-/, $UINTERFACES;
      $usize=@uinter;
                   #print"$ID-$HOST-$PORT-$COMMUNITY-$SIZE\n";
   
#------------------------------OIDs for various parameters-------------------------------------   
          $inoctets='.1.3.6.1.2.1.2.2.1.10';
          $outoctets='.1.3.6.1.2.1.2.2.1.16';
          
          $k=0;
          $i=1;
  
  $usize--;
        
   #----------------------------Loop to collect information from every interface------------------   
      @OID_inoctets=();
       @OID_outoctets=();
      while($k < $usize)
      
      {
          $OID_inoctets[$k]=$inoctets.".".$uinter[$i];
          $OID_outoctets[$k]=$outoctets.".".$uinter[$i];
        
       $k++;
       $i++;
       
      }
        ;
   #---------------------------SNMP session to poll information from a particular interface using get-next----------------------      
         my ($session, $error) = Net::SNMP->session(
               -hostname  => $HOST,
               -community => $COMMUNITY,
               -port => $PORT,
               -nonblocking => 1,
               -timeout => 5,
            );
         
            if (!defined $session) {
               printf "ERROR: %s.\n", $error;
               exit 1;
            }
             
            #@all=
            print"$HOST-$COMMUNITY-$PORT-$usize\n";
            #print Dumper @OID_inoctets;
            
 
            my $result = $session->get_request(-varbindlist => [@OID_inoctets,@OID_outoctets],
                                               -callback => [\&callback2,$ID,$HOST,$COMMUNITY,$SIZE,$usize]);
      
          snmp_dispatcher();
          #print "$ID1\n";
         $session->close();    
       $status="Device Responding";
  
 
       
   }
   


   
#-------------------------------Sub routine to find the various associated parameters based on number of interfaces-------------------------------      
   sub callback2()
      
      {  
          $session= $_[0];
          #$ID= $_[1];
         #@OID_inoctets= $_[2];
          $ID1=$_[1];
          #$HOST1=$_[2];
          $COMMUNITY1=$_[3];
          $SIZE1=$_[4];
          $usize1=$_[5];
          #@OID_inoctets1=$_[6];
          #@OID_outoctets1=$_[7];
          #print"$ID1-$COMMUNITY1-$SIZE1-$usize1\n";
          
         
          #print"$OID_inoctets1[0]\n";
       $result= $session-> var_bind_list();
       print Dumper $result;

if (!defined $result)
            {
               printf "ERROR: %s.\n", $session->error();
               $status="Not Responding";
                  print"$status";
            #print"$ID\n";
                $sth_p = database ("assignment3_interfaces","UPDATE assignment3_interfaces SET
                        STATUS='$status' WHERE ID='$ID'
                        ");
                      
               $sth_p -> execute() or die DBI->errstr;
               #print"ok\n";
            }
#=head           
      else
         {
            #print"Woah!\n$usize1\n";
            $inoct="";
            $outoct="";
             $j=0;
            while($j < $usize1)
            {   
            
            #print"$OID_inoctets1[$j] \n";
            $finoctets = $result->{$OID_inoctets[$j]};
            #$foutoctets = $result->{'.1.3.6.1.2.1.2.2.1.16.2'};
            #print"$finoctets\n";
            $inoct=$inoct.":".$finoctets;
            $foutoctets = $result->{$OID_outoctets[$j]};
            $outoct=$outoct.":".$foutoctets;
            #print"$foutoctets\n";
            $j++;
            }
            print"$inoct\n$outoct\n";
            $status="Responding";
             #  print"$ID\n";
                $sth_p = database ("assignment3_interfaces","UPDATE assignment3_interfaces SET
                        STATUS='$status' WHERE ID='$ID'
                        ");
                      
               $sth_p -> execute() or die DBI->errstr;
              # print"ok\n";
            rrd($inoct,$outoct,$ID1,$COMMUNITY1,$SIZE1);
            return $ID1;
     }
#=cut
      }
      
   
    #---------Sub routine for RRD--------------------------------------------------------------------------
sub rrd
      {
                          
             $in=$_[0];
             $out=$_[1];
             $ID2=$_[2];
             $COMMUNITY2=$_[3];
             $noi=$_[4];
                #print"$in-$out-$ID2-$COMMUNITY2-$noi\n";
            #naming the 2rrd file    
             $rrdfile="$ID2-$COMMUNITY2.rrd";
             my $rrd = RRD::Editor->new();
             
         #creating the datasources based on number of interfaces
       
            if (! -e $rrdfile)
             {
              $n=1;
              $strin='';
              $strout='';
              while ($n <= $noi)
                  {
                     
                     $strin=$strin."DS:"."in".$n.":COUNTER:600:U:U ";
                     $strout=$strout."DS:"."out".$n.":COUNTER:600:U:U ";
                     $n++;
                  }
              $str="";    
              $str=$str.$strin.$strout."RRA:AVERAGE:0.5:1:288 RRA:AVERAGE:0.5:12:168 RRA:AVERAGE:0.5:228:365";
              #print $str."\n";
             
             #creating the rrd file     
              $rrd->create($str);
                 
              # Save RRD to a file
              $rrd->save($rrdfile);
           } 
       
           #updating the rrdfile
            $rrd->open($rrdfile);
 
          
            $up="N".$in.$out;
            
            #print $up."\n";
            if ($up eq "N")
            {
               print"Device not responding \n";
            }
            else
            {
            $rrd->update($up);
            }
            #print $rrd->info();
    
    
            # Get the time when the RRD was last updated (as a unix timestamp)
            #printf "RRD last updated at %d\n", $rrd->last();
            
            # Get the measurements added when the RRD was last updated
            #print $rrd->lastupdate();
   }        
  
   

