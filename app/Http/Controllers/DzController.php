<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class DzController extends Controller{

	public function dz_metod (){
		//$title_stat = 'Запись на сайте';
		//$text			= 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit recusandae quod a minima laborum quisquam omnis dolor praesentium nam. Blanditiis eum aspernatur voluptates nobis quos ipsum non, id atque quis.';
		
		//$data = [
		//	'title'	=> 'Блог',
		//	'params'	=> [$title_stat, $text]
		//];

		$data = [
			'title'	=> 'Блог',
			'params'	=> [
								'0' => ['title_str' => 'Запись на сайте', 'text' => 'текст']
							]
		];
		return view('static/blog')->with($data); //можно было оформить так: with('header', $data);
	}
}
