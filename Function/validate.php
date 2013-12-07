<?php
	function validateAddInventory($room, $itemCount, $chemicalID, $size, $unit) {
		$errors;
		#Validate 'Room': Only letters and numbers aloud, no spaces or symbols
		if(!preg_match('/^[a-zA-Z0-9]+$/', $room)) {
			$errors[] = "Room must be alphanumeric with no spaces or symbols";
		}
		#Validate 'itemCount': integers only
		if(!preg_match('/^[0-9]+$/', $itemCount)) {
			$errors[] = "The item quantity must be an integer number";
		}
		#Validate chemicalID (At the moment, the add function only works if the chemical already exists in DB)
		#Validate size (float value)
		#Validate Unit (how should we validate this?)
		#We also need to validate manufacturer- right now only words if manufacturer already exists in DB
		return $errors;
	}
?>