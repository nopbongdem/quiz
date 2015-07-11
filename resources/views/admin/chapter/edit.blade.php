@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
	<div class="row">
	{!! Form::model($data, [ 'method'=>'PUT', 'route' => array('admin.chapter.update', $data->id), 'role'=>'form' ]) !!}
		<div class="col-md-6 col-lg-6">
			<div class="box box-primary">
                <div class="box-header">
                	<h3 class="box-title">{!! trans('labels.info') !!}</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                      	{!! Form::label('name', trans('labels.title')) !!}
						{!! Form::text('name', null, array('class' => 'form-control')) !!}
						<small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>
                    <div class="form-group">
                    	{!! Form::label('slug', trans('labels.slug')) !!}
						{!! Form::text('slug', null, array('class' => 'form-control')) !!}
						<small class="text-danger">{{ $errors->first('slug') }}</small>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
		</div>
		<div class="col-md-6 col-lg-6">
			<div class="box box-primary">
                <div class="box-header">
                	<h3 class="box-title">SEO</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                      	{!! Form::label('keywords', trans('labels.keyword')) !!}
						{!! Form::text('keywords', null, array('class' => 'form-control')) !!}
						<small class="text-danger">{{ $errors->first('keywords') }}</small>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
		</div>
		<div class="clearfix"></div>
		<div class="col-md-8 col-lg-8">
			<div class="box box-primary">
                <div class="box-header">
                	<h3 class="box-title">{!! trans('labels.content') !!}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	{!! Form::label('description', trans('labels.description')) !!}
				    {!! Form::textarea('description', null, array('class' => 'form-control' ,'rows' => 5)) !!}
				    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
                <div class="box-body">
                	<a class="btn btn-default media-namager" href="http://fakeanh.com/filemanager/dialog.php?type=1&field_id=summernote&crossdomain=1&akey={!! Config::get('core.filemanager_key') !!}">{!! FA::icon('camera') !!}</a>
				    {!! Form::textarea('html', null, array('class' => 'form-control summernote','id' => 'summernote')) !!}
				    <small class="text-danger">{{ $errors->first('html') }}</small>
                </div>
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
			<div class="box box-primary">
                <div class="box-header">
                	<h3 class="box-title">{!! trans('labels.info') !!}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	<div class="form-group">
					    {!! Form::label('chapter', trans('labels.chapter')) !!}
					    {!! Form::text('chapter', null, array('class' => 'form-control')) !!}
					    <small class="text-danger">{{ $errors->first('chapter') }}</small>
					</div>
					<div class="form-group">
					    {!! Form::label('story_id', trans('labels.story')) !!}
					    {!! Form::select('story_id', $stories, $data->story_id, ['class' => 'form-control select2', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('story_id') }}</small>
					</div>
		        </div>
		        <div class="box-footer">
		        	{!! Form::reset(trans('labels.reset'), ['class'=>'btn btn-warning']) !!}
					{!! Form::submit(trans('labels.save'), array('class' => 'btn btn-info col-sm-offset-1','name'=>'save')) !!}
					{!! Form::submit('+ ' . trans('labels.save'), array('class' => 'btn btn-info col-sm-offset-1','name'=>'save_new')) !!}
					<a href="{!! url('/admin/chapter/create') !!}" class="btn btn-success pull-right">{!! FA::icon('plus') !!}</a>
		        </div>

		    </div>
		</div>

		{!! Form::close() !!}
	</div>

@stop


@section('style')
{!! Helpers::style('/assets/fancyapps-fancyBox/source/jquery.fancybox.css') !!}
{!! Helpers::style('/assets/select2-4.0.0/dist/css/select2.min.css') !!}
{!! Helpers::style('/assets/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css') !!}
{!! Helpers::style('//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.css') !!}
{!! Helpers::style('//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.min.css') !!}
{!! Helpers::style('/assets/summernote-master/dist/summernote.css') !!}
@stop


@section('script')
{!! Helpers::script('/assets/fancyapps-fancyBox/source/jquery.fancybox.js') !!}
{!! Helpers::script('/assets/fancyapps-fancyBox/source/jquery.fancybox.pack.js') !!}
{!! Helpers::script('/assets/select2-4.0.0/dist/js/select2.min.js') !!}
{!! Helpers::script('/assets/moment/moment.min.js') !!}
{!! Helpers::script('/assets/moment/moment-with-locales.min.js') !!}
{!! Helpers::script('/assets/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') !!}
{!! Helpers::script('//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.js') !!}
{!! Helpers::script('//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.min.js') !!}
{!! Helpers::script('//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.min.js') !!}
{!! Helpers::script('/assets/summernote-master/dist/summernote.js') !!}
{!! Helpers::script('/assets/summernote-master/lang/summernote-vi-VN.js') !!}
{!! Helpers::script('/assets/summernote-master/plugin/summernote-ext-hello.js') !!}
{!! Helpers::script('/assets/summernote-master/plugin/summernote-ext-hint.js') !!}
{!! Helpers::script('/assets/summernote-master/plugin/summernote-ext-video.js') !!}
{!! Helpers::script('/assets/summernote-master/plugin/summernote-ext-filemanager.js') !!}
<script src="summernote.min.js"></script>
<script type="text/javascript">
	$(".fancybox").fancybox({
		'width'		: 900,
		'height'	: 600,
		'type'		: 'iframe',
        'autoScale'    	: true,
		'iframe': {
			width: 900,
			scrolling : 'auto',
			preload   : true
		}

	});
	$('.datetimepicker').datetimepicker({
		locale: 'vi'
	});
	$('.summernote').summernote({
		tabsize: 2,
		height: 500,
  		minHeight: null,
  		maxHeight: null,
  		lang: 'vi-VN',
  		codemirror: {
		    theme: 'monokai'
		},
		toolbar: [
    		['style', ['style', 'bold', 'italic', 'underline', 'clear']],
    		['font', ['strikethrough', 'superscript', 'subscript']],
    		['fontname', ['fontname']],
    		['fontsize', ['fontsize']],
    		['color', ['color']],
    		['para', ['ul', 'ol', 'paragraph']],
    		['table', ['table']],
    		['url', ['link', 'hr', 'video']],
    		['height', ['height']],
    		['misc', ['undo','redo','fullscreen','codeview']],
    		['help', ['help']]
  		]
	});

	$('.select2').select2();

	function OnMessage(e){
  		var event = e.originalEvent;
  		var fieldID = event.data.field_id;
		var $summernote = $('#'+fieldID);
   		if(event.data.sender === 'responsivefilemanager'){
      		if(event.data.field_id){
      			var url = event.data.url;
      			var img = new Image();
      			img.src = url;
      			$summernote.summernote('editor.insertNode', img);
				$.fancybox.close();
				$(window).off('message', OnMessage);
      		}
   		}
	}

	$('.media-namager').on('click',function(){
  		$(window).on('message', OnMessage);
	});
</script>
@stop