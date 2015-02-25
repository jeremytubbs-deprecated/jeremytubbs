<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;

use Illuminate\Http\Request;

class PostsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::all();
		return view('posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tags = Tag::lists('name', 'id');
		return view('posts.create', compact('tags'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$input = [
			'title' => $request->get('title'),
			'markdown' => $request->get('commonmark'),
			'status' => $request->get('status')
		];

		$tags = $request->get('tags');
		foreach($tags as $key => $tag)
		{
			if (! is_numeric($tag))
			{
				$newTag = new Tag();
				$newTag->name = $tag;
				$newTag->save();
				$tags[$key] = $newTag->id;
			}
		}

		$post = new Post();
		$post->user_id = \Auth::user()->id;
		$post->title = $input['title'];
		$post->slug = $input['title'];
		$post->markdown = $input['markdown'];
		if($input['status'] == 'true') {
			$post->published_at = time();
			$message = $input['title'] . ' published.';
		} else {
			$message = $input['title'] . ' saved.';
		}
		$post->status = $input['status'] == 'true' ? 1 : 0;
		$post->save();

		$post->tags()->attach($tags);

		return redirect()->to('posts');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('posts.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('posts.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
