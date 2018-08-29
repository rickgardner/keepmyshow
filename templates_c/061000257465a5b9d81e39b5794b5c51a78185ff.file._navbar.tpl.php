<?php /* Smarty version Smarty-3.1.16, created on 2018-08-22 08:34:29
         compiled from "./templates/partials/_navbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6905012175b7d6665e1e186-38235097%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '061000257465a5b9d81e39b5794b5c51a78185ff' => 
    array (
      0 => './templates/partials/_navbar.tpl',
      1 => 1534942707,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6905012175b7d6665e1e186-38235097',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BASEURL' => 0,
    '__USER' => 0,
    'ACTIVE_CUSTOMER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b7d6665e3aec7_48318905',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b7d6665e3aec7_48318905')) {function content_5b7d6665e3aec7_48318905($_smarty_tpl) {?><nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/media/logo2.png" style="height:100px;margin-top:-15px" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!--form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form-->
      <?php if ($_smarty_tpl->tpl_vars['__USER']->value['user_id']>0) {?>
      <ul class="nav navbar-nav navbar-right">
          <li>
              <a href="#">Welcome, <?php echo $_smarty_tpl->tpl_vars['__USER']->value['user_firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['__USER']->value['user_lastname'];?>
<?php if ($_smarty_tpl->tpl_vars['ACTIVE_CUSTOMER']->value) {?> - <?php echo $_smarty_tpl->tpl_vars['ACTIVE_CUSTOMER']->value['customer_name'];?>
<?php }?></a></li>
        <li><a href="#">|</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/login.php">Logout</a></li>
      </ul>
      
      
      
      
      <?php } else { ?>
      <div class="nav navbar-nav navbar-right address">
          
          Call (713) 861-9955<br />info@kurzco.com<br />4640 Brittmoore Rd.<br />Houston, TX 77041          
          
      </div>      
      


      <?php }?>    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><?php }} ?>
