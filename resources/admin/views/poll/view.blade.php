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
		<li><a href="{{ URL::to('admin/poll?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('admin/poll?return='.$return) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('admin/poll/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
	<div class="sbox-content"> 	


	
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>Category</td>
						<td>{!! SiteHelpers::gridDisplayView($row->fk_category_id,'fk_category_id','1:category:pk_category_id:category_name') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'> Sub Category</td>
						<td>{!! SiteHelpers::gridDisplayView($row->fk_sub_category_id,'fk_sub_category_id','1:sub_category:pk_sub_category_id:sub_category_name') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Title</td>
						<td>{{ $row->title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Description</td>
						<td>{{ $row->description }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Image</td>
						<td>{!! SiteHelpers::showUploadedFile($row->image,'/uploads/polls/') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Poll Type</td>
						<td>{{ $row->poll_type }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Options</td>
						<td>{{ $row->options }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Start Date</td>
						<td>{{ $row->start_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>End Date</td>
						<td>{{ $row->end_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Featured Poll</td>
						<td>{{ $row->featured_poll }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Target Poll</td>
						<td>{{ $row->target_poll }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Registered Users</td>
						<td>{{ $row->registered_users }} </td>
						
					</tr>
				
		</tbody>	
	</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop