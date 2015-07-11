<?php namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$datas = Category::simplePaginate(20);
		return view('admin.category.index', compact('datas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('admin.category.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		try {
			$data = Category::create($request->all());
			//$author->roles()->attach($request->role_list);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return redirect('admin/category');
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
			$data = Category::findOrFail($id);
		} catch (Excention $e) {

		}
		return view('admin.category.edit', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:2|unique:categories,name,' . $id,
		]);

		if (!$validator->fails()) {
			try {
				$data = Category::findOrFail($id);
				$data->update($request->all());
				return redirect('admin/category');
			} catch (Excention $e) {

			}
		} else {
			return redirect('admin/category/' . $id . '/edit')->withErrors($validator);
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
			$data = Category::findOrFail($id);
			$data->delete();
			return redirect('admin/category');
		} catch (Exception $e) {
			echo $e->getMessages();
		}
	}

}
