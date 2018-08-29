<?php
class Order extends BaseObject {

	function Order($_params = array()) {
		parent::BaseObject($_params, 'orders', 'order_id');
	}

    public static function getDistinctDaysForOrder($order_id) {
        $db = getDb();
        $sql = 'select distinct(delivery_date) as delivery_date from order_items where order_id = ? order by delivery_date asc';
        $rs = $db->Execute($sql,array($order_id));
        $rows = $rs->GetRows();
        return $rows;
    }

	public static function getAll() {
		$db = getDb();
		$sql = 'SELECT * FROM orders';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}

	public static function getByCustomerId($customer_id,$with_items_only=false) {
		$db = getDb();
                $sql = 'SELECT o.*,u.*,c.*,count(oi.order_id) as num_items FROM orders o
 left join users u on o.user_id = u.user_id
 left join order_items oi on oi.order_id = o.order_id
 left join customers c on o.customer_id = c.customer_id
 WHERE o.customer_id = ?
 group by o.order_id';
         
                if($with_items_only) {
                    $sql .= ' having count(oi.order_id) > 0 ';
                }
                
$sql .= ' ORDER BY created_at DESC';
		$rs = $db->Execute($sql,array($customer_id));
		$rows = $rs->GetRows();
                
                for($i = 0; $i < count($rows); $i++) {
                    $updated_at = $rows[$i]['updated_at'];
                    $week_start = $rows[$i]['week_start'];
                    $updated_at_nice = mysqlToNiceDate($rows[$i]['updated_at']);
                    $week_start_nice = mysqlToNiceDate($rows[$i]['week_start']);
                    $rows[$i]['updated_at_nice'] = $updated_at_nice;
                    $rows[$i]['week_start_nice'] = $week_start_nice;
                }
                
                
		return $rows;
	}
        
        public static function isNoOrder($order_id) {
            $db = getDb();

            $sql = 'select count(*) as no_order from orders o
                    left join order_items oi on o.order_id = oi.order_id
                     where o.order_id = ?
                     and oi.product_id = 1';
            $no_order = $db->GetOne($sql,array($order_id));
            return ($no_order == 1);
        }
        
        
        public static function getOrCreateByWeekAndCustomerId($week_start,$customer_id,$user_id) {
            $db = getDb();
            $sql = 'SELECT * FROM orders WHERE week_start = ? AND customer_id = ?';
            $rs = $db->Execute($sql,array($week_start,$customer_id));
            $rows = $rs->GetRows();
            if(count($rows) == 0) {
                // we need to create an order for this customer
                $r = array();
                $r['customer_id'] = $customer_id;
                $r['week_start'] = $week_start;
                $r['user_id'] = $user_id;
                $r['created_at'] = time();
                $r['updated_at'] = time();
                $insert_sql = $db->GetInsertSql($rs,$r);
                $db->Execute($insert_sql);
                // we could probably do this all in one transaction
                // but for safety and sanity, I am retrieving the object 
                // immediately after creating it.
                $sql = 'SELECT * FROM orders WHERE week_start = ? AND customer_id = ?';
                $rs = $db->Execute($sql,array($week_start,$customer_id));
                $rows = $rs->GetRows();
            } 
            return $rows[0];
        }
        
        public static function touchOrder($order_id) {
            $db = getDb();
            $sql = 'SELECT * FROM orders WHERE order_id = ?';
            $rs = $db->Execute($sql,array($order_id));
            $r = array();
            $r['updated_at'] = time();
            $update_sql = $db->GetUpdateSql($rs,$r);
            $db->Execute($update_sql);
        }
        
        public static function addOrderItem($order_id,$product_id,$date,$quantity) {
            $db = getDb();
//            $db->debug = true;
            $sql = 'REPLACE INTO order_items (order_id,product_id,delivery_date,quantity) VALUES(?,?,?,?)';
            $rs = $db->Execute($sql,array($order_id,$product_id,$date,$quantity));
        }
        
        public static function clearOrderItems($order_id) {
            $db = getDb();
            $sql = 'DELETE FROM order_items WHERE order_id = ?';
            $rs = $db->Execute($sql,array($order_id));
        }

        public static function getOrderItemsByOrder($order_id) {
            $db = getDb();
            $sql = 'SELECT * FROM order_items WHERE order_id = ? AND quantity > 0';
            $rs = $db->Execute($sql,array($order_id));
            $rows = $rs->GetRows();
            return $rows;
        }
}
    
?>
