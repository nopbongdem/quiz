<ul class="treeview-menu">
    @foreach($childs as $item)
		@if($item->hasChildren())
			<li {!! $item->attributes() !!}>
				<a href="#">{!! $item->icon !!} <span>{!! $item->title !!}</span> <i class="fa fa-angle-left pull-right"></i></a>
				@include('partials.menu.loop', ['childs'=> $item->children()])
			</li>
		@else
			<li {!! $item->attributes() !!}>
        		<a href="{!! $item->url() !!}">{!! $item->icon !!} <span>{!! $item->title !!}</span></a>
        	</li>
		@endif

    @endforeach
</ul>