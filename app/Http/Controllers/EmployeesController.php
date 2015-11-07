<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_employee;
use Redirect, Input;
class EmployeesController extends Controller
{    public function __construct()
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
         	$employees=m_employee::all();
			 return view('employees.index')->withEmployees($employees);
		 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          return view('employees.create');
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
			'employee_name' => 'required',
			'gender' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$employee = new m_employee;
		$employee->employee_name = Input::get('employee_name');
		$employee->gender = Input::get('gender');
		$employee->user_id = $loggeduser->id;//Auth::user()->id;

		if ($employee->save()) {
			return Redirect::to('employees');
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
         return view('employees.edit')->withEmployee(m_employee::find($id));
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
			'employee_name' => 'required',
			'gender' => 'required',
			'position_id' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$contract = m_employee::find($id);
		$contract->employee_name = Input::get('employee_name');
		$contract->gender = Input::get('gender');
		$contract->position_id = Input::get('position_id');
		$contract->user_id = $loggeduser->id;//Auth::user()->id;

		if ($contract->save()) {
			return Redirect::to('employees');
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
          $employee=m_employee::find($id);
		$employee->delete();

		return Redirect::to('employees');
    }
}
