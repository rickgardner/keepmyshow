<?php /* Smarty version Smarty-3.1.16, created on 2018-08-28 20:22:52
         compiled from "./templates/partials/_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17175881625b7d6665dd79a2-17041468%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2a3374e1b68b0c14b004dca8e7742a861e969d2' => 
    array (
      0 => './templates/partials/_header.tpl',
      1 => 1535505770,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17175881625b7d6665dd79a2-17041468',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b7d6665e163a3_72981667',
  'variables' => 
  array (
    'BASEURL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b7d6665e163a3_72981667')) {function content_5b7d6665e163a3_72981667($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<title>Bluesky</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Bluesky template project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/property.css">
<link rel="stylesheet" type="text/css" href="styles/property_responsive.css">

<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
<body>

<div class="super_container">

    <!-- Header -->

    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justify-content-start">
                        <div class="logo">
                            <a href="#"><img src="images/logo.png" alt=""></a>
                        </div>
                        <nav class="main_nav">
                            <ul>
                                <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/index.php">Home</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/shows.php">Shows</a></li>
                            </ul>
                        </nav>
 
                        <div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Menu -->

    <div class="menu trans_500">
        <div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
            <div class="menu_close_container"><div class="menu_close"></div></div>
            <div class="logo menu_logo">
                <a href="#">
                    <div class="logo_container d-flex flex-row align-items-start justify-content-start">
                        <div class="logo_image"><div><img src="images/logo.png" alt=""></div></div>
                    </div>
                </a>
            </div>
            <ul>
                <li class="menu_item"><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/index.php">Home</a></li>
                <li class="menu_item"><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/shows.php">Shows</a></li>
            </ul>
        </div>
    </div><?php }} ?>
