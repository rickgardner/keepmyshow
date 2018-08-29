<?php
require_once('./INCLUDES.inc.php');

$product_id = getGetVar('product_id');

$product = new Product();
$product->get($product_id);

$db = getDb();
$sql = "Select Chain as Class, `chain_name` as Consumer from 
(
select c.`chain_name`,\"Chain\" from `products` p
join `chain_products` cp using (`product_id`)
join `chains` c using (`chain_id`)
where p.`product_id` = ? /*driven by product*/
union
select c.`customer_name`,\"Customer\" from `products` p
join `customer_products` cp using (`product_id`)
join `customers` c using (`customer_id`)
where p.`product_id` = ?/*driven by product*/) a";

$rs = $db->Execute($sql,array($product_id,$product_id));
$rows = $rs->GetRows();

$smarty->Assign('CONSUMERS',$rows);
$smarty->assign('PRODUCT',$product->params);

$smarty->display('product.tpl');
?>