<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_customer;
use Redirect, Input;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		if (array_key_exists('_account',$loggeduser->permissions)){
			$customers=m_customer::all();
			 return view('customers.index')->withCustomers($customers);
		}
		else return "you not have permission";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('customers.create');
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
			'customer_name' => 'required',
			'bank_name' => 'required',
			'card_num' => 'required',
			'phone_num' => 'required',
			'personal_id' => 'required',
			'address' => 'required',
			'zip' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$customer = new m_customer;
		$customer->customer_name = Input::get('customer_name');
		$customer->bank_name = Input::get('bank_name');
		$customer->card_num = Input::get('card_num');
		$customer->phone_num = Input::get('phone_num');
		$customer->personal_id = Input::get('personal_id');
		$customer->address = Input::get('address');
		$customer->zip = Input::get('zip');
		$customer->user_id = $loggeduser->id;//Auth::user()->id;

		if ($customer->save()) {
			return Redirect::to('customers');
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
          return view('customers.edit')->withCustomer(m_customer::find($id));
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
			'customer_name' => 'required',
			'bank_name' => 'required',
			'card_num' => 'required',
			'phone_num' => 'required',
			'personal_id' => 'required',
			'address' => 'required',
			'zip' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$customer = m_customer::find($id);
		$customer->customer_name = Input::get('customer_name');
		$customer->bank_name = Input::get('bank_name');
		$customer->card_num = Input::get('card_num');
		$customer->phone_num = Input::get('phone_num');
		$customer->personal_id = Input::get('personal_id');
		$customer->address = Input::get('address');
		$customer->zip = Input::get('zip');
		$customer->user_id = $loggeduser->id;//Auth::user()->id;

		if ($customer->save()) {
			return Redirect::to('customers');
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
          $customer=m_customer::find($id);
		 $customer->delete();

		return Redirect::to('customers');
    }
}
