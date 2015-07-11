<?php namespace App\Http\Controllers\Admin;

use App\Chapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterRequest;
use App\Story;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class ChapterController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$datas = Chapter::orderBy('id', 'desc')->simplePaginate(20);

		//$data = Chapter::all();
		//dd(Response::json($data));
		return view('admin.chapter.index', compact('datas'));
		//return view('admin.chapter.demo');
	}

	public function loadData(Request $request) {

		$datas = Chapter::select(['id', 'name']);

		$s = new \stdClass();
		$s->data = $datas;
		return $data;

		//return $data;
	}

	public function getData() {
		$datas = Chapter::select('chapter.*', 'story.name')->leftJoin('stories', 'stories.id', '=', 'stories.story_id');
		return Datatables::of($datas)
		//->addColumn('chapter', $datas->stories->name)

			->make(true);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$stories = Story::lists('name', 'id');
		return view('admin.chapter.create', compact('stories'));
	}

	public function add() {
		$stories = Story::lists('name', 'id');
		return view('admin.chapter.add', compact('stories'));
	}

	public function ads(Request $request) {
		$vol = trim($request->vol);
		if ($request->has('chapter')) {
			$name = $request->name;
			$chapter = $request->chapter;
			$start = $request->start;
			$end = $request->end;
			for ($i = 0; $i < count($request->chapter); $i++) {
				$html = "";
				$link = 'http://fakeanh.com/uploads/fairy/vol' . $vol . '/';
				if ($start[$i] == null) {
					$st = $end[$i - 1] + 1;
				} else {
					$st = $start[$i];
				}

				for ($k = $st; $k <= $end[$i]; $k++) {
					if ($k < 10) {
						$html .= '<img src="' . $link . '00' . $k . '.jpg">';
					} else if ($k < 100) {
						$html .= '<img src="' . $link . '0' . $k . '.jpg">';
					} else {
						$html .= '<img src="' . $link . $k . '.jpg">';
					}
				}
				$chap = new Chapter;
				$chap->name = $chapter[$i] . ' - ' . $name[$i];
				$chap->slug = Str::slug(trim($chap->name));
				$chap->chapter = $chapter[$i];
				$chap->html = $html;
				$chap->story_id = $request->story_id;
				$chap->keywords = 'Fairy Tail,Fairy Tail English,Fairy Tail Vol ' . $vol;
				$chap->save();
			}
		}

		return redirect('admin/chapter');

	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ChapterRequest $request) {

		$vol = trim($request->vol);
		$start = trim($request->start);
		$end = trim($request->end);
		$html = "";
		$link = 'http://fakeanh.com/uploads/fairy/vol' . $vol . '/';
		if ($request->has('start') && $request->has('end')) {
			for ($i = $start; $i <= $end; $i++) {
				if ($i < 10) {
					$html .= '<img src="' . $link . '00' . $i . '.jpg">';
				} else if ($i < 100) {
					$html .= '<img src="' . $link . '0' . $i . '.jpg">';
				} else {
					$html .= '<img src="' . $link . $i . '.jpg">';
				}
			}
			if ($html != null) {
				$request->merge(array('html' => $html));
			}
		}

		//dd($request->all());

		if (!$request->has('slug')) {
			$request->merge(array('slug' => Str::slug(trim($request->name))));
		}
		if (!$request->has('keywords')) {
			$request->merge(array('keywords' => 'Fairy Tail,Fairy Tail English,Fairy Tail Vol ' . $vol));
		}
		if (!$request->has('chapter')) {
			$request->merge(array('chapter' => intval($request->name)));
		}

		$data = Chapter::create($request->all());
		if ($request->has('save_new')) {
			return redirect('admin/chapter/create');
		}

		if ($request->has('save')) {
			return redirect('admin/chapter/' . $data->id . '/edit');
		}

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
			$data = Chapter::findOrFail($id);
		} catch (Excention $e) {

		}
		$stories = Story::lists('name', 'id');
		return view('admin.chapter.edit', compact('stories', 'data'));
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
		if (!$validator->fails()) {
			try {
				$data = Chapter::findOrFail($id);
				$data->update($request->all());
				if ($request->has('save_new')) {
					return redirect('admin/chapter/create');
				}

				if ($request->has('save')) {
					return redirect('admin/chapter/');
				}
				//return redirect('admin/chapter');
			} catch (Excention $e) {
				echo $e->getMessage();
			}
		} else {
			return redirect('admin/chapter/' . $id . '/edit')->withErrors($validator);
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
			$data = Chapter::findOrFail($id);
			$data->delete();
			return redirect('admin/chapter');
		} catch (Exception $e) {
			echo $e->getMessages();
		}
	}

}
