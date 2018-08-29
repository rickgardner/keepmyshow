{if $__USER.user_id > 0}

<div class="col-sm-3 col-md-2 sidebar">
    
{if $__USER.user_role == "administrator"}
  <ul class="nav nav-sidebar">
    <li><a href="{$BASEURL}/dashboard.php">Dashboard</a></li>
    <li><a href="{$BASEURL}/order.php">Place Order</a></li>
    <li><a href="{$BASEURL}/orders.php">Order History</a></li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      Chains <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{$BASEURL}/chains.php">Chains</a></li>
        <li><a href="{$BASEURL}/customers.php">Customers</a></li>
    </ul>
  </li>        
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      Configuration <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{$BASEURL}/broadcast.php">Broadcast Message</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{$BASEURL}/bakeries.php">Bakeries</a></li>
        <li><a href="{$BASEURL}/distribution_centers.php">Distribution Centers</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{$BASEURL}/deadlines.php">Deadlines</a></li>
        <li><a href="{$BASEURL}/customer_deadlines.php">Deadline Overrides</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{$BASEURL}/holiday_days.php">Holiday Days</a></li>
        <li><a href="{$BASEURL}/holidays.php">Holiday Weeks</a></li>
        <li><a href="{$BASEURL}/extra_day_list.php">Open Days</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{$BASEURL}/routes.php">Routes</a></li>
        <li><a href="{$BASEURL}/route_override_list.php">Route Overrides</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{$BASEURL}/products.php">Products</a></li>
        <li><a href="{$BASEURL}/categories.php">Categories</a></li>
        <li><a href="{$BASEURL}/subcategories.php">Sub Categories</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{$BASEURL}/users.php">Users</a></li>
    </ul>
  </li>        
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      File Maintenance <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{$BASEURL}/import.php">Import Files</a></li>
        <li><a href="{$BASEURL}/export.php">Export File</a></li>
    </ul>
  </li>        
  </ul>    
{if $CURRENT_PAGE == "order.php"}    
<ul class="nav nav-sidebar">
    <li><a href="#" class="cust_dropdown" data-toggle="modal" data-target="#myModal"><span style="color:#000;">Select Customer</span><br />{if $ACTIVE_CUSTOMER}{$ACTIVE_CUSTOMER.customer_name}{else}<i>No customer selected</i>{/if}</a></li>
</ul>
{/if}
        
        
{elseif $__USER.user_role == "data-entry"}    
  <ul class="nav nav-sidebar">

    <li><a href="{$BASEURL}/dashboard.php">Dashboard</a></li>
    <li><a href="{$BASEURL}/order.php">Place Order</a></li>
    <li><a href="{$BASEURL}/orders.php">Order History</a></li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      Chains <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{$BASEURL}/chains.php">Chains</a></li>
        <li><a href="{$BASEURL}/customers.php">Customers</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      File Maintenance <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{$BASEURL}/import.php">Import Files</a></li>
        <li><a href="{$BASEURL}/export.php">Export File</a></li>
    </ul>
  </li>    
  </ul>    
{if $CURRENT_PAGE == "order.php"}    
<ul class="nav nav-sidebar">
    <li><a href="#" class="cust_dropdown" data-toggle="modal" data-target="#myModal"><span style="color:#000;">Select Customer</span><br />{if $ACTIVE_CUSTOMER}{$ACTIVE_CUSTOMER.customer_name}{else}<i>No customer selected</i>{/if}</a></li>
</ul>
{/if}

    
    
{else}    
    
  <ul class="nav nav-sidebar">
{foreach from=$LINKS item=link key=page}
    <li {if $CURRENT_PAGE eq $page}class="active"{/if}><a href="{$BASEURL}/{$page}">{$link}</a></li>
{/foreach}    
  </ul>    

{if $ONE_CUSTOMER != true && $__USER.user_role != "bakery-manager"}
<ul class="nav nav-sidebar">
    <li><a href="#" class="cust_dropdown" data-toggle="modal" data-target="#myModal"><span style="color:#000;">Select Customer</span><br />{if $ACTIVE_CUSTOMER}{$ACTIVE_CUSTOMER.customer_name}{else}<i>No customer selected</i>{/if}</a></li>
</ul>
{/if}


{/if}
</div>
{/if}
