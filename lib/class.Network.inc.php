<?php
class Network extends BaseObject {

	function Network($_params = array()) {
		parent::BaseObject($_params, 'networks', 'id');
	}

	public static function getAll() {
		$db = getDb();
		$sql = 'SELECT distinct(network_name) from networks order by network_name';
		$rs = $db->Execute($sql);
		$rows = $rs->getRows();
		return $rows;
	}

}
?>