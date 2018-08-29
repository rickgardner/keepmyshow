<?php

class RouteOverride {
	// placeholder for static functions


	public function RouteOverride() {
		// Do nothing
	}

	public static function getChainCount() {
		$db = getDb();
		$sql = 'select c.chain_id,count(*) as num_customers from customers c inner join 
(select distinct(c.chain_id) from route_overrides ed 
left join customers c on ed.customer_id = c.customer_id) as ch
on c.chain_id = ch.chain_id
group by c.chain_id
';
	$rs = $db->Execute($sql);
	$rows = $rs->GetRows();
	return $rows;
	}

	public static function getExtraDayList() {
		$db = getDb();
		$sql = 'select ch.chain_id,ch.chain_name,ch.chain_number,ed.week_start,ed.reason,count(ed.customer_id) as num_customers from route_overrides ed 
left join customers c on ed.customer_id = c.customer_id
left join chains ch on c.chain_id = ch.chain_id
group by ch.chain_name,ch.chain_number,ed.week_start,ed.reason order by ed.week_start desc';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}

	public static function getOverridesForChainAndDate($chain_id,$week_start) {
		$db = getDb();

		$sql = 'SELECT * FROM route_overrides d left join customers c on d.customer_id = c.customer_id where c.chain_id = ? and week_start = ?';
		$rs = $db->Execute($sql,array($chain_id,$week_start));
		$rows = $rs->GetRows();
		return $rows;
	}

	public static function getRouteOverrides($customer_id,$week_start,$week_end) {
		$db = getDb();
		$sql = 'select week_start,reason,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday from route_overrides where week_start between ? and ?
				and customer_id = ?';
		$row = $db->GetRow($sql,array($week_start,$week_end,$customer_id));
		return $row;
	}


	public static function addOverride($customer_id,$week_start,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday,$reason) {
		$db = getDb();
		$sql = 'REPLACE INTO route_overrides (customer_id, week_start, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday, reason) VALUES(?,?,?,?,?,?,?,?,?,?)';
		$rs = $db->Execute($sql,array($customer_id,$week_start,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday,$reason));
	}

	public static function removeOverride($customer_id,$week_start) {
		$db = getDb();
		$sql = 'DELETE FROM route_overrides WHERE customer_id = ? AND week_start = ?';
		$rs = $db->Execute($sql,array($customer_id,$week_start));
	}

}

?>