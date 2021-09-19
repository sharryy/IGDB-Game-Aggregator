<div wire:init="loadMostAnticipatedGames">
    @forelse($mostAnticipated as $games)
        <div class="most-anticipated-container space-y-10 mt-8">
            <div class="game flex">
                <a href="#">
                    <img src="{{ Str::replaceFirst('thumb', 'cover_small', $games['cover']['url']) }}"
                         alt="game cover"
                         class="w-16 hover:opacity-75 transition ease-in-out duration-150">
                </a>
                <div class="ml-4">
                    <a href="#" class="hover:text-gray-300">{{ $games['name'] }}</a>
                    <div
                        class="text-gray-400 text-sm mt-1">{{ date('M j, Y.',$games['first_release_date']) }}</div>
                </div>
            </div>
        </div>
    @empty
        <div class="spinner mt-8">Loading..</div>
    @endforelse
</div>
