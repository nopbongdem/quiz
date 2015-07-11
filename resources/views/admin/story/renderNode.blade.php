@if($data->isLeaf())
    <tr>
        <td>
            @if($data->getLevel()==0)
                {!! FA::icon('bars') !!}
            @else
                <span style="margin-left:{!! $data->getLevel()*15 !!}px">|_</span>
            @endif
            {!! $data->name !!}
        </td>
        <td>
            @if($data->languages)
                {!! $data->languages->name !!}
            @endif
        </td>
        <td>
            @forelse($data->categories as $category)
                <label class="label label-success">{!! $category->name !!}</label>
            @empty
            @endforelse
        </td>
        <td>
            @if($data->countries)
                {!! $data->countries->name !!}
            @endif
        </td>
        <td>
            @if($data->authors)
                {!! $data->authors->name !!}
            @endif
        </td>
        <td>
            @if($data->status)
                <input name="f-checkbox" type="checkbox" class="f-toggle" checked >
            @else
                <input name="f-checkbox" type="checkbox" class="f-toggle" >
            @endif
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="">
                <a href="{!! url('/admin/story/'.$data->id.'/edit') !!}" class="btn btn-primary">{!! FA::icon('pencil') !!}</a>
                <a class="btn btn-danger" href="{{ route('admin.story.destroy',array($data->id)) }}" data-method="delete" rel="nofollow" data-confirm="{!! trans('labels.delete_confirm') !!}">{!! FA::icon('trash') !!}</a>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td>
            <span style="margin-left:{!! $data->getLevel()*15 !!}px">{!! FA::icon('bars') !!}</span>
            {!! $data->name !!}
        </td>
        <td>
            @if($data->languages)
                {!! $data->languages->name !!}
            @endif
        </td>
        <td>
            @forelse($data->categories as $category)
                <label class="label label-success">{!! $category->name !!}</label>
            @empty
            @endforelse
        </td>
        <td>
            @if($data->countries)
                {!! $data->countries->name !!}
            @endif
        </td>
        <td>
            @if($data->authors)
                {!! $data->authors->name !!}
            @endif
        </td>
        <td>
            @if($data->status)
                <input name="f-checkbox" type="checkbox" class="f-toggle" checked >
            @else
                <input name="f-checkbox" type="checkbox" class="f-toggle" >
            @endif
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="">
                <a href="{!! url('/admin/story/'.$data->id.'/edit') !!}" class="btn btn-primary">{!! FA::icon('pencil') !!}</a>
                <a class="btn btn-danger" href="{{ route('admin.story.destroy',array($data->id)) }}" data-method="delete" rel="nofollow" data-confirm="{!! trans('labels.delete_confirm') !!}">{!! FA::icon('trash') !!}</a>
            </div>
        </td>
    </tr>
    @foreach($data->children as $child)
        @include('admin.story.renderNode', ['data'=> $child])
    @endforeach

@endif
