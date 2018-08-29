<?php
//define('ADODB_FETCH_ASSOC',2);


function getDb() {
        $server = DB_HOST;
        $user = DB_USER;
        $pwd  = DB_PASSWORD;
        
        
        if($server == '127.0.0.1') {
            $port = '3306';
        } else {
            $port = '3306';
        }
        
	$db   = 'keepmyshow';
        $dsn2 = 'mysqli://' . $user . ':' . $pwd . '@' . $server . '/' . $db . '?persist=0&port=' . $port;        
//	$DB = NewADOConnection('mysqli');
	$DB = NewADOConnection($dsn2);
        $DB->Connect($server, $user, $pwd, $db);
//	$DB->debug = true;
	if(isset($_GET['debug']) && $_GET['debug'] == 'true') {
		$DB->debug = true;
	}
	return $DB;
}

?>
