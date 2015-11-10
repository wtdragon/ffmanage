<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_position,App\m_employee,App\UserGroup;
use Redirect, Input;
class PositionsController extends Controller
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
    	    $positions=m_position::where('user_id',$loggeduser->id)->orWhere('leader_id','=',0)->paginate(10);	
			}
			else {
				$positions=m_position::paginate(10);
			}
          	 
			 return view('positions.index')->withPositions($positions);
		 
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
        $sales=m_employee::where('user_id',$loggeduser->id)->get();
        $leaders=m_position::where('user_id',$loggeduser->id)->orWhere('leader_id','=',0)->get();
        return view('positions.create')->withLeaders($leaders)
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
           $this->validate($request, [
			'position_name' => 'required',
			'department_name' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
			'employee_id' => 'required',
			'leader_id' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$position = new m_position;
		 $usergroup=UserGroup::where('user_id',$loggeduser->id)->first();
         $position->branch_name=$usergroup->group->name;
		$position->position_name = Input::get('position_name');
		$position->department_name = Input::get('department_name');
		$position->start_date = Input::get('start_date');
		$position->end_date = Input::get('end_date');
		$position->employee_id = Input::get('employee_id');
		$position->leader_id = Input::get('leader_id');
		$demons = m_position::where('employee_id', '=', $position->leader_id)->first();
		
		$position->depth =$demons->getLevel()+1;
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
        $loggeduser=\App::make('authenticator')->getLoggedUser();
        $sales=m_employee::where('user_id',$loggeduser->id)->get();
        $leaders=m_position::where('user_id',$loggeduser->id)->orWhere('leader_id','=',0)->get();
         return view('positions.edit')->withPosition(m_position::find($id))->withLeaders($leaders)
									  ->withSales($sales);
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
			'department_name' => 'required',
				'start_date' => 'required',
			'end_date' => 'required',
			'employee_id' => 'required',
			'leader_id' => 'required',
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		 $position =m_position::find($id);
		 $usergroup=UserGroup::where('user_id',$loggeduser->id)->first();
         $position->branch_name=$usergroup->group->name;
			$position->position_name = Input::get('position_name');
		$position->department_name = Input::get('department_name');
		$position->start_date = Input::get('start_date');
		$position->end_date = Input::get('end_date');
		$position->employee_id = Input::get('employee_id');
		$position->leader_id = Input::get('leader_id');
		$demons = m_position::where('employee_id', '=', $position->leader_id)->first();
		
		$position->depth =$demons->getLevel()+1;
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
