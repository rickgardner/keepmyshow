<?php
class Genre extends BaseObject {

	function Genre($_params = array()) {
		parent::BaseObject($_params, 'genres', 'genre_id');
	}

	public static function getAll() {
		$db = getDb();
		$sql = 'SELECT distinct(genre_name) from genres order by genre_name';
		$rs = $db->Execute($sql);
		$rows = $rs->getRows();
		return $rows;
	}

}
?>