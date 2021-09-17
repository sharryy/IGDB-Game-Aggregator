@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Popular Games</h2>
        <div
            class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
            @foreach($popularGames as $games)
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
            @endforeach
        </div>

        <div class="flex flex-col lg:flex-row my-10">
            <div class="recently-reviewed w-full lg:w-3/4 mr-0 lg:mr-32">
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Recently Reviewed</h2>
                <div class="recently-reviewed-container space-y-12 mt-8">
                    @foreach($recentlyReviewed as $games)
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
                    @endforeach
                </div>
            </div>
            <div class="most-anticipated lg:w-1/4 mt-12 lg:mt-0">
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Most Anticipated</h2>
                @foreach($mostAnticipated as $games)
                    <div class="most-anticipated-container space-y-10 mt-8">
                        <div class="game flex">
                            <a href="#">
                                <img src="{{ Str::replaceFirst('thumb', 'cover_big', $games['cover']['url']) }}"
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
                @endforeach

                <h2 class="text-blue-500 uppercase tracking-wide font-semibold mt-8">Coming Soon</h2>
                <div class="most-anticipated-container space-y-10 mt-8">
                    <div class="game flex">
                        <a href="#">
                            <img src="/avengers.jpg" alt="game cover"
                                 class="w-16 hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="ml-4">
                            <a href="#" class="hover:text-gray-300">CyberPunk 2077</a>
                            <div class="text-gray-400 text-sm mt-1">Sept 16, 2020</div>
                        </div>
                    </div>
                </div>
                <div class="most-anticipated-container space-y-10 mt-8">
                    <div class="game flex">
                        <a href="#">
                            <img src="/avengers.jpg" alt="game cover"
                                 class="w-16 hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="ml-4">
                            <a href="#" class="hover:text-gray-300">CyberPunk 2077</a>
                            <div class="text-gray-400 text-sm mt-1">Sept 16, 2020</div>
                        </div>
                    </div>
                </div>
                <div class="most-anticipated-container space-y-10 mt-8">
                    <div class="game flex">
                        <a href="#">
                            <img src="/avengers.jpg" alt="game cover"
                                 class="w-16 hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="ml-4">
                            <a href="#" class="hover:text-gray-300">CyberPunk 2077</a>
                            <div class="text-gray-400 text-sm mt-1">Sept 16, 2020</div>
                        </div>
                    </div>
                </div>
                <div class="most-anticipated-container space-y-10 mt-8">
                    <div class="game flex">
                        <a href="#">
                            <img src="/avengers.jpg" alt="game cover"
                                 class="w-16 hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="ml-4">
                            <a href="#" class="hover:text-gray-300">CyberPunk 2077</a>
                            <div class="text-gray-400 text-sm mt-1">Sept 16, 2020</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
