
@extends('frontend.index')
@section('content')


<div class="mian-wrapper">
<div class="head-section-main">
<div class="head-section">
<div class="top-section">
<div class="second-menu"><a href="#menu"></a></div>
<div class="mobile-logo"><a href="index.htm"><img src="images/small-logo.png" alt=""></a></div>
<div class="logo">
<a href="index.htm"><img src="images/logo.jpg" alt=""></a>
<!--logo --></div>
<div class="main-links">
<a href="index.htm" class="active-links">news engage</a>
<a href="polls.htm">polls</a>
<a href="#">stories</a>
<a href="#">campaigns</a>
<a href="#">my voice</a>
<a href="#">brand of the week</a>
<a href="#">movie engage</a>
<a href="#">offbeat</a>
<!--main-links --></div>
<div class="login-box">
<ul id="inline-popups-new">
<li class="sign-in-c"><a href="#login-pop" data-effect="mfp-3d-unfold">Login</a></li>
<li><span> | </span></li>
<li class="sign-up-c"><a href="#login-pop" data-effect="mfp-zoom-out">Sign Up</a></li>
</ul>
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<!--login-box --></div>
<!--top-section --></div>
<!--head-section  --></div>
<div class="sub-menu-section">
<!--.sub-menu-section --></div>
<!--head-section-main --></div>
<div class="middle-section">
<div class="content-section">
<div class="contact-section">
<h1>Contact</h1>
<p>Is Arvind Kejriwal Becoming Much Of An Anarchist Is Arvind Kejriwal Becoming Much Of An Anarchist Is Arvind Kejriwal Becoming Much Of An Anarchist Is Arvind Kejriwal Becoming Much Of An Anarchist</p>

<div class="contact-section-inner">
<form method="post" action="{{ url('/contact')}}" class="form-vertical">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="left"> 
Email us at <a href="mailto:contact@theindianedition.com" class="red-link">contact@theindianedition.com</a>

<div class="name-lable">
Name
<!--name-lable --></div>
<div class="text-field">
<input type="text" name="name" id="textfield2" placeholder="Your Name" required="name">
<!--text-field --></div>


<div class="name-lable">
Email
<!--name-lable --></div>
<div class="text-field">
<input type="text" name="email_id" id="textfield2" placeholder="abc@xyz.com" required="email">
<!--text-field --></div>

<div class="name-lable">
Message
<!--name-lable --></div>
<div class="text-field">
<textarea name="message" rows="7" id="textfield2" placeholder="Leave us a message here" required="message"></textarea>
<!--text-field --></div>



<div class="send-button">
  <input type="submit" name="button" id="button" value="Submit">
</div>
</div>
</form>
<!--left -->

<div class="right">
<div class="gmap">
<iframe width="100%" height="280" style="border: 0; margin: 0;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Web+Synergies+(S)+Pte+Ltd+&amp;sll=1.326728,103.8961&amp;sspn=0.011391,0.02105&amp;ie=UTF8&amp;hq=Web+Synergies+(S)+Pte+Ltd&amp;hnear=&amp;t=m&amp;ll=1.326728,103.8961&amp;spn=0.011391,0.02105&amp;output=embed">
                        </iframe>
</div>
<div class="address">
<div class="location"></div>
<div class="location-add"> Alaikya Towers, 5th Floor, Plot 8, Survey 103/B,<br>
Banjarahiils, 
<br>
Hyderabad, Telangana - 500068
</div>
<div class="clear-fix"></div>
<div class="chat"></div>
<div class="location-add"> 040 6455 2727
</div>
<!--address --></div>

<!--right --></div> 
<!--contact-section-inner --></div>

<!--contact-section --></div>
<!--content-section --></div>
<!--middle-section --></div>
<div class="footer">
<div class="footer-links"><a href="aboutus.htm">ABOUT US</a>     <a href="advertise-with-us.htm">ADVERTISE & PARTNER WITH US</a>	<img src="images/red-patch.png" width="38" height="48" alt=""><a href="#">FAQS</a>         <a href="privacy.htm">PRIVACY POLICY</a>     <a href="contact.htm">CONTACT US</a> </div>                                    
<p>Copyright © 2015 indianedition.com.  All Rights Reserved.</p>
<!--footer --></div>
<!--mian-wrapper --></div>

<div id="forgot-pop" class="white-popup mfp-with-anim mfp-hide" style="display:inherit;">
<div class="forgot-container">
<h2>Forgot Password</h2>
<p>Enter your email address and we will send instruction on how to reset your password.</p>

<div class="forgot-password-pop"><input type="text" name="textfield" id="textfield" placeholder="Your mail Id"></div>
<div class="reset-button"><input type="submit" name="button2" id="button2" value="Reset Password"></div>
</div>
<!--forgot-pop --></div>

<div id="login-pop" class="white-popup mfp-with-anim mfp-hide" style="display:inherit;">
<div class="login-box">
<div class="login-module">
<div class="login-tab-nav">
<ul>
<li class="sign-in-c active">LOG IN</li>
<li class="sign-up-c">SIGN UP</li>
</ul>
<!--login-tab-nav --></div>
<div class="sign-in" style="display:block;">
<div class="facebook-login">
<a href="#"><img src="images/fb-1.jpg" alt=""> SIGN IN WITH FACEBOOK</a>
<!--facebook-login --></div>
<div class="google-login">
<a href="#"><img src="images/g+.jpg" alt=""> SIGN IN  with Google+</a>
<!--facebook-login --></div>
<div class="or"><div>or</div></div>
<div class="email">
<input type="text" name="textfield3" id="textfield3" placeholder="Email">
<!--email --></div>
<div class="password">
<input type="text" name="textfield3" id="textfield3" placeholder="Password">
<!--password --></div>
<div class="remember-me">
<input type="checkbox" name="Remember" id="Remember" class="css-checkbox" /><label for="Remember" class="css-label">Remember Me</label>
<!--remember-me --></div>
<div id="inline-popups" class="forgot-pass">
<a href="#forgot-pop" data-effect="mfp-3d-unfold">Forgot Password</a>
<!--forgot-pass --></div>
<div class="sign-in-button">

<input type="submit" name="button2" id="button2" value="sign in">
<!--sign-in-button --></div>
<!--sign-in --></div>

<div class="sign-up" style="display:none;">
<div class="facebook-login">
<a href="#"><img src="images/fb-1.jpg" alt=""> SIGN UP WITH FACEBOOK</a>
<!--facebook-login --></div>
<div class="google-login">
<a href="#"><img src="images/g+.jpg" alt=""> SIGN UP  with Google+</a>
<!--facebook-login --></div>
<div class="or"><div>or</div></div>
<div class="first-name">
<input type="text" name="textfield3" id="textfield3" placeholder="Firest Name">
<!--first-name --></div>
<div class="last-name">
<input type="text" name="textfield3" id="textfield3" placeholder="Last Name">
<!--first-name --></div>
<div class="email">
<input type="text" name="textfield3" id="textfield3" placeholder="Email">
<!--email --></div>
<div class="password">
<input type="text" name="textfield3" id="textfield3" placeholder="Password">
<!--password --></div>
<div class="text-lable">
Must be at least 8 characters, including 1 number, 1 symbol, and 1 uppercase letter
<!--text-lable --></div>
<div class="sign-in-button">
<input type="submit" name="button2" id="button2" value="sign up">
<!--sign-in-button --></div>
<div class="text-lable">
By clicking sign up, I acknowledge that I am at least 18 years of age.
<!--text-lable --></div>
<!--sign-up --></div>

<!--login-module --></div>
<!--login-box --></div>
<!--login-pop --></div>
