<?php

class Import {
    
    
    function Import() {}
    
    
    public static function getFortWorthSchools() {
        $db = getDb();
        $sql = 'SELECT * FROM `customers` WHERE `chain_id` = 358000 ORDER BY school_id';
        $rs = $db->Execute($sql);
        $rows = $rs->GetRows();
        $schools = array();
        foreach($rows as $row) {
            $school_id = $row['school_id'];
            $schools[$school_id] = $row;
        }
        return $schools;
    }
    
    public static function getDallasSchools() {
        $db = getDb();
        $sql = 'SELECT * FROM customers where chain_id = 15000 ORDER BY school_id';
        $rs = $db->Execute($sql);
        $rows = $rs->GetRows();
        $schools = array();
        foreach($rows as $row) {
            $school_id = $row['school_id'];
            $schools[$school_id] = $row;
        }
        return $schools;        
    }
    
    public static function getSchoolIDs($chain_id) {
        $db = getDb();
        $sql = 'SELECT * FROM customers where chain_id = ? ORDER BY school_id';
        $rs = $db->Execute($sql,array($chain_id));
        $rows = $rs->GetRows();
        $schools = array();
        foreach($rows as $row) {
            $school_id = $row['school_id'];
            $schools[$school_id] = $row;
        }
        return $schools;        
    }
    
    
    public static function validateRecords($import_records,$week_start,$customer_numbers) {
        $week_start_ts = strtotime($week_start);
        $week_end_ts = strtotime("+1 week",$week_start_ts);
        $week_start_string = date('Y-m-d', $week_start_ts);
        $week_end_string = date('Y-m-d',$week_end_ts);
        $records = array();
        $customer_product_orders = array();
        $school_blocked_days = array();
        $school_alternate_days = array();
        $route_overrides = array();
        $extra_days = array();
        
        // I feel dirty
        $db = getDb();
        $sql = 'SELECT * FROM products';
        $rs = $db->Execute($sql);
        $rows = $rs->GetRows();

        $product_ids = array();

        foreach($rows as $row) {
            $product_ids[$row['product_code']] = $row['product_id'];
        }



            foreach($import_records as $import_record) {
                    $customer_product_order = array();
                    $record = $import_record;
                    $customer_id = $record['customer_id'];
                    $customer_number = $customer_numbers[$customer_id];
                    $record['customer_number'] = $customer_number;

                    if(!isset($school_blocked_days[$customer_id])) {
                        $school_blocked_days[$customer_id] = Customer::getHolidayDays($customer_id,$week_start_string,$week_end_string);
                    }
                    if(!isset($school_alternate_days[$customer_id])) {
                        $school_alternate_days[$customer_id] = Customer::getSubstituteDays($customer_id,$week_start_string,$week_end_string);
                    }
                    if(!isset($route_overrides[$customer_id])) {
                        $route_overrides[$customer_id] = RouteOverride::getRouteOverrides($customer_id,$week_start_string,$week_end_string);
                    }

                    if(!isset($extra_days[$customer_id])) {
                        $extra_day_rs = ExtraDays::getExtraDays($customer_id,$week_start_string,$week_end_string);
                        foreach($extra_day_rs as $ed) {
                            $extra_days[$customer_id][$ed['dow']] = $ed['extra_date'];
                        }
                    }

                    // this is really a product_code
                    $product_code  = $record['product_id'];

                    $product_id = $product_ids[$product_code];
                    $record['product_id'] = $product_id;
                    if($product_id == '') {

                        die("oh noooooooos");
                    }

                    $delivery_date_ts = strtotime($record['delivery_date']);
                    
                        if(!isset($school_products[$customer_id])) {
                            $avail_products = Customer::getAllProducts($customer_id);
                            foreach($avail_products as $ap) {
//                                $school_products[$customer_id][$ap['product_code']] = true;
                                $school_products[$customer_id][$ap['product_id']] = true;
                            }
                        }
//                        echo "<pre>";
//                        print_r($school_products);
//                        echo "</pre>";
//                        die("done");

                        $prod_is_avail = $school_products[$customer_id][$product_id];
                        
                        if($prod_is_avail) {
                            // Do nothing for now, mainly just making sure they
                            // do have the product
                        } else {
                            $record['status'] = 'BAD';
                            $record['status_msg'][] = 'Customer does not have product';
                        }
                        
                        if(!isset($school_routes[$customer_id])) {
                            $routes = Route::getByCustomerId($customer_id);
                            $school_routes[$customer_id] = $routes;




                            $days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                            $possible_days = array();
                            foreach($days as $day) {
                                $possible_date = date('Y-m-d',strtotime('this ' . $day,$week_start_ts));

                                    if(count($route_overrides[$customer_id]) > 0) {
                                        if($route_overrides[$customer_id][$day] == 1) {
                                            $school_routes[$customer_id][$day] = 1;
                                            $possible_days[$possible_date] = $possible_date;
                                        } else {
                                            $school_routes[$customer_id][$day] = null;
                                        }
                                    } else {
                                        if(isset($extra_days[$customer_id][$day])) {
                                            $school_routes[$customer_id][$day] = 1;
                                            $possible_days[$possible_date] = $possible_date;
                                        }

                                        if(isset($school_blocked_days[$customer_id][$possible_date])) {
                                            $alternate_date = $school_blocked_days[$customer_id][$possible_date]['alternate_date'];
                                            $school_routes[$customer_id][$day] = null;
                                            unset($possible_days[$possible_date]);
                                            if($alternate_date != '') {
                                                $alternate_day = date('l',strtotime($alternate_date));
                                                $school_routes[$customer_id][$alternate_day] = 1;
                                                $possible_days[$alternate_date] = $alternate_date; 
                                            }

                                        } elseif($school_routes[$customer_id][$day] == 1) {
                                            $possible_days[$possible_date] = $possible_date;
                                        }


                                    }


                                
                            }

                            $school_routes[$customer_id]['possible_days'] = implode(" or ",$possible_days);
                        }
                        $day_of_week = date('l',$delivery_date_ts);
                        $stop_is_avail = $school_routes[$customer_id][$day_of_week];






                        if($stop_is_avail) {
                            // Do nothing, just making sure the stop is avail
                        } else {
                            $record['status'] = 'BAD';
                            $record['status_msg'][] = 'Delivery date for this week must be '  . $school_routes[$customer_id]['possible_days'];
                        }
                    if($delivery_date_ts >= $week_start_ts && $delivery_date_ts <= $week_end_ts) {
                        $data[2] = $delivery_date_str;
                        $good_rows[] = $data;
                    } else {
                        $record['status'] = 'BAD';
                        $record['status_msg'][] = $delivery_date_str . ' not within selected week (must be ' . $school_routes[$customer_id]['possible_days'] . ')';
                        $bad_rows[] = $data;
                    }
                    $delivery_date = $record['delivery_date'];
                    $product_id = $record['product_id'];
                    $customer_id = $record['customer_id'];
                    $s_key = $customer_id . '-' . $product_id . '-' . $delivery_date;
                    if($customer_product_orders[$customer_id][$delivery_date][$product_id]['quantity'] > 0) {
                        $records[$customer_id][$s_key]['quantity'] += $record['quantity'];
                        if($records[$customer_id][$s_key]['status'] != 'BAD') {
                            $records[$customer_id][$s_key]['status'] = 'WARNING';
                        }
                        $records[$customer_id][$s_key]['status_msg'][] = "Customer already had " . $customer_product_orders[$customer_id][$delivery_date][$product_id]['quantity'] . " of this product, so adding " . $record['quantity'];
                    } else {
                        $records[$customer_id][$s_key] = $record;
                    }
                    $customer_product_orders[$customer_id][$delivery_date][$product_id]['quantity'] += $record['quantity'];
            }
//                    echo "<pre>";
//                    print_r($customer_product_orders);
//                    echo "</pre>";
//                    echo "<hr />";
//                    echo "<pre>";
//                    print_r($records);
//                    echo "</pre>";
//                    exit;
            
            return $records;
    }
    
    public static function readDallasCSV($csv_upload_location) {
       $school_lkup = Import::getDallasSchools();
       $product_skus = array();
        $records = array();
        if (($handle = fopen($csv_upload_location, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $schoolid = (int)$data[1];
                $product_sku = $data[5];
                $delivery_date_ts = strtotime($data[4]);
                $quantity = (int)$data[7];
                if($quantity > 0) {

                    if(!isset($product_skus[$product_sku])) {
                        $product = Product::getBySku($product_sku);
                        $product_skus[$product_sku] = $product;
                    }
                    
                    
                    
                    
                    $record = array();
                    $record['src'] = $data;
                    $record['quantity'] = $quantity;

                    $product = $product_skus[$product_sku];
                    $product_id = $product['product_id'];

                    $record['product_id'] = $product_id;

                    if(isset($school_lkup[$schoolid])) {
                        $school = $school_lkup[$schoolid];
                        $customer_id = $school['customer_id'];
                        $record['customer_id'] = $customer_id;
                    } else {
                        $record['customer_id'] = 'NOT FOUND';
                    }

                    $delivery_date_str = date('Y-m-d',$delivery_date_ts);
                    $record['delivery_date'] = $delivery_date_str;
                    $records[] = $record;
                }
            }
            fclose($handle);
            return $records;
        }
    }
    
    public static function readFortworthCSV($csv_upload_location) {
            $school_lkup = Import::getFortWorthSchools();
            $records = array();
            if (($handle = fopen($csv_upload_location, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $schoolid = (int)$data[0];
                    $productid = $data[1];
                    $delivery_date_ts = strtotime($data[2]);
                    $quantity = (int)$data[3];
                    if($quantity > 0) {
                        
                    $record = array();
                    $record['src'] = $data;
                    $record['quantity'] = $quantity;
                    
                    $product_id = $productid - 900000; // Fortworth-specific logic
                    
                    $record['product_id'] = $product_id;
                    
                    if(isset($school_lkup[$schoolid])) {
                        $school = $school_lkup[$schoolid];
                        $customer_id = $school['customer_id'];
                        $record['customer_id'] = $customer_id;
                    } else {
                        $record['customer_id'] = 'NOT FOUND (' . $schoolid . ')';
                    }
                    $delivery_date_str = date('Y-m-d',$delivery_date_ts);
                    $record['delivery_date'] = $delivery_date_str;
                    $records[] = $record;
                    }
                }
                fclose($handle);
                return $records;
            }
        
    }

    public static function readGenericCSV($csv_upload_location,$chain_id) {
            $school_lkup = Import::getSchoolIDs($chain_id);
            $records = array();
            if (($handle = fopen($csv_upload_location, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      //              echo "<pre>";
      //              print_r($data);
      //              echo "</pre>";
                    $schoolid = (int)$data[0];
                    $product_id = $data[1];
                    $delivery_date_ts = strtotime($data[2]);
                    $quantity = (int)$data[3];
                    if($quantity > 0) {
                        
                    $record = array();
                    $record['src'] = $data;
                    $record['quantity'] = $quantity;
                    
                    //$product_id = $productid - 900000; // Fortworth-specific logic
                    
                    $record['product_id'] = $product_id;
                    
                    if(isset($school_lkup[$schoolid])) {
                        $school = $school_lkup[$schoolid];
                        $customer_id = $school['customer_id'];
                        $record['customer_id'] = $customer_id;
                    } else {
                        $record['customer_id'] = 'NOT FOUND (' . $schoolid . ')';
                    }
                    $delivery_date_str = date('Y-m-d',$delivery_date_ts);
                    $record['delivery_date'] = $delivery_date_str;
                    $records[] = $record;
//                    echo "<pre>";
//                    print_r($record);
//                    echo "</pre>";
                    }
                }
 //               echo "<pre>";
 //               print_r($records);
 //               echo "</pre>";
 //           die("got here");
                
                fclose($handle);
                return $records;
            }
        
    }    
    
    public static function readHISDCSV($csv_upload_location,$chain_id) {
            //$chain_id = 47000; // we should pass this in probably
            $school_lkup = Import::getSchoolIDs($chain_id);
            $records = array();
            if (($handle = fopen($csv_upload_location, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $schoolid = (int)$data[1];
                    $product_id = $data[4];
                    $delivery_date_ts = strtotime($data[6]);
                    $quantity = (int)$data[8];
                    if($quantity > 0) {
                        
                    $record = array();
                    $record['src'] = $data;
                    $record['quantity'] = $quantity;
                    $record['product_id'] = $product_id;
                    
                    if(isset($school_lkup[$schoolid])) {
                        $school = $school_lkup[$schoolid];
                        $customer_id = $school['customer_id'];
                        $record['customer_id'] = $customer_id;
                    } else {
                        $record['customer_id'] = 'NOT FOUND (' . $schoolid . ')';
                    }
                    $delivery_date_str = date('Y-m-d',$delivery_date_ts);
                    $record['delivery_date'] = $delivery_date_str;
                    $records[] = $record;
                    }
                }
                fclose($handle);
                return $records;
            }
    }

    
    
    public static function readArlingtonCSV($csv_upload_location,$chain_id) {
            //$chain_id = 354000; // we should pass this in probably
            $school_lkup = Import::getSchoolIDs($chain_id);
            $records = array();
            if (($handle = fopen($csv_upload_location, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $schoolid = (int)$data[0];
                    $product_id = $data[4];
                    $delivery_date_ts = strtotime($data[2]);
                    $quantity = (int)$data[5];
                    if($quantity > 0) {
                        
                    $record = array();
                    $record['src'] = $data;
                    $record['quantity'] = $quantity;
                    $record['product_id'] = $product_id;
                    
                    if(isset($school_lkup[$schoolid])) {
                        $school = $school_lkup[$schoolid];
                        $customer_id = $school['customer_id'];
                        $record['customer_id'] = $customer_id;
                    } else {
                        $record['customer_id'] = 'NOT FOUND (' . $schoolid . ')';
                    }
                    $delivery_date_str = date('Y-m-d',$delivery_date_ts);
                    $record['delivery_date'] = $delivery_date_str;
                    $records[] = $record;
                    }
                }
                fclose($handle);
                return $records;
            }
    }
    
    
}


?>