<?php

namespace App\Http\Controllers;
use App\t_interestdetail,App\t_contract;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect, Input;

class IntrestsController extends Controller
{
    
	  public function __construct()
    {
        $middle=$this->middleware('ckp');
	 
    }
	 
	 
    public function index()
    {
    	    $loggeduser=$loggeduser=\App::make('authenticator')->getLoggedUser();       
            if(array_key_exists('_branch',$loggeduser->permissions)){
    	    $contracts= t_interestdetail::where('user_id',$loggeduser->id)->paginate(10);	
			}
			else {
				$contracts=t_interestdetail::all()->paginate(10);
			}
			 
			return view('intrests.index')->withIntrests($contracts);
			  
		 
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
			'realinterest_date' => 'required',
			
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$intrest = t_interestdetail::find($id);
		$intrest->realinterest_date = Input::get('realinterest_date');
		
		$intrest->have_intrests = Input::get('have_intrests');
		if($intrest->have_intrests==1)
		{
		
        $intbefore = t_interestdetail::where('id','=', $id-1)->where('contract_id',$intrest->contract_id)->first();
		if($intbefore)
		{
		 if($intbefore->have_intrests==0)
			{
				return Redirect::back()->withInput()->withErrors('有未结息数据，请先结息后再对本期进行操作！');
			}
			else
			{
			$intrest->realinterest_date = Input::get('realinterest_date');
            $intrest->other =  Input::get('other');
			$intrest->bonused_time = $intrest->bonused_time+1;
            $intrest->rest_time = $intrest->total_time-$intrest->bonused_time;
           $intrest->save();
				$intafters = t_interestdetail::where('id','>',$id)->where('contract_id',$intrest->contract_id)->get();
				foreach($intafters as $intafter)
				{
					$intafter->bonused_time = $intafter->bonused_time+1;
                    $intafter->rest_time = $intafter->total_time-$intafter->bonused_time;
                    $intrest = t_interestdetail::find($intafter->id);
					$intrest->bonused_time=$intafter->bonused_time;
					$intrest->rest_time = $intafter->rest_time;
		            $intrest->save();
				}
		
		}
		}
		else {
			$intrest->realinterest_date = Input::get('realinterest_date');
            $intrest->other =  Input::get('other');
			$intrest->bonused_time = $intrest->bonused_time+1;
            $intrest->rest_time = $intrest->total_time-$intrest->bonused_time;
            $intrest->save();       
			$intafters = t_interestdetail::where('id','>',$id)->where('contract_id',$intrest->contract_id)->get();
				foreach($intafters as $intafter)
				{
					$intafter->bonused_time = $intafter->bonused_time+1;
                    $intafter->rest_time = $intafter->total_time-$intafter->bonused_time;
                    $intrest = t_interestdetail::find($intafter->id);
					$intrest->bonused_time=$intafter->bonused_time;
					$intrest->rest_time = $intafter->rest_time;
		            $intrest->save();
				}
		}
		}
else{
	 $intrest->realinterest_date = Input::get('realinterest_date');
     $intrest->other =  Input::get('other');
	 
}
		 
		

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
