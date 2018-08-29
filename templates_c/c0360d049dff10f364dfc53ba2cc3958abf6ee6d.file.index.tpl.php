<?php /* Smarty version Smarty-3.1.16, created on 2018-08-28 20:31:32
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7135929205b7d6665d86ca5-54020379%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0360d049dff10f364dfc53ba2cc3958abf6ee6d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1535506273,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7135929205b7d6665d86ca5-54020379',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b7d6665dd2795_52715401',
  'variables' => 
  array (
    'FEATURE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b7d6665dd2795_52715401')) {function content_5b7d6665dd2795_52715401($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("partials/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="home">
		<div class="home_slider_container">
			<div class="owl-carousel owl-theme home_slider">
				<?php echo $_smarty_tpl->getSubTemplate ("partials/_home_slider.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('show'=>$_smarty_tpl->tpl_vars['FEATURE']->value), 0);?>

			</div>
		</div>
	</div>

<?php echo $_smarty_tpl->getSubTemplate ("partials/_search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo $_smarty_tpl->getSubTemplate ("partials/_recent.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>





<?php echo $_smarty_tpl->getSubTemplate ("partials/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
