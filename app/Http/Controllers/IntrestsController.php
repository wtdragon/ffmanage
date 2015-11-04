<?php

namespace App\Http\Controllers;
use App\t_interestdetail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect, Input;

class IntrestsController extends Controller
{
    
	  public function __construct()
    {
        $this->middleware('ckp');
    }
	 
	 
    public function index()
    {
        //   $loggeduser=\App::make('authenticator')->getLoggedUser();	
    	     
    	      	
        	$intrests=t_interestdetail::all();
			 return view('intrests.index')->withIntrests($intrests);
			  
		 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('intrests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
			'contract_id' => 'required',
			'planinterest_date' => 'required',
			'realinterest_date' => 'required',
			'interests_money' => 'required',
			'rate_bymonth' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$intrest = new t_interestdetail;
		$intrest->contract_id = Input::get('contract_id');
		$intrest->planinterest_date = Input::get('planinterest_date');
		$intrest->realinterest_date = Input::get('realinterest_date');
		$intrest->interests_money = Input::get('interests_money');
		$intrest->rate_bymonth = Input::get('rate_bymonth');
		$intrest->user_id = $loggeduser->id;//Auth::user()->id;

		if ($intrest->save()) {
			return Redirect::to('intrests');
		} else {
			return Redirect::back()->withInput()->withErrors('保存失败！');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('intrests.edit')->withInterest(t_interestdetail::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
          $this->validate($request, [
			'contract_id' => 'required',
			'planinterest_date' => 'required',
			'realinterest_date' => 'required',
			'interests_money' => 'required',
			'rate_bymonth' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$intrest = t_interestdetail::find($id);
		$intrest->contract_id = Input::get('contract_id');
		$intrest->planinterest_date = Input::get('planinterest_date');
		$intrest->realinterest_date = Input::get('realinterest_date');
		$intrest->interests_money = Input::get('interests_money');
		$intrest->rate_bymonth = Input::get('rate_bymonth');
		$intrest->user_id = $loggeduser->id;//Auth::user()->id;

		if ($intrest->save()) {
			return Redirect::to('intrests');
		} else {
			return Redirect::back()->withInput()->withErrors('保存失败！');
		}
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $intrests=t_interestdetail::find($id);
		$intrests->delete();

		return Redirect::to('intrests');
    }
}
