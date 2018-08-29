<?php
class Bakery extends BaseObject {

	function Bakery($_params = array()) {
		parent::BaseObject($_params, 'bakeries', 'bakery_id');
	}
        
        public static function getAll() {
            $db = getDb();
            $sql = 'SELECT * FROM bakeries ORDER by bakery_name';
            $rs = $db->Execute($sql);
            $rows = $rs->GetRows();
            return $rows;
            
        }

}
    
?>
