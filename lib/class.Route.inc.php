<?php
class Route extends BaseObject {

	function Route($_params = array()) {
		parent::BaseObject($_params, 'routes', 'route_id');
	}

	public static function getAll() {
		$db = getDb();
                $sql = 'select count(Stop) as stops,route_id,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday from ' . 
                       ' routes group by route_id';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows;
	}

	public static function getByCustomerId($customer_id) {
		$db = getDb();
		$sql = 'SELECT * FROM routes WHERE customer_id = ?';
		$row = $db->GetRow($sql,array($customer_id));
                
                $days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');

                $first_delivery_date = '';
                $has_days = array();
                foreach($days as $day) {
                    $key = 'has_' . strtolower($day);
                    $row[$key] = $row[$day] == 1;
                    if($row[$day] == 1) {
                        if($first_delivery_date == '') {
                            $first_delivery_date = $day;
                        }
                        $has_days[] = $day;
                    }
                }
                $row['first_delivery_date'] = $first_delivery_date;
                $row['has_days'] = implode('/',$has_days);
                $row['day_count'] = count($has_days);
		return $row;
	}

	public static function getStopsByRoute($route_id) {
		$db = getDb();
		$sql = 'select * from routes r join customers c on r.customer_id = c.customer_id where r.route_id = ? ORDER by r.Stop';
		$rs = $db->Execute($sql,array($route_id));
		$rows = $rs->GetRows();
		return $rows;
	}
        
        public static function getStop($route_id,$stop) {
            $db = getDb();
            $sql = 'SELECT * FROM routes WHERE route_id = ? AND Stop = ?';
            $row = $db->GetRow($sql,array($route_id,$stop,$customer_id));
            return $row;
        }
        
        public static function getStopByCustomerId($customer_id) {
            $db = getDb();
            $sql = 'SELECT * FROM routes WHERE customer_id = ?';
            $row = $db->GetRow($sql,array($customer_id));
            return $row;
        }
        
        public static function insertNewStop($route_id,$stop,$new_stop) {
            $db = getDb();
            $sql = 'SELECT * FROM routes WHERE 1 = 2';
            $rs = $db->Execute($sql);
            $insert_sql = $db->GetInsertSql($rs,$new_stop);
            $db->Execute($insert_sql);
        }
        
        public static function updateRouteMetaData($route_id,$stop,$new_stop) {
            $db = getDb();
            $sql = 'SELECT * FROM routes WHERE route_id = ? AND Stop = ?';
            $rs = $db->Execute($sql,array($route_id,$stop));
            
            unset($new_stop['route_id']);
            unset($new_stop['stop']);
            
            $update_sql = $db->GetUpdateSql($rs,$new_stop);
            if(trim($update_sql) != '') {
                $db->Execute($update_sql);
            }
        }
       
       public static function getStops($route_id) {
            $db = getDb();
            $sql = 'SELECT * FROM routes WHERE route_id = ? ORDER BY Stop';
            $rs = $db->Execute($sql,array($route_id));
            $rows = $rs->GetRows();
            return $rows;
       }
       
       
       public static function setStops($route_id,$records) {
//           echo "<pre>";
//           print_r($records);
//           echo "</pre>";
           $db = getDb();
//           $db->debug = true;
           // first remove everything from that route
           $sql = 'DELETE FROM routes WHERE route_id = ?';
           $rs = $db->Execute($sql,array($route_id));
           
           $dummy_sql = 'SELECT * FROM routes WHERE 1 = 2';
           $dummy_rs = $db->Execute($dummy_sql);
           $stop = 1;
           foreach($records as $record) {
               $record['Stop'] = $stop;
               $insert_sql = $db->GetInsertSql($dummy_rs,$record);
               $db->Execute($insert_sql);
               $stop++;
           }
       }
       
       public static function addStop($stops,$new_stop) {
            $new_records = array();
            $record_added = false;
            foreach($stops as $row) {
                $stop = $row['Stop'];
                if($stop != $new_stop['Stop']) {
                    $new_records[] = $row;
                } else {
                    $record_added = true;
                    $new_records[] = $new_stop;
                    $new_records[] = $row;
                }
            }
            if($record_added == false) {
                $new_records[] = $new_stop;
            }
            return $new_records;
       }

       public static function removeStop($stops,$old_stop_pos) {
//           echo "Removing stop = $old_stop_pos from <pre>";
//           print_r($stops);
//           echo "</pre>";
            $new_records = array();
            foreach($stops as $row) {
                $stop = $row['Stop'];
                if($stop != $old_stop_pos) {
                    $new_records[] = $row;
                }
            }
            
//            echo "About to return <pre>";
//            print_r($new_records);
//            echo "</pre>";
//            exit;
            return $new_records;
           
       }
       

}
    
?>
