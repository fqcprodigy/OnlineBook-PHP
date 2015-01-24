<!DOCTYPE html>
<?php
 $id=$product->product_id;
 $img=$product->img;
 $name=$product->name;
 $amount=$product->amount;
 $i_price=$product->price;
 $discount=$product->discount;
 $cost=$i_price*$discount;
 $this->load->helper('form');
 ?>
<html>
    <head>
        <base href="<?php echo base_url();?>"/>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="css/reset.css" />
<link type="text/css" rel="stylesheet" href="css/1024_768.css" />
<link type="text/css" rel="stylesheet" media="screen and (min-width:861px) and (max-width:960px)" href="<?php echo base_url().'css/pad_heng.css';?>" />
<link type="text/css" rel="stylesheet" media="screen and (min-width:601px) and (max-width:860px)" href="<?php echo base_url().'css/pad.css';?>" />
<link type="text/css" rel="stylesheet" media="screen and (min-width:481px) and (max-width:600px)" href="<?php echo base_url().'css/tel_heng.css';?>" />
<link type="text/css" rel="stylesheet" media="screen and (max-width:480px)" href="css/tel.css" />

        <title>Details of Book</title>
    </head>
    <body style="text-align:center;padding-bottom: 15px">
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
                    <li class="sel"><?php echo anchor('default_control','HOME','');?></li>
                	<li><a href="#">STORE</a></li>
                	<li><a href="#">PRESS</a></li>
                	<li><a href="#">ABOUT</a></li>
                	<li><a href="index.php/contact">CONTACT</a></li>
                </ul>
            </div>
            <div class="top_shop_cur"><a href="<?php echo site_url('cart_ctl');?>"><img src="<?php echo base_url('css/images/top_shop_cur.jpg');?>" alt="shopping car" /></a></div>
        </div>
                     
                <div><img style="margin-top: 50px;" height="308px" width="200px" src="<?php echo $img;?>"/>
                    <p class='book_title'><?php echo $name;?></p>
                    <p class='book_inline'>Initial Price: $<?php echo "$i_price";?></p>
                    <p class="book_inline">You have <?php if($discount==1){echo "no";} else{echo 100*$discount;}?>% discount.</p>
                    <?php echo form_open('cart_ctl/add_item');?>
                        <?php echo "<p>There are total $amount in storage.</p>";?>
                        <label for="num">You want to buy:</label>
                        <input name="num" required type="number" min="1" max="<?php echo $amount;?>"/>
                        <br>
                        <input name="proid" type="hidden" value="<?php echo $id;?>"/>
                        <input name="cost" type="hidden" value="<?php echo $cost;?>"/>
                        <input name="proname" type="hidden" value="<?php echo $name;?>"/>
                        <label for="cart">Put into cart</label>
                        <input type="image" name="cart" src="<?php echo base_url('css/img/cart.png');?>" height="20px" width="20px"/>
                    </form>
            </div>
        </div>
        </div>
    </body>
</html>
