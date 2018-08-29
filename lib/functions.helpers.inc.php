<?php


function getGetVar($key) {
	if(isset($_GET[$key])) {
		return trim($_GET[$key]);
	}
	return null;
}


function serializeRecords($records) {
    $good_records = array();
    while(list($customer_id,$record) = each($records)) {
        while(list($customer_order_id,$r) = each($record)) {
            if($r['status'] != 'BAD') {
                $good_records[$customer_id][$customer_order_id] = $r;
            }
        }
    }
    $serialized = serialize($good_records);
    return $serialized;
}

function getPostVar($key) {
	if(isset($_POST[$key])) {
		return $_POST[$key];
	}
	return null;
}

function setUserAttribute($att,$val) {
    global $tool_user;
    $_SESSION['USER'][$att] = $val;
    $tool_user = $_SESSION['USER'];
}

function getUserAttribute($att) {
    $return_val = null;
    if(isset($_SESSION['USER']) && isset($_SESSION['USER'][$att])) {
        $return_val = $_SESSION['USER'][$att];
    }
    return $return_val;
}

function getDeadlineOffset($week_start) {


        $deadline_string = 'last saturday - 1 second';
        $active_customer_id = getUserAttribute('active_customer_id');
        if($active_customer_id == 0) {
            //die("no active customer id being set!");
        }
    
        $routes = Route::getByCustomerId($active_customer_id);

        $has_days = $routes['has_days'];
        $day_count = $routes['day_count'];

        $role = getUserAttribute('user_role');

        $deadline_day = getUserAttribute('deadline_day');
        $deadline_hour = getUserAttribute('deadline_hour');

        $user_id  = getUserAttribute('user_id');

        // check here to override deadline



        $deadline_override = DeadlineOverride::getUserOverride($user_id,$week_start);
        if(count($deadline_override) > 0) {

            $deadline_day = $deadline_override['deadline_day'];
            $deadline_hour = $deadline_override['deadline_hour'];
        }



        
        $hour_pieces = explode(":",$deadline_hour);
        $hour = (int)$hour_pieces[0];
        
        $deadline_string = 'last ' . strtolower($deadline_day) . ' + ' . $hour . ' hours';
        

         return $deadline_string;
 
}

function findWeekStart($adate) {
    $in_date_string = strtotime($adate);

        if(date('D',$in_date_string) == 'Mon') {
            $start_of_week = $in_date_string;
        } else {
            $start_of_week = strtotime('last monday',$in_date_string);
        }
    return $start_of_week;    
}


function getTimePeriod($adate) {
        $start_of_week = findWeekStart($adate);
        $start_of_week_fmt = date('Y-m-d',$start_of_week);

        $deadline_offset = getDeadlineOffset($start_of_week_fmt);
	// adate will be of Y-m-d format.
	$in_date_string = strtotime($adate);

//        if(date('D',$in_date_string) == 'Mon') {
//            $start_of_week = $in_date_string;
//        } else {
//            $start_of_week = strtotime('last monday',$in_date_string);
//        }

        
        $ret = array();
        $ret['current_time'] = time();
        
        $order_deadline = strtotime($deadline_offset,$start_of_week);
        $order_deadline_str = date('l, M d, Y h:i:s A',$order_deadline);
        $ret['order_deadline_str'] = $order_deadline_str;
        $ret['order_deadline'] = $order_deadline;
        
        $ret['current_deadline'] = strtotime($deadline_offset,$ret['current_time']);
        $ret['current_order_period'] = strtotime('next monday + 1 week',$ret['current_deadline']);
        $ret['current_order_period_str'] = date('Y-m-d',$ret['current_order_period']);
        
        $end_of_week = strtotime('this saturday',$start_of_week);
        
        

        $sM = date('M', $start_of_week);
        $sD = date('d', $start_of_week);
        $sY = date('Y', $start_of_week);
        
        $eM = date('M', $end_of_week);
        $eD = date('d', $end_of_week);
        $eY = date('Y', $end_of_week);

        $sW = $sY . '-' . date('W', $start_of_week);
        $eW = $sY . '-' . date('W', $end_of_week);


        $display_string = '';
        
        
        if($sY == $eY) {
            // same Month
            if($sM == $eM) {
                $display_string = "$sM $sD-$eD, $sY";
            } else {
                $display_string = "$sM $sD - $eM $eD, $sY";
            }
        } else {
            $display_string = "$sM $sD, $sY - $eM $eD, $eY";
        }
        
        $ret['display_string'] = $display_string;
        
        $start_of_week_str = date('M d, Y',$start_of_week);
        $ret['start_of_week_fmt'] = date('Y-m-d',$start_of_week);
        $end_of_week_str   = date('M d, Y',$end_of_week);
        $ret['start_of_week_str'] = $start_of_week_str;
        $ret['end_of_week_str'] = $end_of_week_str;
        $ret['start_time'] = $start_of_week;
        $ret['end_time'] = $end_of_week;
        $ret['end_of_week_fmt'] = date('Y-m-d',$end_of_week);


    $ret['year_week'] = $sW;

	$ret['last_period'] = date('Y-m-d',strtotime('-1 weeks',$ret['start_time']));
	$ret['next_period'] = date('Y-m-d',strtotime('1 week',$ret['start_time']));


	$days = array();

$dowMap = array(' ', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');

for($i = $ret['start_time']; $i <= $ret['end_time']; $i+=86400) {
//	echo "i = $i<br />";
//	$ts = $ret['start_time'] + ($i*86400);
	$d['date'] = date( 'Y-m-d', $i );
	$d['short_date'] = date('m/d',$i);
        $d['short_date_lng'] = date('m-d-Y',$i);
	$dow = date('N',$i);
	$d['dow'] = $dowMap[$dow];
	$ret['days'][] = $d;
}

if($_GET['debug'] == 'true') {
echo "<!--pre>";
print_r($ret);
echo "</pre -->";
}
	return $ret;
}

function mysqlToNiceDate($mysql_date) {
    $ts = strtotime($mysql_date);
    $nice = date('M d, Y',$ts);
    return $nice;
}

function exportCSV($fields,$rows,$file_name) {
    header('Content-Type: application/excel');
    header('Content-Disposition: attachment; filename="' . $file_name . '"');

    $fp = fopen('php://output', 'w');

    fputcsv($fp, $fields);
    foreach ($rows as $entry ) {
        $e = array();
        while(list($key,$val) = each($fields)) {
            $e[] = $entry[$key];
        }
        fputcsv($fp, $e);
        reset($fields);
    }
    fclose($fp);    
}

function order_days(&$days_ary) {
    $out_array = array();
    foreach($days_ary as $day) {
        $out_array[array_search($day,array('monday','tuesday', 'wednesday', 'thursday', 'friday'))] = $day;
    }
    ksort($out_array);
    $days_ary = $out_array;
}

function depth_picker($arr, $temp_string, &$collect) {
    if ($temp_string != "") 
        $collect []= $temp_string;

    for ($i=0; $i<sizeof($arr);$i++) {
        $arrcopy = $arr;
        $elem = array_splice($arrcopy, $i, 1); 
        if (sizeof($arrcopy) > 0) {
            depth_picker($arrcopy, $temp_string ."/" . $elem[0], $collect);
        } else {
            $collect []= $temp_string. "/" . $elem[0];
        }   
    }   
}

function days($args,$chain_id = 0) {

    $monday = $args[0];
    $tuesday = $args[1];
    $wednesday = $args[2];
    $thursday = $args[3];
    $friday = $args[4];
    $params = array($monday,$tuesday,$wednesday,$thursday,$friday);

        $sql = 'select count(*) as num_schools from routes r 
    left join customers c on r.customer_id = c.customer_id
    left join chains ch on c.chain_id = ch.chain_id
    where ch.chain_type = \'web_based\'
    and coalesce(r.Monday,0) = ?
    and coalesce(r.Tuesday,0) = ?
    and coalesce(r.Wednesday,0) = ?
    and coalesce(r.Thursday,0) = ?
    and coalesce(r.Friday,0) = ?
    ';

    if($chain_id > 0) {
        $sql .= ' AND ch.chain_id = ?';
        $params[] = $chain_id;
    }

    $db = getDb();
    $rs = $db->Execute($sql,$params);
    $rows = $rs->GetRows();
    return $rows[0][0];
}

function customers_with_days($args,$original_date) {
    $monday = $args[0];
    $tuesday = $args[1];
    $wednesday = $args[2];
    $thursday = $args[3];
    $friday = $args[4];

        $sql_old = 'select c.*,ch.* from routes r 
    left join customers c on r.customer_id = c.customer_id
    left join chains ch on c.chain_id = ch.chain_id
    where coalesce(r.Monday,0) = ?
    and coalesce(r.Tuesday,0) = ?
    and coalesce(r.Wednesday,0) = ?
    and coalesce(r.Thursday,0) = ?
    and coalesce(r.Friday,0) = ?
    ';

    $sql = 'select sd.original_date,sd.alternate_date,sd.reason,c.* from (select c.*,ch.chain_number,ch.chain_name from routes r
 left join customers c on r.customer_id = c.customer_id
 left join chains ch on c.chain_id = ch.chain_id
 where coalesce(r.Monday,0) = ?
 and coalesce(r.Tuesday,0) = ?
 and coalesce(r.Wednesday,0) = ?
 and coalesce(r.Thursday,0) = ?
 and coalesce(r.Friday,0) = ?) c
 left outer join substitute_days sd on sd.customer_id = c.customer_id 
 and sd.original_date = ?';


    $db = getDb();
    $rs = $db->Execute($sql,array($monday,$tuesday,$wednesday,$thursday,$friday,$original_date));
    $rows = $rs->GetRows();
    return $rows;

}



?>
