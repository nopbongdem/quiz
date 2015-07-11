@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<div class="box box-primary">
                <div class="box-header">
                	<h3 class="box-title">Tag info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($tag, ['method'=>'PUT', 'route' => array('admin.tag.update', $tag->id), 'role'=>'form', 'autocomplete'=>'off' ]) !!}
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
	                </div><!-- /.box-body -->
	                <div class="box-footer">
	                	{!! Form::reset("Reset", ['class'=>'btn btn-warning']) !!}
						{!! Form::submit(trans('labels.update'), array('class' => 'btn btn-info pull-right')) !!}
                	</div>
                {!! Form::close() !!}
            </div><!-- /.box -->
		</div>
	</div>

@stop
