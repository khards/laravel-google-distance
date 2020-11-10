<?php

namespace Pnlinh\GoogleDistance;

/**
 * Single google matrix api response
 *
 * Class Response
 * @package Pnlinh\GoogleDistance
 */
class Response
{
    const METERS_IN_MILE = 1609.344;

    const SECONDS_IN_MINUTE = 60;

    public $status = 'FAIL';

    public $exception = null;

    public $destination_address;

    public $origin_address;
    public $distance_text;

    public $distance_value;
    public $duration_text;

    public $duration_value;

    /**
     * Parse a single google matrix api response
     *
     * @param $responseData
     */
    public function parse($responseData) {

        if (isset($responseData->origin_addresses[0])) {
            $this->origin_address = $responseData->origin_addresses[0];
        }

        if (isset($responseData->destination_addresses[0])) {
            $this->destination_address = $responseData->destination_addresses[0];
        }

        if (isset($responseData->rows[0]->elements[0]->distance)) {
            $this->distance_value = $responseData->rows[0]->elements[0]->distance->value;
            $this->distance_text = $responseData->rows[0]->elements[0]->distance->text;
        }
        if (isset($responseData->rows[0]->elements[0]->duration)) {
            $this->duration_value = $responseData->rows[0]->elements[0]->duration->value;
            $this->duration_text = $responseData->rows[0]->elements[0]->duration->text;
        }
        $this->status = $responseData->status;
    }

    /**
     * @return float|int
     */
    public function getKilometers() {
        return $this->distance_value / 1000;
    }

    /**
     * @return float
     */
    public function getMiles() {
        return $this->distance_value / self::METERS_IN_MILE;
    }

    public function getMinutes() {
        return round($this->duration_value / self::SECONDS_IN_MINUTE);
    }
}
