{include file="partials/_header.tpl"}
  <div class="input_form">
    <div class="container">
      <div class="row">
<h2>Add/Edit Show</h2>
        <!-- Contact Form -->
        <div class="col-lg-8">
          <div class="contact_form_container">
            <form action="{$BASEURL}/show_edit.php" class="contact_form" method="POST" id="contact_form">
              <input type="hidden" name="show[show_id]" value="{$SHOW.show_id}" />

              <div class="row">
                <!-- Name -->
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[show_name]" value="{$SHOW.show_name}" placeholder="Show Name" required="required">
                </div>
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[imdbid]" value="{$SHOW.imdbid}" placeholder="IMDB ID" required="required">
                </div>                <!-- Network -->
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[show_network]" value="{$SHOW.show_network}" placeholder="Show Network" required="required">
                </div>
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[show_uri]" value="{$SHOW.show_uri}" placeholder="Show URI" required="required">
                </div>
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[show_image_large]" value="{$SHOW.show_image_large}" placeholder="Show Large Image URL" required="required">
                </div>
                <div class="col-lg-6 contact_name_col">
                  <input type="text" class="contact_input" name="show[show_image_small]" value="{$SHOW.show_image_small}" placeholder="Show Small Image URL" required="required">
                </div>
              </div>
              <div><textarea class="contact_textarea contact_input" name="show[show_description]" placeholder="Description" required="required">{$SHOW.show_description}</textarea></div>
              <button type="submit" class="contact_button button">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 {include file="partials/_footer.tpl"}