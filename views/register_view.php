<?php 
if(isset($this->session->userdata['customer']))
{
    $cus=$this->session->userdata['customer'];
    $set=TRUE;
    $action="index.php/register/update_now";
}
 else
 {
     $set=FALSE;
     $action="index.php/register/add_new";
 }
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="<?=base_url()?>" />
        <title>Register/Update</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <script  src="js/jquery.min.js"></script>
<script  src="js/ddaccordion.js"></script>
<style type="text/css">
.right_content{
width:625px;
margin: 0 auto;
padding:30px 0 0 10px;
}
</style>
<script>
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='css/images/plus.gif' class='statusicon' />", "<img src='css/images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
});
</script>
<script src="js/niceforms.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="css/niceforms-default.css" />
<?php
if(isset($fail))
{
    echo "<script>alert('register failed!')</script>";
}
?>
    </head>
    <body style="text-align:center;background-color: #cceac4">
      <div class="right_content">
      <div class="form">
      <form action="<?php echo $action;?>" id="update" method="post" class="niceform">
         
          <fieldset>
                    <dl>
                        <dt><label for="email">Email:</label></dt>
                        <dd><input required type="email" maxlength="50" name="email" value="<?php if($set){echo $cus->email;}?>"/>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="pass">Password:</label></dt>
                        <dd><input required type="password" name="pass" minlength="6" maxlength="30" /></dd>
                    </dl>
                    
                    
                    <dl>
                        <dt><label for="sex">Gender</label></dt>
                        
                        <dd style="text-align:left">
                            <input type="radio" name="sex" value="0" /><label class="check_label">Female</label>
                            <input type="radio" name="sex" value="1" /><label class="check_label">Male</label>
                            <input type="radio" name="sex" value="2" /><label class="check_label">Unknown</label>
                        </dd>
                    </dl>
                    
                    <dl>
                        <dt><label for="fname">First name:</label></dt>
                        <dd><input required onkeyup="value=value.replace(/[^\a-\z\A-\Z]/g,'')" type="text" value="<?php if($set){echo $cus->firstname;}?>" maxlength="45" name="fname"/></dd>
                    </dl>
                    
                    <dl>
                        <dt><label for="lname">Last name:</label></dt>
                        <dd><input required onkeyup="value=value.replace(/[^\a-\z\A-\Z]/g,'')" type="text" value="<?php if($set){echo $cus->lastname;}?>" maxlength="45" name="lname"/></dd>
                    </dl>
                    
                     <dl>
                        <dt><label for="addr">Addresss:</label></dt>
                        <dd><input required type="text" name="addr" value="<?php if($set){echo $cus->address;}?>" size="54"></dd>
                    </dl>
                     <dl>
                        <dt><label for="zip">Zip code:</label></dt>
                        <dd><input required type="text" onblur="value=value.replace(/\D/g,'')" onKeyUp="value=value.replace(/\D/g,'')" value="<?php if($set){echo $cus->zip;}?>" name="zip"  maxlength="5"></dd>
                    </dl>
                    
                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Submit">
                     </dl>
                     
                     
                    
                </fieldset>
                
         </form> 
      </div>
      </div>
    </body>
</html>
