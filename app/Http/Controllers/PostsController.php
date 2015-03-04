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
		$posts = Post::with('tags')->orderBy('created_at', 'DESC')->get();
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
			'status' => $request->get('status') == 'true' ? 1 : 0
		];

		$tags = $request->get('tag_list');

		if ( isset($tags) ) {
			foreach($tags as $key => $tag)
			{
				if (! is_numeric($tag))
				{
					$newTag = new Tag();
			        $newTag->name = $tag;
			        $newTag->slug = $tag;
			        $newTag->save();
					$tags[$key] = $newTag->id;
				}
			}
		}
		$file = $request->file('file');

		if ($request->hasFile('file'))
		{
			$destinationPath = 'images/';
			$filename = $file->getClientOriginalName();
			$request->file('file')->move($destinationPath, $filename);
		}

		$post = new Post();
		$post->user_id = \Auth::user()->id;
		$post->title = $input['title'];
		$post->slug = $input['title'];
		$post->image = $filename;
		$post->markdown = $input['markdown'];
		$post->status = $input['status'];
		if( $input['status'] ) {
			$post->published_at = time();
		}
		$post->save();

		if (isset($tags)) {
			$post->tags()->sync($tags);
		}

		return redirect()->to('posts');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Post $post)
	{
		return view('posts.show', compact('post'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Post $post)
	{
		$tags = Tag::lists('name', 'id');
		return view('posts.edit', compact('post', 'tags'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, Post $post)
	{
		$input = [
			'title' => $request->get('title'),
			'markdown' => $request->get('commonmark'),
			'status' => $request->get('status') == 'true' ? 1 : 0
		];

		$tags = $request->get('tag_list');

		if ( isset($tags) ) {
			foreach($tags as $key => $tag)
			{
				if (! is_numeric($tag))
				{
					$newTag = new Tag();
			        $newTag->name = $tag;
			        $newTag->slug = $tag;
			        $newTag->save();
					$tags[$key] = $newTag->id;
				}
			}
		}

		$post->user_id = \Auth::user()->id;
		$post->title = $input['title'];
		$post->markdown = $input['markdown'];
		$post->status = $input['status'];
		if( $input['status'] ) {
			$post->published_at = time();
		}
		$post->update();

		if (isset($tags)) {
			$post->tags()->sync($tags);
		}

		return redirect()->to('posts');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Post $post)
	{
		$post->delete();
		return redirect()->to('posts');
	}

}
