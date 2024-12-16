# Mojang API Client

A simple PHP/Laravel client for the Mojang Public API. Currently supports player profile lookups either by their name or UUID (Mojang ID).

## Installation

```
composer require badmushroom/mojangapiclient
```

## Example Usage

```
use BadMushroom\MojangApiClient\Facades\Mojang;

// Lookup player by name
$profile = Mojang::profile()->name('notch');

// Or lookup player by their ID
$profile = Mojang::profile()->id('069a79f4-44e9-4726-a5be-fca90e38aaf5');
```

The response will be `BadMushroom\MojangApiClient\Shapes\Profile` object but can easily be converted to an Array or JSON.

```
$profile->toArray();
$profile->toJson();
```

You're also welcome to use the shape along with its getters:

```
$profile->getId();      // Returns the player's Mojang ID
$profile->getName();    // Returns the player's name
$profile->getSkin();    // Returns a URL to the player's skin
$profile->getCape();    // Returns a URL to the player's cape, if used
```

If you just want to play around and checkout the data, there's an Artisan command for this very thing:

```
php artisan app:test-mojang notch
// or
php artisan app:test-mojang 069a79f4-44e9-4726-a5be-fca90e38aaf5
```
