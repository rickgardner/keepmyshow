{if $NAVSTACK}
<ol class="breadcrumb">
{foreach from=$NAVSTACK key=url item=nav name=navstack}
{if $smarty.foreach.navstack.last}
  <li class="active">{$nav}</li>
{else}
  <li><a href="{$BASEURL}/{$url}">{$nav}</a></li>
{/if}
{/foreach}
</ol>
{/if}