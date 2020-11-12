<?php

namespace Pnlinh\tests;

use Pnlinh\GoogleDistance\GoogleDistance;
use Pnlinh\GoogleDistance\Tests\TestCase;

class GoogleDistanceTest extends TestCase
{
    /** @test */
    public function it_can_created()
    {
        $googleDistanceApi = new GoogleDistance('foo');

        $this->assertNotNull($googleDistanceApi);
    }

    /** @test */
    public function google_api_key_was_wrong_or_over_query_limit()
    {
        $response = (new GoogleDistance("this-is-an-invalid-key-123"))
            ->calculate('79 Đinh Tiên Hoàng, P Đa Kao, Q1, TPHCM', '265 Nguyễn Đình Chiểu, P5, Q3');

        $this->assertEquals('REQUEST_DENIED', $response->status);
    }

    /** @test */
    public function origins_address_is_wrong()
    {
        $response = (new GoogleDistance($this->googleApiKey))
            ->calculate('', '14 Grove Road, TA9 3RS, UK');

        $this->assertEquals('INVALID_REQUEST', $response->status);
    }

    /** @test */
    public function destinations_address_is_wrong()
    {
        $response = (new GoogleDistance($this->googleApiKey))
            ->calculate('14 Grove Road, TA9 3RS, UK', '');

        $this->assertEquals('INVALID_REQUEST', $response->status);
    }

    /** @test */
    public function origins_address_and_destinations_address_are_same()
    {
        $response = (new GoogleDistance($this->googleApiKey))
            ->calculate('14 Grove Road, TA9 3RS, UK', '14 Grove Road, TA9 3RS, UK');

        $this->assertEquals('OK', $response->status);
    }

    /** @test */
    public function origins_address_and_destinations_address_are_an_empty_string()
    {
        $response = (new GoogleDistance($this->googleApiKey))->calculate('', '');

        $this->assertEquals('INVALID_REQUEST', $response->status);
    }

    /** @test */
    public function google_api_returns_valid_response()
    {
        $response = (new GoogleDistance($this->googleApiKey))->calculate('14 Grove Road, TA9 3RS, UK', '20 De Burgh Hill, Dover, CT17 0BS');

        $this->assertEquals('OK', $response->status);
        $this->assertEquals('20 De Burgh Hill, Dover CT17 0BS, UK', $response->destination_address);
        $this->assertEquals('14 Grove Rd, Highbridge TA9 3RS, UK', $response->origin_address);
        $this->assertEquals('219 mi', $response->distance_text);
        $this->assertEquals(351806, $response->distance_value);
        $this->assertEquals('3 hours 53 mins', $response->duration_text);
        $this->assertEquals(13988, $response->duration_value);
        $this->assertEquals('', $response->error_message);
        $this->assertEquals(352.0, round($response->getKilometers()));
        $this->assertEquals(219.0, round($response->getMiles()));
        $this->assertEquals(233.0, round($response->getMinutes()));

        $this->assertNull($response->exception);
    }
}
