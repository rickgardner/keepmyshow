<?php
class ProductCategory extends BaseObject {

	function ProductCategory($_params = array()) {
		parent::BaseObject($_params, 'product_categories', 'product_category_id');
	}

	public static function getAll() {
		$db = getDb();
		$sql = 'SELECT * FROM product_categories';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}

}
    
?>