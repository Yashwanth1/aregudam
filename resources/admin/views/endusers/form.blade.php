@extends('layouts.app')

@section('content')

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('admin/endusers?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	  	  
    </div>
 
 	<div class="page-content-wrapper">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'admin/endusers/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Users</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Pk User Id" class=" control-label col-md-4 text-left"> Pk User Id </label>
									<div class="col-md-6">
									  {!! Form::text('pk_user_id', $row['pk_user_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="First Name" class=" control-label col-md-4 text-left"> First Name <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('first_name', $row['first_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Password" class=" control-label col-md-4 text-left"> Password <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('password', $row['password'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Email Id" class=" control-label col-md-4 text-left"> Email Id <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('email_id', $row['email_id'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'parsley-type'=>'email'   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="State" class=" control-label col-md-4 text-left"> State <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='fk_state_id' rows='5' id='fk_state_id' class='select2 ' required  ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Gender" class=" control-label col-md-4 text-left"> Gender <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='gender' value ='male' required @if($row['gender'] == 'male') checked="checked" @endif > Male </label>
					<label class='radio radio-inline'>
					<input type='radio' name='gender' value ='female' required @if($row['gender'] == 'female') checked="checked" @endif > Female </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='active' required @if($row['status'] == 'active') checked="checked" @endif > Active </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='inactive' required @if($row['status'] == 'inactive') checked="checked" @endif > Inactive </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> </fieldset>
			</div>
			
			

		
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('admin/endusers?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#fk_state_id").jCombo("{{ URL::to('admin/endusers/comboselect?filter=states:pk_state_id:state_name') }}",
		{  selected_value : '{{ $row["fk_state_id"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop