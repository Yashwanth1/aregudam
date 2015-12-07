@extends('layouts.login')
<?php
/*foreach ($states as $state) {
	echo "<pre>";
	print_r($state->getAttribute('pk_state_id'));
	die;
}*/
?>
@section('content')
<div class="sbox">
	<div class="sbox-title">
			
				<h3 >{{ CNF_APPNAME }}</h3>
				
	</div>
	<div class="sbox-content">
	<div class="text-center  animated fadeInDown delayp1">
		<img src="{{ asset('sximo/images/logo-sximo.png')}}" width="70" height="70" />
	</div>		
 {!! Form::open(array('url'=>'/create', 'class'=>'form-signup')) !!}
	    	@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.firstname') }}	 </label>
	  {!! Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=>'First Name' ,'required'=>'' )) !!}
		<i class="icon-users form-control-feedback"></i>
	</div>
	
	<!-- <div class="form-group has-feedback">
		<label>{{ Lang::get('core.lastname') }}	 </label>
	 {!! Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>'Last Name','required'=>'')) !!}
		<i class="icon-users form-control-feedback"></i>
	</div> -->
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.email') }}	 </label>
	 {!! Form::text('email_id', null, array('class'=>'form-control', 'placeholder'=>'Email Address','required'=>'email')) !!}
		<i class="icon-envelop form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.password') }}	</label>
	 {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password','required'=>'')) !!}
		<i class="icon-lock form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.repassword') }}	</label>
	 {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password','required'=>'')) !!}
		<i class="icon-lock form-control-feedback"></i>
	</div>
    @if(CNF_RECAPTCHA =='true') 
    <div class="form-group has-feedback  animated fadeInLeft delayp1">
        <label class="text-left"> Are u human ? </label>    
        <br />
        {!! captcha_img() !!} <br /><br />
        <input type="text" name="captcha" placeholder="Type Security Code" class="form-control" required/>

        <div class="clr"></div>
    </div>
    @endif						

    	<div class="form-group has-feedback" >
		<label>State</label>
		<!-- <div class="col-md-6"> -->
		  <!-- <select name='fk_state_id' rows='5' id='fk_state_id' class='select2 ' required  ></select>  -->
		 <select name="state" class="form-control">
		 	<option value = ''>Please select</option>
		 	@foreach($states as $state)
		 	<option value = '{{$state->getAttribute("pk_state_id")}}'>{{$state->getAttribute('state_name')}}</option>
		 	@endforeach
		 </select>
		 <!-- </div> --> 
		 <!-- <div class="col-md-2">
		 	
		 </div> -->
	  </div>

	  <div class="form-group has-feedback" >
		<label>Gender</label>
		<label>
					<input type='radio' name='gender' value ='male' required > Male </label>
					<label>
					<input type='radio' name='gender' value ='female' required > Female </label>
	  </div>

      <div class="row form-actions">
        <div class="col-sm-12">
          <button type="submit" style="width:100%;" class="btn btn-primary pull-right"><i class="icon-user-plus"></i> {{ Lang::get('core.signup') }}	</button>
       </div>
      </div>
	  <p style="padding:10px 0" class="text-center">
	  <a href="{{ URL::to('admin/user/login')}}"> {{ Lang::get('core.signin') }}  </a> | <a href="{{ URL::to('admin/')}}"> {{ Lang::get('core.backtosite') }}  </a> 
   		</p>
 {!! Form::close() !!}
 </div>
</div> 
@stop
