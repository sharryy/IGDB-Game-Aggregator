<div wire:init="loadRecentlyReviewedGames"
     class="recently-reviewed-container space-y-12 mt-8">
    @forelse($recentlyReviewed as $games)
        <div class="flex bg-gray-800 rounded-lg shadow-md  px-6 py-6">
            <div class="game bg-gray-800 rounded-lg flex-none">
                <div class="relative">
                    <a href="{{ route('games.show', $games['slug']) }}">
                        <img src="{{ $games['coverImageUrl'] }}"
                             alt="game cover"
                             class="hover:opacity-75 w-48 transition ease-in-out duration-150">
                    </a>
                    @if(isset($games['rating']))
                        <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full"
                             style="right: -20px; bottom: -20px;">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">
                                {{ $games['rating'] }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <div class="ml-12">
                    <a href="{{ route('games.show', $games['slug']) }}"
                       class="block text-base font-semibold leading-tight hover:text-gray-400 mt-4">
                        {{ $games['name'] }}
                    </a>
                    <div class="text-gray-400 mt-1">
                        {{ $games['platform'] }}
                    </div>
                    <div class="mt-6 text-gray-400 hidden lg:block">
                        {{ $games['summary'] }}
                    </div>
                </div>
            </div>
        </div>
    @empty
        @foreach(range(1, 3) as $games)
            <div class="flex bg-gray-800 rounded-lg shadow-md  px-6 py-6">
                <div class="game bg-gray-800 rounded-lg flex-none">
                    <div class="relative">
                        <div class="bg-gray-700 w-32 lg:w-48 h-40 lg:h-56"></div>
                    </div>
                </div>
                <div>
                    <div class="ml-12">
                        <div href="#"
                             class="inline-block text-base font-semibold leading-tight text-transparent bg-gray-700 rounded mt-4">
                            name goes here.
                        </div>
                        <div class="mt-8 space-y-4 hidden lg:block">
                            <span class="text-transparent bg-gray-700 rounded inline-block">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum.
                            </span>
                            <span class="text-transparent bg-gray-700 rounded inline-block">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum.
                            </span>
                            <span class="text-transparent bg-gray-700 rounded inline-block">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforelse
</div>

@push('scripts')
    @include('_rating', [
        'event'=> 'reviewGameWithRatingAdded',
    ])
@endpush
