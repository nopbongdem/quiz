<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Language;
use Illuminate\Http\Request;
use Validator;

class LanguageController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$datas = Language::simplePaginate(20);
		return view('admin.language.index', compact('datas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('admin.language.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(LanguageRequest $request) {
		try {
			$data = Language::create($request->all());
			//$author->roles()->attach($request->role_list);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return redirect('admin/language');
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
			$data = Language::findOrFail($id);
		} catch (Excention $e) {

		}
		return view('admin.language.edit', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:2|unique:languages,name,' . $id,
		]);

		if (!$validator->fails()) {
			try {
				$data = Language::findOrFail($id);
				$data->update($request->all());
				return redirect('admin/language');
			} catch (Excention $e) {

			}
		} else {
			return redirect('admin/language/' . $id . '/edit')->withErrors($validator);
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
			$data = Language::findOrFail($id);
			$data->delete();
			return redirect('admin/language');
		} catch (Exception $e) {
			echo $e->getMessages();
		}
	}

}
