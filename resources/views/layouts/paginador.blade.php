<footer class="light lt p-a">
  <div class="row">
    <div class="col-sm-4 hidden-xs">
      {{-- <select class="custom-select w-sm inline v-middle">
        <option value="0">Bulk action</option>
        <option value="1">Delete selected</option>
        <option value="2">Bulk edit</option>
        <option value="3">Export</option>
      </select>
      <button class="btn white">Apply</button> --}}
    </div>
    <div class="col-sm-4 text-center">
      {{-- <small class="text-muted inline m-t-sm m-b-sm">Mostrando {{ $paginator->firstItem() }}-{{ $paginator->lastPage() }} de {{ $paginator->total() }} items</small> --}}
    </div>
    <div class="col-sm-4 text-right text-center-xs">
    @if ($paginator->hasPages())
      <ul class="pagination m-a-0">
        @if ($paginator->onFirstPage())
        	<li><a class="disabled" aria-disabled="true"><i class="fa fa-chevron-left"></i></a></li>
        @else
        	<li><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a></li>
        @endif
        @foreach ($elements as $element)
        	@if (is_string($element))
        		<li><a  class="disabled" aria-disabled="true" href="#">{{ $element }}</a></li>
			@endif
			@if (is_array($element))
				@foreach ($element as $page => $url)
					@if ($page == $paginator->currentPage())
						<li class="active"><a>{{ $page }}</a></li>
					@else
						<li><a href="{{ $url }}">{{ $page }}</a></li>
					@endif
				@endforeach
			@endif
        @endforeach

        @if ($paginator->hasMorePages())
        	<li><a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a></li>
        @else
        	<li><a class="disabled" aria-disabled="true"><i class="fa fa-chevron-right"></i></a></li>
        @endif
      </ul>
    @endif
    </div>
  </div>
</footer>