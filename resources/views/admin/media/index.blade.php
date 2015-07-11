@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-10">
        	<div class="embed-responsive embed-responsive-16by9">
        		<iframe class="embed-responsive-item" src="http://fakeanh.com/filemanager/dialog.php?crossdomain=1&akey={!! Config::get('core.filemanager_key') !!}"></iframe>
			</div>
        </div>
	</div>
@stop