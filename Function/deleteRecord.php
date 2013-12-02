<?php 
include 'logger.php';
slog('out');
if(isset($_POST['location'])) {
	slog('0');
	if(!include "../admin/AcidRainDBLogin.php") {
		slog('1');
	}
	slog('2');
	$query = "SELECT FROM somewhere WHERE something ? ? ? ";
	$delete = $db->prepare($query);
	$delete->bind_param('ssi', $_POST['location'], $_POST['name'], $_POST['amount']);
	if(!$delete->execute()) {
		slog('Query did not execute successfully: ' . $db->error);
	}
	
	$delete->close();
}

?>