@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hover Data Table</h3>
                    <a href="{!! url('/admin/question/create') !!}" class="btn btn-info pull-right">{!! FA::icon('plus') !!}</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{!! trans('labels.id') !!}</th>
                                <th>{!! trans('labels.question') !!}</th>
                                <th>{!! trans('labels.option') !!}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($datas as $data)
                            <tr>
                                <td>{!! $data->id !!}</td>
                                <td>{!! $data->question !!}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="">
                                        <a class="btn btn-danger" href="{{ route('admin.question.destroy',array($data->id)) }}" data-method="delete" rel="nofollow" data-confirm="{!! trans('labels.delete_confirm') !!}">{!! FA::icon('trash') !!}</a>
                                        <a href="{!! url('/admin/question/'.$data->id.'/edit') !!}" class="btn btn-primary">{!! FA::icon('pencil') !!}</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{!! trans('labels.id') !!}</th>
                                <th>{!! trans('labels.question') !!}</th>
                                <th>{!! trans('labels.option') !!}</th>
                            </tr>
                        </tfoot>
                    </table>
                    {!! $datas->render() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
{!! Html::script('/assets/jquery-ujs-master/src/rails.js') !!}
@stop