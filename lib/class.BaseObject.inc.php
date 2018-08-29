<?php

class BaseObject {

    var $params;
    var $tblname;
    var $pkname;

    function BaseObject($_params, $_tablename, $_pkname = 'id') {
        $this->params = $_params;
        $this->tblname = $_tablename;
        $this->pkname = $_pkname;
    }

    function isNew() {
        $id = (int) $this->params[$this->pkname];
        return ($id == 0);
    }

    function get($_id) {
        $sql = 'SELECT * FROM ' . $this->tblname . ' WHERE ' . $this->pkname . ' = ?';
        $db = getDb();
        $rs = $db->Execute($sql, array($_id));
        $rows = $rs->GetRows();
        if(count($rows) > 0) {
            $row = $rows[0];
        } else {
            $row = array();
        }
        $this->params = $row;
    }

    function getNextId() {
        $db = getDb();
    $db->debug = true;
        $sql = 'SELECT MAX(' . $this->pkname . ') as id FROM ' . $this->tblname;
        $rs = $db->Execute($sql);
        $rows = $rs->GetRows();
        return ((int) $rows[0]['id'] + 1);
    }

    public static function FindOrCreateByName($name, $table, $field_name = 'name') {
        $db = getDb();
//        $db->debug = true;
        $sql = 'SELECT * FROM ' . $table . ' WHERE lower(' . $field_name . ') = lower(?)';
        $row = $db->GetRow($sql, array($name));

        if (count($row) > 0) {
            return $row;
        } else {
            $obj = new BaseObject(array($field_name => $name), $table);
            $obj->save();
            $sql = 'SELECT * FROM ' . $table . ' WHERE lower(' . $field_name . ') = lower(?)';
            $row = $db->GetRow($sql, array($name));
            return $row;
        }
    }

        function save($db = null) {
        if ($db == null) {
                $db = getDb();
        }
        $db->debug = true;

        if ($this->isNew()) {
            $this->params['created_at'] = time();
            $this->params['insert_timestamp'] = $this->params['created_at'];
            $this->params['updated_at'] = time();
            $this->params['last_update_timestamp'] = $this->params['updated_at'];
            $this->params[$this->pkname] = $this->getNextId();
            $dummysql = 'SELECT * FROM ' . $this->tblname . ' WHERE 1 = 2';

            // echo "Inside the save method<Br />";
            // echo "<pre>";
            // print_r($this->params);
            // echo "</pre>";

            $rs = $db->Execute($dummysql);
            $insertsql = $db->GetInsertSql($rs, $this->params);

            $db->Execute($insertsql);
        } else {

            $dummysql = 'SELECT * FROM ' . $this->tblname . ' WHERE ' . $this->pkname . ' = ?';

            $rs = $db->Execute($dummysql, array($this->params[$this->pkname]));

            $updatesql = $db->GetUpdateSql($rs, $this->params);
            if (trim($updatesql) != '') {
                $this->params['updated_at'] = time();
                $this->params['last_update_timestamp'] = $this->params['updated_at'];
                $updatesql = $db->GetUpdateSql($rs, $this->params);
                // var_dump( $updatesql); die();
                $db->Execute($updatesql);
            }
        }
        return $this->params[$this->pkname];
    }
}
?>