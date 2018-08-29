<?php /* Smarty version Smarty-3.1.16, created on 2018-08-27 12:52:33
         compiled from "./templates/show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11586099235b8348f9d3c9d7-27792204%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab429123cfcfd2a9c43df1000ae350709b3b60f9' => 
    array (
      0 => './templates/show.tpl',
      1 => 1535392352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11586099235b8348f9d3c9d7-27792204',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5b8348f9d837d9_59613720',
  'variables' => 
  array (
    'SHOW' => 0,
    'GENRES' => 0,
    'BASEURL' => 0,
    'genre' => 0,
    'NETWORKS' => 0,
    'network' => 0,
    'BACKDROPS' => 0,
    'backdrop' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b8348f9d837d9_59613720')) {function content_5b8348f9d837d9_59613720($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("partials/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



	<!-- Intro -->

	<div class="intro">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="intro_content d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="intro_title_container">
							<div class="intro_title"><?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_name'];?>
</div>
							<div class="intro_tags">
								<ul>
<?php  $_smarty_tpl->tpl_vars["genre"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["genre"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['GENRES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["genre"]->key => $_smarty_tpl->tpl_vars["genre"]->value) {
$_smarty_tpl->tpl_vars["genre"]->_loop = true;
?>									
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/shows.php?genre=<?php echo $_smarty_tpl->tpl_vars['genre']->value['genre_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['genre']->value['genre_name'];?>
</a></li>
<?php } ?>									
<?php  $_smarty_tpl->tpl_vars["network"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["network"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['NETWORKS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["network"]->key => $_smarty_tpl->tpl_vars["network"]->value) {
$_smarty_tpl->tpl_vars["network"]->_loop = true;
?>									
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['BASEURL']->value;?>
/shows.php?network=<?php echo $_smarty_tpl->tpl_vars['network']->value['network_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['network']->value['network_name'];?>
</a></li>
<?php } ?>									
								</ul>
							</div>
						</div>
						<div class="intro_price_container ml-lg-auto d-flex flex-column align-items-start justify-content-center">
							<div>Keep This Show!</div>
							<div class="intro_price">100,234 Votes</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="intro_slider_container">

			<!-- Intro Slider -->
			<div class="owl-carousel owl-theme intro_slider">
				<!-- Slide -->
				<?php  $_smarty_tpl->tpl_vars["backdrop"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["backdrop"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['BACKDROPS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["backdrop"]->key => $_smarty_tpl->tpl_vars["backdrop"]->value) {
$_smarty_tpl->tpl_vars["backdrop"]->_loop = true;
?>
				<div class="owl-item"><img src="https://image.tmdb.org/t/p/original<?php echo $_smarty_tpl->tpl_vars['backdrop']->value['file_path'];?>
" alt=""></div>
				<?php } ?>				
			</div>

			<!-- Intro Slider Nav -->
			<div class="intro_slider_nav_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="intro_slider_nav_content d-flex flex-row align-items-start justify-content-end">
								<div class="intro_slider_nav intro_slider_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
								<div class="intro_slider_nav intro_slider_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Property -->

	<div class="property">
		<div class="container">
			<div class="row">
				
				<!-- Sidebar -->

				<div class="col-lg-4">
					<div class="sidebar">
						<div class="sidebar_search">
							<div class="sidebar_search_title"><?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_name'];?>
</div>
							<div class="sidebar_search_form_container">
								<form action="#" class="sidebar_search_form" id="sidebar_search_form">
									<select class="sidebar_search_select">
										<option disabled selected>Keywords</option>
										<option>Option</option>
										<option>Option</option>
										<option>Option</option>
										<option>Option</option>
									</select>
									<select class="sidebar_search_select">
										<option disabled selected>Property ID</option>
										<option>Option</option>
										<option>Option</option>
										<option>Option</option>
										<option>Option</option>
									</select>
									<select class="sidebar_search_select">
										<option disabled selected>Property Status</option>
										<option>Option</option>
										<option>Option</option>
										<option>Option</option>
										<option>Option</option>
									</select>
									<select class="sidebar_search_select">
										<option disabled selected>City</option>
										<option>Option</option>
										<option>Option</option>
										<option>Option</option>
										<option>Option</option>
									</select>
									<select class="sidebar_search_select">
										<option disabled selected>Property Type</option>
										<option>Option</option>
										<option>Option</option>
										<option>Option</option>
										<option>Option</option>
									</select>
									<div class="row sidebar_search_row">
										<div class="col-lg-6">
											<input type="text" class="sidebar_search_input" placeholder="Bedrooms No">
										</div>
										<div class="col-lg-6">
											<input type="text" class="sidebar_search_input" placeholder="Bathrooms No">
										</div>
									</div>

									<!-- Filter Price -->
									<div class="price_filter">
										<div class="price_filter_values d-flex flex-row align-items-center justfy-content-start">
											<div>Min Price</div>
											<div class="ml-auto">Max Price</div>
										</div>
										<input type="range" min="0" max="1000" step="10" value="250" data-rangeslider="" style="position: absolute; width: 1px; height: 1px; overflow: hidden; opacity: 0;">
									</div>

									<!-- Filter Area -->
									<div class="area_filter">
										<div class="price_filter_values d-flex flex-row align-items-center justfy-content-start">
											<div>Min Price</div>
											<div class="ml-auto">Max Price</div>
										</div>
										<input type="range" min="0" max="1000" step="10" value="300" data-rangeslider="" style="position: absolute; width: 1px; height: 1px; overflow: hidden; opacity: 0;">
									</div>
									<button class="sidebar_search_button search_form_button">search</button>
								</form>
							</div>
						</div>

						<!-- Realtor -->
						<div class="sidebar_realtor">
							<div class="sidebar_realtor_image"><img src="<?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_image_small'];?>
 alt=""></div>
						</div>
					</div>
				</div>
				
				<!-- Property Content -->
				<div class="col-lg-7 offset-lg-1">
					<div class="property_content">
						<div class="property_icons">
							<div class="property_title">Extra Facilities</div>
							<div class="property_text property_text_1">
								<p>Donec ullamcorper nulla non metus auctor fringi lla. Curabitur blandit tempus porttitor.</p>
							</div>
							<div class="property_rooms d-flex flex-sm-row flex-column align-items-start justify-content-start">

								<!-- Property Room Item -->
								<div class="property_room">
									<div class="property_room_title">Bedrooms</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="images/room_1.png" alt=""></div>
										<div class="room_num">4</div>
									</div>
								</div>

								<!-- Property Room Item -->
								<div class="property_room">
									<div class="property_room_title">Bathrooms</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="images/room_2.png" alt=""></div>
										<div class="room_num">3</div>
									</div>
								</div>

								<!-- Property Room Item -->
								<div class="property_room">
									<div class="property_room_title">Area</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="images/room_3.png" alt=""></div>
										<div class="room_num">7100 Sq Ft</div>
									</div>
								</div>

								<!-- Property Room Item -->
								<div class="property_room">
									<div class="property_room_title">Patio</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="images/room_4.png" alt=""></div>
										<div class="room_num">1</div>
									</div>
								</div>

								<!-- Property Room Item -->
								<div class="property_room">
									<div class="property_room_title">Garage</div>
									<div class="property_room_content d-flex flex-row align-items-center justify-content-start">
										<div class="room_icon"><img src="images/room_5.png" alt=""></div>
										<div class="room_num">2</div>
									</div>
								</div>

							</div>
						</div>

						<!-- Description -->

						<div class="property_description">
							<div class="property_title">Description</div>
							<div class="property_text property_text_2">
								<p><?php echo $_smarty_tpl->tpl_vars['SHOW']->value['show_description'];?>
</p>
							</div>
						</div>

						<!-- Additional Details -->

						<div class="additional_details">
							<div class="property_title">Additional Details</div>
							<div class="details_container">
								<ul>
									<li><span>bedroom features: </span>Main Floor Master Bedroom, Walk-In Closet</li>
									<li><span>dining area: </span>Breakfast Counter/Bar, Living/Dining Combo</li>
									<li><span>doors & windows: </span>Bay Window</li>
									<li><span>entry location: </span>Mid Level</li>
									<li><span>floors: </span>Raised Foundation, Vinyl Tile, Wall-to-Wall Carpet, Wood</li>
								</ul>
							</div>
						</div>

						<!-- Property On Map -->

						<div class="property_map">
							<div class="property_title">Property on map</div>
							<div class="property_map_container">

								<!-- Google Map -->
								<div id="google_map" class="google_map">
									<div class="map_container">
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php echo $_smarty_tpl->getSubTemplate ("partials/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
