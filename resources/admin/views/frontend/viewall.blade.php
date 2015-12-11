
@extends('frontend.index')
@section('content')
<?php 
/*get cat and sub cat ids from url*/
$currentRoute   = Route::current();
$parameters     = $currentRoute->parameters();
if($parameters)
{
  $cat  = SiteHelpers::CF_decode_json($parameters['one']);
  if(is_array($cat))
  {
    $categoryId = $cat[0];
    $subCatId   = $cat[1];
  }
  else
  {
    $categoryId = $cat[0];
    $subCatId   = '';
  }
}
else
{
  $categoryId = '';
  $subCatId   = '';
}
?>
<div class="main-banner m-none">
<img src="{{ URL::asset('images/banner-main.jpg') }}" alt="">
<!--main-banner --></div>

<div class="content-section">
<div class="left-column">
@if(isset($latest))
  @foreach($latest as $l)
  <?php 
  $lp[0] = $l->fk_category_id;
  $lp[1] = $l->fk_sub_category_id;
  $lp[2] = $l->pk_poll_id;
  $lpArr = SiteHelpers::CF_encode_json($lp);
  ?>
      <div class="section">
      <div class="image">
      <img src="{{ URL::asset('uploads/polls/thumb/'.$l->thumbnail) }}" alt="">
      <!--image --></div>

      <div class="description">
  
      <h2><a href="{{URL::to('/poll/'.$lpArr)}}">{{$l->title}}</a></h2>
      <div class="small-des">
      This is an aditional description and is optional
      <!--small-des --></div>
      <?php 
          $endDate    = strtotime($l->end_date);
          if(!empty($endDate))
          {
            $closeDate  = date('d-m-y',$endDate);
          }
          else
          {
            $closeDate = "Not specified";
          }
      ?>
      <div class="sub-sec">
      <ul>
      <li>contest based</li>
      <li>closes  {{$closeDate}}</li>
      <li>votes: 14,57,000</li>
      </ul>
      </div>
  </div>
</div>
@endforeach
@endif
<div class="pagination">
<ul>
<li><a href="#">&laquo;</a></li>
<li><a href="#">1</a></li>
<li><a href="#" class="active">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">&raquo;</a></li>
</ul>
<!--pagination --></div>

<!--left-column --></div>
<div class="middle-column">
<div class="sub-banner">
<img src="{{URL::asset('images/banner-sub.jpg')}}" alt="">
<!--sub-banner --></div>
<?php 
$latestArr      = array();
$latestArr[0]   = $categoryId;
$latestArr[1]   = $subCatId;
$latestArr[2]   = 'upcomming';
$lArr           = SiteHelpers::CF_encode_json($latestArr);


?>
@if(isset($upcomming) && !empty($upcomming))
<div class="coming-soon-section">
<h2><span>COMING SOON</span> <div class="view-more"><a href="{{URL::to('/viewall/'.$lArr)}}">view more</a></div></h2>

@foreach($upcomming as $up)
<?php 
/*for individual poll*/
  $u[0] = $up->fk_category_id;
  $u[1] = $up->fk_sub_category_id;
  $u[2] = $up->pk_poll_id;
  $upArr = SiteHelpers::CF_encode_json($u);
  ?>
  <div class="soon-section">
    <div class="soon-image"><img src="{{ URL::asset('uploads/polls/thumb/'.$up->thumbnail) }}" alt=""></div>
    <div class="soon-des">
      <a href = "{{ URL::asset('/poll/'.$lpArr) }}">{{$up->title}}</a>
    <div class="clear-fix"></div>
    <div class="sub-sec">
    <ul>
    <li>contest based</li>
    <li>votes: 14,57,000</li>
    </ul>
    </div>
    </div>
  </div>
@endforeach
<!--coming-soon-section --></div>
@endif

@if(isset($featured) && !empty($featured))
<?php 
$featuredArr      = array();
$featuredArr[0]   = $categoryId;
$featuredArr[1]   = $subCatId;
$featuredArr[2]   = 'featured';
$fArr           = SiteHelpers::CF_encode_json($featuredArr);
?>
<div class="featured-polls">
<h2><span>FEATURED POLLS</span> <div class="view-more"><a href="{{URL::to('/viewall/'.$fArr)}}">view more</a></div></h2>
@foreach($featured as $f)
<?php 
/*for individual poll*/
  $fp[0] = $f->fk_category_id;
  $fp[1] = $f->fk_sub_category_id;
  $fp[2] = $f->pk_poll_id;
  $fpArr = SiteHelpers::CF_encode_json($fp);
  ?>
<div class="soon-section">
<div class="soon-image"><img src="{{ URL::asset('uploads/polls/thumb/'.$f->thumbnail) }}" alt=""></div>
<div class="soon-des">
  <a href = "{{ URL::to('/poll/'.$fpArr) }}">{{$f->title}}</a>
<div class="clear-fix"></div>
<div class="sub-sec">
<ul>
<li>contest based</li>
<li>votes: 14,57,000</li>
</ul>
</div>
</div>
<!--soon-section --></div>
@endforeach
<!--featured-polls --></div>
@endif
@if(isset($closed) && !empty($closed))
<?php 
$closedArr      = array();
$closedArr[0]   = $categoryId;
$closedArr[1]   = $subCatId;
$closedArr[2]   = 'closed';
$cArr           = SiteHelpers::CF_encode_json($closedArr);
?>
<div class="closed-polls">
<h2><span>CLOSED POLLS</span> <div class="view-more"><a href="{{URL::to('/viewall/'.$cArr)}}">view more</a></div></h2>
<ul>
@foreach($closed as $c)

<li>{{$c->title}}(<span>contest based   votes 14,57,000</span>)</li>

@endforeach
</ul>
<!--closed-polls --></div>
@endif
<!--middle-column --></div>

<div class="right-column">
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

<div class="banner">
<img src="{{URL::asset('images/duh-add.jpg')}}" alt="">
<!--banner --></div>
<div class="banner">
<img src="{{URL::asset('images/banner-right2.jpg')}}" alt="">
<!--banner --></div>
<!--right-column --></div>

<!--content-section --></div>
@stop

