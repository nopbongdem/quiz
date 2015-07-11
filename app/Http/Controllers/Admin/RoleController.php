<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Validator;

class RoleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$datas = Role::orderBy('id', 'desc')->simplePaginate(20);
		return view('admin.role.index', compact('datas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$permissions = Permission::lists('name', 'id');
		return view('admin.role.create', compact('permissions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(RoleRequest $request) {
		try {
			$role = Role::create($request->all());
			$role->permissions()->attach($request->permission_list);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return redirect('admin/manager/role');
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
		$permissions = Permission::lists('name', 'id');
		try {
			$role = Role::findOrFail($id);
		} catch (Excention $e) {

		}
		return view('admin.role.edit', compact('role', 'permissions'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:2|unique:roles,name,' . $id,
		]);

		if (!$validator->fails()) {
			try {
				$role = Role::findOrFail($id);
				$role->update($request->all());
				$role->permissions()->sync($request->input('permission_list'));
				return redirect('admin/manager/role');
			} catch (Excention $e) {

			}
		} else {
			return redirect('admin/manager/role/' . $id . '/edit')->withErrors($validator);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}
