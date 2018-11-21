<?php

#id=$ID&community=$community&name=$name&type=2

$community=$_GET['community'];
$id=$_GET['id'];
$sname=$_GET['name'];
#$dsno=$_GET['dsno'];
$start=$_GET['start'];
$end=$_GET['end'];


$type=$_GET['type'];
#$type='weekly';
/*
$id='1';
$community='public';
$name='localhost';
$type='1';
*/
$rrdFile ="server-".$community."-".$sname.".rrd";
$t='3600';
if($type == '1')
{
    $dsno='cpu';
    $name = 'hour.png';
    $units='%';
    $color='FF4000';
}
elseif($type == '2')
{
    $dsno='bytes';
    $name = 'daily.png';
    $units='Bytes';
    $color='0101DF';
}
elseif($type == '3')
{
    $dsno='requests';
    $name = 'weekly.png';
    $units='Requests';
    $color='04B404';
}
elseif($type == '4')
{
    $dsno='br';
    $name = 'monthly.png';
    $units='Bytes/Requests';
    $color='0B3861';
}

//graph output
$options= array(
                    "--start", "$start",
                    "--end", "$end",
                    "--title"," $dsno vs time graph for $sname",
                    "--vertical-label", "$units",
                    "DEF:x=$rrdFile:$dsno:AVERAGE",
                    "LINE:x#$color:$dsno",
                    "GPRINT:x:AVERAGE:Avg\:%6.2lf%S",
                    "GPRINT:x:MIN:Min\:%6.2lf%S",
                    "GPRINT:x:MAX:Max\:%6.2lf%S",
                );

$r=rrd_graph($name,$options);

if(!$r)
{
    echo rrd_error();
}
header("Location: graphdisplay3_server.php?name=$name");
?>
