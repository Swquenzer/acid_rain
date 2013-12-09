<?php
	function validateAddInventory($room, $itemCount, $chemicalID, $size, $unit) {
		$errors = array();		
		#Validate 'Room': Only letters and numbers aloud, no spaces or symbols
		if(!preg_match('/^[a-zA-Z0-9]+$/', $room)) {
			$errors[] = "Room must be alphanumeric with no spaces or symbols";
		}
		#Validate 'itemCount': integers only
		if(!preg_match('/^[0-9]+$/', $itemCount)) {
			$errors[] = "The item quantity must be an integer number";
		}
		#Validate 'size': float-decimal and sign optional
		if(!preg_match('/^-?([0-9])+([\.|,]([0-9])*)?$/', $size)) {
			$errors[] = "The size quantity must be an decimal number";
		}
		#Validate chemicalID (At the moment, the add function only works if the chemical already exists in DB)
		#Validate Unit (how should we validate this?)
		#We also need to validate manufacturer- right now only works if manufacturer already exists in DB
		return $errors;
	}
?>