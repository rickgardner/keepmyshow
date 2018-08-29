<?php

class Activity {
    
    public function Activity() {
    }
    
    // customer_id
    // user_id
    // object_class
    // object_id
    // activity
    
    
    public static function Log($customer_id,$object_class,$object_id,$activity) {
        $user_id = getUserAttribute('user_id');
        $db = getDb();
        //$db->debug = true;
        $sql = 'INSERT INTO activities ';
        $sql .= '(user_id,customer_id,object_class,object_id,activity,created_at) ';
        $sql .= 'values(?,?,?,?,?,now())';
        $db->Execute($sql,array($user_id,$customer_id,$object_class,$object_id,$activity));
        //exit;
    }
    
    public static function getAll($filter = array()) {
        $db = getDb();
        $sql = 'SELECT * FROM activities ORDER BY created_at DESC';
        
$sql = 'select * from activities a 
left join users u on a.user_id = u.user_id
left join customers c on a.customer_id = c.customer_id
left join chains ch on c.chain_id = ch.chain_id';
$conds = array();
$args = array();
while(list($key,$val) = each($filter)) {
//    echo "$key = $val<br />";
    if($val != '' || $val != 0) {
        $conds[] = "$key = ?";
        $args[] = $val;
    }
}
if(count($conds) > 0) {
    $sql .= ' WHERE ' . implode(' AND ', $conds);
}

$sql .= ' ORDER BY created_at DESC';        
        $rs = $db->Execute($sql,$args);
        $rows = $rs->GetRows();
        //exit;
        return $rows;
    }
    
}

?>