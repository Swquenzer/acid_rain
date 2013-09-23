<?php

function slog($entry)
{
	$head = $_SERVER['REQUEST_TIME']. ':   ';
$file = 'log.log';	
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .= $head. $entry. "\n";
// Write the contents back to the file
file_put_contents($file, $current);

}
	 
 ?><?php

?>