<?php
class ConfigDeadline {

	function ConfigDeadline() {
	}
        
        public static function getDeadline() {
            $sql = 'SELECT * FROM config_deadlines';
            $db = getDb();
            $row = $db->GetRow($sql);
            return $row;
        }
        
        public static function setDeadline($days,$hours) {
            $sql = 'DELETE FROM config_deadlines';
            $db = getDb();
            $rs = $db->Execute($sql);

            $sql = 'INSERT INTO config_deadlines(days,times) values(?,?)';
            $rs = $db->Execute($sql,array($days,$hours));
        }
        
}



?>
