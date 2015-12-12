<?php namespace App\Http\admin\Controllers\frontend;

use App\Http\admin\Controllers\Controller;
use App\Models\State;
use App\Models\Endusers;
use App\Models\Contactus;
// use App\User;
use Socialize;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 

class LoginController extends Controller {

	
	// protected $layout = "admin.layouts.main";
	protected $layout = "frontend.layouts.index";
	public function __construct() {
		parent::__construct();

	} 

	public function getIndex() 
	{
		$getData = \PollHelpers::all();
		return view('frontend.home',$getData)->render(); 
	}
	/*when click on menu*/
	public function getPolls($params)
	{
		$param = \SiteHelpers::CF_decode_json($params);
		if(is_array($param))
		{
			//subcategory
			$getData = \PollHelpers::subCategory($param);
		}
		else
		{
			//category
			$getData = \PollHelpers::category($param);
		}
		return view('frontend.home',$getData)->render();
	}
	/*for next poll*/
	public function getNextpoll($params)
	{
		$param 	 	= \SiteHelpers::CF_decode_json($params);
		$getData  	= \PollHelpers::subCategory($param);
		return view('frontend.home',$getData)->render();
	}
	/*for view all*/
	public function getViewall($params)
	{
		$param 		= \SiteHelpers::CF_decode_json($params);
		$getData 	= \PollHelpers::viewAll($param);
		return view('frontend.viewall',$getData)->render();
	}
	public function getPoll($params)
	{
		$param 		= \SiteHelpers::CF_decode_json($params);
		$getData 	= \PollHelpers::pollSingle($param);
		return view('frontend.viewall',$getData)->render();
	}
	public function getRegister() {
		
		if(CNF_REGIST =='false') :    
			if(\Auth::check()):
				 return Redirect::to('admin/')->with('message',\SiteHelpers::alert('success','Youre already login'));
			else:
				 return Redirect::to('admin/user/login');
			  endif;
			  
		else :
				$data['states'] = state::where('status','=','active')->get(array('pk_state_id','state_name'));
				// echo "<pre>";
				// print_r($data['states']);
				// die;
				return view('frontend.register',$data)->render();  
		 endif ; 
           
	

	}

	public function postCreate( Request $request) {
		
		$email_id 			= $request->input('email_id');
		$row 				= endusers::where('email_id','=',$email_id)->get(array('email_id'));
		$row['email_id'] 	= array_pluck($row->toArray(),'email_id');
		
		if(!empty($row['email_id'])){
			return 'Email id already exists.';
		}

		$rules = array(
			'first_name'=>'required|alpha_num|min:2',
			'email_id'=>'required|email|unique:users',
			'password'=>'required|alpha_num|between:6,12',
			/*'password_confirmation'=>'required|alpha_num|between:6,12',
			'state'=>'required',
			'gender'=>'required'*/
			);	
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
				
		$validator = Validator::make($request->all(), $rules);

		if ($validator->passes()) {
			$code 		= rand(10000,10000000);

			$first_name 		= $request->input('first_name');
			$password 			= $request->input('password');
			$authen 			= new endusers;
			$authen->first_name = $first_name;
			$authen->email_id 	= trim($email_id);
			/*$authen->activation = $code;
			$authen->group_id = 3;*/
			$authen->password 		= \Hash::make($password);
			$authen->fk_state_id 	= 2;
			$authen->gender 		= '';
			if(CNF_ACTIVATION == 'auto') { $authen->status = 'active'; } else { $authen->status = 'inactive'; }
			$authen->save();

			\Session::put('user_id', $authen->pk_user_id);
			\Session::put('email_id', $authen->email_id);
			\Session::put('first_name', $authen->first_name);	

			/*date_default_timezone_set("Asia/Kolkata");
			$date = date('Y-m-d H:i:s');*/
			$data = array(
				'first_name'	=> 	$first_name ,
				'password'		=> 	$password ,
				'email_id'		=> 	$email_id ,
				// 'fk_state_id'	=>	$request->input('state'),
				// 'gender'		=>	$request->input('gender'),
				// 'created_at'	=>	$date,
				// 'updated_at'	=>	$date,
				'status'		=>	'inactive'
				
			);
			/*if(CNF_ACTIVATION == 'confirmation')
			{ 
			
				$to = $request->input('email');
				$subject = "[ " .CNF_APPNAME." ] REGISTRATION "; 			
				$message = view('user.emails.registration', $data);
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
					mail($to, $subject, $message, $headers);	
				
				$message = "Thanks for registering! . Please check your inbox and follow activation link";
								
			} elseif(CNF_ACTIVATION=='manual') {
				$message = "Thanks for registering! . We will validate you account before your account active";
			} else {
   			 	$message = "Thanks for registering! . Your account is active now ";         
			
			}	*/

			return 'You are registered successfully';
			// return Redirect::to('admin/user/login')->with('message',\SiteHelpers::alert('success',$message));
		} else {
			// $error = $validator->messages();
			return "Please fill the fields correctly";
			
			// return Redirect::to('register')->with('message',\SiteHelpers::alert('error','The following errors occurred')
			// )->withErrors($validator)->withInput();
		}
	}
	
	public function getActivation( Request $request  )
	{
		$num = $request->input('code');
		if($num =='')
			return Redirect::to('admin/user/login')->with('message',\SiteHelpers::alert('error','Invalid Code Activation!'));
		
		$user =  User::where('activation','=',$num)->get();
		if (count($user) >=1)
		{
			\DB::table('tb_users')->where('activation', $num )->update(array('active' => 1,'activation'=>''));
			return Redirect::to('admin/user/login')->with('message',\SiteHelpers::alert('success','Your account is active now!'));
			
		} else {
			return Redirect::to('admin/user/login')->with('message',\SiteHelpers::alert('error','Invalid Code Activation!'));
		}
		
		
	
	}

	public function getLogin() {
	
		if(\Auth::check())
		{
			return Redirect::to('admin/dashboard')->with('message',\SiteHelpers::alert('success','Youre already login'));

		} else {
			$this->data['socialize'] =  config('services');
			return view('frontend.login',$this->data);
			
		}	
	}

	public function postSignin( Request $request) {
		// print_r(Input::all());die;
		$rules = array(
			'email_id'=>'required|email',
			'password'=>'required',
		);		
		if(CNF_RECAPTCHA =='true') $rules['captcha'] = 'required|captcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {	
			$remember = (!is_null($request->get('remember')) ? 'true' : 'false' );
			// var_dump($this->auth->attempt(array('email'=>$request->input('email_id'), 'password'=> $request->input('password'))));die;
			$email_id 	= $request->input('email_id');
			$password 	= $request->input('password');
			
			$row 				= endusers::where('email_id','=',$email_id)->get(array('pk_user_id','first_name','email_id','password','status'));
			$row['email_id'] 	= array_pluck($row->toArray(),'email_id');
			$row['password'] 	= array_pluck($row->toArray(),'password');
			
			if (!empty($row['email_id']) && !empty($row['password']) && \Hash::check($password,$row['password'][0])) {
				
					$row['status'] 		= array_pluck($row->toArray(),'status');

					if($row['status'][0] =='inactive')
					{
						// inactive 
						// \Auth::logout();
						return 'Your Account is not active';	
					} /*else if($row->active=='2')
					{
						// BLocked users
						\Auth::logout();
						return Redirect::to('/login')->with('message', \SiteHelpers::alert('error','Your Account is BLocked'));
					}*/ else {
						$row['pk_user_id'] 	= array_pluck($row->toArray(),'pk_user_id');
						$row['first_name'] 	= array_pluck($row->toArray(),'first_name');

						// \DB::table('users')->where('id', '=',$row->id )->update(array('last_login' => date("Y-m-d H:i:s")));
						\Session::put('user_id', $row['pk_user_id'][0]);
						// \Session::put('gid', $row->group_id);
						\Session::put('email_id', $row['email_id'][0]);
						// \Session::put('ll', $row->last_login);
						\Session::put('first_name', $row['first_name'][0]);	
						
						if($request->input('remember')){
							$year = time() + 31536000;
							setcookie('remember_me', $email_id, $year);
						}
						/*if(!is_null($request->input('language')))
						{
							\Session::put('lang', $request->input('language'));	
						} else {
							\Session::put('lang', 'en');	
						}  */

							if(CNF_FRONT =='false') :
							return Redirect::to('/login');						
						else :
							// return Redirect::to('/login')
							// 		->with('message', \SiteHelpers::alert('success','Logged in successfully'));
									return 'Logged in successfully';
						endif;							
											
					}			
				
			} else {
				// return \Response::json(['data' => array('message' => 'thanks for registering!')]);
				// return json_encode($result);
				return "Your username or password combination was incorrect";
				/*return Redirect::to('/login')
					->with('message', \SiteHelpers::alert('error','Your username/password combination was incorrect'))
					->withInput();*/
			}
		} else {
		
				return Redirect::to('/login')
					->with('message', \SiteHelpers::alert('error','The following  errors occurred'))
					->withErrors($validator)->withInput();
		}	
	}

	public function getProfile() {
		
		if(!\Auth::check()) return redirect('user/login');
		
		
		$info =	User::find(\Auth::user()->id);
		$this->data = array(
			'pageTitle'	=> 'My Profile',
			'pageNote'	=> 'View Detail My Info',
			'info'		=> $info,
		);
		return view('admin.user.profile',$this->data);
	}
	
	public function postSaveprofile( Request $request)
	{
		if(!\Auth::check()) return Redirect::to('admin/user/login');
		$rules = array(
			'first_name'=>'required|alpha_num|min:2',
			'last_name'=>'required|alpha_num|min:2',
			);	
			
		if($request->input('email') != \Session::get('eid'))
		{
			$rules['email'] = 'required|email|unique:tb_users';
		}	
				
		$validator = Validator::make($request->all(), $rules);

		if ($validator->passes()) {
			
			
			if(!is_null(Input::file('avatar')))
			{
				$file = $request->file('avatar'); 
				$destinationPath = './uploads/users/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				 $newfilename = \Session::get('uid').'.'.$extension;
				$uploadSuccess = $request->file('avatar')->move($destinationPath, $newfilename);				 
				if( $uploadSuccess ) {
				    $data['avatar'] = $newfilename; 
				} 
				
			}		
			
			$user = User::find(\Session::get('uid'));
			$user->first_name 	= $request->input('first_name');
			$user->last_name 	= $request->input('last_name');
			$user->email 		= $request->input('email');
			if(isset( $data['avatar']))  $user->avatar  = $newfilename; 			
			$user->save();

			return Redirect::to('admin/user/profile')->with('messagetext','Profile has been saved!')->with('msgstatus','success');
		} else {
			return Redirect::to('admin/user/profile')->with('messagetext','The following errors occurred')->with('msgstatus','error')
			->withErrors($validator)->withInput();
		}	
	
	}
	
	public function postSavepassword( Request $request)
	{
		$rules = array(
			'password'=>'required|alpha_num|between:6,12',
			'password_confirmation'=>'required|alpha_num|between:6,12'
			);		
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$user = User::find(\Session::get('uid'));
			$user->password = \Hash::make($request->input('password'));
			$user->save();

			return Redirect::to('admin/user/profile')->with('message', \SiteHelpers::alert('success','Password has been saved!'));
		} else {
			return Redirect::to('admin/user/profile')->with('message', \SiteHelpers::alert('error','The following errors occurred')
			)->withErrors($validator)->withInput();
		}	
	
	}	
	
	public function getReminder()
	{
	
		return view('admin.user.remind');
	}	

	public function postRequest( Request $request)
	{

		$rules = array(
			'credit_email'=>'required|email'
		);	
		
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {	
	
			$user =  endusers::where('email_id','=',$request->input('credit_email'));
			
			if($user->count() >=1)
			{
				$user = $user->get();
				$user = $user[0];
				$data = array('token'=>$request->input('_token'));	
				$to = $request->input('credit_email');
				$subject = "[ " .CNF_APPNAME." ] REQUEST PASSWORD RESET "; 			
				$message = view('user.emails.auth.reminder', $data);
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
					mail($to, $subject, $message, $headers);				
			
				
				/*$affectedRows = endusers::where('email_id', '=',$user->email_id)
								->update(array('reminder' => $request->input('_token')));*/
								
				return Redirect::to('/login')->with('message', \SiteHelpers::alert('success','Please check your email'));	
				
			} else {
				return Redirect::to('/login')->with('message', \SiteHelpers::alert('error','Cant find email address'));
			}

		}  else {
			return Redirect::to('/login')->with('message', \SiteHelpers::alert('error','The following errors occurred')
			)->withErrors($validator)->withInput();
		}	 
	}	
	
	public function getReset( $token = '')
	{
		if(\Auth::check()) return Redirect::to('admin/dashboard');

		$user = User::where('reminder','=',$token);
		if($user->count() >=1)
		{
			$data = array('verCode'=>$token);
			return view('admin.user.remind',$data);	
		} else {
			return Redirect::to('admin/user/login')->with('message', \SiteHelpers::alert('error','Cant find your reset code'));
		}
		
	}	
	
	public function postDoreset( Request $request , $token = '')
	{
		$rules = array(
			'password'=>'required|alpha_num|between:6,12|confirmed',
			'password_confirmation'=>'required|alpha_num|between:6,12'
			);		
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			
			$user =  User::where('reminder','=',$token);
			if($user->count() >=1)
			{
				$data = $user->get();
				$user = User::find($data[0]->id);
				$user->reminder = '';
				$user->password = \Hash::make($request->input('password'));
				$user->save();			
			}

			return Redirect::to('admin/user/login')->with('message',\SiteHelpers::alert('success','Password has been saved!'));
		} else {
			return Redirect::to('admin/user/reset/'.$token)->with('message', \SiteHelpers::alert('error','The following errors occurred')
			)->withErrors($validator)->withInput();
		}	
	
	}	

	public function getLogout() {
		\Auth::logout();
		\Session::flush();
		return Redirect::to('admin/user/login')->with('message', \SiteHelpers::alert('info','Your are now logged out!'));
	}

	function getSocialize( $social )
	{
		return Socialize::with($social)->redirect();
	}

	function getAutosocial( $social )
	{
		$user = Socialize::with($social)->user();
		$user =  User::where('email',$user->email)->first();
		return self::autoSignin($user);		
	}


	function autoSignin($user)
	{

		if(is_null($user)){
		  return Redirect::to('admin/user/login')
				->with('message', \SiteHelpers::alert('error','You have not registered yet '))
				->withInput();
		} else{

		    Auth::login($user);
			if(Auth::check())
			{
				$row = User::find(\Auth::user()->id); 

				if($row->active =='0')
				{
					// inactive 
					Auth::logout();
					return Redirect::to('admin/user/login')->with('message', \SiteHelpers::alert('error','Your Account is not active'));

				} else if($row->active=='2')
				{
					// BLocked users
					Auth::logout();
					return Redirect::to('admin/user/login')->with('message', \SiteHelpers::alert('error','Your Account is BLocked'));
				} else {
					Session::put('uid', $row->id);
					Session::put('gid', $row->group_id);
					Session::put('eid', $row->group_email);
					Session::put('fid', $row->first_name.' '. $row->last_name);	
					if(CNF_FRONT =='false') :
						return Redirect::to('admin/dashboard');						
					else :
						return Redirect::to('admin');
					endif;					
					
										
				}
				
				
			}
		}

	}
	
	public function getContact(){
		return view('frontend.contact')->render();
	}

	public function postContact(Request $request){
		$rules = array(
			'name'=>'required|min:2',
			'email_id'=>'required|email',
			'message'=>'required|min:5'
			);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$contact 			= new contactus;
			$contact->name 		= $request->input('name');
			$contact->email_id 	= $request->input('email_id');
			$contact->message 	= $request->input('message');
			$contact->save();
			return Redirect::to('/contact')
									->with('message', \SiteHelpers::alert('success','Thank you for contacting us'));
		}
		else{
			return Redirect::to('/contact')->with('message',\SiteHelpers::alert('error','The following errors occurred')
			)->withErrors($validator)->withInput();
		}
	}

	public function getPrivacy(){
		return view('frontend.privacy')->render();
	}

	public function getAbout(){
		return view('frontend.aboutus')->render();
	}

	public function getAdvertise(){
		return view('frontend.advertise-with-us')->render();
	}

}