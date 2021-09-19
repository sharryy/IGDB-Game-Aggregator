<div wire:init="loadRecentlyReviewedGames"
     class="recently-reviewed-container space-y-12 mt-8">
    @forelse($recentlyReviewed as $games)
        <div class="flex bg-gray-800 rounded-lg shadow-md  px-6 py-6">
            <div class="game bg-gray-800 rounded-lg flex-none">
                <div class="relative">
                    <a href="#">
                        <img src="{{ Str::replaceFirst('thumb', 'cover_big', $games['cover']['url']) }}"
                             alt="game cover"
                             class="hover:opacity-75 w-48 transition ease-in-out duration-150">
                    </a>
                    @if(isset($games['rating']))
                        <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full"
                             style="right: -20px; bottom: -20px;">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">
                                {{ round($games['rating']) . '%' }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <div class="ml-12">
                    <a href="#"
                       class="block text-base font-semibold leading-tight hover:text-gray-400 mt-4">
                        {{ $games['name'] }}
                    </a>
                    <div class="text-gray-400 mt-1">
                        @foreach($games['platforms'] as $platform)
                            @if(array_key_exists('abbreviation', $platform))
                                {{ $platform['abbreviation'] }},
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-6 text-gray-400 hidden lg:block">
                        {{ $games['summary'] }}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div>Loading..</div>
    @endforelse
</div>
