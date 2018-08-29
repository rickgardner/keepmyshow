<?php
class Config extends BaseObject {

	function Config($_params = array()) {
		parent::BaseObject($_params, 'configs', 'config_id');
	}
        
    public static function getConfigValue($key) {
        $db = getDb();
        $sql = 'SELECT config_value FROM configs WHERE lower(config_name) = lower(?)';
        $value = $db->GetOne($sql,array($key));
        return $value;
    }

    public static function clearConfigValue($key) {
        $db = getDb();
        $sql = 'DELETE FROM configs WHERE lower(config_name) = lower(?)';
        $rs = $db->Execute($sql,array($key));
    }

    public static function setConfigValue($key,$val) {
        $db = getDb();
        $sql = 'REPLACE INTO configs (config_name,config_value) VALUES(?,?)';
        $rs = $db->Execute($sql,array($key,$val));
    }



}
    
?>
