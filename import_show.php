<?php
require_once('./INCLUDES.inc.php');

$tmdbid = getGetVar('tmdbid');

$object = Show::importTmdb($tmdbid);


?>