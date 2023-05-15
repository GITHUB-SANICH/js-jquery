<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentForm;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	public function index()
	{
		$posts = Post::orderBy("created_at", "DESC")->paginate(3);

		return view('posts.index', [
			'posts' => $posts,
		]);
	}

	//public function show($id)
	//{
	//	$post = Post::findOrFail($id);

	//	return view('posts.show', [
	//		'post' => $post,
	//	]);
	//}
    
	public function show($id)
	{
		 $post = Post::findOrFail($id);
		// $post = Post::with("comments.user")->findOrFail($id);

		 return view('posts.show', [
			"post" => $post,
		 ]);
	}

	public function comment($id, CommentForm $request)
	{
		$post = Post::findOrFail($id);
		$comment = $post->comments()->create($request->validated());
		//вызов события по отправки комментария
		//event(new CommentCreated($comment));

		return redirect(route("posts.show", $id));
	}
}
