<?php 
  $categories     = SiteHelpers::mainCategory('category') ;
  $subCategories  = SiteHelpers::mainCategory('subcategory') ;

?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0" />
  <title>:: The Indian Edition ::</title>
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/layout.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/iPad.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/mobile-small.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/mobile-480.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/magnific-popup.css') }}"/>
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="{{ URL::asset('scripts/jquery-1.10.2.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('scripts/jquery.mmenu.min.all.js') }}"></script>
  <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/jquery.mmenu.all.css') }}" />
  <script type="text/javascript" src="{{ URL::asset('scripts/theia-sticky-sidebar.js') }}"></script>
  <script type="text/javascript">
    $(function() {
      $('nav#menu').mmenu();
    });
  </script>
</head>
<body>
<div class="mian-wrapper">
<div class="head-section-main">
<div class="head-section">
<div class="top-section">
<div class="second-menu"><a href="#menu"></a></div>
<div class="mobile-logo"><a href="index.htm"><img src="{{ URL::asset('images/small-logo.png') }}" alt=""></a></div>
<div class="logo">
<a href="index.htm"><img src="{{ URL::asset('images/logo.jpg') }}" alt=""></a>
<!--logo --></div>

<!--main-links start-->
<div class="main-links">
  <a href="#" class="active-links">All</a>
  @foreach($categories as $category)
  <a href="{{URL::to('/polls/'.SiteHelpers::CF_encode_json($category->pk_category_id))}}">{{$category->category_name}}</a>
  @endforeach
</div>
<!--main-links ends-->

<!-- before login start-->
<div class="login-box">
<ul id="inline-popups-new">
<li class="sign-in-c"><a href="#login-pop" data-effect="mfp-3d-unfold">Login</a></li>
<li><span> | </span></li>
<li class="sign-up-c"><a href="#login-pop" data-effect="mfp-zoom-out">Sign Up</a></li>
</ul>
</div>

<!-- before login ends -->
<!-- after login -->
<div class="after-login">
<div class="user-icon"><img src="{{ URL::asset('images/user.jpg') }}" alt=""></div>
<div class="lable">Suresh</div>
</div>


<!--top-section --></div>
<!--head-section  --></div>

<!--head-section-main --></div>
<div class="middle-section">
<div class="sub-links">
<?php $params = array();?>
@foreach($subCategories as $subcat)
<?php 
  $params[0] = $subcat->pk_sub_category_id;
  $params[1] = $subcat->fk_category_id;
?>
  <a href="{{URL::to('/polls/'.SiteHelpers::CF_encode_json($params))}}">{{$subcat->sub_category_name}}</a>
@endforeach
</div>
@yield('content')
@extends('frontend.layouts.footer')
<!--footer -->
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
<li class="sign-in-c active">SIGN IN</li>
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
<input type="text" name="textfield3" id="textfield3" placeholder="First Name">
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
<div id="signup-inner" style="display:none;">
<div class="signup-inner">
<p>Hi <span>Suresh Adams</span>, you are almost there. Please  fill the fields below to make the opinions and engagement more relevant and real.</p>
<div class="signup-inner-pop">
<div class="white-box">Gender: 
  <input type="radio" name="radio" id="radio" value="radio">
Male 
<input type="radio" name="radio2" id="radio2" value="radio2">
Female</div>
<div class="white-box">D.O.B:  Date 
  <select name="select" id="select" style="padding:2px">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
  <option>11</option>
    <option>12</option>
    <option>13</option>
    <option>14</option>
    <option>15</option>
    <option>16</option>
    <option>17</option>
    <option>18</option>
    <option>19</option>
    <option>20</option>
  <option>21</option>
  <option>11</option>
    <option>22</option>
    <option>23</option>
    <option>24</option>
    <option>25</option>
    <option>26</option>
    <option>27</option>
    <option>28</option>
    <option>29</option>
    <option>30</option>
     <option>31</option>
  </select>
  Month
  <select name="select2" id="select2" style="padding:2px">
  <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
  <option>11</option>
    <option>12</option>

  </select>
Year 
<select name="select3" id="select3" style="padding:2px">
  <option>2001</option>
    <option>2002</option>
    <option>2003</option>
    <option>2004</option>
    <option>2005</option>
    <option>2006</option>
    <option>2007</option>
    <option>2008</option>
    <option>2009</option>
    <option>2010</option>
  <option>2011</option>
    <option>2012</option>
    <option>2013</option>
    <option>2014</option>
    <option>2015</option>
    <option>2016</option>
    <option>2017</option>
</select>
<!--white-box --></div>
<div class="white-box">State: 
  <select name="select" id="select" style="padding:2px">
      <option selected>Select State</option>
      <option>Andra Pradesh</option>
      <option>Arunachal Pradesh</option>
      <option>Assam</option>
      <option>Bihar</option>
      <option>Chhattisgarh</option>
      <option>Goa</option>
      <option>Gujarat</option>
      <option>Haryana</option>
      <option>Himachal Pradesh</option>
      <option>Jammu and Kashmir</option>
      <option>Jharkhand</option>
      <option>Karnataka</option>
      <option>Kerala</option>
      <option>Madya Pradesh</option>
      <option>Maharashtra</option>
      <option>Manipur</option>
      <option>Meghalaya</option>
      <option>Mizoram</option>
      <option>Nagaland</option>
      <option>Orissa</option>
      <option>Punjab</option>
      <option>Rajasthan</option>
      <option>Sikkim</option>
      <option>Tamil Nadu</option>
      <option>Telangana</option>
      <option>Tripura</option>
      <option>Uttaranchal</option>
      <option>Uttar Pradesh</option>
      <option>West Bengal</option>
    </select>
</div>
<p>By clicking sign up, I acknowledge that I am at least 18 years of age.</p>
<p>By clicking sign up, I acknowledge that I am at least 18 years of age.</p>

<!--signup-inner-pop --></div>
<div class="signup-submit-button"><input type="submit" name="button2" id="button2" value="Submit"></div>
</div>
<!--forgot-pop --></div>
</body>


<script src='scripts/jquery.magnific-popup.min.js'></script>
<script src="scripts/index.js"></script>
<script>
$(document).ready(function(){
  $('.devices-menu').click(function(){
    $('.main-menu').toggle();
     $('.dashboard-menu').toggleClass('dashboard-menu-active');
     
  $(window).resize(function(){
  var divwidth=$("body").width();
  if(divwidth>768){
  $('.main-menu').show();
  }
  else
  if(divwidth<768){
  $('.main-menu').hide();
  }
  });
 
  });
});
</script>

<script>
$(document).ready(function(){
  $(".sign-in-m").click(function(){
  $('.login-module').slideToggle();
  });
  
  $(".sign-in-c").click(function(){
    $('.sign-in').show();
    $('.sign-up').hide();
    $( '.sign-in-c' ).addClass('active');
    $('.sign-up-c').removeClass('active');
  }); 
  
    $(".sign-up-c").click(function(){
    $('.sign-up').show();
    $('.sign-in').hide();
    $( '.sign-up-c' ).addClass('active');
    $('.sign-in-c').removeClass('active');

  }); 
  
  $(".blue-link").click(function(){
  $('.third-level-links').slideToggle();
  });
  
  $('.close-ic').click(function(){
  $('.third-level-links').slideUp();
  });
  
  
});
</script>






    <script type="text/javascript">
    $(function () {
        function HighlightLiTag(divId, btnDivId) {
            if ($(divId).length > 0) {
                $(divId).find('li').mouseover(function () {
                    $(this).css({ 'background-color': '#fff195' }); $(this).find(btnDivId).find('input[type=submit]').css({ 'background-color': '#99cc00' });
                }).mouseleave(function () {
                    $(this).removeAttr('style'); $(this).find(btnDivId).find('input[type=submit]').removeAttr('style');
                });;
            } else { return false; }
        }

        HighlightLiTag('.four-column,.three-column,.two-column,.single-column', '.small-desc');
    })
</script>

<!--<script type="text/javascript">
function equalHeight(group) {
    tallest = 0;
    group.each(function() {
        thisHeight = $(this).height();
        if(thisHeight > tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
}

$(document).ready(function(){
    equalHeight($(".four-c"));
});
$(document).ready(function(){
    equalHeight($(".three-c"));
});
$(document).ready(function(){
    equalHeight($(".two-c"));
});
$(document).ready(function(){
    equalHeight($(".single-c"));
});

</script>
 -->


<script type="text/javascript">


equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}

$(window).load(function() {
  equalheight('.four-c, .three-c, .two-c, .single-c');

});


$(window).resize(function(){
  equalheight('.four-c, .three-c, .two-c, .single-c');
});




</script>


<script>
$(document).ready(function(){
  $(".latest-c").click(function(){
  $('.latest').show();
  $('.you-voted, .closed').hide();
  $( '.latest-c' ).addClass('active');
  $('.you-voted-c, .closed-c').removeClass('active');
  });
  
  $(".you-voted-c").click(function(){
  $('.you-voted').show();
  $('.latest, .closed').hide();
  $( '.you-voted-c' ).addClass('active');
  $('.latest-c, .closed-c').removeClass('active');
  });
  
  $(".closed-c").click(function(){
  $('.closed').show();
  $('.latest, .you-voted').hide();
  $( '.closed-c' ).addClass('active');
  $('.latest-c, .you-voted-c').removeClass('active');
  });

});
</script>
    <script>
      $(document).ready(function() {
        $('.leftSidebar, .content, .rightSidebar')
          .theiaStickySidebar({
            additionalMarginTop: 30
          });
      });
    </script>
<html>
