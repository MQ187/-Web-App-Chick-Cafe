<!DOCTYPE html>
<html>
	<head>
		<title>Main | Chick Cafe</title>
		<link type="text/css" href="images/styles.css" rel="stylesheet" media="screen" />
    <script type="text/javascript">
      $(document).ready(function(){
  $('#login-trigger').click(function(){
    $(this).next('#login-content').slideToggle();
    $(this).toggleClass('active');          
    
    if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
      else $(this).find('span').html('&#x25BC;')
    })
});
    </script>
	</head>

	<body>
	<nav>
  <ul>
    <li id="login">
      <a id="login-trigger" href="#">
        Log in <span>▼</span>
      </a>
      <div id="login-content">
        <form>
          <fieldset id="inputs">
            <input id="username" type="text" name="Email" placeholder="Your email address" required>   
            <input id="password" type="password" name="Password" placeholder="Password" required>
          </fieldset>
          <fieldset id="actions">
            <input type="submit" id="submit" value="Log in">
            <label><input type="checkbox" checked="checked"> Keep me signed in</label>
          </fieldset>
        </form>
      </div>                     
    </li>
    <li id="signup">
      <a href="">Sign up FREE</a>
    </li>
  </ul>
</nav>
	</body>
</html>