<?php

// open the file in a binary mode
//$name = 'graph.png';
$name=$_GET['name'];

$fp = fopen($name, 'rb');

// send the right headers
header("Content-Type: image/png");
#header("Content-Length: " . filesize($name));


// clean the output buffer
// dump the picture and stop the script
fpassthru($fp);
unlink($name);

exit;

?>