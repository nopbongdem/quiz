@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Quản lý thành viên</h3>
                    <a href="{!! url('/admin/manager/user/create') !!}" class="btn btn-info pull-right">{!! BS3::icon('plus') !!}</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{!! trans('labels.name') !!}</th>
                                <th>{!! trans('labels.email') !!}</th>
                                <th>{!! trans('labels.role') !!}</th>
                                <th>{!! trans('labels.option') !!}</th>
                            </tr>
                        </thead>
                    <tbody>
                    @forelse($datas as $data)
                        <tr>
                            <td><a href="{!! url('/admin/manager/user/'.$data->id.'/edit') !!}">{!! $data->name !!}</a></td>
                            <td><a href="{!! url('/admin/manager/user/'.$data->id.'/edit') !!}">{!! $data->email !!}</td>
                            <td>
                                @forelse($data->roles as $role)
                                    <a href="{!! url('/admin/manager/role/'.$role->id.'/edit') !!}"><label class="label label-success">{!! $role->name !!}</label></a>
                                @empty
                                @endforelse
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="" class="btn btn-danger">{!! FA::icon('trash') !!}</a>
                                    <a href="{!! url('/admin/manager/user/'.$data->id.'/edit') !!}" class="btn btn-primary">{!! FA::icon('pencil') !!}</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                    </tbody>
                        <tfoot>
                            <tr>
                                <th>{!! trans('labels.name') !!}</th>
                                <th>{!! trans('labels.email') !!}</th>
                                <th>{!! trans('labels.role') !!}</th>
                                <th>{!! trans('labels.option') !!}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

@stop

@section('script')
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