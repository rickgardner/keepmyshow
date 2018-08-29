<?php
class Customer extends BaseObject {

	function Customer($_params = array()) {
		parent::BaseObject($_params, 'customers', 'customer_id');
	}

        public function get($customer_id) {
            $db = getDb();
            $sql = 'SELECT ch.chain_number, c.* FROM customers c '
                    . 'LEFT JOIN chains ch on c.chain_id = ch.chain_id '
                    . ' WHERE c.customer_id = ?';
            $row = $db->GetRow($sql,array($customer_id));
            $this->params = $row;
        }
        
        
	public static function getAll($start_date = '', $end_date = '', $company_id = 0) {
		$db = getDb();
		$sql = 'SELECT * FROM customers ORDER BY chain_id, customer_name';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}

        public static function getHolidayWeeks($customer_id) {
            $db = getDb();
            $sql = 'select distinct(hw.holiday_week_year) as holiday_week_year, h.holiday_label from chain_holidays ch
 left join holiday_weeks hw on ch.holiday_id = hw.holiday_id
 left join holidays h on ch.holiday_id = h.holiday_id
 left join customers c on ch.chain_id = c.chain_id
 where c.customer_id = ?';
            $rs = $db->Execute($sql,array($customer_id));
            $rows = $rs->GetRows();
            $weeks = array();

            foreach($rows as $row) {
                $weeks[$row['holiday_week_year']] = $row['holiday_label'];
            }
            return $weeks;
        }


        public static function getHolidayDays($customer_id,$week_start,$week_end) {
            $sql = 'select * from substitute_days
                     where customer_id = ?
                     and original_date between ? and ?';
            $db = getDb();
            $rs = $db->Execute($sql,array($customer_id,$week_start,$week_end));
            $rows = $rs->GetRows();

            $days = array();
            foreach($rows as $row) {
                $original_date = $row['original_date'];
                $row['original_dow'] = date('l',strtotime($original_date));

                $days[$row['original_date']] = $row;
            }
            return $days;
        }

        public static function getSubstituteDays($customer_id,$week_start,$week_end) {
            $sql = 'select * from substitute_days
                     where customer_id = ?
                     and alternate_date between ? and ?';
            $db = getDb();
            $rs = $db->Execute($sql,array($customer_id,$week_start,$week_end));
            $rows = $rs->GetRows();
            $days = array();
            foreach($rows as $row) {
                $alternate_date = $row['alternate_date'];
                $row['alternate_dow'] = date('l',strtotime($alternate_date));
                $days[$row['alternate_date']] = $row;
            }
            return $days;
        }
        
        public static function getByCustomerNumber($customer_number) {
            $db = getDb();
            $sql = 'SELECT * FROM customers WHERE customer_number = ?';
            $row = $db->GetRow($sql,array($customer_number));
            return $row;
        }
        
        public static function getChainCustomers($customer_ids) {
            $customer_id_string = implode(",",$customer_ids);
            $db = getDb();
            $sql = 'SELECT * FROM customers WHERE chain_id in (?) ORDER BY chain_id, customer_name';
            $rs = $db->Execute($sql,array($customer_id_string));
            $rows = $rs->GetRows();
            return $rows;
            
        }

	public static function getProducts($customer_id) {
		$db = getDb();
//		$sql = 'SELECT * FROM chain_products WHERE chain_id = ? ORDER BY product_name';
		$sql = 'select p.* from customer_products cp
				left join products p on cp.product_id = p.product_id
				where cp.customer_id = ?
				ORDER BY p.product_name';
		$rs = $db->Execute($sql,array($customer_id));
		$rows = $rs->GetRows();
		return $rows;
        }
        
        
        public static function getAllProducts($customer_id) {
            $db = getDb();

            
            $sql = 'select * from ((select cp.chain_p_id,p.* from customer_products cp left join products p on p.product_id = cp.product_id where cp.customer_id = ?) union (select p.* from chain_products ch left join customers c on ch.chain_id = c.chain_id left join products p on ch.product_id = p.product_id where c.customer_id = ?)) t group by t.product_id order by t.product_id, t.product_name';

            $sql = 'select pc.*,sc.*,prod.* from 

(select * from 
(
(select p.*,cp.chain_p_id from customer_products cp left join products p on p.product_id = cp.product_id where cp.customer_id = ?)
 union 
(select p.*,ch.chain_p_id from chain_products ch left join customers c on ch.chain_id = c.chain_id left join products p on ch.product_id = p.product_id where c.customer_id = ?))
 t
 group by t.product_id order by t.product_id, t.product_name) prod 
left join product_categories pc on prod.product_category_id = pc.product_category_id
left join product_sub_categories sc on prod.product_sub_category_id = sc.product_sub_category_id
WHERE prod.product_active = 1 
ORDER BY pc.display_order, sc.product_sub_category_display_order,prod.display_order
';
            
            $rs = $db->Execute($sql,array($customer_id,$customer_id));
            $rows = $rs->GetRows();
            return $rows;
        }
        
        public static function getAllCustomerProductsByOrder($customer_id,$order_id) {
            $db = getDb();
            $sql = '
select pc.*,sc.*,prod.*
 from 
(select * from ( 
(select p.* from customer_products cp left join products p on p.product_id = cp.product_id where cp.customer_id = ?)
 union 
(select p.* from chain_products ch left join customers c on ch.chain_id = c.chain_id left join products p on ch.product_id = p.product_id where c.customer_id = ?))
 t group by t.product_id order by t.product_id, t.product_name) prod
 left join product_categories pc on prod.product_category_id = pc.product_category_id
 left join product_sub_categories sc on prod.product_sub_category_id = sc.product_sub_category_id
 left join order_items oi on oi.product_id = prod.product_id
where oi.quantity > 0 and oi.order_id = ?
 group by prod.product_id
 ORDER BY pc.display_order, sc.product_sub_category_display_order,prod.display_order';   
            $rs = $db->Execute($sql,array($customer_id,$customer_id,$order_id));
            $rows = $rs->GetRows();
            return $rows;
        }
        
        public static function clearProducts($customer_id) {
            $db = getDb();
            $sql = 'DELETE FROM customer_products WHERE customer_id = ?';
            $rs = $db->Execute($sql,array($customer_id));
        }
        
        public static function setProducts($customer_id,$product_ids,$customer_product_ids) {
            $db = getDb();
            foreach($product_ids as $product_id) {
                $customer_product_id = $customer_product_ids[$product_id];
                $sql = 'INSERT INTO customer_products (customer_id,product_id,chain_p_id) VALUES(?,?,?)';
                $rs = $db->Execute($sql,array($customer_id,$product_id,$customer_product_id));
            }
        }        
        

}
    
?>