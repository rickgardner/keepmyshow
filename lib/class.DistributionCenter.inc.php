<?php
class DistributionCenter extends BaseObject {

	function DistributionCenter($_params = array()) {
		parent::BaseObject($_params, 'distribution_centers', 'distribution_center_id');
	}

	public static function getAll() {
		$db = getDb();
		$sql = 'SELECT * FROM distribution_centers ORDER BY distribution_center_name';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}
}
    
?>
