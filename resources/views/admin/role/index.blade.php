@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Article Data Table</h3>
                    @if(Entrust::can('create-role'))
                        <a href="{!! url('/admin/manager/role/create') !!}" class="btn btn-info pull-right">{!! BS3::icon('plus') !!}</a>
                    @endif
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{!! trans('labels.name') !!}</th>
                            <th>{!! trans('labels.display_name') !!}</th>
                            <th>{!! trans('labels.description') !!}</th>
                            <th>{!! trans('labels.option') !!}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($datas as $data)
                        <tr>
                            <td>{!! $data->name !!}</td>
                            <td>{!! $data->display_name !!}</td>
                            <td>{!! $data->description !!}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="">
                                    @if(Entrust::can('edit-role'))
                                        <a href="{!! url('/admin/manager/role/'.$data->id.'/edit') !!}" class="btn btn-primary">{!! FA::icon('pencil') !!}</a>
                                    @endif

                                    @if(Entrust::can('delete-role'))
                                        <a class="btn btn-danger" href="{{ route('admin.manager.role.destroy',array($data->id)) }}" data-method="delete" rel="nofollow" data-confirm="{!! trans('labels.delete_confirm') !!}">{!! FA::icon('trash') !!}</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{!! trans('labels.name') !!}</th>
                            <th>{!! trans('labels.display_name') !!}</th>
                            <th>{!! trans('labels.description') !!}</th>
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
{!! Helpers::script('/AdminLTE/plugins/datatables/jquery.dataTables.min.js') !!}
{!! Helpers::script('/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') !!}
<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
      });
    </script>
@stop