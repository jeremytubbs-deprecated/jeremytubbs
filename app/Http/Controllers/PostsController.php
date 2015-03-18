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
		$posts = Post::with('tags')->where('published', '=', 1)->orderBy('published_at', 'DESC')->get();
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
		$parsedown = new \Parsedown();

		// assign request to input array
		$input = [
			'title' => $request->get('title'),
			'published_at' => $request->get('published_at'),
			'markdown' => $request->get('markdown'),
			'html' => $parsedown->text($request->get('markdown')),
			'published' => $request->get('published'),
			'summary' => $request->get('summary')
		];

		// create new post
		$post = new Post();
		$post->user_id = \Auth::user()->id;
		$post->title = $input['title'];
		$post->slug = $input['title'];
		$post->markdown = $input['markdown'];
		$post->html = $input['html'];
		$post->published = $input['published'];
		$post->summary = $input['summary'];
		$post->published_at = $input['published_at'];
		$post->save();

		// do tag stuff
		$tags = $request->get('tag_list');
		if ( isset($tags) ) {
			foreach($tags as $key => $tag)
			{
				// if tag is NAN create a new tag
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

		// if tag sync tags
		if (isset($tags)) {
			$post->tags()->sync($tags);
		}

		// do file stuff
		$file = $request->file('file');
		if ($request->hasFile('file'))
		{
			$destinationPath = 'images/posts';
			$filename = $file->getClientOriginalName();
			$request->file('file')->move($destinationPath, $filename);
		}

		$post->cover_image = isset($filename) ? $filename : null;
		$post->save();

		return redirect()->to('posts');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$post = Post::where('slug', '=', $slug)->with('user', 'tags')->firstOrFail();
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
		$parsedown = new \Parsedown();

		// assign request to input array
		$input = [
			'title' => $request->get('title'),
			'published_at' => $request->get('published_at'),
			'markdown' => $request->get('markdown'),
			'html' => $parsedown->text($request->get('markdown')),
			'published' => $request->get('published'),
			'summary' => $request->get('summary')
		];

		// update post
		$post->user_id = \Auth::user()->id;
		$post->title = $input['title'];
		$post->slug = $input['title'];
		$post->markdown = $input['markdown'];
		$post->html = $input['html'];
		$post->published = $input['published'];
		$post->summary = $input['summary'];
		$post->published_at = $input['published_at'];

		// do tag stuff
		$tags = $request->get('tag_list');
		if ( isset($tags) ) {
			foreach($tags as $key => $tag)
			{
				// if tag is NAN create a new tag
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

		// if tag sync tags
		if (isset($tags)) {
			$post->tags()->sync($tags);
		}

		// do file stuff
		$file = $request->file('file');
		if ($request->hasFile('file'))
		{
			$destinationPath = 'images/posts/';
			$filename = $file->getClientOriginalName();
			$request->file('file')->move($destinationPath, $filename);
		}

		$post->cover_image = isset($filename) ? $filename : null;
		$post->save();

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
