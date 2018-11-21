<?php

#id=$ID&community=$community&name=$name&type=2

$community=$_GET['community'];
$id=$_GET['id'];
$start=$_GET['start'];
$end=$_GET['end'];
$uname=$_GET['uname'];
$usize=$_GET['usize'];
#print"$id-$community-$uname<br>$usize<br>";
/*
$community='station2';
$id='15';
$start='-1h';
$end='now';
$uname='start-eth0-eth2-br0-tr0';
$usize='4';
*/
$uname=explode("-",$uname);

//graph output
$name="daily.".$id.".png";

$rrdFile =$id."-".$community.".rrd";
#print"$rrdFile<br>";

$units='Bytes per second';

$a1= array("--start", "$start","--end", "$end","--title"," Data Rate vs time graph ",
                    "--vertical-label", "$units",);
$j=1;
$i=0;
$inagre="CDEF:inagre=";
$outagre="CDEF:outagre=";
    $plus="";
while($j <= $usize)
{
    $color = dechex(rand(0xAAAAAA, 0xCCCCCC));
    $color2 = dechex(rand(0xDDDDDD, 0xFFFFFF));
    $a2= array("DEF:x$j=$rrdFile:in$j:AVERAGE","LINE:x$j#$color:$uname[$j]-inoctets","GPRINT:x$j:AVERAGE:Avg\:%6.2lf%SB/s",
                    "GPRINT:x$j:MIN:Min\:%6.2lf%SB/s","GPRINT:x$j:MAX:Max\:%6.2lf%SB/s\l",
                    "DEF:y$j=$rrdFile:out$j:AVERAGE","LINE2:y$j#$color2:$uname[$j]-outoctets","GPRINT:y$j:AVERAGE:Avg\:%6.2lf%SB/s",
                    "GPRINT:y$j:MIN:Min\:%6.2lf%SB/s","GPRINT:y$j:MAX:Max\:%6.2lf%SB/s\l",);
    $a1=array_merge($a1,$a2);
    $inagre=$inagre."x".$j.",";
    $outagre=$outagre."y".$j.",";
    
    if($i > 0)
    {
        $plus=$plus."+,";
    }
    
  
    $j++;
    $i++;
}
$j=1;

$inagre=$inagre.$plus;
$inagre=substr($inagre,0,-1);
#echo"$inagre\n";
$outagre=$outagre.$plus;
$outagre=substr($outagre,0,-1);
#echo"$outagre\n";
$color = dechex(rand(0xAAAAAA, 0xCCCCCC));
    $color2 = dechex(rand(0xDDDDDD, 0xFFFFFF));
$a3=array( "LINE2:inagre#$color:inoctets aggregate","GPRINT:inagre:AVERAGE:value\:%6.2lf%SB/s\l","LINE2:outagre#$color2:outoctets aggregate","GPRINT:outagre:AVERAGE:value\:%6.2lf%SB/s\l");
array_push($a1,$inagre,$outagre);
$a1=array_merge($a1,$a3);
#var_dump($a1);





$options= $a1;

$r=rrd_graph($name,$options);

if(!$r)
{
    echo rrd_error();
}

header("Location: graphdisplay3_server.php?name=$name");


?>
