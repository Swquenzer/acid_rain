<?php
/*****************************************************
**  loger.php                                       **
**--------------------------------------------------**
**  Generated By:Isaac 4/10 17:00                   **
**                                                  **
**            #####################                 **
**            # ACTIVE EDITOR:    #                 **
**            #####################                 **
**                                                  **
**  Status: development version                     **
**                                                  **
**  Comments: this file really shouldn't change     **
**--------------------------------------------------**
** <-Changelog->                                    **
******************************************************/
function slog($entry)
{
	$head = date('m//d//y H:i:s') . ':   ';
$file = 'log.log';	
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .= $head. $entry. "\n";
// Write the contents back to the file
file_put_contents($file, $current);

}
	 
 ?>