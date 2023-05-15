<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$shop = DB::select('SELECT * FROM shops');
		dd($shop);
		return view('dz/index')->with('shop', $shop);
	 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('dz/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		{
			$this->validate($request, [														//метод хранящий 
				'title' => 'required|min:10|max:170', 										//условия проверки ошибки
				'description' => 'required|min:10|max:170',
				'category' => 'required|min:3|max:40',
				'price' => 'required',
				'price' => 'numeric|min:1|max:1000000',
				'price' => 'integer'
			]);
			$shop = new Shop();
			$shop->title = $request->input('title');
			$shop->anons = $request->input('description');
			$shop->category = $request->input('category');
			$shop->price = $request->input('price');

			$shop->save();																		//запись полученных данных в БД
			  return redirect('/')->with('success', 'Товар добавлен'); 			//пердача данных на главную страницу с созданием сессии
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
		$shop = shop::find($id);
		return view('dz/show')->with('shop', $shop);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$shop = shop::find($id);
		return view('dz.edit')->with('shop', $shop);
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
			$this->validate($request, [														//метод хранящий 
				'title' => 'required|min:3|max:170', 										//условия проверки ошибки
				'description' => 'required|min:10|max:170',
				'category' => 'required|min:3|max:40',
				'price' => 'required',
				'price' => 'numeric|min:1|max:1000000',
				'price' => 'integer'
			]);
			$shop = Shop::find($id);
			$shop->title = $request->input('title');
			$shop->anons = $request->input('description');
			$shop->category = $request->input('category');
			$shop->price = $request->input('price');

			$shop->save();																		//запись полученных данных в БД
			  return redirect('/')->with('success', 'Товар изменен'); 			//пердача данных на главную страницу с созданием сессии
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
    }
}
