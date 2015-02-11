<?php

/* Do some operation here, like talk to the database, the file-session
 * The world beyond, limbo, the city of shimmers, and Canada.
 * 
 * AJAX generally uses strings, but you can output JSON, HTML and XML as well. 
 * It all depends on the Content-type header that you send with your AJAX
 * request. */


$sin = array();
$cos = array();
$x = array();
for ($i = 0; $i < 14; $i+=0.5) { 
    $x[] = $i;
    $sin[$i][] = sin($i);
    $cos[] = cos($i);
}

?>
