@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Language Data Table</h3>
                    <a href="{!! url('/admin/language/create') !!}" class="btn btn-info pull-right">{!! BS3::icon('plus') !!}</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{!! trans('labels.name') !!}</th>
                            <th>{!! trans('labels.code') !!}</th>
                            <th>{!! trans('labels.option') !!}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($datas as $data)
                        <tr>
                            <td>{!! $data->name !!}</td>
                            <td>{!! $data->code !!}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="...">
                                    <a class="btn btn-danger" href="{{ route('admin.language.destroy',array($data->id)) }}" data-method="delete" rel="nofollow" data-confirm="{!! trans('labels.delete_confirm') !!}">{!! FA::icon('trash') !!}</a>
                                    <a href="{!! url('/admin/language/'.$data->id.'/edit') !!}" class="btn btn-primary">{!! FA::icon('pencil') !!}</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{!! trans('labels.name') !!}</th>
                            <th>{!! trans('labels.code') !!}</th>
                            <th>{!! trans('labels.option') !!}</th>
                        </tr>
                    </tfoot>
                    </table>
                    {!! $datas->render() !!}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

@stop

@section('script')
{!! HTML::script('/assets/jquery-ujs-master/src/rails.js') !!}
@stop