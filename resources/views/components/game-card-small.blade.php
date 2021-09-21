<div class="game flex">
    <a href="{{ route('games.show', $games['slug']) }}">
        <img src="{{ $games['coverImageUrl'] }}"
             alt="game cover"
             class="w-16 hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="w-52">
        <div class="ml-4">
            <a href="{{ route('games.show', $games['slug']) }}"
               class="hover:text-gray-300">{{ $games['name'] }}</a>
            <div
                class="text-gray-400 text-sm mt-1">{{ $games['releaseDate'] }}</div>
        </div>
    </div>
</div>
