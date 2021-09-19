<div wire:init="loadPopularGames"
     class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
    @forelse($popularGames as $games)
        <div class="game mt-4">
            <div class="relative inline-block">
                <a href="#">
                    <img src="{{ Str::replaceFirst('thumb', 'cover_big', $games['cover']['url']) }}"
                         alt="game cover"
                         class="hover:opacity-75 transition ease-in-out duration-150">
                </a>
                @if(isset($games['rating']))
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full"
                         style="right: -20px; bottom: -20px;">
                        <div class="font-semibold text-xs flex justify-center items-center h-full">
                            {{ round($games['rating']) . '%' }}
                        </div>
                    </div>
                @endif
            </div>
            <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-4">
                {{ $games['name'] }}
            </a>
            <div class="text-gray-400 mt-1">
                @foreach($games['platforms'] as $platform)
                    @if(array_key_exists('abbreviation', $platform))
                        {{ $platform['abbreviation'] }},
                    @endif
                @endforeach
            </div>
        </div>
    @empty
        <div class="spinner mt-8">
            Loading..
        </div>
    @endforelse
</div>
