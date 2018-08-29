<?php
class ChainManager extends User {

	function ChainManager($_params = array()) {
		parent::User($_params, 'users', 'user_id');
	}

        public static function getUsers($user_id) {
            $db = getDb();
            $sql = 'select u.* from
            (select u.* from chain_users cu 
            left join users u on cu.user_id = u.user_id
            join 
            (select cu.chain_id, cu.user_id from users u 
            left join chain_users cu on cu.user_id = u.user_id
            where u.user_id = ?) cu1 on cu.chain_id = cu1.chain_id
            where u.user_id <> cu1.user_id
            union all
            select u.* from customer_users cu 
            left join users u on cu.user_id = u.user_id
            join 
            (select c.*, cu.user_id from users u 
            left join chain_users cu on cu.user_id = u.user_id
            left join customers c on c.chain_id = cu.chain_id
            where u.user_id = ?) cu3 on cu.customer_id = cu3.customer_id
            where u.user_id <> cu3.user_id
            union all
            select u.* from customer_users cu 
            left join users u on cu.user_id = u.user_id
            join 
            (select cu.customer_id, cu.user_id from users u 
            left join customer_users cu on cu.user_id = u.user_id
            where u.user_id = ?) cu1 on cu.customer_id = cu1.customer_id
            where u.user_id <> cu1.user_id
            ) u
            group by u.user_id';

            $rs = $db->Execute($sql,array($user_id,$user_id,$user_id));
            $users = $rs->GetRows();
            return $users;
        }
        
        public static function getChainsAndCustomers($user_id) {
            $chains = User::getUserChains($user_id);
            $chain_customers = array();
            $my_chains = array();
            foreach($chains as $chain) {
                $chain_id = $chain['chain_id'];
                $my_chains[$chain_id] = $chain;
                $chain_groups[$chain_id] = $chain;
                $customers_for_chains = Chain::getSchools($chain_id);
                foreach($customers_for_chains as $cust) {
                    $chain_customers[$chain_id][$cust['customer_id']] = $cust;
                }
            }
            // customers that this user is allowed to assign people to
            $customers = User::getUserCustomers($user_id);
            foreach($customers as $customer) {
                $chain_customers[$customer['chain_id']][$customer['customer_id']] = $customer;
                $chain = new Chain();
                $chain->get($customer['chain_id']);
                $chain_groups[$customer['chain_id']] = $chain->params;
            }
            return array('chain_groups'=>$chain_groups,'chain_customers'=>$chain_customers,'admin_chains'=>$my_chains);
        }
}
    
?>