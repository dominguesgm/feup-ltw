<?php
	include_once('database/connection.php');
	header('Content-Type: application/json');

    $result = array();

    if( !isset($_POST['functionname']) ) { $result['error'] = 'No function name'; }
    if( !isset($result['error']) ) {

        switch($_POST['functionname']) {
            case 'getEventTypes':
               $result['result'] = getEventTypes();
               break;
            default:
               $aResult['error'] = 'Not function found'.$_POST['functionname'].'!';
               break;
        }

    }

    echo json_encode($aResult);

function getEventTypes(){
	// open database
	global $db;

	$stmt = $db->prepare('SELECT * FROM EventType');
	$stmt->execute();
	return $stmt->fetchAll();
}

?>