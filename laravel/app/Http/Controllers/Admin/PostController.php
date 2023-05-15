<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostFormRequest;

use Illuminate\Support\Facades\Gate;
use App\DTO\PostForm;


class PostController extends Controller
{
	
	public function __construct()
	{
	  $this->authorizeResource(Post::class, 'post');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$posts = Post::orderBy("created_at", "DESC")->paginate(10);
      return view('admin.posts.index', [
			'posts' => $posts,
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.posts.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
		$data = $request->validated();
		if ($request->has('thumbnail')) {
			$thumbnail = str_replace("public/posts", "", $request->file('thumbnail')->store("public/posts"));
			$data['thumbnail'] = $thumbnail;
		}
		
      $post = Post::create($data);
		return redirect(route('admin.posts.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
		//$post = Post::findOrFail($id);
		//аналог gate, но для контроллера, а не для шаблона
		$this->authorize('update', $post);

		return view('admin.posts.create', [
			"post" => $post   
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostFormRequest  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, Post $post)
    {
		//$post = Post::findOrFail($id);

		$data = $request->validated();
		if ($request->has('thumbnail')) {
			$thumbnail = str_replace("public/posts", "", $request->file('thumbnail')->store("public/posts"));
			$data['thumbnail'] = $thumbnail;
		}

		$post->update($data);
		return redirect(route('admin.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      //  Post::destroy($id);
		$post->delete();
		  return redirect(route("admin.posts.index"));
    }
}
