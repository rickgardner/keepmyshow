<?php

class SubstituteDays {
	// placeholder for static functions


	public function SubstituteDays() {
		// Do nothing
	}


	public static function addSubstitute($customer_id,$original_date,$alternate_date,$days,$reason = '') {
		$db = getDb();
		if($alternate_date == 'NONE') {
			$alternate_date = null;
		}
		$sql = 'REPLACE INTO substitute_days (customer_id, original_date, alternate_date, reason,days) VALUES(?,?,?,?,?)';
		$rs = $db->Execute($sql,array($customer_id,$original_date,$alternate_date,$reason,$days));
	}

	public static function removeSubstitute($customer_id,$original_date) {
		$db = getDb();

		$sql = 'DELETE FROM substitute_days WHERE customer_id = ? AND original_date = ?';
		$rs = $db->Execute($sql,array($customer_id,$original_date));
	}

}

?>