
@extends('frontend.index')
@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
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
@stop


