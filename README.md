# Pick coordinates using a map in Silverstripe

Provides a `GeoLocation` (for coordinates) field editable with a map.

Uses [Google Places API](https://developers.google.com/maps/documentation/places/web-service/overview) to display the map.


## Enable Places API & Maps JavaScript API

[Maps JavaScript API](https://developers.google.com/maps/documentation/javascript/overview) is used to display the map.

[Places API](https://developers.google.com/maps/documentation/places/web-service/overview) is used to let you find things there by typing an address.

Check out the following links to get it working
* https://developers.google.com/maps/gmp-get-started#enable-api-sdk
* https://developers.google.com/maps/documentation/places/web-service/get-api-key

Then put the key into your .env file:
```
PLACES_API_KEY="the-key"
```
## Usage

```php
class Foo extends DataObject {
    private static $db = [
        'Location' => 'GeoLocation',
    ];
}
# OR
class Foo extends DataObject {
    private static $db = [
        'Location' => DBGeoLocation::class,
    ];
}
```
You can then refer to it as
```php
$obj->Location->Latitude;
$obj->Location->Longitude;
```
