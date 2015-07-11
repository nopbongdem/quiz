@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<div class="box box-primary">
                <div class="box-header">
                	<h3 class="box-title">{!! trans('labels.country') !!}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($data, [ 'method'=>'PUT', 'route' => array('admin.country.update', $data->id), 'prefix'=>'admin', 'role'=>'form' ]) !!}
	                <div class="box-body">
	                    <div class="form-group">
	                      	{!! Form::label('name', trans('labels.name')) !!}
							{!! Form::text('name', null, array('class' => 'form-control')) !!}
							<small class="text-danger">{{ $errors->first('name') }}</small>
	                    </div>
	                    <div class="form-group">
	                    	{!! Form::label('code', trans('labels.code')) !!}
							{!! Form::text('code', null, array('class' => 'form-control')) !!}
							<small class="text-danger">{{ $errors->first('code') }}</small>
	                    </div>
	                    <div class="form-group">
		                	{!! Form::label('flag', trans('labels.flag')) !!}
		                	<div class="input-group">
  								<a href="http://fakeanh.com/filemanager/dialog.php?type=1&field_id=image&crossdomain=1&akey={!! Config::get('core.filemanager_key') !!}" class="input-group-addon iframe-btn">{!! FA::icon('image') !!}</a>
  								{!! Form::text('flag', null, array('class' => 'form-control', 'id' => 'image')) !!}
  								<small class="text-danger">{{ $errors->first('flag') }}</small>
							</div>
		                </div>
	                    <div class="form-group">
		                	{!! Form::label('description', trans('labels.description')) !!}
						    {!! Form::textarea('description', null, array('class' => 'form-control' ,'rows' => 5)) !!}
						    <small class="text-danger">{{ $errors->first('description') }}</small>
		                </div>
	                </div><!-- /.box-body -->
	                <div class="box-footer">
	                	{!! Form::reset(trans('labels.reset'), ['class'=>'btn btn-warning']) !!}
						{!! Form::submit(trans('labels.save'), array('class' => 'btn btn-info pull-right')) !!}
                	</div>
                {!! Form::close() !!}
            </div><!-- /.box -->
		</div>
	</div>

@stop

@section('style')
{!! HTML::style('/assets/select2-4.0.0/dist/css/select2.min.css') !!}
{!! HTML::style('/assets/fancyapps-fancyBox/source/jquery.fancybox.css') !!}
@stop

@section('script')
{!! HTML::script('/assets/select2-4.0.0/dist/js/select2.min.js') !!}
{!! HTML::script('/assets/fancyapps-fancyBox/source/jquery.fancybox.js') !!}
{!! HTML::script('/assets/fancyapps-fancyBox/source/jquery.fancybox.pack.js') !!}
<script type="text/javascript">
	$('.select2').select2();

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

	$('.iframe-btn').on('click',function(){
  		$(window).on('message', OnMessage);
	});
</script>
@stop