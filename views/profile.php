<!DOCTYPE html>
<?php
$cus=$this->session->userdata['customer'];
?>
<html>
<head>
    <base id="base" href="<?php echo base_url();?>" />
    <meta http-equiv="Content-Type" charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
<title>My Account</title>
<link rel="stylesheet" type="text/css" media="screen and (max-width:2000px)" href="css/style2.css" />
<script src="js/jquery.min.js"></script>
<script src="js/ddaccordion.js"></script>
<script src="js/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" media="screen and (max-width:900px)" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css"/>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
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
<script src="js/jquery.jclock-1.2.0.js" ></script>
<script  src="js/jconfirmaction.jquery.js"></script>
<script src="js/search.js"></script>
<script>
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>
<script>
$(function($) {
    $('.jclock').jclock();
});
</script>
<script>
function show(id)
{
    $("#show").html("");
    var url=$("#base").attr("href")+"index.php/myaccount/order_detail/"+id;
    $.get(url,function(data,status){
       if(status==='success')
           $("#show").html("<h2>Order Detail:</h2>"+data);
    });
}
</script>
</head>
<body>

<div id="main_container">
<div  data-role="page" data-theme="b">
	<div class="header">
    
    
            <div class="right_header">Welcome, <?php echo "$cus->firstname;"?> <a href="index.php/default_control" target="_self">Visit site</a> | <a href="#" class="messages">Messages</a> | <a href="index.php/logout" target="_self" class="logout">Logout</a></div>
    <div class="jclock"></div>
    <div class="top_shop_cur"><a href="index.php/cart_ctl" target="_self"><img src="css/images/top_shop_cur.jpg" alt="shopping car" /></a></div>
    </div>
    
    
    <div class="main_content">
    <div data-role="main" class="ui-content">            
                    
                    
                    
    <div class="center_content">  
    
    
    
    <div class="left_content">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return false;">
    
            <div class="sidebarmenu">
            
                <a class="menuitem submenuheader" href="">Order Date</a>
                <div class="submenu">
                    <ul>
                        <li><a href="">This Month</a></li>
                        <li><a href="">A Month Ago</a></li>
                        <li><a href="">The Last Three Monthes</a></li>
                    </ul>   
                </div>
                
            
                <a class="menuitem submenuheader" href="">Total Cost</a>
                <div class="submenu">
                  <ul>
                        <li><a href="">Less than $100</a></li>
                        <li><a href="">Less than $300</a></li>
                        <li><a href="">More than $500</a></li>
                    </ul>     
                </div>
                
            <div class="sidebar_search">
            
           <input type="text" id="searchstr" class="search_input" placeholder="search keyword" />
           <input type="image" onclick="findIt()" class="search_submit" src="css/images/search.png" />
            
                        
            </div>
               
                    
            </div>
            </form>
      
           
              
    
    </div>  
    
    <div class="right_content">            
        
    <h2>My Order History</h2> 
                                       
<table id="rounded-corner" summary="Orders">
    <thead>
    	<tr>
            
            <th scope="col" class="rounded">Order_ID</th>
            <th scope="col" class="rounded">Total Price</th>
            <th scope="col" class="rounded">Date</th>
            <th scope="col" class="rounded">Status</th>
            <th scope="col" class="rounded">Details</th>
        </tr>
    </thead>
    <tbody id="table">
        <?php
        
        if($result->num_rows>0)
        {
            
            foreach ($result->result_array() as $value)
            {
                
                echo "<tr>";
      
                $id=$value['orderid'];
                echo "<td>$id</td>";
                $paid=$value['totalpaid'];
                echo "<td>$paid</td>";
                $date=$value['date'];
                echo "<td>$date</td>";
                $status=$value['status'];
                echo "<td>$status</td>";
                echo  "<td><input type='image' src='css/images/comment.png' onclick='show($id)' border='0' /></td>";
                echo  "</tr>";
            }
        }
    	?>
    </tbody>
</table>
    
    <br>    
    <h2>My Profile</h2>
    <div style="color: green">
    <?php
    echo "<p>First Name:$cus->firstname</p>";
    echo "<p>Last Name:$cus->lastname</p>";
    echo "<p>Email:$cus->email</p>";
    switch ($cus->sex)
    {
        case 0:$sex="Female";break;
        case 1:$sex="Male";break;
        case 2:$sex="Unknown";break;
    }
    echo "<p>Gender:$sex</p>";
    echo "<p>Address:$cus->address</p>";
    echo "<p>Zip code:$cus->zip</p>";
    ?>
    <a href="index.php/register" target="_blank" class="bt_red"><span class="bt_red_lft"></span><strong>Edit</strong><span class="bt_red_r"></span></a>
    <a href="index.php/default_control" target="_self" class="bt_blue"><span class="bt_blue_lft"></span><strong>Back</strong><span class="bt_blue_r"></span></a>     
    </div>
    <div style="color: blue" id="show">
       
    </div> 
    </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    </div>
    <div class="footer">
    <div data-role="footer">
    	<div class="left_footer">Reporst | Powered by <a href="http://indeziner.com">INDEZINER</a></div>
    	<div class="right_footer"><a href="http://indeziner.com"><img src="css/images/indeziner_logo.gif" alt="" border="0" /></a></div>
    </div>
    </div>

</div>
</div>
</body>
</html>