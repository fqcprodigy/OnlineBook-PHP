<!DOCTYPE HTML>

<html>
    
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>FQC BOOKSTORE</title>
<link type="text/css" rel="stylesheet" href="<?php echo base_url().'css/reset.css';?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url().'css/1024_768.css';?>" />
<link type="text/css" rel="stylesheet" media="screen and (min-width:861px) and (max-width:960px)" href="<?php echo base_url().'css/pad_heng.css';?>" />
<link type="text/css" rel="stylesheet" media="screen and (min-width:601px) and (max-width:860px)" href="<?php echo base_url().'css/pad.css';?>" />
<link type="text/css" rel="stylesheet" media="screen and (min-width:481px) and (max-width:600px)" href="<?php echo base_url().'css/tel_heng.css';?>" />
<link type="text/css" rel="stylesheet" media="screen and (max-width:480px)" href="<?php echo base_url().'css/tel.css';?>" />
</head>

<body>
<div class="w_100_l top_title">
	<div class="main">
            <?php
            if(!isset($this->session->userdata['cuslog']))
            {
               echo "<p>";
               echo anchor(site_url('login_ctl'),'Login','');
               echo "&nbsp;&nbsp;";
               echo anchor('register','Register','');
               echo "</p>";
            }
            else
            {
                $cus=$this->session->userdata['customer'];
                echo "<p style='color:white'>Welcome,".$cus->firstname."!&nbsp;&nbsp<a href='".site_url('myaccount')."'>My account</a>&nbsp;&nbsp;<a href='".site_url('logout')."'>Logout</a></p>";
            }
    	?>
    </div>
</div>

<div class="w_100_l">
	<div class="main">
      <div class="top_banner">
            <div class="top_logo"><img src="<?php echo base_url('css/images/top_logo.jpg');?>" alt="FQC BookStore LOGO" /></div>
            <div class="top_menu">
            	<ul>
                	<li class="sel"><a href="#">HOME</a></li>
                	<li><a href="#">STORE</a></li>
                	<li><a href="#">PRESS</a></li>
                	<li><a href="#">ABOUT</a></li>
                	<li><a href="contact">CONTACT</a></li>
                </ul>
            </div>
            <div class="top_shop_cur"><a href="<?php echo site_url('cart_ctl');?>"><img src="<?php echo base_url('css/images/top_shop_cur.jpg');?>" alt="shopping car" /></a></div>
        </div>
        <span class="index_img"><img src="<?php echo base_url('css/images/banner_img.jpg');?>" alt="Dan" border="0" usemap="#Map" />
        <map name="Map" id="Map">
          <area shape="rect" coords="857,230,930,269" href="#" alt="buy now" />
        </map>
        </span>
        <p class="index_hr"></p>
        
      <div class="content">
            <h1 class="h1_book_title">Wonderful Books</h1>
        	<ul>
            	<?php
                foreach ($result as $value)
                {
                    echo "<li>";
                    echo "<dl>";
                    $img=$value['img'];
                    $id=$value['product_id'];
                    $proname=$value['name'];
                    $type=$value['category'];
                    $imgsrc=  base_url()."css/".$img;
                    echo "<dd><a href='".site_url("bookdetail/index/$id")."' target='_blank'><img src='$imgsrc' alt='book' /></a></dd>";
                    echo "<dt>";
                    echo "<p class='book_title'>";
                    anchor("/bookdetail/index/$id",$proname,'');
                    echo "</p>";
                    echo "<p class='book_inline'>$type</p>";
                    echo "<a class='book_buy' href='bookdetail/index/$id' target='_blank'>BUY</a>";
                    echo "</dt>";
                    echo "</dl>";
                    echo "</li>";
                }
            	
            	?>
            		
                	
                	
                	
                        	
            </ul>
      </div>
        <p class="index_hr"></p>
        <div class="content_press">
        	<div class="press_porsen_01">
                <h1>Press Room</h1>
            	<dl>
                	<dd><img src="<?php echo base_url('css/images/img_men.jpg');?>" alt="person" /></dd>
                    <dt>
                    	<p class="date">Apr 03, 2014</p>
                        <p class="book_title"><a href="#" target="_blank">Design Is a Job audiobook</a></p>
                        <p class="book_intro">
                        We’re pleased to announce that <a href="#">Design Is a Job</a> by Mike Monteiro is now available in audiobook format, through <a href="#">Audible.com</a> and <a href="#">Amazon.com</a>. Narrated by the raconteur himself, experience the guidance, real-talk, and humor of our seminal book on design as a job.
                        </p>
                    </dt>
                </dl>
            </div>
            <div class="press_porsen_02">
                <h1><span class="span_2"><a href="#"> More Articles →</a></span><span class="span_1"><a href="#">Press Room RSS</a></span></h1>
            	<dl>
                	<dd><img src="<?php echo base_url('css/images/img_lives.jpg');?>" alt="book img" /></dd>
                    <dt>
                    	<p class="date">Mar 31, 2014</p>
                        <p class="book_title"><a href="#" target="_blank">A Few of Our Faves: March 31st</a></p>
                        <p class="book_intro">
                        As the madness of March comes to a close, we gathered up a few things that caught our attention during the last half of the month. <a href="#">Read on for more.</a>                        </p>
                    </dt>
                </dl>
            </div>
        </div>
        <p class="index_hr"></p>
        <h1 class="news_title">Newsletter</h1>
        <p class="news_title_1"><span class="span_1">Keep up to date with new book releases and announcements with our newsletter.</span><span class="span_2"></span></p>
        <p class="index_hr" style="margin-top:20px;"></p>
        <div class="footer">
           <span class="span_1">&copy; Copyright 2014, A Book Apart, LLC</span>&nbsp;&nbsp;
           <a href="contact.html">Help & Contact us</a>
            <a class="a1" href="#">Press Room RSS feed</a>
            <a class="a2" href="#">FQC BookStore on Twitter</a>
            <span class="span_2"><b>Published by</b><img src="<?php echo base_url('css/images/icon_hg.jpg');?>" style="float:left" alt="" /></span>
        </div>
    </div>
</div>

</body>
</html>