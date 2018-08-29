	<div class="home_search">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_search_container">
						<div class="home_search_content">
							<form action="{$BASEURL}/shows.php" type="GET" class="search_form d-flex flex-row align-items-start justfy-content-start">
								<div class="search_form_content d-flex flex-row align-items-start justfy-content-start flex-wrap">
									<div>
										<select class="search_form_select" name="genre">
											<option disabled selected>Genre</option>
											{foreach from=$GENRES item="genre"}
											<option value="{$genre.genre_name}">{$genre.genre_name}</option>
											{/foreach}
										</select>
									</div>
									<div>
										<select class="search_form_select" name="network">
											<option disabled selected>Network</option>
											{foreach from=$NETWORKS item="network"}
											<option value="{$network.network_name}">{$network.network_name}</option>
											{/foreach}
										</select>
									</div>
									<div>
										<select class="search_form_select" name="language">
											<option disabled selected>Language</option>
											{foreach from=$LANGUAGES item="language"}
											<option value="{$language.language_name}">{$language.language_name}</option>
											{/foreach}
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
	</div>