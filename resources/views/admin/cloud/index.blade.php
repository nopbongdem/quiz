@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
    	<div class="col-md-6 col-lg-6">
			<div class="box box-primary">
                <div class="box-header">
                	<h3 class="box-title">{!! trans('labels.author') !!}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url'=>'admin/cloud', 'role'=>'form','autocomplete'=>'on' ]) !!}
	                <div class="box-body">
	                    <div class="form-group">
	                      	{!! Form::label('url', trans('labels.link')) !!}
							{!! Form::text('url', null, array('class' => 'form-control')) !!}
							<small class="text-danger">{{ $errors->first('url') }}</small>
	                    </div>
						<div class="form-group">
						    {!! Form::label('story_id', trans('labels.story')) !!}
						    {!! Form::select('story_id', $stories, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
						    <small class="text-danger">{{ $errors->first('story_id') }}</small>
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