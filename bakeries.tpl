{include file="partials/_header.tpl"}
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Bakeries</h1>

          <a href="{$BASEURL}/bakery_edit.php">Add Bakery</a>

<div class="container">
<table class="table table-striped table-condensed">
<tr>
<th>Bakery</th>
</tr>
{foreach from=$BAKERIES item=bakery}
<tr>
<td>
<a href="{$BASEURL}/bakery_edit.php?bakery_id={$bakery.bakery_id}">{if $bakery.bakery_name == ''}No Name{else}{$bakery.bakery_name}{/if}</a>
</td>
</tr>
{/foreach}
</table>

</div>

        </div>
{include file="partials/_footer.tpl"}
