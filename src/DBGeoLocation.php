<?php
namespace Gurucomkz\GeoPicker;

use SilverStripe\ORM\FieldType\DBComposite;

/**
 * @property float $Latitude
 * @property float $Longitude
 */
class DBGeoLocation extends DBComposite
{
    /**
     * @var array<string,string>
     */
    private static $composite_db = [
        'Latitude' => 'Decimal(20,17)',
        'Longitude' => 'Decimal(20,17)',
    ];

    public function getLatitude()
    {
        return $this->getField('Latitude');
    }
    public function getLongitude()
    {
        return $this->getField('Longitude');
    }

    public function scaffoldFormField($title = null, $params = null)
    {
        return GeoLocationPickerInput::create($this->getName(), $title);
    }
}
