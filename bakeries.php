<?php
require_once('./INCLUDES.inc.php');

$bakeries = Bakery::getAll();

$smarty->Assign('BAKERIES',$bakeries);

$smarty->display('bakeries.tpl');
?>
