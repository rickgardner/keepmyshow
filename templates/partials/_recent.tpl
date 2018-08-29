			<div class="row properties_row">
				{foreach from=$SHOWS item="show"}				
				{include file="partials/_show_card.tpl" show=$show}
				{/foreach}
			</div>