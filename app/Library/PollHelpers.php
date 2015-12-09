<?php

class PollHelpers 
{
	public static function all()
	{
		/*all polls*/
		$getData['polls'] 	= \DB::table('poll')->select('*')
							->first();
		/*latest records*/
		$getData['latest'] 	= \DB::table('poll')->select('*')
							->orderBy('start_date', 'desc')
							->get();
		/*closed votes*/
		$getData['closed']  = \DB::table('poll')->select('*')
								// ->select('*')
								->where('end_date', '<', new \DateTime('today'))
								->get();
		/*voted polls*/
		/*after integration of poll answers update this query*/
		$getData['voted']  	= \DB::table('poll')->select('*')
								->join('poll_answer','poll.pk_poll_id','=','poll_answer.fk_poll_id')
								->get();
		/*featured poll*/
		$getData['featured'] = \DB::table('poll')->select('*')
								->where('featured_poll','yes')
								->get();
		return $getData;
	}
	public static function category($param)
	{
		
		//category
		$getData['polls'] = \DB::table('poll')->select('*')
							->where('fk_category_id',$param)
							->first();
		/*latest records*/
		$getData['latest'] 	= \DB::table('poll')->select('*')
							->orderBy('start_date', 'desc')
							->where('fk_category_id',$param)
							->get();
		/*closed votes*/
		$getData['closed']  = \DB::table('poll')->select('*')
								->where('end_date', '<', new \DateTime('today'))
								->where('fk_category_id',$param)
								->get();
		/*voted polls*/
		/*after integration of poll answers update this query*/
		$getData['voted']  	= \DB::table('poll')->select('*')
								->join('poll_answer','poll.pk_poll_id','=','poll_answer.fk_poll_id')
								->where('poll.fk_category_id',$param)
								->get();
		/*featured poll*/
		$getData['featured'] = \DB::table('poll')->select('*')
								->where('featured_poll','yes')
								->where('fk_category_id',$param)
								->get();

		return $getData;
	}
	public static function subCategory($param)
	{
		$parLength = count($param);
		//subcategory
		$getData['polls'] = \DB::table('poll')->select('*');
							if($param[1])
							{
								$getData['polls'] = $getData['polls']->where('fk_sub_category_id',$param[1]);
							}
							/*check for sub category*/
							if($param[0])
							{
								$getData['polls'] = $getData['polls']->where('fk_category_id',$param[0]);
							}
							/*check for already voted from ansers table... present keep this*/
							/*if($parLength == 3)
							{
								$getData['polls'] = $getData['polls']->where('pk_poll_id','!=',$param[2]);
							}*/
						$getData['polls'] = $getData['polls']->first();
		//echo "<pre>";print_r($getData['polls']);die;
		/*latest records*/
		$getData['latest'] 	= \DB::table('poll')->select('*')
							->orderBy('start_date', 'desc')
							->where('fk_category_id',$param[0])
							->where('fk_sub_category_id',$param[1])
							->get();
		/*closed votes*/
		$getData['closed']  = \DB::table('poll')->select('*')
								->where('end_date', '<', new \DateTime('today'))
								->where('fk_category_id',$param[0])
								->where('fk_sub_category_id',$param[1])
								->get();
		/*voted polls*/
		/*after integration of poll answers update this query*/
		$getData['voted']  	= \DB::table('poll')->select('*')
								->join('poll_answer','poll.pk_poll_id','=','poll_answer.fk_poll_id')
								->where('poll.fk_category_id',$param[0])
								->where('poll.fk_sub_category_id',$param[1])
								->get();
		/*featured poll*/
		$getData['featured'] = \DB::table('poll')->select('*')
								->where('featured_poll','yes')
								->where('fk_category_id',$param[0])
								->where('fk_sub_category_id',$param[1])
								->get();
		return $getData;

	}
	public static function viewAll($params)
	{
		/*latest polls*/
		if($params[2] == "latest")
		{
			$getData['latest'] 	= \DB::table('poll')->select('*')
								->orderBy('start_date', 'desc');
								if($params[0])
								{
									$getData['latest']=$getData['latest']->where('fk_category_id',$params[0]);
								}
								if($params[1])
								{
									$getData['latest']=$getData['latest']->where('fk_sub_category_id',$params[1]);
								}
								$getData['latest']=$getData['latest']->get();
		}
		/*closed polls*/
		if($params[2] == "closed")
		{
			$getData['latest'] 	=\DB::table('poll')->select('*')
								->where('end_date', '<', new \DateTime('today'));
								if($params[0])
								{
									$getData['latest']=$getData['latest']->where('fk_category_id',$params[0]);
								}
								if($params[1])
								{
									$getData['latest']=$getData['latest']->where('fk_sub_category_id',$params[1]);
								}
								$getData['latest']=$getData['latest']->get();
		}
		/*voted polls based on polls*/
		return $getData;
	}
	public static  function pollSingle($params)
	{
		echo "<pre>";print_r($params);die;
	}
}

?>