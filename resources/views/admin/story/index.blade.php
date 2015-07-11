@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Story Data Table</h3>
                    <a href="{!! url('/admin/story/create') !!}" class="btn btn-info pull-right">{!! BS3::icon('plus') !!}</a>
                    @if(Entrust::can('create-permission'))
                        <a href="{!! url('/admin/story/create') !!}" class="btn btn-info pull-right">{!! BS3::icon('plus') !!}</a>
                    @endif
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{!! trans('labels.name') !!}</th>
                            <th>{!! trans('labels.lang') !!}</th>
                            <th>{!! trans('labels.category') !!}</th>
                            <th>{!! trans('labels.country') !!}</th>
                            <th>{!! trans('labels.author') !!}</th>
                            <th>{!! trans('labels.status') !!}</th>
                            <th>{!! trans('labels.option') !!}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($datas as $data)
                        @include('admin.story.renderNode', ['data'=> $data])

                    @empty
                    @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{!! trans('labels.name') !!}</th>
                            <th>{!! trans('labels.lang') !!}</th>
                            <th>{!! trans('labels.category') !!}</th>
                            <th>{!! trans('labels.country') !!}</th>
                            <th>{!! trans('labels.author') !!}</th>
                            <th>{!! trans('labels.status') !!}</th>
                            <th>{!! trans('labels.option') !!}</th>
                        </tr>
                    </tfoot>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

<?php
function renderNode($node) {
	if ($node->isLeaf()) {
		return '<li>' . $node->name . '</li>';
	} else {
		$html = '<li>' . $node->name;

		$html .= '<ul>';

		foreach ($node->children as $child) {
			$html .= renderNode($child);
		}

		$html .= '</ul>';

		$html .= '</li>';
	}
	return $html;
}
?>

@stop

@section('style')
{!! HTML::style('/assets/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
@stop

@section('script')
{!! HTML::script('/assets/jquery-ujs-master/src/rails.js') !!}
{!! HTML::script('/assets/bootstrap-switch-master/dist/js/bootstrap-switch.min.js') !!}
<script type="text/javascript">
    $('.f-toggle').bootstrapSwitch({
        size: 'normal',
        labelWidth: 1,
        readonly: true,
        onText: '{!! trans('labels.on') !!}',
        offText: '{!! trans('labels.off') !!}',
        offColor: 'danger'
    });

</script>
@stop