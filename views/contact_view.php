<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <base href="<?php echo base_url();?>"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FQC BookStore</title>
<meta name="robots" content="index, follow" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<!-- Basic CSS Style (other styles are included in this file) -->
<link rel="stylesheet" type="text/css" href="css/style_1.css" media="screen" />
<link rel="stylesheet" media="screen and (max-width:900px)" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css"/>
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie8.css" media="all" />
<![endif]-->

<!-- JavaScript Files -->
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>

<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<script type="text/javascript">

// Form Validation

$(document).ready(function(){
    $("#captcha").attr("autocomplete", "off");


    function clear_form_elements(ele) {
        $(ele).find(':input').each(function() {
            switch(this.type) {
                case 'password':
                case 'select-multiple':
                case 'select-one':
                case 'text':
                case 'textarea':
                    $(this).val('');
                    break;
                case 'checkbox':
                case 'radio':
                    this.checked = false;
            }
        });
    }

    $("#send_message").click(function(e){

        // Stop the form from being submitted
        e.preventDefault();

        /* Declare the variables, var error is the variable that we use on the end
        to determine if there was an error or not */
        var error = false;
        var name = $("#name").val();
        var email = $("#email").val();
        var subject = $("#subject").val();
        var message = $("#message").val();
        var captcha = $("#captcha").val();

        /* In the next section we do the checking by using VARIABLE.length
        where VARIABLE is the variable we are checking (like name, email),
        length is a javascript function to get the number of characters */

        if(name.length == 0){
            var error = true;
            $("#name_error").fadeIn(500);
        }else{
            $("#name_error").fadeOut(500);
        }

        // Validate Email addresses with a JavaScript Regular Expression
        var emailPattern = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/; 
        if(!emailPattern.test(email)){
            var error = true;         
            $("#email_error").fadeIn(500);   
        }else{   
            $("#email_error").fadeOut(500);
        }

        if(captcha.length == 0){
            var error = true;
            $("#captcha_error").fadeIn(500);
        }else{
            $("#captcha_error").fadeOut(500);
        }

        if(message.length == 0){
            var error = true;
            $("#message_error").fadeIn(500);
        }else{
            $("#message_error").fadeOut(500);
        }

        // Now when the validation is done we check if the error variable is false (no errors)
        if(error == false){

            /* Using the jquery's post(ajax) function and a lifesaver
            function serialize() which gets all the data from the form
            we submit it to send_email.php */
            $.post("send_email.html", $("#feedback_form").serialize(),function(result){
                // And after the ajax request ends we check the text returned
                if(result == "sent"){

                    // And show the mail success div with fadeIn
                    if($("#mail_success").fadeIn(500)) {
                    	$("#mail_error").hide();
                    }

                    $('#feedback_form')[0].reset();
                    $("#mail_success").delay(8000).fadeOut(500);

                }else{
                    // Show the mail error div
                    if($("#mail_error").fadeIn(500)) {
                        $("#mail_success").hide();
                    }
                }
            });
        }
    });    
});

</script>

</head>

<body>
<div data-role="page">
<!-- Start Wrapper -->
<div data-role="main" class="ui-content">
<div id="wrapper">

    <!-- Start Header -->
    <div class="top-header"></div>

    <div id="header">
        <div class="into-header">

            <!-- Start Logo -->
            <div class="logo">
                <a href="index.php/default_control" target="_self"><img src="css/images/top_logo.jpg" alt="FQC BookStore" title="FQC BookStore" /></a>
            </div>
            <!-- End Logo -->

            <!-- Start Top Menu -->
            <div class="topmenu">

                <!-- Start Dropdown Menu -->
                <ul id="menu" class="menu-nav">

                    <li class="parent"><a href="index.php/default_control" target="_self">Home</a>
                        <ul class="child">
                            <li><a href="index.php/default_control" target="_self">With Nivo Slider</a></li>
                            <li><a href="index.php/default_control" target="_self">With Thumbnail Slider</a></li>
                        </ul>
                    </li>

                    <li class="parent"><a href="index.php/myaccount" target="_self">My account</a>
                        <ul class="child">
                            <li><a href="index.php/myaccount" target="_self">Full Description Portfolio</a></li>
                            <li><a href="index.php/myaccount" target="_self">2-Column Portfolio</a></li>
                            
                            
                        </ul>
                    </li>

                    

                    <li class="parent"><a href="index.php/cart_ctl" target="_self">Shopping Cart</a>
                        
                    </li>

                    <li class="current"><a href="">Contact</a></li>

                </ul>
                <!-- End Dropdown Menu -->

                <!-- Start Social -->
                <div class="social">
                    <ul>
                        <li><a href="#"><img src="css/images/social/twitter_off.png" alt="Twitter" title="Twitter" /></a></li>
                        <li><a href="#"><img src="css/images/social/facebook_off.png" alt="Facebook" title="Facebook" /></a></li>   
                        <li><a href="#"><img src="css/images/social/vimeo_off.png" alt="Vimeo" title="Vimeo" /></a></li>
                        <li><a href="#"><img src="css/images/social/flickr_off.png" alt="Flickr" title="Flickr" /></a></li>
                    </ul>
                </div>
                <!-- End Social -->

            </div>
            <!-- End Top Menu -->

            <div class="clear"></div>
        </div>
    </div>

    <div class="horizon-line"></div>  
    <div class="header-shadow"></div>
    <!-- End Header -->

    <!-- Start Content -->
    <div id="content">

        <!-- Start Topbar -->
        <div class="topbar">
            <h1>Contact / <em>How to find us</em></h1>
        </div>
        <!-- End Topbar -->

        <!-- Start Contact -->
        <div class="sidebars one-half-divider">

            <!-- Start Left Side --> 
            <div class="sidebar one-half-seg left">

                <!-- Start Contact Information -->
                <div class="contacts">
                    <span><strong>FQC BookStore</strong><br />1247 W 30th Str, Los Angeles, CA, USA</span>
                    <span><strong>Phone:</strong> +1 (323) 599-6634<br /><strong>Fax:</strong> +1 (123) 098-7654</span>
                    <span><strong>Email:</strong> <a href="mailto:fqcprodigy@icloud.com">fqcprodigy@icloud.com</a></span>
                </div>
                <!-- End Contact Information -->

                <!-- Start Location Map -->
                <div class="title left-pos"><h2>Location Map</h2></div>

                <div class="location-map">
                    <iframe width="436" height="416" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=casework,+QC,+Canada&amp;aq=&amp;sll=45.548376,-73.6106&amp;sspn=0.213022,0.528374&amp;t=m&amp;ie=UTF8&amp;hq=casework,+QC,+Canada&amp;hnear=&amp;cid=7643875063430673152&amp;z=12&amp;iwloc=A&amp;output=embed"></iframe>
                </div>
                <!-- End Location Map -->

            </div>
            <!-- End Left Side --> 

            <!-- Start Right Side -->
            <div class="sidebar one-half-seg right">

                <div class="corner-shadow right-one-half"></div>

                <!-- Start Contact Form -->
                <div class="title right-pos"><h2>Contact Form</h2></div>

                <!-- Start Feedback Form -->
                <div class="feedback-form">

                    <div class="info"><p>Nam accumsan id magna auctor sodales vivamus felis quam sodales. Phasellus elementum odio nec felis venenatis euismod.</p></div>

                    <!-- Start Notifications -->
                    <div id="mail_success" class="success-box"><p>Thank you! Your message has been successfully sent.</p></div>
                    <div id="mail_error" class="warning-box"><p>Something went wrong. Maybe captcha code is not correct.</p></div>
                    <!-- End Notifications -->
                    
                    <!-- Start Form -->
                    <form id="feedback_form" method="post" onsubmit="return false" action="#">

                        <fieldset>
                            <label>Your Name <span class="required">(required)</span><span id="name_error" class="error">Please enter your name</span></label>
                            <input type="text" name="name" id="name" value="" />

                            <label>Email <span class="required">(required)</span><span id="email_error" class="error">Enter your email or check the correct entry</span></label>
                            <input type="text" name="email" id="email" value="" />

                            <label>Subject</label>
                            <div class="feedback-field"><input type="text" name="subject" id="subject" value="" /></div>

                            <label>Message <span class="required">(required)</span><span id="message_error" class="error">Please type your message in the box below</span></label>
                            <textarea name="message" id="message" rows="5" cols="54"></textarea>

                            <div class="captcha-image">
                                <img src="css/images/send_email951f.png?code=1" id="security_code" alt="Security Code" title="Security Code" />
                            </div>

                            <div class="left">  
                                <label>Captcha Code <span class="required">(required)</span><span id="captcha_error" class="error">Enter captcha code</span></label>
                                <input type="text" name="captcha" id="captcha" maxlength="5" value="" />
                            </div>

                            <div class="feedback-button">
                                <a href="#" class="blue-button" id="send_message">Send Message</a>
                            </div>
                        </fieldset>

                    </form>
                    <!-- End Form -->

                </div>
                <!-- End Feedback Form -->
		
            </div>
            <!-- End Right Side -->

        <div class="clear"></div>
        </div>
        <!-- End Contact -->

    <div class="horizon-line"></div>
    </div>
    <!-- End Content -->

</div>
<!-- End Wrapper -->
</div>
<!-- Start Footer -->
<div data-role="footer">
<div id="footer">
    
    <div class="footer-shadow"></div>
    <div class="horizon-line"></div>

    <!-- Start Footer Blocks -->
    <div class="footer-bg">
    <div class="into-footer">

        <!-- Start Subscribe -->
        <div class="subscribe left">

            <div class="footer-title"><h3>Subscribe</h3></div>

            <div class="footer-block">
                <p>Subscribe to our newsletter today! Receive updates, tips, support and inspiration once a month.</p>

                <!-- Start Subscribe Form -->
                <div class="subscribe-form">
                    <form id="sub_form" method="post" action="#">
                        <fieldset>
                            <input class="subscribe-field" type="text" name="sub_email" id="sub_email" value="Subscribe via Email" onfocus="if (this.value == 'Subscribe via Email') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Subscribe via Email';}"  />
                            <div class="subscribe-button"><a href="#" onclick="this.blur(); return false;" class="blue-button" title="Click to Subscribe"><img src="css/images/subscribe_icon.png" alt="Subscribe" /></a></div>
                        </fieldset>
                    </form>
                </div>
                <!-- End Subscribe Form -->

                <p>As well subscribe to our <a href="#" title="Click to Subscribe">RSS Feed</a></p>
            </div>
        </div>
        <!-- End Subscribe -->

       

        <!-- Start Get in Touch -->
        <div class="get-in-touch right">

            <div class="footer-title"><h3>Get in Touch</h3></div>

            <div class="footer-block">
                <span class="location">1247 W 30th Str, Los Angeles, CA, USA</span>
                <span class="phone">+1 (123) 456-7890</span>
                <span class="email">fqcprodigy@icloud.com</span>
                <span class="feedback">Send email via <a href="contact">contact form</a></span>
            </div>
        </div>
        <!-- End Get in Touch -->

    </div>
    </div>
    <!-- End Footer Blocks -->

    <!-- Start Bottom Panel -->
    <div id="bottom">
        <div class="into-bottom">
            <span class="left">Casework &copy; 2013. All Rights Reserved.</span>            <div class="backtop" id="toTop" title="Back to Top"></div>
        </div>
    </div>
    <!-- End Bottom Panel -->

</div>
<!-- End Footer -->
</div>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</div>
</body>
</html>