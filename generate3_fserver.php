<?php

#id=$ID&community=$community&name=$name&type=2

$community=$_GET['community'];
$id=$_GET['id'];
$sname=$_GET['name'];

#$dsno=$_GET['dsno'];
$start=$_GET['start'];
$end=$_GET['end'];
$size=$_GET['total'];
$type=$_GET['type'];
/*
$id='1';
$community='start-public-public';
$sname='start-localhost-localhost2';
$type='1';
$start='-1h';
$end='now';
$size='2';
*/
$sname=explode("-",$sname);
$community=explode("-",$community);




if($type == '1')
{
    $dsno='cpu';
    $name = 'hour.png';
    $units='%';
    #$color='FF4000';
}
elseif($type == '2')
{
    $dsno='bytes';
    $name = 'daily.png';
    $units='Bytes';
    #$color='0101DF';
}
elseif($type == '3')
{
    $dsno='requests';
    $name = 'weekly.png';
    $units='Requests';
    #$color='04B404';
}
elseif($type == '4')
{
    $dsno='br';
    $name = 'monthly.png';
    $units='Bytes/Requests';
    #$color='0B3861';
}


$a1= array("--start", "$start","--end", "$end","--title"," $dsno vs time graph  ",
                    "--vertical-label", "$units",);
$j=1;
while($j <= $size)
{
    
    $rrdFile ="server-".$community[$j]."-".$sname[$j].".rrd";
    $color2 = dechex(rand(0xAAAAAA, 0xFFFFFF));
    #$color2 = dechex(rand(0x000000, 0xFFFFFF));
    $a2= array("DEF:y$j=$rrdFile:$dsno:AVERAGE","LINE2:y$j#$color2:$sname[$j]","GPRINT:y$j:AVERAGE:Avg\:%6.2lf%S",
                    "GPRINT:y$j:MIN:Min\:%6.2lf%S","GPRINT:y$j:MAX:Max\:%6.2lf%S\l",);
    $a1=array_merge($a1,$a2);
    $j++;
}



$r=rrd_graph($name,$a1);

if(!$r)
{
    echo rrd_error();
}
header("Location: graphdisplay3_server.php?name=$name");
?>
