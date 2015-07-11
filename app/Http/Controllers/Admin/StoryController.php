<?php namespace App\Http\Controllers\Admin;

use App\Author;
use App\Category;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoryRequest;
use App\Language;
use App\Story;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class StoryController extends Controller {

	public function index() {
		if (!Story::isValidNestedSet()) {
			Story::rebuild();
		}
		/*
		$par = Story::findOrFail(5);
		$d = $par->descendants()->wher('order', '>', 10)->wher('order', '<=', 39)->get();

		if (!$d->isEmpty()) {
		foreach ($d as $value) {
		$value->image = 'http://fakeanh.com/uploads/fairy/vol' . $value->order . '/001.jpg';
		$value->save();
		}
		}
		 */

		/*
		$par = Story::findOrFail(5);
		$dd = Story::wher('id', '>=', 17)->wher('id', '<=', 58)->get();
		if (!$dd->isEmpty()) {
		foreach ($dd as $value) {
		$value->makeChildOf($par);
		}
		}
		 */
		/*
		for ($i = 11; $i <= 48; $i++) {
		$story = new Story;
		$story->name = 'Fairy Tail Vol.' . $i;
		$story->author_id = 1;
		$story->country_id = 1;
		$story->lang_id = 3;
		$story->save();
		}
		 */
		//$datas = Story::toHierarchy()->simplePaginate(20);
		$datas = Story::all()->toHierarchy();

		return view('admin.story.index', compact('datas'));
	}

	public function status(Request $request) {
		if ($request->ajax()) {
			return 'DKMM';
		} else {
			return 1;
		}

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$languages = Language::lists('name', 'id');
		$countries = Country::lists('name', 'id');
		$categories = Category::lists('name', 'id');
		$tags = Tag::lists('name', 'id');
		$authors = Author::lists('name', 'id');
		$parents = Story::lists('name', 'id');
		return view('admin.story.create', compact('authors', 'categories', 'tags', 'countries', 'languages', 'parents'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StoryRequest $request) {
		if ($request->slug == null) {
			$request->merge(array('slug' => Str::slug(trim($request->name))));
		}

		try {
			$data = Story::create($request->all());
			if ($request->has('is_root')) {
				$data->makeRoot();
			} elseif ($request->has('parent')) {
				$parent = Story::findOrFail($request->parent);
				switch ($request->move) {
					case 1:
						$data->moveToLeftOf($parent);
						break;
					case 2:
						$data->moveToRightOf($parent);
						break;

					default:
						$data->makeChildOf($parent);
						break;
				}
			}
			$data->tags()->attach($request->input('tag_list'));
			$data->categories()->attach($request->input('category_list'));
			//$author->roles()->attach($request->role_list);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return redirect('admin/story');
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
		$languages = Language::lists('name', 'id');
		$countries = Country::lists('name', 'id');
		$categories = Category::lists('name', 'id');
		$tags = Tag::lists('name', 'id');
		$authors = Author::lists('name', 'id');
		$parents = Story::getNestedList('name', 'id');
		try {
			$data = Story::findOrFail($id);
			$data->parent = $data->parent_id;

		} catch (Excention $e) {

		}

		return view('admin.story.edit', compact('data', 'categories', 'tags', 'authors', 'countries', 'languages', 'parents'));
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
			'slug' => 'required|min:2',
		]);
		if (!$request->has('status')) {
			$request->merge(array('status' => 0));
		}

		if (!$validator->fails()) {
			try {
				$data = Story::findOrFail($id);
				if ($request->has('is_root')) {
					$data->makeRoot();
				} elseif ($request->has('parent')) {
					$parent = Story::findOrFail($request->parent);
					if ($data->isRoot()) {
						if (!$parent->isDescendantOf($data)) {
							try {
								switch ($request->move) {
									case 1:
										$data->moveToLeftOf($parent);
										break;
									case 2:
										$data->moveToRightOf($parent);
										break;

									default:
										$data->makeChildOf($parent);
										break;
								}

							} catch (Excention $e) {

							}
						}

					} else {
						$curent_parent = Story::findOrFail($data->parent_id);

						try {
							switch ($request->move) {
								case 1:
									$data->moveToLeftOf($parent);
									break;
								case 2:
									$data->moveToRightOf($parent);
									break;
								default:
									if (!$curent_parent->equals($parent)) {
										if (!$parent->isDescendantOf($data)) {
											$data->makeChildOf($parent);
										}
									}
									break;
							}

						} catch (Excention $e) {

						}
					}

				}
				$data->update($request->all());
				if ($request->tag_list != null) {
					$data->tags()->sync($request->input('tag_list'));
				}

				if ($request->category_list != null) {
					$data->categories()->sync($request->input('category_list'));
				}

				return redirect('admin/story');
			} catch (Excention $e) {

			}
		} else {
			return redirect('admin/story/' . $id . '/edit')->withErrors($validator);
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
			$data = Story::findOrFail($id);
			$data->delete();
			return redirect('admin/story');
		} catch (Exception $e) {
			echo $e->getMessages();
		}
	}

}
