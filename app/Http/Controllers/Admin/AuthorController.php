<?php namespace App\Http\Controllers\Admin;

use App\Author;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use Illuminate\Http\Request;
use Validator;

class AuthorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$datas = Author::simplePaginate(20);
		return view('admin.author.index', compact('datas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('admin.author.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AuthorRequest $request) {
		try {
			$author = Author::create($request->all());
			//$author->roles()->attach($request->role_list);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return redirect('admin/author');
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
			$data = Author::findOrFail($id);
		} catch (Excention $e) {

		}
		return view('admin.author.edit', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:2|unique:authors,name,' . $id,
		]);

		if (!$validator->fails()) {
			try {
				$author = Author::findOrFail($id);
				$author->update($request->all());
				return redirect('admin/author');
			} catch (Excention $e) {

			}
		} else {
			return redirect('admin/author/' . $id . '/edit')->withErrors($validator);
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
			$data = Author::findOrFail($id);
			$data->delete();
			return redirect('admin/author');
		} catch (Exception $e) {
			echo $e->getMessages();
		}
	}

}
