<?php
require_once('./INCLUDES.inc.php');

$show_uri = getGetVar('show_uri');

if(trim($show_uri) != '') {
	$show = Show::getShowByURI($show_uri);
	$smarty->Assign('SHOW',$show);
	$backdrops = Backdrop::getImagesByShowAndType($show['id'],'backdrop');
	$posters = Backdrop::getImagesByShowAndType($show['id'],'poster');
	$smarty->Assign('BACKDROPS',$backdrops);

	$genres = Show::getGenres($show['id']);
	$smarty->Assign('GENRES',$genres);

	$networks = Show::getNetworks($show['id']);
	$smarty->Assign('NETWORKS',$networks);

}

$smarty->Display('show.tpl');
?>
