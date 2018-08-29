<?php
class DeadlineOverride {


    function DeadlineOverride($_params = array()) {
        parent::BaseObject($_params, 'deadline_overrides', 'deadline_override_id');
    }
        

    public static function getUserOverride($user_id,$week_start) {
        $db = getDb();
        //$db->debug = true;
        $sql = 'SELECT * FROM deadline_overrides WHERE user_id = ? AND week_start = ?';
        $row = $db->GetRow($sql,array($user_id,$week_start));
        return $row;
    }


    public static function getCurrentOverrides() {
        $db = getDb();



        $sql = ' select d.week_start,u.deadline_hour,u.deadline_day,d.reason,count(distinct(cu.customer_id)) as num_affected from deadline_overrides d 
 left join users u on d.user_id = u.user_id
 left join customer_users cu on u.user_id = cu.user_id
 left join customers c on cu.customer_id = c.customer_id
 where u.user_active = 1
 and c.customer_active = 1
 group by d.week_start,u.deadline_hour,u.deadline_day,d.reason order by d.week_start desc';

        $rs = $db->Execute($sql);
        $rows = $rs->GetRows();

        for($i = 0; $i < count($rows); $i++) {
            $ts = strtotime($rows[$i]['week_start']);
            $d_ts =  strtotime('last ' . strtolower($rows[$i]['deadline_day']),$ts);
            $date = date('Y-m-d',$d_ts);
            $rows[$i]['date'] = $date;
        }




        return $rows;            
    }


    public static function findUsersForDeadline($day) {
        $db = getDb();



        $sql = 'select u.deadline_day,u.deadline_hour,count(distinct(u.user_id)) as num_affected
                 from users u
                  left join customer_users cu on cu.user_id = u.user_id
                  left join customers c on cu.customer_id = c.customer_id and c.customer_active = 1
                  left join chain_users chu on chu.user_id = u.user_id
                  left join chains ch on ch.chain_id = chu.chain_id and ch.chain_active = 1
                 where lower(u.deadline_day) = lower(?)
                 and u.user_active = 1
                    and u.user_role in (\'customer\',\'chain-manager\')
                group by u.deadline_day, u.deadline_hour 
                order by u.user_id,ch.chain_name, c.customer_name
                ';

        $rs = $db->Execute($sql,array($day));
        $rows = $rs->GetRows();
        return $rows;
    }



    public static function customersWithDeadline($deadline_day,$deadline_hour,$date) {
        $db = getDb();
        //$db->debug = true;


        $sql = 'select 
dl.deadline_day as new_deadline_day, dl.deadline_hour as new_deadline_hour, dl.reason,
ch.chain_number,c.customer_number,ch.chain_name,c.customer_name,
u.user_role,u.user_email,u.user_id,u.user_active,u.user_firstname,u.user_lastname, u.deadline_day, u.deadline_hour 
 from users u
 left join deadline_overrides dl on dl.user_id = u.user_id and week_start = ?
 left join customer_users cu on cu.user_id = u.user_id
 left join customers c on cu.customer_id = c.customer_id and c.customer_active = 1
 left join chain_users chu on chu.user_id = u.user_id
 left join chains ch on ch.chain_id = chu.chain_id and ch.chain_active = 1
 where lower(u.deadline_day) = lower(?) and u.deadline_hour = ?
 and u.user_active = 1 and u.user_role in (\'customer\',\'chain-manager\')
 order by ch.chain_name, c.customer_name ';



        $rs = $db->Execute($sql,array($date,$deadline_day,$deadline_hour));
        $rows = $rs->GetRows();


        $users = array();
        foreach($rows as $row) {

//            $users[$row['user_id']] = array();
            $users[$row['user_id']]['user_role'] = $row['user_role'];
            $users[$row['user_id']]['user_firstname'] = $row['user_firstname'];
            $users[$row['user_id']]['user_lastname'] = $row['user_lastname'];
            $users[$row['user_id']]['deadline_day'] = $row['deadline_day'];
            $users[$row['user_id']]['deadline_hour'] = $row['deadline_hour'];
            $users[$row['user_id']]['new_deadline_hour'] = $row['new_deadline_hour'];
            $users[$row['user_id']]['new_deadline_day'] = $row['new_deadline_day'];
            $users[$row['user_id']]['reason'] = $row['reason'];
            $users[$row['user_id']]['user_id'] = $row['user_id'];
            $users[$row['user_id']]['user_email'] = $row['user_email'];
            if($row['chain_number'] != '') {
                $users[$row['user_id']]['chain_list'] .= $row['chain_number'] . ' : ' . $row['chain_name'] . "<br />";
                $users[$row['user_id']]['chain_count']++;
            }
            if($row['customer_number'] != '') {
                $users[$row['user_id']]['customer_list'] .=  $row['customer_number'] . ' : ' . $row['customer_name']."<br />";
                $users[$row['user_id']]['customer_count']++;
            }
        }

/*        while(list($user_id,$vals) = each($users)) {
            $users[$user_id]['chain_list'] = implode(", ", $users[$user_id]['chains']);
            $users[$user_id]['chain_count'] = count($users[$user_id]['chains']);
            $users[$user_id]['customer_list'] = implode(", ", $users[$user_id]['customers']);
            $users[$user_id]['customer_count'] = count($users[$user_id]['customers']);
        }
*/        

        return $users;
    }

    public static function removeOverride($user_id,$week_start) {
        $db = getDb();
        $sql = 'DELETE FROM deadline_overrides WHERE user_id = ? and week_start = ?';
        $rs = $db->Execute($sql,array($user_id,$week_start));
    }


    public static function addOverride($user_id,$week_start,$deadline_day,$deadline_hour,$reason) {
        $db = getDb();
        //$db->debug = true;
         $sql = 'REPLACE INTO deadline_overrides (user_id, week_start, deadline_day, deadline_hour,reason) VALUES(?,?,?,?,?)';
        $db->Execute($sql,array($user_id,$week_start,$deadline_day,$deadline_hour,$reason));

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
