<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="#"><img src="{$BASEURL}/media/logo2.png" style="height:100px;margin-top:-15px" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!--form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form-->
      {if $__USER.user_id > 0}
      <ul class="nav navbar-nav navbar-right">
          <li>
              <a href="#">Welcome, {$__USER.user_firstname} {$__USER.user_lastname}{if $ACTIVE_CUSTOMER} - {$ACTIVE_CUSTOMER.customer_name}{/if}</a></li>
        <li><a href="#">|</a></li>
        <li><a href="{$BASEURL}/login.php">Logout</a></li>
      </ul>
      
      
      
      
      {else}
      <div class="nav navbar-nav navbar-right address">
          
          Call (713) 861-9955<br />info@kurzco.com<br />4640 Brittmoore Rd.<br />Houston, TX 77041          
          
      </div>      
      


      {/if}    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>