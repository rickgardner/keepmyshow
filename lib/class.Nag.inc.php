<?php

class Nag {
    
    
    function Nag() {}
    
    
    public static function TuesdayCustomers() {
        //--Emails will go out on Tuesday for schools that are Monday, Tuesday, Monday/Thursday, Monday/Wednesday, Tuesday/Friday
        $sql = 'select distinct c.customer_id from routes r
            left join customers c on r.customer_id = c.customer_id
            left join chains ch on c.chain_id = ch.chain_id
            where 
            (r.Monday = 1
            and r.Tuesday is null
            and r.Wednesday is null
            and r.Thursday is null
            and r.Friday is null
            and r.Saturday is null)
            or
            (r.Monday is null
            and r.Tuesday = 1
            and r.Wednesday is null
            and r.Thursday is null
            and r.Friday is null
            and r.Saturday is null)
            or
            (r.Monday = 1
            and r.Tuesday is null
            and r.Wednesday is null
            and r.Thursday = 1
            and r.Friday is null
            and r.Saturday is null)
            or
            (r.Monday = 1
            and r.Tuesday is null
            and r.Wednesday = 1
            and r.Thursday is null
            and r.Friday is null
            and r.Saturday is null)
            or
            (r.Monday is null
            and r.Tuesday = 1
            and r.Wednesday is null
            and r.Thursday is null
            and r.Friday = 1
            and r.Saturday is null) 
            and c.customer_active = 1 and ch.chain_active = 1
            ';
        return $sql;
    } 
    
    public static function WednesdayCustomers() {
        //--Emails will go out on Wednsedays for schools that are Wednesday
        $sql = 'select distinct c.customer_id from routes r
            left join customers c on r.customer_id = c.customer_id
            left join chains ch on c.chain_id = ch.chain_id
            where 
            (r.Monday is null
            and r.Tuesday is null
            and r.Wednesday = 1
            and r.Thursday is null
            and r.Friday is null
            and r.Saturday is null) 
            and c.customer_active = 1 and ch.chain_active = 1';
        return $sql;
    }
    
    public static function ThursdayCustomers() {
        //--Emails will go out on Wednsedays for schools that are Thursday
        $sql = 'select distinct c.customer_id from routes r
            left join customers c on r.customer_id = c.customer_id
            left join chains ch on c.chain_id = ch.chain_id
            where 
            (r.Monday is null
            and r.Tuesday is null
            and r.Wednesday is null
            and r.Thursday = 1
            and r.Friday is null
            and r.Saturday is null) 
            and c.customer_active = 1 and ch.chain_active = 1';
        return $sql;
    }

    public static function FridayCustomers() {
        //--Emails will go out on Fridays for schools that are Friday
        $sql = 'select distinct c.customer_id from routes r
            left join customers c on r.customer_id = c.customer_id
            left join chains ch on c.chain_id = ch.chain_id
            where 
            (r.Monday is null
            and r.Tuesday is null
            and r.Wednesday = null
            and r.Thursday is null
            and r.Friday = 1
            and r.Saturday is null) 
            and c.customer_active = 1 and ch.chain_active = 1';
        return $sql;
    }

    public static function TodaysReport($date) {
        $db = getDb();
        
	$in_date_string = strtotime($date);

        if(date('D',$in_date_string) == 'Mon') {
            $start_of_week = $in_date_string;
        } else {
            $start_of_week = strtotime('last monday + 7 days',$in_date_string);
        }        
        
        $week_start = date('Y-m-d',$start_of_week);
        
        
        
        $dow = date('l',$in_date_string);
        
                $invalid_deadline_date = false;
        
        $sql = '
select r.route_id,ch.chain_id,ch.chain_number,ch.chain_name,c.* from customers c 
left join chains ch on c.chain_id = ch.chain_id
left join routes r on r.customer_id = c.customer_id




join (';
        switch($dow) {
            case 'Tuesday':
                $sql .= Nag::TuesdayCustomers();
            break;
            case 'Wednesday':
                $sql .= Nag::WednesdayCustomers();
            break;
            case 'Thursday':
                $sql .= Nag::ThursdayCustomers();
            break;
            case 'Friday':
                $sql .= Nag::FridayCustomers();
            break;
            default:
                $invalid_deadline_date = true;
                //die("$dow is not a valid deadline");
            break;
        }
        $sql .= ') dow
            on dow.customer_id = c.customer_id




where ch.chain_active = 1 
 and ch.chain_type is not null
 and ch.chain_type <> \'\'
and c.customer_active = 1
and c.customer_id not in (

select c.customer_id from customers c 
left join orders o on o.customer_id = c.customer_id
where o.week_start = ?
)

            group by r.route_id,c.customer_id,c.`customer_name`
order by r.route_id,ch.chain_number,c.customer_number            ';
        if($invalid_deadline_date) {
            $rows = array();
        } else {
         $rs = $db->Execute($sql,array($week_start));
         $rows = $rs->GetRows();
        }
	return $rows;        
    }
    
    
}


?>
