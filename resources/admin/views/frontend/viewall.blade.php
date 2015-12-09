@extends('frontend.index')
@section('content')

<div class="middle-section">
<div class="content-section">
<div class="tab-section">
<div class="tabs">
<ul>
<li><a href="#">Trending</a></li>
<li><a href="#" class="active">New</a></li>
<li><a href="#">Controversial <img src="{{URL::asset('/images/flame.png')}}" width="10" height="13" alt=""></a></li>
<li class="submit-a-link-c"><img src="{{URL::asset('images/chain.png')}}" alt=""> SUBMIT A LINK</li>
</ul>
<!--tabs --></div>

<div class="home-form-container">
<div class="home-form">
<div class="text-box">
  <input type="text" name="textfield2" id="textfield2" placeholder="http://ideas.ted.com/want-to-be-happy-slow-down/">
</div>
<div class="text-box">
  <textarea name="textarea" id="textarea" cols="45" rows="5" placeholder="Want to be happy? SLOW DOWN | ideas.ted.com this is the title given to this Article"></textarea>
</div>
<div class="text-box-blue">
  <input type="text" name="textfield2" id="textfield2" value="Business & Brands">
</div>

<p style="color:#F00">Oops the link already exists. Please click the link below to visit and discuss</p>
<p><a href="#" style="word-break:break-all; color:#666; text-decoration:none;">indianedition.com/comments/http://ideas.ted.com/want-to-be-happy-slow-down/</a></p>
<p>Click on a category below.</p>
<div class="submit-links"><a href="#">Politics & Gov</a>   <a href="#">India</a>     <a href="#">Sports</a>     <a href="#">Business & Brands</a>      <a href="#">Tech & Gadgets</a>     <a href="#">Auto</a>    <a href="#">Crime</a>      
<a href="#">Life</a>     <a href="#">World</a>      <a href="#">Bwood</a>    <a href="#">Twood</a>      <a href="#">Kwood</a>      <a href="#">Interesting</a>    <a href="#">Fun</a>      <a href="#">Politics & Gov</a>   <a href="#">India</a>     
<a href="#">Sports</a>     <a href="#">Business & Brands</a>      <a href="#">Tech & Gadgets</a>     <a href="#">Auto</a>    <a href="#">Crime</a>     <a href="#">Life</a>     <a href="#">World</a>      
<a href="#">Bwood</a>    <a href="#">Twood</a>      <a href="#">Kwood</a>      <a href="#">Interesting</a>     <a href="#">Andhra pradesh</a>    <a href="#">Telangana</a>    <a href="#">Tamil Nadu</a> </div>  
<!--home-form --></div>
<div class="add-link"><a href="javascript:void(0)" class="cancel-c">CANCEL</a> <a href="#" class="active">ADD LINK</a></div>
<!--home-form-container --></div>

@if(isset($latest))
<!-- poll start -->
@foreach($latest as $l)
<?php 
$catData[0]     = $l->fk_category_id;
$catData[1]     = $l->fk_sub_category_id;
$catData[2]     = $l->pk_poll_id;
$urlParams      = SiteHelpers::CF_encode_json($catData);
echo "URL::".$urlParams."<br/>";
?>
<div class="tab-section-with-thumb">
  <div class="shape-area">
    <div class="shape"></div>
    <div class="count">02034</div>
  </div>
  <div class="thumb-area">
      <img src="{{Url::asset('uploads/polls/thumb/'.$l->thumbnail)}}" alt="">
  </div>
  <div class="desc-area">
    <h4><a href="{{URL::to('/polls/'.$urlParams)}}">{{$l->title}}</a></h4>
    <div class="sec-bottom">
      <div class="video-icon video-icon-c"></div>
      <div class="small">by Suresh Adams   40 mins ago   from (indianedition.com)</div>
      <div class="small-links">
        <a href="#">123 comments - discuss</a>   <a href="#">share</a>   <a href="#">report</a>  
      </div>
    </div>
  </div>
  <div class="video-area">
    <div class="video">
      <iframe width="100%"  src="{{$l->video}}" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="video-bottom-banner">
      <img src="{{URL::asset('images/banner2.jpg')}}" alt="">
    </div>
  </div>
</div>
@endforeach
@endif


<!-- polls end -->


<!--tab-section --></div>
<div class="home-middle-column">
<div class="featured-polls">
<h1>FEATURED POLLS</h1>
<div class="content">
@if(isset($latest))
<!-- poll start -->
@foreach($latest as $l)
@if($l->featured_poll == 'yes')

  @if($l->poll_type != 'thumbnail without image')
  <div class="thumb-des">
  <div class="thumb">
  <img src="{{URL::asset('uploads/polls/thumb/'.$l->thumbnail)}}" alt="">
  <!--thumb --></div>
  <div class="des">
  {{$l->title}}
  <p>14,68,767 votes</p>
  <!--des --></div>
  <!--thumb-des --></div>
  @else
  <div class = "without-thumb-des">
  {{$l->title}}
  <p>contest based   14,68,767 votes</p>
  <!--without-thumb-des --></div>
  @endif

@endif
@endforeach
@endif
<div class="more-link">
<a href="#">more &raquo;</a>
</div>
<!--content --></div>
<!--featured-polls --></div>
<div class="orange-banner">
<img src="{{URL::asset('images/orange.jpg')}}" alt="">
<!--orange-banner --></div>
<div class="worth-nowing">
<h1>WORTH KNOWING - OFFBEAT</h1>
<div class="box">
<div class="thumb"><img src="{{URL::asset('images/offbeat1.jpg')}}"> </div>
<div class="desc">Small Optional Description Goes 
Here And Is Not Repeated In 
Widgets Will Go In Second Line</div>
<!--box --></div>
<div class="box">
<div class="thumb"><img src="{{URL::asset('images/offbeat2.jpg')}}"> </div>
<div class="desc">Small Optional Description Goes 
Here And Is Not Repeated In 
Widgets Will Go In Second Line</div>
<!--box --></div>
<div class="box">
<div class="thumb"><img src="{{URL::asset('images/offbeat1.jpg')}}"> </div>
<div class="desc">Small Optional Description Goes 
Here And Is Not Repeated In 
Widgets Will Go In Second Line</div>
<!--box --></div>
<div class="box">
<div class="thumb"><img src="{{URL::asset('images/offbeat2.jpg')}}"> </div>
<div class="desc">Small Optional Description Goes Here 
And Is Not Repeated In Live Widget</div>
<!--box --></div>

<!--worth-nowing --></div>
<!--home-middle-column --></div>
<div class="home-right-column">
<div class="right-top">
<h1>JOIN INDIAN EDITION</h1>
<div class="number-lable">
<h2>0,85,76,890</h2>
<span>Indians And Growing</span>
<!--number-lable --></div>
<div class="join">
<h2><div>Join IndianEdition</div></h2>
<div class="fb"><a href="#">Like Us On Facebook</a></div>
<div class="tw"><a href="#">Follow Us On Twitter</a></div>
<!--join --></div>
<div class="email">
<h2><div>OR SignUp With Email</div></h2>
<div class="name">
<!--name -->
<input type="text" name="textfield2" id="textfield2" placeholder="Name">
</div>
<div class="name">
<!--name -->
<input type="text" name="textfield2" id="textfield2" placeholder="Email">
</div>
<div class="name">
<input type="password" name="textfield2" id="textfield2" placeholder="Password">
<!--name --></div>
<div class="signup-but">

<input type="submit" name="button" id="button" value="Submit">
<!--signup-but --></div>
<!--email --></div>
</div>
<div class="campaigns">
<h1>CAMPAIGNS & PETITIONS</h1>
<div class="one-column-box">
<div class="thumb">
<img src="{{URL::asset('images/campaigns.jpg')}}" >
</div>
<div class="desc">Arvind Kejriwal: Appoint a special prosecutor 
and fast track the murder case of Soumya 
Viswanathan  -  <span>23,67,980</span> <a href="#">supporters</a></div>
<!--one-column-box --></div>
<div class="two-column-box">
<div class="thumb">
<img src="{{URL::asset('images/campaigns-small1.jpg')}}" >
</div>
<div class="desc">Arvind Kejriwal: Appoi
nt a special prosecutor 
and fast track the 
murder case of them.
<span>23,67,980</span> <a href="#">supporters</a></div>
</div>
<div class="two-column-box">
<div class="thumb">
<img src="{{URL::asset('images/campaigns-small2.jpg')}}" >
</div>
<div class="desc">Arvind Kejriwal: Appoi
nt a special prosecutor 
and fast track the 
murder case of them.
 <span>23,67,980</span> <a href="#">supporters</a></div>
</div>

<div class="more-link">
<a href="#">more &raquo;</a>
</div>
<!--campaigns --></div>
<div class="banner">
<img src="{{URL::asset('images/banner-right1.jpg')}}" alt="">
<!--banner --></div>
<div class="top-stories">
<h1>TOP STORIES</h1>
<div class="main-section">
<div class="main-img"><img src="{{URL::asset('images/top-stories-main.jpg')}}" alt=""></div>
<div class="main-desc">The root of Sushma Swaraj woes: Keith Vaz, the NRIs go-to-MP in Britain</div>
<!--main-section --></div>
<div class="short-stories">
<div class="thumb"><img src="{{URL::asset('images/section-img.jpg')}}" width="130" height="86" alt=""></div>
<div class="thumb-desc">Small Optional Description Goes 
Here And Is Not Repeated In 
Widgets Will Go In </div>
<!--short-stories --></div>
<div class="short-stories">
<div class="thumb"><img src="{{URL::asset('images/section-img2.jpg')}}" width="130" height="86" alt=""></div>
<div class="thumb-desc">Small Optional Description Goes 
Here And Is Not Repeated In 
Widgets Will Go In </div>
<!--short-stories --></div>
<!--top-stories --></div>
<!--home-right-column --></div>
<!--content-section --></div>
<!--middle-section --></div>

<script>
$(document).ready(function(){
	$(".video-icon-c").click(function(){
	$('.video-area').slideToggle();
	});
	
	$(".submit-a-link-c").click(function(){
	$('.home-form-container').show();
	});
	
	$('.cancel-c').click(function(){
	$('.home-form-container').hide();
	});

	
	$(".social-share-c").click(function(){
	$('.social-share').show();
	});
	
	$('.close-c').click(function(){
	$('.social-share').hide();
	});
});
</script>
@stop