<?php /* Smarty version Smarty-3.1.16, created on 2018-08-22 08:34:29
         compiled from "./templates/partials/_sidenav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14000214575b7d6665e40ad2-65159807%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1688296dfaeb70cb23b2b0d3831b29356067a964' => 
    array (
      0 => './templates/partials/_sidenav.tpl',
      1 => 1534942707,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14000214575b7d6665e40ad2-65159807',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '__USER' => 0,
    'BASEURL' => 0,
    'CURRENT_PAGE' => 0,
    'ACTIVE_CUSTOMER' => 0,
    'LINKS' => 0,
    'page' => 0,
    'link' => 0,
    'ONE_CUSTOMER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b7d6665eb7855_66627637',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b7d6665eb7855_66627637')) {function content_5b7d6665eb7855_66627637($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['__USER']->value['user_id']>0) {?>

<div class="col-sm-3 col-md-2 sidebar">
    
<?php if ($_smarty_tpl->tpl_vars['__USER']->value['user_role']=="administrator") {?>
  <ul class="nav nav-sidebar">
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/dashboard.php">Dashboard</a></li>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/order.php">Place Order</a></li>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/orders.php">Order History</a></li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      Chains <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/chains.php">Chains</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/customers.php">Customers</a></li>
    </ul>
  </li>        
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      Configuration <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/broadcast.php">Broadcast Message</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/bakeries.php">Bakeries</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/distribution_centers.php">Distribution Centers</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/deadlines.php">Deadlines</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/customer_deadlines.php">Deadline Overrides</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/holiday_days.php">Holiday Days</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/holidays.php">Holiday Weeks</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/extra_day_list.php">Open Days</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/routes.php">Routes</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/route_override_list.php">Route Overrides</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/products.php">Products</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/categories.php">Categories</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/subcategories.php">Sub Categories</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/users.php">Users</a></li>
    </ul>
  </li>        
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      File Maintenance <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/import.php">Import Files</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/export.php">Export File</a></li>
    </ul>
  </li>        
  </ul>    
<?php if ($_smarty_tpl->tpl_vars['CURRENT_PAGE']->value=="order.php") {?>    
<ul class="nav nav-sidebar">
    <li><a href="#" class="cust_dropdown" data-toggle="modal" data-target="#myModal"><span style="color:#000;">Select Customer</span><br /><?php if ($_smarty_tpl->tpl_vars['ACTIVE_CUSTOMER']->value) {?><?php echo $_smarty_tpl->tpl_vars['ACTIVE_CUSTOMER']->value['customer_name'];?>
<?php } else { ?><i>No customer selected</i><?php }?></a></li>
</ul>
<?php }?>
        
        
<?php } elseif ($_smarty_tpl->tpl_vars['__USER']->value['user_role']=="data-entry") {?>    
  <ul class="nav nav-sidebar">

    <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/dashboard.php">Dashboard</a></li>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/order.php">Place Order</a></li>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/orders.php">Order History</a></li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      Chains <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/chains.php">Chains</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/customers.php">Customers</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      File Maintenance <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/import.php">Import Files</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/export.php">Export File</a></li>
    </ul>
  </li>    
  </ul>    
<?php if ($_smarty_tpl->tpl_vars['CURRENT_PAGE']->value=="order.php") {?>    
<ul class="nav nav-sidebar">
    <li><a href="#" class="cust_dropdown" data-toggle="modal" data-target="#myModal"><span style="color:#000;">Select Customer</span><br /><?php if ($_smarty_tpl->tpl_vars['ACTIVE_CUSTOMER']->value) {?><?php echo $_smarty_tpl->tpl_vars['ACTIVE_CUSTOMER']->value['customer_name'];?>
<?php } else { ?><i>No customer selected</i><?php }?></a></li>
</ul>
<?php }?>

    
    
<?php } else { ?>    
    
  <ul class="nav nav-sidebar">
<?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LINKS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->_loop = true;
 $_smarty_tpl->tpl_vars['page']->value = $_smarty_tpl->tpl_vars['link']->key;
?>
    <li <?php if ($_smarty_tpl->tpl_vars['CURRENT_PAGE']->value==$_smarty_tpl->tpl_vars['page']->value) {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['link']->value;?>
</a></li>
<?php } ?>    
  </ul>    

<?php if ($_smarty_tpl->tpl_vars['ONE_CUSTOMER']->value!=true&&$_smarty_tpl->tpl_vars['__USER']->value['user_role']!="bakery-manager") {?>
<ul class="nav nav-sidebar">
    <li><a href="#" class="cust_dropdown" data-toggle="modal" data-target="#myModal"><span style="color:#000;">Select Customer</span><br /><?php if ($_smarty_tpl->tpl_vars['ACTIVE_CUSTOMER']->value) {?><?php echo $_smarty_tpl->tpl_vars['ACTIVE_CUSTOMER']->value['customer_name'];?>
<?php } else { ?><i>No customer selected</i><?php }?></a></li>
</ul>
<?php }?>


<?php }?>
</div>
<?php }?>
<?php }} ?>
