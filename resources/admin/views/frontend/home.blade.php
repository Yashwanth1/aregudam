
@extends('frontend.index')
@section('content')

<div class="main-banner m-none">
<img src="{{ URL::asset('images/banner-main.jpg') }}" alt="">
<!--main-banner --></div>
<div class="content-section">

<div class="left-main">
<div class="middle-column-sub">
<div class="middle-section-button">
<a href="#" class="facebook"><i class="fa fa-facebook"></i> &nbsp;Post to Facebook</a>
<a href="#" class="next-poll">Next Poll <i class="fa fa-angle-double-right"></i></a>
<!--middle-section-button --></div>

<div class="google-add">
<img src="{{ URL::asset('images/google-add.jpg') }}" alt="">
<!--google-add --></div>

<div class="sub-sec-inner">
<ul>
<li>12,56,000 <span style="font-size:12px;">votes</span></li>  
<li class="red-txt">VOTE TO REVIEW RESULTS</li>  
<li class="date-close">
	<?php 
		$startDate = strtotime($polls->start_date);
		echo date('j,F,Y',$startDate);
	?>
</li>
<li class="date-close">
	<?php
	$endDate = strtotime($polls->end_date);
	echo 'closes:'. date('j,F,Y',$endDate);
	?>
</li>    

</ul>
</div>
<h1>{{$polls->title}}</h1>
<div class="description">{{$polls->description}} </div>
<div class="video-big">
	@if($polls->video)
		<iframe src="{{$polls->video}}"></iframe>
	@else
		<img src="{{ URL::asset('uploads/polls/'.$polls->image) }}"  alt="">
	@endif
</div>
<?php 
	$pollOptions = $polls->options;
	$jsonOptions = json_decode($pollOptions);
	
?>
@if($polls->poll_type =="four column")
<!--four-column start-->
<div class="four-column">
<ul>
@foreach($jsonOptions as $opt)
<li>
	<div class="thumb">
		<img src="{{ URL::asset('/uploads/options/'.$polls->pk_poll_id.'/'.$opt->image) }}" alt="">
	</div>
	<div class="small-desc">
		<p class="four-c">{{$opt->title}}</p>
		<input type="submit" name="button" id="button" value="Vote">
	</div>
</li>
@endforeach
</ul>
</div>
<!--four-column ends-->
@elseif($polls->poll_type =="three column")
<!--three-column start-->
<div class="three-column">
<ul>
@foreach($jsonOptions as $opt)
<li>
	<div class="thumb">
		<img src="{{ URL::asset('/uploads/options/'.$polls->pk_poll_id.'/'.$opt->image) }}" alt="">
	</div>
	<div class="small-desc">
		<p class="three-c">{{$opt->title}}</p>
		<input type="submit" name="button" id="button" value="Vote">
	</div>
</li>
@endforeach
</ul>
</div>
<!--three-column ends-->
@elseif($polls->poll_type =="two column")
<!--two-column start-->
<div class="two-column">
<ul>
@foreach($jsonOptions as $opt)
<li>
<div class="thumb"><img src="{{ URL::asset('/uploads/options/'.$polls->pk_poll_id.'/'.$opt->image) }}" alt=""></div>
<div class="small-desc"><p class="two-c">{{$opt->title}}</p>

<input type="submit" name="button" id="button" value="Vote">
</div>
</li>
@endforeach
</ul>
</div>
<!--two-column ends-->
@elseif($polls->poll_type =="one column")
<!--one-column starts-->
<div class="single-column">
<ul>
@foreach($jsonOptions as $opt)
	<li>
		<div class="thumb">
			<img src="{{ URL::asset('/uploads/options/'.$polls->pk_poll_id.'/'.$opt->image) }}" alt="">
		</div>
		<div class="small-desc"><p class="single-c">{{$opt->title}}</p>
			<input type="submit" name="button" id="button" value="Vote">
		</div>
	</li>
@endforeach
</ul>
</div>
<!--one-column ends-->
@elseif($polls->poll_type == "thumbnail without image")
<!-- thumbnail without image start-->
<div class="bar-with-out-thumb">
@foreach($jsonOptions as $opt)
<div class="item">
<div class="bar-desc">
<p class="single-line"> {{$opt->title}}</p>
  <!--bar-desc --></div>
<div class="vote-but">
    <input type="submit" value="Vote" id="button" name="button">
  </div>
</div>
@endforeach
</div>
<!-- thumbnail without image ends -->
@elseif($polls->poll_type == "thumbnail with image")
<!-- thumbnail with image starts -->

<div class="bar-with-thumb">
@foreach($jsonOptions as $opt)
	<div class="item">
		<div class="thumb">
			<img alt="" src="{{ URL::asset('/uploads/options/'.$polls->pk_poll_id.'/'.$opt->image) }}">
		</div>
		<div class="bar-desc">
			<p class="single-line">{{$opt->title}} </p>
		</div>
		<div class="vote-but">
			<input type="submit" value="Vote" id="button" name="button">
		</div>
	</div>
@endforeach
</div>
<!-- thumbnail with image ends -->
@endif

<div class="google-add">
<img src="{{ URL::asset('images/google-add2.jpg') }}" alt="">
<!--google-add --></div>

<div class="bottom-section-button">
<a href="#" class="next-poll">Next Poll <i class="fa fa-angle-double-right"></i></a>
<div class="clear-fix"></div>
<a href="#" class="facebook"><i class="fa fa-facebook"></i> &nbsp;Post to Facebook</a>

<!--middle-section-button --></div>

<div class="commnets-discussions">
<h3>Comments/discussions below the polls</h3>
<div class="tab-sub-section">
<div class="soon-image"><img src="{{ URL::asset('images/section-img2.jpg') }}" alt=""></div>
<div class="soon-des">How Informative Do You 
Think This Website Is? Think This Website Is?
</div>

<!--featured-section --></div>
<div class="tab-sub-section">
<div class="soon-image"><img src="{{ URL::asset('images/section-img3.jpg') }}" alt=""></div>
<div class="soon-des">How Informative Do You 
Think This Website Is?
This Website Is?
</div>
<!--featured-section --></div>
<div class="clear-fix"></div>
<div class="tab-sub-section">
<div class="soon-image"><img src="{{ URL::asset('images/section-img5.jpg') }}" alt=""></div>
<div class="soon-des">How Informative Do You 
Think This Website Is?
This Website Is?
</div>
<!--featured-section --></div>
<div class="tab-sub-section">
<div class="soon-image"><img src="{{ URL::asset('images/section-img2.jpg') }}" alt=""></div>
<div class="soon-des">How Informative Do You 
Think This Website Is? Think This Website Is?
</div>

<!--featured-section --></div>
<div class="clear-fix"></div>
<div class="tab-sub-section">
<div class="soon-image"><img src="{{ URL::asset('images/section-img3.jpg') }}" alt=""></div>
<div class="soon-des">How Informative Do You 
Think This Website Is?
This Website Is?
</div>
<!--featured-section --></div>
<div class="tab-sub-section">
<div class="soon-image"><img src="{{ URL::asset('images/section-img5.jpg') }}" alt=""></div>
<div class="soon-des">How Informative Do You 
Think This Website Is?
This Website Is?
</div>
<!--featured-section --></div>

<!--commnets-discussions --></div>


<!--middle-column-sub --></div>

<div class="left-column-sub">
<div class="left-tabs">
<ul>
<li class="latest-c active">LATEST</li>
<li class="you-voted-c">YOU VOTED</li>
<li class="closed-c">CLOSED</li>
</ul>
<!--right-tabs --></div>
<!--latest starts-->
<div class="latest" style="display:block;">
<?php
$latestNoImage 	= array();
$latestImage 	= array(); 
foreach ($latest as $l) {
	if($l->poll_type == "thumbnail without image")
	{
		$latestNoImage[] = $l;
	}
	else
	{
		$latestImage[] = $l;
	}
}
if(count($latestImage))
{
foreach ($latestImage as $key) {
?>
<div class="tab-sub-section">
<div class="soon-image"><img src="{{ URL::asset('uploads/polls/thumb/'.$key->thumbnail) }}" alt=""></div>
<div class="soon-des"><?php echo $key->title;?>
</div>
<!--soon-section --></div>
<?php }}//withimage?>

<?php
if(count($latestNoImage)) 
{
foreach ($latestNoImage as $key1) {
?>
<div class="tab-sub-section">
<?php echo $key1->title;?>
</div>
<?php }}?>
<div class="view-all"><a href="#">VIEW ALL</a></div>
</div>
<!--latest ends-->

<!-- you voted start -->
<div class="you-voted"  style="display:none;">
<div class="tab-sub-section">
<div class="soon-image"><img src="{{ URL::asset('images/section-img2.jpg') }}" alt=""></div>
<div class="soon-des-active">How Informative Do You 
Think This Website Is?
</div>
</div>
<div class="tab-sub-section">
How Informative Do You Think This Website 
Is? This Website Is?
</div>

<div class="view-all"><a href="#">VIEW ALL</a></div>
</div>
<!-- you voted ends -->
<!-- closed starts -->
<div class="closed"  style="display:none;">
<?php
$closedNoImage 	= array();
$closedImage 	= array();
if(count($closed))
{ 
	foreach ($closed as $c) 
	{
		if($c->poll_type == "thumbnail without image")
		{
			$closedNoImage[] = $l;
		}
		else
		{
			$closedImage[] = $l;
		}
	}
}
else
{
	echo "No Closed POlls";
}
if(count($closedImage))
{
	foreach ($closedImage as $ckey) {
?>
	<div class="tab-sub-section">
	<div class="soon-image"><img src="{{ URL::asset('uploads/polls/thumb/'.$ckey->thumbnail) }}" alt=""></div>
	<div class="soon-des"><?php echo $ckey->title;?>
	</div>
	</div>
<?php }}?>
<?php 
if(count($closedNoImage))
{
	foreach ($closedNoImage as $ckey1) {
?>
<div class="tab-sub-section">
<?php echo $ckey1->title;?>
</div>
<?php }}?>
<div class="view-all"><a href="#">VIEW ALL</a></div>
</div>
<!-- closed ends -->

<!-- featured polls start -->
<div class="featured-head">
	<h2>FEATURED</h2>
	@if(count($featured))
	@foreach($featured as $fkey)
	<div class="tab-sub-section">
		<div class="soon-image">
			<img src="{{ URL::asset('uploads/polls/thumb/'.$fkey->thumbnail) }}" alt="">
		</div>
		<div class="soon-des">
			{{$fkey->title}}
		</div>
	</div>
	@endforeach
	@endif
</div>
<!-- featured poll ends -->
</div>
</div>
<div class="right-column-sub">
<div class="banner">
<img src="{{ URL::asset('images/duh-add.jpg') }}" alt="">
<!--banner --></div>

<div class="featured-head">
<h2>FEATURED</h2>
@if(count($featured))
	@foreach($featured as $fkey)
	<div class="tab-sub-section">
		<div class="soon-image">
			<img src="{{ URL::asset('uploads/polls/thumb/'.$fkey->thumbnail) }}" alt="">
		</div>
		<div class="soon-des">
			{{$fkey->title}}
		</div>
	</div>
	@endforeach
@endif

<!--featured-head --></div>

<!--right-column-sub --></div>
<!--content-section --></div>
<!--middle-section --></div>
		
@stop