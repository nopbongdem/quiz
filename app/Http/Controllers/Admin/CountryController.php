<?php namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use Illuminate\Http\Request;
use Validator;

class CountryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$datas = Country::simplePaginate(20);
		return view('admin.country.index', compact('datas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('admin.country.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CountryRequest $request) {
		try {
			$data = Country::create($request->all());
			//$author->roles()->attach($request->role_list);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return redirect('admin/country');
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
			$data = Country::findOrFail($id);
		} catch (Excention $e) {

		}
		return view('admin.country.edit', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:2|unique:countries,name,' . $id,
		]);

		if (!$validator->fails()) {
			try {
				$data = Country::findOrFail($id);
				$data->update($request->all());
				return redirect('admin/country');
			} catch (Excention $e) {

			}
		} else {
			return redirect('admin/country/' . $id . '/edit')->withErrors($validator);
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
			$data = Country::findOrFail($id);
			$data->delete();
			return redirect('admin/country');
		} catch (Exception $e) {
			echo $e->getMessages();
		}
	}

}
