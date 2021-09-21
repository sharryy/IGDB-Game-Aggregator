<div wire:init="loadMostAnticipatedGames" class="most-anticipated-container space-y-10 mt-8">
    @forelse($mostAnticipated as $games)
        <x-game-card-small :games="$games"/>
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
