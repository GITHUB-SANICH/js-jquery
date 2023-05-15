<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaticController extends Controller
{
    public function index_metod (){
		//$articles = Article::orderBy('id', 'desc')->get();
		//$articles = Article::where('id', '>', '1')->take(1)->get();
		//$articles = Article::orderBy('id', 'desc')->paginate(1);

		//$articles	= Article::all();
		$articles = Article::orderBy('id', 'desc')->get();
		//$articles = DB::select('SELECT * FROM articles'); - вариант передачи данных в шаблон, выдающий ошибку - при наличии связей с другими моделями.
		return view('static/index')->with('articles', $articles);
	 }

	 public function about_metod (){
		
		$data = [
			'title'	=> 'Страница про нас',
			'params'	=> ['BMW', 'Audio', 'Volvo']
		];

		return view('static/about')->with($data); //можно было оформить так: with('header', $data);
	}
}
