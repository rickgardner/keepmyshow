<?php
class ProductSubCategory extends BaseObject {

	function ProductSubCategory($_params = array()) {
		parent::BaseObject($_params, 'product_sub_categories', 'product_sub_category_id');
	}

	public static function getAll() {
		$db = getDb();
                $sql = 'SELECT * FROM product_sub_categories sc 
left join product_categories pc on sc.product_category_id = pc.product_category_id';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}

}
    
?>