<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Illuminate\Contracts\Routing\ResponseFactory;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_product,App\t_contract,App\m_customer,App\m_employee,App\t_interestdetail,App\m_position;

use Redirect, Input;
class ReportsController extends Controller
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
          	$products=m_product::all();
			$contracts=t_contract::all();
			 return view('reports.index')->withProducts($products)
			                             ->withContracts($contracts);;
		 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
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
          	'product_id' => 'required',
			'product_name' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
			
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$product = new m_product;
		$product->product_id = Input::get('product_id');
		$product->product_name = Input::get('product_name');
		$product->start_date = Input::get('start_date');
		$product->end_date = Input::get('end_date');
		$product->user_id = $loggeduser->id;//Auth::user()->id;

		if ($product->save()) {
			return Redirect::to('products');
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
        return view('products.edit')->withProduct(m_product::find($id));
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
           'product_id' => 'required',
			'product_name' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
			
		]);
         $loggeduser=\App::make('authenticator')->getLoggedUser();
		$product =m_product::find($id);
		$product->product_id = Input::get('product_id');
		$product->product_name = Input::get('product_name');
		$product->start_date = Input::get('start_date');
		$product->end_date = Input::get('end_date');
		$product->user_id = $loggeduser->id;//Auth::user()->id;

		if ($product->save()) {
			return Redirect::to('products');
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
         $product=m_product::find($id);
		$product->delete();

		return Redirect::to('products');
    }
	 /**
     * post product infro and the begin time
	 * end time
     * return the reports for products
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function prodreports()
    {
        //
        $productname = Input::get('productname');
		$begintime = Input::get('begintime');
		$endtime = Input::get('endtime');
       $product=m_product::where('product_name',$productname)->first();
	    
	   $contracts=t_contract::where('product_id',$product->product_id)->get();
	   $filename=$product->product_id+time();
	   \Excel::create($filename, function($excel) use ($productname, $contracts) {
          
         $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
         
        $sheet->loadView('pdreport') 
                            ->withProductname($productname)
	                        ->withContracts($contracts);

    });

       })->download('xls');
       return \View::make('reports.products')->withProductname($productname)
	                                         ->withContracts($contracts)
											 ->withFilename($filename);
    }
	 /**
     * post contracts infro and the begin time
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function contractreports()
    {
        //
       $contractid = Input::get('contractid');
	   $begintime = Input::get('begintime');
	   $endtime = Input::get('endtime');
         
	   $contract=t_contract::where('contract_id',$contractid)->first();
	   $product=m_product::where('product_id',$contract->product_id)->first();
	   
	   $sale=m_employee::find($contract->sales_id);
	   $position=m_position::where('employee_id',$sale->id)->first();
	   $parents = $position->ancestors()->get();  
       return \View::make('reports.contracts')->withProduct($product)
	                                         ->withParents($parents)
											  ->withPosition($position)
	                                         ->withContract($contract);
 

    }
	
	
	/**
     * post contracts infro and the begin time
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function anydata()
    {
        //
        $contractid= Input::get('contract_id');
        $contract=t_contract::where('contract_id',$contractid)->first();
		$product=m_product::where('id',$contract->product_id)->first();
		$sale=m_employee::find($contract->sales_id);
        $position=m_position::where('employee_id',$sale->id)->first();
       $parentcount = Input::get('parent_count');
	   $employeecut=  Input::get('employee_cut');
	   $parentname1=Input::get('parent_username1');
	   $parentname2=Input::get('parent_username2');
	   $parentname3=Input::get('parent_username3');
	   $parentname4=Input::get('parent_username4');
	   $parencut1=Input::get('parent_cut_val1');
	   $parent1_money=$parencut1/100*$contract->deal_money*10000;
	   $parencut2=Input::get('parent_cut_val2');
	   $parent2_money=$parencut2/100*$contract->deal_money*10000;
	   $parencut3=Input::get('parent_cut_val3');
	   $parent3_money=$parencut3/100*$contract->deal_money*10000;
	   $parencut4=Input::get('parent_cut_val4'); 
	   $parent4_money=$parencut4/100*$contract->deal_money*10000;
	   $parentcontents=array($parentname1=>$parent1_money,$parentname2=>$parent2_money,$parentname3=>$parent3_money,$parentname4=>$parent4_money);
       
	   $comcut = Input::get('compnay_cut');
	   $contract->comcut=$comcut/100*$contract->deal_money*10000;
	   $totalcut= $contract->channel_cut;
	   $calcut=$employeecut+$parencut1+$parencut2+$parencut3+$parencut4+$comcut;
	   if($totalcut!=$calcut)
	   {
	   	return Redirect::back()->withInput()->withErrors('需要更改各级别分账比例！');
	   }
	   else{
	   	
	    $filename=$contractid.date("Y-m-d");
	    \Excel::create($filename, function($excel) use ($product, $parentcontents,$position,$contract) {
          
         $excel->sheet('New sheet', function($sheet)  use ($product, $parentcontents,$position,$contract) {
         
        $sheet->loadView('contract') 
                            ->withProduct($product)
	                                         ->withParentcontents($parentcontents)
											  ->withPosition($position)
	                                         ->withContract($contract);

    });

       })->download('xls');
	     
	   }
	   $endtime = Input::get('endtime');
         
	   $contract=t_contract::where('contract_id',$contractid)->first();
	   $product=m_product::where('product_id',$contract->product_id)->first();
	   
	   $sale=m_employee::find($contract->sales_id);
	   $position=m_position::where('employee_id',$sale->id)->first();
	   $parents = $position->ancestors()->get();  
       return \View::make('reports.contracts')->withProduct($product)
	                                         ->withParents($parents)
											  ->withPosition($position)
	                                         ->withContract($contract);
 

    }
	
	 /**
     * post contracts infro and the begin time
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dowload($filename)
    {
        //
        $file= app_path() . "/storage/exports/" . $filename . ".xls";
		var_dump($file);
 
		 return $this->response->download($file);

    }
}
