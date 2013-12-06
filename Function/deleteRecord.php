<?php 
include 'logger.php';
if(isset($_POST['location'])) {
	if(!include "../admin/AcidRainDBLogin.php") {
		slog('In deleteRecord.php: Error including dblogin file');
	}
slog("test");
	$query = "SELECT * FROM inventory WHERE Location = ? AND ID = ? AND Size = ?;"; // WHERE something (?, ?, ?) ';
	$delete = $db->prepare($query);
	settype( $_POST['amount'], int );
	slog($_POST['location'] . $_POST['name'] . settype($_POST['amount']);
	$delete->bind_param('ssi', $_POST['location'], $_POST['name'], $_POST['amount']);
	
	slog("this far" . $db->error);
	##Not getting through to this line
	if(!$delete->execute()) {
		slog('Query did not execute successfully: ' . $db->error);
	}
	$delete->close();
	
	slog("Successful");
}

?>