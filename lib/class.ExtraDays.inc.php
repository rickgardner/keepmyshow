<?php

class ExtraDays {
	// placeholder for static functions


	public function ExtraDays() {
		// Do nothing
	}

	public static function getChainCount() {
		$db = getDb();
		$sql = 'select c.chain_id,count(*) as num_customers from customers c inner join 
(select distinct(c.chain_id) from extra_days ed 
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
		$sql = 'select ch.chain_id,ch.chain_name,ch.chain_number,ed.extra_date,ed.reason,count(ed.customer_id) as num_customers from extra_days ed 
left join customers c on ed.customer_id = c.customer_id
left join chains ch on c.chain_id = ch.chain_id
group by ch.chain_name,ch.chain_number,ed.extra_date,ed.reason order by ed.extra_date desc';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}

	public static function getExtraDaysForChainAndDate($chain_id,$extra_date) {
		$db = getDb();

		$sql = 'SELECT * FROM extra_days d left join customers c on d.customer_id = c.customer_id where c.chain_id = ? and extra_date = ?';
		$rs = $db->Execute($sql,array($chain_id,$extra_date));
		$rows = $rs->GetRows();
		return $rows;
	}

	public static function getExtraDays($customer_id,$week_start,$week_end) {
		$db = getDb();
		$sql = 'select extra_date,reason from extra_days where extra_date between ? and ?
				and customer_id = ?';
		$rs = $db->Execute($sql,array($week_start,$week_end,$customer_id));
		$rows = $rs->GetRows();


		for($i = 0; $i < count($rows); $i++) {
			$extra_date = $rows[$i]['extra_date'];
			$extra_date_ts = strtotime($extra_date);
			$extra_date_dow = date('l',$extra_date_ts);
			$rows[$i]['dow'] = $extra_date_dow;
		}

		return $rows;
	}


	public static function addExtra($customer_id,$extra_date,$reason) {
		$db = getDb();
		$sql = 'REPLACE INTO extra_days (customer_id, extra_date, reason) VALUES(?,?,?)';
		$rs = $db->Execute($sql,array($customer_id,$extra_date,$reason));
	}

	public static function removeExtra($customer_id,$extra_date) {
		$db = getDb();
		$sql = 'DELETE FROM extra_days WHERE customer_id = ? AND extra_date = ?';
		$rs = $db->Execute($sql,array($customer_id,$extra_date));
	}

}

?>