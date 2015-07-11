@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
	<div class="row">
		{!! Form::model($data, [ 'method'=>'PUT', 'route' => array('admin.story.update', $data->id), 'prefix'=>'admin', 'role'=>'form' ]) !!}
		<div class="col-md-6 col-lg-6">
			<div class="box box-primary">
                <div class="box-header">
                	<h3 class="box-title">{!! trans('labels.story') !!}</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                    	{!! Form::label('name', trans('labels.name')) !!}
                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>
                    <div class="form-group">
                    	{!! Form::label('slug', trans('labels.slug')) !!}
						{!! Form::text('slug', null, array('class' => 'form-control')) !!}
						<small class="text-danger">{{ $errors->first('slug') }}</small>
                    </div>
                    <div class="form-group">
	                	{!! Form::label('description', trans('labels.description')) !!}
					    {!! Form::textarea('description', null, array('class' => 'form-control' ,'rows' => 5)) !!}
					    <small class="text-danger">{{ $errors->first('description') }}</small>
	                </div>
	                <div class="form-group">
	                	{!! Form::label('image', trans('labels.image')) !!}
	                	<div class="input-group">
							<a href="http://fakeanh.com/filemanager/dialog.php?type=1&field_id=image&crossdomain=1&akey={!! Config::get('core.filemanager_key') !!}" class="input-group-addon iframe-btn">{!! FA::icon('image') !!}</a>
							{!! Form::text('image', null, array('class' => 'form-control', 'id' => 'image')) !!}
							<small class="text-danger">{{ $errors->first('image') }}</small>
						</div>
	                </div>
	                <div class="form-group">
	                	{!! Form::label('cover', trans('labels.cover')) !!}
	                	<div class="input-group">
							<a href="http://fakeanh.com/filemanager/dialog.php?type=1&field_id=cover&crossdomain=1&akey={!! Config::get('core.filemanager_key') !!}" class="input-group-addon iframe-btn">{!! FA::icon('image') !!}</a>
							{!! Form::text('cover', null, array('class' => 'form-control', 'id' => 'cover')) !!}
							<small class="text-danger">{{ $errors->first('cover') }}</small>
						</div>
	                </div>
                    <div class="form-group">
                    	{!! Form::label('author_id', trans('labels.author')) !!}
					    {!! Form::select('author_id', $authors, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('author_id') }}</small>
                    </div>
                    <div class="form-group">
                    	{!! Form::label('country_id', trans('labels.country')) !!}
					    {!! Form::select('country_id', $countries, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('country_id') }}</small>
                    </div>
                    <div class="form-group">
                    	{!! Form::label('lang_id', trans('labels.language')) !!}
					    {!! Form::select('lang_id', $languages, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('lang_id') }}</small>
                    </div>
                    <div class="form-group">
                    	{!! Form::label('category_list', trans('labels.category')) !!}
                    	{!! Form::select('category_list[]', $categories, null, ['id'=>'category_list', 'class' => 'form-control select2', 'multiple']) !!}
					    <small class="text-danger">{{ $errors->first('category_list') }}</small>
                    </div>
                    <div class="form-group">
                    	{!! Form::label('tag_list', trans('labels.tag')) !!}
                    	{!! Form::select('tag_list[]', $tags, null, ['id'=>'tag_list', 'class' => 'form-control select2', 'multiple']) !!}
					    <small class="text-danger">{{ $errors->first('tag_list') }}</small>
                    </div>
                    <div class="form-group">
						{!! Form::checkbox('status', 1, $data->status, ['class' => 'f-checkbox form-control']) !!}
						<small class="text-danger">{{ $errors->first('status') }}</small>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-md-6 col-lg-6">
			<div class="box box-primary">
                <div class="box-header">
                	<h3 class="box-title">{!! trans('labels.story') !!}</h3>
                </div>
                <div class="box-body">
                    {!! Form::label('order', trans('labels.order')) !!}
                    <div class="row">
                        <div class="col-xs-4">
                            {!! Form::text('order', null, array('class' => 'form-control col-md-6')) !!}
                            <small class="text-danger">{{ $errors->first('order') }}</small>
                        </div>
                    </div>
                	<div class="form-group">
                    	{!! Form::label('parent', trans('labels.parent')) !!}
					    {!! Form::select('parent', $parents, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
					    <small class="text-danger">{{ $errors->first('parent') }}</small>
                    </div>
                    {!! Form::label('is_root', 'Is Root') !!}
                    <div class="form-group">
                        {!! Form::checkbox('is_root', 1, $data->isRoot(), ['class' => 'f-checkbox form-control']) !!}
                        <small class="text-danger">{{ $errors->first('is_root') }}</small>
                    </div>
                    {!! Form::label('move', 'Move of parent') !!}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <label for="left">{!! trans('labels.move_left') !!} </label>
                                {!! Form::radio('move', 1, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <label for="right">{!! trans('labels.move_right') !!} </label>
                                {!! Form::radio('move', 2, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <label for="default">{!! trans('labels.default') !!}</label>
                                {!! Form::radio('move', 0, ['class' => 'form-control']) !!}
                            </div>
                            <small class="text-danger">{{ $errors->first('move') }}</small>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                	{!! Form::reset(trans('labels.reset'), ['class'=>'btn btn-warning']) !!}
					{!! Form::submit(trans('labels.save'), array('class' => 'btn btn-info pull-right')) !!}
            	</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>

@stop


@section('style')
{!! HTML::style('/assets/select2-4.0.0/dist/css/select2.min.css') !!}
{!! HTML::style('/assets/fancyapps-fancyBox/source/jquery.fancybox.css') !!}
{!! HTML::style('/assets/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
@stop

@section('script')
{!! HTML::script('/assets/bootstrap-switch-master/dist/js/bootstrap-switch.min.js') !!}
{!! HTML::script('/assets/select2-4.0.0/dist/js/select2.min.js') !!}
{!! HTML::script('/assets/fancyapps-fancyBox/source/jquery.fancybox.js') !!}
{!! HTML::script('/assets/fancyapps-fancyBox/source/jquery.fancybox.pack.js') !!}
<script type="text/javascript">
	$('.select2').select2();
    $("input[type=\"radio\"]").not("[data-switch-no-init]").bootstrapSwitch();
	$('.f-checkbox').bootstrapSwitch({
        size: 'normal',
        labelWidth: 1,
        onText: '{!! trans('labels.on') !!}',
        offText: '{!! trans('labels.off') !!}',
        offColor: 'danger'
    });
    $('.f-checkbox-indeterminate').bootstrapSwitch({
        size: 'normal',
        indeterminate: true,
        labelWidth: 1,
        handleWidth: 100,
        onText: '{!! trans('labels.move_left') !!}',
        offText: '{!! trans('labels.move_right') !!}',
        offColor: 'danger'
    });
	$('.iframe-btn').fancybox({
		'width'		: 900,
		'height'	: 600,
		'type'		: 'iframe',
        'autoScale'    	: false
    });

    function OnMessage(e){
  		var event = e.originalEvent;
   		if(event.data.sender === 'responsivefilemanager'){
      		if(event.data.field_id){
      			var fieldID=event.data.field_id;
      			var url=event.data.url;
				$('#'+fieldID).val(url).trigger('change');
				$.fancybox.close();

				$(window).off('message', OnMessage);
      		}
   		}
	}

// Handler for a message from ResponsiveFilemanager
	$('.iframe-btn').on('click',function(){
  		$(window).on('message', OnMessage);
	});
</script>
@stop