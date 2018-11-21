<?php


$community=$_GET['community'];
$id=$_GET['id'];
$iname=$_GET['iname'];
$dsno=$_GET['dsno'];
$name ='hour.png';
$start=$_GET['start'];
$end=$_GET['end'];

echo"$community-$id-$iname-$dsno-$name-$end-$start";
/*
$community='station2';
$id='12';
$iname='eth2';
$dsno='1';
$start='-1h';
$end='now';
*/
                                                                             

$rrdFile =$id."-".$community.".rrd";
                                     

//graph output
$options= array(
                    "--start", "$start",
                    "--end", "$end",
                    "--title","Data rate of $iname vs time graph",
                    "--vertical-label", "Bytes per second",
                    "DEF:x=$rrdFile:in$dsno:AVERAGE",
                    "AREA:x#4B3086:inoctets",
                    "GPRINT:x:AVERAGE:Avg\:%6.2lf%SB/s",
                    "GPRINT:x:MIN:Min\:%6.2lf%SB/s",
                    "GPRINT:x:MAX:Max\:%6.2lf%SB/s",
                    "DEF:y=$rrdFile:out$dsno:AVERAGE",
                    "LINE2:y#FF3030:outoctets",
                    "GPRINT:y:AVERAGE:Avg\:%6.2lf%SB/s",
                    "GPRINT:y:MIN:Min\:%6.2lf%SB/s",
                    "GPRINT:y:MAX:Max\:%6.2lf%SB/s",
                );

$r=rrd_graph($name,$options);

if(!$r)
{
    echo rrd_error();
}
header("Location: graphdisplay3_server.php?name=$name");


?>
