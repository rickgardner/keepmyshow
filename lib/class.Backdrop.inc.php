<?php
class Backdrop extends BaseObject {

	function Backdrop($_params = array()) {
		parent::BaseObject($_params, 'backdrops', 'id');
	}

	public static function findByPathAndShowId($file_path,$show_id) {
		$db = getDb();
		$sql = 'SELECT * FROM backdrops WHERE file_path = ? and show_id = ?';
		$rs = $db->Execute($sql,array($file_path,$show_id));
		$rows = $rs->GetRows();
		return $rows;
	}

	function isNew() {
		$existing = Backdrop::findByPathAndShowId($this->params['file_path'],$this->params['show_id']);
		return (count($existing) == 0);
	}

	public static function getImagesByShowAndType($show_id,$type) {
		$db = getDb();
		$sql = 'SELECT * FROM backdrops WHERE show_id = ? and type = ?';
		$rs = $db->Execute($sql,array($show_id,$type));
		$rows = $rs->GetRows();
		return $rows;
	}

}
?>