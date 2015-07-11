<?php namespace App\Http\Controllers\Admin;

use App\Chapter;
use App\Http\Controllers\Controller;
use App\Story;
use Cache;
use Htmldom;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CloudController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$link = 'http://truyentranhtuan.net/truyentranh/190/fairy-tail';
		$stories = Story::lists('name', 'id');
		//return view('admin.cloud.index', compact('stories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		$link = $request->url;
		$html = new Htmldom($link);
		if (!Cache::has('chap')) {
			Cache::put('chap', 0, 10000);
		}
		if (!empty($html)) {
			$ulpost = $html->find('ul.ulpost li a');
			if (count($ulpost) > 0) {
				$datas = new \stdClass();
				$list = array_reverse($ulpost);

				$i = Cache::get('chap') ? Cache::get('chap') : 0;
				foreach ($list as $key => $value) {
					if (!Cache::has($value->href)) {
						$i++;
						$string = new Htmldom($value->href);
						$chapter = new Chapter;
						$chapter->story_id = $request->story_id;
						$chapter->name = 'Fairy Tail ' . $i;
						$chapter->slug = Str::slug($chapter->name);
						$chapter->chapter = $i;
						$chapter->html = $string->find('div.noidung', 0)->innertext;
						try {
							$chapter->save();
							Cache::put($value->href, $value->href, 5000);
							Cache::increment('chap');
							//Cache::put('chap', $i);
						} catch (Exception $e) {
							echo $value->href;
							echo $e->getMessage();
						}

					}
				}
			} else {
				$list = null;
			}
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
		//
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
		//
	}

}
