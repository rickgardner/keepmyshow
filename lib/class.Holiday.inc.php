<?php
class Holiday extends BaseObject {

	function Holiday($_params = array()) {
		parent::BaseObject($_params, 'holidays', 'holiday_id');
	}

	public static function getAll() {
		$db = getDb();
		$sql = 'SELECT * FROM holidays';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}


	public function getChains() {
		$db = getDb();
		$sql = 'SELECT chain_id FROM chain_holidays WHERE holiday_id = ?';
		$rs = $db->Execute($sql,array($this->params['holiday_id']));
		$rows = $rs->GetRows();

		$chains = array();
		foreach($rows as $row) {
			$chains[$row['chain_id']] = $row['chain_id'];
		}

		return $chains;
	}

	public function setChains($chains) {
		$this->clearChains();
		$db = getDb();
		foreach($chains as $chain_id) {
			$sql = 'INSERT INTO chain_holidays (holiday_id,chain_id) VALUES(?,?)';
			$rs = $db->Execute($sql,array($this->params['holiday_id'],$chain_id));
		}
	}

	public function addWeek($year_week) {
		$db = getDb();
		$sql = 'INSERT IGNORE into holiday_weeks (holiday_id,holiday_week_year) VALUES(?,?)';
		$rs = $db->Execute($sql,array($this->params['holiday_id'],$year_week));
	}

	public function removeWeek($year_week) {
		$db = getDb();
		$sql = 'DELETE FROM holiday_weeks WHERE holiday_id = ? AND holiday_week_year = ?';
		$rs = $db->Execute($sql,array($this->params['holiday_id'],$year_week));
	}


	public function getWeeks() {
		$db = getDb();
		$sql = 'SELECT * FROM holiday_weeks WHERE holiday_id = ? ORDER BY holiday_week_year asc';
		$rs = $db->Execute($sql,array($this->params['holiday_id']));
		$rows = $rs->GetRows();
		return $rows;
	}

	public function clearChains() {
		$db = getDb();
		$sql = 'DELETE FROM chain_holidays WHERE holiday_id = ?';
		$rs = $db->Execute($sql,array($this->params['holiday_id']));
	}

}
?>
