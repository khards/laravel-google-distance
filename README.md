# Google Distance in Laravel
[![StyleCI](https://github.styleci.io/repos/155349271/shield?branch=master)](https://github.styleci.io/repos/155349271)

## Requirements

- PHP >= 7.1.3
- Laravel >= 5.5.*

## Installation

Require this package with composer.

```bash
composer require pnlinh/laravel-google-distance
```

To publishes config `config/google-distance.php`, use command:

```bash
php artisan vendor:publish --tag="google-distance"
```

You must set your [Google Maps API Key](https://developers.google.com/maps/documentation/distance-matrix/get-api-key) GOOGLE_MAPS_DISTANCE_API_KEY in your .env file like so:

```bash
GOOGLE_MAPS_DISTANCE_API_KEY=ThisIsMyGoogleApiKey
```

## Usage

```php
// Use Facades
use Pnlinh\GoogleDistance\Facades\GoogleDistance;

$distance = GoogleDistance::calculate('FromAddress', 'To Address');

// Use Helper Function
$distance = google_distance('From Address', 'To Address');
```

## Test

Update GOOGLE_API_KEY in phpunit.xml to your API key and then run:

```bash
composer test
```

## Credits

Original by:
- [Pham Ngoc Linh](https://github.com/pnlinh)

Enhanced by:
- [DJ Keith Hards](https://keithhards.co.uk)

For more info, please visit https://developers.google.com/maps/documentation/distance-matrix/
