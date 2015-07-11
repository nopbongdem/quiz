@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<div class="box box-primary">
                <div class="box-header">
                	<h3 class="box-title">Tag info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($permissions, [ 'method'=>'PUT', 'route' => array('admin.manager.permission.update', $permissions->id), 'prefix'=>'admin', 'role'=>'form' ]) !!}
	                <div class="box-body">
	                    <div class="form-group">
	                      	{!! Form::label('name', trans('labels.name')) !!}
							{!! Form::text('name', null, array('class' => 'form-control')) !!}
							<small class="text-danger">{{ $errors->first('name') }}</small>
	                    </div>
	                    <div class="form-group">
	                    	{!! Form::label('display_name', trans('labels.display_name')) !!}
							{!! Form::text('display_name', null, array('class' => 'form-control')) !!}
							<small class="text-danger">{{ $errors->first('display_name') }}</small>
	                    </div>
	                    <div class="form-group">
		                	{!! Form::label('description', trans('labels.description')) !!}
						    {!! Form::textarea('description', null, array('class' => 'form-control' ,'rows' => 5)) !!}
						    <small class="text-danger">{{ $errors->first('html') }}</small>
		                </div>
	                    <div class="form-group">
	                    	{!! Form::label('role_list', trans('labels.role')) !!}
	                    	{!! Form::select('role_list[]', $roles, null, ['id'=>'role_list', 'class' => 'form-control select2', 'multiple']) !!}
						    <small class="text-danger">{{ $errors->first('role_list') }}</small>
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
{!! Helpers::style('/assets/select2-4.0.0/dist/css/select2.min.css') !!}
@stop

@section('script')
{!! Helpers::script('/assets/select2-4.0.0/dist/js/select2.min.js') !!}
<script type="text/javascript">
	$('.select2').select2();
</script>
@stop