<?php
class Language extends BaseObject {

	function Language($_params = array()) {
		parent::BaseObject($_params, 'languages', 'language_id');
	}

	public static function getAll() {
		$db = getDb();
		$sql = 'SELECT distinct(language_name) from languages order by language_name';
		$rs = $db->Execute($sql);
		$rows = $rs->getRows();
		return $rows;
	}	
}
?>