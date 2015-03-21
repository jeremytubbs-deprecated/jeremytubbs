<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cover;

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
			$destinationPath = 'uploads/covers';
			$filename = $file->getClientOriginalName();
			$request->file('file')->move($destinationPath, $filename);
			$src = '/' . $destinationPath . '/' . $filename;

			$cover = new Cover();
			$cover->src = $src;
			$cover->save();

			return \Response::json($cover, 200);
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
		$cover = Cover::find($id);
		if ( \File::exists(public_path() . $cover->src )) {
			\File::delete(public_path() . $cover->src);
		}
		$cover->delete();

		return \Response::json('success', 200);
	}

}
