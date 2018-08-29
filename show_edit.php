<?php
require_once('./INCLUDES.inc.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$params = $_POST['show'];
        
        
	$show = new Show($params);
	$show_id = $show->save();


	echo "<pre>";
	print_r($params);
	echo "</pre>";
	echo "<pre>";
	print_r($show);
	echo "</pre>";
	die("Done");

	
	setFlash('Show saved','success');
	header('Location:' . BASEURL . '/shows.php');
	exit;
}


$show_id = (int)$_GET['show_id'];


if($show_id > 0) {
	$show = new Show();
	$show->get($show_id);
	$smarty->Assign('SHOW',$show->params);
}

$smarty->Display('show_edit.tpl');
?>
