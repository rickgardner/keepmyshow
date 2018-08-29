<?php /* Smarty version Smarty-3.1.16, created on 2018-08-28 20:33:14
         compiled from "./templates/partials/_home_slider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:666319305b85f469536c70-52994683%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '51cc2984e97e488e903da0056b359495a44e330c' => 
    array (
      0 => './templates/partials/_home_slider.tpl',
      1 => 1535506393,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '666319305b85f469536c70-52994683',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b85f4695390e1_69596206',
  'variables' => 
  array (
    'show' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b85f4695390e1_69596206')) {function content_5b85f4695390e1_69596206($_smarty_tpl) {?>				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(https://image.tmdb.org/t/p/original<?php echo $_smarty_tpl->tpl_vars['show']->value['file_path'];?>
)"></div>
					<div class="slide_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="slide_content">
										<div class="home_subtitle"><?php echo $_smarty_tpl->tpl_vars['show']->value['network_name'];?>
</div>
										<div class="home_title"><?php echo $_smarty_tpl->tpl_vars['show']->value['show_name'];?>
</div>
										<div class="home_price"><?php echo $_smarty_tpl->tpl_vars['show']->value['votes'];?>
</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php }} ?>
