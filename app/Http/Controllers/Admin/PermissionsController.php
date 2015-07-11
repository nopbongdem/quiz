<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Validator;

class PermissionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$datas = Permission::orderBy('id', 'desc')->simplePaginate(20);
		return view('admin.permission.index', compact('datas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$roles = Role::lists('name', 'id');
		return view('admin.permission.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PermissionRequest $request) {
		try {
			$permission = Permission::create($request->all());
			$permission->roles()->attach($request->role_list);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return redirect('admin/manager/permission');
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
		$roles = Role::lists('name', 'id');
		try {
			$permissions = Permission::findOrFail($id);
		} catch (Excention $e) {

		}
		return view('admin.permission.edit', compact('roles', 'permissions'));
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
				$permission = Permission::findOrFail($id);
				$permission->update($request->all());
				$permission->roles()->sync($request->role_list);
				return redirect('admin/manager/permission');
			} catch (Excention $e) {

			}
		} else {
			return redirect('admin/manager/permission/' . $id . '/edit')->withErrors($validator);
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
			$data = Permission::findOrFail($id);
			$data->delete();
			return redirect('admin/manager/permission');
		} catch (Exception $e) {
			echo $e->getMessages();
		}
	}

}
