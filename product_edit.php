<?php
require_once('./INCLUDES.inc.php');


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $params = $_POST['product'];
    $compound_key = $params['cat_subcat'];
    $parts = explode('-',$compound_key);
    $product_category_id = (int)$parts[0];
    $product_sub_category_id = (int)$parts[1];

    
    
    
    $params['product_category_id'] = $product_category_id;
    if($product_sub_category_id > 0) {
        $params['product_sub_category_id'] = $product_sub_category_id;
    } else {
        $params['product_sub_category_id'] = null;
    }

    if(!isset($params['product_active'])) {
            $params['product_active'] = 0;
    }
    
    
    
    $product_id = $params['product_id'];
    $product = new Product($params);
    $product_id = $product->save();
    setFlash('Product Saved','success');
    header('Location:'.BASEURL.'/product.php?product_id=' . $product_id);
    exit;
}


$product_id = getGetVar('product_id');

$product = new Product();
$product->get($product_id);

$smarty->assign('PRODUCT',$product->params);


$product_categories = ProductCategory::getAll();
$product_subcategories = ProductSubCategory::getAll();
$bakeries = Bakery::getAll();
$smarty->Assign('BAKERIES',$bakeries);

$cats = array();

foreach($product_categories as $pc) {
    $pc['compound_key'] = $pc['product_category_id'] . '-0';
    $pc['compound_name'] = $pc['product_category_name'];
    $cats[$pc['product_category_id']]['category'] = $pc;
    $cats[$pc['product_category_id']]['subcats'] = array();
}

foreach($product_subcategories as $sc) {
    $sc['compound_key'] = $sc['product_category_id'] . '-' . $sc['product_sub_category_id'];
    $sc['compound_name'] = $cats[$sc['product_category_id']]['category']['product_category_name'] . ' > ' . $sc['product_sub_category_name'];
    $cats[$sc['product_category_id']]['subcats'][] = $sc;
}
$smarty->Assign('CATEGORIES',$cats);

$smarty->display('product_edit.tpl');
?>