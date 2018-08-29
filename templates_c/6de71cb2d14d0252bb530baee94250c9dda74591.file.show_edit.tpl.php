<?php /* Smarty version Smarty-3.1.16, created on 2018-08-26 20:21:51
         compiled from "./templates/show_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11603103055b833c55e65d53-85894846%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6de71cb2d14d0252bb530baee94250c9dda74591' => 
    array (
      0 => './templates/show_edit.tpl',
      1 => 1535332894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11603103055b833c55e65d53-85894846',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b833c55ec9ce1_14546569',
  'variables' => 
  array (
    'BASEURL' => 0,
    'SHOW' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b833c55ec9ce1_14546569')) {function content_5b833c55ec9ce1_14546569($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("partials/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

  <div class="input_form">
    <div class="container">
      <div class="row">
<h2>Add/Edit Show</h2>
        <!-- Contact Form -->
        <div class="col-lg-8">
          <div class="contact_form_container">
            <form action="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/show_edit.php" class="contact_form" method="POST" id="contact_form">
              <input type="hidden" name="show[show_id]" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_id'];?>
" />

              <div class="row">
                <!-- Name -->
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[show_name]" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_name'];?>
" placeholder="Show Name" required="required">
                </div>
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[imdbid]" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value['imdbid'];?>
" placeholder="IMDB ID" required="required">
                </div>                <!-- Network -->
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[show_network]" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_network'];?>
" placeholder="Show Network" required="required">
                </div>
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[show_uri]" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_uri'];?>
" placeholder="Show URI" required="required">
                </div>
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[show_image_large]" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_image_large'];?>
" placeholder="Show Large Image URL" required="required">
                </div>
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[show_image_small]" value="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_image_small'];?>
" placeholder="Show Small Image URL" required="required">
                </div>
              </div>
              <div><textarea class="contact_textarea contact_input" name="show[show_description]" placeholder="Description" required="required"><?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_description'];?>
</textarea></div>
              <button type="submit" class="contact_button button">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 <?php echo $_smarty_tpl->getSubTemplate ("partials/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
