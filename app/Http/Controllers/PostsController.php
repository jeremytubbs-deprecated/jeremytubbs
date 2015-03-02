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
		$tags = $this->tag->tagList();
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
			'status' => $request->get('status') == 'true' ? 1 : 0,
			'tags' => $request->get('tag_list')
		];

		if ( isset($input['tags']) ) {
			$input['tags'] = $this->tag->createOrUpdate($input['tags']);
		}

		$this->post->create($input);

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
	public function edit($id)
	{
		$post = $this->post->find($id);
		$tags = $this->tag->tagList();
		return view('posts.edit', compact('post', 'tags'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$input = [
			'title' => $request->get('title'),
			'markdown' => $request->get('commonmark'),
			'status' => $request->get('status') == 'true' ? 1 : 0,
			'tags' => $request->get('tag_list')
		];

		if ( isset($input['tags']) ) {
			$input['tags'] = $this->tag->createOrUpdate($input['tags']);
		}

		$this->post->update($input);

		return redirect()->to('posts');
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
