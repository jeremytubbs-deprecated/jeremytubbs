<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;
use App\Project;

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
		$categories = Category::lists('name', 'id');
		$projects = Project::lists('title', 'id');
		return view('posts.create', compact('tags', 'categories', 'projects'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// create new post
		$post = new Post();
		$post->user_id = \Auth::user()->id;
		$post->slug = $request->get('title');
		$post->html = $request->get('markdown');
		$post->fill($request->all());
		$post->featured = $request->has('featured') ? 1 : 0;
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

		return redirect()->to('admin');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$post = Post::where('slug', '=', $slug)->with('user', 'tags', 'project', 'cover', 'category')->firstOrFail();
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
		$categories = Category::lists('name', 'id');
		$projects = Project::lists('title', 'id');
		return view('posts.edit', compact('post', 'tags', 'categories', 'projects'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, Post $post)
	{
		// update post
		$post->user_id = \Auth::user()->id;
		$post->slug = $request->get('title');
		$post->html = $request->get('markdown');
		$post->fill($request->all());
		$post->featured = $request->has('featured') ? 1 : 0;
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

		return redirect()->to('admin');
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
		return redirect()->to('admin');
	}

}
