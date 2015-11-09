<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\t_contract,App\m_product,App\m_customer,App\m_employee,App\t_interestdetail;
use yajra\Datatables\Datatables;
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

 public function anyData()
    {
    	    header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
		header('Access-Control-Allow-Origin: *');
		       
    	   
          
 return Datatables::of($contracts)
            ->addColumn('edit', function($contract) {
                return '<a href='.$contract->id.'/edit class="btn btn-default">编辑</a>';
            })
->addColumn('delete', function($contract) {
                $modal =
                    '<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                        '.Form::open(array("route" => array("contracts.destroy", $contract->id), "method" => "delete")).'
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
                                        <h4 class="modal-title">取消删除</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>确认删除此条数据吗？</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消删除</button>
                                        <button type="submit" class="btn btn-danger" name="cancelDR">确认删除</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        '.Form::close().'
                    </div><!-- /.modal -->';

                return Form::button('<span class="glyphicon glyphicon-trash"></span> 取消', array('name'=>'cancelDR', 'class' => 'btn btn-danger btn-block', 'type' => 'button',  'data-toggle' => 'modal', 'data-target' => '#confirmDelete')).$modal;
            })
            ->removeColumn('id')
            ->make(true);
		  
		 
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
		if($contract->pay_mothod=="pos" && strtotime($contract->pay_time) >= strtotime('12:00') )
		{    
			$contract->intrests_start_date = date("Y-m-d H:i:s",strtotime("+31days",strtotime($contract->pay_date)));
		     
			
		}
		else
		{
		$contract->intrests_start_date = date("Y-m-d H:i:s",strtotime("+30days",strtotime($contract->pay_date)));
		 
		}
		$contract->deal_money = Input::get('deal_money');
		
		$contract->profit_byyear = Input::get('profit_byyear');
		$contract->profit_bymonth= $contract->profit_byyear/12;
		
		$contract->intrests_money_bymonth=$contract->deal_money*10000*$contract->profit_bymonth/100;
		
	    $contract->invest_time = Input::get('invest_time');
		$contract->channel_cut = Input::get('channel_cut');
		$contract->other = Input::get('other');
		$contract->user_id = $loggeduser->id;//Auth::user()->id;
        
       
        for($i=1;$i <=$contract->invest_time;$i++) {
  if($i!=$contract->invest_time)
    {   
$intrest = new t_interestdetail;
$intrest->contract_id = $contract->contract_id;
$intrest->product_id = $contract->product_id;
$intrest->customer_id = $contract->customer_id;

$days=($i-1)*30;
$intrest->planinterest_date = date("Y-m-d H:i:s",strtotime("+" . $days . "days",strtotime($contract->intrests_start_date)));

$intrest->realinterest_date  = date("Y-m-d H:i:s",strtotime("+" . $days . "days",strtotime($contract->intrests_start_date)));
$intrest->principal_money = 0;
$intrest->bonused_time = 0;
$intrest->rest_time =  $contract->invest_time;
$intrest->total_time = $contract->invest_time;

$intrest->profit_byyear = $contract->profit_byyear;

$intrest->interests_money = floor($contract->deal_money*10000*($contract->profit_bymonth/100));
 
$intrest->user_id = $loggeduser->id;//Auth::user()->id;
				
	$intrest->save();			
      }
 else 
      {
				$intrest = new t_interestdetail;
$intrest->contract_id = $contract->contract_id;
$intrest->customer_id = $contract->customer_id;

$intrest->product_id = $contract->product_id;
$days=($i-1)*30;
$intrest->planinterest_date = date("Y-m-d H:i:s",strtotime("+" . $days . "days",strtotime($contract->intrests_start_date)));

$intrest->realinterest_date  = date("Y-m-d H:i:s",strtotime("+" . $days . "days",strtotime($contract->intrests_start_date)));
$intrest->principal_money = $contract->deal_money;
$intrest->bonused_time = 0;
$intrest->rest_time =  $contract->invest_time;
$intrest->total_time = $contract->invest_time;
$intrest->profit_byyear = $contract->profit_byyear;

$lm=floor($contract->deal_money*10000*($contract->profit_bymonth/100))*($contract->invest_time-1);
$intrest->interests_money = $contract->deal_money*10000*($contract->profit_bymonth/100)*$contract->invest_time - $lm;
 
$intrest->user_id = $loggeduser->id;//Auth::user()->id;
				
	$intrest->save();
	 }
}
        
        
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
		if($contract->pay_mothod=="pos" && strtotime($contract->pay_time) >= strtotime('12:00') )
		{    
			$contract->intrests_start_date = date("Y-m-d H:i:s",strtotime("+31days",strtotime($contract->pay_date)));
		     
			
		}
		else{
		$contract->intrests_start_date = date("Y-m-d H:i:s",strtotime("+30days",strtotime($contract->pay_date)));
		 
		}
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
