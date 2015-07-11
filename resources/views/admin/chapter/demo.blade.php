@extends(Config::get('core.lte_layout_path').'.layout')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box">
                <table id="lego" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>{!! trans('labels.id') !!}</th>
                            <th>{!! trans('labels.name') !!}</th>
                            <th>{!! trans('labels.chapter') !!}</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>{!! trans('labels.id') !!}</th>
                            <th>{!! trans('labels.name') !!}</th>
                            <th>{!! trans('labels.chapter') !!}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <span onclick="dkm();" class="btn">DKM</span>
    <div id="div1"></div>

@stop

@section('style')
{!! HTML::style('/assets/DataTables-1.10.7/media/css/jquery.dataTables.min.css') !!}
@stop
@section('script')

{!! Helpers::script('/assets/DataTables-1.10.7/media/js/jquery.dataTables.min.js') !!}

<script type="text/javascript">
        $('#aaa').DataTable( {
            "processing": true,
            "serverSide": true,
            ajax: '/admin/chapter/data',
            columns: [
                {data: 'id'},
                {data: 'name'}
            ]
        });

        $('#lego').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/chapter/data',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action'}
            ]
        });

</script>
@stop
