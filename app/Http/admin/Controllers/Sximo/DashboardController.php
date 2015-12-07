<?php namespace App\Http\admin\Controllers\sximo;

use App\Http\admin\Controllers\controller;
use App\Groups;
use Illuminate\Http\Request;
use Validator, Input, Redirect; 



class DashboardController extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function getIndex( Request $request )
	{

		return view('admin.dashboard.index');
	}	


}