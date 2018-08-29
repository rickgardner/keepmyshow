<?php /* Smarty version Smarty-3.1.16, created on 2018-08-27 12:32:56
         compiled from "./templates/shows.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10116282225b833b223cb7c8-58596699%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c52707a9490195e1644e2e71ba218f0b0fe24c1e' => 
    array (
      0 => './templates/shows.tpl',
      1 => 1535391174,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10116282225b833b223cb7c8-58596699',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b833b2245d301_99801033',
  'variables' => 
  array (
    'SHOWS' => 0,
    'show' => 0,
    'BASEURL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b833b2245d301_99801033')) {function content_5b833b2245d301_99801033($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("partials/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>






	<div class="properties" style="margin-top:119px;">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title"><?php echo count($_smarty_tpl->tpl_vars['SHOWS']->value);?>
 Shows found</div>
				</div>
			</div>
			<div class="row properties_row">
				
				<!-- Property -->
<?php  $_smarty_tpl->tpl_vars["show"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["show"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['SHOWS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["show"]->key => $_smarty_tpl->tpl_vars["show"]->value) {
$_smarty_tpl->tpl_vars["show"]->_loop = true;
?>				
				<div class="col-xl-4 col-lg-6 property_col">
					<div class="property">
						<div class="property_image">
							<img src="https://image.tmdb.org/t/p/original<?php echo $_smarty_tpl->tpl_vars['show']->value['file_path'];?>
" alt="">
							<div class="tag_offer property_tag"><a href="#"><?php echo $_smarty_tpl->tpl_vars['show']->value['network_name'];?>
</a></div>
						</div>
						<div class="property_body text-center">
							<div class="property_location"><?php echo $_smarty_tpl->tpl_vars['show']->value['network_name'];?>
</div>
							<div class="property_title"><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/show.php?show_uri=<?php echo $_smarty_tpl->tpl_vars['show']->value['show_uri'];?>
"><?php echo $_smarty_tpl->tpl_vars['show']->value['show_name'];?>
</a></div>
							<div class="property_price">$ 1. 234 981</div>
						</div>
						<div class="property_footer d-flex flex-row align-items-center justify-content-start">
							<div><div class="property_icon"><img src="images/icon_1.png" alt=""></div><span>650 Ftsq</span></div>
							<div><div class="property_icon"><img src="images/icon_2.png" alt=""></div><span>3 Bedrooms</span></div>
							<div><div class="property_icon"><img src="images/icon_3.png" alt=""></div><span>3 Bathrooms</span></div>
						</div>
					</div>
				</div>
<?php } ?>



			</div>
			<div class="row">
				<div class="col">
					<div class="pagination">
						<ul>
							<li class="active"><a href="#">01.</a></li>
							<li><a href="#">02.</a></li>
							<li><a href="#">03.</a></li>
							<li><a href="#">04.</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php echo $_smarty_tpl->getSubTemplate ("partials/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
