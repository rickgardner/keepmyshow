<?php
class User extends BaseObject {

	function User($_params = array()) {
		parent::BaseObject($_params, 'users', 'user_id');
	}

	public static function authenticate($user_email,$password) {
		$enc_password = md5($password);
		$db = getDb();
		$sql = 'SELECT * FROM users WHERE lower(user_email) = lower(?) AND user_password = ? and user_active = 1';
		$row = $db->GetRow($sql,array($user_email,$enc_password));
		return $row;
	}

        public static function getByUsername($username) {
            $db = getDb();
            $sql = "select * from users where lower(user_email) = lower(?)";
            $row = $db->GetRow($sql,array($username));
            return $row;
            
        }
        
        
	public static function getAll() {
		$db = getDb();


		$sql = 'SELECT * from users u';
		$rs = $db->Execute($sql);

		$rows = $rs->GetRows();
		return $rows;
	}
        
        public static function setUserChains($user_id,$chain_ary) {
            // first we remove old records in chain_users for this user
            $db = getDb();
            //$db->debug = true;
            $sql = 'DELETE FROM chain_users WHERE user_id = ?';
            $rs = $db->Execute($sql,array($user_id));
            
            foreach($chain_ary as $chain_id) {
                $sql ='INSERT INTO chain_users (user_id,chain_id) values(?,?)';
                $rs = $db->Execute($sql,array($user_id,$chain_id));

                // Let's do a little cleanup.  If we ADD somebody as a chain administrator
                // they automatically get all customers in that chain.
                $sql = 'delete from customer_users where customer_id in (
                    select customer_id from customers where chain_id = ?
                    ) and user_id = ?';
                $rs = $db->Execute($sql,array($chain_id,$user_id));
            }
        }

        public static function getUserChains($user_id) {
            $user = new User();
            $user->get($user_id);
            
            $db = getDb();
            if($user->params['user_role'] == 'administrator') {
                $sql = 'select c.*,? from chains c';
                $rs = $db->Execute($sql,array($user_id));
            } else {
                $sql = 'select c.*,cu.user_id from chain_users cu 
                        left join chains c on cu.chain_id = c.chain_id
                        where cu.user_id = ?';
                $rs = $db->Execute($sql,array($user_id));
            }
            
            
            $rows = $rs->GetRows();
            return $rows;
        }
        
        public static function getUserCustomers($user_id) {
            $db = getDb();
            $sql = 'select c.*,ch.chain_name,ch.chain_number,cu.user_id from customer_users cu 
                    left join customers c on cu.customer_id = c.customer_id
                    left join chains ch on c.chain_id = ch.chain_id
                    where cu.user_id = ?';
            $rs = $db->Execute($sql,array($user_id));
            $rows = $rs->GetRows();
            return $rows;
        }
        
        
        public static function registerUser($customer_id,$password,$question,$answer) {

            // first we need to make sure that the user with this information 
            // does not already exist.
            
            $db = getDb();
            $sql = 'SELECT * FROM users where user_email = ? AND user_password = ?';
            $params = array($customer_id,md5($password));
            $row = $db->GetRow($sql,$params);
            
            if(count($row) == 0) {
                $r = array();
                $r['user_email'] = $customer_id;
                $r['user_role'] = 'customer';
                $r['user_active'] = 1;
                $r['user_password'] = md5($password);
                $r['user_firstname'] = 'Customer';
                $r['user_lastname'] = $customer_id;
                $r['security_question'] = $question;
                $r['security_answer'] = $answer;
                $user = new User($r);
                $user_id = $user->save();
            } else {
                $user = new User($row);
                $user_id = $user->param['user_id'];
            }
            User::setUserCustomers($user_id, array($customer_id));
            return $user;
        }
        
        public static function setUserCustomers($user_id,$customer_ary) {
            // first we remove old records in chain_users for this user
            $db = getDb();
            $sql = 'DELETE FROM customer_users WHERE user_id = ?';
            $rs = $db->Execute($sql,array($user_id));
            
            foreach($customer_ary as $customer_id) {
                $sql ='INSERT INTO customer_users (user_id,customer_id) values(?,?)';
                $rs = $db->Execute($sql,array($user_id,$customer_id));
            }
        }
        
        public static function getAllCustomers($user_id) {
            $all_chains = array();
            
            $user_role = getUserAttribute('user_role');
            if($user_role == 'administrator' || $user_role == 'data-entry') {
                $sql = 'select ch.chain_name,c.* 
                    from customers c
                     left join chains ch on c.chain_id = ch.chain_id
                     ORDER BY ch.chain_name';
                $db = getDb();
                $rs = $db->Execute($sql);
                $rows = $rs->GetRows();
                foreach($rows as $row) {
                    $chain_id = $row['chain_id'];
                    $chain_name = $row['chain_name'];
                    
                    $all_chains[$chain_id]['chain_name'] = $chain_name;
                    $all_chains[$chain_id]['customers'][] = $row;
                }
            } else {
                $chains = User::getUserChains($user_id);
                $customers = User::getUserCustomers($user_id);


                foreach ($customers as $c) {
                    $chain_id = $c['chain_id'];
                    $chain_name = $c['chain_name'];

                    $all_chains[$chain_id]['chain_name'] = $chain_name;
                    $all_chains[$chain_id]['customers'][] = $c;
                }


                foreach($chains as $chain) {
                    $chain_id = $chain['chain_id'];

                    $customers = Chain::getSchools($chain_id);
                    foreach ($customers as $c) {
                        $chain_id = $c['chain_id'];
                        $chain_name = $c['chain_name'];

                        $all_chains[$chain_id]['chain_name'] = $chain_name;
                        $all_chains[$chain_id]['customers'][] = $c;
                    }
                }

                
                
                
            }
            return $all_chains;
        }
        
        
        public static function getAllCustomers2($user_id) {
            
            // very first let's see if this user is data-entry or administrator
            
            $u = new User();
            $u->get($user_id);
            
            if($u->params['user_role'] == 'administrator' || $u->params['user_role'] == 'data-entry') {
                $chains = Chain::getAll();
            } else {
                // first let's get the chains
                $chains = User::getUserChains($user_id);
                $customers = User::getUserCustomers($user_id);
            }
            
            $all_chains = array();
            
            foreach ($customers as $c) {
                $chain_id = $c['chain_id'];
                $chain_name = $c['chain_name'];
                
                $all_chains[$chain_id]['chain_name'] = $chain_name;
                $all_chains[$chain_id]['customers'][] = $c;
            }
            

            foreach($chains as $chain) {
                $chain_id = $chain['chain_id'];
                    
                $customers = Chain::getSchools($chain_id);
                foreach ($customers as $c) {
                    $chain_id = $c['chain_id'];
                    $chain_name = $c['chain_name'];

                    $all_chains[$chain_id]['chain_name'] = $chain_name;
                    $all_chains[$chain_id]['customers'][] = $c;
                }
            }
            
            return $all_chains;
        }
        
}
    
?>
