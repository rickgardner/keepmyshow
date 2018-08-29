<?php /* Smarty version Smarty-3.1.16, created on 2018-08-28 21:06:17
         compiled from "./templates/partials/_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10221470775b85f60e888b89-08874688%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '295eef5360f4162c82754e7a6d38b27d121ad607' => 
    array (
      0 => './templates/partials/_search.tpl',
      1 => 1535508345,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10221470775b85f60e888b89-08874688',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b85f60e88a444_64593048',
  'variables' => 
  array (
    'BASEURL' => 0,
    'GENRES' => 0,
    'genre' => 0,
    'NETWORKS' => 0,
    'network' => 0,
    'LANGUAGES' => 0,
    'language' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b85f60e88a444_64593048')) {function content_5b85f60e88a444_64593048($_smarty_tpl) {?>	<div class="home_search">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_search_container">
						<div class="home_search_content">
							<form action="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/shows.php" type="GET" class="search_form d-flex flex-row align-items-start justfy-content-start">
								<div class="search_form_content d-flex flex-row align-items-start justfy-content-start flex-wrap">
									<div>
										<select class="search_form_select" name="genre">
											<option disabled selected>Genre</option>
											<?php  $_smarty_tpl->tpl_vars["genre"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["genre"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['GENRES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["genre"]->key => $_smarty_tpl->tpl_vars["genre"]->value) {
$_smarty_tpl->tpl_vars["genre"]->_loop = true;
?>
											<option value="<?php echo $_smarty_tpl->tpl_vars['genre']->value['genre_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['genre']->value['genre_name'];?>
</option>
											<?php } ?>
										</select>
									</div>
									<div>
										<select class="search_form_select" name="network">
											<option disabled selected>Network</option>
											<?php  $_smarty_tpl->tpl_vars["network"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["network"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['NETWORKS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["network"]->key => $_smarty_tpl->tpl_vars["network"]->value) {
$_smarty_tpl->tpl_vars["network"]->_loop = true;
?>
											<option value="<?php echo $_smarty_tpl->tpl_vars['network']->value['network_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['network']->value['network_name'];?>
</option>
											<?php } ?>
										</select>
									</div>
									<div>
										<select class="search_form_select" name="language">
											<option disabled selected>Language</option>
											<?php  $_smarty_tpl->tpl_vars["language"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["language"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LANGUAGES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["language"]->key => $_smarty_tpl->tpl_vars["language"]->value) {
$_smarty_tpl->tpl_vars["language"]->_loop = true;
?>
											<option value="<?php echo $_smarty_tpl->tpl_vars['language']->value['language_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['language']->value['language_name'];?>
</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<button class="search_form_button ml-auto" type="submit">search</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><?php }} ?>
