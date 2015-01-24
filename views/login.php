<!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Login</title>

	<!--- CSS -->
        <link rel="stylesheet" href="<?php echo base_url()."css/style.css";?>" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="fallback.css" /></noscript>
	<![endif]-->
        
	</head>

	<body>
            <?php 
            if($error)
            {
                echo "<script>alert('Wrong Email or Password!')</script>";
            }
            ?>
		<div id="container">
                    <form method="post" action="<?php echo site_url('login_ctl/check');?>">
				<div class="login">LOGIN</div>
				<div class="username-text">Username(Email):</div>
				<div class="password-text">Password:</div>
				<div class="username-field">
                                    <input type="email" onkeyup="value=value.replace(/[^\a-\z\A-\Z0-9\@\.]/g,'')" name="username" required placeholder="Username" />
				</div>
				<div class="password-field">
                                    <input type="password" required name="password" placeholder='Password' />
				</div>
				<input type="checkbox" name="remember-me" id="remember-me" /><label for="remember-me">Remember me</label>
				<div class="forgot-usr-pwd">Forgot <a href="#">username</a> or <a href="#">password</a>?</div>
                                <input type="submit" name="submit" value="GO" />
			</form>
		</div>
		<div id="footer">
                    FQC_Market<a href="http://www.usc.edu/" target="_blank" title="usc">&nbsp;&nbsp;Trojans</a>
		</div>
	</body>
</html>
