<?php /* Smarty version Smarty-3.1.16, created on 2018-08-28 21:38:39
         compiled from "./templates/partials/_show_card.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16891252395b86017700cba7-67330961%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1baacd976ba789c06fad5cd5bd082d3d5907b996' => 
    array (
      0 => './templates/partials/_show_card.tpl',
      1 => 1535510317,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16891252395b86017700cba7-67330961',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b8601770540d8_05803088',
  'variables' => 
  array (
    'show' => 0,
    'BASEURL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b8601770540d8_05803088')) {function content_5b8601770540d8_05803088($_smarty_tpl) {?><div class="col-xl-4 col-lg-6 property_col">
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
			<div class="property_price">VOTECOUNT</div>
		</div>
		<!--div class="property_footer d-flex flex-row align-items-center justify-content-start">
			<div><div class="property_icon"><img src="images/icon_1.png" alt=""></div><span>650 Ftsq</span></div>
			<div><div class="property_icon"><img src="images/icon_2.png" alt=""></div><span>3 Bedrooms</span></div>
			<div><div class="property_icon"><img src="images/icon_3.png" alt=""></div><span>3 Bathrooms</span></div>
		</div -->
	</div>
</div><?php }} ?>
