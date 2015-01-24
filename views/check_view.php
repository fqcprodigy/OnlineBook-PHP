<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url();?>"/>
        <meta charset="UTF-8">
       <link type="text/css" rel="stylesheet" href="css/reset.css" />
<link type="text/css" rel="stylesheet" href="css/1024_768.css" />
<link type="text/css" rel="stylesheet" media="screen and (min-width:861px) and (max-width:960px)" href="css/pad_heng.css" />
<link type="text/css" rel="stylesheet" media="screen and (min-width:601px) and (max-width:860px)" href="css/pad.css" />
<link type="text/css" rel="stylesheet" media="screen and (min-width:481px) and (max-width:600px)" href="css/tel_heng.css" />
<link type="text/css" rel="stylesheet" media="screen and (max-width:480px)" href="css/tel.css" />
        <title>Checkout</title>
    </head>
    <body style="text-align: center">
        <div class="w_100_l top_title">
            <div class="main">
              <?php  echo "<p style='color:white'>Welcome,$cus->firstname!&nbsp;&nbsp<a href='index.php/myaccount'>My account</a>&nbsp;&nbsp;<a href='index.php/logout'>Logout</a></p>";
              ?>
            </div>
        </div>
        <div class="w_100_l">
            <div class="main">
                  <div class="top_banner">
            <div class="top_logo"><img src="css/images/top_logo.jpg" alt="FQC BookStore LOGO" /></div>
            <div class="top_menu">
            	<ul>
                    <li class="sel"><a href="index.php/default_control">HOME</a></li>
                	<li><a href="#">STORE</a></li>
                	<li><a href="#">PRESS</a></li>
                	<li><a href="#">ABOUT</a></li>
                	<li><a href="index.php/contact">CONTACT</a></li>
                </ul>
            </div>
            <div class="top_shop_cur"><a href="index.php/cart_ctl"><img src="css/images/top_shop_cur.jpg" alt="shopping car" /></a></div>
        </div>
        <?php
        if($success)
        {
            echo "<h1 style='color:green'>Order Submitted Successfully!</h1>";
        }
        else
        {
            echo "<h1 style='color:red'>Order Submitted Faild!</h1>";
            
        }
        ?>
          <div class="footer">
           <span class="span_1">&copy; Copyright 2014, A Book Apart, LLC</span>&nbsp;&nbsp;
           <a href="index.php/contact">Help & Contact us</a>
            <a class="a1" href="#">Press Room RSS feed</a>
            <a class="a2" href="#">FQC BookStore on Twitter</a>
            <span class="span_2"><b>Published by</b><img src="css/images/icon_hg.jpg" style="float:left" alt="" /></span>
        </div>
            </div>
        </div>
        
    </body>
</html>
