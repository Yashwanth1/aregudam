<?php namespace App\Http\admin\Controllers;

use App\Http\admin\Controllers\controller;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class PollController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'poll';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Poll();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'poll',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('admin/dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'pk_poll_id'); 
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');

		
		$page = $request->input('page', 1);
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null($request->input('rows')) ? filter_var($request->input('rows'),FILTER_VALIDATE_INT) : static::$per_page ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );		
		
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = new Paginator($results['rows'], $results['total'], $params['limit']);	
		$pagination->setPath('poll');
		
		$this->data['rowData']		= $results['rows'];
		// Build Pagination 
		$this->data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$this->data['pager'] 		= $this->injectPaginate();	
		// Row grid Number 
		$this->data['i']			= ($page * $params['limit'])- $params['limit']; 
		// Grid Configuration 
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['colspan'] 		= \SiteHelpers::viewColSpan($this->info['config']['grid']);		
		// Group users permission
		$this->data['access']		= $this->access;
		// Detail from master if any
		
		// Master detail link if any 
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array()); 
		// Render into template
		return view('admin.poll.index',$this->data);
	}	



	function getUpdate(Request $request, $id = null)
	{
	
		if($id =='')
		{
			if($this->access['is_add'] ==0 )
			return Redirect::to('admin/dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}	
		
		if($id !='')
		{
			if($this->access['is_edit'] ==0 )
			return Redirect::to('admin/dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}				
				
		$row = $this->model->find($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('poll'); 
		}

		
		$this->data['id'] = $id;
		return view('admin.poll.form',$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('admin/dashboard')
				->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');
					
		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('poll'); 
		}
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		return view('admin.poll.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data 			= $this->validatePost('tb_poll');
			$pollOptions 	= Input::get('option');
			/*poll option start*/
				// echo "<pre>"; print_r($_FILES['option_file']);die;

			$arr2 = array();
			// $data['image'] 	= ""
			if($data['poll_type'] != "thumbnail without image")
			{
				/*poll with images*/
				$pollImages = $_FILES['option_file']['name'];
				$dbImages = array();

				//for edit form
				if($data['pk_poll_id'])
				{
					$getOptions 	= \DB::table('poll')->select('options')->where('pk_poll_id',$data['pk_poll_id'])->first();
					$jsonData 		= json_decode($getOptions->options);
					foreach ($jsonData as $key) {
						if(isset($key->image))
						{
							$dbImages[] 	= $key->image;
						}
					}
				}
				// echo "<pre>";print_r($dbImages);die;
				for($i=0;$i<count($pollOptions);$i++)
				{
					$j = $i+1;
					$arr1['title'] = $pollOptions[$i];
					if(empty($pollImages[$i]) && array_key_exists($i,$dbImages))
					{
						$arr1['image'] = $dbImages[$i];
					}
					else
					{
						$arr1['image'] = $pollImages[$i];
					}
					/*save the uploaded file*/
					$baseUrl 		= public_path();
					$target = $baseUrl."/uploads/options/";
					// pri t_r($target);die;
					if (!file_exists($target)) {
    							mkdir($target, 0777, true);
					}
					$target1	= $target.$pollImages[$i];
					move_uploaded_file( $_FILES['option_file']['tmp_name'][$i], $target1);

					/*if both empty then dont insert*/
					if(!empty($arr1['image']) || !empty($arr1['title']))
					{
						// echo "string";
						$arr2['option'.$j] = $arr1;
					}
				}
				$data['options'] = json_encode($arr2);	
			}
			else
			{
				/*remaining all*/
				
				for($i=0;$i<count($pollOptions);$i++)
				{
					$j = $i+1;
					$arr1['title'] = $pollOptions[$i];
					if(!empty($arr1['title']))
					{
						$arr2['option'.$j] = $arr1;
					}
				}
				$data['options'] = json_encode($arr2);
			}
			/*poll option ends*/
			if($data['target_poll'] == "yes")
			{
				$data['target_gender']	= \Input::get('target_gender');
				if(\Input::get('state'))
				{
					$data['target_state']	= implode(",", \Input::get('state'));
				}
			}
			// print_r($data);die;
			$id = $this->model->insertRow($data , $request->input('pk_poll_id'));
			
			if(!is_null($request->input('apply')))
			{
				$return = 'poll/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'poll?return='.self::returnUrl();
			}

			// Insert logs into database
			if($request->input('pk_poll_id') =='')
			{
				\SiteHelpers::auditTrail( $request , 'New Data with ID '.$id.' Has been Inserted !');
			} else {
				\SiteHelpers::auditTrail($request ,'Data with ID '.$id.' Has been Updated !');
			}

			return Redirect::to("admin/".$return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			
		} else {

			return Redirect::to('admin/poll/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}	
	
	}	

	public function postDelete( Request $request)
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('admin/dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		// delete multipe rows 
		if(count($request->input('id')) >=1)
		{
			$this->model->destroy($request->input('id'));
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('id'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('admin/poll')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('admin/poll')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}
	public function postState()
	{
		$id = \Input::get('id');
		$states = 	\DB::table('states')->select('pk_state_id','state_name')->where('status','active')->get();
		return $states;
		/*foreach ($states as $stateData) {
			$state[] 		= $stateData['state_name'];
			$stateId[]	 	= $stateData['pk_state_id'];
		}
		$data['state_name'] = 
		//echo "<pre>";
		print_r($data);*/
	}			


}