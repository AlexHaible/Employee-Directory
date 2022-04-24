## Installation Instructions

### Install packages
- `composer install`
- `npm install`

### Initialize .env
- `cp .env.example .env`
- Remember to change database settings.

### Generate key and seed database
- `php artisan key:generate`
- `php artisan migrate:fresh --seed`
