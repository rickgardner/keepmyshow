<?php
class Chain extends BaseObject {

	function Chain($_params = array()) {
		parent::BaseObject($_params, 'chains', 'chain_id');
	}

        public function get($chain_id) {
            $db = getDb();
            $sql = 'SELECT dc.distribution_center_name, c.* FROM chains c left join distribution_centers dc on c.chain_distribution_center_id = dc.distribution_center_id WHERE c.chain_id = ?';
            $row = $db->GetRow($sql,array($chain_id));
            $this->params = $row;
        }
        
        public static function getChainTypes() {

            $import_types = array();
            $import_types[] = array('key' => 'web_based', 'label' => 'Web User');
            $import_types[] = array('key' => 'import_generic', 'label' => 'Generic Import Template');
            $import_types[] = array('key' => 'import_dallas', 'label' => 'Dallas Import Template');
            $import_types[] = array('key' => 'import_arlington', 'label' => 'Arlington Import Template');
            $import_types[] = array('key' => 'import_hisd', 'label' => 'HISD Import Template');
            $import_types[] = array('key' => 'import_fwisd', 'label' => 'FWISD Import Template');
            return $import_types;
            
        }
        

        public static function getCustomerNumbers($chain_id) {
            $db = getDb();
            $sql = 'SELECT customer_number, customer_id FROM customers WHERE chain_id = ?';
            $rs = $db->Execute($sql,array($chain_id));
            $rows = $rs->GetRows();
            $customers = array();
            foreach($rows as $row) {
                $customers[$row['customer_id']] = $row['customer_number'];
            }
            return $customers;
        }

        public static function getHolidayDays($chain_id,$week_start,$week_end) {
//            $sql = 'select * from substitute_days
//                     where customer_id = ?
//                     and original_date between ? and ?';

            $sql = 'select sd.* from substitute_days sd
                    left join customers c on c.customer_id = sd.customer_id
                    where c.chain_id = ? 
                    and original_date between ? and ?';


            $db = getDb();
            $rs = $db->Execute($sql,array($chain_id,$week_start,$week_end));
            $rows = $rs->GetRows();

            $days = array();
            foreach($rows as $row) {
                $original_date = $row['original_date'];
                $customer_id = $row['customer_id'];
                $row['original_dow'] = date('l',strtotime($original_date));
                $days[$customer_id][$row['original_date']] = $row;
            }
            return $days;
        }

        public static function getSubstituteDays($chain_id,$week_start,$week_end) {
//            $sql = 'select * from substitute_days
//                     where customer_id = ?
//                     and alternate_date between ? and ?';
            $sql = 'select sd.* from substitute_days sd
                    left join customers c on c.customer_id = sd.customer_id
                    where c.chain_id = ? 
                    and alternate_date between ? and ?';

            $db = getDb();
            $rs = $db->Execute($sql,array($chain_id,$week_start,$week_end));
            $rows = $rs->GetRows();
            $days = array();
            foreach($rows as $row) {
                $alternate_date = $row['alternate_date'];
                $customer_id = $row['customer_id'];                
                $row['alternate_dow'] = date('l',strtotime($alternate_date));
                $days[$customer_id][$row['alternate_date']] = $row;
            }
            return $days;
        }

        
	public static function getAll($chain_ids = array()) {
		$db = getDb();
                $sql = 'select dc.distribution_center_name,c.* from chains c left join distribution_centers dc on c.chain_distribution_center_id = dc.distribution_center_id ';
                
                if(count($chain_ids) > 0) {
                    $chain_id_string = implode(',',$chain_ids);
                    $sql .= ' WHERE c.chain_id in (' . $chain_id_string . ') ';
                }
                
                
                $sql .= ' ORDER BY c.chain_name';
                
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}
        
        public static function getImportChains() {
		$db = getDb();
                $sql= 'select dc.distribution_center_name,c.* from chains c left join distribution_centers dc on c.chain_distribution_center_id = dc.distribution_center_id 
where chain_type <> \'\' and chain_type <> \'web_user\'
ORDER BY c.chain_name';
                
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
            
        }


	public static function getProducts($chain_id) {
		$db = getDb();
//		$sql = 'SELECT * FROM chain_products WHERE chain_id = ? ORDER BY product_name';
		$sql = 'select p.*,cp.chain_p_id from chain_products cp
				left join products p on cp.product_id = p.product_id
				where cp.chain_id = ?
				ORDER BY p.product_name';
		$rs = $db->Execute($sql,array($chain_id));
		$rows = $rs->GetRows();
		return $rows;
	}

        
        public static function clearProducts($chain_id) {
            $db = getDb();
            $sql = 'DELETE FROM chain_products WHERE chain_id = ?';
            $rs = $db->Execute($sql,array($chain_id));
        }
        
        public static function setProducts($chain_id,$product_ids,$chain_product_ids) {
            $db = getDb();
            foreach($product_ids as $product_id) {
                $chain_product_id = $chain_product_ids[$product_id];
                $sql = 'INSERT INTO chain_products (chain_id,product_id,chain_p_id) VALUES(?,?,?)';
                $rs = $db->Execute($sql,array($chain_id,$product_id,$chain_product_id));
            }
        }
        
        public static function getAllProducts($chain_id) {
            $db = getDb();

            

            $sql = 'select ch.chain_p_id,pc.*,sc.*,prod.* from 
chain_products ch left join products prod on ch.product_id = prod.product_id 
left join chains c on c.chain_id = ch.chain_id
left join product_categories pc on prod.product_category_id = pc.product_category_id
left join product_sub_categories sc on prod.product_sub_category_id = sc.product_sub_category_id
where ch.chain_id = ?
AND c.chain_active = 1
AND prod.product_active = 1
ORDER by pc.display_order, sc.product_sub_category_display_order,prod.display_order
';
            
            $rs = $db->Execute($sql,array($chain_id));
            $rows = $rs->GetRows();
            return $rows;
        }            
        
        
	public static function getSchools($chain_id) {
		$db = getDb();
		$sql = 'select ch.chain_name,c.* from customers c left join chains ch on c.chain_id = ch.chain_id where c.chain_id = ? ORDER by ch.chain_name,c.customer_name';
		$rs = $db->Execute($sql,array($chain_id));
		$rows = $rs->GetRows();
		return $rows;
	}

	public static function getSchoolCounts() {
		$db = getDb();
		$sql = 'select count(*) as school_count, chain_id from customers group by chain_id';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();

		$chains = array();

		foreach($rows as $row) {
			$chains[$row['chain_id']] = $row['school_count'];
		}
		return $chains;
	}
        
        public static function getChainManagers($chain_id) {
            $db = getDb();
            $sql = 'select u.* from chain_users cu
            left join users u on cu.user_id = u.user_id
            where chain_id = ?
            and u.user_role = ?';
            $rs = $db->Execute($sql,array($chain_id,'chain-manager'));
            $rows = $rs->GetRows();
            return $rows;
        }

        public static function getCustomerRoutes($chain_id) {
            $db = getDb();
            $sql = 'select r.* from routes r 
                    left join customers c on r.customer_id = c.customer_id
                    where c.chain_id = ?';
            $rs = $db->Execute($sql,array($chain_id));
            $rows = $rs->GetRows();
            return $rows;

        }

}
    
?>
