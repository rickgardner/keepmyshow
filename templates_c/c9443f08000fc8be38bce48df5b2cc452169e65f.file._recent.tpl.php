<?php /* Smarty version Smarty-3.1.16, created on 2018-08-28 21:13:10
         compiled from "./templates/partials/_recent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3303278845b85f59e9adad6-27083985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9443f08000fc8be38bce48df5b2cc452169e65f' => 
    array (
      0 => './templates/partials/_recent.tpl',
      1 => 1535508788,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3303278845b85f59e9adad6-27083985',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b85f59e9affb1_18599613',
  'variables' => 
  array (
    'SHOWS' => 0,
    'show' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b85f59e9affb1_18599613')) {function content_5b85f59e9affb1_18599613($_smarty_tpl) {?>			<div class="row properties_row">
				<?php  $_smarty_tpl->tpl_vars["show"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["show"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['SHOWS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["show"]->key => $_smarty_tpl->tpl_vars["show"]->value) {
$_smarty_tpl->tpl_vars["show"]->_loop = true;
?>				
				<?php echo $_smarty_tpl->getSubTemplate ("partials/_show_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('show'=>$_smarty_tpl->tpl_vars['show']->value), 0);?>

				<?php } ?>
			</div><?php }} ?>
