<div wire:init="loadComingSoonGames" class="most-anticipated-container space-y-10 mt-8">
    @forelse($comingSoon as $games)
        <div class="game flex">
            <a href="#">
                <img src="{{ Str::replaceFirst('thumb', 'cover_small', $games['cover']['url']) }}"
                     alt="game cover"
                     class="w-16 hover:opacity-75 transition ease-in-out duration-150">
            </a>
            <div class="w-52">
                <div class="ml-4">
                    <a href="#" class="hover:text-gray-300">{{ $games['name'] }}</a>
                    <div
                        class="text-gray-400 text-sm mt-1">{{ date('M j, Y.',$games['first_release_date']) }}</div>
                </div>
            </div>
        </div>
    @empty
        @foreach(range(1,4) as $games)
            <div class="game flex">
                <div class="bg-gray-800 w-16 h-20 flex-none"></div>
                <div class="ml-4">
                    <div class="text-transparent bg-gray-700 rounded leading-tight">title goes here today</div>
                    <div
                        class="text-transparent bg-gray-700 rounded inline-block text-sm mt-1">Sept 14, 2019
                    </div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>
