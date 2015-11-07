<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\t_contract,App\m_product,App\m_customer,App\m_employee;
use Redirect, Input;
class ContractsController extends Controller
{
	 public function __construct()
    {
        $this->middleware('ckp');
    }
	 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loggeduser=$loggeduser=\App::make('authenticator')->getLoggedUser();       
            if(array_key_exists('_branch',$loggeduser->permissions)){
    	    $contracts= t_contract::where('user_id',$loggeduser->id)->get();	
			}
			else {
				$contracts=t_contract::all();
			}
       
			 return view('contracts.index')->withContracts($contracts);
		 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $loggeduser=\App::make('authenticator')->getLoggedUser();
         $products=m_product::all();
		 $customers=m_customer::where('user_id',$loggeduser->id)->get();
		 $sales=m_employee::where('user_id',$loggeduser->id)->get();
         return view('contracts.create')->withProducts($products)
		                                ->withCustomers($customers)
										->withSales($sales);
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
         
        $loggeduser=\App::make('authenticator')->getLoggedUser();
		$contract = new t_contract;
		$contract->contract_id = Input::get('contract_id');
		$contract->product_id= Input::get('product_id');
		$contract->customer_id = Input::get('customer_id');
		 
		$contract->sales_id = Input::get('sales_id');
		$contract->pay_mothod = Input::get('pay_mothod');
		$contract->pay_date = Input::get('pay_date');
		$contract->pay_time = Input::get('pay_time');
		$contract->intrests_start_date = Input::get('intrests_start_date');
		$contract->deal_money = Input::get('deal_money');
		$contract->profit_byyear = Input::get('profit_byyear');
		$contract->invest_time = Input::get('invest_time');
		$contract->channel_cut = Input::get('channel_cut');
		$contract->other = Input::get('other');
		$contract->user_id = $loggeduser->id;//Auth::user()->id;
        
       
        
		if ($contract->save()) {
			return Redirect::to('contracts');
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
          $loggeduser=\App::make('authenticator')->getLoggedUser();
         $products=m_product::all();
		 $customers=m_customer::where('user_id',$loggeduser->id)->get();
		 $sales=m_employee::where('user_id',$loggeduser->id)->get();
         return view('contracts.edit')->withContract(t_contract::find($id))
		                              ->withProducts($products)
		                              ->withCustomers($customers)
									  ->withSales($sales);;
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
			'product_id' => 'required',
			'customer_id' => 'required',
			'sales_id' => 'required',
			'pay_mothod' => 'required',
			'pay_date' => 'required',
			'deal_money' => 'required',
			'profit_byyear' => 'required',
			'invest_time' => 'required',
			'channel_cut' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$contract = t_contract::find($id);
		$contract->contract_id = Input::get('contract_id');
		$contract->product_id = Input::get('product_id');
		$contract->customer_id = Input::get('customer_id');
		$contract->sales_id = Input::get('sales_id');
		$contract->pay_mothod = Input::get('pay_mothod');
		$contract->pay_date = Input::get('pay_date');
		$contract->pay_time = Input::get('pay_time');
		$contract->deal_money = Input::get('deal_money');
		$contract->intrests_start_date = Input::get('intrests_start_date');
		$contract->profit_byyear = Input::get('profit_byyear');
		$contract->invest_time = Input::get('invest_time');
		$contract->channel_cut = Input::get('channel_cut');
		$contract->other = Input::get('other');
		$contract->user_id = $loggeduser->id;//Auth::user()->id;

		if ($contract->save()) {
			return Redirect::to('contracts');
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
        $contract=t_contract::find($id);
		$contract->delete();

		return Redirect::to('contracts');
    }
}
