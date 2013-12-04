<?php 
include 'logger.php';
if(isset($_POST['location'])) {
	if(!include "../admin/AcidRainDBLogin.php") {
		slog('In deleteRecord.php: Error including dblogin file');
	}
	$query = 'SELECT FROM somewhere WHERE something (?, ?, ?) ';
	$delete = $db->prepare($query);
	$delete->bind_param('sss', $_POST['location'], $_POST['name'], $_POST['amount']);
	##Not getting through to this line
	if(!$delete->execute()) {
		slog('Query did not execute successfully: ' . $db->error);
	}
	$delete->close();
}

?>