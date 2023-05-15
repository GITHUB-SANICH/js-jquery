<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{

	//проверка польхователя на авторизаци.
	public function __construct(){
		$this->middleware('auth', ['except' => ['show']]);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		return view('articles/create');		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//метод проверки полученных данных из формы 
		$this->validate($request, [														
			'title' => 'required|min:10|max:170', 										//условия проверки ошибки
			'anons' => 'required|min:10|max:170',
			'text' => 'required|min:10|max:170',
			'main_image' => 'nullable|image|max:500'
		]);

		if ($request->hasFile('main_image')) {											//условие проверки поля на наличие файла
			$file = $request->file('main_image')->getClientOriginalName();
			$image_name_without_ext = pathinfo($file, PATHINFO_FILENAME);
			$ext = $request->file('main_image')->getClientOriginalExtension();
			$image_name = $image_name_without_ext."_".time().".".$ext;
			$request->file('main_image')->storeAs('public/img/articles', $image_name);
		}else{
			$image_name = 'noimage.jpg';
		}
		
		$article = new Article();
		$article->title = $request->input('title');
		$article->anons = $request->input('anons');
		$article->text = $request->input('text');
		$article->user_id = auth()->user()->id; 
		$article->image = $image_name;
		$article->save();																		//запись полученных данных в БД
        return redirect('/')->with('success', 'Статья успешно добавлена'); //пердача данных на главную страницу с созданием сессии
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

	// метод вывода данных таблиц со статьями и комментариями
    public function show($id)
    {
		//вывод дной записи из БД
      $article = Article::find($id);
        $comments = Comment::where('article_id', $id)->get();
        $data = ['article' => $article, 'comments' => $comments];
        return view('articles.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$article = Article::find($id);
		//проверка на авторство
		if(auth()->user()->id != $article->user_id){
			return redirect('/')->with('error', 'Это не ваша статья');
		}

		return view('articles.edit')->with('article', $article);
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
			'title' => 'required|min:10|max:170', 										//условия проверки ошибки
			'anons' => 'required|min:10|max:170',
			'text' => 'required|min:10|max:170',
			'main_image' => 'nullable|image|max:500'
		]);

		if ($request->hasFile('main_image')) {
			$file = $request->file('main_image')->getClientOriginalName();
			$image_name_without_ext = pathinfo($file, PATHINFO_FILENAME);
			$ext = $request->file('main_image')->getClientOriginalExtension();
			$image_name = $image_name_without_ext."_".time().".".$ext;
			$request->file('main_image')->storeAs('public/img/articles', $image_name);
		}

		$article = Article::find($id);
		$article->title = $request->input('title');
		$article->anons = $request->input('anons');
		$article->text = $request->input('text');

		//условие изменения картинки ... т.е. при наличии 
		if($request->hasFile('main_image')){
			if ($article->image != 'noimage.jpg') {
				Storage::delete('public/img/articles/' . $article->image);
			}
			$article->image = $image_name;			
		} 

		$article->save();																		//запись полученных данных в БД
        return redirect('/')->with('success', 'Статья успешно обновлена'); //пердача данных на главную страницу с созданием сессии
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

	  //комментирование
	// public function commentPush(Request $request){

	//	$this->validate($request, [														//метод хранящий 
	//		'text_comm' => 'required|min:10|max:170',
	//	]);

	//	$article = new Article();
	//	$article->article_id = $request->id;
	//	$article->avtor_comm_id = auth()->user()->id; 
	//	$article->text = $request->input('text_comm');
	//	$article->save();																		//запись полученных данных в БД
   //     return redirect('/articles/{id}')->with('success', 'Комментарий оставлен'); //пердача данных на главную страницу с созданием сессии
	// }



    public function destroy($id)
    {
        $article = Article::find($id);
			//проверка на авторство
			if(auth()->user()->id != $article->user_id){
				return redirect('/')->with('error', 'Это не ваша статья');
			}

			//удаление изображения кроме изображения стандартного
			if ($article->image != 'noimage.jpg') {
				Storage::delete('public/img/articles/' . $article->image);
			}

		  $article->delete();
		  return redirect('/')->with('success', 'Статья была удалена');	
	}
}
