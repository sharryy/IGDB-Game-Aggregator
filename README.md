# Laravel HTTP Client Example

This application is a quick demo of laravel HTTP Client. It uses [IGDB API](https://www.igdb.com/discover) to fetch data and populate the view accordingly. Technology Stack include [Laravel](https://www.laravel.com), [Livewire](https://laravel-livewire.com/), [Tailwind CSS](https://tailwindcss.com/) and  [AlpineJS](https://alpinejs.dev/).


Website Demo: [https://intense-dusk-85848.herokuapp.com/](https://intense-dusk-85848.herokuapp.com/).

## Installation

- Clone the repo and `cd` into it
- `composer install`
- Rename or copy `.env.example` file to `.env`
- `php artisan key:generate`
- Add following two fields in `.env` file :
  + `IGDB_CLIENT_ID`
  + `IGDB_AUTHORIZATION` 
- `php artisan serve` or use Laravel Valet or Laravel Homestead
- Visit `http://127.0.0.1:8000/` in your browser


#### Credential for `IGDB API` can be found from [https://api-docs.igdb.com](https://api-docs.igdb.com/#about)
#### The design is heavily based upon Andre Madarang's Awesome Course from [Laracast](https://laracasts.com/series/build-a-video-game-aggregator).


