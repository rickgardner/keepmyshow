<?php
/* Constants */
//define('BASEURL','http://localhost:8888/bos/trunk');
//define('BASEURL','http://bos.kurzco.com');


$base_url = 'http://' . $_SERVER['HTTP_HOST'] .  $_SERVER['PHP_SELF'];
$script = basename($base_url);
$base_url = str_replace("/$script","",$base_url);

define('BASEURL',$base_url);


date_default_timezone_set('America/Chicago');


setlocale(LC_MONETARY, 'en_US');

session_start();
require_once('./db-connect.php');
require_once('./lib/adodb5/adodb.inc.php');
require_once('./lib/functions.api.inc.php');
require_once('./lib/smarty/Smarty.class.php');
require_once('./lib/functions.db.inc.php');
require_once('./lib/functions.helpers.inc.php');
require_once('./lib/class.BaseObject.inc.php');
require_once('./lib/class.Show.inc.php');
require_once('./lib/class.Genre.inc.php');
require_once('./lib/class.Language.inc.php');
require_once('./lib/class.Network.inc.php');
require_once('./lib/class.External.inc.php');
require_once('./lib/class.Backdrop.inc.php');


require_once('./lib/class.User.inc.php');
require_once('./lib/class.Product.inc.php');
require_once('./lib/class.Import.inc.php');
require_once('./lib/class.Config.inc.php');


/* Check if user needs to be authenticated */
if(isset($_SESSION['USER'])) {
	global $tool_user;
	$tool_user = $_SESSION['USER']; 
} else {
	$tool_user = null;
}

$allowed_pages = array();
$allowed_pages[] = 'index.php';

$script = $_SERVER['SCRIPT_FILENAME'];
$current_page = basename($script);


//$results = in_array($current_page, $allowed_pages);

//if($results == false && ($tool_user == null)) {
//	$query_string = $_SERVER['QUERY_STRING'];
//	$referer = '/' . $current_page . '?' . $query_string;
//	$referer = urlencode($referer);
//	header('Location:'.BASEURL.'/login.php?r='.$referer);
//	exit;
//}


function getFlash() {
	if(isset($_SESSION['__FLASH__'])) {
		$flash = $_SESSION['__FLASH__'];
		$_SESSION['__FLASH__'] = null;
		unset($_SESSION['__FLASH__']);
		return $flash;
	}
}

function setFlash($msg,$lvl='info',$next_link='',$next_label='') {
	$lvl = strtolower($lvl);
	$allowed_levels = array('success','info','warning','danger');

	if(!in_array($lvl, $allowed_levels)) {
		$lvl = 'info';
	}


	$flash = array();
	$flash['lvl'] = $lvl;
	$flash['msg'] = $msg;

	if($next_link != '') {
		$flash['next'] = '<a href="' . BASEURL . '/' . $next_link . '">' . $next_label . '</a>';
	}

	$_SESSION['__FLASH__'] = $flash;
}

function isAdmin() {
	return $_SESSION['USER']['user_role'] == 'administrator';
}

function roleRequired($allowedRoles) {
	$authed = false;
	if(isset($_SESSION['USER'])) {
		$user = $_SESSION['USER']; 
		$user_role = $user['user_role'];
		$authed = in_array($user_role,$allowedRoles);
	}
	if($authed == false) {
		setFlash('Not authorized','warning');
		header('Location:' . BASEURL . '/index.php');
	}
}

function adminRequired() {
	$authed = false;
	if(isset($_SESSION['USER'])) {
		$user = $_SESSION['USER']; 
		if($user['user_role'] == 'administrator') {
			$authed = true;
		}
	}
	if($authed == false) {
		setFlash('Not authorized','warning');
		header('Location:' . BASEURL . '/index.php');
	}
}

/* Set up smarty variables */
$smarty = new Smarty();
$flash = getFlash();
if(is_array($flash) && isset($flash['msg'])) {
	$smarty->Assign('FLASH_MSG',$flash['msg']);
	$smarty->Assign('FLASH_LVL',$flash['lvl']);
	if($flash['next'] != '') {
		$smarty->Assign('FLASH_NEXT',$flash['next']);
	}
	$smarty->Assign('FLASH_LABEL',ucwords($flash['lvl']));
} else {
    $smarty->Assign('FLASH_MSG',false);
}
$smarty->Assign('__USER',$tool_user);
$smarty->Assign('BASEURL',BASEURL);



// current page
$smarty->Assign('CURRENT_PAGE',$current_page);
?>
