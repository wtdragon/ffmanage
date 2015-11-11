<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Illuminate\Contracts\Routing\ResponseFactory;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_product,App\t_contract,App\m_customer,App\m_employee,App\t_interestdetail,App\m_position;
use Carbon\Carbon;
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
            $loggeduser=$loggeduser=\App::make('authenticator')->getLoggedUser();       
            if(array_key_exists('_branch',$loggeduser->permissions)){
    	    $contracts= t_contract::where('user_id',$loggeduser->id)->get();
            $products=m_product::where('user_id',$loggeduser->id)->get();	
			}
			else {
			$products=m_product::all();
			$contracts=t_contract::all();
			}
            
          	
			 return view('reports.index')->withProducts($products)
			                             ->withContracts($contracts);;
		 
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
	   $timerange = Input::get('timerange');
	   $product=m_product::where('product_name',$productname)->first();
	  
	   if($timerange==1)
	   { 	 
        $lastWeek = Carbon::now()->subWeek();
	    $nowdate = Carbon::now();    
	    $contracts=t_contract::where('product_id',$product->id)
	                         ->where('pay_date','>',$lastWeek->toDateString())
	                         ->where('pay_date','<=',$nowdate->toDateString())->get();
	    if($contracts->count())
	    {
	    	 
	    	$filename=$product->product_id+time();
	        \Excel::create($filename, function($excel) use ($productname, $contracts) {
              $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
              $sheet->loadView('pdreport') 
                    ->withProductname($productname)
	                ->withContracts($contracts);

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本周此产品下无合同产生');
	       }
	   
	   }
	   elseif($timerange==2)
	   {
	   	$lastMonth = Carbon::now()->subMonth();
	    $nowdate = Carbon::now();    
	    $contracts=t_contract::where('product_id',$product->id)
	                         ->where('pay_date','>',$lastMonth->toDateString())
	                         ->where('pay_date','<=',$nowdate->toDateString())->get();
	    if($contracts->count())
	    {
	    	 
	    	$filename=$product->product_id+time();
	        \Excel::create($filename, function($excel) use ($productname, $contracts) {
              $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
              $sheet->loadView('pdreport') 
                    ->withProductname($productname)
	                ->withContracts($contracts);

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本月此产品下无合同产生');
	       }
	   }
	    elseif($timerange==3)
	   {
	   	 $lastHalfyear = Carbon::now()->subMonths(3);
	    $nowdate = Carbon::now();    
	    $contracts=t_contract::where('product_id',$product->id)
	                         ->where('pay_date','>',$lastHalfyear->toDateString())
	                         ->where('pay_date','<=',$nowdate->toDateString())->get();
	    if($contracts->count())
	    {
	    	 
	    	$filename=$product->product_id+time();
	        \Excel::create($filename, function($excel) use ($productname, $contracts) {
              $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
              $sheet->loadView('pdreport') 
                    ->withProductname($productname)
	                ->withContracts($contracts);

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本季度内此产品下无合同产生');
	       }
	   }
	   elseif($timerange==4)
	   {
	   	 $lastHalfyear = Carbon::now()->subMonths(6);
	    $nowdate = Carbon::now();    
	    $contracts=t_contract::where('product_id',$product->id)
	                         ->where('pay_date','>',$lastHalfyear->toDateString())
	                         ->where('pay_date','<=',$nowdate->toDateString())->get();
	    if($contracts->count())
	    {
	    	 
	    	$filename=$product->product_id+time();
	        \Excel::create($filename, function($excel) use ($productname, $contracts) {
              $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
              $sheet->loadView('pdreport') 
                    ->withProductname($productname)
	                ->withContracts($contracts);

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('半年内此产品下无合同产生');
	       }
	   }
		else 
	   {
	   	$lastYear = Carbon::now()->subYear();
	    $nowdate = Carbon::now();    
	    $contracts=t_contract::where('product_id',$product->id)
	                         ->where('pay_date','>',$lastYear->toDateString())
	                         ->where('pay_date','<=',$nowdate->toDateString())->get();
	    if($contracts->count())
	    {
	    	 
	    	$filename=$product->product_id+time();
	        \Excel::create($filename, function($excel) use ($productname, $contracts) {
              $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
              $sheet->loadView('pdreport') 
                    ->withProductname($productname)
	                ->withContracts($contracts);

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本年度此产品下无合同产生');
	       }
	   }
       
    }
	
	
	
	 /**
     * post ctrreports and the begin time
	 * end time
     * return the reports for products
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ctrreports()
    {
        //
       $productname = Input::get('productname');
	   $timerange = Input::get('timerange');
	   $product=m_product::where('product_name',$productname)->first();
	  
	   if($timerange==1)
	   { 	 
        $lastWeek = Carbon::now()->subWeek();
	    $nowdate = Carbon::now();    
	    $contracts=t_contract::where('product_id',$product->id)
	                         ->where('pay_date','>',$lastWeek->toDateString())
	                         ->where('pay_date','<=',$nowdate->toDateString())->get();
		$productname='本周'.$productname;				 
	    if($contracts->count())
	    {
	    	 
	    	$filename=$product->product_name . time();
	        \Excel::create($filename, function($excel) use ($productname, $contracts) {
              $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
              $sheet->loadView('ctrreports') 
                    ->withProductname($productname)
	                ->withContracts($contracts);

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本周此产品下无合同产生');
	       }
	   
	   }
	   elseif($timerange==2)
	   {
	   	$lastMonth = Carbon::now()->subMonth();
	    $nowdate = Carbon::now();    
	    $contracts=t_contract::where('product_id',$product->id)
	                         ->where('pay_date','>',$lastMonth->toDateString())
	                         ->where('pay_date','<=',$nowdate->toDateString())->get();
	    if($contracts->count())
	    {
	    	 $productname='本月'.$productname;
	    	$filename=$product->product_name . time();
	        \Excel::create($filename, function($excel) use ($productname, $contracts) {
              $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
              $sheet->loadView('ctrreports') 
                    ->withProductname($productname)
	                ->withContracts($contracts);

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本月此产品下无合同产生');
	       }
	   }
	    elseif($timerange==3)
	   {
	   	 $lastHalfyear = Carbon::now()->subMonths(3);
	    $nowdate = Carbon::now();    
	    $contracts=t_contract::where('product_id',$product->id)
	                         ->where('pay_date','>',$lastHalfyear->toDateString())
	                         ->where('pay_date','<=',$nowdate->toDateString())->get();
	    if($contracts->count())
	    {
	    	 $productname='本季度'.$productname;
	    	
	    	$filename=$product->product_name . time();
	        \Excel::create($filename, function($excel) use ($productname, $contracts) {
              $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
              $sheet->loadView('ctrreports') 
                    ->withProductname($productname)
	                ->withContracts($contracts);

               });

               })->download('xls'); 
		 }
		 else {
			
			return Redirect::back()->withInput()->withErrors('本季度内此产品下无合同产生');
	       }
		 }
	
        elseif($timerange==4)
	   {
	   	 $lastHalfyear = Carbon::now()->subMonths(6);
	    $nowdate = Carbon::now();    
	    $contracts=t_contract::where('product_id',$product->id)
	                         ->where('pay_date','>',$lastHalfyear->toDateString())
	                         ->where('pay_date','<=',$nowdate->toDateString())->get();
	    if($contracts->count())
	    {
	    	 $productname='半年度'.$productname;
	    	
	    	$filename=$product->product_name . time();
	        \Excel::create($filename, function($excel) use ($productname, $contracts) {
              $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
              $sheet->loadView('ctrreports') 
                    ->withProductname($productname)
	                ->withContracts($contracts);

               });

               })->download('xls'); 
		}
		 else {
			
			return Redirect::back()->withInput()->withErrors('半年内此产品下无合同产生');
	       }
	   } 	   
		else 
	   {
	   	$lastYear = Carbon::now()->subYear();
	    $nowdate = Carbon::now();    
	    $contracts=t_contract::where('product_id',$product->id)
	                         ->where('pay_date','>',$lastYear->toDateString())
	                         ->where('pay_date','<=',$nowdate->toDateString())->get();
	    if($contracts->count())
	    {
	    	 $productname='本年度'.$productname;
	    	
	    	$filename=$product->product_name . time();
	        \Excel::create($filename, function($excel) use ($productname, $contracts) {
              $excel->sheet('New sheet', function($sheet)  use ($productname, $contracts) {
              $sheet->loadView('ctrreports') 
                    ->withProductname($productname)
	                ->withContracts($contracts);

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本年度此产品下无合同产生');
	       }
	   }
      
    }
	   
	   
	   
	  /**
     * post product infro and the begin time
	 * end time
     * return the reports for products
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cusreports()
    {
        //
        $timerange = Input::get('timerange');
	    
	   if($timerange==1)
	   { 	 
        $lastWeek = Carbon::now()->subWeek();
	    $nowdate = Carbon::now();    
	    $intrests=t_interestdetail::where('planinterest_date','>',$lastWeek->toDateString())
	                                ->where('planinterest_date','<=',$nowdate->toDateString())->get();
	    if($intrests->count())
	    {
	    	 $timerange="周";
	    	$filename=$intrests->first()->id . time();
	        \Excel::create($filename, function($excel) use ($intrests,$timerange) {
              $excel->sheet('New sheet', function($sheet)  use ($intrests,$timerange) {
              $sheet->loadView('cusreports')
			        ->withTimerange($timerange) 
                    ->withIntrests($intrests) ;

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本周无分红明细');
	       }
	   
	   }
	   elseif($timerange==2)
	   {
	   	$lastMonth = Carbon::now()->subMonth();
	    $nowdate = Carbon::now();    
	    $intrests=t_interestdetail::where('planinterest_date','>',$lastMonth->toDateString())
	                                ->where('planinterest_date','<=',$nowdate->toDateString())->get();
	    if($intrests->count())
	    {
	    	 $timerange="月";
	    	$filename=$intrests->first()->id . time();
	        \Excel::create($filename, function($excel) use ($intrests,$timerange) {
              $excel->sheet('New sheet', function($sheet)  use ($intrests,$timerange) {
              $sheet->loadView('cusreports')
			        ->withTimerange($timerange) 
                    ->withIntrests($intrests) ;

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本月无分红明细');
	       }
	   }
	    elseif($timerange==3)
	   {
	   	 $lastHalfyear = Carbon::now()->subMonths(3);
	    $nowdate = Carbon::now();    
	    $intrests=t_interestdetail::where('planinterest_date','>',$lastHalfyear->toDateString())
	                                ->where('planinterest_date','<=',$lastHalfyear->toDateString())->get();
	    if($intrests->count())
	    {
	    	 $timerange="季度";
	    		$filename=$intrests->first()->id . time();
	        \Excel::create($filename, function($excel) use ($intrests,$timerange) {
              $excel->sheet('New sheet', function($sheet)  use ($intrests,$timerange) {
             $sheet->loadView('cusreports')
			        ->withTimerange($timerange) 
                    ->withIntrests($intrests) ;

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本季度无分红明细');
	       }
	   }
	   	elseif($timerange==4)
	   {
	   	 $lastHalfyear = Carbon::now()->subMonths(6);
	    $nowdate = Carbon::now();    
	    $intrests=t_interestdetail::where('planinterest_date','>',$lastHalfyear->toDateString())
	                                ->where('planinterest_date','<=',$lastHalfyear->toDateString())->get();
	    if($intrests->count())
	    {
	    	 $timerange="半年度";
	    		$filename=$intrests->first()->id . time();
	        \Excel::create($filename, function($excel) use ($intrests,$timerange) {
              $excel->sheet('New sheet', function($sheet)  use ($intrests,$timerange) {
            $sheet->loadView('cusreports')
			        ->withTimerange($timerange) 
                    ->withIntrests($intrests) ;

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本半年度无分红明细');
	       }
	   }
		else 
	   {
	   	$lastYear = Carbon::now()->subYear();
	    $nowdate = Carbon::now();    
	    $intrests=t_interestdetail::where('planinterest_date','>',$lastYear->toDateString())
	                                ->where('planinterest_date','<=',$lastHalfyear->toDateString())->get();
	    if($intrests->count())
	    {
	    	 $timerange="半年度";
	    	$filename=$intrests->first()->id . time();
	        \Excel::create($filename, function($excel) use ($intrests,$timerange) {
              $excel->sheet('New sheet', function($sheet)  use ($intrests,$timerange) {
               $sheet->loadView('cusreports')
			        ->withTimerange($timerange) 
                    ->withIntrests($intrests) ;

               });

               })->download('xls'); 
		 }
	     else {
			
			return Redirect::back()->withInput()->withErrors('本年度无分红明细');
	       }
	   }
       
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
