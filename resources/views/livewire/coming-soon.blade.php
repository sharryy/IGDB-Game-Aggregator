<div wire:init="loadComingSoonGames" class="most-anticipated-container space-y-10 mt-8">
    @forelse($comingSoon as $games)
        <x-game-card-small :games="$games"/>
    @empty
        @foreach(range(1,4) as $games)
            <x-game-card-small-skeleton/>
        @endforeach
    @endforelse
</div>
