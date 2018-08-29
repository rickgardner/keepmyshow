<?php
class Report extends BaseObject {

	function Report($_params = array()) {
	}
        
	public static function missingRouteCustomers($count_only = false) {
	  $db = getDb();
	    if($count_only) {

              $sql = 'select count(distinct(r.`customer_id`)) from routes r
                    left join customers c on c.customer_id = r.customer_id
                    left join chains h on h.`chain_id` = c.`chain_id`
                    where h.`chain_id` is null
                    order by r.`customer_id`';
	      $count = $db->GetOne($sql);
	      return $count;
	    } else {

 
          $sql = 'select r.`customer_id` from routes r
                    left join customers c on c.customer_id = r.customer_id
                    left join chains h on h.`chain_id` = c.`chain_id`
                    where h.`chain_id` is null
                    order by r.`customer_id`';
              $rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	    }

	}
        
        public static function customersMissingRoutes($count_only = false) {
            $db = getDb();
            if($count_only) {
                $sql = 'select count(c.customer_id) from customers c
left join routes r on c.customer_id = r.customer_id
left join chains ch on ch.chain_id = c.chain_id
where
 r.customer_id is null
and c.customer_active = 1
and ch.chain_active = 1';
                $count = $db->GetOne($sql);
                return $count;
            } else {
                $sql = 'select c.* from customers c
left join routes r on c.customer_id = r.customer_id
left join chains ch on ch.chain_id = c.chain_id
where
 r.customer_id is null
and c.customer_active = 1
and ch.chain_active = 1';
                $rs = $db->Execute($sql);
                $rows = $rs->GetRows();
                return $rows;
                
            }
        }

}
    
?>
