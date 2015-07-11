<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class TagController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//$datas = Tag::withTrashed()->simplePaginate(20);
		$datas = Tag::simplePaginate(20);
		return view('admin.tag.index', compact('datas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('admin.tag.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TagRequest $request) {
		if ($request->slug == null) {
			$request->merge(array('slug' => Str::slug(trim($request->name))));
		}

		$tag = Tag::create($request->all());

		return redirect('admin/tag');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		try {
			$tag = Tag::findOrFail($id);
		} catch (Excention $e) {

		}
		return view('admin.tag.edit', compact('tag'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		if ($request->slug == null) {
			$request->merge(array('slug' => Str::slug(trim($request->name))));
		}
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:2',
			'slug' => 'required|min:2|unique:tags,slug,' . $id,
		]);

		dd($id);

		if (!$validator->fails()) {
			try {
				$tag = Tag::findOrFail($id);
				$tag->update($request->all());
				return redirect('admin/tag');
			} catch (Excention $e) {

			}
		} else {
			return redirect('admin/tag/' . $id . '/edit')->withErrors($validator);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		try {
			$tag = Tag::findOrFail($id);

			$tag->delete();

			return redirect('admin/tag');
		} catch (Exception $e) {
			echo $e->getMessages();
		}
	}
}
