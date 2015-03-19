<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CoversController extends Controller {


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// do file stuff
		if ($request->hasFile('file'))
		{
			$file = $request->file('file');
			$destinationPath = 'images/uploads/covers';
			$filename = $file->getClientOriginalName();
			$request->file('file')->move($destinationPath, $filename);

			return \Response::json('success', 200);
		}

		return \Response::json('error', 400);
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
