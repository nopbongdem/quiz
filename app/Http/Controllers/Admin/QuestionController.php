<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$datas = Question::simplePaginate(20);
		return view('admin.question.index', compact('datas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$category = Category::lists('name', 'id');
		return view('admin.question.add', compact('category'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		//$quiz = array_combine($request->key, $request->value);
		$request->merge(array('choose' => json_encode($request->value, JSON_FORCE_OBJECT)));
		$ngon = $request->only('question', 'image', 'choose', 'answer', 'category_id');
		try {
			$data = Question::create($ngon);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return redirect('admin/question');
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
		$category = Category::lists('name', 'id');
		try {
			$data = Question::findOrFail($id);
		} catch (Excention $e) {

		}
		return view('admin.question.edit', compact('data', 'category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		try {
			$data = Question::findOrFail($id);
			$data->delete();
			return redirect('admin/question');
		} catch (Exception $e) {
			echo $e->getMessages();
		}
	}
}
