<div class="relative">
    <input type="text"
           wire:model.debounce.300ms="search"
           class="bg-gray-800 text-sm rounded-full pl-8 focus:shadow focus:outline-none w-64 px-3 py-1"
           placeholder="Search..">
    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="fill-current text-gray-400 w-4" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                  d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/>
        </svg>
    </div>

    <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2">
        <ul>
            <li class="border-b border-gray-700">
                <a href=""
                   class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150">
                    <img src="/screenshot1.jpg" class="w-10" alt="cover">
                    <span class="ml-4">Zelda</span>
                </a>
            </li>
        </ul>
    </div>

</div>
