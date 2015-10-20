<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_position;
use Redirect, Input;
class PositionsController extends Controller
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
			$positions=m_position::all();
			 return view('positions.index')->withPositions($positions);
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
        return view('positions.create');
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
			'position_name' => 'required',
			'department_id' => 'required',
			'department_name' => 'required',
				'start_date' => 'required',
			'end_date' => 'required',
			'employee_id' => 'required',
			'leader_id' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$position = new m_position;
		$position->position_name = Input::get('position_name');
		$position->department_id = Input::get('department_id');
		$position->department_name = Input::get('department_name');
		$position->start_date = Input::get('start_date');
		$position->end_date = Input::get('end_date');
		$position->employee_id = Input::get('employee_id');
		$position->leader_id = Input::get('leader_id');
		$position->depth =Input::get('depth');
		$position->user_id = $loggeduser->id;//Auth::user()->id;

		if ($position->save()) {
			return Redirect::to('positions');
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
         return view('positions.edit')->withPosition(m_position::find($id));
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
			'position_name' => 'required',
			'department_id' => 'required',
			'department_name' => 'required',
				'start_date' => 'required',
			'end_date' => 'required',
			'employee_id' => 'required',
			'leader_id' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$position = m_position::find($id);
		$position->position_name = Input::get('position_name');
		$position->department_id = Input::get('department_id');
		$position->department_name = Input::get('department_name');
		$position->start_date = Input::get('start_date');
		$position->end_date = Input::get('end_date');
		$position->employee_id = Input::get('employee_id');
		$position->leader_id = Input::get('leader_id');
		$position->user_id = $loggeduser->id;//Auth::user()->id;

		if ($position->save()) {
			return Redirect::to('positions');
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
         $employee=m_position::find($id);
		$employee->delete();

		return Redirect::to('positions');
    }
}