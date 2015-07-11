@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Article Data Table</h3>
                    <div class="pull-right">
                        <a href="{!! url('/admin/chapter/add') !!}" class="btn btn-success">{!! BS3::icon('plus') . ' ' . BS3::icon('book') !!}</a>
                        <a href="{!! url('/admin/chapter/create') !!}" class="btn btn-info">{!! BS3::icon('plus') !!}</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="lego" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{!! trans('labels.id') !!}</th>
                            <th>{!! trans('labels.chapter') !!}</th>
                            <th>{!! trans('labels.name') !!}</th>
                            <th>{!! trans('labels.story') !!}</th>
                            <th>{!! trans('labels.date_create') !!}</th>
                            <th>{!! trans('labels.author') !!}</th>
                            <th>{!! trans('labels.option') !!}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($datas as $data)
                        <tr>
                            <td>{!! $data->id !!}</td>
                            <td>{!! $data->chapter !!}</td>
                            <td>{!! $data->name !!}</td>
                            <td>
                                @if($data->stories)
                                    {!! $data->stories->name !!}
                                @endif
                            </td>
                            <td>{!! $data->created_at !!}</td>
                            <td>
                                @if($data->stories && $data->stories->authors)
                                    {!! $data->stories->authors->name !!}
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="...">
                                    @if(Entrust::can('delete-chapter'))
                                        <a class="btn btn-danger" href="{{ route('admin.chapter.destroy',array($data->id)) }}" data-method="delete" rel="nofollow" data-confirm="{!! trans('labels.delete_confirm') !!}">{!! FA::icon('trash') !!}</a>
                                    @endif
                                    @if(Entrust::can('edit-chapter'))
                                        <a href="{!! url('/admin/chapter/'.$data->id.'/edit') !!}" class="btn btn-primary">{!! FA::icon('pencil') !!}</a>
                                    @endif
                                    <a class="btn btn-danger" href="{{ route('admin.chapter.destroy',array($data->id)) }}" data-method="delete" rel="nofollow" data-confirm="{!! trans('labels.delete_confirm') !!}">{!! FA::icon('trash') !!}</a>
                                    <a href="{!! url('/admin/chapter/'.$data->id.'/edit') !!}" class="btn btn-primary">{!! FA::icon('pencil') !!}</a>
                                    <a href="{!! url('/chapter/'.$data->id) !!}" class="btn btn-primary">{!! FA::icon('eye') !!}</a>
                                    <a target="_blank" href="{!! url('/api/v1/chapter/'.$data->id) !!}" class="btn btn-info">{!! FA::icon('code-fork') !!}</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{!! trans('labels.id') !!}</th>
                            <th>{!! trans('labels.chapter') !!}</th>
                            <th>{!! trans('labels.name') !!}</th>
                            <th>{!! trans('labels.story') !!}</th>
                            <th>{!! trans('labels.date_create') !!}</th>
                            <th>{!! trans('labels.author') !!}</th>
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

@section('style')
{!! HTML::style('https://cdn.datatables.net/1.10.7/css/jquery.dataTables.css') !!}
@stop
@section('script')
{!! HTML::script('/assets/jquery-ujs-master/src/rails.js') !!}
{!! Helpers::script('/AdminLTE/plugins/datatables/jquery.dataTables.min.js') !!}
{!! Helpers::script('/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') !!}

<script type="text/javascript">
    $(document).ready(function(){
        $('#lego').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {!! url('/admin/chapter/load') !!}
        });
    });
</script>
@stop