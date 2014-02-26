<?php
$array = array("bar","cabinet","locker","fridge","other");
for($i=0; $i<count($array); $i++) {
	echo "<input type='button' class='locBut' value='$array[$i]'>";
}
?>