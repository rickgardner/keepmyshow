{include file="partials/_header.tpl"}
	<div class="properties" style="margin-top:119px;">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title">{$SHOWS|@count} Shows found</div>
				</div>
			</div>
			<div class="row properties_row">
				{foreach from=$SHOWS item="show"}				
				{include file="partials/_show_card.tpl" show=$show}
				{/foreach}
			</div>
		</div>
	</div>
{include file="partials/_footer.tpl"}