{include file="partials/_header.tpl"}
<link rel="stylesheet" href="./css/signin.css">

      <form class="form-signin" role="form" method="POST" action="{$BASEURL}/login.php">
        <h2 class="form-signin-heading">Please Sign In To Your Account</h2>
        <input type="hidden" name="referer" value="{$REFERER}" />
        <input type="text" name="login[user_email]" class="form-control" placeholder="Login" required autofocus>
        <input type="password" name="login[user_password]" class="form-control" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" name="login[remember_me]" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button><br />
        Don't have an account? <a href="{$BASEURL}/register.php">Create Your Account</a><Br />
        Forgot Your Password? <a href="{$BASEURL}/forgot_password.php">Reset it Now</a><Br />
      </form>

{include file="partials/_footer.tpl"}
