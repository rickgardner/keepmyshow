<?php
class OrderItem extends BaseObject {

	function OrderItem($_params = array()) {
		parent::BaseObject($_params, 'order_items', 'order_item_id');
	}

	public static function getByOrderId($order_id) {
		$db = getDb();
		$sql = 'SELECT * FROM order_items WHERE order_id = ?';
		$rs = $db->Execute($sql,array($order_id));
		$rows = $rs->GetRows();
		return $rows;
	}
}
    
?>
