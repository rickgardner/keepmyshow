<?php
require_once('./INCLUDES.inc.php');

$show = Show::getRandom();
$smarty->Assign('FEATURE',$show);


$genres = Genre::getAll();
$smarty->Assign('GENRES',$genres);


$networks = Network::getAll();
$smarty->Assign('NETWORKS',$networks);


$languages = Language::getAll();
$smarty->Assign('LANGUAGES',$languages);


$shows = Show::getAll(array());
$smarty->Assign('SHOWS',$shows);

$user = $_SESSION['USER'];







$smarty->Display('index.tpl');
?>