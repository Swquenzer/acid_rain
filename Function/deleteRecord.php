<?php
include 'logger.php';

if(isset($_POST['location'])) {
    if(!include "../admin/AcidRainDBLogin.php") {
            slog('In deleteRecord.php: Error including dblogin file');
    }
        
    # ----------- QUICKFIX for delete --------------#
    $query = "DELETE FROM inventory WHERE Location = ? AND Size = ? AND ChemicalID IN (SELECT ID FROM chemical WHERE Name = ?)";
    $delete = $db->prepare($query);
    $_POST['amount'] = (int) $_POST['amount'];        
    $delete->bind_param('sis', $_POST['location'], $_POST['amount'], $_POST['name']);

    # ----------- END QUICKFIX ---------------------#
    
    if(!$delete->execute()) {
            slog('Query did not execute successfully: ' . $db->error);
    }
    $delete->close();
}

?>