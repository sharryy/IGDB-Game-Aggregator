<div class="relative"
     x-data="{ isVisible : true }"
     @click.away="isVisible = false">
    <input type="text"
           x-ref="search"
           wire:model.debounce.200ms="search"
           @focus="isVisible = true"
           @keydown.escape.window="isVisible = false"
           @keydown="isVisible = true"
           @keydown.shift.tab="isVisible = false"
           @keydown.window="
            if (event.keyCode === 191){
                event.preventDefault();
                $refs.search.focus();
            }"
           class="bg-gray-800 text-sm rounded-full pl-8 focus:shadow focus:outline-none w-64 px-3 py-1 focus:border-gray-800"
           placeholder="Search &nbsp; (Press '/' to focus)">
    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="fill-current text-gray-400 w-4" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                  d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/>
        </svg>
    </div>

    <div style="position: absolute;"
         wire:loading
         class="spinner top-0 right-0 mr-4 mt-3">

    </div>

    @if(strlen($search) > 2)
        <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2"
             x-show.transition.opacity.duration.200="isVisible">
            @if(count($search_results) > 0)
                <ul>
                    @foreach($search_results as $game)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('games.show', $game['slug']) }}"
                               class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                               @if($loop->last) @keydown.tab="isVisible = false" @endif>
                                @if(isset($game['cover']))
                                    <img src="{{ Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) }}"
                                         class="w-10" alt="cover">
                                @else
                                    <img src="https://via.placeholder.com/264x352" alt="alternate" class="w-10">
                                @endif
                                <span class="ml-4">{{ $game['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">
                    No results for {{ $search }}
                </div>
            @endif
        </div>
    @endif
</div>
