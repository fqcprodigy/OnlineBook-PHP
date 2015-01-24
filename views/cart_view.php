<!DOCTYPE html>

<html>
    <head>
        <base href="<?php echo base_url();?>" />
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery-1.7.1.min.js"></script>
        <link rel="stylesheet" media="screen and (max-width:900px)" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
        <script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
        <script src="js/jquery.min.js"></script>
        <script src="js/niceforms.js"></script>
        
        <script>
            $(document).ready(readyfunc);
            function gettotal()
            {
                 var rows=document.getElementById("rounded-corner").rows;
                 var sum=0.0;
                 for(var key=1;key<rows.length;key++)
                 {
                    sum+=parseFloat(rows[key].cells[3].innerHTML);
                 }
                 sum.toFixed(2);
                 return sum.toString();
            }
             function readyfunc()
            {
                $("#total").html("Total: $"+gettotal());
                $("input[name='del']").click(function(){
                    var ppname=$(this).parent().parent().find('td:first').html();
                    var url=$("base").attr('href')+"index.php/cart_ctl/del";
                    $.post(url,{name:ppname},function(data,status){
                        if(status==='success') location.reload(true);});     
                });
                $(":input[type='number']").change(function(){
                 var amount=parseInt($(this).val());
                 var tr=$(this).closest("tr");
                 var unitprice=tr.find('td:eq(2)').html();
                 tr.find('td:eq(3)').html((amount*parseFloat(unitprice)).toFixed(2).toString());
                 $("#total").html("Total: $"+gettotal());
                });
                $(":input[type='number']").blur(function(){
                  var tr=$(this).closest("tr")
                  var name=tr.find('td:first').html();
                  var amount=$(this).val();
                  var url=$("base").attr('href')+"index.php/cart_ctl/update";
                  $.post(url,{pname:name,amount:amount});
              });
                $("#show").click(function(){
                if(login)
                {
                    var len=$("#rounded-corner").find("tr").length;
                    if(len>0)
                    {
                        $("#check").css("display","block");
                        
                        $("input[name='totalpaid']").val(gettotal());
                    }
                    else
                        alert("Please first choose some books.");
                }
                else
                {
                    alert("Please first login before you checkout");
                    var url="index.php/cart_ctl/check";
                    $.ajax({url:url,async:false}); 
                    window.location.href="index.php/login_ctl";  
                }
                });
                $("#empty").click(function(){
                    var url="index.php/cart_ctl/empty_all";
                    $.ajax({url:url,success:function(){
                            $("#rounded-corner").html("Your cart is EMPTY.");
                            $("#total").html("Total: $0");
                    }});
                    $("#rec").html("");
                    $("#check").css("display","none");
                });
                
            }
        </script>
        <link rel="stylesheet" type="text/css" media="all" href="css/niceforms-default.css" />
        <title>Your Cart</title>
        <?php
        if(isset($this->session->userdata['cuslog']))
        {
            echo "<script>login=true;</script>";
            $cus=$this->session->userdata['customer'];
            $log=TRUE;
        }
        else
        {
            $log=FALSE;
            echo "<script>login=false;</script>";
        }
        ?>
        
        
        
            
    </head>
    <body style="padding: 10px;text-align:center;background-color: #ffa3a9">
        <div  data-role="page" data-theme="a">
            <div data-role="header">
        <div><img src="css/img/cart.png" style="width: 50px;height: 50px"/></div>
        <div><a target="_self" href="index.php/default_control">Back to HomePage</a></div>
            </div>
        <div data-role="main" class="ui-content">
        <table id="rounded-corner" summary="My Cart">
        <thead>
            <tr>
            <th scope="col" class="rounded">Product Name</th>
            <th scope="col" class="rounded">Amount</th>
            <th scope="col" class="rounded">Unit Price(after discount)</th>
            <th scope="col" class="rounded">Total Cost</th>
            <th scope="col" class="rounded">Delete</th>
            </tr>
        </thead>
        <tbody id="table">
         <?php
         if($this->cart->total()!=0)
         {
            foreach ($this->cart->contents() as $value)
            {
                echo "<tr>";
                $name=$value['name'];
                echo "<td>$name</td>";
                $num=$value['qty'];
                echo "<td><input type='number' min='1' value='$num'/></td>";
                $singleprice=$value['price'];
                $price=number_format($singleprice*$num,2);
                echo "<td>$singleprice</td>";
                echo "<td>$price</td>";
                echo "<td><input name='del' type='image' src='css/images/trash.png' border='0' /></td>";
                echo "</tr>";
            }
         }
         else
         {
             echo "<p>Your cart is EMPTY.</p>";
         }
         ?>
        </tbody>
        </table>
        <input id="empty" type="button" value="Empty"/>
        <input id="show" type="button" value="Checkout"/>
        <br><br>
        <div id="check" style="border: 3px solid;position: relative;padding-left: 400px;margin: 0 auto;display: none">
            <form class="niceform" target="_self" method="POST" action="index.php/checkout">
                <fieldset>
                    <dl>
                        <dt><label for="f_name">First Name:</label></dt>
                        <dd><input type="text" name="f_name" onkeyup="value=value.replace(/[^\a-\z\A-\Z\ ]/g,'')" required value="<?php if($log){ echo $cus->firstname;}?>"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="l_name">Last Name:</label></dt>
                        <dd><input type="text" name="l_name" onkeyup="value=value.replace(/[^\a-\z\A-\Z\ ]/g,'')" required value="<?php if($log){ echo $cus->lastname;}?>"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Email:</label></dt>
                        <dd><input type="email" name="email" required value="<?php if($log) echo $cus->email;?>"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="b_addr">Bill Address:</label></dt>
                        <dd><input type="text" name="b_addr" size="54" required value="<?php if($log) echo $cus->address;?>"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="s_addr">Ship Address:</label></dt>
                        <dd><input type="text" name="s_addr" required size="54" value="<?php if($log) echo $cus->address;?>"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="zip">Zip Code:</label></dt>
                        <dd><input type="text" name="zip" maxlength="5" onkeyup="value=value.replace(/[^0-9]/g,'')" required value="<?php if($log) echo $cus->zip;?>"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="card">Credit Card Num:</label></dt>
                        <dd><input type="text" name="card" onkeyup="value=value.replace(/[^0-9]/g,'')" required/></dd>
                    </dl>
                    <dl>
                        <dt><label for="card">CVS:</label></dt>
                        <dd><input type="text" name="cvs" maxlength="3" onkeyup="value=value.replace(/[^0-9]/g,'')" required/></dd>
                    </dl>
                    <dl>
                        <dt><label for="totalpaid">Total Cost:</label>
                        <dd><input type="text" name="totalpaid" readonly="readonly" /></dd>
                    </dl>
                    <dl class="submit">
                        <input type="submit" id="submit" value="Submit" />
                    </dl>
                </fieldset>
            </form>
        </div>
        <br>
        <div style="float: right;color: red;font-size: 40px" id="total"></div>
        <div id='rec' style="text-align: center">
            <?php
            if(isset($rec)&&$rec)
            {
       
                    echo "<p style='color:red'>People buy this book also buy:</p>";
                    foreach($rec as $row)
                    {
                        $id=$row->product_id;
                        $img= base_url()."css/".$row->img;
                        echo "<div style='padding:10px;display:inline'>";
                        echo "<a href='bookdetail/index/$id' target='_slef'><img src='$img' alt='book_for_you'/></a>";
                        echo "</div>";
                    }

            }
            ?>
        </div>
        </div>
        </div>
    </body>
</html>
