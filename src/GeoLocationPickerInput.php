<?php

namespace Gurucomkz\GeoPicker;

use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\FormField;
use SilverStripe\ORM\DataObjectInterface;
use SilverStripe\View\Requirements;

class GeoLocationPickerInput extends FormField
{
    protected $schemaDataType = FormField::SCHEMA_DATA_TYPE_HIDDEN;

    public function __construct($name, $title = null, $value = null)
    {
        parent::__construct($name, $title, $value);
        if ($this->ApiKey()) {
            Requirements::javascript(
                "https://maps.googleapis.com/maps/api/js?libraries=places&key=" . urlencode($this->ApiKey()),
                [
                    'provides' => ['googlemaps'],
                    'async' => true,
                ]
            );
            Requirements::javascript("gurucomkz/geopicker:javascript/geolocation-picker-input.js");
        }
    }

    public function ApiKey()
    {
        if ($key = $this->config()->get("GooglePlacesAPIKey")) {
            $key = Injector::inst()->convertServiceProperty($key);
        }
        return $key;
    }

    public function saveInto(DataObjectInterface $dataObject)
    {
        $fieldName = $this->getName();

        $latitudeField = "{$fieldName}Latitude";
        $longitudeField = "{$fieldName}Longitude";

        [$lat, $lng] = $this->getLatLonArray();
        $dataObject->$latitudeField = $lat;
        $dataObject->$longitudeField = $lng;
    }

    public function setValue($val, $data = null)
    {
        if ($val instanceof DBGeoLocation) {
            $this->value = implode(',', [
                $val->Latitude,
                $val->Longitude,
            ]);
        } else {
            $this->value = $val;
        }
    }

    public function dataValue()
    {
        return $this->value ?: "0,0";
    }

    public function Value()
    {
        return $this->value ?: "0,0";
    }

    public function getLatLonArray()
    {
        $a = explode(',', $this->value);
        if (count($a)!=2) {
            return [0,0];
        }
        return array_map(function ($e) {
            return (float)$e;
        }, $a);
    }

    public function getLatitude()
    {
        return $this->getLatLonArray()[0];
    }

    public function getLongitude()
    {
        return $this->getLatLonArray()[1];
    }
}
