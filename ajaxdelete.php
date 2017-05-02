<?php

	require_once 'db.php';
	$db = new DB();


	$stmt =  $db->getConnection()->prepare("DELETE FROM  hashes where id = :id");
	$stmt->execute(array(':id'=>$_GET['id']));

	echo json_encode(array('status'=>$stmt->rowCount()));
?>