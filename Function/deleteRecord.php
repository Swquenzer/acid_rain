<?php 
include 'logger.php';
if(isset($_POST['location'])) {
	if(!include "../admin/AcidRainDBLogin.php") {
		slog('In deleteRecord.php: Error including dblogin file');
	}
slog("test");
	$query = 'CALL DelInventory(?,?,?,?)'; // WHERE something (?, ?, ?) ';
	$delete = $db->prepare($query);
	settype( $_POST['amount'], 'int' );
	$delete->bind_param('ssis', $_POST['location'], $_POST['name'], $_POST['amount'], $_['manufacturer'] );
	
	slog("this far" . $db->error);
	##Not getting through to this line
	if(!$delete->execute()) {
		slog('Query did not execute successfully: ' . $db->error);
	}
	$delete->close();
	
	slog("Successful");
}

?>