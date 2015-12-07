@extends('layouts.app')

@section('content')
<?php
if(isset($row['target_state']))
{
	$targetState 	= $row['target_state'];
	$implodeState 	= explode(",",$targetState);
}
else
{
	$implodeState = "";
}

?>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('admin/poll?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'admin/poll/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Poll</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Pk Poll Id" class=" control-label col-md-4 text-left"> Pk Poll Id </label>
									<div class="col-md-6">
									  {!! Form::text('pk_poll_id', $row['pk_poll_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Category" class=" control-label col-md-4 text-left"> Category <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='fk_category_id' rows='5' id='fk_category_id' class='select2 ' required  ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Sub Category" class=" control-label col-md-4 text-left"> Sub Category </label>
									<div class="col-md-6">
									  <select name='fk_sub_category_id' rows='5' id='fk_sub_category_id' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-4 text-left"> Title <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <textarea name='title' rows='5' id='title' class='form-control '  
				         required  >{{ $row['title'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Description" class=" control-label col-md-4 text-left"> Description </label>
									<div class="col-md-6">
									  <textarea name='description' rows='5' id='description' class='form-control '  
				           >{{ $row['description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Image" class=" control-label col-md-4 text-left"> Image </label>
									<div class="col-md-6">
									  <input  type='file' name='image' id='image' @if($row['image'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div class="col-md-3">
						
						{!! SiteHelpers::showUploadedFile($row['image'],'/uploads/polls/') !!}
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Video" class=" control-label col-md-4 text-left"> Video </label>
									<div class="col-md-6">
									  {!! Form::text('video', $row['video'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Thumbnail" class=" control-label col-md-4 text-left"> Thumbnail </label>
									<div class="col-md-6">
									  <input  type='file' name='thumbnail' id='thumbnail' @if($row['thumbnail'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div class="col-md-3">
						
						{!! SiteHelpers::showUploadedFile($row['thumbnail'],'/uploads/polls/thumb/') !!}
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  poll_type_change" >
									<label for="Poll Type" class=" control-label col-md-4 text-left"> Poll Type <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<?php $poll_type = explode(',',$row['poll_type']);
					$poll_type_opt = array( '' => '-- Please Select --' ,  'thumbnail with image' => 'Thumbnail with Image' ,  'thumbnail without image' => 'Thumbnail without Image' ,  'four column' => 'Four column' ,  'three column' => 'Three column' ,  'two  column' => 'Two  column' ,  'one  column' => 'One  column' , ); ?>
					<select name='poll_type' rows='5' required  class='select2 ' id = "poll_type" > 
						<?php 
						foreach($poll_type_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['poll_type'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
						<!-- Add dynamic options -->
						<?php if($row['pk_poll_id']):?>
						<div class="dyn_options">
							<div class="form-group">
								<label class=" control-label col-md-4 text-left"> Options </label>
							</div>
							<div class="form-group">
								<label class=" control-label col-md-4 text-left"></label>
								<div class="col-md-4">
									<a title="Add option" id="add_button" href="javascript:void(0);">Add New</a>
								</div>
							</div>
							<?php 
								$editOptions = $row['options'];
								$jsonOptions = json_decode($editOptions);
								foreach ($jsonOptions as $key) {
							?>
							<div class="form-group add_more_options">
								<label class=" control-label col-md-4 text-left"></label>
								<div class="col-md-3">
									<input type="text" required="" class="form-control" name="option[]" value="<?php echo $key->title;?>" placeholder="Title">
								</div>
								<?php if($row['poll_type'] != "thumbnail without image"){?>
								<div class="col-md-3">
									<input type="file" name="option_file[]" class ="trigger_class">
									
								{!! SiteHelpers::showUploadedFile($key->image,'/uploads/options/'.$row['pk_poll_id'].'/') !!}
								</div>
								<?php }?>
								<div class="col-md-1 text-right">
									<a href="javascript:void(0);" id="remove_buttons" title="Remove options">Remove</a>
								</div>
							</div>
							<?php }?>
						</div>
						<?php endif;?>
						<!-- Add dynamic options  -->
								  <div class="form-group  " >
									<label for="Start Date" class=" control-label col-md-4 text-left"> Start Date </label>
									<div class="col-md-6">
									  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('start_date', $row['start_date'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="End Date" class=" control-label col-md-4 text-left"> End Date </label>
									<div class="col-md-6">
									  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('end_date', $row['end_date'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Featured Poll" class=" control-label col-md-4 text-left"> Featured Poll <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='featured_poll' value ='yes' required @if($row['featured_poll'] == 'yes') checked="checked" @endif > Yes </label>
					<label class='radio radio-inline'>
					<input type='radio' name='featured_poll' value ='no' required @if($row['featured_poll'] == 'no') checked="checked" @endif > No </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  target_poll_main" >
									<label for="Target Poll" class=" control-label col-md-4 text-left"> Target Poll <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline' id = "target_poll">
					<input type='radio' name='target_poll'  value ='yes' required @if($row['target_poll'] == 'yes') checked="checked" @endif > Yes </label>
					<label class='radio radio-inline'>
					<input type='radio' name='target_poll'  value ='no' required  @if($row['target_poll'] == 'no' || empty($row['target_poll'])) checked="checked" @endif > No </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Registered Users" class=" control-label col-md-4 text-left"> Registered Users <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='registered_users' value ='yes' required @if($row['registered_users'] == 'yes') checked="checked" @endif > Yes </label>
					<label class='radio radio-inline'>
					<input type='radio' name='registered_users' value ='no' required @if($row['registered_users'] == 'no'|| empty($row['target_poll'])) checked="checked" @endif > No </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('admin/poll?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#fk_category_id").jCombo("{{ URL::to('admin/poll/comboselect?filter=category:pk_category_id:category_name:status:active') }}",
		{  selected_value : '{{ $row["fk_category_id"] }}' });
		
		$("#fk_sub_category_id").jCombo("{{ URL::to('admin/poll/comboselect?filter=sub_category:pk_sub_category_id:sub_category_name:status:active') }}",
		{  selected_value : '{{ $row["fk_sub_category_id"] }}' });
		 

		
		$('#fk_category_id').click(function(){
			var fk_category_id = $(this).val();
			var dyn_url = "comboselect?filter=sub_category:pk_sub_category_id:sub_category_name:status:active:fk_category_id:"+fk_category_id;
			$("#fk_sub_category_id").jCombo(dyn_url,
		{  selected_value : '{{ $row["fk_sub_category_id"] }}' });
			
		});	

		/*onchange poll type*/
		$('#poll_type').change(function(){
			var poll_type = $(this).val();
			if(poll_type)
			{
				$('.dyn_options').remove();
				if(poll_type == "thumbnail without image")
				{
					$('<div class = "dyn_options"><div class="form-group "><label class=" control-label col-md-4 text-left"> Options </label></div><div class="form-group"><label class=" control-label col-md-4 text-left"></label><div class="col-md-4"><a href="javascript:void(0);" id="add_button" title="Add option">Add New</a></div></div><div class="form-group add_more_options"><label class=" control-label col-md-4 text-left"></label><div class="col-md-4"><input type="text" placeholder="Title" value="" name="option[]" class="form-control" required=""></div><div class="col-md-1 text-right"><a title="Remove option" id="remove_buttons" href="javascript:void(0);">Remove</a></div></div></div></div>').insertAfter('.poll_type_change');			
				}
				else
				{
					$('<div class = "dyn_options"><div class="form-group"><label class=" control-label col-md-4 text-left"> Options </label></div><div class="form-group"><label class=" control-label col-md-4 text-left"></label><div class="col-md-4"><a href="javascript:void(0);" id="add_button" title="Add option">Add New</a></div></div><div class="form-group add_more_options"><label class=" control-label col-md-4 text-left"></label><div class="col-md-3"><input type="text" placeholder="Title" value="" name="option[]" class="form-control" required=""></div><div class="col-md-3"><input type="file" name="option_file[]"></div><div class="col-md-1 text-right"><a title="Remove options" id="remove_buttons" href="javascript:void(0);">Remove</a></div></div></div></div>').insertAfter('.poll_type_change');			
				}
				
			}
		});
		/*onchange poll type*/
		/*add option*/
		$(document).on('click', "a#add_button", function() {
			var ids = $('.add_more_option').length+1;
			var dy_ids = "add_more_option_"+ids;
			var poll_type_option = $('#poll_type').val();
			if(poll_type_option == "thumbnail without image")
			{
				$('.dyn_options').append('<div class="form-group add_more_option"> <label class=" control-label col-md-4 text-left"></label><div class="col-md-4"><input type="text" class="form-control" name="option[]" value="" placeholder="Title" required=""></div><div class="col-md-1 text-right"><a title="Remove option" id="remove_button" href="javascript:void(0);">Remove</a></div></div>');
				/*if($('.add_more_option').length)
				{

					$('<div class="form-group add_more_option"> <label class=" control-label col-md-4 text-left"></label><div class="col-md-4"><input type="text" class="form-control" name="option[]" value="" placeholder="Title"></div><div class="col-md-1 text-right"><a title="Remove option" id="remove_button" href="javascript:void(0);">Remove</a></div></div>').insertAfter('.add_more_option');
				}
				else
				{
					$('<div class="form-group add_more_option"><label class=" control-label col-md-4 text-left"></label><div class="col-md-4"><input type="text" class="form-control" name="option[]" value="" placeholder="Title"></div><div class="col-md-1 text-right"><a title="Remove option" id="remove_button" href="javascript:void(0);">Remove</a></div></div>').insertAfter('.add_more_options');
				}*/
			}
			else
			{
				$('.dyn_options').append('<div class="form-group add_more_option"><label class=" control-label col-md-4 text-left"></label><div class="col-md-3"><input type="text" class="form-control" name="option[]" value="" placeholder="Title" required=""></div><div class="col-md-3"><input type="file" name="option_file[]"></div><div class="col-md-1 text-right"><a title="Remove option" id="remove_button" href="javascript:void(0);">Remove</a></div></div>');
				/*if($('.add_more_option').length)
				{
					$('<div class="form-group add_more_option"><label class=" control-label col-md-4 text-left"></label><div class="col-md-3"><input type="text" class="form-control" name="option[]" value="" placeholder="Title"></div><div class="col-md-3"><input type="file" name="option_file[]"></div><div class="col-md-1 text-right"><a title="Remove option" id="remove_button" href="javascript:void(0);">Remove</a></div></div>').insertAfter('.add_more_option');			
				}
				else
				{
					$('<div class="form-group add_more_option"><label class=" control-label col-md-4 text-left"></label><div class="col-md-3"><input type="text" class="form-control" name="option[]" value="" placeholder="Title"></div><div class="col-md-3"><input type="file" name="option_file[]"></div><div class="col-md-1 text-right"><a title="Remove option" id="remove_button" href="javascript:void(0);">Remove</a></div></div>').insertAfter('.add_more_options');			
				}*/
			}
		});
		/*add option*/
		/*remove option*/
		$(document).on('click', "a#remove_button", function() {
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).closest(".form-group ").remove();
			// $(this).parent('div').empty();	
			return false;
		});	
		$(document).on('click', "a#remove_buttons", function() {
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			if($('.add_more_options').length)
			{
				$(this).closest(".form-group").remove();
			}
			else if(!$('.add_more_option').length)
			{
				$(this).closest(".dyn_options").remove();
			}
			else
			{
				$(this).closest(".form-group").remove();
			}
			// $(this).parent('div').empty();	
			return false;
		});	
		
		/*remove option*/

		/*target options start*/
		/*var target_gender = "<?php echo $row['target_gender']?>";
		alert(target_gender)*/
		// $('.target_poll_main').append('<div class="form-group poll_gender"><label class=" control-label col-md-4 text-left" for="Target Poll"> Gender </label><div class="col-md-6"><label id="target_poll" class="radio radio-inline"> <input type="radio" required="" value="male" name="target_gender"  class="parsley-validated" @if($row['target_gender'] == 'male') {{'checked'}}@endif > Male </label><label class="radio radio-inline"><input type="radio" required="" value="female" name="target_gender"  class="parsley-validated"  @if($row['target_gender'] == 'female') {{'checked'}}@endif> Female </label></div><div class="col-md-2"></div>');	
		/*var state 	= "<div class = ' states col-md-2'>";
		var pk_id 	= "{{$row['pk_poll_id']}}";
		var stateId = "";
		var implodeState = [];*/
		/*$.ajax({   
		        type: "POST",
		        url: "{{URL::to('admin/poll/state')}}",
		        data : {"id":pk_id},
		        success: function(data){ 
		       $.each(data, function(i) {
		       		stateId = data[i].pk_state_id;
		       		if(!pk_id)
		       		{
			       		state += "<input type = 'checkbox' name = 'state[]' value = "+data[i].pk_state_id+">"+data[i].state_name;
		       		}
		       		else
		       		{
		       			var arrayFromPHP = <?php echo json_encode($implodeState);?>;
			       		if($.inArray(stateId, arrayFromPHP) !== -1)
			       		{
			       			state += "<input type = 'checkbox' checked name = 'state[]' value = "+data[i].pk_state_id+">"+data[i].state_name;
			       		}
			       		else
			       		{
			       			state += "<input type = 'checkbox'  name = 'state[]' value = "+data[i].pk_state_id+">"+data[i].state_name;
			       		}
		       		}
		       		//alert(state)
		       		$('.target_poll_main').append(state);
		       		state = '';	
					
		       	});
		       
		       $('.states').append('</div>');
		      }
		});*/
		/*target options ends*/

		/*trigger*/

		$('.trigger_class').change(function(){

			var img_val = $(this).val();
			$('.option_hidden_files').val(img_val);
		});

	});
	</script>		 
@stop
