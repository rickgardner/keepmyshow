<?php
require_once('./INCLUDES.inc.php');

$genre = getGetVar('genre');
$network = getGetVar('network');
$language = getGetVar('language');


$filter = array();
$filter['genre'] = $genre;
$filter['network'] = $network;
$filter['language'] = $language;

$shows = Show::getAll($filter);
$smarty->Assign('SHOW_COUNT',count($shows));
$smarty->Assign('SHOWS',$shows);
$smarty->display('shows.tpl');
?>