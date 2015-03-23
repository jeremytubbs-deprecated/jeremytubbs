<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Tag;
use App\Category;

use Illuminate\Http\Request;

class ProjectsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::with('tags')->where('status', '=', 1)->orderBy('started_at', 'ASC')->get();
		return view('projects.index', compact('projects'));
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
		return view('projects.create', compact('tags', 'categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$project = Project::where('slug', '=', $slug)->with('user', 'tags', 'posts', 'cover', 'category')->firstOrFail();
		return view('projects.show', compact('project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Project $project)
	{
		$tags = Tag::lists('name', 'id');
		$categories = Category::lists('name', 'id');
		return view('projects.create', compact('project', 'tags', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, Project $project)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Project $project)
	{
		$project->delete();
		return redirect()->to('projects');
	}

}
