<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\m_product;
use Redirect, Input;
class ProductsController extends Controller
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
			$products=m_product::all();
			 return view('products.index')->withProducts($products);
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
}
