<?php
class Product extends BaseObject {

	function Product($_params = array()) {
		parent::BaseObject($_params, 'products', 'product_id');
	}

        
        public static function getBySku($sku) {
            $db = getDb();
            $sql = 'SELECT * FROM products WHERE sku = ?';
            $row = $db->GetRow($sql,array($sku));
            return $row;
        }
        
	public static function getAll($active_only=false) {
		$db = getDb();
                $sql = 'SELECT * FROM products p 
                    left join bakeries b on p.bakery_id = b.bakery_id 
left join product_categories pc on p.product_category_id = pc.product_category_id
left join product_sub_categories sc on sc.product_sub_category_id = p.product_sub_category_id ';
          
                if($active_only) {
                    $sql .= ' WHERE p.product_active = 1 ';
                }
                
$sql .= ' ORDER BY p.bakery, pc.display_order, sc.product_sub_category_display_order,p.display_order';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}
        
        public function get($product_id) {
            $db = getDb();
                $sql = 'SELECT b.bakery_name,p.*,pc.product_category_name,sc.product_sub_category_name FROM products p 
left join bakeries b on p.bakery_id = b.bakery_id 
left join product_categories pc on p.product_category_id = pc.product_category_id
left join product_sub_categories sc on sc.product_sub_category_id = p.product_sub_category_id
WHERE p.product_id = ?
';
                
                $row = $db->GetRow($sql,array($product_id));
                
                $product_code = (int)$row['product_code'];
                if($product_code == 0) {
                    $row['product_code'] = $row['product_id'];
                }
                
                $product_category_id = (int)$row['product_category_id'];
                $product_sub_category_id = (int)$row['product_sub_category_id'];
                
                
                
                $row['compound_category_key'] = (int)$row['product_category_id'].'-'.(int)$row['product_sub_category_id'];
                $row['compound_category_name'] = $row['product_category_name'];
                if($row['product_sub_category_name'] != '') {
                    $row['compound_category_name'] .= '-' . $row['product_sub_category_name'];
                }
                $this->params = $row;
            
        }
        
        

}
    
?>